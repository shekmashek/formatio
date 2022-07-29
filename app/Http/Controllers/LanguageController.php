<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Write Your Code...
     *
     * @return string
    */
    public function langChange($langue)
    {
        // dd($langue);
        App::setLocale($langue);
        Session::put("locale",$langue);
        return back();
    }
}
