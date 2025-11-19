<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageSent extends Mailable
{
    use Queueable, SerializesModels;

    public $messageData;

    /**
     * Create a new message instance.
     */
    public function __construct($messageData)
    {
        $this->messageData = $messageData;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $email = $this->subject($this->messageData['subject'])
            ->view('emails.message_sent') // HTML email view
            ->with('messageData', $this->messageData);

        // Check if there are attachments and attach them
        if (!empty($this->messageData['attachments'])) {
            foreach ($this->messageData['attachments'] as $attachment) {
                $email->attach($attachment); // Attach the file
            }
        }

        return $email;
    }
}
