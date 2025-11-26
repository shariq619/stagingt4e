<?php

namespace App\Http\Controllers\CRM;

use App\Models\CohortMiscellounose;
use App\Models\CohortReassignment;
use App\Models\ProductInvoice;
use App\Models\ProductInvoiceLine;
use App\Models\ProductInvoicePayment;
use App\Models\User;
use App\Models\Venue;
use App\Models\Cohort;
use App\Models\Course;
use App\Models\FrontOrder;
use App\Models\FrontPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\CheckoutDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\FrontOrderDetails;
use App\Models\UserCohortPayment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\EmailSendingService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Traits\BuildsInvoiceLines;
use App\Traits\UserCohortReassignment;
use App\Traits\HandlesCohortEnrollment;

use Yajra\DataTables\Facades\DataTables;

class TrainingCoursesController extends Controller
{
    use BuildsInvoiceLines, UserCohortReassignment, HandlesCohortEnrollment;


    public function index(Request $request)
    {
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);
        $day = $request->get('day');

        $countQuery = Cohort::query()
            ->whereYear('start_date_time', $year)
            ->whereMonth('start_date_time', $month);

        if ($day) {
            $countQuery->whereDay('start_date_time', $day);
        }

        $cohort_count = $countQuery->count();

        $trainers = User::role('trainer')
            ->orderBy('name')
            ->pluck('name', 'id');

