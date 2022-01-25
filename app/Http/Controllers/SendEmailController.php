<?php

namespace App\Http\Controllers;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Mail\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail; 

class SendEmailController extends Controller
{
   
    public function sendMail(Request $request)
    {

        $name=$request->name;
        $email = $request->email;
        $objet= $request->objet;
        $entreprise = $request->entreprise;
        $message = $request->message;

            Mail::to('eodielorinah08@gmail.com')->send(new Contact($name, $objet, $entreprise, $message, $email));
        return back();
    }
}
