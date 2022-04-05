<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\projet;
use App\entreprise;
use App\User;
use App\Mail\ProjetMail;
use App\Facture;
use App\cfp;
use App\Models\FonctionGenerique;

class ProjetControlleur extends Controller
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
        $etp = entreprise::orderBy('nom_etp')->get();
        return view('admin.projet.nouveauProjet', compact('etp'));
    }

    public function create()
    {
    }


    public function store(Request $request)
    {
        $id = Auth::id();
        $cfp_id = cfp::where('user_id', $id)->value('id');
        //enregistrer les projets dans la bdd
        $projet = new projet();
        $projet->nom_projet = $projet->generateNomProjet();
        $projet->cfp_id = $cfp_id;
        $projet->status = "Confirmé";
        $projet->type_formation_id = $request->type_formation;
        $projet->activiter = TRUE;
        $projet->save();

        //envoyer un mail de notification à tous les utilisateurs admin
        $emails = User::where('role_id', '1')->get();
        foreach ($emails as $email) {
            Mail::to($email)->send(new ProjetMail());
        }

        return back();
    }

    public function show()
    {
        $facture = new Facture();
        $nom_projet = request()->nom_projet;
        $data = DB::select('select * from v_projetentreprise where nom_projet = ? order by nom_projet', [$nom_projet]);
        $projet =projet::get()->unique('nom_projet');
        return view('admin.projet.home', compact('data', 'projet'));
    }


    public function edit(Request $request)
    {
        $id = $request->Id;
        $projet = projet::where('id', $id)->get();
        return response()->json($projet);
    }

    public function update($id,Request $request)
    {
        projet::where('id', $id)
            ->update([
                'status' => $request->edit_status_projet
            ]);
        return back();
        // return response()->json(
        //     [
        //         'success' => true,
        //         'message' => 'Data updated successfully',
        //     ]
        // );
    }

    public function destroy(Request $request)
    {
        $id = $request->id_get;
        $del = DB::delete('delete from projets where id = ?', [$id]);
        return back();
    }

    public function accueilProjet(){
        // return view('projet_session.projetAccueil');
        return redirect()->route('liste_projet',[1]);
    }

    public function module_formation_intra(Request $rq)
    {
        $fonct = new FonctionGenerique();
        $user_id = Auth::user()->id;
        $cfp_id = cfp::where('user_id', $user_id)->value('id');
        $module = $fonct->findWhere("modules", ["formation_id","cfp_id"], [$rq->id,$cfp_id]);

        return response()->json($module);
    }

    public function intraFormProjet(){
        $modules = DB::select('select * from modules');
        $formations = DB::select('select * from formations');
        return view('projet_session.projet_intra_form', compact('modules','formations'));
    }

    public function interFormProjet(){
        return view('projet_session.projet_inter_form');
    }

    public function projetInterne(){
        return view('referent.projet_Interne.projet_interne');
    }

    public function formations(){
        return view('referent.projet_Interne.formations.formation');
    }

    public function formateurs(){
        return view('referent.projet_Interne.formateurs.formateur');
    }

    public function projets(){
        return view('referent.projet_Interne.projets.projet');
    }
}
