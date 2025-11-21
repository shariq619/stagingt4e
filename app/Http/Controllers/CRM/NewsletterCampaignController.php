<?php

namespace App\Http\Controllers\CRM;

use App\Events\NewsletterCampaignSendRequested;
use App\Http\Controllers\Controller;
use App\Jobs\SendNewsletterCampaignJob;
use App\Models\Newsletter;
use App\Models\NewsletterCampaign;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewsletterCampaignController extends Controller
{
    public function index()
    {
        return view('crm.newsletters.campaigns');
    }

    public function list(Request $r)
    {
        $q = NewsletterCampaign::query()
            ->with('newsletter:id,title')
            ->withCount([
                'recipients as total_recipients',
                'recipients as sent_recipients' => function ($q) {
                    $q->where('status', 'sent');
                },
                'recipients as pending_recipients' => function ($q) {
                    $q->whereIn('status', ['pending', 'retry', 'queued']);
                },
                'recipients as failed_recipients' => function ($q) {
                    $q->where('status', 'failed');
                },
            ])
            ->orderByDesc('updated_at');

        if ($r->filled('newsletter_id')) {
            $q->where('newsletter_id', (int) $r->input('newsletter_id'));
        }

        return $q->get()->map(function ($c) {
            $total     = (int) $c->total_recipients;
            $sent      = (int) $c->sent_recipients;
            $pending   = (int) $c->pending_recipients;
            $failed    = (int) $c->failed_recipients;
            $remaining = max(0, $total - $sent);

            return [
                'id'             => $c->id,
                'newsletter_id'  => $c->newsletter_id,
                'newsletter'     => $c->newsletter?->title,
                'data_source'    => $c->data_source,
                'group_name'     => $c->group_name,
                'sender'         => trim(($c->sender_name ? $c->sender_name . ' ' : '') . '<' . $c->sender_email . '>'),
                'subject'        => $c->subject_snapshot,
                'last_sent'      => $c->sent_at?->format('d-m-Y H:i'),
                'count'          => $total,
                'total'          => $total,
                'sent'           => $sent,
                'pending'        => $pending,
                'failed'         => $failed,
                'remaining'      => $remaining,
            ];
        });
    }

    public function recipients(NewsletterCampaign $campaign, Request $r)
    {
        $status  = (string) $r->get('status', '');
        $page    = max(1, (int) $r->get('page', 1));
        $perPage = (int) $r->get('per_page', 50);

        $q = $campaign->recipients()
            ->select('id', 'name', 'email', 'status', 'created_at', 'updated_at')
            ->orderBy('email');

        if ($status === 'sent') {
            $q->where('status', 'sent');
        } elseif ($status === 'pending') {
            $q->whereIn('status', ['pending', 'retry', 'queued']);
        } elseif ($status === 'failed') {
            $q->where('status', 'failed');
        } elseif ($status === 'remaining') {
            $q->whereIn('status', ['pending', 'retry', 'queued']);
        }

        $total = (clone $q)->count();

        $rows = $q->forPage($page, $perPage)->get()->map(function ($r) {
            return [
                'id'         => $r->id,
                'name'       => $r->name ?: '-',
                'email'      => $r->email,
                'status'     => $r->status,
                'created_at' => $r->created_at?->toDateTimeString(),
                'updated_at' => $r->updated_at?->toDateTimeString(),
            ];
        });

        return [
            'data'      => $rows,
            'count'     => $rows->count(),
            'total'     => $total,
            'page'      => $page,
            'per_page'  => $perPage,
            'last_page' => $perPage > 0 ? (int) ceil($total / $perPage) : 1,
        ];
    }

    public function build(Request $r)
    {
        $newsletterId = (int) $r->input('newsletter_id');
        $newsletter   = Newsletter::findOrFail($newsletterId);

        $group = (string) $r->input('group_name', '');
        $group = $group !== '' ? $group : 'Recipients';

        $dataSource = (string) $r->input('data_source', '');

        $manualEmails = collect($r->input('recipient_emails', []))
            ->map(fn ($e) => strtolower(trim((string) $e)))
            ->filter(fn ($e) => $e !== '' && filter_var($e, FILTER_VALIDATE_EMAIL))
            ->unique()
            ->values();

        if ($manualEmails->isNotEmpty()) {
            $emails = $manualEmails;
        } else {
            if ($dataSource === '') {
                return response()->json([
                    'ok'      => false,
                    'message' => 'No data source selected'
                ], 422);
            }
            $emails = collect($this->resolveRecipientsFromDataSource($dataSource, $newsletter))
                ->filter()
                ->unique()
                ->values();
        }

        $campaign = NewsletterCampaign::create([
            'newsletter_id'    => $newsletter->id,
            'data_source'      => $dataSource,
            'group_name'       => $group,
            'sender_name'      => (string) $newsletter->from_name,
            'sender_email'     => (string) $newsletter->from_email,
            'subject_snapshot' => (string) $newsletter->subject,
            'html_snapshot'    => (string) $newsletter->html_body,
            'text_snapshot'    => (string) $newsletter->text_body,
            'recipients_count' => $emails->count(),
        ]);

        if ($emails->isNotEmpty()) {
            $now = now();

            $namesByEmail = User::whereIn('email', $emails)->pluck('name', 'email');

            $rows = $emails->map(function ($email) use ($campaign, $now, $namesByEmail) {
                return [
                    'campaign_id' => $campaign->id,
                    'name'        => $namesByEmail->get($email),
                    'email'       => $email,
                    'status'      => 'pending',
                    'created_at'  => $now,
                    'updated_at'  => $now,
                ];
            })->all();

            DB::table('newsletter_campaign_recipients')->insert($rows);
        }

        return response()->json(['id' => $campaign->id]);
    }

    protected function resolveRecipientsFromDataSource(string $dataSource, Newsletter $newsletter)
    {
        $norm = strtolower(str_replace([' ', '_'], '', $dataSource));

        if ($norm === 'learnerdelegates') {
            $query = User::role('Learner');
        } elseif ($norm === 'customers') {
            $query = User::role('Corporate Client');
        } elseif ($norm === 'trainers') {
            $query = User::role('trainer');
        } elseif ($norm === 'resellers') {
            $query = User::role('Reseller');
        } elseif ($norm === 'admins') {
            $query = User::role('Super Admin');
        } else {
            $raw = (array)($newsletter->to_recipients ?? []);

            return collect($raw)
                ->map(fn ($e) => is_array($e) ? Arr::get($e, 'email') : $e)
                ->map(fn ($e) => strtolower(trim((string)$e)))
                ->filter(fn ($e) => $e !== '' && filter_var($e, FILTER_VALIDATE_EMAIL))
                ->unique()
                ->values();
        }

        $emails = $query
            ->whereNotNull('email')
            ->where('email', '<>', '')
            ->pluck('email')
            ->all();

        return collect($emails)
            ->map(fn ($e) => strtolower(trim((string)$e)))
            ->filter(fn ($e) => $e !== '' && filter_var($e, FILTER_VALIDATE_EMAIL))
            ->unique()
            ->values();
    }

    public function datasourceContacts(Request $r)
    {
        $source = (string) $r->get('source', '');
        $page   = max(1, (int) $r->get('page', 1));
        $per    = max(1, min(100, (int) $r->get('per_page', 25)));
        $q      = trim((string) $r->get('q', ''));

        $norm = strtolower(str_replace([' ', '_'], '', $source));

        if ($norm === 'learnerdelegates') {
            $query = User::role('Learner');
        } elseif ($norm === 'customers') {
            $query = User::role('Corporate Client');
        } elseif ($norm === 'trainers') {
            $query = User::role('trainer');
        } elseif ($norm === 'resellers') {
            $query = User::role('Reseller');
        } elseif ($norm === 'admins') {
            $query = User::role('Super Admin');
        } else {
            return [
                'data'      => [],
                'total'     => 0,
                'page'      => $page,
                'per_page'  => $per,
                'last_page' => 1,
            ];
        }

        $query->whereNotNull('email')->where('email', '<>', '');

        if ($q !== '') {
            $query->where(function ($qq) use ($q) {
                $qq->where('name', 'like', '%' . $q . '%')
                    ->orWhere('email', 'like', '%' . $q . '%');
            });
        }

        $total = (clone $query)->count();
        $rows = $query->orderBy('email')
            ->forPage($page, $per)
            ->get(['id', 'name', 'email'])
            ->map(function ($u) {
                return [
                    'id'    => $u->id,
                    'name'  => $u->name ?: '',
                    'email' => $u->email,
                ];
            });

        return [
            'data'      => $rows,
            'total'     => $total,
            'page'      => $page,
            'per_page'  => $per,
            'last_page' => $per > 0 ? (int) ceil($total / $per) : 1,
        ];
    }

    public function send(NewsletterCampaign $campaign)
    {
        if ($campaign->sent_at) {
            return response()->json([
                'ok'      => false,
                'status'  => 'already_sent',
                'message' => 'This campaign has already been sent or is currently being processed. Please wait for completion.',
            ], 422);
        }

        event(new NewsletterCampaignSendRequested($campaign));

        $campaign->update([
            'sent_at' => Carbon::now(),
        ]);

        return response()->json([
            'ok'      => true,
            'status'  => 'queued',
            'message' => 'Campaign send has been queued. Delivery will depend on the queue and may still fail for some recipients.',
        ]);
    }


    public function destroy(NewsletterCampaign $campaign)
    {
        $campaign->delete();
        return response()->json(['ok' => true]);
    }

    public function datasourceDict()
    {
        $clients = User::role('Corporate Client')->count();
        $learners = User::role('Learner')->count();
        $trainers = User::role('trainer')->count();
        $resellers = User::role('Reseller')->count();
        $admins = User::role('Super Admin')->count();

        return [
            ['key' => 'Learner Delegates', 'count' => $learners],
            ['key' => 'Customers', 'count' => $clients],
            ['key' => 'Trainers', 'count' => $trainers],
            ['key' => 'Resellers', 'count' => $resellers],
            ['key' => 'Admins', 'count' => $admins],
        ];
    }

    public function datasourceSelect(Request $r)
    {
        $q = trim((string)$r->get('q', ''));
        $items = [
            ['id' => 'Learner Delegates', 'text' => 'LearnerDelegates'],
            ['id' => 'Customers', 'text' => 'Customers'],
            ['id' => 'Trainers', 'text' => 'Trainers'],
            ['id' => 'Resellers', 'text' => 'Resellers'],
            ['id' => 'Admins', 'text' => 'Admins'],
            ['id' => 'Training Course', 'text' => 'TrainingCourse'],
        ];

        if ($q !== '') {
            $items = array_values(array_filter($items, function ($x) use ($q) {
                return Str::contains(Str::lower($x['text']), Str::lower($q));
            }));
        }

        return $items;
    }

    public function datasourceTable(Request $r)
    {
        $page = max(1, (int)$r->get('page', 1));
        $per = max(1, min(50, (int)$r->get('per_page', 10)));
        $q = trim((string)$r->get('q', ''));
        $sw = trim((string)$r->get('starts_with', ''));
        $all = [
            ['name' => 'Appointments', 'total' => 0, 'valid' => 0],
            ['name' => 'Case Applicants', 'total' => 0, 'valid' => 0],
            ['name' => 'Customers', 'total' => User::role('Corporate Client')->count(), 'valid' => User::role('Corporate Client')->whereNotNull('email')->where('email', '<>', '')->count()],
            ['name' => 'Db Contacts', 'total' => 0, 'valid' => 0],
            ['name' => 'Debt Case', 'total' => 0, 'valid' => 0],
            ['name' => 'Investors', 'total' => 0, 'valid' => 0],
            ['name' => 'Job', 'total' => 0, 'valid' => 0],
            ['name' => 'Learner Delegates', 'total' => User::role('Learner')->count(), 'valid' => User::role('Learner')->whereNotNull('email')->where('email', '<>', '')->count()],
            ['name' => 'Personal Address Book', 'total' => 0, 'valid' => 1],
            ['name' => 'Potential Cases', 'total' => 0, 'valid' => 0],
            ['name' => 'Solicitors', 'total' => 0, 'valid' => 0],
            ['name' => 'Sources', 'total' => 4, 'valid' => 0],
            ['name' => 'Trainers', 'total' => User::role('trainer')->count(), 'valid' => User::role('trainer')->whereNotNull('email')->where('email', '<>', '')->count()],
            ['name' => 'Resellers', 'total' => User::role('Reseller')->count(), 'valid' => User::role('Reseller')->whereNotNull('email')->where('email', '<>', '')->count()],
            ['name' => 'Admins', 'total' => User::role('Super Admin')->count(), 'valid' => User::role('Super Admin')->whereNotNull('email')->where('email', '<>', '')->count()],
            ['name' => 'Training Course', 'total' => 0, 'valid' => 0],
        ];

        if ($q !== '') {
            $all = array_values(array_filter($all, function ($x) use ($q) {
                return Str::contains(Str::lower($x['name']), Str::lower($q));
            }));
        }

        if ($sw !== '') {
            $all = array_values(array_filter($all, function ($x) use ($sw) {
                $n = $x['name'];
                if ($sw === 'other') {
                    return !preg_match('/^[A-Za-z0-9]/', $n);
                }
                if ($sw === 'num') {
                    return preg_match('/^[0-9]/', $n) === 1;
                }
                return Str::startsWith(Str::lower($n), Str::lower($sw));
            }));
        }

        usort($all, function ($a, $b) {
            return strcasecmp($a['name'], $b['name']);
        });

        $total = count($all);
        $slice = array_slice($all, ($page - 1) * $per, $per);

        return ['data' => $slice, 'total' => $total, 'page' => $page, 'per_page' => $per];
    }

    public function sendTest(Newsletter $newsletter)
    {
        $to = $newsletter->created_by_email ?: auth()->user()?->email;

        if (!$to) {
            return response()->json(['ok' => false, 'message' => 'No test recipient available'], 422);
        }

        $subject = $newsletter->subject ?: 'Newsletter Test';
        $html = $newsletter->html_body ?: '<p>(No HTML body)</p>';
        $text = $newsletter->text_body ?: strip_tags($html);

        Mail::send([], [], function (Message $m) use ($to, $subject, $html, $text, $newsletter) {
            if ($newsletter->from_email) {
                $m->from($newsletter->from_email, $newsletter->from_name ?: null);
            }

            $m->to($to)->subject($subject)->setBody($html, 'text/html');
            $m->addPart($text, 'text/plain');

            foreach ((array)$newsletter->attachments as $a) {
                if (!empty($a['url'])) {
                    $disk = $a['disk'] ?? 'public';
                    $path = $a['path'] ?? ltrim(parse_url($a['url'], PHP_URL_PATH) ?? '', '/');
                    $name = $a['original_name'] ?? $a['name'] ?? null;
                    if ($path) {
                        $m->attachFromStorageDisk($disk, $path, $name);
                    }
                }
            }
        });

        return response()->json(['ok' => true]);
    }
}
