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
    public function __construct($name,$objet,$msg,$entreprise,$email)
    {
        $this->name = $name;
        $this->objet = $objet;
        $this->msg = $msg;
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
        return $this->from($this->email)
        ->subject('formation.mg')
        ->view('emails.contact_email')
        ->with([
            'name' => $this->name,
            'objet' => $this->objet,
            'email' => $this->email,
            'entreprise' => $this->entreprise,
            'msg' => $this->msg

        ]);
    }
}
