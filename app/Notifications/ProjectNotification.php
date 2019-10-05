<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ProjectNotification extends Notification
{
    use Queueable;
    private $projectinfo;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($letter)
    {
        $this->projectinfo = $letter;
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
        /*echo "<pre>";
        print_r($this->leadinfo);
        echo $this->leadinfo['title'];
        echo $this->leadinfo['body'];
        print_r($notifiable);
        exit;*/
        if(isset($this->projectinfo['redirectURL'])){
            $redirectURL=$this->projectinfo['redirectURL'];
        }else{
            $redirectURL=url('/'); 
        }
        return (new MailMessage)
                    ->subject($this->projectinfo['title'])
                    ->greeting('Hi '. $notifiable->fname.' '. $notifiable->lname.',' )
                    ->line($this->projectinfo['body'])
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
            'letter' => $this->projectinfo
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'letter' => $this->projectinfo,
            'count' => $notifiable->unreadNotifications->count(),
        ]);
    }
}
