<?php

namespace App\Mail\new_employer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class create_compte_new_employer_mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nom_etp,$responsable_etp,$nom_employer,$email_employer,$fonction_user)
    {
        $this->nom_etp = $nom_etp;
        $this->responsable_etp = $responsable_etp;
        $this->nom_employer = $nom_employer;
        $this->email_employer = $email_employer;
        $this->fonction_user = $fonction_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->responsable_etp->email_resp)
            ->subject('Création de Nouveau Compte sur formation.mg')
            ->view('save_compte_employer.nouveau_compte_employer')
            ->with([
                'nom_etp' => $this->nom_etp,
                'responsable_etp' => $this->responsable_etp,
                'nom_employer' => $this->nom_employer,
                'fonction_user' =>$this->fonction_user,
                'email_employer' => $this->email_employer
            ]);
    }
}
