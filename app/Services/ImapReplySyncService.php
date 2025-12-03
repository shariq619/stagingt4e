<?php

namespace App\Services\Email;

use App\Models\EmailMessage;
use App\Models\EmailThread;
use App\Models\EmailSend;
use Carbon\Carbon;
use Webklex\IMAP\Facades\Client;
use Webklex\PHPIMAP\Message;

class ImapReplySyncService
{
    protected array $accounts = ['support', 'sales'];

    public function syncAll(): void
    {
        foreach ($this->accounts as $account) {
            $this->syncAccount($account);
        }
    }

    protected function syncAccount(string $account): void
    {
        $client = Client::account($account);

        try {
            $client->connect();
        } catch (\Throwable $e) {
            return;
        }

        $folderName = 'INBOX';
        try {
            $folder = $client->getFolder($folderName);
        } catch (\Throwable $e) {
            return;
        }

        $messages = $folder->query()
            ->since(Carbon::now()->subDays(7))
            ->unseen()
            ->get();

        foreach ($messages as $message) {
            $this->handleMessage($account, $message);
        }
    }

    protected function handleMessage(string $account, Message $message): void
    {
        $messageId       = $message->getMessageId();
        if (!$messageId) {
            return;
        }

        $existing = EmailMessage::where('message_id', $messageId)->first();
        if ($existing) {
            return;
        }

        $subject         = $message->getSubject() ?? '';
        $fromObj         = $message->getFrom()[0] ?? null;
        $fromEmail       = $fromObj ? ($fromObj->mail ?? null) : null;
        $toObj           = $message->getTo()[0] ?? null;
        $toEmail         = $toObj ? ($toObj->mail ?? null) : null;
        $inReplyTo       = $message->getInReplyTo();
        $referencesArray = $message->getReferences() ?? [];
        $references      = is_array($referencesArray) ? $referencesArray : [];
        $bodyHtml        = $message->getHTMLBody();
        $bodyText        = $message->getTextBody() ?? strip_tags($bodyHtml);

        $thread = null;

        if ($inReplyTo) {
            $thread = $this->findThreadByMessageId($inReplyTo, $references);
        }

        if (!$thread) {
            $thread = $this->findThreadBySubjectAndAddress($subject, $fromEmail, $toEmail);
        }

        if (!$thread) {
            $thread = EmailThread::create([
                'subject'            => $subject,
                'root_message_id'    => $inReplyTo ?: $messageId,
                'created_by_user_id' => null,
            ]);
        }

        EmailMessage::create([
            'email_thread_id' => $thread->id,
            'email_send_id'   => null,
            'direction'       => 'inbound',
            'from_email'      => $fromEmail,
            'to_email'        => $toEmail,
            'cc'              => [],
            'bcc'             => [],
            'subject'         => $subject,
            'body_html'       => $bodyHtml,
            'body_text'       => $bodyText,
            'message_id'      => $messageId,
            'in_reply_to'     => $inReplyTo,
            'sent_at'         => $message->getDate() ? Carbon::parse($message->getDate()) : null,
            'received_at'     => Carbon::now(),
            'provider'        => 'imap_' . $account,
            'raw_headers'     => null,
        ]);

        try {
            $message->setFlag('Seen');
        } catch (\Throwable $e) {
        }
    }

    protected function findThreadByMessageId(?string $inReplyTo, array $references)
    {
        if ($inReplyTo) {
            $msg = EmailMessage::where('message_id', $inReplyTo)->first();
            if ($msg && $msg->thread) {
                return $msg->thread;
            }

            $send = EmailSend::where('provider_message_id', $inReplyTo)->first();
            if ($send && $send->thread) {
                return $send->thread;
            }
        }

        if (!empty($references)) {
            $msg = EmailMessage::whereIn('message_id', $references)->first();
            if ($msg && $msg->thread) {
                return $msg->thread;
            }

            $send = EmailSend::whereIn('provider_message_id', $references)->first();
            if ($send && $send->thread) {
                return $send->thread;
            }
        }

        return null;
    }

    protected function findThreadBySubjectAndAddress(string $subject, ?string $fromEmail, ?string $toEmail)
    {
        if (!$fromEmail && !$toEmail) {
            return null;
        }

        $query = EmailThread::query()
            ->where('subject', $subject);

        $thread = $query->first();

        return $thread;
    }
}
