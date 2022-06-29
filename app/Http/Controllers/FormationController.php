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
use App\responsable_cfp;
use App\demande_devis;
use App\Niveau;

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
            $domaine_col1 = DB::select('select * from domaines limit ' . $offset . '');
            $domaine_col2 = DB::select('select * from domaines limit ' . $offset . ' offset ' . $offset . '');
            $domaine_col3 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 2) . '');
            $domaine_col4 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 3) . '');
            return view('admin.formation.formation', compact('formation', 'domaine', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
        }
        if (Gate::allows('isFormateur')) {
            $categorie = formation::orderBy('nom_formation')->get();
            $domaines = Domaine::all();
            $test = 4;
            $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
            $offset = round($domaines_count[0]->nb_domaines / $test);
            $domaine_col1 = DB::select('select * from domaines limit ' . $offset . '');
            $domaine_col2 = DB::select('select * from domaines limit ' . $offset . ' offset ' . $offset . '');
            $domaine_col3 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 2) . '');
            $domaine_col4 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 3) . '');
            return view('referent.catalogue.formation', compact('domaines', 'categorie', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
        }
        if (Gate::allows('isReferent') || Gate::allows('isStagiaire') || Gate::allows('isManager')) {
            //liste formation
            $categorie = formation::orderBy('nom_formation')->get();
            $domaines = Domaine::all();
            $test = 4;
            $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
            $offset = round($domaines_count[0]->nb_domaines / $test);
            $domaine_col1 = DB::select('select * from domaines limit ' . $offset . '');
            $domaine_col2 = DB::select('select * from domaines limit ' . $offset . ' offset ' . $offset . '');
            $domaine_col3 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 2) . '');
            $domaine_col4 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 3) . '');
            // $domaine_col5 = DB::select('select * from domaines limit '.$offset.' offset '.($offset*4).'');
            // $infos = DB::select('select * from moduleformation where module_id = ?', [$id])[0];
            // $categorie = DB::select('select * from formations where status = 1 limit 5');
            $module = DB::select('select md.*,vm.nombre as total_avis from v_nombre_avis_par_module as vm RIGHT join moduleformation as md on md.module_id = vm.module_id where  status = 2 and etat_id = 1 order by md.pourcentage desc limit 2 ');
            return view('referent.catalogue.formation', compact('devise','domaines', 'categorie', 'module', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
        }
    }

    public function listeCrud($id = null){
        $domaine = Domaine::orderBy('nom_domaine', 'asc')->paginate(10, ['*'], 'domaine');
        $formation  = formation::orderBy('nom_formation', 'asc')->paginate(10, ['*'], 'formation');
        return view("admin.formation.liste_formation",compact('formation','domaine'));
    }

    public function nouvelle_formation()
    {
        $domaine = Domaine::all();
        return view('admin.formation.nouvelleFormation', compact('domaine'));
    }

    public function create(){
        $liste_domaine = DB::select('select * from domaines');
        return view('superadmin.nouveau_formation', compact('liste_domaine'));
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

        //enregistrer les formations dans la bdd
        $formation = new formation();
        $formation->nom_formation = $request->nom_formation;
        $formation->domaine_id = $request->domaine_id;
        $formation->save();

        // redirection
        $liste_domaine = Domaine::all();
        $message = 'La formation a bien été ajoutée. <a href="crud_formation#Formations"> Voir la liste</a>';
        return view('superadmin.nouveau_formation', compact('liste_domaine','message'));

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

    public function update(Request $request)
    {
        formation::where('id', $request->id)->update(['nom_formation' => $request->nom_formation]);
        return back();
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        DB::delete('delete from formations where id = ?', [$id]);
        return back();
    }
    ///--------------CATALOGUE DE FORMATION ------------------------ //////////////
    public function rechercheParModule(Request $request, $nbPagination_pag = null, $nom_formation_pag = null)
    {

        $nbPagination = null;
        $nom_formation = null;
        $nb_limit = 5;

        if (isset($nom_formation_pag)) {
            $nom_formation = $nom_formation_pag;
        } else {
            $nom_formation = $request->nom_formation;
        }
        if (isset($nbPagination_pag)) {
            $nbPagination = $nbPagination_pag;
        }
        if ($nbPagination < 0  || $nbPagination == null) {
            $nbPagination = 1;
        }

        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $categorie = DB::select('select * from formations where status = 1');
        $domaines = Domaine::all();
        $test = 4;
        $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
        $offset = round($domaines_count[0]->nb_domaines / $test);
        $domaine_col1 = DB::select('select * from domaines limit ' . $offset . '');
        $domaine_col2 = DB::select('select * from domaines limit ' . $offset . ' offset ' . $offset . '');
        $domaine_col3 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 2) . '');
        $domaine_col4 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 3) . '');

        $query2 = '(SELECT md.*,vm.nombre as total_avis FROM v_nombre_avis_par_module as vm RIGHT JOIN moduleformation as md on md.module_id = vm.module_id WHERE md.nom_formation like (?) and md.status = 2 and md.etat_id = 1 LIMIT ' . $nb_limit . ' OFFSET ' . ($nbPagination - 1) . ') AS t1';
        $query1 = 'SELECT * FROM ';
        $query = $query1 . " " . $query2;
        $query .= "  ORDER BY pourcentage DESC";

        $totale_module = $this->fonct->getNbrePagination("moduleformation", "module_id", ["nom_formation", "status", "etat_id"], ["LIKE", "=", "="], ["%" . $nom_formation . "%", 2, 1], "AND");
        $pagination = $this->fonct->nb_liste_pagination($totale_module, $nbPagination, $nb_limit);

        $infos = DB::select($query, ["%" . $nom_formation . "%"]);
