<?php

namespace App\Services\Email\Provider;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MailProvider
{
    public function send($to, $subject, $htmlBody, $textBody, array $meta = [])
    {
        Mail::send([], [], function ($message) use ($to, $subject, $htmlBody, $textBody, $meta) {
            $message->to($to)->subject($subject);

            if ($htmlBody) {
                $message->setBody($htmlBody, 'text/html');
            }

            if ($textBody) {
                $message->addPart($textBody, 'text/plain');
            }

            if (!empty($meta['cc']) && is_array($meta['cc'])) {
                foreach ($meta['cc'] as $cc) {
                    if ($cc) {
                        $message->cc($cc);
                    }
                }
            }

            if (!empty($meta['bcc']) && is_array($meta['bcc'])) {
                foreach ($meta['bcc'] as $bcc) {
                    if ($bcc) {
                        $message->bcc($bcc);
                    }
                }
            }

            if (!empty($meta['attachments']) && is_array($meta['attachments'])) {
                foreach ($meta['attachments'] as $att) {
                    $filename = $att['name'] ?? 'attachment';

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
                            $mime = $this->guessMimeFromName($filename);

                            $message->attachData(
                                $raw,
                                $filename,
                                ['mime' => $mime]
                            );
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

    protected function guessMimeFromName($filename)
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
