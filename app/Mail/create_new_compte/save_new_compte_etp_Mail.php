<?php

namespace App\Mail\create_new_compte;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class save_new_compte_etp_Mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nom_resp, $email_resp,$nom_etp)
    {
        $this->nom_resp = $nom_resp;
        $this->email_resp = $email_resp;
        $this->nom_etp = $nom_etp;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contact@formation.mg')
            ->subject('Compte crée avec success')
            ->view('collaboration.mail.save_new_compte_etp_Mail')
            ->with([
                'nom_resp' => $this->nom_resp,
                'email_resp' => $this->email_resp,
                'nom_etp' => $this->nom_etp
            ]);
    }
}
