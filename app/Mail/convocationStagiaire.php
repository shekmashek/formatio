<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\User;


class ConvocationStagiaire extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($nom_module,$nom_projet,$nom_stg,$prenom_stg,$nom_formation,$lieu,$debut,$fin,$email,$phone_stg)
    {
        $this->nom_stg = $nom_stg;
        $this->prenom_stg = $prenom_stg;
        $this->nom_formation = $nom_formation;
        $this->lieu = $lieu;
        $this->debut = $debut;
        $this->fin = $fin;
        $this->email = $email;
        $this->phone_stg = $phone_stg;
        $this->nom_projet = $nom_projet;
        $this->nom_module = $nom_module;
        $this->mdp = $this->nom_stg.substr($this->phone_stg,8,2);

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->from('contact-mg@upskill-sarl.com')
                    ->subject('Convocation à une formation')
                    ->view('emails.convocationMail')
                    ->with([
                        'nom_stg' => $this->nom_stg,
                        'prenom_stg' => $this->prenom_stg,
                        'nom_formation' => $this->nom_formation,
                        'lieu' => $this->lieu,
                        'debut' => $this->debut,
                        'fin' => $this->fin,
                        'email' => $this->email,
                        'mdp' => $this->mdp,
                        'nom_module' => $this->nom_module

                    ])
                    ->attach(public_path('pdf/catalogue.pdf'), [
                        'as' => 'catalogue.pdf',
                        'mime' => 'application/pdf',
                    ])
                    ->attach(storage_path('app/public/pdf/'.$this->nom_projet.'.pdf'), [
                        'as' => 'Details_de_la_formation.pdf',
                        'mime' => 'application/pdf',
                    ]);

    }
}
