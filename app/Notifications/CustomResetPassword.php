<?php

// app/Notifications/CustomResetPassword.php

// app/Notifications/CustomResetPassword.php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends ResetPasswordNotification implements ShouldQueue
{
    use Queueable;

    public function toMail($notifiable)
    {
        $url = url(config('app.url') . route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false));

        return (new MailMessage)
            ->subject('Your Password Reset Link')
            ->view('vendor.notifications.email', [ // Update the view name to point to your template
                'greeting' => 'Hello!',
                'level' => 'primary',
                'introLines' => [
                    'You are receiving this email because we received a password reset request for your account.',
                ],
                'actionText' => 'Reset Password',
                'actionUrl' => $url,
                'outroLines' => [
                    'This password reset link will expire in ' . config('auth.passwords.' . config('auth.defaults.passwords') . '.expire') . ' minutes.',
                    'If you did not request a password reset, no further action is required.',
                ],
                'salutation' => 'Regards,',
                'displayableActionUrl' => $url,
            ]);
    }
}
