<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BespokeRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $requestBespoke;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($requestBespoke)
    {
        $this->requestBespoke = $requestBespoke;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Bespoke Request Received')
                    ->view('emails.bespoke_request')
                    ->with('data', $this->requestBespoke);
    }
}
