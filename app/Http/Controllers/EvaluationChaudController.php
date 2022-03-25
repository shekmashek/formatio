<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Facture;
use App\EvaluationChaud;
use App\Models\FonctionGenerique;
use App\stagiaire;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EvaluationChaudController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware(function ($request, $next) {
        //     if(Auth::user()->exists == false) return redirect()->route('sign-in');
        //     return $next($request);
        // });
    }
    public function formulaire()
    {
        $fonct = new FonctionGenerique();
        $type_champ = $fonct->findAll("type_champs");
        return view('admin.evaluation.evaluationChaud.formulaireEvaluationChaud', compact('type_champ'));
    }

    public function index()
    {
        $fact = new Facture();
        $evaluation = new EvaluationChaud();
        $user_id = Auth::user()->id;
        $fonct = new FonctionGenerique();
        $stg_id = stagiaire::where('user_id',$user_id)->value('id');
        $champ_reponse = $evaluation->findAllChampReponse(); // return desc champs formulaire
        $qst_mere = $evaluation->findAllQuestionMere(); // return question entete mere
        $qst_fille = $evaluation->findAllQuestionFille(); // return question a l'interieur de question mere
        $data = $fonct->findWhereMulitOne('v_stagiaire_groupe',['stagiaire_id'],[$stg_id]);; // return les information du project avec detail et information du stagiaire
        
        // $stagiaire = $data['stagiaire'];
        // $detail = $data['detail'];

        return view("admin.evaluation.evaluationChaud.evaluationChaud", compact('data', 'champ_reponse', 'qst_mere', 'qst_fille'));
    }

    public function create(Request $request)
    {
        DB::beginTransaction();
        try{
            $fonct = new FonctionGenerique();
            $user_id = Auth::user()->id;
            $stg_id = stagiaire::where('user_id',$user_id)->value('id');
            
            $note = $request->nb_qst_fille_1;
            $commentaire = $request->txt_qst_fille_20;
            $module = $fonct->findWhereMulitOne("v_stagiaire_groupe",["groupe_id","stagiaire_id"],[$request->groupe,$stg_id]);
          
            DB::insert('insert into avis(stagiaire_id,module_id,note,commentaire,status,date_avis) value(?,?,?,?,?,?)',[$stg_id,$module->module_id,$note,$commentaire,'Fini',date('Y-m-d')]);
            $evaluation = new EvaluationChaud();
            
            $message = $evaluation->verificationEvaluation($module->stagiaire_id,$module->groupe_id,$module->cfp_id,$request);
            DB::commit();

            return redirect()->route('liste_projet',[1]);
            // return back()->with('avis','avis pour la formation');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error_evaluation',$message);
        }
    }

    public function store(Request $request)
    {
        $id_user = Auth::user()->id;
        $stagiaire_id = stagiaire::where('user_id',$id_user)->value('id');
        DB::insert('insert into avis(stagiaire_id,module_id,note,commentaire,status,date_avis) value(?,?,?,?,?)',[$stagiaire_id,$request->module_id,$request->note,$request->commentaire,'Fini',date('Y-m-d')]);
        return redirect()->route('execution');
    }

    public function show(Request $request)
    {
        $fonct = new FonctionGenerique();
        $id_user = Auth::user()->id;
        $stagiaire_id = stagiaire::where('user_id',$id_user)->value('matricule');
        $stagiaire =  $fonct->findWhereMulitOne("v_stagiaire_groupe",["stagiaire_id","groupe_id"],[$stagiaire_id,$request->groupe]);
        $evaluation = new EvaluationChaud();
        // $data = $evaluation->findDetailProject($matricule); // return les information du project avec detail et information du stagiaire
        $qst_mere = $evaluation->findAllQuestionMere(); // return question entete mere
        $qst_fille = $evaluation->findAllQuestionFille(); // return question a l'interieur de question mere
        // $stagiaire = $data['stagiaire'];
        // $detail = $data['detail'];
        $evaluation_detail = $evaluation->getDetailResponseEvaluationChaud($stagiaire_id);

        return view("admin.evaluation.evaluationChaud.detailEvaluationChaud", compact('detail', 'stagiaire', 'qst_mere', 'qst_fille', 'evaluation_detail'));
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

    public function test_avis(Request $request){
        dd($request->note);
    }
}
