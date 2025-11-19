<?php

namespace App\Mail;

use App\Models\FrontOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
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
        if($this->receiver == 'customer'){

            return $this->subject('[Training4Employment]: Order Confirmation')
                ->view('emails.order_confirmation')
                ->with([
                    'order' => $this->order
                ]);

        } else {

            return $this->subject('[Training4Employment]: New order #'.$this->order->id)
                ->view('emails.admin_order_confirmation')
                ->with([
                    'order' => $this->order
                ]);
        }

    }
}
