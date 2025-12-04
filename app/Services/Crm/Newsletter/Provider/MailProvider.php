<?php

namespace App\Services\Crm\Newsletter\Provider;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MailProvider
{
    public function send($to, $subject, $htmlBody, $textBody, array $meta = [])
    {
        $messageId = null;
        $rawHeaders = null;

        Mail::send([], [], function ($message) use ($to, $subject, $htmlBody, $textBody, $meta, &$messageId, &$rawHeaders) {
            $message->to($to)->subject($subject);

            if (!empty($meta['from_email'])) {
                $fromEmail = $meta['from_email'];
                $fromName  = $meta['from_name'] ?? config('mail.from.name');
                $message->from($fromEmail, $fromName);
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
                    $filename = $att['original_name'] ?? ($att['name'] ?? 'attachment');

                    if (!empty($att['path']) && Storage::disk('public')->exists($att['path'])) {
                        $message->attach(
                            Storage::disk('public')->path($att['path']),
                            ['as' => $filename]
                        );
                        continue;
                    }

                    if (!empty($att['url']) && preg_match('#^https?://#i', $att['url'])) {
                        $raw = @file_get_contents($att['url']);
                        if ($raw !== false) {
                            $mime = $this->guessMimeFromName($filename);
                            $message->attachData($raw, $filename, ['mime' => $mime]);
                        }
                        continue;
                    }

                    if (!empty($att['url']) && strpos($att['url'], '/storage/') === 0) {
                        $localPath = public_path(ltrim($att['url'], '/'));
                        if (is_file($localPath)) {
                            $message->attach($localPath, ['as' => $filename]);
                        }
                    }
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
