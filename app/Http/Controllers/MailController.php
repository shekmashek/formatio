<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index(){
        Mail::to('nicrah16@gmail.com')->send(new sendMail());
    }
}
