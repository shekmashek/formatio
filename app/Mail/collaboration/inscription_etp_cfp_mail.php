<?php

namespace App\Mail\collaboration;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class inscription_etp_cfp_mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nom_etp, $nom_resp, $prenom_resp, $email_resp)
    {
        $this->nom_etp = $nom_etp;
        $this->nom_resp = $nom_resp;
        $this->prenom_resp = $prenom_resp;
        $this->email_resp = $email_resp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contact@formation.mg')
            ->subject('Invitation de collaboration')
            ->view('collaboration.mail.invitation_create_new_compte_etp_cfp_mail')
            ->with([
                'nom_etp' => $this->nom_etp,
                'prenom_resp' => $this->prenom_resp,
                'nom_resp' => $this->nom_resp,
                'email_resp' => $this->email_resp
            ]);
    }
}
