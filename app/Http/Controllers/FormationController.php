<?php

namespace App\Http\Controllers;

use App\Domaine;
use Illuminate\Http\Request;
use App\formation;
use App\module;
use App\categories_formations;
use App\cfp;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FormationController extends Controller
{

    public function index($id = null)

    {
        $id_user = Auth::user()->id;
        if (Gate::allows('isCFP')) {
            $cfp_id = cfp::where('user_id', $id_user)->value('id');
            $formation = formation::with('Domaine')->orderBy('domaine_id')->get();
            return view('admin.formation.formation', compact('formation'));
        }
        if (Gate::allows('isSuperAdmin')) {
            $formation = formation::with('Domaine')->orderBy('domaine_id')->get();
            return view('admin.formation.formation', compact('formation'));
        }
        if (Gate::allows('isFormateur')) {
            $categorie = formation::orderBy('nom_formation')->get();
            $domaines = Domaine::all();
            return view('referent.catalogue.formation', compact('domaines', 'categorie'));
        }
        if (Gate::allows('isReferent') || Gate::allows('isStagiaire') || Gate::allows('isManager')) {
            //liste formation
            // $categorie = formation::orderBy('nom_formation')->get();
            // $domaines = Domaine::all();
            // $infos = DB::select('select * from moduleformation where module_id = ?', [$id])[0];

            $categorie = DB::select('select * from formations
            WHERE
           status = 1 limit 7 ');
            // $categorie = DB::select('select * from formations where status = 1 limit 8');
            $module = DB::select('select * from moduleformation where formation_id = 1 and status = 2 limit 6');
            return view('referent.catalogue.formation', compact('categorie','module'));
        }
    }

    public function create()
    {
        //
    }

    public function nouvelle_formation()
    {
        $domaine = Domaine::all();
        return view('admin.formation.nouvelleFormation', compact('domaine'));
    }

    public function store(Request $request)
    {
        //condition de validation de formulaire
        $request->validate(
            [
                'nom_formation' => ["required"]
            ],
            [
                'nom_formation.required' => 'Veuillez remplir le champ'
            ]
        );
        $id_user = Auth::user()->id;

        $id_cfp = cfp::where('user_id', $id_user)->value('id');

        //enregistrer les formations dans la bdd
        $formation = new formation();
        $formation->nom_formation = $request->nom_formation;
        $formation->domaine_id = $request->domaine;
        $formation->cfp_id = $id_cfp;

        $formation->save();


        return redirect()->route('liste_formation');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $maj = formation::where('id', $id)->update([
            'nom_formation' => $request->nom_formation
        ]);
        $id_module = formation::where('id', $id)->value('domaine_id');
        $maj_domaine = Domaine::where('id', $id_module)->update([
            'nom_domaine' => $request->domaine
        ]);
        return back();
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request, $id)
    {
        // $del = formation::where('id', $id)->delete();
        DB::delete('delete from formations where id = ?', [$id]);
        return back();
    }
    ///--------------CATALOGUE DE FORMATION ------------------------ //////////////
    public function rechercheParModule(Request $request)
    {
        $categorie = DB::select('select * from formations where status = 1');
        $nom_formation = $request->nom_formation;
        // $nom_formation = $request->input('nom_formation');
        if ($nom_formation == null) {
            // $infos = DB::select('select * from moduleFormation');
            $infos = DB::select('select * from moduleFormation where status = 2');
            $liste_avis = DB::select('select * from v_liste_avis limit 5');
            // $infos= module::query()
            //                          ->where('nom_formation', ' ', "%{$nom_fomation}%")
            //                         ->get();

            return view('referent.catalogue.liste_formation', compact('infos', 'liste_avis', 'categorie'));
        } else {
            // $id_formation = formation::where('nom_formation',$nom_formation)->value('id');
            $infos = DB::select('select * from moduleFormation where nom_formation like "%' . $nom_formation . '%" and status = 2');
            $liste_avis = DB::select('select * from v_liste_avis limit 5');
            return view('referent.catalogue.liste_formation', compact('infos', 'liste_avis', 'categorie'));
        }
    }
    //recheche formation
    // public function search(Request $request){
    //     $search = $request->input('search');

    //     $categorie= formation::query()
    //                             ->where('nom_formation', 'LIKE', "%{$search}%")
    //                             ->get();
    //     $domaines= Domaine::query()
    //                         ->where('nom_domaine','LIKE',"%{$search}%")
    //                         ->orwhere('sous_titre','LIKE',"%{$search}%")
    //                         ->get();
    // return view('referent.catalogue.resultat_formation', compact('domaines', 'categorie'));
    // }
    public function getModulesParReference(Request $request)
    {

        $search = $request->search;

        if ($search == '') {
            $formation = formation::orderby('nom_formation', 'asc')->select('id', 'nom_formation')->limit(5)->get();
        } else {
            $formation = DB::select('select id,nom_formation from formations where nom_formation like "%' . $search . '%" limit 0,5');
        }

        $response = array();
        foreach ($formation as $formations) {
            $response[] = array("value" => $formations->id, "label" => $formations->nom_formation);
        }
        return response()->json($response);
    }
    public function formation_domaine(Request $request)
    {
        $domaine_id = $request->domaine_id;
        $formations = DB::select('select * from formations where domaine_id = ?', [$domaine_id]);
        $modules = DB::select('select * from moduleformation where domaine_id = ? and status = 2', [$domaine_id]);
        return response()->json([$formations, $modules, $domaine_id]);
    }
    public function affichageParFormation($id)
    {
        $infos = DB::select('select * from moduleformation where formation_id = ? and status = 2', [$id]);
        $datas =DB::select('select module_id,formation_id,date_debut,date_fin from v_groupe_projet_entreprise_module where formation_id = ?',[$id]);
        return view('referent.catalogue.liste_formation', compact('infos','datas'));
    }

    public function affichageTousCategories()
    {
        $infos = DB::select('select * from moduleformation where status = 2');
        return view('referent.catalogue.tous_les_categories', compact('infos'));
    }

    public function affichageParModule($id)
    {
        $id = request('id');
        $categories = DB::select('select * from formations where status = 1');
        $test =  DB::select('select exists(select * from moduleformation where module_id = ' . $id . ' and status = 2) as moduleExiste');
        //on verifie si moduleformation contient le module_id
        if ($test[0]->moduleExiste == 1) {
            // $infos = DB::select('select * from moduleformation where formation_id = ?',[$id]);
            $infos = DB::select('select * from moduleformation where module_id = ? and status = 2', [$id]);
            $nb = DB::select('select ifnull(count(a.module_id),0) as nb_avis from moduleformation mf left join avis a on mf.module_id = a.module_id where mf.formation_id = ? and mf.status = 2 group by mf.formation_id', [$id]);
            if ($nb == null) {
                $nb_avis = 0;
            } else {
                $nb_avis = $nb[0]->nb_avis;
            }

            $cours = DB::select('select * from v_cours_programme where module_id = ?', [$id]);
            $programmes = DB::select('select * from programmes where module_id = ?', [$id]);
            $liste_avis = DB::select('select * from v_liste_avis where module_id = ? limit 5', [$id]);
            $datas =DB::select('select module_id,formation_id,date_debut,date_fin from v_groupe_projet_entreprise_module where module_id = ?',[$id]);
            return view('referent.catalogue.detail_formation', compact('infos','datas', 'cours', 'programmes', 'nb_avis', 'liste_avis', 'categories', 'id'));
        } else return redirect()->route('liste_formation');
    }
    public function categorie_formations()
    {

        $categorie = formation::all();
        return view('superadmin.catalogue.categories_formations', compact('categorie'));
    }
    public function ajout_categorie(Request $request)
    {
        $ids = $request->status;
        $nombre_1 = 1;
        $nombre_0 = 0;
        formation::where('status', 1)->update([
            'status' => $nombre_0
        ]);
        foreach ($ids as $id) {

            formation::where('id', $id)->update([
                'status' => $nombre_1
            ]);
        }
        return back();
    }
    public function affiche_categorie()
    {
        $categorie = DB::select('select formations.nom_formation
                    FROM
                    formations,
                    WHERE
                   status = 1;
                    ');
        return view('referent.catalogue.liste_formation', compact('categorie'));
    }
}
