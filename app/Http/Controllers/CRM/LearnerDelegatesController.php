<?php

namespace App\Http\Controllers\CRM;

use App\Models\Cohort;
use App\Models\CohortReassignment;
use App\Models\EmailSend;
use App\Models\EmailSendEvent;
use App\Models\EmailTemplateVersion;
use App\Models\FrontOrderDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LearnerDelegatesController extends BaseUserDirectoryController
{
    protected const ROLE            = 'Learner';
    protected const INDEX_VIEW      = 'crm.learner_delegates.index';
    protected const SHOW_ROUTE_NAME = 'crm.learner.delegates.show';
    protected const CODE_PREFIX     = 'D';
    protected const ENTITY_LABEL    = 'Delegate';

    public function index(Request $request)
    {
        $total = $this->totalCount();

        return view(static::INDEX_VIEW, compact('total'));
    }

    public function create($customerId)
    {
        return view('crm.learner_delegates.create', [
            'customerId' => $customerId,
        ]);
    }

    public function checkUnique(Request $request)
    {
        $field = $request->input('field');
        $value = trim((string) $request->input('value'));
        $id = $request->input('id');

        $allowed = [
            'email' => 'Email',
            'work_email' => 'Work email',
            'mobile' => 'Mobile',
            'ni_number' => 'NI number',
            'payroll_reference' => 'Payroll reference',
            'third_party_reference' => 'Third party reference',
        ];

        if (!array_key_exists($field, $allowed) || $value === '') {
            return response()->json(['valid' => true]);
        }

        $query = User::query()->where($field, $value);

        if (!empty($id)) {
            $query->where('id', '!=', $id);
        }

        if (static::ROLE) {
            $query->role(static::ROLE);
        }

        $exists = $query->exists();

        return response()->json([
            'valid' => !$exists,
            'message' => $exists ? $allowed[$field] . ' is already in use.' : null,
        ]);
    }


    protected function resolveLearnerCourseStatus(int $userId, int $cohortId): string
    {
        // Same entry point as your learners() method
        $p = getFrontOrder($userId, $cohortId);

        $od = $p
            ? FrontOrderDetails::where('order_id', $p->order_id)
                ->where('cohort_id', $cohortId)
                ->first()
            : null;

        $currentOdCohortId = (int) ($od->cohort_id ?? $cohortId);

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
        }

        $latestTo = DB::table('cohort_reassignments')
            ->where('user_id', $userId)
            ->when($invoiceId, fn($qq) => $qq->where('invoice_id', $invoiceId))
            ->orderByDesc('id')
            ->value('to_cohort_id');

        $fallbackStatus = (!empty($latestTo) && (int) $latestTo !== $currentOdCohortId)
            ? 'Transferred'
            : ($od->course_status ?? '-');

        $status = $od && !empty($od->course_status)
            ? $od->course_status
            : $fallbackStatus;

        return $status ?? '-';
    }

    protected function resolveDefaultCustomerName(?User $learner, ?Cohort $cohort): string
    {
        if ($learner && $learner->client_id) {
            $client = User::find($learner->client_id);
            if ($client) {
                return $client->name;
            }
        }
        return '-';
    }

    public function coursesDt($id, Request $request)
    {
        $userId = (int) $id;

        $cohortIds = DB::table('cohort_user')
            ->where('user_id', $userId)
            ->whereDate('created_at', '>=', '2025-11-24')
            ->pluck('cohort_id');

        if ($cohortIds->isEmpty()) {
            return DataTables::of(collect())->make(true);
        }

        $learner = User::find($userId);

        $cohorts = Cohort::with('course')
            ->whereIn('id', $cohortIds)
            ->orderByDesc('start_date_time')
            ->get();

        $rows = [];

        foreach ($cohorts as $cohort) {
            $status = $this->resolveLearnerCourseStatus($userId, $cohort->id);

            $rows[] = [
                'course_code'        => sprintf('TC%06d', (int) $cohort->id),
                'course_description' => $cohort->course->name ?? '',
                'course_date'        => $cohort->start_date_time
                    ? Carbon::parse($cohort->start_date_time)->format('d-m-Y')
                    : '',
                'course_status'      => $status,
                'default_customer'   => $this->resolveDefaultCustomerName($learner, $cohort),
            ];
        }

        return DataTables::of(collect($rows))->make(true);
    }

    public function correspondenceDt($id, Request $request)
    {
        $userId = (int) $id;

        $query = EmailSendEvent::query()
            ->where('email_send_events.user_id', $userId)
            ->join('email_sends as s', 's.id', '=', 'email_send_events.email_send_id')
            ->leftJoin('email_template_versions as v', 'v.id', '=', 's.template_version_id')
            ->leftJoin('email_templates as t', 't.id', '=', 'v.template_id')
            ->leftJoin('users as u', 'u.id', '=', 't.created_by_id')
            ->leftJoin('courses as c', 'c.id', '=', 's.event_course_id')
            ->select([
                's.id',
                's.created_at',
                's.sent_at',
                's.template_code',
                's.subject',
                's.meta',
                't.code as template_name',
                'u.name as template_creator_name',
                'c.name as course_name',
            ])
            ->distinct();

        return DataTables::of($query)
            ->addColumn('date', function ($row) {
                $dt = $row->sent_at ?? $row->created_at;
                return $dt ? Carbon::parse($dt)->format('d-m-Y H:i:s') : '';
            })
            ->addColumn('letter_code', function ($row) {
                return $row->template_code ?: '-';
            })
            ->addColumn('letter_name', function ($row) {
                return $row->template_name ?: ($row->template_code ?: '-');
            })

            ->addColumn('course', function ($row) {
                return $row->course_name ?: '-';
            })
            ->addColumn('description', function ($row) {
                return $row->subject ?: '-';
            })
            ->addColumn('type', function () {
                return 'Email';
            })
            ->addColumn('user_name', function ($row) {
                return $row->template_creator_name ?: '-';
            })
            ->addColumn('select', function () {
                return '<input type="checkbox" class="form-check-input rowpick">';
            })
            ->addColumn('action', function ($row) use ($userId) {
                $url = route('crm.learner.delegates.correspondence.show', [$userId, $row->id]);
                return '<a href="' . e($url) . '" target="_blank" class="btn btn-sm btn-outline-primary">View</a>';
            })
            ->rawColumns(['select', 'action'])
            ->orderColumn('date', 's.created_at $1')
            ->make(true);
    }
    public function showCorrespondence($id, $sendId)
    {
        $delegateId = (int) $id;
        $sendId     = (int) $sendId;

        $delegate = User::findOrFail($delegateId);
        $send     = EmailSend::findOrFail($sendId);

        $owned = EmailSendEvent::where('email_send_id', $sendId)
            ->where('user_id', $delegateId)
            ->exists();

        if (!$owned) {
            abort(404);
        }

        $meta = $send->meta ?? [];
        if (!is_array($meta)) {
            $meta = (array) $meta;
        }

        $attachments = $meta['attachments'] ?? [];
        $to  = [$send->recipient_email];
        $cc  = $meta['cc']  ?? [];
        $bcc = $meta['bcc'] ?? [];

        $fromName  = $meta['from_name']        ?? 'Training 4 Employment';
        $fromEmail = $meta['from_email']       ?? 'bookings@training4employment.co.uk';
        $creatorName  = $meta['created_by_name']  ?? null;
        $creatorEmail = $meta['created_by_email'] ?? null;

        $course = $send->course;

        return view('crm.learner_delegates.correspondence_view', [
            'delegate'      => $delegate,
            'send'          => $send,
            'meta'          => $meta,
            'to'            => $to,
            'cc'            => $cc,
            'bcc'           => $bcc,
            'attachments'   => $attachments,
            'fromName'      => $fromName,
            'fromEmail'     => $fromEmail,
            'creatorName'   => $creatorName,
            'creatorEmail'  => $creatorEmail,
            'course'        => $course,
        ]);
    }

}
