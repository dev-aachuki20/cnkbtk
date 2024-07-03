<?php

namespace App\Notifications\Auth;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;

class VerifyEmail extends VerifyEmailNotification
{
    public function toMail($notifiable)
    {
        $locale = app()->getLocale();

        if (! in_array($locale, ['en', 'ch'])) {
            $locale = 'en';
        }

        app()->setLocale($locale);


        return (new MailMessage)
        ->subject(trans('verification.subject'))
        ->greeting(trans('verification.greeting'))
        ->line(trans('verification.line1'))
        ->action(trans('verification.action'), $this->verificationUrl($notifiable))
        ->line(trans('verification.line2'))
        ->salutation(trans('verification.salutation', ['app_name' => config('app.name')]));
        // ->line(trans('verification.copy'))
        // ->line(trans('verification.trouble'))
        // ->line($this->verificationUrl($notifiable));
        
    }
}
