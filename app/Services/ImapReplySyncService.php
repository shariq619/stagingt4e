<?php

namespace App\Services;

use App\Models\EmailMessage;
use App\Models\EmailThread;
use Carbon\Carbon;
use Webklex\IMAP\Facades\Client;

class ImapReplySyncService
{
    public function sync(): void
    {
        $client = Client::account('default');
        $client->connect();

        $folder = $client->getFolder('INBOX');

        $messages = $folder->query()
            ->since(now()->subDays(7))
            ->get();

        foreach ($messages as $message) {
            $subject   = $message->getSubject() ?? '';
            $fromObj   = $message->getFrom()[0] ?? null;
            $from      = $fromObj ? ($fromObj->mail ?? null) : null;
            $toObj     = $message->getTo()[0] ?? null;
            $to        = $toObj ? ($toObj->mail ?? null) : null;
            $messageId = $message->getMessageId();
            $inReplyTo = $message->getInReplyTo();
            $referencesHeader = $message->getReferences() ?? null;

            if (!$messageId) {
                $message->setFlag('Seen');
                continue;
            }

            $headersArr = $message->getHeaders()->toArray();
            $fromLower = $from ? strtolower($from) : '';
            $subjectLower = strtolower($subject);
            $autoSubmitted = strtolower($headersArr['auto-submitted'] ?? '');

            $isBounce = false;

            if (
                str_contains($fromLower, 'mailer-daemon@') ||
                str_contains($fromLower, 'postmaster@') ||
                str_contains($subjectLower, 'mail delivery failed') ||
                str_contains($subjectLower, 'undelivered mail returned to sender') ||
                $autoSubmitted === 'auto-replied'
            ) {
                $isBounce = true;
            }

            if ($isBounce) {
                $message->setFlag('Seen');
                continue;
            }

            $bodyText = trim($message->getTextBody() ?? '');
            $bodyHtml = $message->getHTMLBody() ?? null;

            $thread        = null;
            $parentMessage = null;

            if ($inReplyTo) {
                $parentMessage = EmailMessage::where('message_id', $inReplyTo)->first();
            }

            if (!$parentMessage && $referencesHeader) {
                if (is_array($referencesHeader)) {
                    $referencesHeader = implode(' ', $referencesHeader);
                }

                $parts = preg_split('/\s+/', (string) $referencesHeader);
                $parts = array_filter($parts);
                $last  = $parts ? trim(end($parts)) : null;

                if ($last) {
                    $parentMessage = EmailMessage::where('message_id', $last)->first();
                }
            }

            if ($parentMessage) {
                $thread = $parentMessage->thread;
            }

            if (!$thread && $subject) {
                $thread = EmailThread::where('subject', $subject)->first();
            }

            if (!$thread && !$parentMessage) {
                $message->setFlag('Seen');
                continue;
            }

            if (!$thread) {
                $thread = EmailThread::create([
                    'subject'         => $subject,
                    'root_message_id' => $inReplyTo ?: $messageId,
                ]);
            }

            $exists = EmailMessage::where('message_id', $messageId)->exists();
            if ($exists) {
                $message->setFlag('Seen');
                continue;
            }

            $sentAt = null;
            $date   = $message->getDate();
            if ($date) {
                $sentAt = Carbon::parse($date);
            }

            $ccList  = $message->getCc() ?? [];
            $bccList = $message->getBcc() ?? [];

            $cc = collect($ccList)
                ->map(function ($addr) {
                    return $addr->mail ?? null;
                })
                ->filter()
                ->values()
                ->all();

            $bcc = collect($bccList)
                ->map(function ($addr) {
                    return $addr->mail ?? null;
                })
                ->filter()
                ->values()
                ->all();

            EmailMessage::create([
                'email_thread_id' => $thread->id,
                'email_send_id'   => $parentMessage ? $parentMessage->email_send_id : null,
                'direction'       => 'inbound',
                'from_email'      => $from,
                'to_email'        => $to,
                'cc'              => $cc,
                'bcc'             => $bcc,
                'subject'         => $subject,
                'body_html'       => $bodyHtml,
                'body_text'       => $bodyText,
                'message_id'      => $messageId,
                'in_reply_to'     => $inReplyTo,
                'sent_at'         => $sentAt,
                'received_at'     => now(),
                'provider'        => 'imap',
                'raw_headers'     => $headersArr,
            ]);

            $message->setFlag('Seen');
        }

        $client->disconnect();
    }
}
