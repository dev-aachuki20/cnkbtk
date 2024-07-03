<?php

namespace App\Notifications\Auth;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends \Illuminate\Auth\Notifications\ResetPassword
{
    public function toMail($notifiable)
    {
        $locale = app()->getLocale();

        if (! in_array($locale, ['en', 'ch'])) {
            $locale = 'en';
        }

        app()->setLocale($locale);


        return (new MailMessage)
        ->subject(trans('passwords.reset_email_subject'))
        ->greeting(trans('passwords.reset_email_line1', ['name' => $notifiable->name]))
        ->line(trans('passwords.reset_email_line2'))
        ->line(trans('passwords.reset_email_line3'))
        ->action(trans('passwords.reset_email_button'), url(config('app.url').route('password.reset', $this->token, false)))
        ->line(trans('passwords.reset_email_line4'))
        ->line(trans('passwords.reset_email_notice', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
        // ->line(trans('passwords.reset_email_ignore'))
        ->salutation(trans('passwords.reset_email_salutation', ['app_name' => config('app.name')]));
        // ->line(trans('passwords.email_copyright'))
        // ->line(trans('passwords.email_trouble_message'))
        // ->line(url(config('app.url').route('password.reset', $this->token, false)));
        
    }
}
