<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends BaseVerifyEmail
{
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject(__('notifications.verify_email_subject').config('app.name'))
            ->view('emails.verify-email', [
                'verificationUrl' => $verificationUrl,
            ]);
    }
}
