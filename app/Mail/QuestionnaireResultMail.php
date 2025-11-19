<?php

namespace App\Mail;

use App\Models\Questionnaire;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuestionnaireResultMail extends Mailable
{
    use Queueable, SerializesModels;

    public $questionnaire;

    public function __construct(Questionnaire $questionnaire)
    {
        $this->questionnaire = $questionnaire;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('[Training4Employment]: New Questionnaire Submission')
            ->view('emails.questionnaire_result_admin');
    }
}
