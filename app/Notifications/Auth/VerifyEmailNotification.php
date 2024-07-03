<?php

namespace App\Notifications\Auth;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;

class VerifyEmailNotification extends Notification
{
    public static $toMailCallback;

    public function __construct()
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
        );
    }

    public function toMail($notifiable)
    {
        $locale = app()->getLocale();

        if (!in_array($locale, ['en', 'ch'])) {
            $locale = 'en';
        }

        app()->setLocale($locale);

        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->view('mail.auth.verify_email', [
                'url' => $verificationUrl,
                'name' => $notifiable->name,
            ])
            ->subject(trans('verification.verify_email_subject'));
    }
}
