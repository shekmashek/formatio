<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\detail;
use App\projet;
use App\module;
use App\entreprise;
use App\formation;
use App\formateur;
use App\presence;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class EmargementController extends Controller
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
        $id_user = Auth::user()->id;
        if (Gate::allows('isFormateur')) {
            $formateur_id = formateur::where('user_id', $id_user)->value('id');
            $detail_groupe = DB::select('select * from v_detailmodule where formateur_id = ?', [$formateur_id]);
            return view('admin.detail.liste_session', compact('detail_groupe'));
        } else {
            return route('home');
        }
    }


    public function listeDetail(Request $request)
    {
        $formation = formation::all();
        $projet = projet::orderBy('nom_projet')->get();
        $liste = entreprise::orderBy('nom_etp')->get();
        $module = module::orderBy('Reference')->get();
        $datas = DB::select('select * from v_detailmodule where groupe_id = ? and detail_id = ?', [$request->id_groupe, $request->id_detail]);
        $nb_participant = DB::select('select count(stagiaire_id) as presence_count from v_participant_groupe where groupe_id = ? and detail_id = ? ', [$request->id_groupe, $request->id_detail]);
        $nb = detail::withCount([
            'presence' => function ($query) {
                $query->where('status', 'Present');
            }
        ])->get();
        return view('admin.detail.emargement', compact('nb', 'nb_participant', 'datas', 'liste', 'projet', 'module', 'formation'));
    }


    public function create(Request $request)
    {
        $id = $request->Id;
        $status = $request->presence;
        $iddetail = $request->IdDetail;
        $presenceDetail = new presence();
        $presenceDetail->status = $status;
        $presenceDetail->detail_id = $iddetail;
        $presenceDetail->stagiaire_id = $id;

        $presenceDetail->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data created successfully',

            ]
        );
    }

    public function insert(Request $request)
    {
        DB::beginTransaction();
        try {
            $detail_id = $request->detail_id;
            $p = presence::where('detail_id', $detail_id)->get();
            if (count($p) > 0) {
                return redirect()->route('presence.show', [$detail_id]);
            } else {
                $presence = $request->attendance;
                $stagiaires = DB::select('select * from v_participant_groupe where detail_id = ?', [$detail_id]);
                foreach ($stagiaires as $stg) {
                    DB::insert('insert into presences(status, detail_id, stagiaire_id) values (?,?,?)', [$presence[$stg->stagiaire_id], $detail_id, $stg->stagiaire_id]);
                }
                DB::commit();
                $projet_id = detail::where('id', $detail_id)->value('projet_id');
                $etp_id = projet::where('id', $projet_id)->value('entreprise_id');
                $nom_etp = entreprise::where('id', $etp_id)->value('nom_etp');
                $datas = DB::select('select * from v_detailmodule where detail_id = ?', [$detail_id]);
                $liste_stagiaire = DB::select('select * from v_presence_detail where detail_id = ?', [$detail_id]);
                $message = "fini";
                return view('admin.detail.detail_presence', compact('presence', 'liste_stagiaire', 'datas', 'nom_etp', 'message'));
            }
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Vous devez cocher tout les presences.');
        }
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
        $projet_id = detail::where('id', $id)->value('projet_id');
        $etp_id = projet::where('id', $projet_id)->value('entreprise_id');
        $nom_etp = entreprise::where('id', $etp_id)->value('nom_etp');
        $datas = DB::select('select * from v_detailmodule where detail_id = ?', [$id]);
        $liste_stagiaire = NULL;
        $presence = presence::where('detail_id', $id)->get();
        if (count($presence) > 0) {
            $liste_stagiaire = DB::select('select * from v_presence_detail where detail_id = ?', [$id]);
            $message = "fini";
        } else {
            $message = "";
            $liste_stagiaire = DB::select('select * from v_participant_groupe where detail_id = ?', [$id]);
        }

        return view('admin.detail.detail_presence', compact('presence', 'liste_stagiaire', 'datas', 'nom_etp', 'message'));
    }

    public function getProjet(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $projets = projet::orderby('nom_projet', 'asc')->select('id', 'nom_projet')->limit(5)->get();
        } else {

            $projets = projet::orderby('nom_projet', 'asc')->select('id', 'nom_projet')->where(
                'nom_projet',
                'like',
                $search . '%'
            )->limit(5)->get();
        }

        $response = array();
        foreach ($projets as $projet) {
            $response[] = array("value" => $projet->id, "label" => $projet->nom_projet);
        }
        return response()->json($response);
    }
    public function recherche(Request $request)
    {
        $nb_participant = detail::withCount('participantsession')->get();

        $nb = detail::withCount([
            'presence' => function ($query) {
                $query->where('status', 'Present');
            }
        ])->get();

        $projet = $request->nom_projet;
        if ($projet == '') {
            $datas = detail::get();
        } else {
            $id_projet = projet::where('nom_projet', $projet)->value('id');
            $datas = detail::where('projet_id', $id_projet)->get();
        }
        return view('admin.detail.emargement', compact('datas', 'nb', 'nb_participant'));
    }
    /** detail sur les absences par projet */
    public function detail()
    {
        //
    }

    public function edit(Request $request)
    {
        $detail_id = $request->detail_id;
        DB::delete('delete from presences where detail_id = ?', [$detail_id]);
        return redirect()->route('presence.show', [$detail_id]);
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