        return view('crm.training-courses.index', compact('cohort_count', 'trainers'));
    }

    public function show($id)
    {
        return view('crm.training-courses.show');
    }

    public function json($id)
    {
        $c = Cohort::with(['course.user', 'trainer', 'venue'])->findOrFail($id);
        return response()->json([
            'id' => $c->id,
            'training_course_initials' => crmGetFirstLettersOfWord(optional($c->course)->name ?? '-'),
            'course_name' => optional($c->course)->name ?? '-',
            'start_date' => Carbon::parse($c->start_date_time)->format('d-m-Y'),
            'end_date' => Carbon::parse($c->end_date_time)->format('d-m-Y'),
            'duration' => optional($c->course)->duration,
            'status' => $c->status,
            'venue' => [
                'post_code' => optional($c->venue)->post_code,
                'venue_name' => optional($c->venue)->venue_name,
            ],
            'owner' => trim((optional($c->course->user)->name . ' ' . optional($c->course->user)->middle_name . ' ' . optional($c->course->user)->last_name)) ?: '-',
            'max_learner' => $c->max_learner,
            'trainer' => [
                'name' => trim(($c->trainer->name ?? '') . ' ' . ($c->trainer->middle_name ?? '') . ' ' . ($c->trainer->last_name ?? '')) ?: '-',
                'telephone' => $c->trainer->telephone ?? ($c->trainer->phone_number ?? 'N/A'),
            ],
            'trainer_cost' => $c->trainer_cost ?? 0.0,
            'additional_details' => $c->additional_details ?? '',
        ]);
    }

    public function trainingCoursesDatatables(Request $request)
    {
        $year   = $request->get('year', now()->year);
        $month  = $request->get('month', now()->month);
        $day    = $request->get('day');
        $status = $request->get('status');
        $q      = $request->get('q');
        $starts = $request->get('starts');

        $query = DB::table('cohorts as c')
            ->leftJoin('courses as crs', 'crs.id', '=', 'c.course_id')
            ->leftJoin('users as t', 't.id', '=', 'c.trainer_id')
            ->leftJoin('venues as v', 'v.id', '=', 'c.venue_id')
            ->select([
                'c.id',
                'c.status',
                'c.max_learner',
                DB::raw('c.start_date_time'),
                DB::raw('DATE_FORMAT(c.start_date_time, "%d-%m-%Y") as course_date'),
                DB::raw('crs.name as course_plain'),
                DB::raw('crs.duration as days_plain'),
                DB::raw('t.name as trainer_name'),
                DB::raw('v.venue_name as venue_name'),
                DB::raw('(SELECT COUNT(*) FROM cohort_user cu WHERE cu.cohort_id = c.id) as learners_count'),
            ])
            ->whereYear('c.start_date_time', $year)
            ->whereMonth('c.start_date_time', $month)
            ->where('c.deleted_at', null);

        if (!empty($day)) {
            $query->whereDay('c.start_date_time', $day);
        }

        if (!empty($status)) {
            $query->where('c.status', $status);
        }

        if (!empty($starts)) {
            $query->where('crs.name', 'like', $starts . '%');
        }

        if (!empty($q)) {
            $query->where(function ($w) use ($q) {
                $w->where('crs.name', 'like', "%{$q}%")
                    ->orWhere('c.status', 'like', "%{$q}%")
                    ->orWhere('t.name', 'like', "%{$q}%")
                    ->orWhere('v.venue_name', 'like', "%{$q}%");
            });
        }

        $baseCount = (clone $query)->count();
        $cohortIds = (clone $query)->pluck('c.id')->all();

        $financialsByCohort = [];
        $subTotal  = 0.0;
        $discountT = 0.0;
        $totalCost = 0.0;
        $vatT      = 0.0;
        $miscNet   = 0.0;
        $miscVat   = 0.0;
        $resNetT   = 0.0;
        $resVatT   = 0.0;

        if (!empty($cohortIds)) {
            $invTable   = (new ProductInvoice())->getTable();
            $lineTable  = (new ProductInvoiceLine())->getTable();
            $miscTable  = (new CohortMiscellounose())->getTable();
            $cohortTbl  = (new Cohort())->getTable();

            $lineAgg = DB::table($lineTable . ' as l')
                ->join($invTable . ' as i', 'i.id', '=', 'l.invoice_id')
                ->selectRaw("
                i.cohort_id,
                l.is_reassigned,
                COALESCE(SUM(l.qty * l.unit_cost), 0)       AS sub_total,
                COALESCE(SUM(l.discount), 0)                AS discount,
                COALESCE(SUM(l.net_amount), 0)              AS total_cost,
                COALESCE(SUM(l.vat_amount), 0)              AS vat
            ")
                ->whereIn('i.cohort_id', $cohortIds)
                ->whereNull('i.deleted_at')
                ->whereNull('l.deleted_at')
                ->groupBy('i.cohort_id', 'l.is_reassigned')
                ->get();

            $byCohort = [];

            foreach ($lineAgg as $row) {
                $cid = (int) $row->cohort_id;
                if (!isset($byCohort[$cid])) {
                    $byCohort[$cid] = [
                        'sub'    => 0.0,
                        'disc'   => 0.0,
                        'net'    => 0.0,
                        'vat'    => 0.0,
                        'resNet' => 0.0,
                        'resVat' => 0.0,
                    ];
                }

                if ((int) $row->is_reassigned === 1) {
                    $byCohort[$cid]['resNet'] += (float) $row->total_cost;
                    $byCohort[$cid]['resVat'] += (float) $row->vat;
                } else {
                    $byCohort[$cid]['sub']  += (float) $row->sub_total;
                    $byCohort[$cid]['disc'] += (float) $row->discount;
                    $byCohort[$cid]['net']  += (float) $row->total_cost;
                    $byCohort[$cid]['vat']  += (float) $row->vat;
                }
            }

            $miscAgg = DB::table($miscTable)
                ->selectRaw("
                cohort_id,
                COALESCE(SUM(net_cost), 0) AS misc_net,
                COALESCE(SUM(vat), 0)      AS misc_vat
            ")
                ->whereIn('cohort_id', $cohortIds)
                ->groupBy('cohort_id')
                ->get()
                ->keyBy('cohort_id');

            $excludeMiscById = DB::table($cohortTbl)
                ->whereIn('id', $cohortIds)
                ->pluck('exclude_misc', 'id');

            foreach ($cohortIds as $cid) {
                $cidInt = (int) $cid;

                $base = $byCohort[$cidInt] ?? [
                    'sub'    => 0.0,
                    'disc'   => 0.0,
                    'net'    => 0.0,
                    'vat'    => 0.0,
                    'resNet' => 0.0,
                    'resVat' => 0.0,
                ];

                $sub  = $base['sub'];
                $disc = $base['disc'];
                $net  = $base['net'];
                $vat  = $base['vat'];
                $resN = $base['resNet'];
                $resV = $base['resVat'];

                $miscN = 0.0;
                $miscV = 0.0;

                $miscRow = $miscAgg->get($cidInt);
                $excludeMisc = (bool) ($excludeMiscById[$cidInt] ?? false);

                if (!$excludeMisc && $miscRow) {
                    $miscN = (float) $miscRow->misc_net;
                    $miscV = (float) $miscRow->misc_vat;
                }

                $financialsByCohort[$cidInt] = [
                    'sub_total'  => round($sub, 2),
                    'discount'   => round($disc, 2),
                    'total_cost' => round($net, 2),
                    'vat'        => round($vat, 2),
                    'misc_net'   => round($miscN, 2),
                    'misc_vat'   => round($miscV, 2),
                    'misc_total' => round($miscN + $miscV, 2),
                    'res_net'    => round($resN, 2),
                    'res_vat'    => round($resV, 2),
                    'res_total'  => round($resN + $resV, 2),
                ];

                $subTotal  += $sub;
                $discountT += $disc;
                $totalCost += $net;
                $vatT      += $vat;
                $miscNet   += $miscN;
                $miscVat   += $miscV;
                $resNetT   += $resN;
                $resVatT   += $resV;
            }
        }

        $miscTotal = $miscNet + $miscVat;
        $resTotalT = $resNetT + $resVatT;

        $totals = [
            'sub_total'  => round($subTotal, 2),
            'discount'   => round($discountT, 2),
            'total_cost' => round($totalCost, 2),
            'vat'        => round($vatT, 2),
            'count'      => (int) $baseCount,
            'misc_net'   => round($miscNet, 2),
            'misc_vat'   => round($miscVat, 2),
            'misc_total' => round($miscTotal, 2),
            'res_net'    => round($resNetT, 2),
            'res_vat'    => round($resVatT, 2),
            'res_total'  => round($resTotalT, 2),
        ];

        return DataTables::queryBuilder($query)
            ->addColumn('course_name', function ($row) {
                $name = e($row->course_plain ?? '');
                $url  = route('crm.training-courses.show', $row->id);
                return '<a class="text-decoration-underline" href="' . $url . '" target="_blank" rel="noopener noreferrer">' . $name . '</a>';
            })
            ->addColumn('days', function ($row) {
                return $row->days_plain ?? '';
            })
            ->addColumn('availability', function ($row) {
                $available = max(
                    0,
                    (int) ($row->max_learner ?? 0) - (int) ($row->learners_count ?? 0)
                );
                return '<span class="badge-soft">' . $available . '</span>';
            })
            ->addColumn('net', function ($row) use ($financialsByCohort) {
                $cid = (int) $row->id;
                $f   = $financialsByCohort[$cid] ?? ['total_cost' => 0.0];
                return number_format($f['total_cost'], 2);
            })
            ->addColumn('vat', function ($row) use ($financialsByCohort) {
                $cid = (int) $row->id;
                $f   = $financialsByCohort[$cid] ?? ['vat' => 0.0];
                return number_format($f['vat'], 2);
            })
            ->addColumn('discount', function ($row) use ($financialsByCohort) {
                $cid = (int) $row->id;
                $f   = $financialsByCohort[$cid] ?? ['discount' => 0.0];
                return number_format($f['discount'], 2);
            })
            ->addColumn('invoice_total', function ($row) use ($financialsByCohort) {
                $cid = (int) $row->id;
                $f   = $financialsByCohort[$cid] ?? [
                    'total_cost' => 0.0,
                    'vat'        => 0.0,
                ];
                $gross = $f['total_cost'] + $f['vat'];
                return '<span class="fw-semibold">' . number_format($gross, 2) . '</span>';
            })
            ->addColumn('status_text', fn($row) => e($row->status ?? ''))
            ->addColumn('customer', function ($row) {
                $name = e(getCohortClientName((object) ['id' => $row->id]) ?? '');
                return '<span class="td-trunc" title="' . $name . '">' . $name . '</span>';
            })
            ->editColumn('course_date', fn($row) => $row->course_date ?? 'N/A')
            ->rawColumns(['course_name', 'availability', 'invoice_total', 'customer'])
            ->orderColumn('course_date', 'c.start_date_time $1')
            ->with([
                'total'  => $baseCount,
                'totals' => $totals,
            ])
            ->make(true);
    }


    protected function buildLearnerRows(int $cohortId, ?string $search = null, ?string $learnerStatus = null): array
    {
        $ids = DB::table('cohort_user')
            ->where('cohort_id', $cohortId)
            ->pluck('user_id');

        if ($ids->isEmpty()) {
            return [];
        }

        $q = User::query()
            ->leftJoin('users as parent', 'users.client_id', '=', 'parent.id')
            ->whereIn('users.id', $ids->all())
            ->whereNull('users.deleted_at')
            ->select([
                'users.id',
                'users.name',
                'users.last_name',
                'users.email',
                'users.learner_status',
                'users.created_at',
                'users.client_id',
                DB::raw("CONCAT(parent.name, ' ', parent.last_name) AS client_name"),
            ]);

        if ($search !== null && trim($search) !== '') {
            $s = trim($search);
            $q->where(function ($qq) use ($s) {
                $qq->where('name', 'like', "%{$s}%")
                    ->orWhereRaw("CONCAT(name,' ',COALESCE(last_name,'')) LIKE ?", ["%{$s}%"]);
            });
        }

        $users = $q->orderByDesc('id')->get();
        $rows  = [];

        foreach ($users as $u) {
            $userId = (int) $u->id;

            $p = getFrontOrder($userId, $cohortId);

            $od = $p
                ? FrontOrderDetails::where('order_id', $p->order_id)
                    ->where('cohort_id', $cohortId)
                    ->first()
                : null;

            $invoice = null;

            if (!empty($p?->latestInvoice?->id)) {
                $invoice = $p->latestInvoice;
            } elseif (!empty($od?->id)) {
                $invoice = ProductInvoice::where('order_detail_id', $od->id)
                    ->latest('id')
                    ->first();
            }

            $baseNet   = 0.0;
            $discLine  = 0.0;
            $netAfter  = 0.0;
            $vatAmount = 0.0;
            $vatRate   = 0.0;
            $resNet    = 0.0;
            $resVat    = 0.0;

            $baseNetTotal   = 0.0;
            $discLineTotal  = 0.0;
            $netAfterTotal  = 0.0;
            $vatAmountTotal = 0.0;
            $resNetTotal    = 0.0;
            $resVatTotal    = 0.0;

            if ($invoice) {
                $lineQuery   = $invoice->lines();
                $normalLines = (clone $lineQuery)->where('is_reassigned', 0)->get();
                $resLines    = (clone $lineQuery)->where('is_reassigned', 1)->get();

                if ($normalLines->count() > 0) {
                    foreach ($normalLines as $l) {
                        $baseNet   += (float) $l->qty * (float) $l->unit_cost;
                        $discLine  += (float) $l->discount;
                        $netAfter  += (float) $l->net_amount;
                        $vatAmount += (float) $l->vat_amount;
                    }
                    $vatRate = (float) $normalLines->first()->vat_rate;
                }

                if ($resLines->count() > 0) {
                    foreach ($resLines as $l) {
                        $resNet += (float) $l->net_amount;
                        $resVat += (float) $l->vat_amount;
                    }
                }

                $baseNetTotal   = $baseNet;
                $discLineTotal  = $discLine;
                $netAfterTotal  = $netAfter;
                $vatAmountTotal = $vatAmount;
                $resNetTotal    = $resNet;
                $resVatTotal    = $resVat;
            } else {
                if ($od) {
                    $qty       = max(1, (int) ($od->quantity ?? 1));
                    $unitNet   = round((float) ($od->course_price ?? 0), 2);
                    $baseNet   = round($qty * $unitNet, 2);
                    $discLine  = round((float) ($od->discount ?? 0), 2);
                    $netAfter  = round((float) ($od->total_price ?? 0), 2);
                    $vatAmount = round((float) ($od->vat ?? 0), 2);

                    if ($netAfter > 0 && $vatAmount > 0) {
                        $vatRate = round(($vatAmount / $netAfter) * 100, 2);
                    }
                }
            }

            $oldInvoice = CohortReassignment::with('productInvoice')
                ->where('from_cohort_id', $cohortId)
                ->where('user_id', $userId)
                ->latest('id')
                ->first();

            $invoiceId = null;
            if (!empty($p?->latestInvoice?->id)) {
                $invoiceId = (int) $p->latestInvoice->id;
            } elseif (!empty($oldInvoice?->productInvoice?->id)) {
                $invoiceId = (int) $oldInvoice->productInvoice->id;
            } elseif (!empty($invoice?->id)) {
                $invoiceId = (int) $invoice->id;
            }

            $currentOdCohortId = (int) ($od->cohort_id ?? 0);

            $latestTo = DB::table('cohort_reassignments')
                ->where('user_id', $userId)
                ->where('from_cohort_id', $cohortId)
                ->when($invoiceId, fn($qq) => $qq->where('invoice_id', $invoiceId))
                ->orderByDesc('id')
                ->value('to_cohort_id');

            $fallbackStatus = (!empty($latestTo) && (int) $latestTo !== $currentOdCohortId)
                ? 'Transferred'
                : ($od->course_status ?? '-');

            $status = $od && !empty($od->course_status)
                ? $od->course_status
                : $fallbackStatus;

            $invoiceNumber = $p?->latestInvoice?->invoice_number
                ?? $oldInvoice?->productInvoice?->invoice_no
                ?? $p?->invoice_number
                ?? $invoice?->invoice_no
                ?? null;

            $invoiceStatus = $p?->latestInvoice?->invoice_status
                ?? $oldInvoice?->productInvoice?->invoice_status
                ?? $p?->status
                ?? $invoice?->invoice_status
                ?? null;

            $invoicePdfUrl = $p?->invoice_pdf_url
                ? Storage::url($p->invoice_pdf_url)
                : ($invoice?->pdf_url ? Storage::url($invoice->pdf_url) : null);

            $qualification = DB::table('user_post_qualifications')
                ->where('user_id', $userId)
                ->where('cohort_id', $cohortId)
                ->orderByDesc('id')
                ->first();

            $qualificationPassed = $qualification && $qualification->qualification_status === 'Passed';

            $rows[] = [
                'id'                            => $userId,
                'date_added'                    => optional($u->created_at)->format('d-m-Y'),
                'delegate_name'                 => trim(($u->name ?? '') . ' ' . ($u->last_name ?? '')) ?: ($u->name ?? '-'),
                'customer'                      => ($u->client_name ?? '-'),
                'status'                        => $status,
                'cost'                          => round($baseNet, 2),
                'invoice_id'                    => $invoiceId,
                'discount'                      => round($discLine, 2),
                'net_cost'                      => round($netAfter, 2),
                'vat'                           => round($vatAmount, 2),
                'vat_rate'                      => $vatRate,
                'reassignment_fee_net'          => round($resNet, 2),
                'reassignment_fee_vat'          => round($resVat, 2),
                'cost_total'                    => round($baseNetTotal, 2),
                'discount_total'                => round($discLineTotal, 2),
                'net_cost_total'                => round($netAfterTotal, 2),
                'vat_total'                     => round($vatAmountTotal, 2),
                'reassignment_fee_net_total'    => round($resNetTotal, 2),
                'reassignment_fee_vat_total'    => round($resVatTotal, 2),
                'invoice_number'                => $invoiceNumber,
                'invoice_status'                => $invoiceStatus,
                'invoice_pdf_url'               => $invoicePdfUrl,
                'order_detail_id'               => (int) ($od->id ?? 0),
                'payment_status'                => $od->status ?? null,
                'qualification_passed'          => $qualificationPassed ? 1 : 0,
            ];
        }

        if ($learnerStatus !== null && $learnerStatus !== '') {
            $rows = array_values(array_filter($rows, function ($row) use ($learnerStatus) {
                return isset($row['status']) && $row['status'] == $learnerStatus;
            }));
        }

        return $rows;
    }

    protected function aggregateCohortTotals(int $cohortId, array $rows): array
    {
        if (empty($rows)) {
            return [
                'sub_total'  => 0.0,
                'discount'   => 0.0,
                'total_cost' => 0.0,
                'vat'        => 0.0,
                'misc_net'   => 0.0,
                'misc_vat'   => 0.0,
                'misc_total' => 0.0,
                'res_net'    => 0.0,
                'res_vat'    => 0.0,
                'res_total'  => 0.0,
            ];
        }

        $subTotal  = 0.0;
        $discountT = 0.0;
        $totalCost = 0.0;
        $vatT      = 0.0;
        $resNetT   = 0.0;
        $resVatT   = 0.0;

        foreach ($rows as $r) {
            $subTotal  += (float) ($r['cost_total'] ?? 0);
            $discountT += (float) ($r['discount_total'] ?? 0);
            $totalCost += (float) ($r['net_cost_total'] ?? 0);
            $vatT      += (float) ($r['vat_total'] ?? 0);
            $resNetT   += (float) ($r['reassignment_fee_net_total'] ?? 0);
            $resVatT   += (float) ($r['reassignment_fee_vat_total'] ?? 0);
        }

        $resTotalT = $resNetT + $resVatT;

        $cohortRec = Cohort::select(['id', 'exclude_misc'])
            ->where('id', $cohortId)
            ->first();

        $miscNet = 0.0;
        $miscVat = 0.0;

        if ($cohortRec && !$cohortRec->exclude_misc) {
            $miscRows = CohortMiscellounose::where('cohort_id', $cohortId)
                ->get(['net_cost', 'vat']);

            foreach ($miscRows as $m) {
                $miscNet += (float) ($m->net_cost ?? 0);
                $miscVat += (float) ($m->vat ?? 0);
            }
        }

        $miscTotal = $miscNet + $miscVat;

        return [
            'sub_total'  => round($subTotal, 2),
            'discount'   => round($discountT, 2),
            'total_cost' => round($totalCost, 2),
            'vat'        => round($vatT, 2),
            'misc_net'   => round($miscNet, 2),
            'misc_vat'   => round($miscVat, 2),
            'misc_total' => round($miscTotal, 2),
            'res_net'    => round($resNetT, 2),
            'res_vat'    => round($resVatT, 2),
            'res_total'  => round($resTotalT, 2),
        ];
    }

    protected function calculateCohortTotals(int $cohortId): array
    {
        $rows = $this->buildLearnerRows($cohortId, null, null);
        return $this->aggregateCohortTotals($cohortId, $rows);
    }

    public function learners($id, Request $request)
    {
        $cohortId      = (int) $id;
        $search        = trim((string) $request->get('search', ''));
        $learnerStatus = $request->filled('learner_status')
            ? (string) $request->get('learner_status')
            : null;

        $rows = $this->buildLearnerRows(
            $cohortId,
            $search !== '' ? $search : null,
            $learnerStatus
        );

        if (empty($rows)) {
            return response()->json([
                'items'  => [],
                'totals' => [
                    'sub_total'  => 0,
                    'discount'   => 0,
                    'total_cost' => 0,
                    'vat'        => 0,
                    'count'      => 0,
                    'misc_net'   => 0,
                    'misc_vat'   => 0,
                    'misc_total' => 0,
                    'res_net'    => 0,
                    'res_vat'    => 0,
                    'res_total'  => 0,
                ],
            ]);
        }

        $totals = $this->aggregateCohortTotals($cohortId, $rows);
        $totals['count'] = count($rows);

        return response()->json([
            'items'  => $rows,
            'totals' => $totals,
        ]);
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'cohort_id' => ['required', 'integer'],
            'learners' => ['nullable', 'integer'],
            'status' => ['nullable', 'string'],
            'invoice_status' => ['nullable', 'string'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'cost' => ['nullable', 'numeric', 'min:0'],
            'cost_price' => ['nullable', 'numeric', 'min:0'],
            'payment_status' => ['nullable', 'string'],
            'invoice_number' => ['nullable'],
        ]);

        DB::beginTransaction();
        try {
            if ($id == 0) {
                $currentLearnerCohort = ProductInvoice::where('invoice_no', $validated['invoice_number'])->first();
                $cohortUrl = "/crm/training-courses/{$currentLearnerCohort->cohort_id}";
                return response()->json([
                    'status' => 'error',
                    'message' => "This cohort has already been reassigned. Please check the new cohort: <a href='$cohortUrl' target='_blank'>Click Here</a>.",
                ], 400);
            }

            $costing = FrontOrderDetails::with('course')
                ->where('id', $id)
                ->where('cohort_id', $validated['cohort_id'])
                ->firstOrFail();

            if (!empty($validated['learners']) && $request->filled('status')) {
                $send = $costing->course_status !== $validated['status'];
                $costing->course_status = $validated['status'];
            }

            $qty = max(1, (int)($costing->quantity ?: 1));
            $unitNet = $request->filled('cost') ? (float)$validated['cost'] : (float)($costing->course_price ?? 0.0);
            $discGrossPU = max(0.0, (float)($validated['discount'] ?? 0.0));
            $vatRate = 20.0;
            $factor = 1 + ($vatRate / 100);

            $net0 = round($qty * $unitNet, 2);
            $vat0 = round($net0 * ($vatRate / 100), 2);
            $gross0 = round($net0 + $vat0, 2);

            $discLineGross = round(min($gross0, $qty * $discGrossPU), 2);

            $gross1 = round($gross0 - $discLineGross, 2);
            $lineNet = round($gross1 / $factor, 2);
            $lineVat = round($gross1 - $lineNet, 2);

            $depositPaid = (float)($costing->deposit_paid ?? 0.0);
            $remaining = round(max(0.0, $gross1 - $depositPaid), 2);

            if ($request->filled('cost')) {
                $costing->course_price = round($unitNet, 2);
            }
            if ($request->filled('cost_price')) {
                $costing->cost_price = (float)$validated['cost_price'];
            }
            $costing->discount = round($discGrossPU, 2);
            $costing->total_price = $lineNet;
            $costing->vat = $lineVat;
            $costing->remaining_balance = $remaining;

            if ($request->filled('invoice_status')) {
                $costing->status = $validated['invoice_status'];
            }
            $costing->save();

            $orderId = $costing->order_id;
            $sumNet = (float)FrontOrderDetails::where('order_id', $orderId)->sum('total_price');
            $sumVat = (float)FrontOrderDetails::where('order_id', $orderId)->sum('vat');
            $orderGross = round($sumNet + $sumVat, 2);

            $order = FrontOrder::findOrFail($orderId);
            $order->total_amount = round($sumNet, 2);
            $order->tax_amount = round($sumVat, 2);
            $paid = (float)FrontPayment::where('order_id', $orderId)
                ->whereIn('status', ['paid', 'success', 'succeeded'])
                ->sum('amount');
            $order->remaining_balance = round(max(0.0, $orderGross - $paid), 2);
            $order->save();

            $invoice = ProductInvoice::where('order_detail_id', $costing->id)->first();
            if ($invoice) {
                $invoice->lines()->where('is_reassigned', 0)->delete();
                $invoice->lines()->create([
                    'qty' => $qty,
                    'product_code' => $costing->course?->code ?? null,
                    'product_description' => $costing->course_name ?? optional($costing->course)->name ?? 'Course',
                    'unit_cost' => round($unitNet, 2),
                    'vat_rate' => $vatRate,
                    'discount' => $discLineGross,
                    'net_amount' => $lineNet,
                    'vat_amount' => $lineVat,
                    'gross_amount' => $gross1,
                ]);

                $sums = $invoice->lines()
                    ->selectRaw('COALESCE(SUM(net_amount),0) as net, COALESCE(SUM(vat_amount),0) as vat, COALESCE(SUM(gross_amount),0) as gross')
                    ->first();

                $totalNet = round((float)($sums->net ?? 0.0), 2);
                $totalVat = round((float)($sums->vat ?? 0.0), 2);
                $totalGross = round((float)($sums->gross ?? 0.0), 2);

                $invoice->total_net = $totalNet;
                $invoice->total_vat = $totalVat;
                $invoice->total_gross = $totalGross;

                $allocated = (float) ProductInvoicePayment::where('invoice_id', $invoice->id)
                    ->where(function ($q) {
                        $q->whereNull('is_refunded')->orWhere('is_refunded', false);
                    })
                    ->sum('amount');

                $invoice->invoice_status = (max(0.0, $totalGross - $allocated) > 0.01) ? 'Outstanding' : 'Paid';

                if ($request->filled('invoice_status')) {
                    $invoice->invoice_status = $validated['invoice_status'] ?: $invoice->invoice_status;
                }

                $invoice->save();
            }

            DB::commit();
            return response()->json(['status' => 'success']);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $front_order_details = FrontOrderDetails::where(['cohort_id' => $request->cohort_id])->pluck('order_id')->toArray();
            $front_order = FrontOrder::whereIn('id', $front_order_details)->where('user_id', $id)->first();
            $order_id = $front_order->id;
            CheckoutDetail::where('order_id', $order_id)->delete();
            FrontPayment::where('order_id', $order_id)->delete();
            FrontOrderDetails::where('order_id', $order_id)->delete();
            FrontOrder::where('id', $order_id)->delete();
            DB::table('cohort_user')->where(['cohort_id' => $request->cohort_id, 'user_id' => $id])->delete();
            DB::commit();
            return response()->json(['status' => 'deleted']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function generatePdf($cohort_id, $order_detail_id, $id)
    {
        return DB::transaction(function () use ($cohort_id, $order_detail_id, $id) {

            $delegate = User::findOrFail($id);

            $invoice = ProductInvoice::where('cohort_id', $cohort_id)
                ->where('user_id', $delegate->id)
                ->where('order_detail_id', $order_detail_id)
                ->first();

            if (!$invoice) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Invoice not found for this delegate and cohort.',
                ], 404);
            }

            $dir      = 'crm/training-courses/invoices';
            $fileName = "{$invoice->invoice_no}.pdf";
            $filePath = "{$dir}/{$fileName}";

            $result = InvoicePDFController::generateSingleInvoicePdf(
                $invoice,
                $delegate,
                'public',
                $filePath
            );

            $payment = getFrontOrder($id, $cohort_id);
            if ($payment) {
                if ($payment->invoice_pdf_url && Storage::disk('public')->exists($payment->invoice_pdf_url)) {
                    Storage::disk('public')->delete($payment->invoice_pdf_url);
                }

                $payment->invoice_pdf_url = $result['path'];
                $payment->invoice_number  = $invoice->invoice_no;
                $payment->status          = "Unpaid";
                $payment->save();
            }

            $fullPath = Storage::disk('public')->path($result['path']);
            return response()->file($fullPath);
        });
    }


    public function generateChecklist(Request $request, int $cohort_id, ?string $type = null, ?int $userId = null)
    {
        $type = (string)($type ?? $request->input('type', ''));
        if ($type === '') {
            abort(422, 'Invalid checklist type');
        }

        $allowed = ['efaw', 'security', 'register', 'joining-instructions', 'vb-certificate'];
        if (!in_array($type, $allowed, true)) {
            abort(422, 'Invalid checklist type');
        }

        $training = Cohort::with(['venue', 'course', 'trainer'])->findOrFail($cohort_id);

        $venue = $training->venue;
        $course = $training->course;
        $trainer = $training->trainer;

        $selectedIds = collect();

        $userIdsFromArray = $request->input('user_ids', []);
        if (is_array($userIdsFromArray) && !empty($userIdsFromArray)) {
            foreach ($userIdsFromArray as $val) {
                $selectedIds->push((int)$val);
            }
        }

        if ($request->filled('ids')) {
            $idsCsv = (string)$request->input('ids');
            foreach (explode(',', $idsCsv) as $val) {
                $selectedIds->push((int)$val);
            }
        }

        if ($request->filled('user_id')) {
            $selectedIds->push((int)$request->input('user_id'));
        }

        if (!empty($userId)) {
            $selectedIds->push((int)$userId);
        }

        $selectedIds = $selectedIds->filter(function ($v) {
            return $v > 0;
        })->unique()->values();

        $learnerIds = DB::table('cohort_user')
            ->where('cohort_id', $training->id)
            ->pluck('user_id');

        if ($selectedIds->isNotEmpty()) {
            $learnerIds = $learnerIds->intersect($selectedIds);
        }

        if ($type === 'vb-certificate' && ($userId || $request->filled('user_id'))) {
            $targetId = (int)($userId ?: $request->input('user_id'));

            if (!$learnerIds->contains($targetId)) {
                abort(404, 'Learner not found in this cohort.');
            }

            $learner = User::whereNull('deleted_at')
                ->select('id', 'name', 'middle_name', 'last_name')
                ->findOrFail($targetId);

            $issuedOn = Carbon::now();
            $validTill = $issuedOn->copy()->addYears(3)->subDay();
            $certificateNumber = $issuedOn->format('jS F Y') . '-D' . str_pad($learner->id, 7, '0', STR_PAD_LEFT);

            $pdf = Pdf::loadView('crm.pdfs.vb-certificate', [
                'certificate_number' => $certificateNumber,
                'learner_name' => trim(preg_replace('/\s+/', ' ', implode(' ', array_filter([$learner->name, $learner->middle_name, $learner->last_name])))),
                'course_title' => $course ? ($course->name ?? '') : '',
                'issued_on' => $issuedOn->format('d-m-Y'),
                'valid_until' => $validTill->format('d-m-Y'),
                'logo_url' => url('crm/assets/img/logo.png'),
                'signature_url' => null,
                'managing_director' => 'Managing Director',
                'company_name' => 'Training for Employment Ltd',
            ]);

            return $pdf->stream('certificate.pdf');
        }

        $learners = User::whereIn('id', $learnerIds)
            ->whereNull('deleted_at')
            ->select('id', 'name', 'middle_name', 'last_name', 'phone_number', 'telephone')
            ->get();

        $delegates = $learners->map(function ($u) use ($cohort_id) {
            $name = trim(preg_replace('/\s+/', ' ', implode(' ', array_filter([$u->name, $u->middle_name, $u->last_name]))));
            $contact = $u->phone_number ?: $u->telephone ?: '';

            if ($contact === '') {
                $upd = getFrontOrder($u->id, $cohort_id);
                if ($upd && !empty($upd->order_id)) {
                    $order = FrontOrder::find($upd->order_id);
                    if ($order) {
                        $payer = User::find($order->user_id);
                        if ($payer) {
                            $contact = $payer->phone_number ?: $payer->telephone ?: '';
                        }
                    }
                }
            }

            return [
                'id' => $u->id,
                'name' => $name,
                'contact' => $contact,
            ];
        })->sortBy('name')->values()->all();

        $path = '';
        if ($type === 'efaw') {
            $path = 'efaw-checklist';
        } else if ($type === 'security') {
            $path = 'security-checklist';
        } else if ($type === 'register') {
            $path = 'register-checklist';
        } else if ($type === 'joining-instructions') {
            $path = 'joining-instructions';
        } else {
            abort(422, 'Invalid checklist type');
        }

        $pdf = Pdf::loadView("crm.pdfs.$path", [
            'type' => $type,
            'delegates' => $delegates,
            'venue' => $venue,
            'course' => $course,
            'trainer' => $trainer,
            'training_course' => $training,
        ]);

        return $pdf->stream("$path.pdf");
    }


    function updateTrainers(Request $request)
    {
        $cohort = Cohort::find($request->cohort_id);
        if (!$cohort) {
            return response()->json(['status' => 'error', 'message' => 'Cohort not found'], 404);
        }
        $cohort->trainer_cost = $request->trainer_cost;
        $cohort->save();
        return response()->json(['success' => true]);
    }

    public function findUser(Request $request)
    {
        $query    = $request->get('q');
        $cohortId = $request->cohortId;

        if (!$query) {
            return response()->json([]);
        }

        $users = User::where(function ($q2) use ($query) {
            $q2->where('name', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->orWhere('middle_name', 'like', "%{$query}%")
                ->orWhere('last_name', 'like', "%{$query}%");
        })
            ->role('Learner')
            ->select('id', 'name', 'middle_name', 'last_name', 'email')
            ->whereNotIn('id', function ($sub) use ($cohortId) {
                $sub->select('user_id')
                    ->from('cohort_user as cu')
                    ->where('cu.cohort_id', $cohortId);
            })
            ->get();

        return response()->json($users);
    }


    public function addUserToCohort(Request $request)
    {
        $userId = $request->get('user_id');
        $cohortId = $request->get('cohort_id');
        $includeInvoice = 0;

        if (!$userId || !$cohortId) {
            return response()->json(['status' => 'error', 'message' => 'Invalid user or cohort ID.'], 400);
        }

        try {
            $result = $this->enrollUserToCohortWithOptions($userId, $cohortId, $includeInvoice);

            return response()->json([
                'status' => 'success',
                'message' => 'User successfully added to the cohort.',
                'data' => [
                    'order_id' => $result['order']->id,
                    'order_detail_id' => $result['detail']->id,
                ],
            ]);
        } catch (\Throwable $e) {
            Log::error('Enroll to Cohort failed: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function saveNote(Request $request)
    {
        $cohort = Cohort::find($request->cohort_id);
        if ($cohort) {
            $cohort->additional_details = $request->note;
            $cohort->save();
            return response()->json(['result' => true]);
        }
        return response()->json(['result' => false]);
    }

    public function bulkUpdateLearnerStatus(Request $request, $cohortId)
    {
        $learnerIds = explode(',', $request->input('learner_ids', ''));
        $status = $request->input('bulk_learner_status');
        if (empty($learnerIds) || !$status) {
            return redirect()->back()->with('error', 'Please select learners and a status.');
        }
        $updated = 0;
        foreach ($learnerIds as $id) {
            $user = User::find($id);
            if ($user) {
                $user->learner_status = $status;
                $user->save();
                $updated++;
            }
        }
        return redirect()->back()->with('success', "$updated learners updated to status '$status'.");
    }

    public function generateCertificate()
    {
        $data = [
            'name' => 'Taher Moursi',
            'issueDate' => '02-07-2025',
            'validDate' => '01-07-2028',
        ];
        return view('crm.certificates.certificate', $data);
        $pdf = Pdf::loadView('crm.certificates.certificate', $data)
            ->setPaper('A4', 'landscape');

        return $pdf->download('certificate.pdf');
    }

    public function generateInvoice(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $data = $request->validate([
                    'cohort_id'                => ['required', 'integer', 'exists:cohorts,id'],
                    'user_id'                  => ['required', 'integer', 'exists:users,id'],
                    'order_detail_id'          => ['required', 'integer', 'exists:front_order_details,id'],
                    'approval_password'        => ['required', 'string', 'min:4'],
                    'print_pdf'                => ['sometimes', 'accepted'],
                    'include_additional_modules' => ['sometimes', 'accepted'],
                    'consolidate_by_product'   => ['sometimes', 'accepted'],
                ]);

                $user = Auth::user();
                if (!$user || !Hash::check($data['approval_password'], $user->password)) {
                    return response()->json(['message' => 'Invalid approval password.'], 422);
                }

                $detail = FrontOrderDetails::with(['frontOrder', 'course', 'cohort'])
                    ->findOrFail($data['order_detail_id']);

                if ((int) $detail->cohort_id !== (int) $data['cohort_id']) {
                    return response()->json(['message' => 'Order detail does not belong to this cohort.'], 422);
                }

                if (!empty($detail->frontOrder->user_id) &&
                    (int) $detail->frontOrder->user_id !== (int) $data['user_id']) {
                    return response()->json(['message' => 'Order detail does not belong to this user.'], 422);
                }

                $delegate   = User::findOrFail($data['user_id']);
                $frontOrder = getFrontOrder($delegate->id, $data['cohort_id']);

                $invoice = $this->buildInvoiceAndLine($detail, $delegate, null, true);

                $dir      = 'crm/training-courses/invoices';
                $fileName = "{$invoice->invoice_no}.pdf";
                $filePath = "{$dir}/{$fileName}";

                $disk = Storage::disk('public');
                $disk->makeDirectory($dir);

                if ($disk->exists($filePath)) {
                    $disk->delete($filePath);
                }

                $isPrintable = $request->has('print_pdf')
                    && ($request->print_pdf === 'on' || $request->boolean('print_pdf'));

                $result = InvoicePDFController::generateSingleInvoicePdf(
                    $invoice,
                    $delegate,
                    'public',
                    $filePath
                );

                $invoice->update(['pdf_url' => $result['path']]);

                if ($frontOrder) {
                    $frontOrder->invoice_pdf_url = $result['path'];
                    $frontOrder->invoice_number  = $invoice->invoice_no;
                    $frontOrder->status          = 'Unpaid';
                    $frontOrder->save();
                }

                $payload = [
                    'invoice_id' => $invoice->id,
                    'invoice_no' => $invoice->invoice_no,
                    'redirect'   => route('crm.invoices.show', $invoice->id),
                    'open'       => $isPrintable,
                ];

                if ($isPrintable) {
                    $payload['pdf_url'] = $result['url'];
                }

                return response()->json($payload);
            });
        } catch (\Throwable $e) {
            Log::error('Invoice Generation Failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Something went wrong while generating invoice.',
            ], 500);
        }
    }



    public function invoicePreview(Request $request)
    {
        $data = $request->validate([
            'cohort_id' => ['required', 'integer', 'exists:cohorts,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'order_detail_id' => ['nullable', 'integer', 'exists:front_order_details,id'],
            'invoice_number' => ['nullable', 'string'],
        ]);

        if (empty($data['order_detail_id'])) {
            $currentLearnerCohort = ProductInvoice::where('invoice_no', $data['invoice_number'])->first();
            if (!$currentLearnerCohort) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No matching invoice found for this invoice number.',
                ], 400);
            }
            $cohortUrl = "/crm/training-courses/{$currentLearnerCohort->cohort_id}";
            return response()->json([
                'status' => 'error',
                'message' => "This cohort has already been reassigned. Please check the new cohort: <a href='$cohortUrl' target='_blank'>Click Here</a>.",
            ], 400);
        }


        $detail = DB::table('front_order_details as fod')
            ->leftJoin('front_orders as fo', 'fo.id', '=', 'fod.order_id')
            ->where('fod.id', $data['order_detail_id'])
            ->select([
                'fod.id',
                'fod.order_id',
                'fod.cohort_id',
                'fod.quantity',
                'fod.course_price',
                'fod.discount',
                'fod.total_price',
                'fod.vat',
                'fo.user_id as owner_user_id',
            ])
            ->first();

        if (!$detail) {
            return response()->json(['message' => 'Order detail not found.'], 404);
        }
        if ((int)$detail->cohort_id !== (int)$data['cohort_id']) {
            return response()->json(['message' => 'Order detail does not belong to this cohort.'], 422);
        }
        if (!empty($detail->owner_user_id) && (int)$detail->owner_user_id !== (int)$data['user_id']) {
            return response()->json(['message' => 'Order detail does not belong to this user.'], 422);
        }

        $user = User::findOrFail($data['user_id']);

        $hasStoredTotals = is_numeric($detail->total_price) && is_numeric($detail->vat) && ($detail->total_price > 0 || $detail->vat > 0);
        if ($hasStoredTotals) {
            $net = round((float)$detail->total_price, 2);
            $vat = round((float)$detail->vat, 2);
            $gross = round($net + $vat, 2);
        } else {
            $qty = max(1, (int)($detail->quantity ?? 1));
            $unitNet = (float)($detail->course_price ?? 0);
            $discGrossU = max(0.0, (float)($detail->discount ?? 0));

            $invoice = ProductInvoice::with(['lines:id,invoice_id,vat_rate'])
                ->where('order_detail_id', $detail->id)
                ->first();
            $vatRate = $invoice && $invoice->lines->count() ? (float)$invoice->lines->first()->vat_rate : 20.0;

            $rateFactor = 1 + ($vatRate / 100.0);
            $grossBefore = $qty * ($unitNet * $rateFactor);
            $discountTotal = min($qty * $discGrossU, $grossBefore);
            $grossAfter = $grossBefore - $discountTotal;

            $net = round($grossAfter / $rateFactor, 2);
            $vat = round($grossAfter - $net, 2);
            $gross = round($net + $vat, 2);
        }

        return response()->json([
            'customer_no' => $user->customer_no ?? ('D' . str_pad($user->id, 6, '0', STR_PAD_LEFT)),
            'customer_name' => trim(($user->name ?? '') . ' ' . ($user->last_name ?? '')) ?: ($user->name ?? '-'),
            'address1' => $user->address ?? null,
            'postcode' => $user->postcode ?? null,
            'funder' => null,
            'net_amount' => $net,
            'vat_amount' => $vat,
            'gross_amount' => $gross,
        ]);
    }

    public function openOrCreateInvoice($cohortId, $userId, $detailId, Request $request)
    {
        if ($detailId == 0) {
            return redirect()
                ->route('crm.invoices.show', $request->invoice_id);
        }

        try {
            return DB::transaction(function () use ($cohortId, $userId, $detailId) {

                $detail = FrontOrderDetails::with(['frontOrder', 'course', 'cohort'])
                    ->where('cohort_id', $cohortId)
                    ->findOrFail($detailId);

                $invoice = ProductInvoice::where('order_detail_id', $detail->id)->first();

                if (!$invoice) {
                    $delegate = User::findOrFail($userId);
                    $invoice = $this->buildInvoiceAndLine($detail, $delegate);
                }

                return redirect()->route('crm.invoices.show', $invoice->id);
            });
        } catch (\Exception $e) {
            Log::error('Open/Create Invoice Failed: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while opening or creating the invoice.');
        }
    }

    public function searchCohorts(Request $request)
    {
        $q = trim((string)$request->get('q', ''));
        $starts = trim((string)$request->get('starts', ''));
        $limit = min(50, max(1, (int)$request->get('limit', 20)));
        $sort = $request->get('sort', 'recent');
        $exclude = (array)$request->get('exclude', []);
        $year = (int)$request->get('year', 0);
        $month = (int)$request->get('month', 0);


        $query = DB::table('cohorts as c')
            ->leftJoin('courses as crs', 'crs.id', '=', 'c.course_id')
            ->leftJoin('venues as v', 'v.id', '=', 'c.venue_id')
            ->select([
                'c.id',
                DB::raw('DATE_FORMAT(c.start_date_time, "%d-%m-%Y %H:%i:%s") as start_dt'),
                DB::raw('DATE_FORMAT(c.start_date_time, "%d-%m-%Y") as course_date'),
                DB::raw('crs.name as course_name'),
                DB::raw('v.venue_name as venue_name'),
            ])->where('c.deleted_at', null);;

        if (!empty($exclude)) {
            $query->whereNotIn('c.id', $exclude);
        }

        if ($year > 0) {
            $query->whereYear('c.start_date_time', $year);
        }
        if ($month > 0) {
            $query->whereMonth('c.start_date_time', $month);
        }

        if ($starts !== '' && preg_match('/^[A-Z]$/i', $starts)) {
            $query->where('crs.name', 'like', strtoupper($starts) . '%');
        } else if ($q !== '' && $q !== '*' && str_ends_with($q, '%') && preg_match('/^[A-Z]%$/i', $q)) {
            $query->where('crs.name', 'like', strtoupper(substr($q, 0, 1)) . '%');
        } else if ($q !== '' && $q !== '*' && preg_match('/^[A-Z]$/i', $q)) {
            $query->where('crs.name', 'like', strtoupper($q) . '%');
        } else if ($q !== '' && $q !== '*') {
            $query->where(function ($w) use ($q) {
                $w->where('crs.name', 'like', "%{$q}%")
                    ->orWhere('v.venue_name', 'like', "%{$q}%")
                    ->orWhere(DB::raw('DATE_FORMAT(c.start_date_time, "%d-%m-%Y")'), 'like', "%{$q}%");

                if (ctype_digit($q)) {
                    $w->orWhere('c.id', (int)$q);
                }
            });
        }

        if ($sort === 'az') {
            $query->orderBy('crs.name', 'asc')->orderBy('c.start_date_time', 'desc');
        } else {
            $query->orderBy('c.start_date_time', 'desc');
        }

        $rows = $query->limit($limit)->get();

        $out = $rows->map(function ($r) {
            $label = trim(
                ($r->course_date ?? '') . ' – ' .
                ($r->course_name ?? '') .
                (empty($r->venue_name) ? '' : ' (' . $r->venue_name . ')')
            );
            return [
                'id' => $r->id,
                'label' => $label,
                'code' => sprintf('TC%06d', (int)$r->id),
                'course_name' => $r->course_name ?? '',
                'start' => $r->start_dt ?? '',
                'venue_name' => $r->venue_name ?? '',
            ];
        });

        return response()->json($out->values());
    }


    public function reassignCohort(Request $request)
    {
        $data = $request->validate([
            'from_cohort_id' => ['required', 'integer', 'exists:cohorts,id'],
            'to_cohort_id' => ['required', 'integer', 'different:from_cohort_id', 'exists:cohorts,id'],
            'learner_ids' => ['required', 'array', 'min:1'],
            'learner_ids.*' => ['integer', 'exists:users,id'],
            'include_invoice' => ['nullable', 'in:0,1'],
            'include_references' => ['nullable', 'in:0,1'],
            'reschedule_fee' => ['required', 'numeric', 'min:0'],
            'reschedule_vat_rate' => ['required', 'numeric', 'min:0'],
            'reschedule_vat_amount' => ['nullable', 'numeric', 'min:0'],
            'reschedule_gross' => ['nullable', 'numeric', 'min:0'],
        ]);

        $includeInvoice = (bool)$request->boolean('include_invoice');

        if ($includeInvoice) {
            $fromCohortId = (int)$data['from_cohort_id'];
            $userId = (int)$data['learner_ids'][0];

            $detail = FrontOrderDetails::where([
                'cohort_id' => $fromCohortId,
                'user_id' => $userId,
            ])->latest('id')->first();


            $hasInvoice = $detail
                ? ProductInvoice::where('order_detail_id', $detail->id)->exists()
                : false;


            if (!$hasInvoice) {
                return response()->json([
                    'message' => 'You must generate an invoice before including it in reassignment, or uncheck "Include Invoice".'
                ], 422);
            }
        }

        if (!$includeInvoice) {
            $result = $this->enrollUserToCohortWithOptions($data['learner_ids'][0], $data['to_cohort_id'], true);

            return response()->json([
                'status' => 'success',
                'is_new_invoice' => true,
                'message' => 'User successfully added to the cohort.',
                'data' => [
                    'order_id' => $result['order']->id,
                    'order_detail_id' => $result['detail']->id,
                ],
            ]);
        }

        return DB::transaction(function () use ($data, $includeInvoice) {
            $from = (int)$data['from_cohort_id'];
            $to = (int)$data['to_cohort_id'];
            $uids = array_map('intval', $data['learner_ids']);
            $addFee = $includeInvoice;

            $feeNet = (float)($data['reschedule_fee'] ?? 0.0);
            $rate = (float)($data['reschedule_vat_rate'] ?? 0.0);
            $feeVat = array_key_exists('reschedule_vat_amount', $data) ? (float)$data['reschedule_vat_amount'] : null;
            $feeG = array_key_exists('reschedule_gross', $data) ? (float)$data['reschedule_gross'] : null;

            $results = [];

            foreach ($uids as $userId) {
                $draftId = $this->insertCohortReassignmentDraft($userId, $from, $to, $feeNet, $rate, $feeVat, $feeG, $addFee);

                $this->moveLearnerPivot($from, $to, $userId);

                $invResult = null;
                if ($addFee) {
                    $invResult = $this->attachRescheduleFeeToLatestInvoice($from, $to, $userId, $feeNet, $rate, $feeVat, $feeG);
                }

                if ($draftId && $invResult) {
                    $this->updateCohortReassignmentWithInvoice($draftId, $invResult);
                }

                $results[] = [
                    'user_id' => $userId,
                    'pivot_moved' => true,
                    'invoice_touched' => (bool)$invResult,
                    'invoice' => $invResult,
                    'reassignment_id' => $draftId,
                ];
            }

            $computedVat = ($feeVat !== null) ? $feeVat : round($feeNet * ($rate / 100), 2);
            $computedGross = ($feeG !== null) ? $feeG : round($feeNet + $computedVat, 2);

            return response()->json([
                'status' => 'ok',
                'moved_count' => count($results),
                'results' => $results,
                'fee_applied' => $addFee ? [
                    'net' => number_format($feeNet, 2, '.', ''),
                    'rate' => $rate,
                    'vat' => number_format($computedVat, 2, '.', ''),
                    'gross' => number_format($computedGross, 2, '.', ''),
                ] : null,
            ]);
        });
    }


    public function getCurrentInvoiceCohort($id)
    {
        $invoice = ProductInvoice::findOrFail($id);
        return response()->json([
            'learner_id' => (array)$invoice->user_id,
            'from_cohort_id' => $invoice->cohort_id,
        ]);
    }

    public function profitData($cohortId)
    {
        $cohort = Cohort::query()
            ->with([
                'course:id,name',
                'venue:id,venue_name',
                'trainer:id,name',
            ])
            ->select(
                'id', 'course_id', 'venue_id', 'trainer_id', 'trainer_cost', 'exclude_misc',
                'start_date_time', 'end_date_time', 'booking_reference', 'status', 'max_learner'
            )
            ->findOrFail($cohortId);

        $invoiceAgg = DB::table('product_invoices as pi')
            ->leftJoin('product_invoice_payments as pip', function ($j) {
                $j->on('pip.invoice_id', '=', 'pi.id')
                    ->where(function ($q) {
                        $q->whereNull('pip.is_refunded')->orWhere('pip.is_refunded', 0);
                    });
            })
            ->where('pi.cohort_id', (int) $cohortId)
            ->whereNull('pi.deleted_at')
            ->groupBy('pi.id', 'pi.user_id', 'pi.total_net', 'pi.total_vat', 'pi.total_gross')
            ->selectRaw('
            pi.id as invoice_id,
            pi.user_id,
            ROUND(pi.total_net,2)   as total_net,
            ROUND(pi.total_vat,2)   as total_vat,
            ROUND(pi.total_gross,2) as total_gross,
            ROUND(COALESCE(SUM(pip.amount),0),2) as paid_amount
        ')
            ->get();

        $byUserInvoice = $invoiceAgg->groupBy('user_id');

        $rows = $this->buildLearnerRows((int) $cohortId, null, null);

        if (empty($rows)) {
            $trainer_cost = round((float) $cohort->trainer_cost, 2);

            $start = $cohort->start_date_time
                ? Carbon::parse($cohort->start_date_time)->format('Y-m-d H:i:s')
                : null;

            $end = $cohort->end_date_time
                ? Carbon::parse($cohort->end_date_time)->format('Y-m-d H:i:s')
                : null;

            return response()->json([
                'cohort' => [
                    'id'               => $cohort->id,
                    'course_name'      => $cohort->course?->name,
                    'venue_name'       => $cohort->venue?->venue_name,
                    'trainer_name'     => $cohort->trainer?->name,
                    'trainer_cost'     => $trainer_cost,
                    'start_date_time'  => $start,
                    'end_date_time'    => $end,
                    'booking_reference'=> $cohort->booking_reference,
                    'status'           => $cohort->status,
                    'max_learner'      => $cohort->max_learner,
                ],
                'totals' => [
                    'sum_net'           => 0,
                    'sum_vat'           => 0,
                    'sum_gross'         => 0,
                    'sum_paid'          => 0,
                    'sum_out'           => 0,
                    'misc_net'          => 0,
                    'misc_vat'          => 0,
                    'misc_gross'        => 0,
                    'resched_fee_net'   => 0,
                    'resched_fee_vat'   => 0,
                    'profit_amount'     => 0,
                    'profit_margin_pct' => 0,
                ],
                'learners' => [],
            ]);
        }

        $cohortTotals = $this->aggregateCohortTotals((int) $cohortId, $rows);

        $sum_net     = (float) ($cohortTotals['total_cost'] ?? 0);
        $sum_vat     = (float) ($cohortTotals['vat'] ?? 0);
        $sum_gross   = round($sum_net + $sum_vat, 2);
        $sum_fee_net = (float) ($cohortTotals['res_net'] ?? 0);
        $sum_fee_vat = (float) ($cohortTotals['res_vat'] ?? 0);
        $miscNet     = (float) ($cohortTotals['misc_net'] ?? 0);
        $miscVat     = (float) ($cohortTotals['misc_vat'] ?? 0);
        $miscGross   = (float) ($cohortTotals['misc_total'] ?? ($miscNet + $miscVat));

        $sum_net     = round($sum_net, 2);
        $sum_vat     = round($sum_vat, 2);
        $sum_fee_net = round($sum_fee_net, 2);
        $sum_fee_vat = round($sum_fee_vat, 2);
        $miscNet     = round($miscNet, 2);
        $miscVat     = round($miscVat, 2);
        $miscGross   = round($miscGross, 2);

        $learners = [];
        $sum_paid = 0.0;
        $sum_out  = 0.0;

        foreach ($rows as $row) {
            $userId = (int) ($row['id'] ?? 0);

            $lineNet = (float) ($row['net_cost_total'] ?? $row['net_cost'] ?? 0);
            $lineVat = (float) ($row['vat_total'] ?? $row['vat'] ?? 0);
            $feeNet  = (float) ($row['reassignment_fee_net_total'] ?? $row['reassignment_fee_net'] ?? 0);
            $feeVat  = (float) ($row['reassignment_fee_vat_total'] ?? $row['reassignment_fee_vat'] ?? 0);

            $lineGross = $lineNet + $lineVat;

            $invs = $byUserInvoice->get($userId, collect());
            $paid = round((float) $invs->sum('paid_amount'), 2);

            $outstanding = max(0.0, round($lineGross - $paid, 2));

            if (abs($outstanding) < 0.01 && $lineGross > 0) {
                $status = 'Paid';
            } elseif ($paid > 0.0 && $outstanding > 0.0) {
                $status = 'Outstanding';
            } elseif ($lineGross > 0) {
                $status = 'Unpaid';
            } else {
                $status = 'Unpaid';
            }

            $invoiceStatus = $row['invoice_status'] ?? null;
            if (!empty($invoiceStatus)) {
                $status = $invoiceStatus;
            }

            $sum_paid += $paid;
            $sum_out  += $outstanding;

            $learners[] = [
                'user_id'        => $userId,
                'learner_name'   => $row['delegate_name'] ?? '-',
                'email'          => $row['customer'] ?? '-',
                'total_net'      => round($lineNet, 2),
                'total_vat'      => round($lineVat, 2),
                'total_gross'    => round($lineGross, 2),
                'fee_net'        => round($feeNet, 2),
                'fee_vat'        => round($feeVat, 2),
                'paid'           => $paid,
                'outstanding'    => $outstanding,
                'status'         => $status,
                'invoice_status' => $invoiceStatus,
            ];
        }

        $sum_paid = round($sum_paid, 2);
        $sum_out  = round($sum_out, 2);

        $trainer_cost = round((float) $cohort->trainer_cost, 2);

        $profit_amount = round($sum_paid - $trainer_cost - $miscGross, 2);

        $profit_margin = $sum_paid > 0
            ? max(0, round(($profit_amount / $sum_paid) * 100, 2))
            : 0.0;

        $start = $cohort->start_date_time
            ? Carbon::parse($cohort->start_date_time)->format('Y-m-d H:i:s')
            : null;

        $end = $cohort->end_date_time
            ? Carbon::parse($cohort->end_date_time)->format('Y-m-d H:i:s')
            : null;

        return response()->json([
            'cohort' => [
                'id'               => $cohort->id,
                'course_name'      => $cohort->course?->name,
                'venue_name'       => $cohort->venue?->venue_name,
                'trainer_name'     => $cohort->trainer?->name,
                'trainer_cost'     => $trainer_cost,
                'start_date_time'  => $start,
                'end_date_time'    => $end,
                'booking_reference'=> $cohort->booking_reference,
                'status'           => $cohort->status,
                'max_learner'      => $cohort->max_learner,
            ],
            'totals' => [
                'sum_net'           => $sum_net,
                'sum_vat'           => $sum_vat,
                'sum_gross'         => $sum_gross,
                'sum_paid'          => $sum_paid,
                'sum_out'           => $sum_out,
                'misc_net'          => $miscNet,
                'misc_vat'          => $miscVat,
                'misc_gross'        => $miscGross,
                'resched_fee_net'   => $sum_fee_net,
                'resched_fee_vat'   => $sum_fee_vat,
                'profit_amount'     => $profit_amount,
                'profit_margin_pct' => $profit_margin,
            ],
            'learners' => $learners,
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $envPassword = env('ADMIN_VERIFY_PASSWORD');

        if (!$envPassword) {
            return response()->json([
                'ok' => false,
                'message' => 'Server password not configured.',
            ], 500);
        }

        if ($envPassword === $request->input('password')) {
            return response()->json([
                'ok' => true,
                'message' => 'OK',
            ]);
        }

        return response()->json([
            'ok' => false,
            'message' => 'Invalid password',
        ], 403);
    }


    public function copy(Request $request, $cohortId)
    {
        $cohort = Cohort::findOrFail($cohortId);

        if (!$request->filled('start_date_time') || !$request->filled('end_date_time')) {
            return response()->json([
                'success' => false,
                'message' => 'Start and End date are required.',
            ], 422);
        }

        $startInput = trim($request->input('start_date_time'));
        $endInput   = trim($request->input('end_date_time'));

        $startFormat = strlen($startInput) > 10 ? 'd-m-Y H:i' : 'd-m-Y';
        $endFormat   = strlen($endInput) > 10 ? 'd-m-Y H:i' : 'd-m-Y';

        $clone = $cohort->replicate();
        $clone->status = 'Confirmed';

        if (!$request->boolean('exclude_trainers')) {
            $clone->trainer_id = $request->input('trainer_id');
        }

//        elseif($request->boolean('exclude_trainers')) {
//            $clone->trainer_id = $cohort->trainer_id;
//        }

        $clone->start_date_time = Carbon::createFromFormat($startFormat, $startInput);
        $clone->end_date_time   = Carbon::createFromFormat($endFormat, $endInput);

        $clone->created_at = now();
        $clone->updated_at = now();
        $clone->save();

        if (!$request->boolean('exclude_delegates')) {
            $oldDelegates = DB::table('cohort_user')
                ->where('cohort_id', $cohortId)
                ->pluck('user_id');

            foreach ($oldDelegates as $uid) {
                try {
                    $this->enrollUserToCohortWithOptions(
                        $uid,
                        $clone->id,
                        0
                    );
                } catch (\Throwable $e) {
                    Log::error("Failed to add delegate $uid to cloned cohort: " . $e->getMessage());
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Course copied successfully',
            'id' => $clone->id,
            'cohort_id' => $clone->id,
        ]);
    }


    public function updateStatus(Request $request)
    {
        $data = $request->validate([
            'cohort_id' => 'required|integer|exists:cohorts,id',
            'status' => 'required|string|in:Cancelled,Complete,Confirmed',
        ]);

        $cohort = Cohort::findOrFail($data['cohort_id']);
        $cohort->status = $data['status'];
        $cohort->save();

        return response()->json(['ok' => true]);
    }

    public function bulkUpdateLearnerCourseStatus(Request $request, $cohortId)
    {
        $validated = $request->validate([
            'status'        => ['required', 'string'],
            'learner_ids'   => ['required', 'array', 'min:1'],
            'learner_ids.*' => ['integer'],
        ]);

        $status     = $validated['status'];
        $learnerIds = $validated['learner_ids'];

        $items = FrontOrderDetails::with('learner')
            ->where('cohort_id', $cohortId)
            ->whereIn('user_id', $learnerIds)
            ->get();

        if ($items->isEmpty()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'No matching learners found for this cohort.',
            ], 404);
        }

        DB::beginTransaction();

        try {
            $updated = 0;

            foreach ($items as $orderDetail) {
                if ($orderDetail->course_status === $status) {
                    continue;
                }

                $orderDetail->course_status = $status;
                $orderDetail->save();

                $updated++;
            }

            DB::commit();

            return response()->json([
                'status'  => 'success',
                'message' => "Status updated for {$updated} learner(s).",
                'updated' => $updated,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }


}

