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
    protected ?int $campaignId;

    public function __construct(int $emailSendId, ?int $userId = null, ?int $recipientId = null, ?int $campaignId = null)
    {
        $this->emailSendId = $emailSendId;
        $this->userId = $userId;
        $this->recipientId = $recipientId;
        $this->campaignId = $campaignId;
    }

    public function handle(): void
    {
        $send = EmailSend::find($this->emailSendId);
        if (!$send) {
            return;
        }

        $now = now();
        $meta = is_array($send->meta) ? $send->meta : [];

        if ($send->status === 'sent') {
            return;
        }

        $recentThreshold = (clone $now)->subDay();
        if ($send->sent_at && $send->sent_at >= $recentThreshold) {
            return;
        }

        $provider = new MailProvider();

        try {
            $send->attempts = $send->attempts + 1;
            $send->updated_at = $now;
            $send->save();

            $result = $provider->send(
                $send->recipient_email,
                $send->subject,
                $send->html_body,
                $send->text_body,
                $meta
            );

            $send->status = 'sent';
            $send->sent_at = $now;
            $send->meta = array_merge($meta, $result);
            $send->updated_at = $now;
            $send->save();

            EmailSendEvent::create([
                'email_send_id' => $send->id,
                'user_id'       => $this->userId,
                'type'          => 'delivered',
                'payload'       => $result,
                'created_at'    => $now,
                'updated_at'    => $now,
            ]);

            if ($this->recipientId) {
                DB::table('newsletter_campaign_recipients')
                    ->where('id', $this->recipientId)
                    ->update([
                        'status'     => 'sent',
                        'updated_at' => $now,
                    ]);
            }
        } catch (Throwable $e) {
            $meta['error'] = $e->getMessage();

            $send->status = 'failed';
            $send->meta = $meta;
            $send->updated_at = $now;
            $send->save();

            EmailSendEvent::create([
                'email_send_id' => $send->id,
                'user_id'       => $this->userId,
                'type'          => 'failed',
                'payload'       => ['error' => $e->getMessage()],
                'created_at'    => $now,
                'updated_at'    => $now,
            ]);

            if ($this->recipientId) {
                DB::table('newsletter_campaign_recipients')
                    ->where('id', $this->recipientId)
                    ->update([
                        'status'     => 'failed',
                        'updated_at' => $now,
                    ]);
            }

            $campaignId = $this->campaignId ?? ($meta['campaign_id'] ?? null);
            if ($campaignId) {
                DB::table('newsletter_campaigns')
                    ->where('id', $campaignId)
                    ->update([
                        'sent_at'    => null,
                        'updated_at' => $now,
                    ]);
            }

            throw $e;
        }
    }
}
