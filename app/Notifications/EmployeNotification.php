<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class EmployeNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

   
    public function via($notifiable)
    {
        return ['mail'];
    }

 
   
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line($notifiable->name.' C est nouvellement inscrit sur la plateforme. Veuillez activer son compte')
                    ->action('Voir le profil', url('/show',['uuid' => $notifiable]));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
  
}
