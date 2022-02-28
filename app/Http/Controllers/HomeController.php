<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\abonnement_cfp;
use App\abonnement;
use App\offre_gratuit;
use App\type_abonnement;
use App\tarif_categorie;
use App\type_abonne;
use App\type_abonnement_role;
use App\Facture;
use App\detail;
use App\entreprise;
use App\formation;
use App\module;
use App\projet;
use App\responsable;
use App\ResponsableCfpModel;
use App\stagiaire;
use App\User;
use Illuminate\Support\Facades\Gate;
use App\Models\FonctionGenerique;
use App\cfp;
use App\chefDepartement;
use App\formateur;
use App\Collaboration;
use App\Models\getImageModel;
use function Ramsey\Uuid\v1;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->collaboration = new Collaboration();
        // $this->middleware('auth');
        // $this->middleware(function ($request, $next) {
        //     if (Auth::user()->exists == false) return view('auth.connexion');
        //     return $next($request);
        // });
    }


    // public function index(Request $request)
    // {
    //     if (Auth::user()->exists) {
    //         $totale_invitation = $this->collaboration->count_invitation();
    //         return view('layouts.accueil_admin', compact('totale_invitation'));
    //     }

    // }
    //affichage role
    public function affichage_role(Request  $request) {
        $user_id = $request->id_user;
        $liste_role = DB::select('select * from v_user_role where user_id = ?', [$user_id]);
         return response()->json($liste_role);
    }
    //remplissage des info manquantes
    public function remplir_info_stagiaire(Request $request){
        $id_stg = $request->input('id_stg');

        if ($request->input('nom_stg') != null) {
            DB::update('update stagiaires set nom_stagiaire = ? where id = ?', [$request->input('nom_stg'),$id_stg]);
        }
        if ($request->input('titre_stg') != null) {
            DB::update('update stagiaires set titre = ? where id = ?', [$request->input('titre_stg'),$id_stg]);
        }
        if ($request->input('date_naissance_stg') != null) {
            DB::update('update stagiaires set date_naissance = ? where id = ?', [$request->input('date_naissance_stg'),$id_stg]);
        }
        if ($request->input('genre_stg') != null) {
            DB::update('update stagiaires set genre_stagiaire = ? where id = ?', [$request->input('genre_stg'),$id_stg]);
        }
        if ($request->input('tel_stg') != null) {
            DB::update('update stagiaires set telephone_stagiaire = ? where id = ?', [$request->input('tel_stg'),$id_stg]);
        }
        if ($request->input('cin_stg') != null) {
            DB::update('update stagiaires set cin = ? where id = ?', [$request->input('cin'),$id_stg]);
        }
        if ($request->input('lot') != null) {
            DB::update('update stagiaires set lot = ? where id = ?', [$request->input('lot'),$id_stg]);
        }
        if ($request->input('quartier') != null) {
            DB::update('update stagiaires set quartier = ? where id = ?', [$request->input('quartier'),$id_stg]);
        }
        if ($request->input('ville') != null) {
            DB::update('update stagiaires set ville = ? where id = ?', [$request->input('ville'),$id_stg]);
        }
        if ($request->input('code_postal') != null) {
            DB::update('update stagiaires set code_postal = ? where id = ?', [$request->input('code_postal'),$id_stg]);
        }
        if ($request->input('region') != null) {
            DB::update('update stagiaires set region = ? where id = ?', [$request->input('region'),$id_stg]);
        }
        if ($request->input('niveau_stg') != null) {
            DB::update('update stagiaires set niveau_etude = ? where id = ?', [$request->input('niveau_stg'),$id_stg]);
        }
        if(count($request->input()) > 2){
            return redirect()->back()->with('error','Remplissez les champs vides');
        }
        else{
            $totale_invitation = $this->collaboration->count_invitation();
            return view('layouts.accueil_admin', compact('totale_invitation'));
        }
    }
    public function remplir_info_manager(Request $request){
        $id_chef = $request->input('id_chef');

        if ($request->input('nom_chef') != null) {
            DB::update('update chef_departements set nom_chef = ? where id = ?', [$request->input('nom_chef'),$id_chef]);
        }
        if ($request->input('genre_chef') != null) {
            DB::update('update chef_departements set genre_chef = ? where id = ?', [$request->input('genre_chef'),$id_chef]);
        }
        if ($request->input('tel_chef') != null) {
            DB::update('update chef_departements set telephone_chef = ? where id = ?', [$request->input('tel_chef'),$id_chef]);
        }
        if ($request->input('cin_chef') != null) {
            DB::update('update chef_departements set cin_chef = ? where id = ?', [$request->input('cin_chef'),$id_chef]);
        }


        if(count($request->input()) > 2){
            return redirect()->back()->with('error','Remplissez les champs vides');
        }
        else{
            $totale_invitation = $this->collaboration->count_invitation();
            return view('layouts.accueil_admin', compact('totale_invitation'));
        }
    }
    public function remplir_info_resp(Request $request){
        $id_resp = $request->input('id_resp');

        if ($request->input('nom_resp') != null) {
            DB::update('update responsables set nom_resp = ? where id = ?', [$request->input('nom_resp'),$id_resp]);
        }
        if ($request->input('date_naissance_resp') != null) {
            DB::update('update responsables set date_naissance_resp = ? where id = ?', [$request->input('date_naissance_resp'),$id_resp]);
        }
        if ($request->input('genre') != null) {
            DB::update('update responsables set sexe_resp = ? where id = ?', [$request->input('genre'),$id_resp]);
        }
        if ($request->input('tel_resp') != null) {
            DB::update('update responsables set telephone_resp = ? where id = ?', [$request->input('tel_resp'),$id_resp]);
        }
        if ($request->input('cin_resp') != null) {
            DB::update('update responsables set cin_resp = ? where id = ?', [$request->input('cin_resp'),$id_resp]);
        }
        if ($request->input('lot') != null) {
            DB::update('update responsables set adresse_lot = ? where id = ?', [$request->input('lot'),$id_resp]);
        }
        if ($request->input('quartier') != null) {
            DB::update('update responsables set adresse_quartier = ? where id = ?', [$request->input('quartier'),$id_resp]);
        }
        if ($request->input('ville') != null) {
            DB::update('update responsables set adresse_ville = ? where id = ?', [$request->input('ville'),$id_resp]);
        }
        if ($request->input('code_postal') != null) {
            DB::update('update responsables set adresse_code_postal = ? where id = ?', [$request->input('code_postal'),$id_resp]);
        }
        if ($request->input('region') != null) {
            DB::update('update responsables set adresse_region = ? where id = ?', [$request->input('region'),$id_resp]);
        }
        if(count($request->input()) > 2){
            return redirect()->back()->with('error','Remplissez les champs vides');
        }
        else{
            $user_id = User::where('id', Auth::user()->id)->value('id');
            return view('layouts.dashboard_referent');
        }
    }
    public function index(Request $request, $id = null)
    {


        if (Gate::allows('isStagiairePrincipale')) {
             //get the column with null value
            $databaseName = DB::connection()->getDatabaseName();
            $testNull = DB::select('select * from stagiaires where user_id  = ? ',[Auth::user()->id]);
            $entreprise = DB::select('select * from entreprises where id  = ? ',[$testNull[0]->entreprise_id]);

            $colonnes = DB::select(' select COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS  WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?',[$databaseName,'stagiaires']);
            $nb = 0;
            for ($i=0; $i < count($colonnes); $i++) {
                $tempo =  $colonnes[$i]->COLUMN_NAME;
                if ($colonnes[$i]->COLUMN_NAME != "branche_id" and  $colonnes[$i]->COLUMN_NAME != "service_id" and $colonnes[$i]->COLUMN_NAME != "matricule" and $colonnes[$i]->COLUMN_NAME != "photos" and $colonnes[$i]->COLUMN_NAME != "updated_at"){
                    if ($testNull[0]-> $tempo== null) {
                        $nb+=1;
                    }
                }
            }
            //lorsque les informations différents que branche  id, service id , matricule sont vides alors on incite l'utilisateur à remplir les infos
            if ($nb>0) {
                return view('formulaire_stagiaire',compact('testNull','entreprise'));
            }

            $valeur = DB::select('select activiter,id from stagiaires where user_id = ' . Auth::id());
            $activiter = $valeur[0]->activiter;
            $stg_id =  $valeur[0]->id;

            //si le compte stagiaire est actif
            if ($activiter == 1) {
                if (Auth::user()->exists) {
                    $totale_invitation = $this->collaboration->count_invitation();
                    return view('layouts.accueil_admin', compact('totale_invitation'));
                }
            }
            //si le compte est inactif, on vérifie d'abord si le stagiaire est déjà dans une autre entreprise
            if ($activiter == 0) {
                $value_etp = DB::select('select nouveau_entreprise_id,particulier from historique_stagiaires where stagiaire_id = ' . $stg_id);
                $etp_nouveau_id = $value_etp[0]->nouveau_entreprise_id;
                $particulier = $value_etp[0]->particulier;
                if ($etp_nouveau_id == 0 && $particulier == 0) {
                    $msg = 'Vous n\'êtes plus employé en ce moment,veuillez ajouter votre adresse e-mail personnelle';
                    return view('auth.email_nouveau', compact('msg'));
                }
                if ($etp_nouveau_id == 0  && $particulier == 1) {
                    if (Auth::user()->exists) {
                        $totale_invitation = $this->collaboration->count_invitation();
                        return view('layouts.accueil_admin', compact('totale_invitation'));
                    }
                }
                if ($etp_nouveau_id == 1) {
                    if (Auth::user()->exists) {
                        $totale_invitation = $this->collaboration->count_invitation();
                        return view('layouts.accueil_admin', compact('totale_invitation'));
                    }
                }
            }
        }

        if (Gate::allows('isCFPPrincipale')) {

            $fonct = new FonctionGenerique();

            $user_id = Auth::user()->id;
            $cfp = Cfp::where('user_id', $user_id)->value('nom');
            // cfp_id
            $cfp_id = Cfp::where('user_id', $user_id)->value('id');

            $user_id = User::where('id', Auth::user()->id)->value('id');
            $centre_fp = $fonct->findWhereMulitOne("responsables_cfp",["user_id"],[$user_id])->cfp_id;
            // $centre_fp = cfp::where('user_id', $user_id)->value('id');

            $GChart = DB::select('SELECT ROUND(IFNULL(SUM(net_ht),0),2) as net_ht ,ROUND(IFNULL(SUM(net_ttc),0),2) as net_ttc , MONTH(invoice_date) as mois,
                year(invoice_date) as annee from v_facture_existant where year(invoice_date)=year(now()) or year(invoice_date)=YEAR(DATE_SUB(now(),
                INTERVAL 1 YEAR)) and cfp_id = ' . $centre_fp . ' group by MONTH(invoice_date),
                year(invoice_date) order by MONTH( invoice_date),year(invoice_date) desc');

            $CA_actuel = DB::select('SELECT ROUND(IFNULL(SUM(net_ht),0),2) as total_ht,ROUND(IFNULL(SUM(net_ttc),0),2) as total_ttc from v_facture_existant where YEAR(invoice_date)=year(now()) and cfp_id = ' . $centre_fp . ' ');
            $CA_precedent = DB::select('SELECT ROUND(IFNULL(SUM(net_ht),0),2) as total_ht,ROUND(IFNULL(SUM(net_ttc),0),2) as total_ttc from v_facture_existant where year(invoice_date)=YEAR(DATE_SUB(now(), INTERVAL 1 YEAR)) and cfp_id = ' . $centre_fp . ' ');

            // debut
            // $formations = formation::where('cfp_id', $centre_fp)->value('id');
            // $top_10_module = DB::select('select ');
            // ty no anaovana DB select  $modules = module::where('formation_id', $formations)->value('id');
            // fin

            // debut top 10 par client
            // fin top 10 par client
            // dd($user_id, $centre_fp, $top_10_par_client);




            $drive = new getImageModel();
            $drive->create_folder($cfp);
            $drive->create_sub_folder($cfp,"Mes documents");

            $formateur = DB::select('select * from demmande_cfp_formateur where demmandeur_cfp_id = ' . $centre_fp . ' ');
            $dmd_cfp_etp = DB::select('select * from demmande_cfp_etp where demmandeur_cfp_id = ' . $centre_fp . ' ');
            $resp_cfp = DB::select('select * from responsables_cfp where user_id = ' . $user_id . ' ');

            $module_publié = DB::select('select * from modules where status = 2 and cfp_id = ' . $cfp_id . ' ');
            $module_encours_publié = DB::select('select * from modules where status = 1 and cfp_id = ' . $cfp_id . ' ');

            $facture_paye = DB::select('select * from v_facture_actif where facture_encour = "terminer" and cfp_id = ' . $cfp_id . ' ');
            $facture_non_echu = DB::select('select * from v_facture_actif where facture_encour = "en_cours" and cfp_id = ' . $cfp_id . ' ');
            $facture_brouillon = DB::select('select * from v_facture_inactif where cfp_id = ' . $cfp_id . ' ');

            $session_intra_terminer = DB::select('select * from v_groupe_projet_entreprise where status_groupe = 4 and cfp_id = ' . $cfp_id . ' ');
            $session_intra_previ = DB::select('select * from v_groupe_projet_entreprise where status_groupe = 1 and cfp_id = ' . $cfp_id . ' ');
            $session_intra_en_cours = DB::select('select * from v_groupe_projet_entreprise where status_groupe = 3 and cfp_id = ' . $cfp_id . ' ');
            $session_intra_avenir = DB::select('select * from v_groupe_projet_entreprise where status_groupe = 2 and cfp_id = ' . $cfp_id . ' ');

            $nom_profil_organisation = cfp::where('user_id', $user_id)->value('nom');


            // $test_abonne = abonnement_cfp::where('cfp_id', $cfp_id)->exists();
            // // $abn =type_abonnement::all();

            // $typeAbonne_id = 2;
            // $typeAbonnement = type_abonnement_role::with('type_abonnement')->where('type_abonne_id', $typeAbonne_id)->value('id');
            // $name = DB::select('select nom_type from type_abonnements where id = '. $typeAbonnement .' ');

            if ($id!=null) {
                $ref = $fonct->findWhereMulitOne("cfps",["id"],[$id]);
            }
            else{
                $ref = $fonct->findWhereMulitOne("cfps",["user_id"],[Auth::user()->id]);
            }

            return view('cfp.dashboard_cfp.dashboard', compact('nom_profil_organisation','ref','formateur','dmd_cfp_etp','resp_cfp','module_publié','module_encours_publié','facture_paye','facture_non_echu','facture_brouillon','session_intra_terminer','session_intra_previ','session_intra_en_cours','session_intra_avenir'));
        }
        // else {
        //     $totale_invitation = $this->collaboration->count_invitation();
        //     return view('layouts.accueil_admin', compact('totale_invitation'));
        // }

        if (Gate::allows('isReferentPrincipale')) {
            //get the column with null value

            $testNull = DB::select('select * from responsables where user_id  = ? ',[Auth::user()->id]);
            $entreprise = DB::select('select * from entreprises where id  = ? ',[$testNull[0]->entreprise_id]);
            $departement = DB::select('select * from departement_entreprises where id  = ? ',[$testNull[0]->departement_entreprises_id]);

            $databaseName = DB::connection()->getDatabaseName();

            $colonnes = DB::select(' select COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS  WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?',[$databaseName,'responsables']);
            $nb = 0;
            for ($i=0; $i < count($colonnes); $i++) {
                $tempo =  $colonnes[$i]->COLUMN_NAME;
                if ($colonnes[$i]->COLUMN_NAME != "branche_id" and  $colonnes[$i]->COLUMN_NAME != "service_id" and  $colonnes[$i]->COLUMN_NAME != "departement_entreprises_id" and  $colonnes[$i]->COLUMN_NAME != "poste_resp" and $colonnes[$i]->COLUMN_NAME != "photos" and $colonnes[$i]->COLUMN_NAME != "updated_at" and $colonnes[$i]->COLUMN_NAME != "matricule"){
                    if ($testNull[0]-> $tempo== null) {
                        $nb+=1;
                    }
                }
            }
            //lorsque les informations différents que branche  id, service id , matricule sont vides alors on incite l'utilisateur à remplir les infos

            if ($nb>0) {
                return view('formulaire',compact('testNull','entreprise','departement'));
            }
            else{
                // $user_id = User::where('id', Auth::user()->id)->value('id');
                // return view('layouts.dashboard_referent');
                $fonct = new FonctionGenerique();

                $user_id = User::where('id', Auth::user()->id)->value('id');
                $ref = $fonct->findWhereMulitOne("responsables",["user_id"],[$user_id])->user_id;

                $nom_profil_referent = responsable::where('user_id', $user_id)->value('id');
                $etp = entreprise::where('id',$nom_profil_referent)->value('nom_etp');
                $etp_id = entreprise::where('id',$nom_profil_referent)->value('id');

                // $refs = DB::select('select nif,stat,rcs from entreprises where id = ' . $nom_profil_referent . ' ');

                $refs_tmp = DB::select('select nif,stat,rcs from entreprises where id = ?',[$nom_profil_referent]);
                $refs =$refs_tmp[0];

                $formateur_referent = DB::select('select * from demmande_formateur_cfp where demmandeur_formateur_id = ' . $ref . ' ');

                $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');
                $etp1Collaborer = $fonct->findWhere("v_demmande_etp_cfp", ["entreprise_id"], [$entreprise_id]);
                $etp2Collaborer = $fonct->findWhere("v_demmande_cfp_etp", ["entreprise_id"], [$entreprise_id]);
                $cfps = $fonct->concatTwoList($etp1Collaborer, $etp2Collaborer);

                $facture_paye = DB::select('select * from v_facture_actif where facture_encour = "terminer" and entreprise_id = ' . $ref . ' ');
                $facture_non_echu = DB::select('select * from v_facture_actif where facture_encour = "en_cours" and entreprise_id = ' . $ref . ' ');

                $session_intra_terminer = DB::select('select * from v_groupe_projet_entreprise where status_groupe = 4 and entreprise_id = ' . $ref . ' ');
                $session_intra_previ = DB::select('select * from v_groupe_projet_entreprise where status_groupe = 1 and entreprise_id = ' . $ref . ' ');
                $session_intra_en_cours = DB::select('select * from v_groupe_projet_entreprise where status_groupe = 3 and entreprise_id = ' . $ref . ' ');
                $session_intra_avenir = DB::select('select * from v_groupe_projet_entreprise where status_groupe = 2 and entreprise_id = ' . $ref . ' ');

                $stagiaires = DB::select('select * from stagiaires where entreprise_id = ?', [$etp_id]);
                $nb_stagiaire = count($stagiaires);
                $responsables = DB::select('select * from responsables where entreprise_id = ?', [$etp_id]);
                $nb_responsable = count($responsables);
                $chef_departements = DB::select('select * from v_chef_departement_entreprise where entreprise_id = ?', [$etp_id]);
                $nb_cDepartement = count($chef_departements);
                $total = $nb_stagiaire + $nb_responsable + $nb_cDepartement ;


                // $test_abonne = abonnement::where('user_id', $etp_id)->exists();
                // $abn =type_abonnement::all();

                $typeAbonne_id = 1;
                $typeAbonnement = type_abonnement_role::with('type_abonnement')->where('type_abonne_id', $typeAbonne_id)->value('id');
                $name = DB::select('select nom_type from type_abonnements where id = ?', [$typeAbonnement] );


                if ($id!=null) {
                    $referent = $fonct->findWhereMulitOne("responsables",["id"],[$id]);
                }
                else{
                    $referent = $fonct->findWhereMulitOne("responsables",["user_id"],[Auth::user()->id]);
                }

                return view('referent.dashboard_referent.dashboard_referent',compact('etp','referent','refs','formateur_referent','cfps','facture_paye','facture_non_echu','session_intra_terminer','session_intra_previ','session_intra_en_cours','session_intra_avenir','nb_stagiaire','total','name'));

            }


        }
        // else {
        //      //get the column with null value
        //      $databaseName = DB::connection()->getDatabaseName();
        //      $testNull = DB::select('select * from chef_departements where user_id  = ? ',[Auth::user()->id]);
        //      $entreprise = DB::select('select * from entreprises where id  = ? ',[$testNull[0]->entreprise_id]);

        //      $colonnes = DB::select(' select COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS  WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?',[$databaseName,'chef_departements']);
        //      $nb = 0;
        //      for ($i=0; $i < count($colonnes); $i++) {
        //          $tempo =  $colonnes[$i]->COLUMN_NAME;
        //          if ($colonnes[$i]->COLUMN_NAME != "matricule" and $colonnes[$i]->COLUMN_NAME != "updated_at" and $colonnes[$i]->COLUMN_NAME != "photos"){
        //             if ($testNull[0]-> $tempo== null) {
        //                 $nb+=1;
        //             }
        //         }

        //      }
        //      //lorsque les informations différents que branche  id, service id , matricule sont vides alors on incite l'utilisateur à remplir les infos
        //      if ($nb>0) {
        //          return view('formulaire_manager',compact('testNull','entreprise'));
        //      }
        //     $totale_invitation = $this->collaboration->count_invitation();
        //     return view('layouts.accueil_admin', compact('totale_invitation'));
        // }
    }


    public function liste_projet(Request $request, $id = null)
    {
        $projet_model = new projet();

        $fonct = new FonctionGenerique();

        $user_id = Auth::user()->id;
        $totale_invitation = $this->collaboration->count_invitation();
        $entp = new entreprise();
        $status = DB::select('select * from status');
        $type_formation_id = $request->type_formation;
        // dd($type_formation_id);
        //récupérer id de l'utilisateur en fonction de l'email
        // $role_id = User::where('email', Auth::user()->email)->value('role_id');
        $data = [];
        if (Gate::allows('isSuperAdmin') || Gate::allows('isAdmin')) {

            //on récupère tous les projets de formation
            $projet = projet::get()->unique('nom_projet');
            $data = $fonct->findAll("v_projet_session");
            $cfp = $fonct->findAll("cfps");
            $entreprise = entreprise::all();
            return view('admin.projet.home', compact('data', 'cfp', 'projet', 'totale_invitation', 'entreprise','status'));
        }
        if (Gate::allows('isReferent')) {
            //on récupère l'entreprise id de la personne connecté

            // $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');
            // $data = $fonct->findWhere("v_projetentreprise", ["entreprise_id"], [$entreprise_id]);
            // $cfp = $fonct->findAll("cfps");
            // return view('admin.projet.home', compact('data', 'cfp', 'totale_invitation'));
            if (Gate::allows('isReferentPrincipale')) {
                $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');
            }
            if (Gate::allows('isStagiairePrincipale')) {
                $entreprise_id = stagiaire::where('user_id', $user_id)->value('entreprise_id');
            }
            if (Gate::allows('isManagerPrincipale')) {
                $entreprise_id = chefDepartement::where('user_id', $user_id)->value('entreprise_id');
            }

            $data = $fonct->findWhere("v_groupe_projet_entreprise", ["entreprise_id"], [$entreprise_id]);
            // $infos = DB::select('select * from where entreprise_id = ?', [$entreprise_id]);
            $stagiaires = DB::select('select * from v_participant_groupe where entreprise_id = ?', [$entreprise_id]);
            return view('projet_session.index2', compact('data', 'stagiaires','status'));
        }
        if (Gate::allows('isManager')) {
            //on récupère l'entreprise id de la personne connecté

            $entreprise_id = chefDepartement::where('user_id', $user_id)->value('entreprise_id');
            $data = $fonct->findWhere("v_projetentreprise", ["entreprise_id"], [$entreprise_id]);
            $cfp = $fonct->findAll("cfps");
            return view('admin.projet.home', compact('data', 'cfp', 'totale_invitation','status'));
        } elseif (Gate::allows('isStagiaire')) {
            return view('layouts.accueil_admin');
        } elseif (Gate::allows('isCFP')) {

            $cfp_id = cfp::where('user_id', $user_id)->value('id');
            $sql = $projet_model->build_requette($cfp_id,$type_formation_id,"v_projet_session",$request);
            // dd($sql);
            $projet = DB::select($sql);
            // $projet = $fonct->findWhere("v_projet_session", ["cfp_id","type_formation_id"], [$cfp_id,$type_formation_id]);
            if($type_formation_id == 1){
                $data = $fonct->findWhere("v_groupe_projet_entreprise", ["cfp_id","type_formation_id"], [$cfp_id,$type_formation_id]);
            }
            elseif($type_formation_id == 2){
                $data = $fonct->findWhere("v_projet_session_inter", ["cfp_id","type_formation_id"], [$cfp_id,$type_formation_id]);
            }
            $etp1 = $fonct->findWhere("v_demmande_etp_cfp", ["cfp_id"], [$cfp_id]);
            $etp2 = $fonct->findWhere("v_demmande_cfp_etp", ["cfp_id"], [$cfp_id]);

            $entreprise = $entp->getEntreprise($etp2, $etp1);

            $formation = $fonct->findAll("formations");
            $module = $fonct->findAll("modules");

            $type_formation = DB::select('select * from type_formations');

            return view('projet_session.index2', compact('projet', 'data', 'entreprise', 'totale_invitation', 'formation', 'module','type_formation','status','type_formation_id'));
        }
        if (Gate::allows('isFormateur')) {
            $formateur_id = formateur::where('user_id', $user_id)->value('id');
            $cfp_id = DB::select("select cfp_id from v_demmande_cfp_formateur where user_id_formateur = ?", [$user_id])[0]->cfp_id;
            $projet = $fonct->findWhere("v_projet_session", ["cfp_id","type_formation_id"], [$cfp_id,$type_formation_id]);
            $data = $fonct->findWhere("v_groupe_projet_entreprise", ["cfp_id","type_formation_id"], [$cfp_id,$type_formation_id]);


            $etp1 = $fonct->findWhere("v_demmande_etp_cfp", ["cfp_id"], [$cfp_id]);
            $etp2 = $fonct->findWhere("v_demmande_cfp_etp", ["cfp_id"], [$cfp_id]);

            $entreprise = $entp->getEntreprise($etp2, $etp1);

            $formation = $fonct->findWhere("formations", ["cfp_id"], [$cfp_id]);
            $module = $fonct->findAll("modules");

            return view('projet_session.index2', compact('projet','data', 'entreprise', 'totale_invitation', 'formation', 'module','status'));
        }
    }

    public function compte(Request $request)
    {
        $totale_invitation = $this->collaboration->count_invitation();
        return view('suivi.compte', compact('totale_invitation'));
    }
    public function detail($id)
    {
        $totale_invitation = $this->collaboration->count_invitation();
        $id_module = detail::where('id', $id)->value('module_id');
        $nom_module = module::where('id', $id_module)->value('nom_module');
        $id_formation = module::where('id', $id_module)->value('formation_id');
        $nom_formation = formation::where('id', $id_formation)->value('nom_formation');
        //récupérer id du projet en fonction de l'id du détail
        $id_projet = detail::where('id', $id)->value('projet_id');
        //récupérer nom du projet en fonction de l'id projet
        $nom_projet = projet::where('id', $id_projet)->value('nom_projet');

        $datas = DB::table('executions')
            ->join('details', 'details.id', '=', 'executions.detail_id')
            ->join('stagiaires', 'stagiaires.id', '=', 'executions.stagiaire_id')

            ->select(
                'stagiaires.nom_stagiaire',
                'stagiaires.prenom_stagiaire',
                'stagiaires.genre_stagiaire',
                'stagiaires.fonction_stagiaire',
                'stagiaires.mail_stagiaire',
                'stagiaires.telephone_stagiaire',
                'executions.qualite_formation',
                'executions.evaluation_formation',
                'executions.note',
                'stagiaires.id',

            )
            ->where('details.id', $id)
            ->get();
        return view('suivi.liste', compact('nom_module', 'nom_formation', 'datas', 'nom_projet', 'totale_invitation'));
    }
    public function profil($id)
    {
        //récupérer les informations personnelles du stagiaire
        $my_data = DB::table('stagiaires')
            ->select(
                'stagiaires.nom_stagiaire',
                'stagiaires.prenom_stagiaire',
                'stagiaires.genre_stagiaire',
                'stagiaires.fonction_stagiaire',
                'stagiaires.mail_stagiaire',
                'stagiaires.telephone_stagiaire',

            )
            ->where('stagiaires.id', $id)
            ->get();
        //recupérer le détail des formations que le/le stagiaire a suivi
        $datas = DB::table('executions')
            ->join('details', 'details.id', '=', 'executions.detail_id')
            ->join('entreprises', 'entreprises.id', '=', 'details.entreprise_id')
            ->join('stagiaires', 'stagiaires.id', '=', 'executions.stagiaire_id')
            ->join('modules', 'modules.id', '=', 'details.module_id')
            ->join('formations', 'formations.id', '=', 'modules.formation_id')
            ->select(
                'modules.nom_module',
                'formations.nom_formation',
                'details.lieu',
                'details.date_debut',
                'details.date_fin',
                'executions.evaluation_formation',
                'executions.qualite_formation',
                'executions.note',
                'details.id'
            )
            ->where('executions.stagiaire_id', $id)
            ->distinct()
            ->get();

        $totale_invitation = $this->collaboration->count_invitation();
        return view('suivi.profil', compact('datas', 'my_data', 'totale_invitation'));
    }
    public function liste()
    {
        //récupérer id de l'utilisateur en fonction de l'email
        $user_id = User::where('email', Auth::user()->email)->value('id');
        //récupérer id responsable
        $id_resp = responsable::where('user_id', $user_id)->value('id');
        $datas = DB::table('stagiaires')
            ->join('entreprises', 'entreprises.id', '=', 'stagiaires.entreprise_id')
            ->select(

                'stagiaires.id',
                'stagiaires.nom_stagiaire',
                'stagiaires.prenom_stagiaire',
                'stagiaires.genre_stagiaire',
                'stagiaires.fonction_stagiaire',
                'stagiaires.mail_stagiaire',
                'stagiaires.telephone_stagiaire',
                'entreprises.nom_etp'
            )


            ->orderBy('stagiaires.nom_stagiaire')
            ->paginate(10);
        $totale_invitation = $this->collaboration->count_invitation();
        return view('suivi.liste_generale', compact('datas', 'totale_invitation'));
    }

    public function accueil()
    {
        $totale_invitation = $this->collaboration->count_invitation();
        return view('layouts.accueil_admin', compact('totale_invitation'));
    }

    public function liste_notification()
    {
        return  view('layouts.notifications');
    }

    public function liste_message()
    {
        return  view('layouts.messages');
    }

    public function profil_user()
    {
        $id_user = Auth::user()->id;
        if (Gate::allows('isSuperAdmin')) {
            $profil_user = 'images/entreprises/TEST15-11-2021.png';
        }
        if (Gate::allows('isAdmin')) {
            $profil_user = 'images/entreprises/TEST15-11-2021.png';
        }
        if (Gate::allows('isCFP')) {
            $logo = cfp::where('user_id', $id_user)->value('logo');
            $profil_user = 'images/CFP/' . $logo;
        }
        if (Gate::allows('isFormateur')) {
            $photo_formateur = formateur::where('user_id', $id_user)->value('photos');
            $profil_user = 'images/formateurs/' . $photo_formateur;
        }
        if (Gate::allows('isStagiaire')) {
            $photo_stagiaire = stagiaire::where('user_id', $id_user)->value('photos');
            $profil_user = 'images/stagiaires/' . $photo_stagiaire;
        }
        if (Gate::allows('isReferent')) {
            $photo_referent = responsable::where('user_id', $id_user)->value('photos');
            $profil_user = 'images/responsables/' . $photo_referent;
        }
        if (Gate::allows('isManager')) {
            $photo_manager = chefDepartement::where('user_id', $id_user)->value('photos');
            $profil_user = 'images/chefDepartement/' . $photo_manager;
        }
        return response()->json($profil_user);
    }
    //modification e-mail stagiaire en cas de changement d'entreprise
    public function update_email(Request $request)
    {
        $email = $request->email;
        $user_id = Auth::id();
        $val = db::select('select id from stagiaires where user_id = ' . $user_id);
        $id_stg = $val[0]->id;
        DB::update('update stagiaires set mail_stagiaire = ? where user_id = ?', [$email, $user_id]);
        DB::update("update users set email = ? where id = ?", [$email, $user_id]);
        DB::update("update historique_stagiaires set particulier = ? where stagiaire_id = ?", [1, $id_stg]);
        $totale_invitation = $this->collaboration->count_invitation();
        return view('layouts.accueil_admin', compact('totale_invitation'));
    }
}