// dd($infos);
        $organismes = DB::select('select * from cfps');
        $competences = DB::select('select * from competence_a_evaluers');
        $formations = DB::select('select * from formations');

        $datas = DB::select('select module_id,formation_id,date_debut,date_fin,groupe_id,type_formation_id from v_groupe_projet_module where type_formation_id = 2 group by module_id');

        return view('referent.catalogue.liste_formation', compact('formations', 'competences', 'organismes', 'nom_formation', 'pagination', 'infos', 'datas', 'categorie', 'devise', 'nom_formation', 'domaines', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));

        /*   if ($nom_formation == null) {
            $infos = DB::select('select *,vm.nombre as total_avis from v_nombre_avis_par_module as vm RIGHT join moduleformation as md on md.module_id = vm.module_id where md.status = 2 and md.etat_id = 1 order by md.nom_formation asc');
            // dd($infos);
            return view('referent.catalogue.liste_formation', compact('infos', 'datas', 'categorie','devise','nom_formation','domaines', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
        } else {
            $id_formation = formation::where('nom_formation',$nom_formation)->value('id');
            $infos = DB::select('select *,vm.nombre as total_avis from v_nombre_avis_par_module as vm RIGHT join moduleformation as md on md.module_id = vm.module_id where md.nom_formation like ("%' . $nom_formation .'%") and md.status = 2 and md.etat_id = 1 order by md.nom_formation asc');
            // dd($infos);

            return view('referent.catalogue.liste_formation', compact('infos', 'datas', 'categorie','devise','nom_formation','domaines', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
        } */
    }

    public function affichage_formation(Request $request)
    {
        $id_formation = $request->id;
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $categorie = DB::select('select * from formations where status = 1');
        $nom_formation = formation::where('id', $id_formation)->value('nom_formation');
        $domaines = Domaine::all();
        $test = 4;
        $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
        $offset = round($domaines_count[0]->nb_domaines / $test);
        $domaine_col1 = DB::select('select * from domaines limit ' . $offset . '');
        $domaine_col2 = DB::select('select * from domaines limit ' . $offset . ' offset ' . $offset . '');
        $domaine_col3 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 2) . '');
        $domaine_col4 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 3) . '');
        $datas = DB::select('select module_id,formation_id,date_debut,date_fin,groupe_id,type_formation_id from v_groupe_projet_entreprise_module where type_formation_id = 2 group by module_id');
        $infos = DB::select('select *,vm.nombre as total_avis from v_nombre_avis_par_module as vm RIGHT join moduleformation as md on md.module_id = vm.module_id where md.status = 2 and md.etat_id = 1 and md.formation_id = ? order by md.nom_formation asc', [$id_formation]);
        return view('referent.catalogue.liste_formation', compact('infos', 'datas', 'categorie', 'devise', 'nom_formation', 'domaines', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
    }

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
        $domaine_col1 = DB::select('select * from domaines limit ' . $offset . '');
        $domaine_col2 = DB::select('select * from domaines limit ' . $offset . ' offset ' . $offset . '');
        $domaine_col3 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 2) . '');
        $domaine_col4 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 3) . '');
        $infos = DB::select('select * from moduleformation where formation_id = ? and status = 2 and etat_id = 1', [$id]);
        $datas = DB::select('select module_id,formation_id,date_debut,date_fin,groupe_id,type_formation_id from v_session_projet where formation_id = ? and type_formation_id = 2 group by module_id', [$id]);
        return view('referent.catalogue.liste_formation', compact('devise', 'infos', 'datas', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
    }

    public function affichageTousCategories()
    {
        $test1 = 4;
        $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
        $offset = round($domaines_count[0]->nb_domaines / $test1);
        $domaine_col1 = DB::select('select * from domaines limit ' . $offset . '');
        $domaine_col2 = DB::select('select * from domaines limit ' . $offset . ' offset ' . $offset . '');
        $domaine_col3 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 2) . '');
        $domaine_col4 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 3) . '');
        $infos = DB::select('select * from moduleformation where status = 2 and etat_id = 1');
        return view('referent.catalogue.tous_les_categories', compact('infos', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
    }

    public function affichageParModule($id)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $id = request('id');
        $domaines = Domaine::all();
        $niveau = DB::select('select * from niveaux');
        $categorie = DB::select('select * from formations where status = 1');
        $test =  DB::select('select exists(select * from moduleformation where module_id = ' . $id . ' and status = 2 and etat_id = 1) as moduleExiste');
        $test1 = 4;
        $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
        $offset = round($domaines_count[0]->nb_domaines / $test1);
        $domaine_col1 = DB::select('select * from domaines limit ' . $offset . '');
        $domaine_col2 = DB::select('select * from domaines limit ' . $offset . ' offset ' . $offset . '');
        $domaine_col3 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 2) . '');
        $domaine_col4 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 3) . '');
        //on verifie si moduleformation contient le module_id
        if ($test[0]->moduleExiste == 1) {
            $infos = DB::select('select * from moduleformation where module_id = ? and status = 2 and etat_id = 1', [$id]);
            // dd($infos);
            $nb = DB::select('select count(*) as nb_avis from v_liste_avis where module_id = ?', [$id]);
            if ($nb == null) {
                $nb_avis = 0;
            } else {
                $nb_avis = $nb[0]->nb_avis;
            }
            $cours = DB::select('select * from v_cours_programme where module_id = ?', [$id]);
            $programmes = DB::select('select * from programmes where module_id = ?', [$id]);
            $liste_avis = DB::select('select *, SUBSTRING(nom_stagiaire, 1, 1) as nom_stagiaire from v_liste_avis where module_id = ? limit 10', [$id]);
            $liste_avis_count = DB::select('select *, SUBSTRING(nom_stagiaire, 1, 1) as nom_stagiaire from v_liste_avis where module_id = ?', [$id]);
            $statistiques = DB::select('select * from v_statistique_avis where module_id = ?',[$id]);
            $avis_etoile = DB::select('select round(SUM(vn.note) / SUM(vn.nombre_note), 2) as pourcentage, SUM(vn.nombre_note) as nb_avis, md.cfp_id from v_nombre_note as vn join moduleformation as md on vn.module_id = md.module_id join cfps as cfp on md.cfp_id = cfp.id where md.cfp_id = cfp.id group by md.cfp_id');
            // dd($avis_etoile);
            $competences = DB::select('select titre_competence from competence_a_evaluers where module_id = ?',[$id]);
            $datas = DB::select('select module_id,formation_id,date_debut,date_fin,groupe_id,type_formation_id,adresse_lot,adresse_ville from v_session_projet where module_id = ? and type_formation_id = 2 group by module_id', [$id]);
            return view('referent.catalogue.detail_formation', compact('devise','infos','niveau','statistiques','avis_etoile', 'datas', 'cours', 'programmes', 'nb_avis', 'liste_avis','liste_avis_count', 'categorie', 'id','competences','domaines', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
        } else
            return redirect()->route('liste_formation');
    }
    public function categorie_formations()
    {

        $categorie = formation::all();
        // $ctg= formation::where('status', 1)->get();
        $formation = DB::select('select * from formations where status=?', [1]);
        // dd($ctg);
        return view('superadmin.catalogue.categories_formations', compact('categorie', 'formation'));
    }
    public function module_formations()
    {

        $module = module::all();
        // $modules=module::where(['status', 2])->where(['etat_id', 1])->get();
        return view('superadmin.catalogue.formation_publier', compact('module', 'modules'));
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

    public function annuaire($nbPagination_pag = null)
    {
        $fonct = new FonctionGenerique();
        $nb_limit = 10;
        $nbPagination = 0;
        if (isset($nbPagination_pag)) {
            $nbPagination = $nbPagination_pag;
        } else {
            $nbPagination = 1;
        }
        if (Gate::allows('isReferent') || Gate::allows('isStagiaire') || Gate::allows('isManager')) {
            $initial = DB::select('select distinct(LEFT(nom,1)) as initial from cfps order by initial asc');
            $cfps = $this->fonct->findWhereTrieOrderBy("cfps", [1], ["="], [1], ["nom"], "ASC", ($nbPagination), $nb_limit);
            $totaleData = $this->fonct->getNbrePagination("cfps", "id", [], [], [], "");
            $pagination = $this->fonct->nb_liste_pagination($totaleData,  $nbPagination, $nb_limit);
            $secteurs = $this->fonct->findAll("secteurs");
            $user_id = Auth::id();
            $resp_etp_connecter = $fonct->findWhereMulitOne('responsables', ["user_id"], [$user_id]);
            $responsable = DB::select("select * from responsables where entreprise_id=? and id!=?", [$resp_etp_connecter->entreprise_id, $resp_etp_connecter->id]);
            $collaboration = DB::select('select decs.* from demmande_etp_cfp as decs join cfps as cfp on decs.inviter_cfp_id = cfp.id where decs.activiter = ? and decs.demmandeur_etp_id = ? and decs.inviter_cfp_id = cfp.id',[1, $resp_etp_connecter->entreprise_id]);
            $avis_etoile = DB::select('select round(SUM(vn.note) / SUM(vn.nombre_note), 2) as pourcentage, SUM(vn.nombre_note) as nb_avis, md.cfp_id from v_nombre_note as vn join moduleformation as md on vn.module_id = md.module_id join cfps as cfp on md.cfp_id = cfp.id where md.cfp_id = cfp.id group by md.cfp_id');
            $type_abonnement = DB::select('select abc.type_abonnement_id, tpof.nom_type, abc.cfp_id from abonnement_cfps as abc join type_abonnements_of as tpof on abc.type_abonnement_id = tpof.id join cfps as cfp on abc.cfp_id = cfp.id where abc.cfp_id = cfp.id and abc.activite = 1');
            // dd($type_abonnement);

            return view('referent.catalogue.cfp_tous', compact('secteurs', 'cfps', 'pagination', 'initial','collaboration','avis_etoile','type_abonnement'));
        }
    }

    public function search_par_nom_entiter(Request $req, $nbPagination = null, $nom_entiter_pag = null)
    {
        $fonct = new FonctionGenerique();
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
        $fonct = new FonctionGenerique();
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
            $user_id = Auth::id();
            $resp_etp_connecter = $fonct->findWhereMulitOne('responsables', ["user_id"], [$user_id]);
            $responsable = DB::select("select * from responsables where entreprise_id=? and id!=?", [$resp_etp_connecter->entreprise_id, $resp_etp_connecter->id]);
            $collaboration = DB::select('select decs.* from demmande_etp_cfp as decs join cfps as cfp on decs.inviter_cfp_id = cfp.id where decs.activiter = ? and decs.demmandeur_etp_id = ? and decs.inviter_cfp_id = cfp.id',[1, $resp_etp_connecter->entreprise_id]);
            $avis_etoile = DB::select('select round(SUM(vn.note) / SUM(vn.nombre_note), 2) as pourcentage, SUM(vn.nombre_note) as nb_avis, md.cfp_id from v_nombre_note as vn join moduleformation as md on vn.module_id = md.module_id join cfps as cfp on md.cfp_id = cfp.id where md.cfp_id = cfp.id group by md.cfp_id');
            $type_abonnement = DB::select('select abc.type_abonnement_id, tpof.nom_type, abc.cfp_id from abonnement_cfps as abc join type_abonnements_of as tpof on abc.type_abonnement_id = tpof.id join cfps as cfp on abc.cfp_id = cfp.id where abc.cfp_id = cfp.id and abc.activite = 1');
            return view('referent.catalogue.cfp_tous', compact('quartier', 'ville', 'code_postal', 'region', 'secteurs', 'cfps', 'pagination', 'initial','collaboration','type_abonnement','avis_etoile'));
        }
    }

    public function alphabet_filtre(Request $request)
    {
        $fonct = new FonctionGenerique();
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
        $user_id = Auth::id();
        $resp_etp_connecter = $fonct->findWhereMulitOne('responsables', ["user_id"], [$user_id]);
        $responsable = DB::select("select * from responsables where entreprise_id=? and id!=?", [$resp_etp_connecter->entreprise_id, $resp_etp_connecter->id]);
        $collaboration = DB::select('select decs.* from demmande_etp_cfp as decs join cfps as cfp on decs.inviter_cfp_id = cfp.id where decs.activiter = ? and decs.demmandeur_etp_id = ? and decs.inviter_cfp_id = cfp.id',[1, $resp_etp_connecter->entreprise_id]);
        $avis_etoile = DB::select('select round(SUM(vn.note) / SUM(vn.nombre_note), 2) as pourcentage, SUM(vn.nombre_note) as nb_avis, md.cfp_id from v_nombre_note as vn join moduleformation as md on vn.module_id = md.module_id join cfps as cfp on md.cfp_id = cfp.id where md.cfp_id = cfp.id group by md.cfp_id');
        $type_abonnement = DB::select('select abc.type_abonnement_id, tpof.nom_type, abc.cfp_id from abonnement_cfps as abc join type_abonnements_of as tpof on abc.type_abonnement_id = tpof.id join cfps as cfp on abc.cfp_id = cfp.id where abc.cfp_id = cfp.id and abc.activite = 1');
        return response()->json(['cfp'=>$cfp,'collab'=>$collaboration,'avis'=>$avis_etoile,'type'=>$type_abonnement]);
    }

    public function detail_cfp($id)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        $fonct = new FonctionGenerique();
        $cfp = $fonct->findWhereMulitOne("cfps", ["id"], [$id]);
        $horaire = DB::select('select * from v_horaire_cfp where cfp_id = ? ', [$id]);
        $modules = DB::select('select md.pourcentage,md.module_id, md.nom_module, md.formation_id,md.cfp_id, md.duree, md.duree_jour, md.prix, md.prix_groupe, md.modalite_formation, cfp.nom, vm.nombre as total_avis from v_nombre_avis_par_module as vm RIGHT join moduleformation as md on md.module_id = vm.module_id join formations as frmt on md.formation_id = frmt.id join domaines as dm on frmt.domaine_id = dm.id join cfps as cfp on md.cfp_id = cfp.id where md.status = 2 and md.etat_id = 1 order by md.pourcentage desc');
        $modules_counts = DB::select('select count(*) as nb_modules, md.formation_id from modules as md join formations as frmt on md.formation_id = frmt.id where md.status = 2 and md.etat_id = 1 group by md.formation_id');
        $reseau_sociaux = $fonct->findWhere("v_reseaux_sociaux_cfp", ["cfp_id"], [$id]);
        $formation = DB::select('select frmt.nom_formation,frmt.id from formations as frmt join modules as md on frmt.id = md.formation_id where md.cfp_id = ? and md.etat_id = 1 group by frmt.nom_formation,frmt.id', [$id]);
        $domaine_cfp = DB::select('select nom_domaine from domaines as dm join formations as frmt on dm.id = frmt.domaine_id join modules as md on frmt.id = md.formation_id where md.cfp_id = ? group by dm.nom_domaine', [$id]);
        $liste_avis = DB::select('select SUBSTRING(lsta.nom_stagiaire, 1, 1) as nom_stagiaire, lsta.prenom_stagiaire, lsta.date_avis, lsta.note, lsta.commentaire from v_liste_avis as lsta join modules as md on lsta.module_id = md.id join cfps as cfp on md.cfp_id = cfp.id where md.cfp_id = ? order by lsta.date_avis desc limit 10', [$id]);
        $liste_avis_count = DB::select('select SUBSTRING(lsta.nom_stagiaire, 1, 1) as nom_stagiaire, lsta.prenom_stagiaire, lsta.date_avis, lsta.note, lsta.commentaire from v_liste_avis as lsta join modules as md on lsta.module_id = md.id join cfps as cfp on md.cfp_id = cfp.id where md.cfp_id = ? order by lsta.date_avis desc', [$id]);
        $pourcentage_cfp = DB::select('select vpa.note, vpa.nombre_note, SUM(vpa.pourcentage_note * vpa.nombre_note) as nb_pourcent, SUM(vpa.nombre_note) as nombre_note from v_pourcentage_avis as vpa join moduleformation as md on vpa.module_id = md.module_id where md.cfp_id = ?',[$id]);
        $avis_cfp = DB::select('select vptc.nb_pourcent, vpa.note, vpa.nombre_note, ROUND((SUM(vpa.pourcentage_note * vpa.nombre_note)*100) / vptc.nb_pourcent, 2) as pourcentage, SUM(vpa.nombre_note) as nombre_note from v_pourcentage_avis as vpa join moduleformation as md on vpa.module_id = md.module_id join v_pourcentage_total_module_cfp as vptc where md.cfp_id = ? group by vpa.note,vptc.nb_pourcent',[$id]);
        $avis_etoile = DB::select('select round(SUM(vn.note) / SUM(vn.nombre_note), 2) as pourcentage, SUM(vn.nombre_note) as nb_avis from v_nombre_note as vn join moduleformation as md on vn.module_id = md.module_id where md.cfp_id = ?',[$id]);
        $user_id = Auth::id();
        $resp_etp_connecter = $fonct->findWhereMulitOne('responsables', ["user_id"], [$user_id]);
        $responsable = DB::select("select * from responsables where entreprise_id=? and id!=?", [$resp_etp_connecter->entreprise_id, $resp_etp_connecter->id]);
        $collaboration = DB::select('select decs.* from demmande_etp_cfp as decs join cfps as cfp on decs.inviter_cfp_id = cfp.id where decs.activiter = ? and decs.demmandeur_etp_id = ? and decs.inviter_cfp_id = cfp.id',[1, $resp_etp_connecter->entreprise_id]);
        $type_abonnement = DB::select('select abc.type_abonnement_id, tpof.nom_type, abc.cfp_id from abonnement_cfps as abc join type_abonnements_of as tpof on abc.type_abonnement_id = tpof.id join cfps as cfp on abc.cfp_id = cfp.id where abc.cfp_id = cfp.id and abc.activite = 1');
    //    dd($cfp);
        return view('referent.catalogue.detail_cfp', compact('cfp', 'liste_avis','liste_avis_count', 'avis_cfp', 'avis_etoile', 'formation', 'reseau_sociaux', 'horaire', 'modules_counts', 'modules', 'devise', 'domaine_cfp','collaboration','type_abonnement'));
    }

    public function affichageParFormationParcfp($id_formation)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        $module_cfp_id = module::where('formation_id', $id_formation)->value('cfp_id');
        $infos = DB::select('select *,vm.nombre as total_avis from v_nombre_avis_par_module as vm RIGHT join moduleformation as md on md.module_id = vm.module_id where md.status = 2 and md.etat_id = 1 and md.formation_id = ? and md.cfp_id = ? order by md.nom_formation asc', [$id_formation, $module_cfp_id]);
        // dd($infos);
        $datas = DB::select('select module_id,formation_id,date_debut,date_fin,groupe_id,type_formation_id from v_session_projet where formation_id = ? and type_formation_id = 2 group by module_id', [$id_formation]);
        $test = 4;
        $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
        $offset = round($domaines_count[0]->nb_domaines / $test);
        $domaine_col1 = DB::select('select * from domaines limit ' . $offset . '');
        $domaine_col2 = DB::select('select * from domaines limit ' . $offset . ' offset ' . $offset . '');
        $domaine_col3 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 2) . '');
        $domaine_col4 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 3) . '');
        $categorie = formation::orderBy('nom_formation')->get();
        $nom_formation = formation::where('id', $id_formation)->value('nom_formation');

        return view('referent.catalogue.liste_formation', compact('infos', 'datas', 'devise', 'nom_formation', 'categorie', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
    }

    public function domaine_vers_formation(Request $request)
    {
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        $domaine_id = $request->id;
        // $modules = DB::select('select md.id, md.nom_module, md.formation_id,md.cfp_id, md.duree, md.duree_jour, md.prix, md.prix_groupe, md.modalite_formation, cfp.nom from modules as md join formations as frmt on md.formation_id = frmt.id join domaines as dm on frmt.domaine_id = dm.id join cfps as cfp on md.cfp_id = cfp.id where md.status = 2 and md.etat_id = 1');
        // $formations = DB::select('select * from formations where domaine_id = ?', [$domaine_id]);
        $formations = DB::select('select frmt.nom_formation,frmt.id from formations as frmt join modules as md on frmt.id = md.formation_id join domaines as dm on frmt.domaine_id = dm.id where dm.id = ? and md.etat_id = 1 group by frmt.nom_formation,frmt.id',[$domaine_id]);
        $formations_sans_module = DB::select('select frmt.nom_formation,frmt.id from formations as frmt join domaines as dm on frmt.domaine_id = dm.id where dm.id = ? group by frmt.nom_formation,frmt.id',[$domaine_id]);
        // dd($formations_sans_module);
        $test = 4;
        $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
        $offset = round($domaines_count[0]->nb_domaines / $test);
        $domaine_col1 = DB::select('select * from domaines limit ' . $offset . '');
        $domaine_col2 = DB::select('select * from domaines limit ' . $offset . ' offset ' . $offset . '');
        $domaine_col3 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 2) . '');
        $domaine_col4 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 3) . '');
        $categorie = formation::orderBy('nom_formation')->get();
        $nom_domaine = DB::select('select nom_domaine from domaines where id = ?', [$domaine_id]);
        $modules = DB::select('select md.pourcentage,md.module_id, md.nom_module, md.formation_id,md.cfp_id, md.duree, md.duree_jour, md.prix, md.prix_groupe, md.modalite_formation, cfp.nom, vm.nombre as total_avis from v_nombre_avis_par_module as vm RIGHT join moduleformation as md on md.module_id = vm.module_id join formations as frmt on md.formation_id = frmt.id join domaines as dm on frmt.domaine_id = dm.id join cfps as cfp on md.cfp_id = cfp.id where md.status = 2 and md.etat_id = 1 order by md.pourcentage desc');
        // dd($modules);
        // dd($nom_domaine);
        // $formation_id = $formations[0]->id;
        $modules_counts = DB::select('select count(*) as nb_modules, md.formation_id from modules as md join formations as frmt on md.formation_id = frmt.id where md.status = 2 and md.etat_id = 1 group by md.formation_id');
        // dd($modules_counts);
        return view('referent.catalogue.domaine', compact('formations', 'modules', 'modules_counts', 'categorie', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4','nom_domaine','devise','formations_sans_module'));
    }

    public function demande_devis_client(Request $request){
        $user_id = Auth::user()->id;
        $fonct = new FonctionGenerique();
        $resp_etp = $fonct->findWhereMulitOne("responsables",["user_id"],[Auth::user()->id]);

    //  dd($resp_etp);
        $id_module = $request->id;
        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $test = 4;
        $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');

        $offset = round($domaines_count[0]->nb_domaines / $test);
        $domaine_col1 = DB::select('select * from domaines limit ' . $offset . '');
        $domaine_col2 = DB::select('select * from domaines limit ' . $offset . ' offset ' . $offset . '');
        $domaine_col3 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 2) . '');
        $domaine_col4 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 3) . '');
        $categorie = formation::orderBy('nom_formation')->get();

        $domaine_id = $request->id;
        $formations = DB::select('select * from formations where domaine_id = ?', [$domaine_id]);
        $modules = DB::select('select md.pourcentage,md.module_id, md.nom_module, md.formation_id,md.cfp_id, md.duree, md.duree_jour, md.prix, md.prix_groupe, md.modalite_formation, cfp.nom, vm.nombre as total_avis from v_nombre_avis_par_module as vm RIGHT join moduleformation as md on md.module_id = vm.module_id join formations as frmt on md.formation_id = frmt.id join domaines as dm on frmt.domaine_id = dm.id join cfps as cfp on md.cfp_id = cfp.id where md.status = 2 and md.etat_id = 1 and md.module_id = ?', [$id_module]);
        $modules_counts = DB::select('select count(*) as nb_modules, md.formation_id from modules as md join formations as frmt on md.formation_id = frmt.id where md.status = 2 and md.etat_id = 1 group by md.formation_id');
        return view('referent.catalogue.demande_devis', compact('resp_etp','formations', 'modules', 'modules_counts', 'devise', 'categorie', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
    }


    //========================  Filtre ========================================

    /*
    public function filtre_par_entiter(Request $request, $nbPagination_pag = null, $nom_entiter_pag = null)
    {

        $nbPagination = null;
        $nom_entiter = null;
        $nb_limit = 5;

        if (isset($nom_entiter_pag)) {
            $nom_entiter = $nom_entiter_pag;
        } else {
            $nom_entiter = $request->nom_entiter;
        }
        if (isset($nbPagination_pag)) {
            $nbPagination = $nbPagination_pag;
        }
        if ($nbPagination < 0  || $nbPagination == null) {
            $nbPagination = 2;
        }

        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 2)[0];

        $categorie = DB::select('select * from formations where status = 2');
        $domaines = Domaine::all();
        $test = 4;
        $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
        $offset = round($domaines_count[0]->nb_domaines / $test);
        $domaine_col1 = DB::select('select * from domaines limit ' . $offset . '');
        $domaine_col2 = DB::select('select * from domaines limit ' . $offset . ' offset ' . $offset . '');
        $domaine_col3 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 2) . '');
        $domaine_col4 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 3) . '');


        $query2 = '(SELECT md.*,vm.nombre as total_avis FROM v_nombre_avis_par_module as vm RIGHT JOIN moduleformation as md on md.module_id = vm.module_id WHERE md.nom like (?) and md.status = 2 and md.etat_id = 2 LIMIT ' . $nb_limit . ' OFFSET ' . ($nbPagination - 2) . ') AS t1';
        $query1 = 'SELECT * FROM ';
        $query = $query1 . " " . $query2;
        $query .= "  ORDER BY pourcentage DESC";

        $totale_module = $this->fonct->getNbrePagination("moduleformation", "module_id", ["nom", "status", "etat_id"], ["LIKE", "=", "="], ["%" . $nom_entiter . "%", 2, 2], "AND");
        $pagination = $this->fonct->nb_liste_pagination($totale_module, $nbPagination, $nb_limit);

        $infos = DB::select($query, ["%" . $nom_entiter . "%"]);

        $organismes = DB::select('select * from cfps');
        $competences = DB::select('select * from competence_a_evaluers');
        $formations = DB::select('select * from formations');

        $datas = DB::select('select module_id,formation_id,date_debut,date_fin,groupe_id,type_formation_id from v_groupe_projet_module where type_formation_id = 2 group by module_id');
        return view('referent.catalogue.liste_formation', compact('formations', 'competences', 'organismes', 'nom_entiter', 'pagination', 'infos', 'datas', 'categorie', 'devise', 'domaines', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
    }
*/

    public function filtre_par_modaliter(Request $request, $nbPagination_pag = null, $nom_entiter_pag = null)
    {
        $nom_modalite = null;

        $nom_param = "";

        $nbPagination = null;
        $nb_limit = 5;


        if (isset($nbPagination_pag)) {
            $nbPagination = $nbPagination_pag;
        }
        if ($nbPagination < 0  || $nbPagination == null) {
            $nbPagination = 1;
        }

        if (isset($nom_entiter_pag)) {
            $nom_modalite = $nom_entiter_pag;
        } else {
            $nom_modalite = $request->nom_modalite;
        }

        $nom_param = "modalite_formation";

        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $categorie = DB::select('select * from formations where status = 1');
        $domaines = Domaine::all();
        $test = 4;
        $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
        $offset = round($domaines_count[0]->nb_domaines / $test);
        $domaine_col1 = DB::select('select * from domaines limit ' . $offset . '');
        $domaine_col2 = DB::select('select * from domaines limit ' . $offset . ' offset ' . $offset . '');
        $domaine_col3 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 2) . '');
        $domaine_col4 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 3) . '');

        $query2 = '(SELECT md.*,vm.nombre as total_avis FROM v_nombre_avis_par_module as vm RIGHT JOIN moduleformation as md on md.module_id = vm.module_id WHERE md.' . $nom_param . ' =? and md.status = 2 and md.etat_id = 1 LIMIT ' . $nb_limit . ' OFFSET ' . ($nbPagination - 1) . ') AS t1';
        $query1 = 'SELECT * FROM ';
        $query = $query1 . " " . $query2;
        $query .= "  ORDER BY pourcentage DESC";

        $totale_module = $this->fonct->getNbrePagination("moduleformation", "module_id", [$nom_param, "status", "etat_id"], ["=", "=", "="], [$nom_modalite, 2, 1], "AND");
        $pagination = $this->fonct->nb_liste_pagination($totale_module, $nbPagination, $nb_limit);

        $infos = DB::select($query, [$nom_modalite]);

        $organismes = DB::select('select * from cfps');
        $competences = DB::select('select * from competence_a_evaluers');
        $formations = DB::select('select * from formations');

        $datas = DB::select('select module_id,formation_id,date_debut,date_fin,groupe_id,type_formation_id from v_groupe_projet_module where type_formation_id = 2 group by module_id');
        return view('referent.catalogue.liste_formation', compact('formations', 'competences', 'organismes', 'nom_modalite', 'pagination', 'infos', 'datas', 'categorie', 'devise', 'domaines', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
    }



    public function filtre_par_nom(Request $request, $type_filtre = null, $nbPagination_pag = null, $nom_entiter_pag = null)
    {
        $nom_entiter = null;

        $nom_param = "";

        $nbPagination = null;
        $nb_limit = 5;
        $para = [];
        $opt = [];
        $val = [];

        $query2 = "";
        $totale_module = 0;
        if (isset($nbPagination_pag)) {
            $nbPagination = $nbPagination_pag;
        }
        if ($nbPagination < 0  || $nbPagination == null) {
            $nbPagination = 1;
        }

        if (isset($nom_entiter_pag)) {
            $nom_entiter = $nom_entiter_pag;
        } else {
            $nom_entiter = $request->nom_entiter;
        }

        if ($type_filtre == "OF") {
            $nom_param = "nom";
            $query2 = '(SELECT md.*,vm.nombre as total_avis FROM v_nombre_avis_par_module as vm RIGHT JOIN moduleformation as md on md.module_id = vm.module_id WHERE md.' . $nom_param . ' like (?) and md.status = 2 and md.etat_id = 1 LIMIT ' . $nb_limit . ' OFFSET ' . ($nbPagination - 1) . ') AS t1';
            $totale_module = $this->fonct->getNbrePagination("moduleformation", "module_id", [$nom_param, "status", "etat_id"], ["LIKE", "=", "="], ["%" . $nom_entiter . "%", 2, 1], "AND");
        }
        if ($type_filtre == "FORMATION") {
            $nom_param = "nom_formation";
            $query2 = '(SELECT md.*,vm.nombre as total_avis FROM v_nombre_avis_par_module as vm RIGHT JOIN moduleformation as md on md.module_id = vm.module_id WHERE md.' . $nom_param . ' like (?) and md.status = 2 and md.etat_id = 1 LIMIT ' . $nb_limit . ' OFFSET ' . ($nbPagination - 1) . ') AS t1';
            $totale_module = $this->fonct->getNbrePagination("moduleformation", "module_id", [$nom_param, "status", "etat_id"], ["LIKE", "=", "="], ["%" . $nom_entiter . "%", 2, 1], "AND");
        }


        /*-------------------------------------------------------------------*/
        if ($type_filtre == "COMPETENCE") {
            $nom_param = "titre_competence";
            $totale_module = $this->fonct->getNbrePagination("competence_a_evaluers", "module_id", [$nom_param], ["LIKE"], ["%" . $nom_entiter . "%"], "AND");
            $module_id = DB::select("SELECT module_id FROM competence_a_evaluers WHERE titre_competence LIKE ('%" . $nom_entiter . "%') GROUP BY module_id");
            if (count($module_id) > 0) {
                $query2 = '(SELECT md.*,vm.nombre as total_avis FROM v_nombre_avis_par_module as vm RIGHT JOIN moduleformation as md on md.module_id = vm.module_id WHERE  ';
                for ($i = 0; $i < count($module_id); $i += 1) {
                    $query2 .= " md.module_id = " . $module_id[$i]->module_id;
                    if ($i + 1 < count($module_id)) {
                        $query2 .= " OR ";
                    }
                }
                $query2 .= ' and md.status = 2 and md.etat_id = 1 LIMIT ' . $nb_limit . ' OFFSET ' . ($nbPagination - 1) . ') AS t1';
            } else{
                $query2 = '(SELECT md.*,vm.nombre as total_avis FROM v_nombre_avis_par_module as vm RIGHT JOIN moduleformation as md on md.module_id = vm.module_id WHERE  md.nom like (?) and md.status = 100 and md.etat_id = 1 LIMIT ' . $nb_limit . ' OFFSET ' . ($nbPagination - 1) . ') AS t1';

            }
        }
        /*-------------------------------------------------------------------*/

        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $categorie = DB::select('select * from formations where status = 1');
        $domaines = Domaine::all();
        $test = 4;
        $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
        $offset = round($domaines_count[0]->nb_domaines / $test);
        $domaine_col1 = DB::select('select * from domaines limit ' . $offset . '');
        $domaine_col2 = DB::select('select * from domaines limit ' . $offset . ' offset ' . $offset . '');
        $domaine_col3 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 2) . '');
        $domaine_col4 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 3) . '');

        $query1 = 'SELECT * FROM ';
        $query = $query1 . " " . $query2;
        $query .= "  ORDER BY pourcentage DESC";

        $pagination = $this->fonct->nb_liste_pagination($totale_module, $nbPagination, $nb_limit);

        $infos = DB::select($query, ["%" . $nom_entiter . "%"]);

        $organismes = DB::select('select * from cfps');
        $competences = DB::select('select * from competence_a_evaluers');
        $formations = DB::select('select * from formations');

        $datas = DB::select('select module_id,formation_id,date_debut,date_fin,groupe_id,type_formation_id from v_groupe_projet_module where type_formation_id = 2 group by module_id');
        return view('referent.catalogue.liste_formation', compact('formations', 'competences', 'organismes', 'nom_entiter', 'type_filtre', 'pagination', 'infos', 'datas', 'categorie', 'devise', 'domaines', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
    }


    public function filtre_par(Request $request, $type_filtre = null, $nbPagination_pag = null, $data_min_pag = null, $data_max_pag = null)
    {
        $data_debut_filtre = 0;
        $data_fin_filtre = 1;

        $nom_par_debut = "";
        $nom_par_fin = "";

        $nbPagination = null;
        $nb_limit = 5;


        if (isset($nbPagination_pag)) {
            $nbPagination = $nbPagination_pag;
        }
        if ($nbPagination < 0  || $nbPagination == null) {
            $nbPagination = 1;
        }


        if (isset($data_min_pag) && isset($data_max_pag)) {
            $data_debut_filtre = $data_min_pag;
            $data_fin_filtre = $data_max_pag;
        } else {
            $data_debut_filtre = $request->data_debut_filtre;
            $data_fin_filtre = $request->data_fin_filtre;
        }

        if ($type_filtre == "SINGLE_PRIX") {
            // dd("SINGLE_PRIX");
            $nom_par_debut = "prix";
            $nom_par_fin = "prix";
        }
        if ($type_filtre == "GROUPE_PRIX") {
            $nom_par_debut = "prix_groupe";
            $nom_par_fin = "prix_groupe";
        }
        if ($type_filtre == "HR") {
            $nom_par_debut = "duree";
            $nom_par_fin = "duree";
        }
        if ($type_filtre == "DAY") {
            $nom_par_debut = "duree_jour";
            $nom_par_fin = "duree_jour";
        }
        // ========= revoie les données

        $devise = $this->fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $categorie = DB::select('select * from formations where status = 1');
        $domaines = Domaine::all();
        $test = 4;
        $domaines_count = DB::select('select count(*)  as nb_domaines from domaines');
        $offset = round($domaines_count[0]->nb_domaines / $test);
        $domaine_col1 = DB::select('select * from domaines limit ' . $offset . '');
        $domaine_col2 = DB::select('select * from domaines limit ' . $offset . ' offset ' . $offset . '');
        $domaine_col3 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 2) . '');
        $domaine_col4 = DB::select('select * from domaines limit ' . $offset . ' offset ' . ($offset * 3) . '');

        $query2 = '(SELECT md.*,vm.nombre as total_avis FROM v_nombre_avis_par_module as vm RIGHT JOIN moduleformation as md on md.module_id = vm.module_id WHERE md.' . $nom_par_debut . '>=? AND md.' . $nom_par_fin . '<=?  and md.status = 2 and md.etat_id = 1 LIMIT ' . $nb_limit . ' OFFSET ' . ($nbPagination - 1) . ') AS t1';
        $query1 = 'SELECT * FROM ';
        $query = $query1 . " " . $query2;
        $query .= "  ORDER BY pourcentage DESC";

        $totale_module = $this->fonct->getNbrePagination("moduleformation", "module_id", [$nom_par_debut, $nom_par_fin, "status", "etat_id"], [">=", "<=", "=", "="], [$data_debut_filtre, $data_fin_filtre, 2, 1], "AND");
        $pagination = $this->fonct->nb_liste_pagination($totale_module, $nbPagination, $nb_limit);

        $infos = DB::select($query, [$data_debut_filtre, $data_fin_filtre]);

        $organismes = DB::select('select * from cfps');
        $competences = DB::select('select * from competence_a_evaluers');
        $formations = DB::select('select * from formations');
        $datas = DB::select('select module_id,formation_id,date_debut,date_fin,groupe_id,type_formation_id from v_groupe_projet_module where type_formation_id = 2 group by module_id');

        return view('referent.catalogue.liste_formation', compact('formations', 'competences', 'organismes', 'data_debut_filtre', 'data_fin_filtre', 'type_filtre', 'pagination', 'infos', 'datas', 'categorie', 'devise', 'domaines', 'domaine_col1', 'domaine_col2', 'domaine_col3', 'domaine_col4'));
    }

    //========================= FIN Filtre ==================================




