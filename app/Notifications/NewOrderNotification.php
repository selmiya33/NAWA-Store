<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class NewOrderNotification extends Notification
{
    use Queueable;
/**
 * @var \App\Models\Order
 */
    protected $order;

    /**
     * Create a new notification instance.
     */

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // $notifiable الشخص الي ح يستقبل الرسالة
        //mail - Database - vonage(sms) - slack - twillo (sms) -telegram
        //laravel notification chanels
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('New Order #' . $this->order->id)
                    ->greeting('hello '. $notifiable->name)
                    ->line('a new order has been created')
                    ->action('View order', route('orders.show',$this->order->id))

                    ->line('Thank you !!');
    }

    public function toDatabase(object $notifiable): DatabaseMessage
    {
        return new DatabaseMessage([
            'body'=>"A new order # {$this->order->id} has been created",
            'icon' =>'fas fa-envelope',
            'link' => route('orders.show',$this->order->id),
        ]);
    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
