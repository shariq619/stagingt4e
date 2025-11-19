<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeadFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($leadData)
    {
        $this->leadData = $leadData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Lead Form Submission')
            ->view('emails.lead_form_submitted')
            ->with('leadData', $this->leadData);
    }
}