// }
    public function liste_demande_devis(){
        $id_user = Auth::user()->id;
        $id_cfp = responsable_cfp::where('user_id', $id_user)->value('cfp_id');
        $liste=DB::select('select *  from v_liste_demande_devis where cfp_id=?',[$id_cfp]);

        return view('referent.catalogue.liste_demande_devis',compact('liste'));

    }
    public function detail_demande_devis($id){
        $detail=demande_devis::findOrfail($id);
        // $liste=DB::select('select *  from v_liste_demande_devis where cfp_id=?',[$id_cfp]);
        return view('referent.catalogue.detail_demande_devis',compact('detail'));
    }
    public function delete_demande_devis($id)
    {
        // DB::delete('delete devise from devise where id=?',[$id]);
        DB::table('demande_devis')->delete($id);
        return back();
    }

    public function plus_avis(Request $request){
        $id = $request->Id;
        $liste_avis_tous = DB::select('select SUBSTRING(lsta.nom_stagiaire, 1, 1) as nom_stagiaire, lsta.prenom_stagiaire, lsta.date_avis, lsta.note, lsta.commentaire from v_liste_avis as lsta join modules as md on lsta.module_id = md.id join cfps as cfp on md.cfp_id = cfp.id where md.cfp_id = ? order by lsta.date_avis desc limit 30 offset 10', [$id]);

        return response()->json(['liste_avis'=>$liste_avis_tous]);
    }

    public function plus_avis_module(Request $request){
        $id = $request->Id;
        $liste_avis_tous = DB::select('select *, SUBSTRING(nom_stagiaire, 1, 1) as nom_stagiaire from v_liste_avis as lsta where module_id = ? order by lsta.date_avis desc limit 30 offset 10', [$id]);

        return response()->json(['liste_avis'=>$liste_avis_tous]);
    }

    public function plus_avis_mod_cfp(Request $request){
        $id = $request->Id;
        $liste_avis_tous = DB::select('select *, SUBSTRING(nom_stagiaire, 1, 1) as nom_stagiaire from v_liste_avis as lsta where module_id = ? order by lsta.date_avis desc limit 30 offset 10', [$id]);

        return response()->json(['liste_avis'=>$liste_avis_tous]);
    }

}
