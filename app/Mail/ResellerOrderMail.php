<?php

namespace App\Mail;

use App\Models\FrontOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResellerOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $receiver;

    /**
     * Create a new message instance.
     *
     * @param FrontOrder $order
     */
    public function __construct(FrontOrder $order, $receiver)
    {
        $this->order = $order;
        $this->receiver = $receiver;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('[Training4Employment]: Reseller New order #' . $this->order->id)
            ->view('emails.reseller_order')
            ->with([
                'order' => $this->order
            ]);

    }
}
