<?php

namespace App\Jobs;

use App\Models\EmailSend;
use App\Models\EmailSendEvent;
use App\Models\EmailThread;
use App\Models\EmailMessage;
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
        $this->userId      = $userId;
        $this->recipientId = $recipientId;
        $this->campaignId  = $campaignId;
    }

    public function handle(): void
    {
        $send = EmailSend::find($this->emailSendId);
        if (!$send) {
            return;
        }

        $now  = now();
        $meta = is_array($send->meta) ? $send->meta : [];

        if ($send->status === 'sent') {
            return;
        }

        $userId      = $this->userId ?? ($meta['user_id'] ?? null);
        $recipientId = $this->recipientId ?? ($meta['recipient_id'] ?? null);
        $campaignId  = $this->campaignId ?? ($meta['campaign_id'] ?? null);

        $provider = new MailProvider();

        try {
            $send->attempts   = $send->attempts + 1;
            $send->updated_at = $now;
            $send->save();

            $result = $provider->send(
                $send->recipient_email,
                $send->subject,
                $send->html_body,
                $send->text_body,
                $meta
            );

            $send->status              = 'sent';
            $send->sent_at             = $now;
            $send->provider_message_id = $result['message_id'] ?? null;
            $send->meta                = array_merge($meta, $result);
            $send->updated_at          = $now;

            if (!$send->email_thread_id) {
                $thread = EmailThread::create([
                    'subject'            => $send->subject,
                    'root_message_id'    => $result['message_id'] ?? null,
                    'created_by_user_id' => $userId,
                ]);
                $send->email_thread_id = $thread->id;
            } else {
                $thread = $send->thread;
            }

            $send->save();

            if ($thread) {
                EmailMessage::create([
                    'email_thread_id' => $thread->id,
                    'email_send_id'   => $send->id,
                    'direction'       => 'outbound',
                    'from_email'      => $meta['from_email'] ?? config('mail.from.address'),
                    'to_email'        => $send->recipient_email,
                    'cc'              => $meta['cc'] ?? [],
                    'bcc'             => $meta['bcc'] ?? [],
                    'subject'         => $send->subject,
                    'body_html'       => $send->html_body,
                    'body_text'       => $send->text_body,
                    'message_id'      => $result['message_id'] ?? null,
                    'in_reply_to'     => null,
                    'sent_at'         => $now,
                    'received_at'     => null,
                    'provider'        => $result['provider'] ?? 'smtp',
                    'raw_headers'     => $result['headers'] ?? null,
                ]);
            }

            EmailSendEvent::create([
                'email_send_id' => $send->id,
                'user_id'       => $userId,
                'type'          => 'delivered',
                'payload'       => $result,
                'created_at'    => $now,
                'updated_at'    => $now,
            ]);

            if ($recipientId) {
                DB::table('newsletter_campaign_recipients')
                    ->where('id', $recipientId)
                    ->update([
                        'status'     => 'sent',
                        'updated_at' => $now,
                    ]);
            }
        } catch (Throwable $e) {
            $meta['error']   = $e->getMessage();

            $send->status    = 'failed';
            $send->meta      = $meta;
            $send->updated_at = $now;
            $send->save();

            EmailSendEvent::create([
                'email_send_id' => $send->id,
                'user_id'       => $userId ?? null,
                'type'          => 'failed',
                'payload'       => ['error' => $e->getMessage()],
                'created_at'    => $now,
                'updated_at'    => $now,
            ]);

            if ($recipientId) {
                DB::table('newsletter_campaign_recipients')
                    ->where('id', $recipientId)
                    ->update([
                        'status'     => 'failed',
                        'updated_at' => $now,
                    ]);
            }

            if ($campaignId) {
                DB::table('newsletter_campaigns')
                    ->where('id', $campaignId)
                    ->update([
                        'sent_at'    => null,
                        'updated_at' => $now,
                    ]);
            }

        }
    }
}
