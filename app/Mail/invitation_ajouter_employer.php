<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class invitation_ajouter_employer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_acteur,$name_session,$name_cfp,$date_debut,$date_fin,$employe)
    {
        $this->name_session = $name_session;
        $this->name_cfp = $name_cfp;
        $this->mail_acteur = $mail_acteur;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->employe = $employe;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->mail_acteur)
        ->subject('Annulation : session de formation')
        ->view('emails.invitation_ajouter_employer')
        ->with([
            'name_session' => $this->name_session,
            'name_cfp' => $this->name_cfp,
            'date_debut' => $this->date_debut,
            'date_fin' => $this->date_fin,
            'employe' => $this->employe
        ]);
    }
}
