<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class testController extends Controller
{
    public function test(){
        $req = DB::table('moduleformation')
                ->join('v_groupe_projet_entreprise', 'v_groupe_projet_entreprise.module_id', 'moduleformation.module_id')
                ->select('*')
                ->groupBy('moduleformation.module_id')
                // ->select('nom_formation', 'nom_module')
                ->get();
        dd($req);
        }

}
