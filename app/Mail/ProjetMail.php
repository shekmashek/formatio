<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
//pour récupérer "current time"
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\projet;
use App\entreprise;
use App\User;

class ProjetMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $username = User::where('email',Auth::user()->email)->value('name');
        //on récupère le dernier projet inséré
        $projet = Projet::with('entreprise')->latest()->first();
        $date_creation = Carbon::now()->toDateString();
        return $this->from('contact@numerika.center')
                    ->subject('Nouveau projet de formation créé')
                    ->view('emails.projetNotif',compact('username','projet','date_creation'));
    }
}
