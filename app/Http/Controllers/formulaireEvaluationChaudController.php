<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EvaluationChaud;

use App\Models\FonctionGenerique;

class formulaireEvaluationChaudController extends Controller
{

    public function index()
    {
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $evaluation = new EvaluationChaud();
        $fonct = new FonctionGenerique();

        return $evaluation->verify_insert_qste($request);
    }

    public function show($id)
    {
        $module = EvaluationChaud::where('formation_id',$id)->orderBy('Reference')->get();
        return response()->json($module);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
