<?php

namespace App\Notifications\Frontend\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;
    //<!-- ❀❀❀❀❀❀❀❀❀❀ This Notification For Customer From Admin About Order Placed/Status ❀❀❀❀❀❀❀❀❀❀ -->

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $user, $order;
    public function __construct($user, $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $title = '';
        if ($this->order->order_status == 'pending') {
            $title = 'Your order successfully placed !';
        }
        if ($this->order->order_status == 'processing') {
            $title = 'Your order is now processing !';
        }
        if ($this->order->order_status == 'on_the_way') {
            $title = 'Your order is now in on the way !';
        }
        if ($this->order->order_status == 'delivered') {
            $title = 'Your order has been delivered !';
        }
        if ($this->order->order_status == 'cancelled') {
            $title = 'Your order has been cancelled !';
        }

        return (new MailMessage)
            ->greeting("Hello " . $this->user->name . " !")
            ->subject($title)
            ->line($title)
            ->line("This is your order number : " . $this->order->order_no)
            ->action('View Order', route('website.track.order.detail', ['order' => $this->order->order_no]))
            ->line('Thank you for using our ' . config('app.name') . '!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
