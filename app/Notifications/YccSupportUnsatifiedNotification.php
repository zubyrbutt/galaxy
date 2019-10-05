<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
class YccSupportUnsatifiedNotification extends Notification
{
    use Queueable;
    private $notificationInfo;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($information)
    {
        $this->notificationInfo = $information;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','broadcast','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->notificationInfo['title'])
            ->greeting('Hi '. $notifiable->fname.' '. $notifiable->lname.',' )
            ->line($this->notificationInfo['body'])
            ->action('Notification Action', $this->notificationInfo['redirectURL']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'letter' => $this->notificationInfo
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'letter' => $this->notificationInfo,
            'count' => $notifiable->unreadNotifications->count(),
        ]);
    }
}
