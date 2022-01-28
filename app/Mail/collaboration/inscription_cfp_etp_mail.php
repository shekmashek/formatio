<?php

namespace App\Mail\collaboration;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class inscription_cfp_etp_mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nom_cfp, $nom_resp_cfp, $prenom_resp_cfp, $email_resp_cfp)
    {
        $this->nom_cfp = $nom_cfp;
        $this->nom_resp_cfp = $nom_resp_cfp;
        $this->prenom_resp_cfp = $prenom_resp_cfp;
        $this->email_resp_cfp = $email_resp_cfp;
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
            ->view('collaboration.mail.invitation_create_new_compte_cfp_etp_mail')
            ->with([
                'nom_cfp' => $this->nom_cfp,
                'prenom_resp_cfp' => $this->prenom_resp_cfp,
                'nom_resp_cfp' => $this->nom_resp_cfp,
                'email_resp_cfp' => $this->email_resp_cfp
            ]);
    }
}
