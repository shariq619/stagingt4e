<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $expiryTime;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($otp)
    {
        $this->otp = $otp;
        $this->expiryTime = now()->addMinutes(2)->format('h:i A');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your OTP Code for Password Reset -' . config('app.name'))
        ->markdown('emails.api.otp')
        ->with([
            'otp' => $this->otp,
            'expiryTime' => $this->expiryTime,
        ]);
    }
}
