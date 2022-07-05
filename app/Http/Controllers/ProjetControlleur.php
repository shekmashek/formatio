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
    }

    public function destroy(Request $request)
    {
        $id = $request->id_get;
        $del = DB::delete('delete from projets where id = ?', [$id]);
        return back();
    }

    public function accueilProjet(){
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
        $fonct = new FonctionGenerique();
        $devise = $fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        $id_user = Auth::user()->id;
        $etp_id  = $fonct->findWhereMulitOne("responsables",["user_id"],[$id_user])->entreprise_id;
        $etp = $fonct->findWhereMulitOne("entreprises", ["id"], [$etp_id]);
        $domaines = DB::select('select * from domaines');
        // $infos = DB::select('select * from v_moduleformation_interne where etp_id = ?', [$etp_id]);
        $infos = DB::select('select md.*,vm.nombre as total_avis FROM v_nombre_avis_par_module_interne as vm RIGHT JOIN v_moduleformation_interne as md on md.module_id = vm.module_id where md.status = 2 and md.etat_id = 1 and md.etp_id = ? order by md.nom_formation asc',[$etp_id]);
        // dd($infos);
        return view('referent.projet_Interne.formations.formation', compact('domaines','infos','devise'));
    }

    public function module_interne(Request $request){
        $fonct = new FonctionGenerique();
        $etp_id = $fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id])->entreprise_id;

        $formation = $request->categorie;
        $nom_module = 'Excel - Avancé(Titre module)';
        $description = 'Optimiser et automatiser vos tableaux sans programmer(Description courte du module)';
        $heure = 12;
        $jour = 2;
        $modalite = 'Presentiel';
        $prerequis = 'Avoir suivi la formation "Excel - Intermédiaire" ou avoir un niveau de connaissances équivalent.';
        $reference = 'Ref';
        $objectif = 'Organiser vos données pour faciliter l\'analyse et fiabiliser les résultats. Exploiter le potentiel de calcul d\'Excel, automatiser les traitements et la mise en forme sans programmer : formules complexes, imbriquées, matricielles.';
        $materiel = 'Les matériels necessaires pour suivre la formation (ordinateur, etc... )';
        $bon_a_savoir = 'Bon à savoir pour pouvoir suivre la formation';
        $cible = 'Contrôleur de gestion, financier, RH, toute personne ayant à exploiter des résultats chiffrés dans Excel (version 2013 et suivantes).';
        $prestation = 'Package pedagogique special 40 ans, repas du midi et pauses-cafe offerts les jours de formation';
        $min_pers = 5;
        $max_pers = 10;
        $level = 1;
        DB::insert('insert into modules_interne(reference,nom_module,formation_id,duree,duree_jour,prerequis,objectif,description,modalite_formation,materiel_necessaire,niveau_id,cible,bon_a_savoir,prestation,min,max,etp_id,created_at)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())', [$reference, $nom_module, $formation, $heure, $jour, $prerequis, $objectif, $description, $modalite, $materiel, $level, $cible, $bon_a_savoir, $prestation, $min_pers, $max_pers, $etp_id]);
        $id = DB::select('select id from modules_interne order by id desc limit 1');
        $np = 3;
        $npc = 4;
        $nc = 6;
        DB::beginTransaction();
        try {
            for($j = 1; $j < $np; $j++){

                DB::insert('insert into programmes_interne(titre,module_id) values(?,?)', ['Programme '.$j, $id[0]->id]);

                $id_prog = DB::select('select id from programmes_interne where module_id = ? order by id desc limit 1',[$id[0]->id]);
                for($k = 1; $k < $npc; $k++){
                    DB::insert('insert into cours_interne(titre_cours,programme_id) values(?,?)',['Cours '.$k, $id_prog[0]->id]);
                }
            }
            for($i = 1; $i < $nc; $i++){
                DB::insert('insert into competence_a_evaluers_interne(titre_competence,objectif,module_id) values(?,?,?)',['Competence '.$i,(4 + $i),$id[0]->id]);
            }
            DB::update('update modules_interne set status = ? where id = ?',[2,$id[0]->id]);
            DB::commit();
            return redirect()->route('module_interne_new');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('formations');
        }
    }

    public function module_interne_new(){
        $fonct = new FonctionGenerique();
        $devise = $fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        $id = DB::select('select id from modules_interne  order by id desc limit 1');
        $test =  DB::select('select exists(select * from v_moduleformation_interne where module_id = ' . $id[0]->id . ') as moduleExiste');
        $domaines = DB::select('select * from domaines');

        //on verifie si moduleformation contient le module_id
        if ($test[0]->moduleExiste == 1) {
            $infos = DB::select('select * from v_moduleformation_interne where module_id = ?', [$id[0]->id]);
            $nb = DB::select('select ifnull(count(a.module_id),0) as nb_avis from v_moduleformation_interne mf left join avis_interne a on mf.module_id = a.module_id where mf.formation_id = ? group by mf.formation_id', [$id[0]->id]);
            if ($nb == null) {
                $nb_avis = 0;
            } else {
                $nb_avis = $nb[0]->nb_avis;
            }

            $cours = DB::select('select * from v_cours_programme_interne where module_id = ?', [$id[0]->id]);
            $programmes = DB::select('select * from programmes_interne where module_id = ?', [$id[0]->id]);
            $competences = DB::select('select * from competence_a_evaluers_interne where module_id = ?', [$id[0]->id]);
            $liste_avis = DB::select('select * from v_liste_avis_interne where module_id = ? limit 5', [$id[0]->id]);
            $niveau = DB::select('select * from niveaux');
            // $statistiques = DB::select('select * from v_statistique_avis where formation_id = ? order by nombre desc',[$id[0]->id]);
            return view('referent.projet_Interne.formations.nouveau_module_interne', compact('devise','infos', 'cours', 'programmes','domaines', 'nb_avis', 'liste_avis', 'id', 'competences','niveau'));
        } else return view('referent.projet_Interne.formations.nouveau_module_interne');
    }

    public function destroy_new(Request $req){
        DB::delete('delete from modules_interne where id = ? ',[$req->id]);
        return redirect()->route('formations');
    }

    public function afficher_radar(Request $request){
        $competences = DB::select('select * from competence_a_evaluers_interne where module_id = ?',[$request->mod_id]);
        return response()->json(['detail'=>$competences]);
    }

    public function edit_name_module(Request $request){
        $id = $request->id;
        $nom = $request->nom_module;
        DB::update('update modules_interne set nom_module = ? where id = ?',[$nom, $id]);
        return back();
    }
    public function edit_description(Request $request){
        $id = $request->id;
        $description = $request->description;
        DB::update('update modules_interne set description = ? where id = ?',[$description, $id]);
        return back();
    }
    public function edit_detail(Request $request){
        $id = $request->id;
        $jour = $request->jour;
        $heure = $request->heure;
        $modalite = $request->modalite;
        $niveau = $request->niveau;
        $reference = $request->reference;
        DB::update('update modules_interne set duree_jour = ?, duree = ?, modalite_formation = ?, reference = ?, niveau_id = ?  where id = ?',[$jour,$heure,$modalite,$reference,$niveau, $id]);
        // dd($query);
        return back();
    }
    public function edit_objectif(Request $request){
        $id = $request->id;
        $objectif = $request->objectif;
        DB::update('update modules_interne set objectif = ? where id = ?',[$objectif, $id]);
        return back();
    }
    public function edit_public_cible(Request $request){
        $id = $request->id;
        $cible = $request->public_cible;
        DB::update('update modules_interne set cible = ? where id = ?',[$cible, $id]);
        return back();
    }
    public function edit_prerequis(Request $request){
        $id = $request->id;
        $prerequis = $request->prerequis;
        DB::update('update modules_interne set prerequis = ? where id = ?',[$prerequis, $id]);
        return back();
    }
    public function edit_equipement(Request $request){
        $id = $request->id;
        $equipement = $request->equipement;
        // dd($equipement);
        DB::update('update modules_interne set materiel_necessaire = ? where id = ?',[$equipement, $id]);
        return back();
    }
    public function edit_bon_a_savoir(Request $request){
        $id = $request->id;
        $bon_a_savoir = $request->bon_a_savoir;
        DB::update('update modules_interne set bon_a_savoir = ? where id = ?',[$bon_a_savoir, $id]);
        return back();
    }
    public function edit_prestation(Request $request){
        $id = $request->id;
        $prestation = $request->prestation;
        DB::update('update modules_interne set prestation = ? where id = ?',[$prestation, $id]);
        return back();
    }

    public function insert_prog_cours_etp(Request $request)
    {
        $id = $request->id_module;
        $donnees = $request->all();

        for ($i = 0; $i < count($donnees['titre_prog']); $i++) {
            if ($donnees['titre_prog'][$i] != null) {
                $prog = DB::insert('insert into programmes_interne(titre,module_id) values(?,?)', [$donnees['titre_prog'][$i], $id]);
                $id_prog = DB::select('select id from programmes_interne order by id desc limit 1')[0]->id;
                for ($j = 0; $j < count($donnees['cours_' . $i]); $j++) {

                    if ($donnees['cours_' . $i][$j] != null) {
                        $cours = DB::insert('insert into cours_interne(titre_cours,programme_id) values(?,?)', [$donnees['cours_' . $i][$j], $id_prog]);
                    }
                }
            }
        }
        return back();
        // return redirect()->route('liste_module');
    }

    public function update_prog_cours_etp(Request $request)
    {
        $id = $request->id_prog;
        $donnees = $request->all();
        $fonct = new FonctionGenerique();

        if ($request->titre_prog != null) {
            $prog = DB::update('update programmes_interne set titre=? where id = ?', [$request->titre_prog, $id]);
            $cours = $fonct->findWhere('cours_interne', ['programme_id'], [$id]);

            for ($i = 0; $i < count($cours); $i++) {
                $id_cour = $donnees['id_cours_' . $id . '_' . $cours[$i]->id];
                $val_cour = $donnees['cours_' . $id . '_' . $cours[$i]->id];

                if ($donnees['cours_' . $id . '_' . $cours[$i]->id] != null) {
                    $cour = DB::update('update cours_interne set titre_cours=? where programme_id = ? and id = ?', [$val_cour, $id, $id_cour]);
                } else {
                    return back()->with('error', "l'une de ses informations est invalid");
                }
            }
            return back();
        }
    }

    public function insertion_cours_etp(Request $request)
    {
        $request->validate(
            [
                'cours' => ["required"]
            ],
            [
                'cours.required' => 'Veuillez remplir le champ'
            ]
        );

        $id = $request->id_prog;
        $donnees = $request->all();

        for($i = 0; $i < count($donnees['cours']); $i++){
            if ($donnees['cours'][$i] != null) {
                $cours = DB::insert('insert into cours_interne(titre_cours,programme_id) values(?,?)',[$donnees['cours'][$i],$id]);
            }
        }

        return back();
    }

    public function load_cours_programme_etp(Request $request)
    {
        $id = $request->Id;
        $cours_prog = DB::select('select cours_id,programme_id,titre,titre_cours from v_cours_programme_interne where programme_id = ?', [$id]);
        return response()->json(['cours'=>$cours_prog]);
    }

    public function ajout_new_competence(Request $request)
    {
        $id = $request->id;
        $competence = $request->all();
        for($i = 0; $i < count($competence['titre_competence']); $i++){
            $comp = DB::insert('insert into competence_a_evaluers_interne(titre_competence,objectif,module_id) values(?,?,?)',[$competence['titre_competence'][$i],$competence['notes'][$i],$id]);
        }
        return back();
    }

    public function modif_competence(Request $request)
    {
        $id = $request->id;
        $donnees = $request->all();
        $fonct = new FonctionGenerique();

        $competence = $fonct->findWhere('competence_a_evaluers_interne', ['module_id'], [$id]);
        for ($i = 0; $i < count($competence); $i++) {
            $id_comp = $donnees['id_notes_' . $id . '_' . $competence[$i]->id];
            $val_comp = $donnees['titre_competence_' . $id . '_' . $competence[$i]->id];
            $val_note = $donnees['notes_' . $id . '_' . $competence[$i]->id];
            if ($donnees['titre_competence_' . $id . '_' . $competence[$i]->id] != null) {
                $cour = DB::update('update competence_a_evaluers_interne set titre_competence=?, objectif=?  where module_id = ? and id = ?', [$val_comp, $val_note, $id_comp, $competence[$i]->id]);
            } else {
                return back()->with('error', "l'une de ces informations est invalide");
            }
        }
        return back();
    }
    public function destroy_competence(Request $request)
    {
        $id = $request->Id;
        DB::delete('delete from competence_a_evaluers_interne where id = ?', [$id]);
        // $test = DB::select('select * from competence_a_evaluers')
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully',
            ]
        );
    }

    public function suppre_programme(Request $request)
    {
        $id = $request->Id;
        DB::delete('delete from cours_interne where programme_id = ?', [$id]);
        DB::delete('delete from programmes_interne where id = ?', [$id]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully',
            ]
        );
    }

    public function suppre_cours(Request $request)
    {
        $id = $request->Id;
        DB::delete('delete from cours_interne where id = ?', [$id]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully',
            ]
        );
    }

    public function ajout_programme($id)
    {
        $fonct = new FonctionGenerique();

        $id = request('id');
        $devise = $fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $categorie = DB::select('select * from formations');
        $test =  DB::select('select exists(select * from v_moduleformation_interne where module_id = ' . $id . ') as moduleExiste');
        if ($test[0]->moduleExiste == 1) {

            $infos = DB::select('select * from v_moduleformation_interne where module_id = ?', [$id]);
            // dd($infos);
            $nb = DB::select('select ifnull(count(a.module_id),0) as nb_avis from v_moduleformation_interne mf left join avis_interne a on mf.module_id = a.module_id where mf.module_id = ? group by mf.module_id', [$id]);
            if ($nb == null) {
                $nb_avis = 0;
            } else {
                $nb_avis = $nb[0]->nb_avis;
            }

            $cours = DB::select('select * from v_cours_programme_interne where module_id = ?', [$id]);
            $liste_avis = DB::select('select *, SUBSTRING(nom_stagiaire, 1, 1) as nom_stagiaire from v_liste_avis_interne where module_id = ? limit 10', [$id]);
            $liste_avis_count = DB::select('select *, SUBSTRING(nom_stagiaire, 1, 1) as nom_stagiaire from v_liste_avis_interne where module_id = ?', [$id]);
            $statistiques = DB::select('select * from v_statistique_avis_interne where module_id = ?',[$id]);
            $avis_etoile = DB::select('select round(SUM(vn.note) / SUM(vn.nombre_note), 2) as pourcentage, SUM(vn.nombre_note) as nb_avis from v_nombre_note_interne as vn join v_moduleformation_interne as md on vn.module_id = md.module_id where md.etp_id = ?',[$infos[0]->etp_id]);
            $programmes = DB::select('select * from programmes_interne where module_id = ?', [$id]);
            $competences = DB::select('select * from competence_a_evaluers_interne where module_id = ?', [$id]);
            $niveau = DB::select('select * from niveaux');
            return view('referent.projet_Interne.formations.modif_module_interne', compact('devise','infos','liste_avis','liste_avis_count','statistiques','avis_etoile', 'cours', 'programmes', 'nb', 'liste_avis', 'categorie', 'id', 'competences','niveau'));
        } else return redirect()->route('formations');
    }

    public function plus_avis_mod_etp(Request $request){
        $id = $request->Id;
        $liste_avis_tous = DB::select('select *, SUBSTRING(nom_stagiaire, 1, 1) as nom_stagiaire from v_liste_avis_interne as lsta where module_id = ? order by lsta.date_avis desc limit 30 offset 10', [$id]);
        return response()->json(['liste_avis'=>$liste_avis_tous]);
    }

    public function affichageParModule($id)
    {
        $fonct = new FonctionGenerique();
        $devise = $fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];

        $id = request('id');
        $niveau = DB::select('select * from niveaux');
        $categorie = DB::select('select * from formations');
        $test =  DB::select('select exists(select * from v_moduleformation_interne where module_id = ' . $id . ' and status = 2 and etat_id = 1) as moduleExiste');

        if ($test[0]->moduleExiste == 1) {
            $infos = DB::select('select * from v_moduleformation_interne where module_id = ? and status = 2 and etat_id = 1', [$id]);
            // dd($infos);
            $nb = DB::select('select count(*) as nb_avis from v_liste_avis_interne where module_id = ?', [$id]);
            if ($nb == null) {
                $nb_avis = 0;
            } else {
                $nb_avis = $nb[0]->nb_avis;
            }
            $cours = DB::select('select * from v_cours_programme_interne where module_id = ?', [$id]);
            $programmes = DB::select('select * from programmes_interne where module_id = ?', [$id]);
            $liste_avis = DB::select('select *, SUBSTRING(nom_stagiaire, 1, 1) as nom_stagiaire from v_liste_avis_interne where module_id = ? limit 10', [$id]);
            $liste_avis_count = DB::select('select *, SUBSTRING(nom_stagiaire, 1, 1) as nom_stagiaire from v_liste_avis_interne where module_id = ?', [$id]);
            $statistiques = DB::select('select * from v_statistique_avis_interne where module_id = ?',[$id]);
            $avis_etoile = DB::select('select round(SUM(vn.note) / SUM(vn.nombre_note), 2) as pourcentage, SUM(vn.nombre_note) as nb_avis, md.etp_id from v_nombre_note_interne as vn join v_moduleformation_interne as md on vn.module_id = md.module_id join entreprises as etp on md.etp_id = etp.id where md.etp_id = etp.id group by md.etp_id');
            // dd($avis_etoile);
            $competences = DB::select('select titre_competence from competence_a_evaluers_interne where module_id = ?',[$id]);
            return view('referent.projet_Interne.formations.detail_formation_interne', compact('devise','infos','niveau','statistiques','avis_etoile', 'cours', 'programmes', 'nb_avis', 'liste_avis','liste_avis_count', 'categorie', 'id','competences'));
        } else
            return redirect()->route('formations');
    }

    public function affichage_formation_etp(Request $request)
    {
        $fonct = new FonctionGenerique();

        $id_formation = $request->id;
        $devise = $fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        $domaines = DB::select('select * from domaines');
        $categorie = DB::select('select * from formations where status = 1');
        $nom_formation = DB::select('select nom_formation from formations where id = ?',[$id_formation]);
        $infos = DB::select('select *,vm.nombre as total_avis from v_nombre_avis_par_module_interne as vm RIGHT join v_moduleformation_interne as md on md.module_id = vm.module_id where md.status = 2 and md.etat_id = 1 and md.formation_id = ? order by md.nom_formation asc', [$id_formation]);
        return view('referent.projet_Interne.formations.formation', compact('infos','domaines', 'categorie', 'devise', 'nom_formation'));
    }

    public function destroy_module_etp(Request $req){
        DB::delete('delete from modules_interne where id = ? ',[$req->Id]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully',
            ]);
    }

    public function formateurs(){
        return view('referent.projet_Interne.formateurs.formateur');
    }

    public function projets(){
        return view('referent.projet_Interne.projets.projet');
    }

    // public function load_formations(Request $request)
    // {
    //     $id = $request->Id;
    //     $formations = DB::select('select fm.nom_formation,fm.id,fm.domaine_id,dm.nom_domaine from domaines as dm join formations as fm on dm.id = fm.domaine_id where dm.id = ?', [$id]);
    //     if ($formations == null) {
    //         $domaines = DB::select('select * from domaines_interne where id = ?',[$id]);
    //         return response()->json(['domaines'=>$domaines]);
    //     }else{
    //         return response()->json(['formations'=>$formations]);
    //     }
    // }

    // public function load_formations_suppre(Request $request)
    // {
    //     $id = $request->Id;
    //     $formations = DB::select('select fm.nom_formation,fm.id,fm.domaine_id,dm.nom_domaine from domaines_interne as dm join formations_interne as fm on dm.id = fm.domaine_id where dm.id = ?', [$id]);
    //     // $domaines = DB::select('select md.id,nom_domaine from domaines_interne as dm join formations_interne as fm on dm.id = fm.domaine_id where dm.id = ?', [$id]);
    //     return response()->json(['formations'=>$formations]);
    // }

    // public function new_domaine(Request $request){
    //     $fonct = new FonctionGenerique();

    //     $request->validate(
    //         [
    //             'domaine' => ["required"],
    //             'formation' => ["required"]
    //         ],
    //         [
    //             'domaine.required' => 'Veuillez remplir le champ',
    //             'formation.required' => 'Veuillez remplir le champ'
    //         ]
    //     );
    //     $id_user = Auth::user()->id;
    //     $etp_id = $fonct->findWhereMulitOne("responsables",["user_id"],[$id_user]);
    //     DB::beginTransaction();
    //     try {
    //         DB::insert('insert into domaines_interne(nom_domaine,etp_id) values(?,?)',[$request->domaine,$etp_id->entreprise_id]);
    //         $id_domaine = DB::select('select id from domaines_interne where etp_id = ? order by id desc limit 1',[$etp_id->entreprise_id]);
    //         for($k = 0; $k < count($request['formation']); $k++){
    //             DB::insert('insert into formations_interne(nom_formation,domaine_id) values(?,?)',[$request['formation'][$k], $id_domaine[0]->id]);
    //         }

    //         DB::commit();
    //         return back();
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return back()->with('message','Le domaine n\est pas enregistrer, réessayer!');
    //     }
    // }

    // public function new_formation(Request $request){
    //     $fonct = new FonctionGenerique();

    //     $request->validate(
    //         [
    //             'domaine' => ["required"],
    //             'formation' => ["required"]
    //         ],
    //         [
    //             'domaine.required' => 'Veuillez remplir le champ',
    //             'formation.required' => 'Veuillez remplir le champ'
    //         ]
    //     );
    //     DB::beginTransaction();
    //     try {
    //         for($k = 0; $k < count($request['formation']); $k++){
    //             DB::insert('insert into formations_interne(nom_formation,domaine_id) values(?,?)',[$request['formation'][$k], $request['domaine']]);
    //         }

    //         DB::commit();
    //         return back();
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return back()->with('message','Le domaine n\est pas enregistrer, réessayer!');
    //     }
    // }


    // public function update_formation_domaine(Request $request)
    // {
    //     $id = $request->id_domaine;
    //     $donnees = $request->all();
    //     $fonct = new FonctionGenerique();
    //     if ($donnees['domaine'] != null) {
    //         DB::update('update domaines_interne set nom_domaine = ? where id = ?', [$donnees['domaine'], $id]);
    //         $formation = $fonct->findWhere('formations_interne', ['domaine_id'], [$id]);
    //         if ($formation != null) {
    //             for ($i = 0; $i < count($formation); $i++) {
    //                 $id_formation = $donnees['id_formation_' . $id . '_' . $formation[$i]->id];
    //                 $val_formation = $donnees['formation_' . $id . '_' . $formation[$i]->id];

    //                 if ($donnees['formation_' . $id . '_' . $formation[$i]->id] != null) {
    //                     DB::update('update formations_interne set nom_formation = ? where domaine_id = ? and id = ?', [$val_formation, $id, $id_formation]);
    //                 } else {
    //                     return back()->with('error', "l'une de ses informations est invalid");
    //                 }
    //             }
    //         }
    //         return back();
    //     }
    // }


    // public function supprimer_thematique(Request $request)
    // {
    //     $id = $request->id_domaine;
    //     DB::delete('delete from domaines_interne where id = ?', [$id]);
    //     // $test = DB::select('select * from competence_a_evaluers')
    //     return back();
    // }

    // public function supprimer_domaine(Request $request)
    // {
    //     $id = $request->Id;
    //     DB::delete('delete from domaines_interne where id = ?', [$id]);
    //     // $test = DB::select('select * from competence_a_evaluers')
    //     return response()->json(
    //         [
    //             'success' => true,
    //             'message' => 'Data deleted successfully',
    //         ]
    //     );
    // }

    // public function suppression_formation(Request $request)
    // {
    //     $id = $request->Id;
    //     DB::delete('delete from formations_interne where id = ?', [$id]);
    //     // $test = DB::select('select * from competence_a_evaluers')
    //     return response()->json(
    //         [
    //             'success' => true,
    //             'message' => 'Data deleted successfully',
    //         ]
    //     );
    // }
}
