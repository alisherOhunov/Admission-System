<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword
{
    public function toMail($notifiable)
    {
        $actionUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject(__('notifications.reset_password_subject').config('app.name'))
            ->view('emails.password-reset', [
                'actionUrl' => $actionUrl,
                'notifiable' => $notifiable,
            ]);
    }
}
