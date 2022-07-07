<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormateurMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nom_formateur,$prenom_formateur,$nom_cfp,$email,$mail_cfp)
    {
        $this->nom_formateur = $nom_formateur;
        $this->prenom_formateur = $prenom_formateur;
        $this->nom_cfp = $nom_cfp;
        $this->email = $email;
        $this->mail_cfp = $mail_cfp;
        $this->mdp = "0000";
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
       return $this->from($this->mail_cfp)
                    ->subject('Invitation de collaboration sur formation.mg')
                    ->view('emails.convocationFormateur')
                    ->with([
                        'nom_formateur' => $this->nom_formateur,
                        'prenom_formateur' => $this->prenom_formateur,
                        'nom_cfp' => $this->nom_cfp,
                        'email' => $this->email,
                        'mdp' => $this->mdp,
                    ]);
    }
}
