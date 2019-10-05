<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class RecordingNotification extends Notification
{
    use Queueable;
    private $recordinginfo;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->recordinginfo = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if(isset($this->recordinginfo['redirectURL'])){
            $redirectURL=$this->recordinginfo['redirectURL'];
        }else{
            $redirectURL=url('/'); 
        }
        return (new MailMessage)
                    ->subject($this->recordinginfo['title'])
                    ->greeting('Hi '. $notifiable->fname.' '. $notifiable->lname.',' )
                    ->line($this->recordinginfo['body'])
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
            'letter' => $this->recordinginfo
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'letter' => $this->recordinginfo,
            'count' => $notifiable->unreadNotifications->count(),
        ]);
    }
}
