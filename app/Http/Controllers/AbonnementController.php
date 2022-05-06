<?php

namespace App\Http\Controllers;

use App\abonnement;
use App\abonnement_cfp;
use App\categorie_paiement;
use App\offre_gratuit;
use App\responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use App\Models\AbonnementModel;
use App\type_abonnement;
use App\tarif_categorie;
use App\type_abonne;
use App\type_abonnement_role;
use App\User;
use App\cfp;
use App\entreprise;
use PDF;
use App\Models\FonctionGenerique;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Facture;
use function PHPSTORM_META\type;

class AbonnementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
        $this->fact = new Facture();
        $this->abonnement_model = new AbonnementModel();
    }
    public function index()
    {
        // $role = Role::where('role_name','<>','admin')->where('role_name','<>','SuperAdmin')->where('role_name','<>','formateur')->orderBy('role_name')->get();
        $type_abonne = type_abonne::all();
        $categorie = categorie_paiement::all();

        return view('superadmin.abonnement', compact('type_abonne', 'categorie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //enregistrement du type d'abonnement
        $typeAbonnement = new type_abonnement();
        $typeAbonnement->nom_type = $request->type_abonnement;

        $nom_image = str_replace(' ', '_', $request->type_abonnement . '.' . $request->logo_abonnement->extension());
        $str = 'images/abonnement';
        $request->logo_abonnement->move(public_path($str), $nom_image);

        $typeAbonnement->Logo = $nom_image;
        $typeAbonnement->save();

        $id_abonnement = type_abonnement::where('nom_type', $request->type_abonnement)->value('id');

        $type_abonne_id = $request->type_abonne;

        //enregistrement type abonnement par type d'abonnés
        $typeAbonneRole = new type_abonnement_role();
        $typeAbonneRole->type_abonne_id = $type_abonne_id;
        $typeAbonneRole->type_abonnement_id = $id_abonnement;
        $typeAbonneRole->save();

        $idTypeAbonneRole = type_abonnement_role::where(['type_abonne_id' => $type_abonne_id], ['type_abonnement_id' => $id_abonnement])->value('id');

        $this->abonnement_model->insert_tarif_categories($idTypeAbonneRole,1,$request->tarif_ab);
        $this->abonnement_model->insert_tarif_categories($idTypeAbonneRole,2,$request->tarif_annuel);

        return redirect()->back()->with('message', 'Configuration d\'abonnement enregistré avec succès');
    }
    //liste des type d'abonnements
    public function liste_abonnement()
    {
        $tarifCategorie = tarif_categorie::with('type_abonnement', 'categorie_paiement')->get();

        return view('superadmin.listeAbonnement', compact('tarifCategorie', 'limite'));
    }

    //enregistrer tarif par cattegorie
    public function tarif_categorie(Request $request)
    {
        $request->validate(
            [
                'tarif_ab' => ["required"]
            ],
            [
                'tarif_ab.required' => 'Entrez le tarif'
            ]
        );
        $tarif = new tarif_categorie();
        $tarif->type_abonnement_id = $request->abonnement_id;
        $tarif->categorie_paiement_id = $request->categorie_id;
        $tarif->tarif = $request->tarif_ab;
        $tarif->save();
        return redirect()->route('listeTarifCategorie');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->Id;
        $role = type_abonne::where('id', '<>', $id)->get();

        return response()->json($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //affichage des types d'abonnements
    public function ListeAbonnement()
    {

        if (Gate::allows('isReferent')) {
            $fonct = new FonctionGenerique();
            $offregratuit = offre_gratuit::with('type_abonne')->where('type_abonne_id', 1)->get();
            $responsable = $fonct->findWhere('responsables',['user_id'],[Auth::user()->id]);
            $abn =type_abonnement::all();
            $typeAbonne_id = 1;

            $test_abonne = $fonct->findWhere('abonnements',['entreprise_id','status'],[$responsable[0]->entreprise_id,'En attente']);


            /** on récupère l'abonnement actuel */
            $abonnement_actuel = DB::select('select * from v_abonnement_facture_entreprise where entreprise_id = ? order by facture_id desc limit 1', [$responsable[0]->entreprise_id]);

            // $typeAbonnement = type_abonnement_role::with('type_abonnement')->where('type_abonne_id', $typeAbonne_id)->get();
            $typeAbonnement = $fonct->findWhere('v_abonnement_role',['abonne_id'],[$typeAbonne_id]);

            $tarif = tarif_categorie::with('type_abonnement_role')->where('categorie_paiement_id', '1')->orderBy('tarif','asc')->get();

            $tarifAnnuel = tarif_categorie::with('type_abonnement_role')->where('categorie_paiement_id', '2')->get();

            //liste facturation
            // $facture = $fonct->findWhere('v_abonnement_facture_entreprise',['entreprise_id'],[$responsable[0]->entreprise_id]);
            $facture = DB::select('select * from v_abonnement_facture_entreprise where entreprise_id = ? order by date_demande desc ',[$responsable[0]->entreprise_id]);
            // facture du mois suivant
            $facture_suivant = [];
            for ($i=0; $i < count($facture); $i++) {
               array_push($facture_suivant,  date('Y-m-d', strtotime($facture[$i]->invoice_date. ' + 31 days')));
            }
            //generation nouvelle facture chaque mois si l'utilisateur a choisi l'offre mensuel
            $max_id_facture = $this->abonnement_model->findMax('v_abonnement_facture_entreprise','facture_id');

            $dernier_facture = $fonct->findWhere('v_abonnement_facture_entreprise',['entreprise_id','facture_id'],[$responsable[0]->entreprise_id,$max_id_facture[0]->id_max]);



            $annee ='';
            $mois = '';

            if($dernier_facture!=null){

                $test_activite = DB::select('select * from abonnements where  id = ?', [$dernier_facture[0]->abonnement_id]);
                if( $test_activite[0]->activite == 1){

                    if($dernier_facture[0]->categorie_paiement_id == 1){
                        $mois_dernier = $dernier_facture[0]->invoice_date;
                        $dt = Carbon::today()->toDateString();
                        $mois_suivant =  date('Y-m-d', strtotime($mois_dernier. ' + 31 days'));
                        $due_suivant =  date('Y-m-d', strtotime($mois_suivant. ' + 15 days'));

                        //si on est au mois suivant par rapport à la dernière facture, on regénère une nouvelle factur
                        if($dt == $mois_suivant ){
                            $this->abonnement_model->insert_factures_abonnements_etp($facture[0]->abonnement_id,$mois_suivant,$due_suivant,$facture[0]->montant_facture);
                        }
                        setlocale(LC_TIME,"fr_FR");
                        $mois = strftime('%B',strtotime($dernier_facture[0]->invoice_date));

                    }
                    else{
                        $annee_dernier = $dernier_facture[0]->invoice_date;
                        $dt = Carbon::today()->toDateString();
                        $annee_suivant =  date('Y-m-d', strtotime($annee_dernier. ' + 365 days'));
                        $due_suivant =  date('Y-m-d', strtotime($annee_suivant. ' + 15 days'));
                         //si on est au mois suivant par rapport à la dernière facture, on regénère une nouvelle facture

                        if($dt == $annee_suivant ){
                            $this->abonnement_model->insert_factures_abonnements_etp($facture[0]->abonnement_id,$annee_suivant,$due_suivant,$facture[0]->montant_facture);
                        }
                        setlocale(LC_TIME,"fr_FR");
                        $annee = strftime('%Y',strtotime($dernier_facture[0]->invoice_date));
                    }
                }
            }

            else{
                $mois_dernier = $due_suivant = $mois = '';
            }

            $tva = array();
            $net_ttc = array();

            if($facture!=null){

                $test_assujetti = $fonct->findWhere('entreprises',['id'],[$responsable[0]->entreprise_id]);

                    //on vérifie d'abord si l'organisme est assujetti ou non pourqu'on puisse ajouter le TVA
                if($test_assujetti[0]->assujetti_id == 1) {
                    for ($i=0; $i < count($facture); $i++) {
                        array_push ($tva,($facture[$i]->montant_facture * 20) / 100);
                        array_push($net_ttc,$facture[$i]->montant_facture + $tva[$i]);
                    }
                }

                if($test_assujetti[0]->assujetti_id == 2) {
                    for ($i=0; $i < count($facture); $i++) {
                        $tva = 0;
                        array_push($net_ttc, $facture[$i]->montant_facture);
                    }
                }
            }
            else{
                $test_assujetti = $tva = $net_ttc ='';
            }



            if ($test_abonne) {
                $payant = abonnement::with('type_abonnement_role')->where('entreprise_id', $responsable[0]->entreprise_id)->get();
                return view('superadmin.listeAbonnement', compact('facture_suivant','abonnement_actuel','annee','mois','net_ttc','tva','facture','abn', 'payant', 'typeAbonne_id', 'tarifAnnuel', 'offregratuit', 'typeAbonnement', 'tarif'));
            }
            if ($test_abonne == false) {
                $gratuit = "Gratuite";
                return view('superadmin.listeAbonnement', compact('facture_suivant','abonnement_actuel','annee','mois','net_ttc','tva','facture','abn', 'gratuit', 'typeAbonne_id', 'tarifAnnuel', 'offregratuit', 'typeAbonnement', 'tarif'));
            }
        }
        else {
            $offregratuit = offre_gratuit::with('type_abonne')->get();
        }

        if (Gate::allows('isCFP')) {
            $fonct = new FonctionGenerique();

            $resp = $fonct->findWhere('responsables_cfp',['user_id'],[Auth::user()->id]);
            $cfp_id = $resp[0]->cfp_id;
            $test_abonne = abonnement_cfp::where('cfp_id', $cfp_id)->where('status','!=','En attente')->exists();

            $abn =type_abonnement::all();
            $offregratuit = offre_gratuit::with('type_abonne')->where('type_abonne_id', 1)->get();
            $typeAbonne_id = 2;

            /** on récupère l'abonnement actuel */
            $abonnement_actuel = DB::select('select * from v_abonnement_facture where cfp_id = ? order by facture_id desc limit 1', [$cfp_id]);

            $typeAbonnement = $fonct->findWhere('v_abonnement_role',['abonne_id'],[$typeAbonne_id]);

            $tarif = tarif_categorie::with('type_abonnement_role')->where('categorie_paiement_id', '1')->get();
            $tarifAnnuel = tarif_categorie::with('type_abonnement_role')->where('categorie_paiement_id', '2')->get();

               //liste facturation
            // $facture = $fonct->findWhere('v_abonnement_facture',['cfp_id'],[$cfp_id]);
            $facture = DB::select('select * from v_abonnement_facture where cfp_id = ? order by date_demande desc',[$cfp_id] );
            // facture du mois suivant
             $facture_suivant = [];
             for ($i=0; $i < count($facture); $i++) {
                array_push($facture_suivant,  date('Y-m-d', strtotime($facture[$i]->invoice_date. ' + 31 days')));
             }
            //generation nouvelle facture chaque mois si l'utilisateur a choisi l'offre mensuel
            $max_id_facture = $this->abonnement_model->findMax('v_abonnement_facture','facture_id');

            $dernier_facture = $fonct->findWhere('v_abonnement_facture',['cfp_id','facture_id'],[$cfp_id,$max_id_facture[0]->id_max]);



            $annee ='';
            $mois = '';

            if($dernier_facture!=null){
                $test_activite = DB::select('select * from abonnement_cfps where  id = ?', [$dernier_facture[0]->abonnement_id]);
                if( $test_activite[0]->activite == 1){
                    if($dernier_facture[0]->categorie_paiement_id == 1){
                        $mois_dernier = $dernier_facture[0]->invoice_date;
                        $dt = Carbon::today()->toDateString();
                        $mois_suivant =  date('Y-m-d', strtotime($mois_dernier. ' + 31 days'));
                        $due_suivant =  date('Y-m-d', strtotime($mois_suivant. ' + 15 days'));

                        //si on est au mois suivant par rapport à la dernière facture, on regénère une nouvelle factur
                        if($dt == $mois_suivant ){
                            $this->abonnement_model->insert_factures_abonnements_cfp($facture[0]->abonnement_cfps_id,$mois_suivant,$due_suivant,$facture[0]->montant_facture);
                        }
                        setlocale(LC_TIME,"fr_FR");
                        $mois = strftime('%B',strtotime($dernier_facture[0]->invoice_date));

                    }
                    else{
                        $annee_dernier = $dernier_facture[0]->invoice_date;
                        $dt = Carbon::today()->toDateString();
                        $annee_suivant =  date('Y-m-d', strtotime($annee_dernier. ' + 365 days'));
                        $due_suivant =  date('Y-m-d', strtotime($annee_suivant. ' + 15 days'));
                         //si on est au mois suivant par rapport à la dernière facture, on regénère une nouvelle facture

                        if($dt == $annee_suivant ){
                            $this->abonnement_model->insert_factures_abonnements_cfp($facture[0]->abonnement_cfps_id,$annee_suivant,$due_suivant,$facture[0]->montant_facture);
                        }
                        setlocale(LC_TIME,"fr_FR");
                        $annee = strftime('%Y',strtotime($dernier_facture[0]->invoice_date));
                    }
                }
            }

            else{
                $mois_dernier = $due_suivant = $mois = '';
            }
            $tva = array();
            $net_ttc = array();


            if($facture!=null){
                $test_assujetti = $fonct->findWhere('cfps',['id'],[$cfp_id]);
                    //on vérifie d'abord si l'organisme est assujetti ou non pourqu'on puisse ajouter le TVA
                if($test_assujetti[0]->assujetti_id == 1) {
                    for ($i=0; $i < count($facture); $i++) {
                        array_push ($tva,($facture[$i]->montant_facture * 20) / 100);
                        array_push($net_ttc,$facture[$i]->montant_facture + $tva[$i]);
                    }
                }
                if($test_assujetti[0]->assujetti_id == 2) {
                    for ($i=0; $i < count($facture); $i++) {
                        $tva = 0;
                        array_push($net_ttc, $facture[$i]->montant_facture);
                    }
                }
            }
            else{
                $test_assujetti = $tva = $net_ttc ='';
            }


            if ($test_abonne) {
                $payant = abonnement_cfp::with('type_abonnement_role')->where('cfp_id', $cfp_id)->get();
                return view('superadmin.listeAbonnement', compact('facture_suivant','abonnement_actuel','annee','mois','net_ttc','tva','facture','abn', 'payant', 'typeAbonne_id', 'tarifAnnuel', 'offregratuit', 'typeAbonnement', 'tarif'));
            }
            if ($test_abonne == false) {
                $gratuit = "Gratuite";
                return view('superadmin.listeAbonnement', compact('facture_suivant','abonnement_actuel','annee','mois','net_ttc','tva','facture','abn', 'gratuit', 'typeAbonne_id', 'tarifAnnuel', 'offregratuit', 'typeAbonnement', 'tarif'));
            }
        }
        else {
            $offregratuit = offre_gratuit::with('type_abonne')->get();
        }
    }

    //abonnement
    public function Abonnement()
    {
        $fonct = new FonctionGenerique();
        $tarif_id = request()->id;
        $tarif = tarif_categorie::where('id', $tarif_id)->get();
        $categorie_paiement_id = tarif_categorie::where('id', $tarif_id)->value('categorie_paiement_id');
        $type_abonnement_role_id = tarif_categorie::where('id', $tarif_id)->value('type_abonnement_role_id');
        // $typeAbonnement = type_abonnement_role::with('type_abonnement')->where('id', $type_abonnement_role_id)->get();
        $typeAbonnement = $fonct->findWhere('v_abonnement_role',['types_id'],[$type_abonnement_role_id]);

        $user_id = Auth::user()->id;
        $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');
        $nb = abonnement::where('entreprise_id', $entreprise_id)->count();

        if (Gate::allows('isReferent')) {
            $resp = $fonct->findWhere('responsables',['user_id'],[Auth::user()->id]);
            $entreprise_id = $resp[0]->entreprise_id;
            $entreprise = $fonct->findWhere('v_responsable_entreprise',['entreprise_id','prioriter'],[$entreprise_id,1]);
            $cfps = null;

              //on verifie l'abonnemennt de l'entreprise
            $etp_ab = DB::select('select * from v_abonnement_facture_entreprise where entreprise_id = ? order by facture_id desc limit 1', [$entreprise_id]);

            if($etp_ab!=null){

                //on teste d'abord si le dernier abonnement est gratuit,
                if($etp_ab[0]->nom_type == "Gratuit") {
                   // si l'utilisateur choisi encore l'offre gratuit, il n'a plus droit d'accéder une deuxieme fois à cette offre
                    if($typeAbonnement[0]->nom_type == "Gratuit"){
                        return back()->with('erreur_abonnement','Vous ne pouvez plus choisir une deuxième fois cette offre');
                    }
                    // si l'utilisateur choisi une autre offre
                    else{
                        $type_abonnement = $etp_ab[0]->nom_type;
                        return view('superadmin.index_abonnement', compact('type_abonnement','etp_ab','categorie_paiement_id', 'entreprise', 'cfps', 'nb', 'tarif', 'typeAbonnement', 'type_abonnement_role_id'));
                    }

                }
                //si le dernnier abonnement n'est pas gratuit
                if($etp_ab[0]->nom_type != "Gratuit"){
                    $dtNow = Carbon::today()->toDateString();
                    $un_mois_plus_tard = strtotime(date("Y-m-d", strtotime($etp_ab[0]->invoice_date)) . " + 31 days");
                    //on verifie le type d'arret du dernier abonnement
                    if($etp_ab[0]->type_arret == ""){
                        return back()->with('erreur','Vous devriez arrêter votre abonnement actuel avant de s\'abonner à une autre offre');
                    }
                    if($etp_ab[0]->type_arret == 'fin abonnement'){
                         /**si on est encore à moins de 31jours du dernier abonnement, l'utilisateur ne peut pas changer d'abonnement */
                        if($dtNow < $un_mois_plus_tard){
                            return back()->with('erreur','Vous devriez attendre un mois avant de s\'abonner à une autre offre');
                        }
                        else{
                            if($etp_ab == null) $type_abonnement = "Gratuit";
                            else $type_abonnement = $etp_ab[0]->nom_type;
                            return view('superadmin.index_abonnement', compact('type_abonnement','etp_ab','categorie_paiement_id', 'entreprise', 'cfps', 'nb', 'tarif', 'typeAbonnement', 'type_abonnement_role_id'));
                        }
                    }
                    else{
                        if($etp_ab == null) $type_abonnement = "Gratuit";
                        else $type_abonnement = $etp_ab[0]->nom_type;
                        return view('superadmin.index_abonnement', compact('type_abonnement','etp_ab','categorie_paiement_id', 'entreprise', 'cfps', 'nb', 'tarif', 'typeAbonnement', 'type_abonnement_role_id'));
                    }

                }

            }
            else{
                $type_abonnement = "Gratuit";
                $cfps = null;
                return view('superadmin.index_abonnement', compact('entreprise','type_abonnement','categorie_paiement_id', 'cfps', 'nb', 'tarif', 'typeAbonnement', 'type_abonnement_role_id'));
            }
        }

        if(Gate::allows(('isCFP'))) {
            $resp = $fonct->findWhere('responsables_cfp',['user_id'],[Auth::user()->id]);
            $cfp_id = $resp[0]->cfp_id;
            $cfps = cfp::where('id', $cfp_id)->get();
              //on verifie l'abonnemennt de l'of
            $cfp_ab = DB::select('select * from v_abonnement_facture where cfp_id = ? order by facture_id desc limit 1', [$cfp_id]);
            $entreprise = null;
            if($cfp_ab!=null){
                //on teste d'abord si le dernier abonnement est gratuit,
                if($cfp_ab[0]->nom_type == "Gratuit") {
                    // si l'utilisateur choisi encore l'offre gratuit, il n'a plus droit d'accéder une deuxieme fois à cette offre
                    if($typeAbonnement[0]->nom_type == "Gratuit"){
                        return back()->with('erreur_abonnement','Vous ne pouvez plus choisir une deuxième fois cette offre');
                    }
                    // si l'utilisateur choisi une autre offre
                    else{
                        $type_abonnement = $cfp_ab[0]->nom_type;
                        return view('superadmin.index_abonnement', compact('type_abonnement','cfp_ab','categorie_paiement_id', 'entreprise', 'cfps', 'nb', 'tarif', 'typeAbonnement', 'type_abonnement_role_id'));
                    }

                }
                //si le dernnier abonnement n'est pas gratuit
                if($cfp_ab[0]->nom_type != "Gratuit"){

                    $dtNow = Carbon::today()->toDateString();
                    $un_mois_plus_tard = strtotime(date("Y-m-d", strtotime($cfp_ab[0]->invoice_date)) . " + 31 days");
                    /**si on est encore à moins de 31jours du dernier abonnement, l'utilisateur ne peut pas changer d'abonnement */
                    if($cfp_ab[0]->type_arret == ""){
                        return back()->with('erreur','Vous devriez arrêter votre abonnement actuel avant de s\'abonner à une autre offre');
                    }
                    if($cfp_ab[0]->type_arret == 'fin abonnement'){
                           /**si on est encore à moins de 31jours du dernier abonnement, l'utilisateur ne peut pas changer d'abonnement */
                        if($dtNow < $un_mois_plus_tard){
                            return back()->with('erreur','Vous devriez attendre un mois avant de s\'abonner à une autre offre');
                        }
                        else{
                            if($cfp_ab == null) $type_abonnement = "Gratuit";
                            else $type_abonnement = $cfp_ab[0]->nom_type;
                            return view('superadmin.index_abonnement', compact('type_abonnement','cfp_ab','categorie_paiement_id', 'entreprise', 'cfps', 'nb', 'tarif', 'typeAbonnement', 'type_abonnement_role_id'));
                        }
                    }
                    else{

                        if($cfp_ab == null) $type_abonnement = "Gratuit";
                        else $type_abonnement = $cfp_ab[0]->nom_type;
                        return view('superadmin.index_abonnement', compact('type_abonnement','cfp_ab','categorie_paiement_id', 'entreprise', 'cfps', 'nb', 'tarif', 'typeAbonnement', 'type_abonnement_role_id'));
                    }
                }
                // $dtNow = Carbon::today()->toDateString();
                // $un_mois_plus_tard = strtotime(date("Y-m-d", strtotime($cfp_ab[0]->invoice_date)) . " + 31 days");
                // /**si on est encore à moins de 31jours du dernier abonnement, l'utilisateur ne peut pas changer d'abonnement */
                // if($dtNow < $un_mois_plus_tard){
                //      return back()->with('erreur','Vous devriez attendre un mois avant de s\'abonner à une autre offre');
                // }
                // else{
                //     if($cfp_ab == null) $type_abonnement = "Gratuit";
                //     else $type_abonnement = $cfp_ab[0]->nom_type;
                //     $entreprise = null;
                //     return view('superadmin.index_abonnement', compact('type_abonnement','cfp_ab','categorie_paiement_id', 'entreprise', 'cfps', 'nb', 'tarif', 'typeAbonnement', 'type_abonnement_role_id'));
                // }
            }
            else{
                $type_abonnement = "Gratuit";
                $entreprise = null;
                return view('superadmin.index_abonnement', compact('entreprise','type_abonnement','categorie_paiement_id', 'cfps', 'nb', 'tarif', 'typeAbonnement', 'type_abonnement_role_id'));
            }

        }
    }

    //enregistrer abonnement des utilisateurs;
    public function enregistrer_abonnement(Request $request)
    {
        $fonct = new FonctionGenerique();
        $abonnement = new abonnement();
        $abonnement_cfp = new abonnement_cfp();
        $dt = Carbon::today()->toDateString();
        $due_date = Carbon::today()->addDays(15)->toDateString();

        $user_id = Auth::user()->id;
        $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');

        $resp = $fonct->findWhere('responsables_cfp',['user_id'],[Auth::user()->id]);
        if($resp!=null) $cfp_id = $resp[0]->cfp_id;
        else $cfp_id = null;

        if ($cfp_id == null) {
            $abonnement->date_demande = $dt;
            $abonnement->status = "En attente";
            $abonnement->type_abonnement_role_id = $request->type_abonnement_role_id;
            $abonnement->entreprise_id = $entreprise_id;
            $abonnement->categorie_paiement_id = $request->catg_id;
            $abonnement->type_arret = "";
            $abonnement->save();

              //générer une facture

            // $abonnement_cfp_id = $fonct->findWhere('abonnement_cfps',['cfp_id','status'],[$cfp_id,'En attente']);
            $abonnement_id = DB::select('select * from abonnements where entreprise_id = ? and status = ? order by id desc limit 1', [$entreprise_id,'En attente']);
            $montant = $fonct->findWhere('v_categorie_abonnement_etp',['type_abonnement_role_id'],[$abonnement_id[0]->type_abonnement_role_id]);


            // $last_num_facture = $fonct->fin
            $this->abonnement_model->insert_factures_abonnements_etp($abonnement_id[0]->id,$dt,$due_date,$montant[0]->tarif);

        }
        if ($entreprise_id == null) {
            $abonnement_cfp->date_demande = $dt;
            $abonnement_cfp->status = "En attente";
            $abonnement_cfp->type_abonnement_role_id = $request->type_abonnement_role_id;
            $abonnement_cfp->cfp_id = $cfp_id;
            $abonnement_cfp->categorie_paiement_id = $request->catg_id;
            $abonnement_cfp->type_arret = "";
            $abonnement_cfp->save();

            //générer une facture

            // $abonnement_cfp_id = $fonct->findWhere('abonnement_cfps',['cfp_id','status'],[$cfp_id,'En attente']);
            $abonnement_cfp_id = DB::select('select * from abonnement_cfps where cfp_id = ? and status = ? order by id desc limit 1', [$cfp_id,'En attente']);
            $montant = $fonct->findWhere('v_categorie_abonnements_cfp',['type_abonnement_role_id'],[$abonnement_cfp_id[0]->type_abonnement_role_id]);


            // $last_num_facture = $fonct->fin
            $this->abonnement_model->insert_factures_abonnements_cfp($abonnement_cfp_id[0]->id,$dt,$due_date,$montant[0]->tarif);
            // DB::insert('insert into factures_abonnements_cfp (abonnement_cfps_id, invoice_date,due_date,num_facture,montant_facture) values (?, ?,?,?,?)', [$abonnement_cfp_id[0]->id,$dt,$due_date,1,$montant[0]->tarif]);

        }

        return redirect()->route('ListeAbonnement');
    }
    //liste des demandes d'abonnement
    public function listeAbonne()
    {
        // $abonnementCFP = DB::select('select nom_type,tarif,abonnement_id from v_categorie_abonnements_cfp group by nom_type,tarif,abonnement_id');
        // // $abonnementETP = DB::select('select nom_type,tarif,abonnement_id from v_categorie_abonnement_etp group by nom_type,tarif,abonnement_id');
        // // dd($abonnementETP);
        // $abonnementETP = DB::select('select nom_type,tarif,abonnement_id,count(type_abonnement_role_id) as total_inscrit from v_categorie_abonnement_etp group by nom_type,tarif');
        //return view('superadmin.listeAbonne', compact('abonnementETP', 'abonnementCFP'));
        $fonct = new FonctionGenerique();
        $liste = $fonct->findAll('v_abonnement_facture_entreprise');
        $cfpListe = $fonct->findAll('v_abonnement_facture');
        return view('superadmin.activation-abonnement', compact('liste','cfpListe'));
    }
    //activation de compte
    public function activation()
    {
        $fonct = new FonctionGenerique();
        $id = request()->id;
        $type_abonnement_role_id = abonnement::where('id', $id)->value('type_abonnement_role_id');

        if ($type_abonnement_role_id!=null) {
            $type = type_abonnement_role::with('type_abonnement', 'type_abonne')->where('id', $type_abonnement_role_id)->get();
            $ctg_id = abonnement::where('type_abonnement_role_id', $type_abonnement_role_id)->value('categorie_paiement_id');

            $tarif =tarif_categorie::with('categorie_paiement')->where('type_abonnement_role_id', $type_abonnement_role_id)->where('categorie_paiement_id', $ctg_id)->get();

            $nbAbonnement = type_abonnement_role::withCount('abonnement')->where('id', $type_abonnement_role_id)->get();
            // $liste = abonnement::with('type_abonnement_role', 'entreprise', 'categorie_paiement')->where('type_abonnement_role_id', $type_abonnement_role_id)->get();
            $liste = $fonct->findWhere('v_abonnement_facture_entreprise',['type_abonnement_role_id'],[$type_abonnement_role_id]);
            $nom_entreprise = [];
            for ($i=0; $i < count($liste); $i++) {
                array_push($nom_entreprise ,$fonct->findWhere('entreprises',['id'],[$liste[$i]->entreprise_id]));
            }

            $cfpListe = null;
            return view('superadmin.activation-abonnement', compact('cfpListe', 'tarif', 'id', 'type', 'nbAbonnement', 'liste','nom_entreprise'));
        }

        if ($type_abonnement_role_id == null) {
            $type_abonnement_role_id = abonnement_cfp::where('id', $id)->value('type_abonnement_role_id');
            $type = type_abonnement_role::with('type_abonnement', 'type_abonne')->where('id', $type_abonnement_role_id)->get();
            $ctg_id = abonnement_cfp::where('type_abonnement_role_id', $type_abonnement_role_id)->value('categorie_paiement_id');

            $tarif = tarif_categorie::with('categorie_paiement')->where('type_abonnement_role_id', $type_abonnement_role_id)->where('categorie_paiement_id', $ctg_id)->get();

            $nbAbonnement = type_abonnement_role::withCount('abonnement')->where('id', $type_abonnement_role_id)->get();
            $cfpListe = abonnement_cfp::with('type_abonnement_role', 'cfp', 'categorie_paiement')->where('type_abonnement_role_id', $type_abonnement_role_id)->get();
            $liste = null;
            return view('superadmin.activation-abonnement', compact('liste', 'tarif', 'id', 'type', 'nbAbonnement', 'cfpListe'));
        }
    }
    //activer le compte
    public function activer(Request $request)
    {
        $id = $request->Id;

        $Statut = $request->Statut;
        $dt = Carbon::today()->toDateString();
        $mensuel = strtotime(date("Y-m-d", strtotime($dt)) . " + 31 days");
        $annuel = strtotime(date("Y-m-d", strtotime($dt)) . " +1 year");

        $test = abonnement::where('id', $id)->exists();
        if ($test) {
            $ctg_id =abonnement::where('id', $id)->value('categorie_paiement_id');
            if ($ctg_id == 1) $date_fin = date("Y-m-d", $mensuel);
            if ($ctg_id == 2)  $date_fin = date("Y-m-d", $annuel);
            DB::table('abonnements')
                ->where('id', $id)
                ->update(['status' => $Statut, 'date_debut' => $dt, 'date_fin' => $date_fin]);
            $liste = abonnement::where('id', $id)->get();
            return response()->json($liste);
        } else {
            $ctg_id = abonnement_cfp::where('id', $id)->value('categorie_paiement_id');
            if ($ctg_id == 1) $date_fin = date("Y-m-d", $mensuel);
            if ($ctg_id == 2)  $date_fin = date("Y-m-d", $annuel);
            DB::table('abonnement_cfps')
                ->where('id', $id)
                ->update(['status' => $Statut, 'date_debut' => $dt, 'date_fin' => $date_fin]);
            $liste = abonnement::where('id', $id)->get();
            return response()->json($liste);
        }
    }
    //detail facture
    public function detail_facture($id){

        $fonct = new FonctionGenerique();
        $mode_paiements = $fonct->findAll('mode_financements');

        if(Gate::allows('isCFP')){
            $entreprises = null;
            $resp = $fonct->findWhere('responsables_cfp',['user_id'],[Auth::user()->id]);
            $cfp_id = $resp[0]->cfp_id;
            $cfp = $fonct->findWhereMulitOne('cfps',['id'],[$cfp_id]);
            $facture = $fonct->findWhere('v_abonnement_facture',['facture_id'],[$id]);

            if($facture!=null){
                $test_assujetti = $fonct->findWhere('cfps',['id'],[$cfp_id]);
                    //on vérifie d'abord si l'organisme est assujetti ou non pourqu'on puisse ajouter le TVA
                if($test_assujetti[0]->assujetti_id == 1) {
                    $tva = ($facture[0]->montant_facture * 20) / 100;
                    $net_ttc = $facture[0]->montant_facture + $tva;
                }
                if($test_assujetti[0]->assujetti_id == 2) {
                    $tva = 0;
                    $net_ttc = $facture[0]->montant_facture;
                }
                $lettre_montant = $this->fact->int2str($net_ttc);
            }
            else{
                $test_assujetti = $tva = $net_ttc ='';
            }
            $dates_abonnement = $fonct->findWhere('abonnement_cfps',['cfp_id'],[$cfp_id]);
            return view('superadmin.detail_facture',compact('dates_abonnement','entreprises','lettre_montant','cfp','facture','tva','net_ttc','mode_paiements'));
        }
        if(Gate::allows('isReferent')){
            $cfp = null;
            $resp = $fonct->findWhere('responsables',['user_id'],[Auth::user()->id]);
            $entreprise_id = $resp[0]->entreprise_id;
            $entreprises = $fonct->findWhereMulitOne('entreprises',['id'],[$entreprise_id]);

            $facture = $fonct->findWhere('v_abonnement_facture_entreprise',['facture_id'],[$id]);

            if($facture!=null){
                $test_assujetti = $fonct->findWhere('entreprises',['id'],[$entreprise_id]);
                    //on vérifie d'abord si l'organisme est assujetti ou non pourqu'on puisse ajouter le TVA
                if($test_assujetti[0]->assujetti_id == 1) {
                    $tva = ($facture[0]->montant_facture * 20) / 100;
                    $net_ttc = $facture[0]->montant_facture + $tva;
                }
                if($test_assujetti[0]->assujetti_id == 2) {
                    $tva = 0;
                    $net_ttc = $facture[0]->montant_facture;
                }
                $lettre_montant = $this->fact->int2str($net_ttc);
            }
            else{
                $test_assujetti = $tva = $net_ttc ='';
            }
            $dates_abonnement = $fonct->findWhere('abonnements',['entreprise_id'],[$entreprise_id]);

            return view('superadmin.detail_facture',compact('dates_abonnement','cfp','lettre_montant','entreprises','facture','tva','net_ttc','mode_paiements'));
        }
    }
    public function desactiver_offre($id){

        if (Gate::allows('isReferent')) {
            $abonnement_id = DB::select('select * from v_abonnement_facture_entreprise where type_abonnement_id = ? order by facture_id desc limit 1', [$id]);
               //on met à 0 l'activite pour desactiver l'offre
            DB::update('update abonnements set activite = 0 where id = ?',[$abonnement_id[0]->abonnement_id]);
            return redirect()->back();
        }
        if (Gate::allows('isCFP')) {
            $abonnement_id = DB::select('select * from v_abonnement_facture where type_abonnement_id = ? order by facture_id desc limit 1', [$id]);
               //on met à 0 l'activite pour desactiver l'offre
            DB::update('update abonnement_cfps set activite = 0 where id = ?',[$abonnement_id[0]->abonnement_id]);
            return redirect()->back();
        }
    }
    //impression facture
    public function impression($id){
        PDF::setOptions([
            "defaultFont" => "Courier",
            "defaultPaperSize" => "a4",
            "dpi" => 130
        ]);

        $fonct = new FonctionGenerique();
        $mode_paiements = $fonct->findAll('mode_financements');

        if(Gate::allows('isCFP')){
            $entreprises = null;
            $resp = $fonct->findWhere('responsables_cfp',['user_id'],[Auth::user()->id]);
            $cfp_id = $resp[0]->cfp_id;
            $cfp = $fonct->findWhereMulitOne('cfps',['id'],[$cfp_id]);
            $facture = $fonct->findWhere('v_abonnement_facture',['facture_id'],[$id]);

            if($facture!=null){
                $test_assujetti = $fonct->findWhere('cfps',['id'],[$cfp_id]);
                    //on vérifie d'abord si l'organisme est assujetti ou non pourqu'on puisse ajouter le TVA
                if($test_assujetti[0]->assujetti_id == 1) {
                    $tva = ($facture[0]->montant_facture * 20) / 100;
                    $net_ttc = $facture[0]->montant_facture + $tva;
                }
                if($test_assujetti[0]->assujetti_id == 2) {
                    $tva = 0;
                    $net_ttc = $facture[0]->montant_facture;
                }
                $lettre_montant = $this->fact->int2str($net_ttc);
            }
            else{
                $test_assujetti = $tva = $net_ttc ='';
            }
            $dates_abonnement = $fonct->findWhere('abonnement_cfps',['cfp_id'],[$cfp_id]);
            $lettre_montant = $this->fact->int2str($net_ttc);
            $pdf = PDF::loadView('admin.pdf.pdf_facture_abonnement', compact('dates_abonnement','lettre_montant','entreprises','lettre_montant','cfp','facture','tva','net_ttc','mode_paiements'));

        }
        if(Gate::allows('isReferent')){
            $cfp = null;
            $resp = $fonct->findWhere('responsables',['user_id'],[Auth::user()->id]);
            $entreprise_id = $resp[0]->entreprise_id;
            $entreprises = $fonct->findWhereMulitOne('entreprises',['id'],[$entreprise_id]);

            $facture = $fonct->findWhere('v_abonnement_facture_entreprise',['facture_id'],[$id]);

            if($facture!=null){
                $test_assujetti = $fonct->findWhere('entreprises',['id'],[$entreprise_id]);
                    //on vérifie d'abord si l'organisme est assujetti ou non pourqu'on puisse ajouter le TVA
                if($test_assujetti[0]->assujetti_id == 1) {
                    $tva = ($facture[0]->montant_facture * 20) / 100;
                    $net_ttc = $facture[0]->montant_facture + $tva;
                }
                if($test_assujetti[0]->assujetti_id == 2) {
                    $tva = 0;
                    $net_ttc = $facture[0]->montant_facture;
                }
                $lettre_montant = $this->fact->int2str($net_ttc);
            }
            else{
                $test_assujetti = $tva = $net_ttc ='';
            }
            $dates_abonnement = $fonct->findWhere('abonnements',['entreprise_id'],[$entreprise_id]);
            $lettre_montant = $this->fact->int2str($net_ttc);
            $pdf = PDF::loadView('admin.pdf.pdf_facture_abonnement', compact('lettre_montant','dates_abonnement','cfp','lettre_montant','entreprises','facture','tva','net_ttc','mode_paiements'));
            // return view('admin.pdf.pdf_facture_abonnement', compact('cfp','lettre_montant','entreprises','facture','tva','net_ttc','mode_paiements'));
        }
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed' => TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );
        return $pdf->download('facture abonnement.pdf');

    }
    //arret  de l'abonnement pour entreprises
    public function arret_immediat_abonnement_entreprise($id){
        DB::update('update abonnements set activite = ? , type_arret = ? where id = ?', [0,"immediat",$id]);
        return back()->with('arret_immediat','Vous venez de désactiver votre abonnement');
    }
    public function arret_fin_abonnement_entreprise($id){
        $fonct = new FonctionGenerique();
        $dateNow = Carbon::today()->toDateString();
        $date_fin = $fonct->findWhere('abonnements',['id'],[$id]);
        if($dateNow == $date_fin)  DB::update('update abonnements set activite = ?, type_arret = ? where id = ?', [0,"fin abonnement",$id]);
        return back()->with('arret_fin','Votre abonnement sera désactivé automatiquement dans un mois');
    }
    //arret de l'abonnemement pour cfp
    public function arret_immediat_abonnement_of($id){
        DB::update('update abonnement_cfps set activite = ?, type_arret = ? where id = ?', [0,"immediat",$id]);
        return back()->with('arret_immediat','Vous venez de désactiver votre abonnement');
    }

    public function arret_fin_abonnement_of($id){
        $fonct = new FonctionGenerique();
        $dateNow = Carbon::today()->toDateString();
        $date_fin = $fonct->findWhere('abonnements',['id'],[$id]);
        if($dateNow == $date_fin)  DB::update('update abonnement_cfps set activite = ?, type_arret = ? where id = ?', [0,"fin abonnement",$id]);
        return back()->with('arret_fin','Votre abonnement sera désactivé automatiquement dans un mois');
    }
    /** TRI */
    public function tri_client(){
        $tri_nom =  DB::select('select * from v_abonnement_facture_entreprise  order by nom_entreprise');
        return response()->json($tri_nom);
    }

}