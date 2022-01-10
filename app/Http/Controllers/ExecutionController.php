<?php

namespace App\Http\Controllers;

use App\cfp;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\detail;
use App\execution;
use App\projet;
use App\entreprise;
use App\module;
use App\stagiaire;
use App\formation;
use App\formateur;
use App\participant_groupe;
use App\programme;
use App\Responsable;
use Illuminate\Support\Facades\Gate;

use App\Models\FonctionGenerique;
class ExecutionController extends Controller
{
    public function index()
    {
        $liste_etp = entreprise::orderBy('nom_etp')->get();
        $execution = execution::with('detail', 'stagiaire')->paginate(20);
        return view('admin.liste_execution', compact('execution', 'liste_etp'));
    }


    public function create()
    {
        $id = request()->id_detail;
        $detail =detail::with('formateur')->where('id', $id)->get();
        $id_groupe =detail::where('id', $id)->value('groupe_id');
        $id_projet =detail::where('id', $id)->value('projet_id');
        $id_etp = projet::where('id', $id_projet)->value('entreprise_id');
        $nom_etp = entreprise::where('id', $id_etp)->value('nom_etp');
        $stagiaire = DB::select('select * from stagiaires WHERE entreprise_id = ' . $id_etp . ' and id not in(SELECT stagiaire_id from participant_groupe)');

        $date_horaire_formation =detail::where([
            'projet_id' => $id_projet,
            'groupe_id' => $id_groupe
        ])->get();
        $nb_meme_horaire = detail::where([
            'projet_id' => $id_projet,
            'groupe_id' => $id_groupe
        ])->count();

        $formation = formation::all();
        $module = module::orderBy('nom_module')->get();
        $programme =programme::orderBy('titre')->get();
        
        return view('admin.stagiaire.ajout_stagiaire', compact('id_groupe', 'programme', 'module', 'formation', 'stagiaire', 'detail', 'nom_etp', 'date_horaire_formation', 'nb_meme_horaire'));
    }


    public function inserer(Request $request)
    {
        $input = $request->all();
        $groupe_id = $input['groupe_id'];
        var_dump($input['stagiaire']);
        if (!empty($input['stagiaire'])) {
            $input['stagiaire'] = array_filter($input['stagiaire'], static function ($item) {
                return !empty($item);
            });
            $input['stagiaire'] = array_unique($input['stagiaire']);
            for ($i = 0; $i < count($input['stagiaire']); $i++) {
                $participantsessions = new participant_groupe();
                $participantsessions->groupe_id = $groupe_id;
                $participantsessions->stagiaire_id = $input['stagiaire'][$i];
                $participantsessions->save();
            }
        }

        return back();
    }

    public function listeStagiaire($id_det = NULL)
    {
        if ($id_det == null) {
            $id = request()->id_detail;
        } else {
            $id = $id_det;
        }

        $detail = detail::where('id', $id)->get();
        $id_groupe = detail::where('id', $id)->value('groupe_id');
        $id_projet = detail::where('id', $id)->value('projet_id');
        $id_etp = projet::where('id', $id_projet)->value('entreprise_id');
        $nom_etp = entreprise::where('id', $id_etp)->value('nom_etp');


        $date_horaire_formation = detail::where([
            'projet_id' => $id_projet,
            'groupe_id' => $id_groupe
        ])->get();
        $nb_meme_horaire = detail::where([
            'projet_id' => $id_projet,
            'groupe_id' => $id_groupe
        ])->count();

        $formation = formation::all();
        $module = module::orderBy('nom_module')->get();
        $programme = programme::orderBy('titre')->get();

        $stagiaire = DB::select("select * from v_participant_groupe where detail_id = " . $id);

        return view('admin.stagiaire.liste_stagiaire_detail', compact('programme', 'module', 'formation', 'stagiaire', 'detail', 'nom_etp', 'date_horaire_formation', 'nb_meme_horaire'));
    }

    public function deleteParticipantSession()
    {
        $id_stg = request()->id_stagiaire;
        $id_det = request()->id_groupe;
        DB::delete('delete from participant_groupe where groupe_id = ' . $id_det . ' and stagiaire_id = ' . $id_stg);

        return back();
    }

    public function store(Request $request)
    {
        //enregistrer les projets dans la bdd
        $execution = new execution();
        $execution->qualite_formation = $request->Qualite;
        $execution->evaluation_formateur = $request->Evaluation;
        $execution->msexcel_fondamentaux    = $request->Exc_m1;
        $execution->msexcel_calculsFonctions = $request->Exc_m2;
        $execution->msexcel_gestionDonnées = $request->Exc_m3;
        $execution->msexcel_BI = $request->Exc_m4;
        $execution->msexcel_VBA = $request->Exc_m5;

        $execution->msBI_fondamentaux = $request->Bi_m1;
        $execution->mseBI_dax = $request->Bi_m2;
        $execution->msBI_dataviz = $request->Bi_m3;

        $execution->stagiaire_id = $request->Stagiaire_id;
        $execution->session_id = $request->Session_id;
        $execution->save();

        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully',

            ]
        );
    }

    public function show()
    {
        $id_user = Auth::user()->id;
        if (Gate::allows('isSuperAdmin')) {
            $datas = DB::select('select * from v_detail_projet_groupe');
        }
        // if (Gate::allows('isReferent') || Gate::allows('isStagiaire')) {
        //     $entreprise_id = Stagiaire::where('user_id', $id_user)->value('entreprise_id');
        //     $datas = DB::select('select * from v_detail_projet_groupe where entreprise_id = ?', [$entreprise_id]);
        // }
        // return view('admin.execution.execution', compact('datas'));
        if (Gate::allows('isReferent')) {
            $entreprise_id = responsable::where('user_id',$id_user)->value('entreprise_id');
            $datas = DB::select('select * from v_detail_projet_groupe where entreprise_id = ?', [$entreprise_id]);
        }
        if (Gate::allows('isStagiaire')) {
            $entreprise_id = stagiaire::where('user_id',$id_user)->value('entreprise_id');
            $datas =DB::select('select * from v_participant_groupe where entreprise_id = ?', [$entreprise_id]);
        }
        if (Gate::allows('isCFP')) {
            $cfp_id = cfp::where('user_id',$id_user)->value('id');
            $datas =DB::select('select * from v_detail_projet_groupe where cfp_id = ?', [$cfp_id]);
        }

        if (Gate::allows('isFormateur')) {

            $fonct = new FonctionGenerique();
            $cfps = new cfp();

            $formateur_id = formateur::where('user_id',$id_user)->value('id');

            // $cfp1 = $fonct->findWhere("v_demmande_formateur_cfp", ["formateur_id"], [$formateur_id]);
            // $cfp2 = $fonct->findWhere("v_demmande_cfp_formateur", ["formateur_id"], [$formateur_id]);
            // $cfp = $cfps->getCfp($cfp1,$cfp2);

            // $cfp_id = cfp::where('user_id',$id_user)->value('id');
            $datas =DB::select('select * from v_detailmodule where formateur_id = ?', [$formateur_id]);
        }
        return view('admin.execution.execution',compact('datas'));
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
        $execution = execution::find($id);
        $execution->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully',

            ]
        );
    }
}
