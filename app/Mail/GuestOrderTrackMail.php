<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GuestOrderTrackMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->order['order_status'] == 'pending') {
            $title = 'Your order successfully placed !';
        }
        if ($this->order['order_status'] == 'processing') {
            $title = 'Your order is now processing !';
        }
        if ($this->order['order_status'] == 'on_the_way') {
            $title = 'Your order is now in on the way !';
        }
        if ($this->order['order_status'] == 'delivered') {
            $title = 'Your order has been delivered !';
        }
        if ($this->order['order_status'] == 'cancelled') {
            $title = 'Your order has been cancelled !';
        }

        return $this->subject($title)
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->markdown('mails.guest-order-track', [
                'title' => $title
            ]);
    }
}
