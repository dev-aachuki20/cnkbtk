<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class BidUpdatedNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $creator;
    protected $bid;
    protected $project;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($creator, $bid, $project)
    {
        $this->creator = $creator;
        $this->bid = $bid;
        $this->project = $project;
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
            ->markdown('mail.bid_update', ['creator' => $this->creator, 'bid' => $this->bid, 'project' => $this->project]);
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
