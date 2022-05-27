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
use App\Models\FonctionGenerique;

class FormationController extends Controller
{

    public function __construct()
    {
        $this->fonct = new FonctionGenerique();
        $this->formation = new formation();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }
    public function index($id = null)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $id_user = Auth::user()->id;
        if (Gate::allows('isCFP')) {
            // $cfp_id = cfp::where('user_id', $id_user)->value('id');
            $formation = formation::with('Domaine')->orderBy('domaine_id')->get();
            return view('admin.formation.formation', compact('formation'));
        }
        if (Gate::allows('isSuperAdmin')) {
            $formation = formation::with('Domaine')->orderBy('domaine_id')->get();
            $test = 4;
            $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
            $offset = round($domaines_count[0]->nb_domaines / $test);
            $domaine_col1 = DB::select('select * from domaines limit '.$offset.'');
            $domaine_col2 = DB::select('select * from domaines limit '.$offset.' offset '.$offset.'');
            $domaine_col3 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*2).'');
            $domaine_col4 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*3).'');
            return view('admin.formation.formation', compact('formation','domaine_col1','domaine_col2','domaine_col3','domaine_col4'));
        }
        if (Gate::allows('isFormateur')) {
            $categorie = formation::orderBy('nom_formation')->get();
            $domaines = Domaine::all();
            $test = 4;
            $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
            $offset = round($domaines_count[0]->nb_domaines / $test);
            $domaine_col1 = DB::select('select * from domaines limit '.$offset.'');
            $domaine_col2 = DB::select('select * from domaines limit '.$offset.' offset '.$offset.'');
            $domaine_col3 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*2).'');
            $domaine_col4 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*3).'');
            return view('referent.catalogue.formation', compact('domaines', 'categorie','domaine_col1','domaine_col2','domaine_col3','domaine_col4'));
        }
        if (Gate::allows('isReferent') || Gate::allows('isStagiaire') || Gate::allows('isManager')) {
            //liste formation
            $categorie = formation::orderBy('nom_formation')->get();
            // $domaines = Domaine::all();
            $test = 4;
            $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
            $offset = round($domaines_count[0]->nb_domaines / $test);
            $domaine_col1 = DB::select('select * from domaines limit '.$offset.'');
            $domaine_col2 = DB::select('select * from domaines limit '.$offset.' offset '.$offset.'');
            $domaine_col3 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*2).'');
            $domaine_col4 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*3).'');
            // $domaine_col5 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*4).'');
            // $infos = DB::select('select * from moduleformation where module_id = ?', [$id])[0];
            // $categorie = DB::select('select * from formations where status = 1 limit 5');
            $module = DB::select('select * from moduleformation where  status = 2 and etat_id = 1 limit 6 ');
            return view('referent.catalogue.formation', compact('devise','categorie', 'module','domaine_col1','domaine_col2','domaine_col3','domaine_col4'));
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
        $maj = formation::where('id', $id)->update(['nom_formation' => $request->nom_formation]);
        $id_module = formation::where('id', $id)->value('domaine_id');
        $maj_domaine = Domaine::where('id', $id_module)->update(['nom_domaine' => $request->domaine]);
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

        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $categorie = DB::select('select * from formations where status = 1');
        $nom_formation = $request->nom_formation;
        $domaines = Domaine::all();
        $test = 4;
        $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
        $offset = round($domaines_count[0]->nb_domaines / $test);
        $domaine_col1 = DB::select('select * from domaines limit '.$offset.'');
        $domaine_col2 = DB::select('select * from domaines limit '.$offset.' offset '.$offset.'');
        $domaine_col3 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*2).'');
        $domaine_col4 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*3).'');
        // $infos = DB::select('select * from moduleFormation where nom_formation like ("%' . $nom_formation .'%") and status = 2 and etat_id = 1 order by nom_formation desc');
        // dd($infos);
        $datas = DB::select('select module_id,formation_id,date_debut,date_fin from v_groupe_projet_entreprise_module where type_formation_id = 2 group by module_id');
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        if ($nom_formation == null) {
            // $infos = DB::select('select * from moduleFormation');
            $infos = DB::select('select * from moduleformation where status = 2 and etat_id = 1');
            // dd($infos, $datas);
            $liste_avis = DB::select('select * from v_liste_avis limit 5');
            return view('referent.catalogue.liste_formation', compact('infos', 'datas', 'liste_avis', 'categorie','devise','nom_formation','domaines', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
        } else {

            // dd($datas);
            $id_formation = formation::where('nom_formation',$nom_formation)->value('id');
            $infos = DB::select('select * from moduleformation where nom_formation like ("%' . $nom_formation .'%") and status = 2 and etat_id = 1 order by nom_formation desc');
            $liste_avis = DB::select('select * from v_liste_avis limit 5');
            // dd($infos, $datas);
            return view('referent.catalogue.liste_formation', compact('infos', 'datas', 'liste_avis', 'categorie','devise','nom_formation','domaines', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
        }
    }

    public function affichage_formation(Request $request)
    {
        // dd("eto");
        $id_formation = $request->id;
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $categorie = DB::select('select * from formations where status = 1');
        $nom_formation = formation::where('id',$id_formation)->value('nom_formation');
        // dd($nom_formation);
        $domaines = Domaine::all();
        $test = 4;
        $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
        $offset = round($domaines_count[0]->nb_domaines / $test);
        $domaine_col1 = DB::select('select * from domaines limit '.$offset.'');
        $domaine_col2 = DB::select('select * from domaines limit '.$offset.' offset '.$offset.'');
        $domaine_col3 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*2).'');
        $domaine_col4 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*3).'');
        // $infos = DB::select('select * from moduleFormation where nom_formation like ("%' . $nom_formation .'%") and status = 2 and etat_id = 1 order by nom_formation desc');
        // dd($infos);
        $datas = DB::select('select module_id,formation_id,date_debut,date_fin from v_groupe_projet_entreprise_module where type_formation_id = 2');
        $infos = DB::select('select * from moduleformation where status = 2 and etat_id = 1 and formation_id = ? order by nom_formation desc',[$id_formation]);
        // dd($infos);
        $liste_avis = DB::select('select * from v_liste_avis limit 5');
        return view('referent.catalogue.liste_formation', compact('infos', 'datas', 'liste_avis', 'categorie','devise','nom_formation','domaines', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));

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
        $modules = DB::select('select * from moduleformation where domaine_id = ? and status = 2 and etat_id = 1', [$domaine_id]);
        return response()->json([$formations, $modules, $domaine_id]);
    }
    public function affichageParFormation($id)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $test1 = 4;
        $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
        $offset = round($domaines_count[0]->nb_domaines / $test1);
        $domaine_col1 = DB::select('select * from domaines limit '.$offset.'');
        $domaine_col2 = DB::select('select * from domaines limit '.$offset.' offset '.$offset.'');
        $domaine_col3 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*2).'');
        $domaine_col4 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*3).'');
        $infos = DB::select('select * from moduleformation where formation_id = ? and status = 2 and etat_id = 1', [$id]);
        $datas = DB::select('select module_id,formation_id,date_debut,date_fin from v_session_projet where formation_id = ? and type_formation_id = 2', [$id]);
        return view('referent.catalogue.liste_formation', compact('devise', 'infos', 'datas', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
    }

    public function affichageTousCategories()
    {
        $test1 = 4;
        $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
        $offset = round($domaines_count[0]->nb_domaines / $test1);
        $domaine_col1 = DB::select('select * from domaines limit '.$offset.'');
        $domaine_col2 = DB::select('select * from domaines limit '.$offset.' offset '.$offset.'');
        $domaine_col3 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*2).'');
        $domaine_col4 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*3).'');
        $infos = DB::select('select * from moduleformation where status = 2 and etat_id = 1');
        return view('referent.catalogue.tous_les_categories', compact('infos', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
    }

    public function affichageParModule($id)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $id = request('id');
        $domaines = Domaine::all();
        $categorie = DB::select('select * from formations where status = 1');
        $test =  DB::select('select exists(select * from moduleformation where module_id = ' . $id . ' and status = 2 and etat_id = 1) as moduleExiste');
        $test1 = 4;
        $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
        $offset = round($domaines_count[0]->nb_domaines / $test1);
        $domaine_col1 = DB::select('select * from domaines limit '.$offset.'');
        $domaine_col2 = DB::select('select * from domaines limit '.$offset.' offset '.$offset.'');
        $domaine_col3 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*2).'');
        $domaine_col4 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*3).'');
        //on verifie si moduleformation contient le module_id
        if ($test[0]->moduleExiste == 1) {
            // $infos = DB::select('select * from moduleformation where formation_id = ?',[$id]);
            $infos = DB::select('select * from moduleformation where module_id = ? and status = 2 and etat_id = 1', [$id]);
            // dd($infos);
            $nb = DB::select('select ifnull(count(a.module_id),0) as nb_avis from moduleformation mf left join avis a on mf.module_id = a.module_id where mf.formation_id = ? and mf.status = 2 and etat_id = 1 group by mf.formation_id', [$id]);
            if ($nb == null) {
                $nb_avis = 0;
            } else {
                $nb_avis = $nb[0]->nb_avis;
            }


            $cours = DB::select('select * from v_cours_programme where module_id = ?', [$id]);
            $programmes = DB::select('select * from programmes where module_id = ?', [$id]);
            $liste_avis = DB::select('select * from v_liste_avis where module_id = ? limit 5', [$id]);
            $competences = DB::select('select titre_competence from competence_a_evaluers where module_id = ?',[$id]);
            $datas = DB::select('select module_id,formation_id,date_debut,date_fin,groupe_id,type_formation_id,adresse_lot,adresse_ville from v_session_projet where module_id = ? and type_formation_id = 2', [$id]);
            return view('referent.catalogue.detail_formation', compact('devise','infos', 'datas', 'cours', 'programmes', 'nb_avis', 'liste_avis', 'categorie', 'id','competences','domaines', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
        } else
            dd("eto");
        return redirect()->route('liste_formation');
    }
    public function categorie_formations()
    {

        $categorie = formation::all();
        // $ctg= formation::where('status', 1)->get();
        $formation=DB::select('select * from formations where status=?',[1]);
        // dd($ctg);
        return view('superadmin.catalogue.categories_formations', compact('categorie','formation'));
    }
    public function module_formations()
    {

        $module = module::all();
        // $modules=module::where(['status', 2])->where(['etat_id', 1])->get();
        return view('superadmin.catalogue.formation_publier', compact('module','modules'));
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
    public function ajout_module(Request $request)
    {
        $ids = $request->status;
        $nombre_1 = 2;
        $nombre_0 = 0;
        module::where('status', 2)->update([
            'status' => $nombre_0
        ]);
        foreach ($ids as $id) {

            module::where('id', $id)->update([
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

    public function inscription(Request $request)
    {
        $id_groupe = $request->id_groupe;
        $id_type_formation = $request->type_formation_id;
        return redirect()->route('detail_session', ['id_session' => $id_groupe, 'type_formation' => $id_type_formation]);
    }

    /*  public function annuaire(){
        if (Gate::allows('isReferent') || Gate::allows('isStagiaire') || Gate::allows('isManager')) {
            $initial = DB::select('select distinct(LEFT(nom,1)) as initial from cfps order by initial asc');
            $pagination = Cfp::orderBy('nom')->paginate(1);
            return view('referent.catalogue.cfp_tous', compact('pagination','initial'));
        }
    } */

    public function annuaire($nbPagination = null)
    {
        $nb_limit = 10;
        if ($nbPagination == null || $nbPagination <= 0) {
            $nbPagination = 1;
        }

        if (Gate::allows('isReferent') || Gate::allows('isStagiaire') || Gate::allows('isManager')) {
            $initial = DB::select('select distinct(LEFT(nom,1)) as initial from cfps order by initial asc');
            $cfps = $this->fonct->findWhereTrieOrderBy("cfps", [1], ["="], [1], ["nom"], "ASC", ($nbPagination), $nb_limit);
            $totaleData = $this->fonct->getNbrePagination("cfps", "id", [], [], [], "");
            $pagination = $this->fonct->nb_liste_pagination($totaleData,  $nbPagination, $nb_limit);
            $secteurs = $this->fonct->findAll("secteurs");

            return view('referent.catalogue.cfp_tous', compact('secteurs', 'cfps', 'pagination', 'initial'));
        }
    }

    public function search_par_nom_entiter(Request $req, $nbPagination = null, $nom_entiter_pag = null)
    {
        $nom_entiter = null;
        $nb_limit = 10;
        if ($nbPagination == null || $nbPagination <= 0) {
            $nbPagination = 1;
        }

        if ($nom_entiter_pag != null) {
            $nom_entiter = $nom_entiter_pag;
        } else {
            $nom_entiter = $req->nom_entiter;
        }

        if (Gate::allows('isReferent') || Gate::allows('isStagiaire') || Gate::allows('isManager')) {
            $initial = DB::select('select distinct(LEFT(nom,1)) as initial from cfps order by initial asc');
            $cfps = $this->fonct->findWhereTrieOrderBy("cfps", ["upper(nom)"], ["LIKE"], ["%" . $nom_entiter . "%"], ["nom"], "ASC", ($nbPagination), $nb_limit);

            $totaleData = $this->fonct->getNbrePagination("cfps", "id", ["upper(nom)"], ["LIKE"], ["%" . $nom_entiter . "%"], "AND");
            $pagination = $this->formation->nb_entiter_pagination($nom_entiter,  $nbPagination, $nb_limit);
            $secteurs = $this->fonct->findAll("secteurs");
            return view('referent.catalogue.cfp_tous', compact('nom_entiter', 'secteurs', 'cfps', 'pagination', 'initial'));
        }
    }

    public function search_par_adresse(Request $req, $nbPagination = null, $qter = null, $vlle = null, $cde_post = null, $reg = null)
    {
        $quartier = null;
        $ville = null;
        $code_postal = null;
        $region = null;

        $nb_limit = 10;
        if ($nbPagination == null || $nbPagination <= 0) {
            $nbPagination = 1;
        }

        if ($qter != null) {
            $quartier = $qter;
            $ville = $vlle;
            $code_postal = $cde_post;
            $region = $reg;
        } else {
            $nom_entiter = $req->nom_entiter;

            $quartier = $req->qter;
            $ville = $req->vlle;
            $code_postal = $req->cde_post;
            $region = $req->reg;
        }

        if (Gate::allows('isReferent') || Gate::allows('isStagiaire') || Gate::allows('isManager')) {
            $initial = DB::select('select distinct(LEFT(nom,1)) as initial from cfps order by initial asc');

            $cfps = $this->fonct->findWhereTrieOrderBy(
                "cfps",
                ["adresse_quartier", "adresse_ville", "adresse_code_postal", "adresse_region"],
                ["=", "=", "=", "="],
                [$quartier, $ville, $code_postal, $region],
                ["nom"],
                "ASC",
                ($nbPagination),
                $nb_limit
            );

            $totaleData = $this->fonct->getNbrePagination(
                "cfps",
                "nom",
                ["adresse_quartier", "adresse_ville", "adresse_code_postal", "adresse_region"],
                ["=", "=", "=", "="],
                [$quartier, $ville, $code_postal, $region],
                "AND"
            );

            $pagination = $this->fonct->nb_liste_pagination($totaleData, $nbPagination, $nb_limit);
            $secteurs = $this->fonct->findAll("secteurs");
            return view('referent.catalogue.cfp_tous', compact('quartier', 'ville', 'code_postal', 'region', 'secteurs', 'cfps', 'pagination', 'initial'));
        }
    }





    public function alphabet_filtre(Request $request)
    {
        $nb_limit = 10;
        $query = "";
        if (isset($request->nom_entiter)) {
            $cfp = $this->fonct->findWhereTrieOrderBy(
                "cfps",
                ["nom", "nom"],
                ["LIKE", "LIKE"],
                [$request->Alpha . "%", "%" . $request->nom_entiter . "%"],
                ["nom"],
                "ASC",
                0,
                $nb_limit
            );
        } else if (isset($request->quartier) && isset($request->ville) && isset($request->code_postal) && isset($request->region)) {

            $cfp = $this->fonct->findWhereTrieOrderBy(
                "cfps",
                ["nom", "adresse_quartier", "adresse_ville", "adresse_code_postal", "adresse_region"],
                ["LIKE", "=", "=", "=", "="],
                [$request->Alpha . "%", $request->quartier, $request->ville, $request->code_postal, $request->region],
                ["nom"],
                "ASC",
                0,
                $nb_limit
            );
        } else {
            // $query = $this->fonct->queryWhereTrieOrderBy(
            //     "cfps",
            //     ["nom"],
            //     ["LIKE"],
            //     [$request->Alpha . "%"],
            //     ["nom"],
            //     "ASC",
            //     0,
            //     $nb_limit
            // );

            $cfp = $this->fonct->findWhereTrieOrderBy(
                "cfps",
                ["nom"],
                ["LIKE"],
                [$request->Alpha . "%"],
                ["nom"],
                "ASC",
                0,
                $nb_limit
            );
        }

        //    $cfp = DB::select('select * from cfps where nom like "' . $alpha . '%" order by nom asc');
        return response()->json($cfp);
    }

    public function detail_cfp($id)
    {

        $fonct = new FonctionGenerique();
        $cfp = $fonct->findWhereMulitOne("cfps", ["id"], [$id]);
        $horaire = DB::select('select * from v_horaire_cfp where cfp_id = ? ', [$id]);

        $reseau_sociaux = $fonct->findWhere("v_reseaux_sociaux_cfp", ["cfp_id"], [$id]);
        $formation = DB::select('select nom_formation,id,cfp_id from v_formation where cfp_id = ?', [$id]);
        return view('referent.catalogue.detail_cfp', compact('cfp', 'formation', 'reseau_sociaux', 'horaire'));
    }

    public function affichageParFormationParcfp($id_formation, $id_cfp)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $infos = DB::select('select * from moduleformation where formation_id = ? and status = 2 and cfp_id = ? and etat_id = 1', [$id_formation, $id_cfp]);
        $datas = DB::select('select module_id,formation_id,date_debut,date_fin from v_session_projet where formation_id = ? and type_formation_id = 2', [$id_formation]);
        $test = 4;
        $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
        $offset = round($domaines_count[0]->nb_domaines / $test);
        $domaine_col1 = DB::select('select * from domaines limit '.$offset.'');
        $domaine_col2 = DB::select('select * from domaines limit '.$offset.' offset '.$offset.'');
        $domaine_col3 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*2).'');
        $domaine_col4 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*3).'');
        $categorie = formation::orderBy('nom_formation')->get();
        $nom_formation = formation::where('id',$id_formation)->value('nom_formation');

        return view('referent.catalogue.liste_formation', compact('infos', 'datas','devise', 'nom_formation', 'categorie', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
    }

    public function domaine_vers_formation(Request $request)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $domaine_id = $request->id;
        $formations = DB::select('select * from formations where domaine_id = ?', [$domaine_id]);
        $test = 4;
        $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
        $offset = round($domaines_count[0]->nb_domaines / $test);
        $domaine_col1 = DB::select('select * from domaines limit '.$offset.'');
        $domaine_col2 = DB::select('select * from domaines limit '.$offset.' offset '.$offset.'');
        $domaine_col3 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*2).'');
        $domaine_col4 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*3).'');
        $categorie = formation::orderBy('nom_formation')->get();
        $nom_domaine = DB::select('select nom_domaine from domaines where id = ?',[$domaine_id]);
        // dd($nom_domaine);
        // $formation_id = $formations[0]->id;
        $modules = DB::select('select md.id, md.nom_module, md.formation_id,md.cfp_id, md.duree, md.duree_jour, md.prix, md.prix_groupe, md.modalite_formation, cfp.nom from modules as md join formations as frmt on md.formation_id = frmt.id join domaines as dm on frmt.domaine_id = dm.id join cfps as cfp on md.cfp_id = cfp.id where md.status = 2 and md.etat_id = 1');
        $modules_counts = DB::select('select count(*) as nb_modules, md.formation_id from modules as md join formations as frmt on md.formation_id = frmt.id where md.status = 2 and md.etat_id = 1 group by md.formation_id');
        // dd($modules_counts);
        return view('referent.catalogue.domaine', compact('formations', 'modules', 'modules_counts', 'categorie', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4','nom_domaine','devise'));
    }

    public function demande_devis_client(Request $request){

        $id_module = $request->id;
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        $test = 4;
        $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
        $offset = round($domaines_count[0]->nb_domaines / $test);
        $domaine_col1 = DB::select('select * from domaines limit '.$offset.'');
        $domaine_col2 = DB::select('select * from domaines limit '.$offset.' offset '.$offset.'');
        $domaine_col3 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*2).'');
        $domaine_col4 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*3).'');
        $categorie = formation::orderBy('nom_formation')->get();

        $domaine_id = $request->id;
        $formations = DB::select('select * from formations where domaine_id = ?', [$domaine_id]);
        $modules = DB::select('select md.id, md.nom_module, md.formation_id,md.cfp_id, md.duree, md.duree_jour, md.prix, md.prix_groupe, md.modalite_formation, cfp.nom from modules as md join formations as frmt on md.formation_id = frmt.id join cfps as cfp on md.cfp_id = cfp.id where md.status = 2 and md.etat_id = 1 and md.id = ?',[$id_module]);
        $modules_counts = DB::select('select count(*) as nb_modules, md.formation_id from modules as md join formations as frmt on md.formation_id = frmt.id where md.status = 2 and md.etat_id = 1 group by md.formation_id');
        return view('referent.catalogue.demande_devis', compact('formations', 'modules', 'modules_counts','devise', 'categorie', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
    }
}
