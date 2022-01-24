<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

class SendEmailController extends Controller
{
    function send(Request $request)
    {
     $this->validate($request, [
      'name'     =>  'required',
      'email'  =>  'required|email',
      'message' =>  'required',
      'entreprise'  =>  'required|entreprise',
      'objet' =>  'required|objet'
     ]);

        $data = array(
            'name'      =>  $request->name,
            'message'   =>   $request->message,
            'objet'   =>   $request->objet,
            'entreprise'   =>   $request->entreprise

        );

     Mail::to('eodielorinah08@gmail.com')->send(new Contact($data));
     return back()->with('success', 'Thanks for contacting us!');

    }
}
