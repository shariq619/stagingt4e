<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Message;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
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
        $this->email             = $email;
        $this->subject           = $subject;
        $this->htmlBody          = $htmlBody;
        $this->attachments       = $attachments;
        $this->originalRecipients = $originalRecipients;
    }

    public function handle(): void
    {
        try {
            Mail::send([], [], function (Message $m) {
                $m->to($this->email)
                    ->subject($this->subject)
                    ->setBody($this->htmlBody, 'text/html');

                foreach ($this->attachments as $att) {
                    $path = $att['path'] ?? null;
                    $name = $att['name'] ?? null;

                    if ($path && is_file($path)) {
                        $m->attach($path, [
                            'as' => $name ?: basename($path),
                        ]);
                    }
                }

                if (!empty($this->originalRecipients)) {
                    $m->getHeaders()->addTextHeader(
                        'X-Original-Recipients',
                        implode(',', $this->originalRecipients)
                    );
                }

                $m->getHeaders()->addTextHeader('X-Contact-Copy', '1');
            });
        } catch (Throwable $e) {
            \Log::warning('SendContactCopyEmailJob failed', [
                'email' => $this->email,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }
}
