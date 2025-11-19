<?php

namespace App\Services\Newsletter;

use App\Jobs\DeliverNewsletterJob;
use App\Models\EmailSend;
use App\Models\EmailSendEvent;
use App\Models\NewsletterCampaign;
use App\Models\NewsletterCampaignRecipient;
use App\Models\User;
use App\Services\Email\TemplateRenderer;
use App\Services\Newsletter\Context\ContextBuilder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class NewsletterCampaignService
{
    protected TemplateRenderer $renderer;
    protected ContextBuilder $builder;

    public function __construct(TemplateRenderer $renderer, ContextBuilder $builder)
    {
        $this->renderer = $renderer;
        $this->builder  = $builder;
    }

    public function queueCampaign(NewsletterCampaign $campaign, string $locale = 'en'): void
    {
        $newsletter = $campaign->newsletter;

        if (!$newsletter) {
            return;
        }

        [$baseSubject, $baseHtml, $baseText] = $this->buildBaseContent($campaign);
        $baseMeta = $this->buildBaseMeta($campaign, $newsletter);

        NewsletterCampaignRecipient::query()
            ->where('campaign_id', $campaign->id)
            ->whereIn('status', ['pending', 'retry'])
            ->whereNotNull('email')
            ->orderBy('id')
            ->chunkById(200, function (Collection $rows) use (
                $campaign,
                $newsletter,
                $baseSubject,
                $baseHtml,
                $baseText,
                $baseMeta,
                $locale
            ) {
                $now = now();

                $normalizedEmails = [];
                $recipientEmailMap = [];

                foreach ($rows as $recipient) {
                    $normalized = $this->normalizeEmail($recipient->email);

                    if (!$normalized) {
                        continue;
                    }

                    $normalizedEmails[$normalized] = true;
                    $recipientEmailMap[$recipient->id] = $normalized;
                }

                if (empty($normalizedEmails)) {
                    return;
                }

                $emails = array_keys($normalizedEmails);
                $userMap = $this->mapUsersByEmail($emails);

                $recipientIdsToMarkQueued = [];

                foreach ($rows as $recipient) {
                    $recipientId = $recipient->id;

                    if (!isset($recipientEmailMap[$recipientId])) {
                        continue;
                    }

                    $emailKey = $recipientEmailMap[$recipientId];
                    $user = $userMap->get($emailKey);

                    $this->handleRecipientRow(
                        $campaign,
                        $newsletter,
                        $recipient,
                        $user,
                        $baseSubject,
                        $baseHtml,
                        $baseText,
                        $baseMeta,
                        $locale,
                        $now
                    );

                    $recipientIdsToMarkQueued[] = $recipientId;
                }

                if (!empty($recipientIdsToMarkQueued)) {
                    DB::table('newsletter_campaign_recipients')
                        ->whereIn('id', $recipientIdsToMarkQueued)
                        ->update([
                            'status'     => 'queued',
                            'updated_at' => $now,
                        ]);
                }
            });
    }

    protected function buildBaseContent(NewsletterCampaign $campaign): array
    {
        $baseSubject = (string) $campaign->subject_snapshot;
        $baseHtml    = (string) $campaign->html_snapshot;
        $baseText    = $campaign->text_snapshot ?: strip_tags($baseHtml);

        return [$baseSubject, $baseHtml, $baseText];
    }

    protected function buildBaseMeta(NewsletterCampaign $campaign, $newsletter): array
    {
        return [
            'from_name'        => (string) $newsletter->from_name,
            'from_email'       => (string) $newsletter->from_email,
            'cc'               => is_array($newsletter->cc_recipients) ? $newsletter->cc_recipients : [],
            'bcc'              => is_array($newsletter->bcc_recipients) ? $newsletter->bcc_recipients : [],
            'attachments'      => is_array($newsletter->attachments) ? $newsletter->attachments : [],
            'newsletter_id'    => $newsletter->id,
            'newsletter_name'  => $newsletter->title,
            'campaign_id'      => $campaign->id,
            'data_source'      => $campaign->data_source,
            'group_name'       => $campaign->group_name,
        ];
    }

    protected function mapUsersByEmail(array $emails): Collection
    {
        if (count($emails) === 0) {
            return collect();
        }

        $users = User::query()
            ->whereIn('email', $emails)
            ->get();

        return $users->keyBy(function (User $u) {
            return $this->normalizeEmail($u->email);
        });
    }

    protected function normalizeEmail(?string $email): ?string
    {
        if ($email === null) {
            return null;
        }

        $e = trim($email);

        if ($e === '') {
            return null;
        }

        return strtolower($e);
    }

    protected function handleRecipientRow(
        NewsletterCampaign $campaign,
                           $newsletter,
        NewsletterCampaignRecipient $recipient,
        ?User $user,
        string $baseSubject,
        string $baseHtml,
        string $baseText,
        array $baseMeta,
        string $locale,
        $now
    ): void {
        $context = $this->builder->build($campaign, $recipient, $user, $locale);

        [$subject, $html, $text] = $this->renderer->render(
            $newsletter->layout_html,
            $newsletter->layout_text,
            $baseSubject,
            $baseHtml,
            $baseText,
            $context
        );

        $sendMeta = $baseMeta;

        $send = EmailSend::create([
            'event_key'          => 'newsletter_campaign',
            'event_course_id'    => null,
            'recipient_email'    => $recipient->email,
            'template_code'      => 'newsletter_campaign',
            'template_version_id'=> null,
            'locale'             => $locale,
            'provider_key'       => 'smtp',
            'status'             => 'queued',
            'attempts'           => 0,
            'subject'            => $subject,
            'html_body'          => $html,
            'text_body'          => $text,
            'context'            => $context,
            'meta'               => $sendMeta,
            'created_at'         => $now,
            'updated_at'         => $now,
        ]);

        EmailSendEvent::create([
            'email_send_id' => $send->id,
            'user_id'       => $user ? $user->id : null,
            'type'          => 'queued',
            'payload'       => [
                'campaign_id'   => $campaign->id,
                'newsletter_id' => $newsletter->id,
            ],
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        dispatch(
            (new DeliverNewsletterJob(
                $send->id,
                $user ? $user->id : null,
                $recipient->id
            ))->delay($now->copy()->addSeconds(5))
        );
    }
}
