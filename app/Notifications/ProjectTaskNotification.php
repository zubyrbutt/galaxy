<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ProjectTaskNotification extends Notification
{
    use Queueable;
    private $taskinfo;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->taskinfo = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if(isset($this->taskinfo['redirectURL'])){
            $redirectURL=$this->taskinfo['redirectURL'];
        }else{
            $redirectURL=url('/'); 
        }
        return (new MailMessage)
                    ->subject($this->taskinfo['title'])
                    ->greeting('Hi '. $notifiable->fname.' '. $notifiable->lname.',' )
                    ->line($this->taskinfo['body'])
                    ->action('Notification Action', $redirectURL);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    /*public function toArray($notifiable)
    {
        return [
            'letter' => $this->leadinfo
        ];
    }*/

    public function toDatabase($notifiable)
    {
        return [
            'letter' => $this->taskinfo
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'letter' => $this->taskinfo,
            'count' => $notifiable->unreadNotifications->count(),
        ]);
    }
}
