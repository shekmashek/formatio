<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\PlanFormation;
use App\User;

class PlanStagiaire extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_resp,$nom_empl,$prenom_empl,$date_debut, $date_fin)
    {
        $this->mail_resp = $mail_resp;
        $this->nom_empl = $nom_empl;
        $this->prenom_empl = $prenom_empl;
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
        return $this->from($this->mail_resp)
        ->subject('Annonce: Récueil de Besoin')
        ->view('emails.nouveauPlan')
        ->with([
            'date_debut' => $this->date_debut,
            'date_fin' => $this->date_fin,
            'nom_empl' => $this->nom_empl,
            'prenom_empl' => $this->prenom_empl
        ]);
    }
}
