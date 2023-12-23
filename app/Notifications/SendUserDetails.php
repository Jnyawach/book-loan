<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendUserDetails extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $temp_pass;
    public function __construct($temp_pass)
    {
        //
        $this->temp_pass=$temp_pass;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Account creation')
            ->line('Dear ' . $notifiable->name)
            ->line('An account has been created for you at Book loans.')
            ->line('Your temporary password is: ' . $this->temp_pass)
            ->line('Please change your password after login.')
            ->action('Login here', route('login'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
