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

class ProjetControlleur extends Controller
{

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
        $projet->nom_projet = $projet->generateNomProjet($request->liste_etp);
        $projet->entreprise_id = $request->liste_etp;
        $projet->cfp_id = $cfp_id;
        $projet->status = "En Cours";
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

    public function update(Request $request)
    {
        $id = $request->Id;
        //modifier les données
        $nom_projet = $request->Nom_projet;

        projet::where('id', $id)
            ->update([
                'nom_projet' => $nom_projet

            ]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data updated successfully',
            ]
        );
    }

    public function destroy(Request $request)
    {
        $id = $request->id_get;
        $del = projet::where('id', $id)->delete();
        return back();
    }
}
