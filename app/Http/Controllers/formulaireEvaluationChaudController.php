<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EvaluationChaud;

use App\Models\FonctionGenerique;
use Illuminate\Support\Facades\Auth;
class formulaireEvaluationChaudController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }
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
