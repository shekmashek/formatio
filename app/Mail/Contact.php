<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\User;


class ConvocationStagiaire extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($name,$objet,$message,$entreprise,$email)
    {
        $this->name = $name;
        $this->objet = $objet;
        $this->message = $message;
        $this->entreprise = $entreprise;
        $this->email = $email;
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->from('contact@formation.mg')
                    ->subject('Message du site formation.mg')
                    ->view('emails.contact_email')
                    ->with([
                        'name' => $this->name,
                        'objet' => $this->objet,
                        'email' => $this->email,
                        'entreprise' => $this->entreprise,
                        'message' => $this->message

                    ]);
                 

    }
}
