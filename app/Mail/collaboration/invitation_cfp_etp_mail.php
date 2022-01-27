<?php

namespace App\Mail\collaboration;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class invitation_cfp_etp_mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nom_cfp, $responsables_cfp, $nom_resp_etp)
    {
        $this->nom_cfp = $nom_cfp;
        $this->responsables_cfp = $responsables_cfp;
        $this->nom_resp_etp = $nom_resp_etp;
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
            ->view('collaboration.mail.invitation_collaborer_cfp_etp_mail')
            ->with([
                'nom_cfp' => $this->nom_cfp,
                'responsables_cfp' => $this->responsables_cfp,
                'nom_resp_etp' => $this->nom_resp_etp
            ]);
    }
}
