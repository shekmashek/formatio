<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\stagiaire;
use App\programme;
use App\FroidEvaluation;
use App\detail;
use App\projet;
use App\responsable;
use Exception;
use Illuminate\Support\Facades\Auth;

class FroidEvaluationController extends Controller
{

    public function index()
    {
        $id_user = Auth::user()->id;
        $entreprise_id = responsable::where('user_id', $id_user)->value('entreprise_id');
        $datas = DB::select('select * from v_detailmodule where entreprise_id = ?', [$entreprise_id]);
        return view('admin.evaluation.evaluationFroid.liste_projet', compact('datas'));
    }

    public function create($info)
    {
        dd($info['id_projet']);
    }

    public function store(Request $request)
    {
        $evaluationFroid = new FroidEvaluation;
        $status = $request->cours;
        $stagiaire_id = $request->stagiaire_id;
        $projet_id = $request->projet_id;
        $detail_id = $request->detail_id;
        $module_id = $request->module_id;
        $matricule =stagiaire::where('id', $stagiaire_id)->value('matricule');
        $programme = programme::where('module_id', $module_id)->get();
        $cours = DB::select('select * from v_cours_programme where module_id = ?', [$module_id]);
        $cfp_id = projet::where('id', $projet_id)->value('cfp_id');
        foreach ($programme as $pg) {
            foreach ($cours as $crs) {
                if ($crs->programme_id == $pg->id) {
                    DB::insert('insert into froid_evaluations(cours_id,status, projet_id, stagiaire_id,cfp_id) values (?,?,?,?,?)', [$crs->cours_id, $status[$crs->cours_id], $projet_id, $stagiaire_id, $cfp_id]);
                }
            }
        }
        // return $this->tableauDeCompetenceStagiaire($info);
        return redirect()->route('resultat_tableau_competence', [$projet_id, $stagiaire_id, $module_id]);
    }

    public function show(Request $request)
    {
        $stg_id = $request->matricule;
        $groupe_id = $request->groupe_id;
        $stagiaire = stagiaire::where('id', $stg_id)->with('entreprise')->get();
        $detail = DB::select('select * from v_participant_groupe where stagiaire_id = ? and groupe_id = ?', [$stg_id, $groupe_id]);
        $programme = programme::where('module_id', $detail[0]->module_id)->get();
        $cours = DB::select('select * from v_cours_programme where module_id = ?', [$detail[0]->module_id]);
        $evaluation_stagiaire = FroidEvaluation::where('stagiaire_id', $stg_id)->get();
        $nb_evaluation =  stagiaire::where('id', $stg_id)->withCount('FroidEvaluation')->get();
        $nb = DB::select('select id from froid_evaluations where stagiaire_id = ?', [$stg_id]);
        if (count($nb) > 0) {
            return redirect()->route('resultat_tableau_competence', [$detail[0]->projet_id, $stg_id, $detail[0]->module_id]);
        } else {
            return view('admin.evaluation.evaluationFroid.evaluationFroid', compact('nb_evaluation', 'evaluation_stagiaire', 'stagiaire', 'detail', 'programme', 'cours'));
        }
    }

    public function tableauDeCompetenceStagiaire(Request $request)
    {
        try {
            $id_projet = $request->id_projet;
            $id_stagiaire = $request->id_stagiaire;
            $id_module = $request->id_module;
            $projet = DB::select('select * from v_projetentreprise where projet_id = ?', [$id_projet])[0];
            $stagiaire = DB::select('select * from v_participantsession where stagiaire_id = ?', [$id_stagiaire]);
            $programme = programme::where('module_id', $id_module)->get();
            $cours = DB::select('select * from v_cours_programme where module_id = ?', [$id_module]);
            $evaluation = DB::select('select * from v_froid_evaluations where projet_id = ?', [$id_projet]);
            $pourcentage = DB::select('select * from v_pourcentage_status where projet_id = ?', [$id_projet]);
            return view('admin.evaluation.evaluationFroid.tableau_de_competence', compact('stagiaire', 'programme', 'cours', 'id_projet', 'evaluation', 'projet', 'pourcentage'));
        } catch (Exception $e) {
            return back()->with('error', 'Il y a une erreur');
        }
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

    public function tableauDeCompetence(Request $request)
    {
        // try {
            $detail = detail::where('projet_id', $request->id_projet)->where('groupe_id', $request->id_groupe)->get();
            $req = "select * from v_participantsession where ";
            for ($i = 0; $i < count($detail); $i++) {
                if ($i == 0) {
                    $req = $req . " detail_id = " . $detail[$i]->id;
                } else {
                    $req = $req . " or detail_id =" . $detail[$i]->id;
                }
            }
            $id_projet = $request->id_projet;
            $projet_temp = DB::select('select * from v_projetentreprise where projet_id = ?', [$id_projet]);

            $projet = $projet_temp[0];
            $stagiaire = DB::select('select * from v_participantsession');
            $programme = programme::where('module_id', $detail[0]->module_id)->get();
            $cours = DB::select('select * from v_cours_programme where module_id = ?', [$request->id_module]);
            $evaluation = DB::select('select * from v_froid_evaluations where projet_id = ?', [$id_projet]);
            $pourcentage = DB::select('select * from v_pourcentage_status where projet_id = ?', [$id_projet]);
            return view('admin.evaluation.evaluationFroid.tableau_de_competence', compact('stagiaire', 'programme', 'cours', 'id_projet', 'evaluation', 'projet', 'pourcentage'));
        // } catch (Exception $e) {
        //     return back()->with('error', 'Il y a une erreur');
        // }
    }
}
