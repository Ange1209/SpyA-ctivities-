<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DemandeNotification extends Notification
{
    use Queueable;

    public $demande;

    public function __construct( $demande)
    {
        $this->demande = $demande;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
         $this->demande;

        return (new MailMessage)
                    ->line(' Une demande à été envoyé par Mr/Mme  '.$notifiable->name .'vous pouvez voir la demande en cliquant sur le boutton ci dessous')
                    ->action('Voir', url('/showRead', ['item' => $this->demande]));
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
   
 
}
