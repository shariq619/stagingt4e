<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Training 4 Employment Hub Access';

        // for learner with T&C
        if ($this->user->hasRole('Learner')) {

            $pdfPath = public_path('resources/T4E_ Booking Terms and Conditions_v.3.2_2024.pdf');

            return $this->subject($subject)->view('emails.welcome_learners')
                ->with([
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                    'password' => $this->password,
                ])
                ->attach($pdfPath, [
                    'as' => 'Booking_Terms_and_Conditions.pdf', // Optional: Rename the file
                    'mime' => 'application/pdf',
                ]);


        } else {

            return $this->subject($subject)->view('emails.welcome')
                ->with([
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                    'password' => $this->password,
                ]);
        }


    }
}
