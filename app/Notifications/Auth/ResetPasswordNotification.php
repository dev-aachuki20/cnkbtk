<?php

namespace App\Notifications\Auth;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $locale = app()->getLocale();

        if (! in_array($locale, ['en', 'ch'])) {
            $locale = 'en';
        }

        app()->setLocale($locale);

        return (new MailMessage)
            ->subject(trans('passwords.reset_email_subject'))
            ->view('mail.auth.reset_password', [
                'notifiable' => $notifiable,
                'token' => $this->token
            ]);
    }
}
