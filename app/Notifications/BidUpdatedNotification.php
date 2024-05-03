<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BidUpdatedNotification extends Notification
{
    use Queueable;
    protected $creator;
    protected $bid;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($creator, $bid)
    {
        $this->creator = $creator;
        $this->bid = $bid;
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

        return (new MailMessage)
            ->line('The bid for the project has been updated.')
            ->line('Creator: ' . $this->creator->user_name)
            ->line('Bid: ' . $this->bid . config("constant.currency.rmb"));
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
