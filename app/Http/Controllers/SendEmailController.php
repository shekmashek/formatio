<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Mail\Contact;

use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{

    public function sendMail(Request $request)
    {

        $name=$request->name;
        $mail = $request->mail;
        $objet= $request->objet;
        $entreprise = $request->entreprise;
        $msg = $request->message;

        Mail::to('nicrah16@gmail.com')->send(new Contact($name, $objet, $entreprise, $msg, $mail));

        return back();
    }
}
