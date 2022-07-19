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
    public function langChange($locale)
    {
        // dd($locale);
        App::setLocale($locale);
        Session::put("locale",$locale);
        return redirect()->back();
    }
}
