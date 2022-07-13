<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class testController extends Controller
{
    public function dataEmp($etp_id, $secteur_id){
        $emps = DB::select('select * from employers where entreprise_id = ?', [$etp_id]);
        $etps = DB::select('select * from entreprises where secteur_id = ?', [$secteur_id]);

        return response()->json([
            'emps' => $emps,
            'etps' => $etps
        ]);
    }

}
