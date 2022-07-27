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
use Illuminate\Support\Facades\Gate;

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
        $questions = DB::select('select * from v_question_champ_froid order by question_id asc');
        $reponses = DB::select('select * from reponse_question_eval_froid');
        return view('evaluation_froid.formulaire_froid',compact('data','questions','reponses'));
    }

    public function create(Request $request)
    {
        
    }

    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $user_id = Auth::user()->id;
            if(Gate::allows('isManager')){
                $manager_id = DB::select('select id from chef_departements where user_id = ?',[$user_id])[0]->id;
                $input = $request->all();
                $questions = DB::select('select * from v_question_champ_froid order by question_id asc');
                foreach($questions as $quest){
                    if($quest->desc_champ == 'CASE'){
                        if($input['reponse_case_'.$quest->question_id] == null){
                            throw new Exception('Vous devez repondre à tous les questions.');
                        }else{
                            DB::insert('insert into resultat_eval_froid_manager(question_id,groupe_id,manager_id,reponse_id) values(?,?,?,?)',[$quest->question_id,$request->groupe,$manager_id,$input['reponse_case_'.$quest->question_id]]);
                        }
                    }
                    if($quest->desc_champ == 'TEXT'){
                        if($input['reponse_text_'.$quest->question_id] == null){
                            throw new Exception('Vous devez repondre à tous les questions.');
                        }else{
                            DB::insert('insert into resultat_eval_froid_manager(question_id,groupe_id,manager_id,reponse_id,reponse_text) values(?,?,?,?,?)',[$quest->question_id,$request->groupe,$manager_id,$request->reponse_text,$input['reponse_text_'.$quest->question_id]]);
                        }
                    }
                    if($quest->desc_champ == 'CHECKBOX'){
                        for($i = 0; $i < count($input['reponse_checkbox_'.$quest->question_id]); $i++){
                            if($input['reponse_checkbox_'.$quest->question_id][$i] == null){
                                throw new Exception('Vous devez répondre à tous les questions.');
                            }else{
                                DB::insert('insert into resultat_eval_froid_manager(question_id,groupe_id,manager_id,reponse_id) values(?,?,?,?)',[$quest->question_id,$request->groupe,$manager_id,$input['reponse_checkbox_'.$quest->question_id][$i]]);
                            }
                        }
                    }
                }
            }
            if(Gate::allows('isStagiaire')){
                $stg_id = stagiaire::where('user_id',$user_id)->value('id');
                $input = $request->all();
                // dd($input);
                $questions = DB::select('select * from v_question_champ_froid order by question_id asc');
                foreach($questions as $quest){
                    if($quest->desc_champ == 'CASE'){
                        if($input['reponse_case_'.$quest->question_id] == null){
                            throw new Exception('Vous devez repondre à tous les questions.');
                        }else{
                            DB::insert('insert into resultat_eval_froid_stagiaire(question_id,groupe_id,stagiaire_id,reponse_id) values(?,?,?,?)',[$quest->question_id,$request->groupe,$stg_id,$input['reponse_case_'.$quest->question_id]]);
                        }
                    }
                    if($quest->desc_champ == 'TEXT'){
                        if($input['reponse_text_'.$quest->question_id] == null){
                            throw new Exception('Vous devez repondre à tous les questions.');
                        }else{
                            DB::insert('insert into resultat_eval_froid_stagiaire(question_id,groupe_id,stagiaire_id,reponse_id,reponse_text) values(?,?,?,?,?)',[$quest->question_id,$request->groupe,$stg_id,$request->reponse_text,$input['reponse_text_'.$quest->question_id]]);
                        }
                    }
                    if($quest->desc_champ == 'CHECKBOX'){
                        for($i = 0; $i < count($input['reponse_checkbox_'.$quest->question_id]); $i++){
                            if($input['reponse_checkbox_'.$quest->question_id][$i] == null){
                                throw new Exception('Vous devez répondre à tous les questions.');
                            }else{
                                DB::insert('insert into resultat_eval_froid_stagiaire(question_id,groupe_id,stagiaire_id,reponse_id) values(?,?,?,?)',[$quest->question_id,$request->groupe,$stg_id,$input['reponse_checkbox_'.$quest->question_id][$i]]);
                            }
                        }
                    }
                }
            }
            DB::commit();
            return redirect()->route('liste_projet');
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('eval_error',$e->getMessage());
        }
    }

    public function show(Request $request)
    {
        $groupe = $request->groupe;
        $session = DB::select('select nom_module,nom_formation,date_debut,date_fin from v_groupe_projet_module where groupe_id = ?',[$groupe])[0];
        $questions = DB::select('select * from v_question_champ_froid order by question_id asc');
        $resultats = DB::select('select * from v_resultat_froid_evaluation_stagiaire where groupe_id = ?', [$groupe]);
        $resultats_manager = DB::select('select * from v_resultat_froid_evaluation_manager where groupe_id = ?', [$groupe]);
        $commentaires = DB::select('select * from resultat_eval_froid_stagiaire where groupe_id = ?',[$groupe]);
        $commentaires_manager = DB::select('select * from resultat_eval_froid_manager where groupe_id = ?',[$groupe]);
        // dd($questions,$commentaires);
        return view('evaluation_froid.resultat_froid_stagiaire',compact('session','questions','resultats','commentaires','resultats_manager','commentaires_manager'));
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
