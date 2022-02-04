<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConditionController extends Controller
{
    public function index(){
        if (auth()->guest()) {
            return view('cgv');
        }
        else{
            return view('cgv_connecte');
        }
    }
}
