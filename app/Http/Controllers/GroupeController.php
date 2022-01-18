<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\responsable;
use App\User;
use Illuminate\Http\Request;
use App\groupe;
use App\projet;
use App\cfp;
use App\Models\FonctionGenerique;

class GroupeController extends Controller
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
        $users = Auth::user()->id;

        $entreprise_id = responsable::where('user_id', $users)->value('entreprise_id');

        $id_groupe = projet::where('entreprise_id', $entreprise_id)->value('id');

        $role_id = User::where('email', Auth::user()->email)->value('role_id');
        if ($role_id == 2) {
            $groupe = groupe::with('projet')->where('projet_id', $id_groupe)->get();
        } else {
            $groupe = groupe::orderBy('nom_groupe')->with('projet')->get();
        }
        return view('admin.groupe.groupe', compact('groupe', 'users'));
    }

    public function create($idProjet)
    {
        $fonct = new FonctionGenerique();
        $user_id = Auth::user()->id;
        $cfp_id = cfp::where('user_id', $user_id)->value('id');
        $projet = $fonct->findWhereMulitOne("v_projetentreprise", ["projet_id"], [$idProjet]);
        $groupe = $fonct->findWhere("v_groupe", ["projet_id"], [$idProjet]);
        $formation = $fonct->findWhere("formations", ["cfp_id"], [$cfp_id]);
        $module = $fonct->findAll("modules");
        return view('admin.groupe.nouveauGroupe', compact('projet', 'groupe', 'formation', 'module'));
    }


    public function module_formation(Request $rq)
    {
        $fonct = new FonctionGenerique();
        $module = $fonct->findWhere("modules", ["formation_id"], [$rq->id]);
        return response()->json($module);
    }

    public function store(Request $request)
    {
        //condition de validation de formulaire
        $request->validate(
            [
                'min_part' => "required|numeric|min:0",
                'max_part' => "required|numeric|min:0",
                'dte_debut' => "required|date",
                'dte_fin' => "required|date",
                'module_id' => "required",
            ],
            [
                'dte_debut.required' => 'la date du debut de formation ne doit pas être null',
                'dte_fin.required' => 'la date fin de formation ne doit pas être null',
                'module_id.required' => 'le module  de la formation ne doit pas être null',
            ]
        );
        //enregistrer les projets dans la bdd
        $groupe = new groupe();
        $groupe->nom_groupe = $groupe->generateNomSession($request->projet_id);
        $groupe->min_participant = $request->min_part;
        $groupe->max_participant = $request->max_part;
        $groupe->date_debut = $request->dte_debut;
        $groupe->date_fin = $request->dte_fin;
        $groupe->status = "En Cour";
        $groupe->activiter = TRUE;
        $groupe->module_id = $request->module_id;
        $groupe->projet_id = $request->projet_id;
        $groupe->save();

        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request)
    {
        $id = $request->Id;
        $groupe =groupe::where('id', $id)->get();
        return response()->json($groupe);
    }

    public function update(Request $request,$id)
    {
        $maj = groupe::where('id', $id)->update([
            'min_participant' => $request->edit_min_part,
            'max_participant' => $request->edit_max_part,
            'date_debut' => $request->edit_dte_debut,
            'date_fin' => $request->edit_dte_fin,
            'status' => $request->edit_status
        ]);

        // dd($request->input());
        return back();
    }

    public function destroy(Request $request)
    {
        $id = $request->id_get;
        $del = groupe::where('id', $id)->delete();
        return back();
    }
}
