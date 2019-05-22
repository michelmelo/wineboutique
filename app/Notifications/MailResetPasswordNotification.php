<?php

namespace App\Notifications;

use Closure;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MailResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     * @return void
     */
    public $token;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var Closure|null
     */
    public static $toMailCallback;

    /**
     * Create a notification instance.
     *
     * @param string $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via()
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return MailMessage
     */
    public function toMail()
    {
        return (new MailMessage)
            ->subject('Reset Password Notification')
            ->line('We have received your rquest to reset your account password. Please use the link below to set up a new password for your account.')
            ->action('Reset Password', route('password.reset', $this->token))
            ->line('If you did not request to reset your password, please ignore this email and the link will automatically expire.')
            ->line('If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: ');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }

    public function toArray()
    {
        return [];
    }
}
