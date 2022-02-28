<?php

namespace App\Mail\collaboration;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class invitation_etp_cfp_mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nom_etp, $responsables_etp, $nom_resp_cfp,$email_destinataire)
    {
        $this->nom_etp = $nom_etp;
        $this->responsables_etp = $responsables_etp;
        $this->nom_resp_cfp = $nom_resp_cfp;
        $this->email_destinataire = $email_destinataire;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email_destinataire)
            ->subject('Invitation de collaboration')
            ->view('collaboration.mail.invitation_collaborer_etp_cfp_mail')
            ->with([
                'nom_etp' => $this->nom_etp,
                'responsables_etp' => $this->responsables_etp,
                'nom_resp_cfp' => $this->nom_resp_cfp
            ]);
    }
}
