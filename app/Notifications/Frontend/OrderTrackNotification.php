<?php

namespace App\Notifications\Frontend;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderTrackNotification extends Notification implements ShouldQueue
{
    use Queueable;
    //<!-- ❀❀❀❀❀❀❀❀❀❀ This Notification For Order From Admin About Order Status Change ❀❀❀❀❀❀❀❀❀❀ -->
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $title, $order;
    public function __construct($title, $order)
    {
        $this->title = $title;
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
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        //
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
            'title' => $this->title,
            'order' => $this->order,
        ];
    }
}
