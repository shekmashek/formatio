<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FonctionGenerique;
use App\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class testController extends Controller
{
    public function filtrereferent(){
        $function = new FonctionGenerique();

        $res = $function->filtreReferent('responsables');
        dd($res);
    }

}
