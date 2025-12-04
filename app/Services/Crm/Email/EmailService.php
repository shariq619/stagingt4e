<?php

namespace App\Services\Crm\Email;

use App\Jobs\Crm\DeliverEmailJob;
use App\Models\EmailSend;
use App\Models\EmailSendEvent;
use App\Models\EmailTrigger;
use App\Services\Crm\Email\Context\ContextBuilder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use function dispatch;

class EmailService
{
    protected TemplateRenderer $renderer;
    protected MappingResolver $resolver;
    protected ContextBuilder $builder;

    public function __construct(ContextBuilder $builder)
    {
        $this->renderer = new TemplateRenderer();
        $this->resolver = new MappingResolver();
        $this->builder = $builder;
    }

    public function dispatchLearnerStatusUpdate($detail, string $status, array $extras = [])
    {
        $slug = Str::slug($status);
        $triggerKey = 'course.status.changed.' . $slug;
        $eventKey = 'learner-status-' . $detail->id . '-' . $status;

        return $this->dispatchStatusTrigger($triggerKey, $detail, $status, $extras, $eventKey);
    }

    public function dispatchStatusTrigger(string $triggerKey, $detail, string $status, array $extras, string $eventKey)
    {
        $payload = $this->builder->build($detail, $status, $extras);

        return $this->dispatchTrigger($triggerKey, $payload, $eventKey);
    }

    public function dispatchTrigger(string $triggerKey, array $payload, string $eventKey)
    {
        $trigger = EmailTrigger::where('key', $triggerKey)
            ->where('active', 1)
            ->first();

        if (!$trigger) {
            return null;
        }

        $mapping = $this->resolver->resolve($trigger, $payload);
        if (!$mapping) {
            return null;
        }

        $template = $mapping->template;
        $version = $template->currentVersion;
        if (!$version) {
            return null;
        }

        $locale = $payload['locale'] ?? 'en';
        $t = $version->translationForLocale($locale);
        if (!$t) {
            return null;
        }

        $context = $payload;

        $userId = $this->read($payload, 'user.id')
            ?? ($payload['user_id'] ?? null)
            ?? $this->read($payload, 'order.user_id');

        if (!array_key_exists('user_id', $context)) {
            $context['user_id'] = $userId;
        }

        [$subject, $html, $text] = $this->renderer->render(
            $version->layout_html,
            $version->layout_text,
            $t->subject,
            $t->html_body,
            $t->text_body,
            $context
        );

        $recipients = $this->resolveRecipients($mapping->recipients, $payload);
        if (!count($recipients)) {
            return true;
        }

        $versionAttachments = is_array($version->attachments) ? $version->attachments : [];
        $versionMeta = is_array($version->meta) ? $version->meta : [];

        $courseId =
            $mapping->course_id
            ?? ($payload['course_id'] ?? null)
            ?? $this->read($payload, 'course.id');

        foreach ($recipients as $toEmail) {

//            $idKey = $this->makeIdempotencyKey($eventKey, $toEmail);

//          if ($this->alreadySentRecently($idKey)) {
//              continue;
//          }

            $sendMeta = [
                'cc' => $versionMeta['cc'] ?? [],
                'bcc' => $versionMeta['bcc'] ?? [],
                'attachments' => $versionAttachments,
                'from_name' => $versionMeta['from_name'] ?? null,
                'from_email' => $versionMeta['from_email'] ?? null,
                'created_by_name' => $versionMeta['created_by_name'] ?? null,
                'created_by_email' => $versionMeta['created_by_email'] ?? null,
                'data_source' => $versionMeta['data_source'] ?? null,
                'merge_field' => $versionMeta['merge_field'] ?? null,
                'newsletter_name' => $versionMeta['newsletter_name'] ?? null,
            ];

            $send = EmailSend::create([
                'event_key' => $eventKey,
                'event_course_id' => $courseId,
                'recipient_email' => $toEmail,
                'template_code' => $template->code,
                'template_version_id' => $version->id,
                'locale' => $locale,
                'provider_key' => 'smtp',
                'status' => 'queued',
                'attempts' => 0,
                'subject' => $subject,
                'html_body' => $html,
                'text_body' => $text,
                'context' => $context,
                'meta' => $sendMeta,
            ]);

            EmailSendEvent::create([
                'email_send_id' => $send->id,
                'user_id' => $userId,
                'type' => 'queued',
                'payload' => ['trigger' => $triggerKey],
            ]);

//          $this->recordIdempotency($idKey, $eventKey, $toEmail);

            dispatch(new DeliverEmailJob($send->id, $userId));
        }

        return true;
    }

    protected function resolveRecipients($recipientsConfig, array $payload): array
    {
        $resolved = [];

        if (is_array($recipientsConfig)) {
            foreach ($recipientsConfig as $r) {
                $role = $r['role'] ?? null;

                if ($role === 'student' || $role === 'user') {
                    $email = $this->read($payload, 'user.email');
                    if ($email) {
                        $resolved[] = $email;
                    }
                } elseif ($role === 'instructor') {
                    $email = $this->read($payload, 'instructor.email');
                    if ($email) {
                        $resolved[] = $email;
                    }
                } elseif ($role === 'admin') {
                    if (env('ADMIN_EMAIL')) {
                        $resolved[] = env('ADMIN_EMAIL');
                    }
                } elseif ($role === 'custom' && !empty($r['email'])) {
                    $resolved[] = $r['email'];
                }
            }
        }

        $seen = [];
        $final = [];

        foreach ($resolved as $emRaw) {
            $em = strtolower(trim($emRaw));
            if ($em && !isset($seen[$em])) {
                $seen[$em] = true;
                $final[] = $em;
            }
        }

        return $final;
    }

    protected function read(array $data, string $path)
    {
        $parts = explode('.', $path);
        $cur = $data;

        foreach ($parts as $p) {
            if (is_array($cur) && array_key_exists($p, $cur)) {
                $cur = $cur[$p];
            } else {
                return null;
            }
        }

        return $cur;
    }

//    protected function makeIdempotencyKey(string $eventKey, string $email): string
//    {
//        return sha1($eventKey . '|' . strtolower($email));
//    }
//
//    protected function alreadySentRecently(string $hash): bool
//    {
//        return DB::table('email_idempotency')
//            ->where('hash', $hash)
//            ->where('created_at', '>=', now()->subDay())
//            ->exists();
//    }

    protected function recordIdempotency(string $hash, string $eventKey, string $email): void
    {
        DB::table('email_idempotency')->insert([
            'hash' => $hash,
            'event_key' => $eventKey,
            'recipient_email' => $email,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
