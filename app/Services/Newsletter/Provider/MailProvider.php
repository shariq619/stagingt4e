<?php

namespace App\Services\Newsletter\Provider;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MailProvider
{
    public function send($to, $subject, $htmlBody, $textBody, array $meta = [])
    {
        Mail::send([], [], function ($message) use ($to, $subject, $htmlBody, $textBody, $meta) {

            if (!empty($meta['from_email'])) {
                $message->from($meta['from_email'], $meta['from_name'] ?? null);
            }

            $message->to($to)->subject($subject);

            if ($htmlBody) {
                $message->setBody($htmlBody, 'text/html');
            }

            if ($textBody) {
                $message->addPart($textBody, 'text/plain');
            }

            if (!empty($meta['cc']) && is_array($meta['cc'])) {
                foreach ($meta['cc'] as $cc) {
                    if ($cc) $message->cc($cc);
                }
            }

            if (!empty($meta['bcc']) && is_array($meta['bcc'])) {
                foreach ($meta['bcc'] as $bcc) {
                    if ($bcc) $message->bcc($bcc);
                }
            }

            if (!empty($meta['attachments']) && is_array($meta['attachments'])) {
                foreach ($meta['attachments'] as $att) {

                    $filename = $att['name'] ?? $att['original_name'] ?? 'attachment';

                    if (!empty($att['disk']) && !empty($att['path']) && Storage::disk($att['disk'])->exists($att['path'])) {
                        $message->attach(
                            Storage::disk($att['disk'])->path($att['path']),
                            ['as' => $filename]
                        );
                        continue;
                    }

                    if (!empty($att['path']) && Storage::exists($att['path'])) {
                        $message->attach(
                            Storage::path($att['path']),
                            ['as' => $filename]
                        );
                        continue;
                    }

                    if (!empty($att['url'])) {
                        $raw = @file_get_contents($att['url']);
                        if ($raw !== false) {
                            $mime = $this->guessMime($filename);
                            $message->attachData($raw, $filename, ['mime' => $mime]);
                        }
                    }
                }
            }
        });

        return [
            'provider' => 'smtp',
            'message_id' => null,
        ];
    }

    protected function guessMime($file)
    {
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        return match ($ext) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png'        => 'image/png',
            'gif'        => 'image/gif',
            'pdf'        => 'application/pdf',
            'doc'        => 'application/msword',
            'docx'       => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            default      => 'application/octet-stream',
        };
    }
}
