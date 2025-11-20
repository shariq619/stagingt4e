<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Jobs\SendRawEmailJob;
use App\Models\Course;
use App\Models\Lead;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class LeadController extends Controller
{
    public function index()
    {
        $statuses = Lead::STATUSES;
        $courses = Course::select('id', 'name')->orderBy('name')->get();
        return view('crm.leads.index', compact('statuses', 'courses'));
    }

    public function dt(Request $request)
    {
        $baseQuery = Lead::with(['creator:id,name'])->select('leads.*');

        $kw = trim((string)$request->input('q', ''));
        if ($kw !== '') {
            $like = '%' . str_replace(['%', '_'], ['\%', '\_'], $kw) . '%';
            $baseQuery->where(function ($w) use ($like) {
                $w->where('candidate_name', 'like', $like)
                    ->orWhere('email', 'like', $like)
                    ->orWhere('contact_number', 'like', $like)
                    ->orWhere('city', 'like', $like)
                    ->orWhere('course_interested', 'like', $like)
                    ->orWhere('platform', 'like', $like)
                    ->orWhere('source', 'like', $like)
                    ->orWhere('notes', 'like', $like)
                    ->orWhere('status', 'like', $like)
                    ->orWhereHas('creator', function ($cq) use ($like) {
                        $cq->where('name', 'like', $like);
                    });
            });
        }

        $from = $request->input('date_from');
        $to = $request->input('date_to');

        if ($from) {
            $baseQuery->whereDate('contact_date', '>=', $from);
        }
        if ($to) {
            $baseQuery->whereDate('contact_date', '<=', $to);
        }

        $dataQuery = clone $baseQuery;

        if ($request->filled('status')) {
            $status = (string)$request->input('status');
            $dataQuery->where('status', $status);
        }

        $summaryQuery = clone $baseQuery;

        $kpiStatusCounts = (clone $summaryQuery)
            ->select('status', DB::raw('COUNT(*) as aggregate'))
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        $kpiTotal = (int)array_sum($kpiStatusCounts->toArray());

        return DataTables::eloquent($dataQuery)
            ->addColumn('created_by', fn(Lead $x) => $x->creator && $x->creator->name ? $x->creator->name : '-')
            ->addColumn('status_label', fn(Lead $x) => $x->status_label ?: '-')
            ->editColumn('contact_date', fn(Lead $x) => $x->contact_date ? $x->contact_date->format('Y-m-d') : '-')
            ->editColumn('enrolment_date', fn(Lead $x) => $x->enrolment_date ? $x->enrolment_date->format('Y-m-d') : '-')
            ->editColumn('follow_up_at', fn(Lead $x) => $x->follow_up_at ? $x->follow_up_at->format('Y-m-d H:i') : '-')
            ->editColumn('follow_up2_at', fn(Lead $x) => $x->follow_up2_at ? $x->follow_up2_at->format('Y-m-d H:i') : '-')
            ->editColumn('follow_up_final_at', fn(Lead $x) => $x->follow_up_final_at ? $x->follow_up_final_at->format('Y-m-d H:i') : '-')
            ->editColumn('candidate_name', fn(Lead $x) => $x->candidate_name ?: '-')
            ->editColumn('contact_number', fn(Lead $x) => $x->contact_number ?: '-')
            ->editColumn('email', fn(Lead $x) => $x->email ?: '-')
            ->editColumn('course_interested', fn(Lead $x) => $x->course_interested ?: '-')
            ->editColumn('city', fn(Lead $x) => $x->city ?: '-')
            ->editColumn('platform', fn(Lead $x) => $x->platform ?: '-')
            ->editColumn('source', fn(Lead $x) => $x->source ?: '-')
            ->editColumn('notes', fn(Lead $x) => $x->notes ?: '-')
            ->addColumn('actions', function (Lead $x) {
                return '<div class="btn-group">
                <button class="btn btn-sm btn-soft btn-modern act-auto" data-id="' . $x->id . '">
                    <i class="bi bi-magic"></i><span>Auto</span>
                </button>
                <button class="btn btn-sm btn-soft btn-modern act-check" data-id="' . $x->id . '">
                    <i class="bi bi-search"></i><span>Check</span>
                </button>
                <button class="btn btn-sm btn-soft btn-modern act-edit" data-id="' . $x->id . '">
                    <i class="bi bi-pencil-square"></i><span>Edit</span>
                </button>
                <button class="btn btn-sm btn-danger btn-modern act-del" data-id="' . $x->id . '">
                    <i class="bi bi-trash"></i><span>Del</span>
                </button>
            </div>';
            })
            ->rawColumns(['actions'])
            ->with([
                'kpi_total' => $kpiTotal,
                'kpi_status_counts' => $kpiStatusCounts,
            ])
            ->toJson();
    }

    public function store(Request $request)
    {
        $data = $this->rules($request);

        if (empty($data['follow_up_at'])) {
            $data['follow_up_at'] = now();
        }

        $data['created_by_id'] = auth()->id();

        $lead = Lead::create($data);

        return response()->json(['ok' => true, 'id' => $lead->id]);
    }

    public function update(Request $request, Lead $lead)
    {
        $lead->update($this->rules($request, $lead->id));

        return response()->json(['ok' => true]);
    }

    public function show(Lead $lead)
    {
        return response()->json($lead);
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();

        return response()->json(['ok' => true]);
    }

    public function checkEnrollment(Lead $lead)
    {
        $u = $this->findMatchingLearner($lead);

        if ($u) {
            $this->attachEnrollment($lead, $u);
            return response()->json(['ok' => true, 'enrolled' => true, 'user_id' => $u->id]);
        } else {
            return response()->json(['ok' => true, 'enrolled' => false]);
        }
    }

    public function bulkSyncEnrollment()
    {
        $n = 0;

        Lead::where('status', '!=', 'enrolled')->chunkById(500, function ($chunk) use (&$n) {
            foreach ($chunk as $lead) {
                $u = $this->findMatchingLearner($lead);

                if ($u) {
                    $this->attachEnrollment($lead, $u);
                    $n++;
                }
            }
        });

        return response()->json(['ok' => true, 'updated' => $n]);
    }

    protected function computeStatus(Lead $lead)
    {
        if ($u = $this->findMatchingLearner($lead)) {
            $lead->user_id = $u->id;
            $lead->enrolment_date = $lead->enrolment_date ?: now()->toDateString();
            return 'enrolled';
        }

        $txt = mb_strtolower(trim(($lead->notes ?? '') . ' ' . ($lead->source ?? '') . ' ' . ($lead->platform ?? '')));

        if (Str::contains($txt, [' dnd ', 'do not disturb', 'dnd'])) {
            return 'do_not_disturb';
        }

        if ($lead->follow_up_final_at && now()->greaterThan(Carbon::parse($lead->follow_up_final_at)->addDays(7))) {
            return 'last_hope';
        }

        if ($lead->follow_up_at || $lead->follow_up2_at || $lead->follow_up_final_at) {
            return 'need_to_followup';
        }

        if ($lead->course_interested && !$lead->enrolment_date) {
            return 'processing';
        }

        return 'pending';
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        $status = $request->validate(['status' => ['required', Rule::in(array_keys(Lead::STATUSES))]])['status'];

        if ($status === 'enrolled' && !$lead->user_id) {
            if ($u = $this->findMatchingLearner($lead)) {
                $this->attachEnrollment($lead, $u);
            } else {
                $lead->enrolment_date = $lead->enrolment_date ?: now()->toDateString();
            }
        }

        $lead->status = $status;
        $lead->save();

        return response()->json(['ok' => true, 'status' => $lead->status]);
    }

    public function bulkUpdateStatus(Request $request)
    {
        $data = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:leads,id',
            'status' => ['required', Rule::in(array_keys(Lead::STATUSES))]
        ]);

        $n = Lead::whereIn('id', $data['ids'])->update(['status' => $data['status']]);

        return response()->json(['ok' => true, 'updated' => $n]);
    }

    public function autoStatus(Lead $lead)
    {
        $lead->status = $this->computeStatus($lead);
        $lead->save();

        return response()->json(['ok' => true, 'status' => $lead->status, 'user_id' => $lead->user_id]);
    }

    public function autoStatusBulk()
    {
        $n = 0;

        Lead::chunkById(500, function ($chunk) use (&$n) {
            foreach ($chunk as $lead) {
                $new = $this->computeStatus($lead);

                if ($new !== $lead->status || ($new === 'enrolled' && !$lead->user_id)) {
                    $lead->status = $new;
                    $lead->save();
                    $n++;
                }
            }
        });

        return response()->json(['ok' => true, 'updated' => $n]);
    }


    public function bulkSendEmail(Request $request)
    {
        $data = $request->validate([
            'scope' => ['required', Rule::in(['single', 'selected', 'all_filtered'])],
            'to' => ['nullable', 'string'],
            'subject' => ['required', 'string', 'min:2', 'max:190'],
            'html_body' => ['required', 'string', 'min:1'],
            'ids' => ['array'],
            'ids.*' => ['integer', 'exists:leads,id'],
            'filters' => ['array'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'max:5120'],
        ]);

        $scope = $data['scope'];

        $manualAddresses = [];
        $toRaw = trim($data['to'] ?? '');
        if ($toRaw !== '') {
            $manualAddresses = array_filter(array_map('trim', explode(',', $toRaw)));
        }

        $addresses = [];

        if ($scope === 'single') {
            $addresses = $manualAddresses;

        } elseif ($scope === 'selected') {
            $ids = $data['ids'] ?? [];
            if (!count($ids)) {
                return response()->json(['message' => 'No leads selected'], 422);
            }

            $addresses = Lead::whereIn('id', $ids)
                ->whereNotNull('email')
                ->pluck('email')
                ->all();

            $addresses = array_merge($addresses, $manualAddresses);

        } elseif ($scope === 'all_filtered') {
            $filters = $data['filters'] ?? [];
            $baseQuery = Lead::with(['creator:id,name'])->select('leads.*');

            $kw = isset($filters['q']) ? trim((string)$filters['q']) : '';
            if ($kw !== '') {
                $like = '%' . str_replace(['%', '_'], ['\%', '\_'], $kw) . '%';
                $baseQuery->where(function ($w) use ($like) {
                    $w->where('candidate_name', 'like', $like)
                        ->orWhere('email', 'like', $like)
                        ->orWhere('contact_number', 'like', $like)
                        ->orWhere('city', 'like', $like)
                        ->orWhere('course_interested', 'like', $like)
                        ->orWhere('platform', 'like', $like)
                        ->orWhere('source', 'like', $like)
                        ->orWhere('notes', 'like', $like)
                        ->orWhere('status', 'like', $like)
                        ->orWhereHas('creator', function ($cq) use ($like) {
                            $cq->where('name', 'like', $like);
                        });
                });
            }

            $from = $filters['date_from'] ?? null;
            $to = $filters['date_to'] ?? null;

            if ($from) {
                $baseQuery->whereDate('contact_date', '>=', $from);
            }
            if ($to) {
                $baseQuery->whereDate('contact_date', '<=', $to);
            }

            if (!empty($filters['status'])) {
                $baseQuery->where('status', $filters['status']);
            }

            $addresses = $baseQuery
                ->whereNotNull('email')
                ->pluck('email')
                ->all();

            $addresses = array_merge($addresses, $manualAddresses);
        }

        $addresses = array_values(array_unique(array_filter($addresses)));

        if (!count($addresses)) {
            return response()->json(['message' => 'No recipient email found'], 422);
        }

        foreach ($addresses as $addr) {
            if (!filter_var($addr, FILTER_VALIDATE_EMAIL)) {
                return response()->json(['message' => 'Invalid email: ' . $addr], 422);
            }
        }

        $attachments = [];
        $files = $request->file('attachments', []);
        foreach ($files as $file) {
            if (!$file || !$file->isValid()) {
                continue;
            }

            $storedPath = $file->store('email_attachments', 'local');

            $attachments[] = [
                'disk' => 'local',
                'path' => $storedPath,
                'name' => $file->getClientOriginalName(),
                'mime' => $file->getClientMimeType(),
            ];
        }

        try {
            $users = User::whereIn('email', $addresses)->get()->keyBy('email');

            $delay = 10;
            foreach ($addresses as $addr) {
                $recipientUserId = optional($users->get($addr))->id;

                SendRawEmailJob::dispatch(
                    $addr,
                    $data['subject'],
                    $data['html_body'],
                    $attachments,
                    $recipientUserId
                )->delay(now()->addSeconds($delay));

                $delay++;
            }

            return response()->json(['ok' => true, 'sent' => count($addresses)], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Email enqueue failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    protected function rules(Request $request, $id = null)
    {
        return $request->validate([
            'contact_date' => ['nullable', 'date'],
            'candidate_name' => ['required', 'string', 'max:150'],
            'contact_number' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'course_interested' => ['nullable', 'string', 'max:150'],
            'city' => ['nullable', 'string', 'max:120'],
            'status' => ['required', Rule::in(array_keys(Lead::STATUSES))],
            'enrolment_date' => ['nullable', 'date'],
            'platform' => ['nullable', 'string', 'max:120'],
            'source' => ['nullable', 'string', 'max:120'],
            'notes' => ['nullable', 'string'],
            'follow_up_at' => ['nullable', 'date'],
            'follow_up2_at' => ['nullable', 'date'],
            'follow_up_final_at' => ['nullable', 'date'],
            'course_id' => ['nullable', 'exists:courses,id'],
            'user_id' => ['nullable', 'exists:users,id'],
        ]);
    }

    protected function normalizePhoneVariants(?string $raw): array
    {
        if (!$raw) {
            return [];
        }

        $digits = preg_replace('/\D+/', '', $raw);

        if ($digits === '') {
            return [];
        }

        $variants = [];

        if (Str::startsWith($digits, '0')) {
            $local = $digits;
            $variants[] = $local;
            $variants[] = '92' . ltrim($local, '0');
            $variants[] = '92' . ltrim($local, '0');
        }

        if (Str::startsWith($digits, '92')) {
            $intl = $digits;
            $variants[] = $intl;
            $variants[] = '0' . substr($intl, 2);
        }

        if (Str::startsWith($digits, '0092')) {
            $v = substr($digits, 2);
            $variants[] = $v;
            $variants[] = '0' . substr($v, 2);
        }

        $variants[] = $digits;

        return array_values(array_unique(array_filter($variants)));
    }

    protected function findMatchingLearner(Lead $lead): ?User
    {
        $email = $lead->email ? trim(mb_strtolower($lead->email)) : null;
        $phoneVariants = $this->normalizePhoneVariants($lead->contact_number);

        $query = User::role('Learner');

        if ($email) {
            $query->where(function ($qq) use ($email) {
                $qq->whereRaw('LOWER(TRIM(email)) LIKE ?', [$email . '%'])
                    ->orWhereRaw('LOWER(TRIM(work_email)) LIKE ?', [$email . '%']);
            });
        }

        if ($phoneVariants) {
            $query->orWhere(function ($qq) use ($phoneVariants) {
                $qq->whereIn('phone_number', $phoneVariants)
                    ->orWhereIn('mobile', $phoneVariants)
                    ->orWhereIn('telephone', $phoneVariants)
                    ->orWhereIn('work_tel', $phoneVariants);
            });
        }

        return $query->first();
    }

    protected function attachEnrollment(Lead $lead, User $u): void
    {
        $lead->update([
            'status' => 'enrolled',
            'user_id' => $u->id,
            'enrolment_date' => $lead->enrolment_date ?: now()->toDateString(),
        ]);
    }
}
