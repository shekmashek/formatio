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
        $fonct = new FonctionGenerique();
        $etp_id = $fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id])->entreprise_id;
        $domaines = DB::select('select * from domaines_interne where etp_id = ?',[$etp_id]);
        $formations = DB::select('select fm.nom_formation,fm.id,fm.domaine_id from domaines_interne as dm  join formations_interne as fm on dm.id = fm.domaine_id where dm.etp_id = ?',[$etp_id]);

        return view('referent.projet_Interne.formations.formation', compact('domaines','formations'));
    }

    public function module_interne(){
        $fonct = new FonctionGenerique();
        $etp_id = $fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id])->entreprise_id;
        // dd($etp_id);
        // $categorie = $request->categorie;
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
        DB::insert('insert into modules_interne(reference,nom_module,formation_id,duree,duree_jour,prerequis,objectif,description,modalite_formation,materiel_necessaire,niveau_id,cible,bon_a_savoir,prestation,status,min,max,etp_id,created_at)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,1,?,?,?,NOW())', [$reference, $nom_module, 1, $heure, $jour, $prerequis, $objectif, $description, $modalite, $materiel, $level, $cible, $bon_a_savoir, $prestation, $min_pers, $max_pers, $etp_id]);
        $id = DB::select('select id from modules_interne order by id desc limit 1');
        $np = 4;
        $npc = 4;
        $nc = 7;
        DB::beginTransaction();
        try {
            for($j = 1; $j < $np; $j++){

                DB::insert('insert into programmes_interne(titre,module_id) values(?,?)', ['Programme '.$j, $id[0]->id]);
                $id_prog = DB::select('select id from programmes where module_id = ? order by id desc limit 1',[$id[0]->id]);
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
            return redirect()->route('liste_module');
        }
    }

    public function module_interne_new(){
        $fonct = new FonctionGenerique();
        $devise = $fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        $id = DB::select('select id from modules_interne  order by id desc limit 1');
        $test =  DB::select('select exists(select * from v_moduleformation_interne where module_id = ' . $id[0]->id . ') as moduleExiste');
        // dd($id,$test);
        //on verifie si moduleformation contient le module_id
        if ($test[0]->moduleExiste == 1) {
            // $infos = DB::select('select * from moduleformation where formation_id = ?',[$id]);
            $infos = DB::select('select * from v_moduleformation_interne where module_id = ?', [$id[0]->id]);
            // dd($infos);
            $nb = DB::select('select ifnull(count(a.module_id),0) as nb_avis from v_moduleformation_interne mf left join avis_interne a on mf.module_id = a.module_id where mf.formation_id = ? group by mf.formation_id', [$id[0]->id]);
            if ($nb == null) {
                $nb_avis = 0;
            } else {
                $nb_avis = $nb[0]->nb_avis;
            }

            $cours = DB::select('select * from v_cours_programme_interne where module_id = ?', [$id[0]->id]);
            // dd($id[0]->id);
            $programmes = DB::select('select * from programmes_interne where module_id = ?', [$id[0]->id]);
            $competences = DB::select('select * from competence_a_evaluers_interne where module_id = ?', [$id[0]->id]);
            $liste_avis = DB::select('select * from v_liste_avis_interne where module_id = ? limit 5', [$id[0]->id]);
            $niveau = DB::select('select * from niveaux_interne');
            // $statistiques = DB::select('select * from v_statistique_avis where formation_id = ? order by nombre desc',[$id[0]->id]);
            return view('referent.projet_Interne.formations.formation', compact('devise','infos', 'cours', 'programmes', 'nb_avis', 'liste_avis', 'id', 'competences','niveau'));
        } else return view('referent.projet_Interne.formations.formation');
        // return view('referent.projet_Interne.formations.formation');
    }

    public function load_formations(Request $request)
    {
        $id = $request->Id;
        $formations = DB::select('select fm.nom_formation,fm.id,fm.domaine_id,dm.nom_domaine from domaines_interne as dm join formations_interne as fm on dm.id = fm.domaine_id where dm.id = ?', [$id]);
        return response()->json(['formations'=>$formations]);
    }

    public function load_formations_suppre(Request $request)
    {
        $id = $request->Id;
        $formations = DB::select('select fm.nom_formation,fm.id,fm.domaine_id,dm.nom_domaine from domaines_interne as dm join formations_interne as fm on dm.id = fm.domaine_id where dm.id = ?', [$id]);
        // $domaines = DB::select('select md.id,nom_domaine from domaines_interne as dm join formations_interne as fm on dm.id = fm.domaine_id where dm.id = ?', [$id]);
        return response()->json(['formations'=>$formations]);
    }

    public function supprimer_thematique(Request $request)
    {
        $id = $request->id_domaine;
        DB::delete('delete from domaines_interne where id = ?', [$id]);
        // $test = DB::select('select * from competence_a_evaluers')
        return back();
    }

    public function supprimer_domaine(Request $request)
    {
        $id = $request->Id;
        DB::delete('delete from domaines_interne where id = ?', [$id]);
        // $test = DB::select('select * from competence_a_evaluers')
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully',
            ]
        );
    }

    public function suppression_formation(Request $request)
    {
        $id = $request->Id;
        DB::delete('delete from formations_interne where id = ?', [$id]);
        // $test = DB::select('select * from competence_a_evaluers')
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully',
            ]
        );
    }

    public function update_formation_domaine(Request $request)
    {
        $id = $request->id_domaine;
        $donnees = $request->all();
        $fonct = new FonctionGenerique();
        if ($request->domaine != null) {
            DB::update('update domaines_interne set nom_domaine =? where id = ?', [$request->domaine, $id]);
            $formation = $fonct->findWhere('formations_interne', ['domaine_id'], [$id]);

            for ($i = 0; $i < count($formation); $i++) {
                $id_formation = $donnees['id_formation_' . $id . '_' . $formation[$i]->id];
                $val_formation = $donnees['formation_' . $id . '_' . $formation[$i]->id];

                if ($donnees['formation_' . $id . '_' . $formation[$i]->id] != null) {
                    DB::update('update formations_interne set nom_formation = ? where domaine_id = ? and id = ?', [$val_formation, $id, $id_formation]);
                } else {
                    return back()->with('error', "l'une de ses informations est invalid");
                }
            }
            return back();
        }
    }

    public function new_domaine(Request $request){
        $fonct = new FonctionGenerique();

        $request->validate(
            [
                'domaine' => ["required"],
                'formation' => ["required"]
            ],
            [
                'domaine.required' => 'Veuillez remplir le champ',
                'formation.required' => 'Veuillez remplir le champ'
            ]
        );
        $id_user = Auth::user()->id;
        $etp_id = $fonct->findWhereMulitOne("responsables",["user_id"],[$id_user]);
        DB::beginTransaction();
        try {
            DB::insert('insert into domaines_interne(nom_domaine,etp_id) values(?,?)',[$request->domaine,$etp_id->entreprise_id]);
            $id_domaine = DB::select('select id from domaines_interne where etp_id = ? order by id desc limit 1',[$etp_id->entreprise_id]);
            for($k = 0; $k < count($request['formation']); $k++){
                DB::insert('insert into formations_interne(nom_formation,domaine_id) values(?,?)',[$request['formation'][$k], $id_domaine[0]->id]);
            }

            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('message','Le domaine n\est pas enregistrer, réessayer!');
        }
    }

    public function new_formation(Request $request){
        $fonct = new FonctionGenerique();

        $request->validate(
            [
                'domaine' => ["required"],
                'formation' => ["required"]
            ],
            [
                'domaine.required' => 'Veuillez remplir le champ',
                'formation.required' => 'Veuillez remplir le champ'
            ]
        );
        DB::beginTransaction();
        try {
            for($k = 0; $k < count($request['formation']); $k++){
                DB::insert('insert into formations_interne(nom_formation,domaine_id) values(?,?)',[$request['formation'][$k], $request['domaine']]);
            }

            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('message','Le domaine n\est pas enregistrer, réessayer!');
        }
    }

    public function formateurs(){
        return view('referent.projet_Interne.formateurs.formateur');
    }

    public function projets(){
        return view('referent.projet_Interne.projets.projet');
    }
}
