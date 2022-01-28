<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
<<<<<<< HEAD
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
=======
    public function __construct($name,$objet,$msg,$entreprise,$mail)
    {
        $this->name = $name;
        $this->objet = $objet;
        $this->msg = $msg;
        $this->entreprise = $entreprise;
        $this->mail = $mail;
    }

    /**
     * Build the msg.
>>>>>>> contact
     *
     * @return $this
     */
    public function build()
    {
<<<<<<< HEAD
        return $this->from('contact@formation.mg')
        ->subject('Message du site formation.mg')
=======
        return $this->from($this->email)
        ->subject('formation.mg')
>>>>>>> contact
        ->view('emails.contact_email')
        ->with([
            'name' => $this->name,
            'objet' => $this->objet,
<<<<<<< HEAD
            'email' => $this->email,
            'entreprise' => $this->entreprise,
            'message' => $this->message

=======
            'mail' => $this->mail,
            'entreprise' => $this->entreprise,
            'msg' => $this->msg
>>>>>>> contact
        ]);
    }
}
