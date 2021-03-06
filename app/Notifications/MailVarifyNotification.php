<?php

namespace App\Notifications;

use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class MailVarifyNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }

        return (new MailMessage)
            ->subject('Complete Registration')
            ->line("Thank you for signing up with us!")
            ->line("You're almost done! Complete your registration and verify your account by clicking on following button:")
            ->action(
                'Complete Registration',
                $this->verificationUrl($notifiable)
            )
            ->line('If you did not create an account, no further action is required.')
            ->line('If you’re having trouble clicking the "Complete Registration" button, copy and paste the URL below into your web browser: ');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array
     */
    public function toArray()
    {
        return [];
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  Closure  $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify', Carbon::now()->addMinutes(60), ['id' => $notifiable->getKey()]
        );
    }
}
