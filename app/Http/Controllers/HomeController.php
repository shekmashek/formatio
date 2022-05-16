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
use App\taux_devises;
use Illuminate\Support\Facades\Gate;
use App\Models\FonctionGenerique;
use App\cfp;
use App\tva;
use App\Devise;
use App\chefDepartement;
use App\formateur;
use App\Collaboration;
use App\EvaluationChaud;
use App\Groupe;
use App\Models\getImageModel;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Offset;

use function Ramsey\Uuid\v1;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->collaboration = new Collaboration();
        $this->middleware('auth');
        $this->fonct = new FonctionGenerique();
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return view('auth.connexion');
            return $next($request);
        });
    }


    // public function index(Request $request)
    // {
    //     if (Auth::user()->exists) {
    //         $totale_invitation = $this->collaboration->count_invitation();
    //         return view('layouts.accueil_admin', compact('totale_invitation'));
    //     }

    // }
    //affichage role
    public function affichage_role(Request  $request)
    {
        $user_id = $request->id_user;
        $liste_role = DB::select('select * from v_user_role where user_id = ?', [$user_id]);
        return response()->json($liste_role);
    }
    //remplissage des info manquantes
    public function remplir_info_stagiaire(Request $request)
    {
        $id_stg = $request->input('id_stg');

        if ($request->input('nom_stg') != null) {
            DB::update('update stagiaires set nom_stagiaire = ? where id = ?', [$request->input('nom_stg'), $id_stg]);
        }
        if ($request->input('titre_stg') != null) {
            DB::update('update stagiaires set titre = ? where id = ?', [$request->input('titre_stg'), $id_stg]);
        }
        if ($request->input('date_naissance_stg') != null) {
            DB::update('update stagiaires set date_naissance = ? where id = ?', [$request->input('date_naissance_stg'), $id_stg]);
        }
        if ($request->input('genre_stg') != null) {
            if ($request->input('genre_stg') == 'Femme') $genre = 1;
            if ($request->input('genre_stg') == 'Homme') $genre = 2;
            DB::update('update stagiaires set genre_stagiaire = ? where id = ?', [$genre, $id_stg]);
        }
        if ($request->input('tel_stg') != null) {
            DB::update('update stagiaires set telephone_stagiaire = ? where id = ?', [$request->input('tel_stg'), $id_stg]);
        }
        if ($request->input('cin_stg') != null) {
            DB::update('update stagiaires set cin = ? where id = ?', [$request->input('cin'), $id_stg]);
        }
        if ($request->input('lot') != null) {
            DB::update('update stagiaires set lot = ? where id = ?', [$request->input('lot'), $id_stg]);
        }
        if ($request->input('quartier') != null) {
            DB::update('update stagiaires set quartier = ? where id = ?', [$request->input('quartier'), $id_stg]);
        }
        if ($request->input('ville') != null) {
            DB::update('update stagiaires set ville = ? where id = ?', [$request->input('ville'), $id_stg]);
        }
        if ($request->input('code_postal') != null) {
            DB::update('update stagiaires set code_postal = ? where id = ?', [$request->input('code_postal'), $id_stg]);
        }
        if ($request->input('region') != null) {
            DB::update('update stagiaires set region = ? where id = ?', [$request->input('region'), $id_stg]);
        }
        if ($request->input('niveau_stg') != null) {
            DB::update('update stagiaires set niveau_etude = ? where id = ?', [$request->input('niveau_stg'), $id_stg]);
        }
        if (count($request->input()) > 2) {
            return redirect()->back()->with('error', 'Remplissez les champs vides');
        } else {
            $totale_invitation = $this->collaboration->count_invitation();
            return view('layouts.accueil_admin', compact('totale_invitation'));
        }
    }
    public function remplir_info_manager(Request $request)
    {
        $id_chef = $request->input('id_chef');

        if ($request->input('nom_chef') != null) {
            DB::update('update chef_departements set nom_chef = ? where id = ?', [$request->input('nom_chef'), $id_chef]);
        }
        if ($request->input('genre_chef') != null) {
            if ($request->input('genre_chef') == 'Femme') $genre = 1;
            if ($request->input('genre_chef') == 'Homme') $genre = 2;
            DB::update('update chef_departements set genre_chef = ? where id = ?', [$genre, $id_chef]);
        }
        if ($request->input('tel_chef') != null) {
            DB::update('update chef_departements set telephone_chef = ? where id = ?', [$request->input('tel_chef'), $id_chef]);
        }
        if ($request->input('cin_chef') != null) {
            DB::update('update chef_departements set cin_chef = ? where id = ?', [$request->input('cin_chef'), $id_chef]);
        }


        if (count($request->input()) > 2) {
            return redirect()->back()->with('error', 'Remplissez les champs vides');
        } else {
            $totale_invitation = $this->collaboration->count_invitation();
            return view('layouts.accueil_admin', compact('totale_invitation'));
        }
    }
    public function remplir_info_resp(Request $request)
    {
        $id_resp = $request->input('id_resp');

        if ($request->input('nom_resp') != null) {
            DB::update('update responsables set nom_resp = ? where id = ?', [$request->input('nom_resp'), $id_resp]);
        }
        if ($request->input('date_naissance_resp') != null) {
            DB::update('update responsables set date_naissance_resp = ? where id = ?', [$request->input('date_naissance_resp'), $id_resp]);
        }
        if ($request->input('genre') != null) {
            if ($request->input('genre') == "Homme") $genre = 2;
            else $genre = 1;
            DB::update('update responsables set genre_id = ? where id = ?', [$genre, $id_resp]);
        }
        if ($request->input('tel_resp') != null) {
            DB::update('update responsables set telephone_resp = ? where id = ?', [$request->input('tel_resp'), $id_resp]);
        }
        if ($request->input('cin_resp') != null) {
            DB::update('update responsables set cin_resp = ? where id = ?', [$request->input('cin_resp'), $id_resp]);
        }
        if ($request->input('lot') != null) {
            DB::update('update responsables set adresse_lot = ? where id = ?', [$request->input('lot'), $id_resp]);
        }
        if ($request->input('quartier') != null) {
            DB::update('update responsables set adresse_quartier = ? where id = ?', [$request->input('quartier'), $id_resp]);
        }
        if ($request->input('ville') != null) {
            DB::update('update responsables set adresse_ville = ? where id = ?', [$request->input('ville'), $id_resp]);
        }
        if ($request->input('code_postal') != null) {
            DB::update('update responsables set adresse_code_postal = ? where id = ?', [$request->input('code_postal'), $id_resp]);
        }
        if ($request->input('region') != null) {
            DB::update('update responsables set adresse_region = ? where id = ?', [$request->input('region'), $id_resp]);
        }
        if (count($request->input()) > 2) {
            return redirect()->back()->with('error', 'Remplissez les champs vides');
        } else {
            $user_id = User::where('id', Auth::user()->id)->value('id');
            return view('layouts.dashboard_referent');
        }
    }
    public function index(Request $request, $id = null)
    {
        if (Gate::allows('isFormateurPrincipale')) {
            return redirect()->route('calendrier');
        }
        if (Gate::allows('isManagerPrincipale')) {
            return redirect()->route('calendrier');
        }
        if (Gate::allows('isStagiairePrincipale')) {
            //get the column with null value
            $databaseName = DB::connection()->getDatabaseName();
            $testNull = DB::select('select * from stagiaires where user_id  = ? ', [Auth::user()->id]);

            $entreprise = DB::select('select * from entreprises where id  = ? ', [$testNull[0]->entreprise_id]);

            $colonnes = DB::select(' select COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS  WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?', [$databaseName, 'stagiaires']);
            $nb = 0;
            for ($i = 0; $i < count($colonnes); $i++) {
                $tempo =  $colonnes[$i]->COLUMN_NAME;
                if ($colonnes[$i]->COLUMN_NAME != "branche_id" and  $colonnes[$i]->COLUMN_NAME != "service_id" and  $colonnes[$i]->COLUMN_NAME != "url_photo" and $colonnes[$i]->COLUMN_NAME != "matricule" and $colonnes[$i]->COLUMN_NAME != "photos" and $colonnes[$i]->COLUMN_NAME != "updated_at") {
                    if ($testNull[0]->$tempo == null) {
                        $nb += 1;
                    }
                }
            }
            //lorsque les informations différents que branche  id, service id , matricule sont vides alors on incite l'utilisateur à remplir les infos
            if ($nb > 0) {
                return view('formulaire_stagiaire', compact('testNull', 'entreprise'));
            }

            $valeur = DB::select('select activiter,id from stagiaires where user_id = ' . Auth::id());
            $activiter = $valeur[0]->activiter;
            $stg_id =  $valeur[0]->id;
            //si le compte stagiaire est actif
            if ($activiter == 1) {
                if (Auth::user()->exists) {
                    $totale_invitation = $this->collaboration->count_invitation();
                    $phone_tmp =  DB::select('select * from v_stagiaire_entreprise where user_id = ?', [Auth::user()->id]);

                    return view('layouts.accueil_admin', compact('totale_invitation', 'phone_tmp'));
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
            // cfp_id
            //  $cfp_id = Cfp::where('user_id', $user_id)->value('id');
            $cfp_id = $fonct->findWhereMulitOne("responsables_cfp", ["user_id"], [$user_id])->cfp_id;

            $cfp = Cfp::where('id', $cfp_id)->value('nom');

            $user_id = User::where('id', Auth::user()->id)->value('id');
            $centre_fp = $fonct->findWhereMulitOne("responsables_cfp", ["user_id"], [$user_id])->cfp_id;
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


            /*

            $drive = new getImageModel();
            $drive->create_folder($cfp);
            $drive->create_sub_folder($cfp, "Mes documents");
*/
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

            $session_inter_terminer = DB::select('select * from v_groupe_projet_module where item_status_groupe = "terminer" and cfp_id = ' . $cfp_id . ' ');
            $session_inter_encours = DB::select('select * from v_groupe_projet_module where item_status_groupe = "en_cours" and cfp_id = ' . $cfp_id . ' ');
            $session_inter_previsionnel = DB::select('select * from v_groupe_projet_module where item_status_groupe = "previsionnel" and cfp_id = ' . $cfp_id . ' ');
            $session_inter_avenir = DB::select('select * from v_groupe_projet_module where item_status_groupe = "avenir" and cfp_id = ' . $cfp_id . ' ');
            $session_inter_annuler = DB::select('select * from v_groupe_projet_module where item_status_groupe = "annuler" and cfp_id = ' . $cfp_id . ' ');

            $nom_profil_organisation = cfp::where('id', $cfp_id)->value('nom');


            // $test_abonne = abonnement_cfp::where('cfp_id', $cfp_id)->exists();
            // // $abn =type_abonnement::all();

            // $typeAbonne_id = 2;
            // $typeAbonnement = type_abonnement_role::with('type_abonnement')->where('type_abonne_id', $typeAbonne_id)->value('id');
            // $name = DB::select('select nom_type from type_abonnements where id = '. $typeAbonnement .' ');

            if ($id != null) {
                $ref = $fonct->findWhereMulitOne("cfps", ["id"], [$id]);
            } else {
                $ref = $fonct->findWhereMulitOne("cfps", ["id"], [$cfp_id]);
            }
            //date now
            $dtNow = Carbon::today()->toDateString();
            $cfp_ab = DB::select('select * from v_abonnement_facture where cfp_id = ? order by facture_id desc limit 1', [$cfp_id]);
            if ($cfp_ab != null) {
                setlocale(LC_TIME, "fr_FR");
                $j1 = strftime('%d', strtotime($cfp_ab[0]->due_date));
                $j2 = strftime('%d', strtotime($dtNow));
                $jour_restant = $j1 - $j2;
                $message = "Il vous reste " . $jour_restant . " jours pour payer votre abonnement";
                $test = 1;
            } else {
                $test = 0;
                $message = "Vous êtes en mode gratuit";
            }
            return view('cfp.dashboard_cfp.dashboard', compact('test', 'message', 'nom_profil_organisation', 'ref', 'formateur', 'dmd_cfp_etp', 'resp_cfp', 'module_publié', 'module_encours_publié', 'facture_paye', 'facture_non_echu', 'facture_brouillon', 'session_intra_terminer', 'session_intra_previ', 'session_intra_en_cours', 'session_intra_avenir', 'session_inter_terminer', 'session_inter_encours', 'session_inter_previsionnel', 'session_inter_avenir', 'session_inter_annuler'));
        }
        if (Gate::allows('isSuperAdminPrincipale')) {
            return redirect()->route('liste_utilisateur');
            // return view('layouts.accueil_admin');
        }
        if (Gate::allows('isSuperAdmin')) {
            return view('layouts.accueil_admin');
        }
        if (Gate::allows('isAdminPrincipale')) {
            return view('layouts.accueil_admin');
        }
        if (Gate::allows('isSuperAdmin')) {
            return view('layouts.accueil_admin');
        }
        // if(Gate::allows('isSuperAdminPrincipale')) {
        //     return view('layouts.accueil_admin', compact('totale_invitation'));
        // }
        // if(Gate::allows('isSuperAdminPrincipale')) {
        //     return view('layouts.accueil_admin', compact('totale_invitation'));
        // }

        if (Gate::allows('isReferentPrincipale')) {


            $testNull = DB::select('select *,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp from responsables where user_id  = ? ', [Auth::user()->id]);

            $entreprise = DB::select('select * from entreprises where id  = ? ', [$testNull[0]->entreprise_id]);
            $departement = DB::select('select * from departement_entreprises where id  = ? ', [$testNull[0]->departement_entreprises_id]);

            $databaseName = DB::connection()->getDatabaseName();

            $colonnes = DB::select(' select COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS  WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?', [$databaseName, 'responsables']);
            $nb = 0;
            for ($i = 0; $i < count($colonnes); $i++) {
                $tempo =  $colonnes[$i]->COLUMN_NAME;
                if ($colonnes[$i]->COLUMN_NAME != "branche_id" and  $colonnes[$i]->COLUMN_NAME != "service_id" and  $colonnes[$i]->COLUMN_NAME != "departement_entreprises_id" and  $colonnes[$i]->COLUMN_NAME != "poste_resp" and $colonnes[$i]->COLUMN_NAME != "photos" and $colonnes[$i]->COLUMN_NAME != "updated_at" and $colonnes[$i]->COLUMN_NAME != "created_at" and $colonnes[$i]->COLUMN_NAME != "matricule" and  $colonnes[$i]->COLUMN_NAME != "url_photo") {
                    if ($testNull[0]->$tempo == null) {
                        $nb += 1;
                    }
                }
            }
            //lorsque les informations différents que branche  id, service id , matricule sont vides alors on incite l'utilisateur à remplir les infos

            if ($nb > 0) {

                return view('formulaire', compact('testNull', 'entreprise', 'departement'));
            } else {

                // $user_id = User::where('id', Auth::user()->id)->value('id');
                // return view('layouts.dashboard_referent');
                $fonct = new FonctionGenerique();

                $user_id = User::where('id', Auth::user()->id)->value('id');
                $ref = $fonct->findWhereMulitOne("responsables", ["user_id"], [$user_id])->user_id;

                $nom_profil_referent = responsable::where('user_id', $user_id)->value('entreprise_id');
                $etp = entreprise::where('id', $nom_profil_referent)->value('nom_etp');
                $etp_id = entreprise::where('id', $nom_profil_referent)->value('id');

                //date now
                $dtNow = Carbon::today()->toDateString();
                $etp_ab = DB::select('select * from v_abonnement_facture_entreprise where entreprise_id = ? order by facture_id desc limit 1', [$etp_id]);
                if ($etp_ab != null) {
                    setlocale(LC_TIME, "fr_FR");
                    $j1 = strftime('%d', strtotime($etp_ab[0]->due_date));
                    $j2 = strftime('%d', strtotime($dtNow));
                    $jour_restant = $j1 - $j2;
                    $message = "Il vous reste " . $jour_restant . " jours pour payer votre abonnement";
                    $test = 1;
                } else {
                    $test = 0;
                    $message = "Vous êtes en mode gratuit";
                }


                // $refs = DB::select('select nif,stat,rcs from entreprises where id = ' . $nom_profil_referent . ' ');

                $refs_tmp = DB::select('select nif,stat,rcs from entreprises where id = ?', [$etp_id]);
                $refs = $refs_tmp[0];

                $formateur_referent = DB::select('select * from demmande_formateur_cfp where demmandeur_formateur_id = ' . $ref . ' ');
                // $formateurs =  DB::select('select * from demmande_formateur_cfp where demmandeur_formateur_id = ?', [$ref]);
                // $formateur_referent = $formateurs[0];

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

                $session_inter_terminer = DB::select('select * from v_groupe_projet_entreprise where item_status_groupe = "terminer" and entreprise_id = ' . $ref . ' ');
                $session_inter_encours = DB::select('select * from v_groupe_projet_entreprise where item_status_groupe = "en_cours" and entreprise_id = ' . $ref . ' ');
                $session_inter_previsionnel = DB::select('select * from v_groupe_projet_entreprise where item_status_groupe = "previsionnel" and entreprise_id = ' . $ref . ' ');
                $session_inter_avenir = DB::select('select * from v_groupe_projet_entreprise where item_status_groupe = "avenir" and entreprise_id = ' . $ref . ' ');
                $session_inter_annuler = DB::select('select * from v_groupe_projet_entreprise where item_status_groupe = "annuler" and entreprise_id = ' . $ref . ' ');

                $stagiaires = DB::select('select * from stagiaires where entreprise_id = ?', [$etp_id]);
                $nb_stagiaire = count($stagiaires);
                $responsables = DB::select('select * from responsables where entreprise_id = ?', [$etp_id]);
                $nb_responsable = count($responsables);
                $chef_departements = DB::select('select * from v_chef_departement_entreprise where entreprise_id = ?', [$etp_id]);
                $nb_cDepartement = count($chef_departements);
                $total = $nb_stagiaire + $nb_responsable + $nb_cDepartement;


                // $test_abonne = abonnement::where('user_id', $etp_id)->exists();
                // $abn =type_abonnement::all();

                $typeAbonne_id = 1;
                // $typeAbonnement = type_abonnement_role::with('type_abonnement')->where('type_abonne_id', $typeAbonne_id)->value('id');
                $name = DB::select('select nom_type from v_type_abonnement_etp where entreprise_id = ? order by abonnement_id desc limit 1', [$entreprise_id]);


                if ($id != null) {
                    $referent = $fonct->findWhereMulitOne("responsables", ["id"], [$id]);
                } else {
                    $referent = $fonct->findWhereMulitOne("responsables", ["user_id"], [Auth::user()->id]);
                }

                return view('referent.dashboard_referent.dashboard_referent', compact('test','message','etp', 'referent', 'refs', 'formateur_referent', 'cfps', 'facture_paye', 'facture_non_echu', 'session_intra_terminer', 'session_intra_previ', 'session_intra_en_cours', 'session_intra_avenir', 'nb_stagiaire', 'total','session_inter_terminer','session_inter_encours','session_inter_previsionnel','session_inter_avenir','session_inter_annuler'));
            }
        }

        if (Gate::allows('isSuperAdminPrincipale')) {
            return redirect()->route('liste_utilisateur');
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
    //Recherche cfp filtre
    public function recherche_cfp(Request $request, $page = null)
    {
        $nb_par_page = 5;
        if ($page == null) {
            $page = 1;
        }
        $type_formation_id = $request->type_formation;
        $status = DB::select('select * from status');
        $user_id = Auth::user()->id;
        $cfp_id = ResponsableCfpModel::value('cfp_id');
        $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');
        $cfp = $request->cfp_search;
        $nb_projet = DB::select('select count(projet_id) as nb_projet from v_groupe_projet_entreprise where entreprise_id = ? and cfp_id=?', [$entreprise_id, $cfp_id])[0]->nb_projet;
        $fin_page = ceil($nb_projet / $nb_par_page);
        if ($page == 1) {
            $offset = 0;
            $debut = 1;
            if ($nb_par_page > $nb_projet) {
                $fin = $nb_projet;
            } else {
                $fin = $nb_par_page;
            }
        } elseif ($page == $fin_page) {
            $offset = ($page - 1) * $nb_par_page;
            $debut = ($page - 1) * $nb_par_page;
            $fin =  $nb_projet;
        } else {
            $offset = ($page - 1) * $nb_par_page;
            $debut = ($page - 1) * $nb_par_page;
            $fin =  $page * $nb_par_page;
        }
        $stagiaires = DB::select('select * from v_stagiaire_groupe where entreprise_id = ?', [$entreprise_id]);
        $data =  DB::select("select * from v_groupe_projet_entreprise  where (nom_cfp) LIKE UPPER('%" . $cfp . "%') ");
        return view('projet_session.index2', compact('data', 'stagiaires', 'status', 'type_formation_id', 'page', 'fin_page', 'nb_projet', 'debut', 'fin', 'nb_par_page'));
    }
    // public function recherche_etp(Request $request,$page = null)
    // {
    //     $nb_par_page = 5;
    //     if($page == null){
    //         $page = 1;
    //     }
    //     $projet_model = new projet();

    //     $fonct = new FonctionGenerique();

    //     $user_id = Auth::user()->id;
    //     $totale_invitation = 0;
    //     $entp = new entreprise();
    //     $status = DB::select('select * from status');
    //     $type_formation_id = $request->type_formation;
    //     $etp= $request->entreprise;
    //     $cfp_id = $fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [$user_id])->cfp_id;

    //     // pagination
    // // $nb_projet = DB::select('select count(projet_id) as nb_projet from v_groupe_projet_entreprise where entreprise_id = ? and cfp_id=?',[$entreprise_id,$cfp_id])[0]->nb_projet;
    // $nb_projet = DB::select('select count(projet_id) as nb_projet from v_projet_session where cfp_id = ?',[$cfp_id])[0]->nb_projet;

    //     $fin_page = ceil($nb_projet/$nb_par_page);
    //     if($page == 1){
    //         $offset = 0;
    //         $debut = 1;
    //         if($nb_par_page > $nb_projet){
    //             $fin = $nb_projet;
    //         }else{
    //             $fin = $nb_par_page;
    //         }
    //     }
    //     elseif($page == $fin_page){
    //         $offset = ($page - 1) * $nb_par_page;
    //         $debut = ($page - 1) * $nb_par_page;
    //         $fin =  $nb_projet;
    //     }
    //     else{
    //         $offset = ($page - 1) * $nb_par_page;
    //         $debut = ($page - 1) * $nb_par_page;
    //         $fin =  $page * $nb_par_page;
    //     }
    //     // fin pagination
    //     $projet=DB::select('select * from v_projet_session where (nom_etp) LIKE UPPER('%" . $etp . "%') ');
    //     $projet_formation = DB::select('select * from v_projet_formation where cfp_id = ?', [$cfp_id]);
    //     $data = $fonct->findWhere("v_groupe_projet_module", ["cfp_id"], [$cfp_id]);
    //     $etp1 = $fonct->findWhere("v_demmande_etp_cfp", ["cfp_id"], [$cfp_id]);
    //     $etp2 = $fonct->findWhere("v_demmande_cfp_etp", ["cfp_id"], [$cfp_id]);

    //     $entreprise = $entp->getEntreprise($etp2, $etp1);
    //     $type_formation = DB::select('select * from type_formations');

    //     $formation = $fonct->findWhere("v_formation", ['cfp_id'], [$cfp_id]);
    //     $module = $fonct->findWhere("v_module",['cfp_id','status'],[$cfp_id,2]);
    //     $payement = $fonct->findAll("type_payement");
    //     $entreprise = DB::select('select groupe_id,entreprise_id,nom_etp from v_groupe_projet_entreprise where cfp_id = ?',[$cfp_id]);
    //     return view('projet_session.index2', compact('projet', 'data', 'entreprise', 'totale_invitation', 'formation', 'module', 'type_formation', 'status', 'type_formation_id', 'projet_formation','payement','entreprise','page','fin_page','nb_projet','debut','fin','nb_par_page'));

    // }

    public function tous_projets(Request $request, $id = null, $page = null)
    {
        $user_id = Auth::user()->id;
        $nb_par_page = 5;
        if ($page == null) {
            $page = 1;
        }
        $fonct = new FonctionGenerique();

        $projet_model = new projet();
        $totale_invitation = 0;
        $entp = new entreprise();
        $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');
        $status = DB::select('select * from status');
        $type_formation_id = $request->type_formation;
        $responsable_id = responsable::where('user_id', $user_id)->value('id');
        $cfp_id = ResponsableCfpModel::value('cfp_id');
        if (Gate::allows('isReferent')) {
            $nb_projet = DB::select('select count(projet_id) as nb_projet from v_groupe_projet_entreprise where entreprise_id = ? and cfp_id=?', [$entreprise_id, $cfp_id])[0]->nb_projet;
            $fin_page = ceil($nb_projet / $nb_par_page);
            if ($page == 1) {
                $offset = 0;
                $debut = 1;
                if ($nb_par_page > $nb_projet) {
                    $fin = $nb_projet;
                } else {
                    $fin = $nb_par_page;
                }
            } elseif ($page == $fin_page) {
                $offset = ($page - 1) * $nb_par_page;
                $debut = ($page - 1) * $nb_par_page;
                $fin =  $nb_projet;
            } else {
                $offset = ($page - 1) * $nb_par_page;
                $debut = ($page - 1) * $nb_par_page;
                $fin =  $page * $nb_par_page;
            }
            $stagiaires = DB::select('select * from v_stagiaire_groupe where entreprise_id = ?', [$entreprise_id]);
            $data = DB::select('select * from v_groupe_projet_entreprise where entreprise_id = ? and cfp_id=?', [$entreprise_id, $cfp_id]);
            return view('projet_session.index2', compact('data', 'stagiaires', 'status', 'type_formation_id', 'page', 'fin_page', 'nb_projet', 'debut', 'fin', 'nb_par_page'));
        } elseif (Gate::allows('isCFP')) {
            $cfp_id = $fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [$user_id])->cfp_id;

            // pagination
            // $nb_projet = DB::select('select count(projet_id) as nb_projet from v_groupe_projet_entreprise where entreprise_id = ? and cfp_id=?',[$entreprise_id,$cfp_id])[0]->nb_projet;
            $nb_projet = DB::select('select count(projet_id) as nb_projet from v_projet_session where cfp_id = ?', [$cfp_id])[0]->nb_projet;

            $fin_page = ceil($nb_projet / $nb_par_page);
            if ($page == 1) {
                $offset = 0;
                $debut = 1;
                if ($nb_par_page > $nb_projet) {
                    $fin = $nb_projet;
                } else {
                    $fin = $nb_par_page;
                }
            } elseif ($page == $fin_page) {
                $offset = ($page - 1) * $nb_par_page;
                $debut = ($page - 1) * $nb_par_page;
                $fin =  $nb_projet;
            } else {
                $offset = ($page - 1) * $nb_par_page;
                $debut = ($page - 1) * $nb_par_page;
                $fin =  $page * $nb_par_page;
            }
            // fin pagination
            $projet = DB::select('select * from v_projet_session where cfp_id=?', [$cfp_id]);
            $projet_formation = DB::select('select * from v_projet_formation where cfp_id = ?', [$cfp_id]);
            $data = $fonct->findWhere("v_groupe_projet_module", ["cfp_id"], [$cfp_id]);
            $etp1 = $fonct->findWhere("v_demmande_etp_cfp", ["cfp_id"], [$cfp_id]);
            $etp2 = $fonct->findWhere("v_demmande_cfp_etp", ["cfp_id"], [$cfp_id]);

            $entreprise = $entp->getEntreprise($etp2, $etp1);
            $type_formation = DB::select('select * from type_formations');

            $formation = $fonct->findWhere("v_formation", ['cfp_id'], [$cfp_id]);
            $module = $fonct->findWhere("v_module", ['cfp_id', 'status'], [$cfp_id, 2]);
            $payement = $fonct->findAll("type_payement");
            $entreprise = DB::select('select groupe_id,entreprise_id,nom_etp from v_groupe_projet_entreprise where cfp_id = ?', [$cfp_id]);
            return view('projet_session.index2', compact('projet', 'data', 'entreprise', 'totale_invitation', 'formation', 'module', 'type_formation', 'status', 'type_formation_id', 'projet_formation', 'payement', 'entreprise', 'page', 'fin_page', 'nb_projet', 'debut', 'fin', 'nb_par_page'));
        }
    }

    public function liste_projet(Request $request, $id = null, $page = null)
    {
        $projet_model = new projet();

        $fonct = new FonctionGenerique();

        $user_id = Auth::user()->id;
        $totale_invitation = 0;
        $entp = new entreprise();
        $status = DB::select('select * from status');
        $type_formation_id = $request->type_formation;
        $data = [];
        $nb_par_page = 5;
        if ($page == null) {
            $page = 1;
        }
        if (Gate::allows('isSuperAdmin') || Gate::allows('isAdmin')) {
            $projet = projet::get()->unique('nom_projet');
            $data = $fonct->findAll("v_projet_session");
            $cfp = $fonct->findAll("cfps");
            $entreprise = entreprise::all();
            return view('admin.projet.home', compact('data', 'cfp', 'projet', 'totale_invitation', 'entreprise', 'status'));
        }
        if (Gate::allows('isReferent')) {
            if (Gate::allows('isReferentPrincipale')) {
                $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');
            }
            if (Gate::allows('isStagiairePrincipale')) {
                $entreprise_id = stagiaire::where('user_id', $user_id)->value('entreprise_id');
            }
            if (Gate::allows('isManagerPrincipale')) {
                $entreprise_id = chefDepartement::where('user_id', $user_id)->value('entreprise_id');
            }
            // pagination
            $nb_projet = DB::select('select count(projet_id) as nb_projet from v_groupe_projet_entreprise where entreprise_id = ?', [$entreprise_id])[0]->nb_projet;
            $fin_page = ceil($nb_projet / $nb_par_page);
            if ($page == 1) {
                $offset = 0;
                $debut = 1;
                if ($nb_par_page > $nb_projet) {
                    $fin = $nb_projet;
                } else {
                    $fin = $nb_par_page;
                }
            } elseif ($page == $fin_page) {
                $offset = ($page - 1) * $nb_par_page;
                $debut = ($page - 1) * $nb_par_page;
                $fin =  $nb_projet;
            } else {
                $offset = ($page - 1) * $nb_par_page;
                $debut = ($page - 1) * $nb_par_page;
                $fin =  $page * $nb_par_page;
            }
            // fin pagination
            $sql = $projet_model->build_requette($entreprise_id, "v_groupe_projet_entreprise", $request, $nb_par_page, $offset);
            $data = DB::select($sql);
            $stagiaires = DB::select('select * from v_stagiaire_groupe where entreprise_id = ?', [$entreprise_id]);
            return view('projet_session.index2', compact('data', 'stagiaires', 'status', 'type_formation_id', 'page', 'fin_page', 'nb_projet', 'debut', 'fin', 'nb_par_page'));
        }
        if (Gate::allows('isManager')) {
            //on récupère l'entreprise id de la personne connecté
            $entreprise_id = chefDepartement::where('user_id', $user_id)->value('entreprise_id');
            $data = $fonct->findWhere("v_projet_entreprise", ["entreprise_id"], [$entreprise_id]);
            $cfp = $fonct->findAll("cfps");
            return view('admin.projet.home', compact('data', 'cfp', 'totale_invitation', 'status'));
        } elseif (Gate::allows('isCFP')) {
            $cfp_id = $fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [$user_id])->cfp_id;

            // pagination
            $nb_projet = DB::select('select count(projet_id) as nb_projet from v_projet_session where cfp_id = ?', [$cfp_id])[0]->nb_projet;
            $fin_page = ceil($nb_projet / $nb_par_page);
            if ($page == 1) {
                $offset = 0;
                $debut = 1;
                if ($nb_par_page > $nb_projet) {
                    $fin = $nb_projet;
                } else {
                    $fin = $nb_par_page;
                }
            } elseif ($page == $fin_page) {
                $offset = ($page - 1) * $nb_par_page;
                $debut = ($page - 1) * $nb_par_page;
                $fin =  $nb_projet;
            } else {
                $offset = ($page - 1) * $nb_par_page;
                $debut = ($page - 1) * $nb_par_page;
                $fin =  $page * $nb_par_page;
            }
            // fin pagination

            $sql = $projet_model->build_requette($cfp_id, "v_projet_session", $request, $nb_par_page, $offset);

            $projet = DB::select($sql);

            // dd( $projet);
            // $projet_formation = DB::select('select * from v_projet_formation where cfp_id = ?', [$cfp_id]);

            $data = $fonct->findWhere("v_groupe_projet_module", ["cfp_id"], [$cfp_id]);

            // $etp1 = $fonct->findWhere("v_demmande_etp_cfp", ["cfp_id"], [$cfp_id]);
            // $etp2 = $fonct->findWhere("v_demmande_cfp_etp", ["cfp_id"], [$cfp_id]);

            // $entreprise = $entp->getEntreprise($etp2, $etp1);
            // dd($entreprise);
            $type_formation = DB::select('select * from type_formations');

            $formation = $fonct->findWhere("v_formation", ['cfp_id'], [$cfp_id]);
            $module = $fonct->findWhere("v_module", ['cfp_id', 'status'], [$cfp_id, 2]);
            $payement = $fonct->findAll("type_payement");

            // $entreprise = DB::select('select groupe_id,entreprise_id,nom_etp from v_groupe_projet_entreprise where cfp_id = ?',[$cfp_id]);
            $entreprise = DB::select('select entreprise_id,groupe_id,nom_etp from v_groupe_entreprise');
            // dd($data);
            return view('projet_session.index2', compact('projet', 'data', 'totale_invitation', 'formation', 'module', 'type_formation', 'status', 'type_formation_id', 'entreprise', 'payement', 'page', 'fin_page', 'nb_projet', 'debut', 'fin', 'nb_par_page'));
        }
        if (Gate::allows('isFormateur')) {
            $formateur_id = formateur::where('user_id', $user_id)->value('id');
            // $cfp_id = DB::select("select cfp_id from v_demmande_cfp_formateur where user_id_formateur = ?", [$user_id])[0]->cfp_id;
            $cfp_id = DB::select("select cfp_id from v_demmande_cfp_formateur where user_id_formateur = ?", [$user_id])[0]->cfp_id;
            $projet = $fonct->findWhere("v_projet_session", ["cfp_id"], [$cfp_id]);

            // pagination
            $nb_projet = DB::select('select count(projet_id) as nb_projet from v_projet_formateur where cfp_id = ? and formateur_id = ?', [$cfp_id, $formateur_id])[0]->nb_projet;
            $fin_page = ceil($nb_projet / $nb_par_page);
            if ($page == 1) {
                $offset = 0;
                $debut = 1;
                if ($nb_par_page > $nb_projet) {
                    $fin = $nb_projet;
                } else {
                    $fin = $nb_par_page;
                }
            } elseif ($page == $fin_page) {
                $offset = ($page - 1) * $nb_par_page;
                $debut = (($page - 1) * $nb_par_page) + 1;
                $fin =  $nb_projet;
            } else {
                $offset = ($page - 1) * $nb_par_page;
                $debut = (($page - 1) * $nb_par_page) + 1;
                $fin =  $page * $nb_par_page;
            }
            // fin pagination
            $data = DB::select('select * from v_projet_formateur where cfp_id = ? and formateur_id = ? order by date_projet desc limit ? offset ?',[$cfp_id,$formateur_id,$nb_par_page,$offset]);
            $entreprise = DB::select('select entreprise_id,groupe_id,nom_etp from v_groupe_entreprise');
            $formation = $fonct->findWhere("v_formation", ["cfp_id"], [$cfp_id]);
            $module = $fonct->findAll("modules");
            $type_formation = DB::select('select * from type_formations');
            $projet_formation = DB::select('select * from v_projet_formation where cfp_id = ?', [$cfp_id]);
            return view('projet_session.index2', compact('projet', 'data', 'entreprise', 'totale_invitation', 'formation', 'module', 'status', 'type_formation_id', 'projet_formation', 'page', 'fin_page', 'nb_projet', 'debut', 'fin', 'nb_par_page'));
        }
        if (Gate::allows('isStagiaire')) {
            $evaluation = new EvaluationChaud();
            $etp_id = stagiaire::where('user_id', $user_id)->value('entreprise_id');
            $matricule = stagiaire::where('user_id', $user_id)->value('matricule');
            $stg_id = stagiaire::where('user_id', $user_id)->value('id');
            // $data = $fonct->findWhere('v_stagiaire_groupe',['stagiaire_id'],[$stg_id]);

            // pagination
            $nb_projet = DB::select('select count(projet_id) as nb_projet from v_stagiaire_groupe where stagiaire_id = ?', [$stg_id])[0]->nb_projet;
            $fin_page = ceil($nb_projet / $nb_par_page);
            if ($page == 1) {
                $offset = 0;
                $debut = 1;
                if ($nb_par_page > $nb_projet) {
                    $fin = $nb_projet;
                } else {
                    $fin = $nb_par_page;
                }
            } elseif ($page == $fin_page) {
                $offset = ($page - 1) * $nb_par_page;
                $debut = (($page - 1) * $nb_par_page) + 1;
                $fin =  $nb_projet;
            } else {
                $offset = ($page - 1) * $nb_par_page;
                $debut = (($page - 1) * $nb_par_page) + 1;
                $fin =  $page * $nb_par_page;
            }
            // fin pagination
            // dd($fin_page,$page,$stg_id);
            $data = DB::select('select *,case when groupe_id not in(select groupe_id from reponse_evaluationchaud) then 0 else 1 end statut_eval from v_stagiaire_groupe where stagiaire_id = ? order by date_debut desc limit ? offset ?', [$stg_id, $nb_par_page, $offset]);

            return view('projet_session.index2', compact('data', 'status', 'type_formation_id', 'page', 'fin_page', 'nb_projet', 'debut', 'fin', 'nb_par_page'));
        }
    }

    public function statut_presence_emargement(Request $req){
        $groupe_id = $req->groupe;
        $groupe = new Groupe();
        $statut_presence = $groupe->statut_presences($groupe_id);
        $statut_evaluation = $groupe->statut_evaluation($groupe_id);
        return response()->json(['presence'=>$statut_presence,'evaluation'=>$statut_evaluation]);
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

    //budget previsionnnel
    public function budget_previsionnel()
    {
        $current_year = Carbon::now()->format('Y');
        $entreprise_id = DB::select('select * from responsables where user_id = ?', [Auth::user()->id]);
        //get total budget de l'année courant de l'entreprise
        $total_budget = DB::select('select ifnull(sum(budget_total),0) as total from v_budgetisation where entreprise_id = ? and annee =  ?', [$entreprise_id[0]->entreprise_id, $current_year]);
        //get total budget réalisé de l'entreprise
        $total_realise = DB::select('select ifnull(sum(montant_total),0) as realise from v_facture_actif where entreprise_id = ? and facture_encour =  ? and year(due_date) = ?', [$entreprise_id[0]->entreprise_id, "terminer", $current_year]);
        //get total budget engagé de l'entreprise
        $total_engage = DB::select('select ifnull(sum(montant_total),0) as engage from v_facture_actif where entreprise_id = ? and facture_encour =  ? and year(due_date) = ?', [$entreprise_id[0]->entreprise_id, "en_cour", $current_year]);
        //get total budget restant
        $total_restant = $total_budget[0]->total - ($total_realise[0]->realise + $total_engage[0]->engage);
        return view('referent.dashboard_referent.dashboard_referent_budget_prev',compact('total_budget','total_realise','total_engage','total_restant'));
    }

    //creation iframe
    public function creer_iframe($nbPagination_etp = null, $nbPagination_cfp = null, $pour_list = null)
    {
        $nb_limit = 10;
        if ($nbPagination_cfp == null || $nbPagination_cfp <= 0) {
            $nbPagination_cfp = 1;
        }
        if ($nbPagination_etp == null || $nbPagination_etp <= 0) {
            $nbPagination_etp = 1;
        }

        $iframe_etp = $this->fonct->findWhereTrieOrderBy(
            "v_entreprise_iframe",
            [],
            [],
            [],
            ["nom_etp"],
            "ASC",
            $nbPagination_etp,
            $nb_limit
        );

        $iframe_of = $this->fonct->findWhereTrieOrderBy(
            "v_cfp_iframe",
            [],
            [],
            [],
            ["nom"],
            "ASC",
            $nbPagination_cfp,
            $nb_limit
        );

        $totaleData_etp = $this->fonct->getNbrePagination("v_entreprise_iframe", "nom_etp", [], [], [], "");
        $pagination_etp = $this->fonct->nb_liste_pagination($totaleData_etp, $nbPagination_etp, $nb_limit);

        $totaleData_cfp = $this->fonct->getNbrePagination("v_cfp_iframe", "nom", [], [], [], "");
        $pagination_cfp = $this->fonct->nb_liste_pagination($totaleData_cfp, $nbPagination_cfp, $nb_limit);

        // $iframe_etp = $this->fonct->findAll("v_entreprise_iframe");
        // $iframe_of = $this->fonct->findAll("v_cfp_iframe");
        return view('bi.iframe', compact('iframe_etp', 'iframe_of', 'pagination_cfp', 'pagination_etp', 'pour_list'));
    }


    public function creer_iframe_filtre(Request $req, $nbPagination_etp = null, $nbPagination_cfp = null, $pour_list = null, $nom_entiter_cfp_pag = null, $nom_entiter_etp_pag = null)
    {
        $nb_limit = 10;
        if ($nbPagination_cfp == null || $nbPagination_cfp <= 0) {
            $nbPagination_cfp = 1;
        }
        if ($nbPagination_etp == null || $nbPagination_etp <= 0) {
            $nbPagination_etp = 1;
        }
        $nom_entiter_of = "";
        $nom_entiter_etp = "";

        if (isset($req->name_of)) {
            $nom_entiter_of = $req->name_of;
        } else {
            $nom_entiter_of = $nom_entiter_cfp_pag;
        }
        if (isset($req->name_etp)) {
            $nom_entiter_etp = $req->name_etp;
        } else {
            $nom_entiter_etp = $nom_entiter_etp_pag;
        }

        if($nom_entiter_etp==null){
            $nom_entiter_etp="";
        } else{
            $pour_list = "ETP";
        }
        if($nom_entiter_of==null){
            $nom_entiter_of="";
        } else {
            $pour_list = "OF";
        }
        $iframe_etp = $this->fonct->findWhereTrieOrderBy(
            "v_entreprise_iframe",
            ["nom_etp"],
            ["LIKE"],
            ["%" . $nom_entiter_etp . "%"],
            ["nom_etp"],
            "ASC",
            $nbPagination_etp,
            $nb_limit
        );
        $iframe_of = $this->fonct->findWhereTrieOrderBy(
            "v_cfp_iframe",
            ["nom"],
            ["LIKE"],
            ["%" . $nom_entiter_of . "%"],
            ["nom"],
            "ASC",
            $nbPagination_cfp,
            $nb_limit
        );

        $totaleData_etp = $this->fonct->getNbrePagination("v_entreprise_iframe", "nom_etp", ["nom_etp"], ["LIKE"], ["%" . $nom_entiter_etp . "%"], "AND");
        $pagination_etp = $this->fonct->nb_liste_pagination($totaleData_etp, $nbPagination_etp, $nb_limit);

        $totaleData_cfp = $this->fonct->getNbrePagination("v_cfp_iframe", "nom", ["nom"], ["LIKE"], ["%" . $nom_entiter_of . "%"], "AND");
        $pagination_cfp = $this->fonct->nb_liste_pagination($totaleData_cfp, $nbPagination_cfp, $nb_limit);

        return view('bi.iframe', compact('iframe_etp', 'iframe_of', 'pagination_cfp', 'pagination_etp', 'pour_list','nom_entiter_of','nom_entiter_etp'));
    }

    // autocomplete IFrame

    public function auto_complete_iframe_of(Request $req)
    {
        $data = DB::select("SELECT nom FROM v_cfp_iframe WHERE nom LIKE '%" . $req->get('query') . "%'");
        return response()->json($data);
    }

    public function auto_complete_iframe_etp(Request $req)
    {
        $data = DB::select("SELECT nom FROM v_entreprise_iframe WHERE nom_etp LIKE '%" . $req->get('query') . "%'");
        return response()->json($data);
    }


    //taxe
    public function taxe(){
        // $tva=DB::select('select * from valeur_TVA ORDER BY id DESC LIMIT 1');
        // $id=tva::value('id');
        $tva=DB::select('select * from taxes where id =?',[1]);
        // $tva=DB::select('select * from valeur_TVA  ');
        // $taux=tva::findOrFail($request->id);
    //     dd($taux);
    //    dd($taux);
        return view('layouts.taxe',compact('tva'));
    }
    public function update_tva(Request $request)
    {
        // $tva=tva::where('id',$request->id)->update(['tva'=>$request->tva]);
    DB::update('update taxes set pourcent=? where id=?',[$request->tva,$request->id]);
    return back();
    }
    // public function delete_tva($id)
    // {
    //     DB::delete('delete from valeur_TVA where id = ?', [$id]);
    //     return back();

    //enregistrer taxe
    // public function taxe_enregistrer(Request $request)
    // {
    //     $inserer = DB::update('update taxes set pourcent=? where id=?', [$request->tva,1]);
    //     return back();
    // }

    //devise
    public function getDevise()
    {
        $data = $this->fonct->findAll("devises");

        return response()->json($data);
    }

    public function devise(){

        // $liste=DB::select('select * from devises ');
        // $devises=DB::select('select * from v_devise order by created_at Desc ');
        // $taux=DB::select('select * from taux_devises ');
        //       $dev = new Devise();
        // $devis_actuel =  $dev->getListDevise();
        // $devise=DB::select('select * from devise ORDER BY id DESC LIMIT 1');
        $devise=DB::select('select * from devise');

        // $devise=DB::select('select * from devise  ');
        return view('layouts.devis',compact('devise'));
    }
    public function update_devise(Request $request)
    {
        DB::update('update devise set devise=? where id=?',[$request->devise,$request->id]);
        return back();
    }
    public function delete_devise($id)
    {
        DB::delete('delete devise from devise where id=?',[$id]);
        return back();
    }
    // public function edit($id)
    // {

    //    $devise_edit=Devise::findOrfail($id);
    //    return view('layouts.edit_devise',compact('devise_edit'));
    // }
    // public function update_devise(Request $request,$id)
    // {
    //     // Devise::where('id',$id)->update([
    //     // 'description'=>$request->description,
    //     // 'reference'=>$request->reference
    //     // ]);
    //     DB::update('update devises set description = ?, reference= ?  where id= ?', [$request->description,$request->reference,$id]);
    //     return redirect()->route('devise');
    // }
    // //delete devise
    // public function delete_devise(Request $request,$id)
    // {
    //     // DB::table('devises ')->where('id', $id)->delete();
    //     $id = $request->id;

    //     DB::delete('delete from devises where id = ?', [$id]);

    //     return redirect()->route('devise');
    // }
    // //edit taux_devise
    // public function edit_taux_devise($id)
    // {
    //     $taux_edit=taux_devises::findOrfail($id);
    //     return view('layouts.edit_taux_devise',compact('taux_edit'));
    // }
    // public function update_taux(Request $request,$id)
    // {

    //     DB::update('update taux_devises set valeur_ariary= ?, created_at= ?  where id= ?', [$request->ar,$request->data_tx,$id]);
    //     return redirect()->route('devise');
    // }
    // public function delete_taux(Request $request,$id)
    // {
    //     $id = $request->id;

    //     DB::delete('delete from taux_devises  where id = ?', [$id]);

    //     return redirect()->route('devise');
    // }
    //enregistrer devise
    public function devise_enregistrer(Request $request)
    {
        // if ($request["devise"]) {
        //     for ($i = 0; $i < count($request["devise"]); $i += 1) {
        //         $devis= $request["devise"][$i];
        //         $ref= $request["reference"][$i];
        // $inserer = DB::insert('insert into devises (description,reference) value (?,?)', [$devis,$ref]);

        //     }
        // }
        $inserer = DB::update('update  devise set devise=? where  id=?', [$request->devis,8]);

        return back();
    }
    // //taxe devise
    // public function taux_enregistrer(Request $request)
    // {
    //     $date_taux=$request->date_taux;

    //     if ($request["devise_id"]) {
    //         for ($i = 0; $i < count($request["devise_id"]); $i += 1) {
    //             $devis_id= $request["devise_id"][$i];
    //             $val= $request["valeur"][$i];
    //             $ariary= $request["ar"][$i];
    //     $inserer = DB::insert('insert into taux_devises (devise_id,valeur_default,valeur_ariary,created_at,updated_at) value (?,?,?,?,?)', [$devis_id,$val,$ariary,$date_taux,$date_taux]);

    //         }
    //     }



    //     return back();
    // }

    public function enregistrer_iframe_etp(Request $request){
        $url_iframe = $request->iframe_url;
        $etp_id = $request->entreprise_id;
        $fonct = new FonctionGenerique();
        $entreprise = $fonct->insert_iframe('iframe_entreprise', 'entreprise_id', $etp_id, $url_iframe);
        return back();
    }
    public function enregistrer_iframe_cfp(Request $request)
    {
        $url_iframe = $request->iframe_url;
        $cfp_id = $request->cfp_id;
        $fonct = new FonctionGenerique();
        $entreprise = $fonct->insert_iframe('iframe_cfp', 'cfp_id', $cfp_id, $url_iframe);
        return back();
    }
    //liste par entreprise
    public function iframe_etp()
    {
        $fonct = new FonctionGenerique();
        $id_etp = DB::select('select * from responsables where user_id = ?', [Auth::user()->id]);
        $iframe_etp = $fonct->findWhereMulitOne("v_entreprise_iframe", ["entreprise_id"], [$id_etp[0]->entreprise_id]);

        return view('layouts.bi', compact('iframe_etp'));
    }
    //liste par of
    public function iframe_cfp()
    {
        $fonct = new FonctionGenerique();
        $id_cfp = DB::select('select * from responsables_cfp where user_id = ?', [Auth::user()->id]);
        $iframe_cfp = $fonct->findWhereMulitOne("v_cfp_iframe", ["cfp_id"], [$id_cfp[0]->cfp_id]);
        return view('layouts.bi', compact('iframe_cfp'));
    }
    public function BI()
    {
        return view('layouts.bi');
    }
    //----------Entreprise---------------//
    //modification
    public function modifier_iframe_etp(Request $request)
    {
        $iframe = $request->n_iframe;
        $entreprise = $request->id_etp;
        $modification = new FonctionGenerique();
        $modification->update_iframe('iframe_entreprise', 'iframe', 'entreprise_id', $entreprise, $iframe);
        return back();
    }
    //suppression
    public function supprimer_iframe_etp(Request $request)
    {
        $id_etp = $request->id_etp;
        $suppression = new FonctionGenerique();
        $suppression->supprimer_iframe('iframe_entreprise', 'entreprise_id', $id_etp);
        return back();
    }

    //----------Organisme de formation---------------//
    //modification
    public function modifier_iframe_cfp(Request $request)
    {
        $iframe = $request->n_iframe_cfp;
        $cfp = $request->id_cfp;
        $modification = new FonctionGenerique();
        $modification->update_iframe('iframe_cfp', 'iframe', 'cfp_id', $cfp, $iframe);
        return back();
    }
    //suppression
    public function supprimer_iframe_cfp(Request $request)
    {
        $id_cfp = $request->id_cfp;
        $suppression = new FonctionGenerique();
        $suppression->supprimer_iframe('iframe_cfp', 'cfp_id', $id_cfp);
        return back();
    }
}
