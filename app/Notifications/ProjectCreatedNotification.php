<?php

namespace App\Notifications;

use App\Models\Project;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectCreatedNotification extends Notification
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
                ->markdown('mail.new_project_notification', ['project' => $this->project, 'creator' => $this->creator]);
        }


        // if ($notifiable->id === $this->creator->id) {
        //     // Customize email content for the creator
        //     return (new MailMessage)
        //         ->line('Hello ' . $notifiable->name . ',')
        //         ->line('A new project has been created by you.')
        //         ->action('View Project', url('/projects/' . $this->project->id))
        //         ->line('Thank you for using our application!');
        // } else {
        //     // Customize email content for other users
        //     return (new MailMessage)
        //         ->line('Hello ' . $notifiable->name . ',')
        //         ->line('A new project has been created by ' . $this->creator->name . '.')
        //         ->action('View Project', url('/projects/' . $this->project->id))
        //         ->line('Thank you for using our application!');
        // }
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
