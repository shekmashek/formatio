<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class acceptation_session extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_etp,$name_session,$name_etp,$date_debut,$date_fin)
    {
        $this->name_session = $name_session;
        $this->name_etp = $name_etp;
        $this->mail_etp = $mail_etp;
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
        return $this->from($this->mail_etp)
        ->subject('Acceptation : session de formation')
        ->view('emails.acceptation_session')
        ->with([
            'name_session' => $this->name_session,
            'name_etp' => $this->name_etp,
            'date_debut' => $this->date_debut,
            'date_fin' => $this->date_fin
        ]);
    }
}
