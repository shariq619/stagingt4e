<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LearnerFeedbackRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $last_name;

    public function __construct($name)
    {
        $this->name = $name;
        //$this->last_name = $last_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Upcoming Courses & Partner Program | Training 4 Employment')
            ->markdown('emails.learners.feedback-request')
            ->attach(public_path('frontend/pdf/T4E_CourseCourseDates.pdf'), [
                'as' => 'CourseDates.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}
