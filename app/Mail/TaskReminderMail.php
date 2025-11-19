<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cohort, $learner, $incompleteTasks, $reminderDate;

    public function __construct($cohort, $learner, $incompleteTasks, $reminderDate)
    {
        $this->cohort = $cohort;
        $this->learner = $learner;
        $this->incompleteTasks = $incompleteTasks;
        $this->reminderDate = $reminderDate;
    }

    public function build()
    {
        return $this->subject('Reminder: Complete Your Tasks for Upcoming Cohort')
            ->view('emails.task_reminder');
    }
}
