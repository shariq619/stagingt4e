<?php

namespace App\Services\Crm\RawEmail\Provider;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MailProvider
{
    public function send(
        string $to,
        string $subject,
        ?string $htmlBody,
        ?string $textBody = null,
        array $meta = []
    ): array {
        $messageId = null;
        $rawHeaders = null;

        Mail::send([], [], function ($message) use ($to, $subject, $htmlBody, $textBody, $meta, &$messageId, &$rawHeaders) {
            $message->to($to)->subject($subject);

            if (!empty($meta['from_email'])) {
                $message->from(
                    $meta['from_email'],
                    $meta['from_name'] ?? config('mail.from.name')
                );
            } else {
                $message->from(
                    config('mail.from.address'),
                    config('mail.from.name')
                );
            }

            if ($htmlBody) {
                $message->setBody($htmlBody, 'text/html');
            }

            if ($textBody) {
                $message->addPart($textBody, 'text/plain');
            }

            if (!empty($meta['cc'])) {
                foreach ($meta['cc'] as $cc) {
                    if ($cc) $message->cc($cc);
                }
            }

            if (!empty($meta['bcc'])) {
                foreach ($meta['bcc'] as $bcc) {
                    if ($bcc) $message->bcc($bcc);
                }
            }

            if (!empty($meta['attachments'])) {
                foreach ($meta['attachments'] as $att) {
                    if (!is_array($att)) continue;
                    $filename = $att['original_name'] ?? ($att['name'] ?? 'attachment');

                    if (!empty($att['path'])) {
                        $disk = $att['disk'] ?? 'public';
                        if (Storage::disk($disk)->exists($att['path'])) {
                            $opts = ['as' => $filename];
                            if (!empty($att['mime'])) $opts['mime'] = $att['mime'];
                            $message->attach(Storage::disk($disk)->path($att['path']), $opts);
                            continue;
                        }
                    }

                    if (!empty($att['url']) && preg_match('#^https?://#i', $att['url'])) {
                        $raw = @file_get_contents($att['url']);
                        if ($raw !== false) {
                            $mime = $att['mime'] ?? $this->guessMimeFromName($filename);
                            $message->attachData($raw, $filename, ['mime' => $mime]);
                        }
                        continue;
                    }

                    if (!empty($att['url']) && strpos($att['url'], '/storage/') === 0) {
                        $localPath = public_path(ltrim($att['url'], '/'));
                        if (is_file($localPath)) {
                            $opts = ['as' => $filename];
                            if (!empty($att['mime'])) $opts['mime'] = $att['mime'];
                            $message->attach($localPath, $opts);
                        }
                    }
                }
            }

            if (!empty($meta['headers'])) {
                foreach ($meta['headers'] as $key => $value) {
                    $message->getHeaders()->addTextHeader($key, (string)$value);
                }
            }

            $swift = $message->getSwiftMessage();
            $messageId = $swift->getId();
            $rawHeaders = $swift->getHeaders()->toString();
        });

        return [
            'provider'   => 'smtp',
            'message_id' => $messageId,
            'headers'    => $rawHeaders,
        ];
    }

    protected function guessMimeFromName(string $filename): string
    {
        return match (strtolower(pathinfo($filename, PATHINFO_EXTENSION))) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png'         => 'image/png',
            'gif'         => 'image/gif',
            'pdf'         => 'application/pdf',
            'doc'         => 'application/msword',
            'docx'        => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            default       => 'application/octet-stream',
        };
    }
}
