<?php

namespace App\Mail;

use App\Models\Cohort;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LearnerReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $incompleteItems;
    public $cohort;

    public function __construct(User $user, array $incompleteItems, Cohort $cohort)
    {
        $this->user = $user;
        $this->incompleteItems = $incompleteItems;
        $this->cohort = $cohort;
    }

    public function build()
    {
        return $this->subject('Reminder: Incomplete Course Requirements')
            ->markdown('emails.learner_reminder');
    }
}
