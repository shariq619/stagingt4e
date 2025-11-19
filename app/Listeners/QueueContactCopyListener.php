<?php

namespace App\Listeners;

use App\Jobs\SendContactCopyJob;
use App\Models\User;
use App\Models\UserContact;
use Illuminate\Mail\Events\MessageSent;

class QueueContactCopyListener
{
    public function handle(MessageSent $event): void
    {
        $message = $event->message;

        $headers = $message->getHeaders();
        if ($headers && $headers->has('X-Contact-Copy')) {
            return;
        }

        $to = $message->getTo() ?: [];
        $originalRecipients = array_keys($to);

        if (empty($originalRecipients)) {
            return;
        }

        $subject = $message->getSubject() ?? '';
        $body    = $message->getBody() ?? '';
        $user = User::where('email', $originalRecipients[0] ?? null)->first();

        if (!$user) {
            return;
        }

        $primaryEmail = strtolower(trim($user->email));

        $contacts = UserContact::query()
            ->where('user_id', $user->client_id)
            ->where('opt_out', 0)
            ->pluck('direct_email')
            ->filter()
            ->all();

        if (empty($contacts)) {
            return;
        }

        $normalizedOriginals = array_map(function ($e) {
            return strtolower(trim($e));
        }, $originalRecipients);


        $contactEmails = collect($contacts)
            ->map(fn($e) => trim($e))
            ->filter(function ($email) use ($primaryEmail, $normalizedOriginals) {
                $norm = strtolower($email);

                if ($norm === $primaryEmail) {
                    return false;
                }

                if (in_array($norm, $normalizedOriginals, true)) {
                    return false;
                }

                return true;
            })
            ->unique()
            ->values()
            ->all();

        if (empty($contactEmails)) {
            return;
        }

        $attachments = [];
        try {
            if ($message instanceof \Swift_Message) {
                foreach ($message->getChildren() as $child) {
                    if ($child instanceof \Swift_Attachment) {
                        $name = $child->getFilename() ?? 'attachment';
                        $tempPath = storage_path('app/tmp_mail_' . uniqid() . '_' . $name);

                        file_put_contents($tempPath, $child->getBody());

                        $attachments[] = [
                            'path' => $tempPath,
                            'name' => $name,
                        ];
                    }
                }
            }
        } catch (\Throwable $e) {
            $attachments = [];
        }

        foreach ($contactEmails as $email) {
            SendContactCopyJob::dispatch(
                $email,
                $subject,
                $body,
                $attachments,
                $originalRecipients
            )->delay(now()->addSeconds( 5));
        }
    }
}
