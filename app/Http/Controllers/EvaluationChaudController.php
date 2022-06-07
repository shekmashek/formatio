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
        $data = $fonct->findWhereMulitOne('v_stagiaire_groupe',['stagiaire_id','groupe_id'],[$stg_id,request()->groupe]);; // return les information du project avec detail et information du stagiaire
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
        $stagiaire_id = stagiaire::where('user_id',$id_user)->value('id');
        $stagiaire =  $fonct->findWhereMulitOne("v_stagiaire_groupe",["stagiaire_id","groupe_id"],[$stagiaire_id,$request->groupe]);
        $evaluation = new EvaluationChaud();
        // $data = $evaluation->findDetailProject($matricule); // return les information du project avec detail et information du stagiaire
        $qst_mere = $evaluation->findAllQuestionMere(); // return question entete mere
        $qst_fille = $evaluation->findAllQuestionFille(); // return question a l'interieur de question mere
        // $stagiaire = $data['stagiaire'];
        // $detail = $data['detail'];
        $evaluation_detail = $evaluation->getDetailResponseEvaluationChaud($stagiaire_id);

        return view("admin.evaluation.evaluationChaud.detailEvaluationChaud", compact( 'stagiaire', 'qst_mere', 'qst_fille', 'evaluation_detail'));
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

    public function evaluation_chaud_pdf(Request $request){
        try{
            $eval = new EvaluationChaud();
            $groupe = $request->groupe_id;
            // preparation de la formation
            // q1
                $res_q1 = $eval->pourcentage_point($groupe,3);
                $note_10_q1 = $eval->note_question($groupe,3);

                if(count($res_q1)<=0 || count($note_10_q1) <= 0){
                    throw new Exception('Impossible de télécharger le pdf.');
                }
            //
            // q2
                $res_q2 = $eval->pourcentage_point($groupe,4);
                $note_10_q2 = $eval->note_question($groupe,4);
                if(count($res_q2)<=0 || count($note_10_q2) <= 0){
                    throw new Exception('Impossible de télécharger le pdf.');
                }
            //
                // $somme_note_1 = DB::select('select sum(note_sur_10)/? as note from v_evaluation_chaud_resultat where groupe_id = ? and id_qst_fille = ? or id_qst_fille = ?',[2,$groupe,3,4]);
            // end

            // organistion de la formation
            // q3
                $res_q3 = $eval->pourcentage_point($groupe,6);
                $note_10_q3 = $eval->note_question($groupe,6);
                if(count($res_q3)<=0 || count($note_10_q3) <= 0){
                    throw new Exception('Impossible de télécharger le pdf.');
                }
            //
                // $somme_note_2 = DB::select('select sum(note_sur_10)/? as note from v_evaluation_chaud_resultat where groupe_id = ? and id_qst_fille = ?',[1,$groupe,6]);
            // end

            // Deroulement de la formation
            // q4
                $res_q4 = $eval->pourcentage_point($groupe,7);
                $note_10_q4 = $eval->note_question($groupe,7);
                if(count($res_q4)<=0 || count($note_10_q4) <= 0){
                    throw new Exception('Impossible de télécharger le pdf.');
                }
            //
            // q5
                $res_q5 = $eval->pourcentage_point($groupe,8);
                $note_10_q5 = $eval->note_question($groupe,8);
                if(count($res_q5)<=0 || count($note_10_q5) <= 0){
                    throw new Exception('Impossible de télécharger le pdf.');
                }
            //
            // q6
                $res_q6 = $eval->pourcentage_point($groupe,9);
                $note_10_q6 = $eval->note_question($groupe,9);
                if(count($res_q6)<=0 || count($note_10_q6) <= 0){
                    throw new Exception('Impossible de télécharger le pdf.');
                }
            //
                // $somme_note_3 = DB::select('select sum(note_sur_10)/? as note from v_evaluation_chaud_resultat where groupe_id = ? and id_qst_fille = ? or id_qst_fille = ? or id_qst_fille = ?',[3,$groupe,7,8,9]);
            // end

            //le rythme de la formation
            // q7
                $res_q7 = DB::select('select * from v_evaluation_chaud_resultat where groupe_id = ? and id_qst_fille = ? and point < 4',[$groupe,10]);
                if(count($res_q7)<=0){
                    throw new Exception('Impossible de télécharger le pdf.');
                }
            // end

            // contenu de la formation
            // q8
                $res_q8 = $eval->pourcentage_point($groupe,11);
                $note_10_q8 = $eval->note_question($groupe,11);
                if(count($res_q8)<=0 || count($note_10_q8) <= 0){
                    throw new Exception('Impossible de télécharger le pdf.');
                }
            //
            // q9
                $res_q9 = $eval->pourcentage_point($groupe,12);
                $note_10_q9 = $eval->note_question($groupe,12);
                if(count($res_q9)<=0 || count($note_10_q9) <= 0){
                    throw new Exception('Impossible de télécharger le pdf.');
                }
            //
            // q10
                $res_q10 = $eval->pourcentage_point($groupe,13);
                $note_10_q10 = $eval->note_question($groupe,13);
                if(count($res_q10)<=0 || count($note_10_q10) <= 0){
                    throw new Exception('Impossible de télécharger le pdf.');
                }
            //
                // $somme_note_4 = DB::select('select sum(note_sur_10)/? as note from v_evaluation_chaud_resultat where groupe_id = ? and id_qst_fille = ? or id_qst_fille = ? or id_qst_fille = ?',[3,$groupe,11,12,13]);
            // end

            // efficacite de la formation
            // q11
                $res_q11 = $eval->pourcentage_point($groupe,15);
                $note_10_q11 = $eval->note_question($groupe,15);
                if(count($res_q11)<=0 || count($note_10_q11) <= 0){
                    throw new Exception('Impossible de télécharger le pdf.');
                }
            //
            // q12
                $res_q12 = $eval->pourcentage_point($groupe,16);
                $note_10_q12 = $eval->note_question($groupe,16);
                if(count($res_q12)<=0 || count($note_10_q12) <= 0){
                    throw new Exception('Impossible de télécharger le pdf.');
                }
            //
                // $somme_note_5 = DB::select('select sum(note_sur_10)/? as note from v_evaluation_chaud_resultat where groupe_id = ? and id_qst_fille = ? or id_qst_fille = ?',[2,$groupe,15,16]);
            // end

            // recommanderiez vous cette formation
            // q13

                $res_q13 = DB::select('select * from v_evaluation_chaud_resultat where groupe_id = ? and id_qst_fille = ? and point < 3 order by point desc',[$groupe,17]);
                if(count($res_q13)<=0){
                    throw new Exception('Impossible de télécharger le pdf.');
                }
            // end

            // points forts
            //q14
                $res_q14 = DB::select('select reponse_desc_champ,case when statut = 0 then concat(nom_stagiaire," ",prenom_stagiaire) when statut = 1 then "Anonyme" end stagiaire from v_reponse_evaluationchaud re join stagiaires s on s.id = re.stagiaire_id where groupe_id = ? and id_qst_fille = ?',[$groupe,20]);
                if(count($res_q14)<=0){
                    throw new Exception('Impossible de télécharger le pdf.');
                }
            // end

            // points faibles
            //q15
                $res_q15 = DB::select('select reponse_desc_champ,case when statut = 0 then concat(nom_stagiaire," ",prenom_stagiaire) when statut = 1 then "Anonyme" end stagiaire from v_reponse_evaluationchaud re join stagiaires s on s.id = re.stagiaire_id where groupe_id = ? and id_qst_fille = ?',[$groupe,21]);
                if(count($res_q15)<=0){
                    throw new Exception('Impossible de télécharger le pdf.');
                }
            // end

            $session = DB::select('select nom_module,nom_formation,date_debut,date_fin from v_groupe_projet_module where groupe_id = ?',[$groupe])[0];

            // PDF::setOptions([
            //     "defaultFont" => "Courier",
            //     "defaultPaperSize" => "a4",
            //     "dpi" => 130
            // ]);
            // dd($res_q14);

            // $pdf = PDF::loadView('admin.evaluation.evaluationChaud.pdf_evaluation_chaud',compact('session','res_q1','note_10_q1','res_q2','note_10_q2','res_q3','note_10_q3','res_q4','note_10_q4','res_q5','note_10_q5','res_q6','note_10_q6','res_q7','res_q8','note_10_q8','res_q9','note_10_q9','res_q10','note_10_q10','res_q11','note_10_q11','res_q12','note_10_q12','res_q13','res_q14','res_q15'));

            return view('admin.evaluation.evaluationChaud.resultat_evaluation_chaud_pdf',compact('session','res_q1','note_10_q1','res_q2','note_10_q2','res_q3','note_10_q3','res_q4','note_10_q4','res_q5','note_10_q5','res_q6','note_10_q6','res_q7','res_q8','note_10_q8',
            'res_q9','note_10_q9','res_q10','note_10_q10','res_q11','note_10_q11','res_q12','note_10_q12','res_q13','res_q14','res_q15'));
            // return $pdf->download('Resulat_evaluation_a_chaud.pdf');
        }catch(Exception $e){
            return back()->with('pdf_error','Evaluation à chaud pas encore disponible.');
        }
    }
}
