<?php

namespace App\Jobs;

use App\Models\EmailSend;
use App\Models\EmailSendEvent;
use App\Services\Newsletter\Provider\MailProvider;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Throwable;

class DeliverNewsletterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    protected int $emailSendId;
    protected ?int $userId;
    protected ?int $recipientId;

    public function __construct(int $emailSendId, ?int $userId = null, ?int $recipientId = null)
    {
        $this->emailSendId = $emailSendId;
        $this->userId = $userId;
        $this->recipientId = $recipientId;
    }

    public function handle(): void
    {
        $send = EmailSend::find($this->emailSendId);
        if (!$send) {
            return;
        }

        if ($send->status === 'sent') {
            return;
        }

        if ($send->sent_at && $send->sent_at >= now()->subDay()) {
            return;
        }

        $provider = new MailProvider();

        try {
            $send->attempts = $send->attempts + 1;
            $send->save();

            $currentMeta = is_array($send->meta) ? $send->meta : [];

            $result = $provider->send(
                $send->recipient_email,
                $send->subject,
                $send->html_body,
                $send->text_body,
                $currentMeta
            );

            $send->status = 'sent';
            $send->sent_at = now();
            $send->meta = array_merge($currentMeta, $result);
            $send->save();

            EmailSendEvent::create([
                'email_send_id' => $send->id,
                'user_id' => $this->userId,
                'type' => 'delivered',
                'payload' => $result,
            ]);

            if ($this->recipientId) {
                DB::table('newsletter_campaign_recipients')
                    ->where('id', $this->recipientId)
                    ->update([
                        'status' => 'sent',
                        'updated_at' => now(),
                    ]);
            }
        } catch (Throwable $e) {
            $currentMeta['error'] = $e->getMessage();

            $send->status = 'failed';
            $send->meta = $currentMeta;
            $send->save();

            EmailSendEvent::create([
                'email_send_id' => $send->id,
                'user_id' => $this->userId,
                'type' => 'failed',
                'payload' => ['error' => $e->getMessage()],
            ]);

            if ($this->recipientId) {
                DB::table('newsletter_campaign_recipients')
                    ->where('id', $this->recipientId)
                    ->update([
                        'status' => 'failed',
                        'updated_at' => now(),
                    ]);
            }

            throw $e;
        }
    }
}
