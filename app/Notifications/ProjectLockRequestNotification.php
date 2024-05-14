<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectLockRequestNotification extends Notification
{
    use Queueable;
    protected $project;
    protected $creator;
    protected $authUser;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($project, $creator, $authUser)
    {
        $this->project = $project;
        $this->creator = $creator;
        $this->authUser = $authUser;
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
                ->markdown('mail.project_lock_request', ['project' => $this->project, 'creator' => $this->creator, 'authUser' => $this->authUser]);
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
