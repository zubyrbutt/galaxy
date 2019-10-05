<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ComplaintNotification extends Notification
{
    use Queueable;
    private $complaintinfo;
 
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($letter)
    {
        $this->complaintinfo = $letter;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //return ['mail'];
        //return ['database','broadcast'];
        return ['mail','database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if(isset($this->complaintinfo['redirectURL'])){
            $redirectURL=$this->complaintinfo['redirectURL'];
        }else{
            $redirectURL=url('/'); 
        }
        return (new MailMessage)
                    ->subject($this->complaintinfo['title'])
                    ->greeting('Hi '. $notifiable->fname.' '. $notifiable->lname.',' )
                    ->line($this->complaintinfo['body'])
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
            'letter' => $this->complaintinfo
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'letter' => $this->complaintinfo,
            'count' => $notifiable->unreadNotifications->count(),
        ]);
    }
}
