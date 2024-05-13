<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectUpdatedNotification extends Notification
{
    use Queueable;
    protected $project;
    protected $creator;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($project, $creator)
    {
        $this->project = $project;
        $this->creator = $creator;
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
        if ($this->creator->id) {
            return (new MailMessage)
                ->markdown('mail.project_update_notification', ['project' => $this->project, 'creator' => $this->creator]);
        }
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
