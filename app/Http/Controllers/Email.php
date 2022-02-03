<?php

namespace App\Http\Controllers;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Mail\sendsemail;
use Illuminate\Http\Request;

class Email extends Controller
{
    public function envoie(Request $request)
    {
        $request->validate(
            [
                'name' => ["required"],
                'mail' => ["required"],
                'objet' =>  ["required"],
                'msg' =>  ["required"],
                'entreprise' =>  ["required"],

            ],
            [ 'name.required' => 'Veuillez remplir le champ',

                'mail.required' =>  'Veuillez remplir le champ',
                'mail.email' => 'Addresse mail non valide',
                'objet.required' => 'Veuillez remplir le champ',
                'entreprise.required' => 'Veuillez remplir le champ',
                'msg.required' => 'Veuillez remplir le champ',
                'ville.required' => 'Veuillez remplir le champ',
                ]
            );
        $input=$request->input;
        if ($input==7){
            $name=$request->name;
            $mail = $request->mail;
            $objet= $request->objet;
            $entreprise = $request->entreprise;
            $msg = $request->msg;
            Mail::to('contact@numerika.center')->send(new sendsemail($name, $objet, $entreprise, $msg, $mail));
            return back()->with('message', 'Votre message a été bien envoyé');
        }
        else{
            return back()->with('message', 'Veuillez saisir le chiffre exacte !');

        }
        }
}