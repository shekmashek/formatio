<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class testController extends Controller
{
    public function dataVille($groupe_id, $projet_id){
        $villes = DB::table("v_detail_session")
            ->select("lieu")
            ->where("groupe_id", "=", $groupe_id)
            ->where("projet_id", "=", $projet_id)
            ->get();

        // dd($datas);
        return view('projet_session.index2', compact('villes'));
    }

}
