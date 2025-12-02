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

        if ($message->getHeaders()->has('X-Contact-Copy')) {
            return;
        }

        $to = $message->getTo() ?: [];
        $originalRecipients = array_keys($to);

        if (empty($originalRecipients)) {
            return;
        }

        $subject = $message->getSubject() ?? '';
        $body    = $message->getBody() ?? '';

        $user = User::where('email', $originalRecipients[0])->first();
        if (!$user) {
            return;
        }

        $primaryEmail = strtolower(trim($user->email));

        $contacts = UserContact::where('user_id', $user->client_id)
            ->where('opt_out', 0)
            ->pluck('direct_email')
            ->filter()
            ->all();

        if (empty($contacts)) {
            return;
        }

        $normalizedOriginals = array_map(
            fn($e) => strtolower(trim($e)),
            $originalRecipients
        );

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

        foreach ($contactEmails as $email) {
            SendContactCopyJob::dispatch(
                $email,
                $subject,
                $body,
                $attachments,
                $originalRecipients
            )->delay(now()->addSeconds(5));
        }
    }
}
