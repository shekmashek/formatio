<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Facture;
use App\EvaluationChaud;
use App\Models\FonctionGenerique;
use App\stagiaire;
use PDF;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EvaluationFroidController extends Controller
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
        $user_id = Auth::user()->id;
        $fonct = new FonctionGenerique();
        $stg_id = stagiaire::where('user_id',$user_id)->value('id');
        $data = $fonct->findWhereMulitOne('v_stagiaire_groupe',['stagiaire_id','groupe_id'],[$stg_id,request()->groupe]);
        $questions = DB::select('select * from v_question_champ_froid');
        $reponses = DB::select('select * from reponse_question_eval_froid');
        return view('evaluation_froid.formulaire_froid',compact('data','questions','reponses'));
    }

    public function create(Request $request)
    {
        
    }

    public function store(Request $request)
    {
        
    }

    public function show(Request $request)
    {
       
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
