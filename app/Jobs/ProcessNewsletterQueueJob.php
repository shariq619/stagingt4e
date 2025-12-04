<?php

namespace App\Jobs;

use App\Models\EmailSend;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProcessNewsletterQueueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        $maxPerHour = 180;
        $perMinute  = max(1, (int) floor($maxPerHour / 60));

        DB::transaction(function () use ($perMinute) {
            $sends = EmailSend::where('status', 'queued')
                ->where('event_key', 'newsletter_campaign')
                ->orderBy('id')
                ->limit($perMinute)
                ->lockForUpdate()
                ->get();

            foreach ($sends as $send) {
                $send->status = 'processing';
                $send->save();

                $meta        = is_array($send->meta) ? $send->meta : [];
                $recipientId = $meta['recipient_id'] ?? null;
                $campaignId  = $meta['campaign_id'] ?? null;
                $userId      = $meta['user_id'] ?? null;

                dispatch(new DeliverNewsletterJob(
                    $send->id,
                    $userId,
                    $recipientId,
                    $campaignId
                ));
            }
        });
    }
}
