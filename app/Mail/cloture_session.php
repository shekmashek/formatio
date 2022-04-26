<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class cloture_session extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_acteur,$name_session,$name_etp,$name_cfp,$date_debut,$date_fin)
    {
        $this->name_session = $name_session;
        $this->name_etp = $name_etp;
        $this->name_cfp = $name_cfp;
        $this->mail_acteur = $mail_acteur;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->mail_acteur)
        ->subject('Cloture : session de formation')
        ->view('emails.cloture_session')
        ->with([
            'name_session' => $this->name_session,
            'name_etp' => $this->name_etp,
            'name_cfp' => $this->name_cfp,
            'date_debut' => $this->date_debut,
            'date_fin' => $this->date_fin
        ]);
    }
}
