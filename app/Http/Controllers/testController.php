<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class testController extends Controller
{
    public function test($etp_id){
        $etp = DB::table('entreprises')
        ->join('responsables', 'responsables.entreprise_id', 'entreprises.id')
        ->join('groupe_entreprises', 'groupe_entreprises.entreprise_id', 'entreprises.id')
        ->join('groupes', 'groupes.id', 'groupe_entreprises.groupe_id' )

        ->join('v_groupe_projet_entreprise', 'v_groupe_projet_entreprise.entreprise_id', 'entreprises.id')
        ->select('*')
        ->where('v_groupe_projet_entreprise.entreprise_id', $etp_id)
        ->get();

        dd($etp);
    }

}
