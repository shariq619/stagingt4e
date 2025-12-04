<?php

namespace App\Jobs\Crm;

use App\Models\EmailSend;
use App\Models\EmailSendEvent;
use App\Services\Crm\RawEmail\Provider\MailProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class SendContactCopyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $email;
    public string $subject;
    public string $htmlBody;
    public array $attachments;
    public array $originalRecipients;

    public $tries = 3;
    public $timeout = 60;

    public function __construct(
        string $email,
        string $subject,
        string $htmlBody,
        array $attachments = [],
        array $originalRecipients = []
    ) {
        $this->email              = $email;
        $this->subject            = $subject;
        $this->htmlBody           = $htmlBody;
        $this->attachments        = $attachments;
        $this->originalRecipients = $originalRecipients;
    }

    public function handle(): void
    {
        $attachments = [];

        if (!empty($this->originalRecipients)) {
            $origEmail = $this->originalRecipients[0];

            $originalSend = EmailSend::query()
                ->where('recipient_email', $origEmail)
                ->where('subject', $this->subject)
                ->where('event_key', '!=', 'contact.copy')
                ->orderByDesc('id')
                ->first();

            if ($originalSend) {
                $meta = $originalSend->meta ?? [];
                if (!empty($meta['attachments'])) {
                    $attachments = $meta['attachments'];
                }
            }
        }

        $metaSeed = [
            'type'                => 'contact_copy',
            'original_recipients' => $this->originalRecipients,
            'attachments'         => $attachments,
        ];

        $send = EmailSend::create([
            'event_key'       => 'contact.copy',
            'recipient_email' => $this->email,
            'template_code'   => 'contact.copy',
            'locale'          => 'en',
            'provider_key'    => 'smtp',
            'status'          => 'pending',
            'attempts'        => 0,
            'subject'         => $this->subject,
            'html_body'       => $this->htmlBody,
            'meta'            => $metaSeed,
        ]);

        try {
            $send->attempts++;
            $send->save();

            $provider = new MailProvider();
            $meta     = $send->meta ?? [];

            $meta['headers'] = [
                'X-Contact-Copy' => '1',
            ];

            if (!empty($this->originalRecipients)) {
                $meta['headers']['X-Original-Recipients'] =
                    implode(',', $this->originalRecipients);
            }

            $result = $provider->send(
                $this->email,
                $this->subject,
                $this->htmlBody,
                null,
                $meta
            );

            $send->status  = 'sent';
            $send->sent_at = now();
            $send->meta    = array_merge($meta, $result);
            $send->save();

            EmailSendEvent::create([
                'email_send_id' => $send->id,
                'type'          => 'delivered',
                'payload'       => $result,
            ]);
        } catch (Throwable $e) {
            $meta          = $send->meta ?? [];
            $meta['error'] = $e->getMessage();

            $send->status = 'failed';
            $send->meta   = $meta;
            $send->save();

            EmailSendEvent::create([
                'email_send_id' => $send->id,
                'type'          => 'failed',
                'payload'       => ['error' => $e->getMessage()],
            ]);

            throw $e;
        }
    }
}
