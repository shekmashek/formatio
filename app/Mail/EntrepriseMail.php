<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\User;
class EntrepriseMail extends Mailable
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

        return $this->from('contact-mg@upskill-sarl.com')
                    ->subject('Nouvelle entreprise créée')
                    ->view('emails.entrepriseNotif',compact('username'));
    }
}
