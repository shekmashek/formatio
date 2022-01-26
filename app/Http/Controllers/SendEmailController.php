<?php

namespace App\Http\Controllers;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Mail\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class SendEmailController extends Controller
{
   
    public function sendMail(Request $request)
    {

        $name=$request->name;
        $email = $request->email;
        $objet= $request->objet;
        $entreprise = $request->entreprise;
        $msg = $request->msg;
        Mail::to('contact@numerika.center')->send(new Contact($name, $objet, $entreprise, $msg, $email));
        return back()->with('message', 'Votre message a été bien envoyé');
    }
}
