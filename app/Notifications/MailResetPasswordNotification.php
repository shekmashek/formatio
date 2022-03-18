<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailResetPasswordNotification extends Notification
{
    use Queueable;
    public $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return (new MailMessage)
        //             ->line('The introduction to the notification.')
        //             ->action('Notification Action', url('/'))
        //             ->line('Thank you for using our application!');
        $token = $this->token;
        // $link = url( "/password/reset/?token=" . $this->token );
        return (new MailMessage)
        ->view('reset.emailer',compact('token'))
        ->from('contact@formation.mg')
        ->subject( 'Réinitialiser votre mot de passe' )
        ->line( "
         Vous recevez cet e-mail car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.
         réinitialiser le mot de passe
         Ce lien de réinitialisation de mot de passe expirera dans 60 minutes.
         Si vous n'avez pas demandé de réinitialisation de mot de passe, aucune autre action n'est requise." )
        // ->action( 'Réinitialiser le mot de passe', $link )

        ->line( 'Cordialement!' );
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
}
