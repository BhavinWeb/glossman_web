<?php

namespace App\Notifications\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPlacedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    //<!-- ❀❀❀❀❀❀❀❀❀❀ This Notification For Admin From Customer About Order Placed ❀❀❀❀❀❀❀❀❀❀ -->
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $admin, $order;
    public function __construct($admin, $order)
    {
        $this->admin = $admin;
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
            'title' => 'A new order request is available to process !',
            'admin' => $this->admin,
            'order' => $this->order,
        ];
    }
}
