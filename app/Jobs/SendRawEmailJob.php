<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Mail\Message;
use Throwable;

class SendRawEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $to;
    public string $subject;
    public string $html;
    public array $attachments;

    public $tries = 3;
    public $timeout = 60;

    public function __construct(string $to, string $subject, string $html, array $attachments = [])
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->html = $html;
        $this->attachments = $attachments;
    }

    public function handle(): void
    {
        try {
            Mail::send([], [], function (Message $m) {
                $m->to($this->to)
                    ->subject($this->subject)
                    ->setBody($this->html, 'text/html');

                foreach ($this->attachments as $att) {
                    if (!is_array($att) || empty($att['path'])) {
                        continue;
                    }

                    $disk = $att['disk'] ?? 'local';
                    $relativePath = $att['path'];

                    $fullPath = Storage::disk($disk)->path($relativePath);
                    if (!is_readable($fullPath)) {
                        continue;
                    }

                    $opts = [];

                    if (!empty($att['name'])) {
                        $opts['as'] = $att['name'];
                    }
                    if (!empty($att['mime'])) {
                        $opts['mime'] = $att['mime'];
                    }

                    $m->attach($fullPath, $opts);
                }
            });

        } catch (Throwable $e) {
            Log::warning('SendRawEmailJob failed', [
                'email' => $this->to,
                'error' => $e->getMessage(),
            ]);

            throw $e;

        }
    }
}
