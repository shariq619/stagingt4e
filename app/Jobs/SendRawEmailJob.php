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
        $this->to          = $to;
        $this->subject     = $subject;
        $this->html        = $html;
        $this->attachments = $attachments;
    }

    public function handle(): void
    {
        $metaSeed = [
            'type' => 'raw_send',
        ];

        $send = EmailSend::create([
            'event_key'          => 'raw.send',
            'event_course_id'    => null,
            'recipient_email'    => $this->to,
            'template_code'      => 'raw.send',
            'template_version_id'=> null,
            'locale'             => 'en',
            'provider_key'       => 'smtp',
            'status'             => 'pending',
            'attempts'           => 0,
            'subject'            => $this->subject,
            'html_body'          => $this->html,
            'text_body'          => null,
            'context'            => null,
            'meta'               => $metaSeed,
        ]);

        try {
            $send->attempts = ($send->attempts ?? 0) + 1;
            $send->save();

            Mail::send([], [], function (Message $m) {
                $m->to($this->to)
                    ->subject($this->subject)
                    ->setBody($this->html, 'text/html');

                foreach ($this->attachments as $att) {
                    if (!is_array($att)) {
                        continue;
                    }

                    $filename = $att['original_name'] ?? ($att['name'] ?? 'attachment');

                    if (!empty($att['path'])) {
                        $disk = $att['disk'] ?? 'public';
                        if (Storage::disk($disk)->exists($att['path'])) {
                            $m->attach(
                                Storage::disk($disk)->path($att['path']),
                                ['as' => $filename] + (!empty($att['mime']) ? ['mime' => $att['mime']] : [])
                            );
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
            });

            $meta = is_array($send->meta) ? $send->meta : [];
            $meta = array_merge($meta, [
                'provider' => 'smtp',
                'to'       => $this->to,
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

            Log::warning('SendRawEmailJob failed', [
                'email' => $this->to,
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
