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
use Illuminate\Support\Facades\Log;
use Throwable;

class SendRawEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $to;
    public string $subject;
    public string $html;
    public array $attachments;
    public ?int $userId;

    public $tries = 3;
    public $timeout = 60;

    public function __construct(
        string $to,
        string $subject,
        string $html,
        array $attachments = [],
        ?int $userId = null
    ) {
        $this->to          = $to;
        $this->subject     = $subject;
        $this->html        = $html;
        $this->attachments = $attachments;
        $this->userId      = $userId;
    }

    public function handle(): void
    {
        $metaSeed = [
            'type'              => 'raw_send',
            'attachments'       => $this->attachments,
            'recipient_user_id' => $this->userId,
        ];

        $send = EmailSend::create([
            'event_key'       => 'raw.send',
            'recipient_email' => $this->to,
            'template_code'   => 'raw.send',
            'locale'          => 'en',
            'provider_key'    => 'smtp',
            'status'          => 'pending',
            'attempts'        => 0,
            'subject'         => $this->subject,
            'html_body'       => $this->html,
            'meta'            => $metaSeed,
        ]);

        try {
            $send->attempts++;
            $send->save();

            $provider = new MailProvider();
            $meta     = $send->meta ?? [];

            $result = $provider->send(
                $this->to,
                $this->subject,
                $this->html,
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

            Log::warning('SendRawEmailJob failed', [
                'email' => $this->to,
                'user'  => $this->userId,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}
