<?php

namespace App\Jobs;

use App\Models\EmailSend;
use App\Models\EmailSendEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Message;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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
        $metaSeed = [
            'type'                => 'contact_copy',
            'original_recipients' => $this->originalRecipients,
        ];

        $send = EmailSend::create([
            'event_key'          => 'contact.copy',
            'event_course_id'    => null,
            'recipient_email'    => $this->email,
            'template_code'      => 'contact.copy',
            'template_version_id'=> null,
            'locale'             => 'en',
            'provider_key'       => 'smtp',
            'status'             => 'pending',
            'attempts'           => 0,
            'subject'            => $this->subject,
            'html_body'          => $this->htmlBody,
            'text_body'          => null,
            'context'            => null,
            'meta'               => $metaSeed,
        ]);

        try {
            $send->attempts = ($send->attempts ?? 0) + 1;
            $send->save();

            Mail::send([], [], function (Message $m) {
                $m->to($this->email)
                    ->subject($this->subject)
                    ->setBody($this->htmlBody, 'text/html');

                foreach ($this->attachments as $att) {
                    if (!is_array($att)) {
                        continue;
                    }

                    $filename = $att['original_name'] ?? ($att['name'] ?? 'attachment');

                    if (!empty($att['path'])) {
                        $disk = $att['disk'] ?? 'public';
                        if (Storage::disk($disk)->exists($att['path'])) {
                            $opts = ['as' => $filename];
                            if (!empty($att['mime'])) {
                                $opts['mime'] = $att['mime'];
                            }
                            $m->attach(Storage::disk($disk)->path($att['path']), $opts);
                            continue;
                        }
                    }

                    if (!empty($att['url']) && preg_match('#^https?://#i', $att['url'])) {
                        $raw = @file_get_contents($att['url']);
                        if ($raw !== false) {
                            $mime = $att['mime'] ?? $this->guessMimeFromName($filename);
                            $m->attachData($raw, $filename, ['mime' => $mime]);
                        }
                        continue;
                    }

                    if (!empty($att['url']) && strpos($att['url'], '/storage/') === 0) {
                        $localPath = public_path(ltrim($att['url'], '/'));
                        if (is_file($localPath)) {
                            $opts = ['as' => $filename];
                            if (!empty($att['mime'])) {
                                $opts['mime'] = $att['mime'];
                            }
                            $m->attach($localPath, $opts);
                        }
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

            $meta = is_array($send->meta) ? $send->meta : [];
            $meta = array_merge($meta, [
                'provider' => 'smtp',
                'to'       => $this->email,
            ]);

            $send->status = 'sent';
            $send->sent_at = now();
            $send->meta = $meta;
            $send->save();

            EmailSendEvent::create([
                'email_send_id' => $send->id,
                'user_id'       => null,
                'type'          => 'delivered',
                'payload'       => $meta,
            ]);
        } catch (Throwable $e) {
            $meta = is_array($send->meta) ? $send->meta : [];
            $meta['error'] = $e->getMessage();

            $send->status = 'failed';
            $send->meta = $meta;
            $send->save();

            EmailSendEvent::create([
                'email_send_id' => $send->id,
                'user_id'       => null,
                'type'          => 'failed',
                'payload'       => ['error' => $e->getMessage()],
            ]);

            Log::warning('SendContactCopyEmailJob failed', [
                'email' => $this->email,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    protected function guessMimeFromName(string $filename): string
    {
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        switch ($ext) {
            case 'jpg':
            case 'jpeg':
                return 'image/jpeg';
            case 'png':
                return 'image/png';
            case 'gif':
                return 'image/gif';
            case 'pdf':
                return 'application/pdf';
            case 'doc':
                return 'application/msword';
            case 'docx':
                return 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
            default:
                return 'application/octet-stream';
        }
    }
}
