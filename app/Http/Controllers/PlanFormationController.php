<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\PlanFormation;
use App\recueil_information;
use App\stagiaire;
use App\ChefDepartement;
use App\responsable;
use App\Domaine;
use App\formation;
use App\annee_plan;
use App\entreprise;
use App\User;
use App\besoins;
use PDF;
use Illuminate\Support\Facades\Mail;
use App\Models\FonctionGenerique;
use Google\Service\Adsense\Alert;

class PlanFormationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }
    public function besoin_PD($id){
        $users_id = Auth::user()->id;
        $plan = PlanFormation::where('id',$id)->get();
        $entreprise_id = responsable::where('user_id',$users_id)->value('entreprise_id');

        $entreprise = entreprise::where('id',$entreprise_id)->get();
        foreach($entreprise as $ent)
        {
           $nom_etp = $ent->nom_etp;
        }
        // $entreprise = entreprise::where('id',$entreprise_id)->get();
        $besoin = besoins::where('anneePlan_id',$id)->get();
        $stagiaire = DB::select('select stagiaire_id,nom_stagiaire,prenom_stagiaire,mail_stagiaire,matricule,fonction_stagiaire from besoin_stagiaire b join stagiaires s on s.id = b.stagiaire_id GROUP BY stagiaire_id,nom_stagiaire,prenom_stagiaire,mail_stagiaire,matricule,fonction_stagiaire');


        $pdf = PDF::loadView('referent.projet_interne.besoin_PDF', compact('plan','entreprise','stagiaire','besoin'))->setPaper('a4', 'landscape');;

        return $pdf->download('plan_previesionele_.pdf');

        // return view('referent.projet_interne.besoin_PDF',compact('plan','entreprise','stagiaire','besoin'));

    }
    public function index()
    {

        $users_id = Auth::user()->id;
        $entreprise_id = stagiaire::where('user_id', $users_id)->value('entreprise_id');
        $stagiaire_id = stagiaire::where('user_id', $users_id)->value('id');

        $collaborateur_id = stagiaire::where('user_id', $users_id)->value('user_id');
        // $besoin = DB::select('select * from besoin_stagiaire where stagiaire_id = ?',[$stagiaire_id]);
        $besoin = besoins::where('stagiaire_id',$stagiaire_id)->where('reponse_stagiaire',1)->get();
        // $besoin = DB::table('besoin_stagiaire')
        //         ->where('stagiaire_id',$stagiaire_id)
        //         ->where('reponse_stagiaire', '<>', 1)
        //         ->get();
        // foreach ($besoin as $b){
        //     $domaines_id = $b->domaines_id;
        // }
        // $domaine = Domaine::where('id',$domaines_id)->value('nom_domaine');
        // $formations = Formation::where('domaine_id',$domaines_id)->value('nom_formation');
        $plan = PlanFormation::where('entreprise_id',$entreprise_id)->get();

        // $plan = DB::select('select * from plan_formation_valide where entreprise_id = ?',[$entreprise_id]);

        // $liste_domaine = Domaine::all();
        // $entreprise_id = stagiaire::where('mail_stagiaire', Auth::user()->email)->value('entreprise_id');
        // $annee = annee_plan::where(['Etat' => 'Ouvert'], ['entreprise_id' => $entreprise_id])->get();
        // $liste_formation = formation::orderBy('nom_formation')->get();
        return view('stagiaire.formulairePlanDeFormation', compact('plan','collaborateur_id','besoin'));
    }
    public function delete($id){
        $besoin = DB::table('besoin_stagiaire')->where('id',$id)->delete();
        return redirect()->back()->with('delete','supression éffectuer avec succes');
    }
    public function ajout($id){
        $entreprise_id = $id;
        return view('referent.ajout_plan',compact('entreprise_id'));
    }
    public function getplan(Request $req)
    {
        $anne = DB::select('select * from plan_formation_valide where AnneePlan = ?',[$req->id]);
        $v='Cette année existe déja';
        if($anne != null){
            return response()->json($v);
        }

    }
    public function countplan(Request $req){
        $id = $req->Id;
        $besoin = DB::select('select * from besoin_stagiaire where anneePlan_id = ?',[$id]);

        $count = count($besoin);
        return response()->json($count);
    }

    public function create()
    {
        $liste_formation = PlanFormation::all();
        return view('stagiaire.formulairePlanDeFormation', compact('liste_formation'));
    }
    public function demande($id)
    {
        $users_id = Auth::user()->id;
        $entreprise_id = stagiaire::where('user_id', $users_id)->value('entreprise_id');
        $domaine = Domaine::all();
        $collaborateur = stagiaire::where('user_id', $users_id)->get();
        $plan = PlanFormation::where('id',$id)->get();

        return view('stagiaire.nouvD',compact('plan','collaborateur','domaine','entreprise_id'));
    }
    public function liste($id)
    {
        $besoin = besoins::where('anneePlan_id',$id)->get();
        $stagiaire = DB::select('select stagiaire_id,nom_stagiaire,prenom_stagiaire,mail_stagiaire,matricule,fonction_stagiaire from besoin_stagiaire b join stagiaires s on s.id = b.stagiaire_id GROUP BY stagiaire_id,nom_stagiaire,prenom_stagiaire,mail_stagiaire,matricule,fonction_stagiaire');
        $ids = $id;

        // dd('end');
            // $besoin = besoins::all()->groupBy('stagiaire_id');

            // dd($besoin);

        return view('referent.projet_interne.listedemandestagiaire',compact('besoin','stagiaire','ids'));
    }

    public function teste(){
        $req = DB::table('besoin_stagiaire')
        ->select('stagiaire_id', 'entreprise_id')
        ->groupBy('stagiaire_id', 'entreprise_id')
        ->get();

    dd($req);
        $nom = $req->stagiaire->nom_stagiaire;

    }

    public function listeV($id)
    {
        $besoin = besoins::where('anneePlan_id',$id)
                            ->where('statut',1)
                            ->get();
        $besoinN = besoins::where('anneePlan_id',$id)
                            ->where('statut',2)
                            ->get();
        $stagiaire = DB::select('select stagiaire_id,nom_stagiaire,prenom_stagiaire,mail_stagiaire,matricule,fonction_stagiaire from besoin_stagiaire b join stagiaires s on s.id = b.stagiaire_id GROUP BY stagiaire_id,nom_stagiaire,prenom_stagiaire,mail_stagiaire,matricule,fonction_stagiaire');
        $ids = $id;
        return view('referent.projet_Interne.listeValide',compact('besoin','stagiaire','besoinN'));
    }
    public function modifier($id, Request $request)
    {
        $debut_rec = $request->input('debut');
        $fin_rec = $request->input('fin');
        $ids = $id;
        DB::update('update plan_formation_valide set debut_rec = ?, fin_rec= ? where id = ?',[$debut_rec,$fin_rec,$ids]);
        return back();

    }
    public function modification_besoin($id,Request $request){


        // $domaine   = $request->input('domaine');
        // $formation = $request->input('formation');
        $ids       = $id;
        $date      = $request->input('date');
        $organisme = $request->input('organisme');
        $type      = $request->input('type');
        DB::update('update besoin_stagiaire set date_previsionnelle = ?, organisme = ? ,type = ? where id = ?',[$date,$organisme,$type,$ids] );
        return redirect()->back()->with('success','modification éffectuer avec succes');


    }
    public function creation(Request $request)
    {
        $request->validate([
            'stagiaire_id' => 'required',
            'entreprise_id'=>'required',
            'domaines_id'=>'required',
            'thematique_id'=>'required',
            'anneePlan_id'=>'required',
            'objectif'=>'required',
            'date_previsionnelle'=>'required',
            'type'=>'required'
        ]);
        besoins::create($request->all());
        return back()->with('success','Votre demande envoyer.');

    }
    public function cree(Request $request)
    {
        $request->validate([
            'AnneePlan'     => 'required',
            'debut_rec'     => 'required',
            'fin_rec'       => 'required',
            'entreprise_id' => 'required',

        ]);
        PlanFormation::create($request->all());
        return back()->with('success','Plan de formation crée avec success.');

    }


    public function store(Request $request)
    {
        //enregistrement formulaire de demande de formation par le stagiaire
        $info = new recueil_information();
        $info->formation_id = $request->IdFormation;

        if (Gate::allows('isReferent')) {
            $id = $request->stagiaire_id;
            $info->stagiaire_id = $id;
            $users_id = Auth::user()->id;
            $entreprise_id = responsable::where('user_id', $users_id)->value('entreprise_id');
        }
        if (Gate::allows('isStagiaire')) {
            $id = stagiaire::where('mail_stagiaire', Auth::user()->email)->value('id');
            $info->stagiaire_id = $id;
            $entreprise_id = stagiaire::where('mail_stagiaire', Auth::user()->email)->value('entreprise_id');
        }
        $info->entreprise_id = $entreprise_id;

        $info->duree_formation = $request->duree_formation;

        $res = explode("-", $request->date_previsionnelle);
        $info->mois_previsionnelle = $res[1];
        $info->annee_previsionnelle = $res[0];
        $info->statut = "En attente";
        $info->typologie_formation = $request->typologie;
        $info->objectif_attendu = $request->objectif;
        //get date now
        $dt = Carbon::today()->toDateString();
        $info->date_demande = $dt;
        $info->annee_plan_id = $request->IdAnnee;
        $info->save();
        if (Gate::allows('isReferent')) {
            return redirect()->route('liste_demande_stagiaire');
        }
        if (Gate::allows(('isStagiaire'))) {
            return redirect()->route("liste_demande_formation");
        }
    }

    //liste des demandes des stagiaires
    public function liste_demande_stagiaire()
    {
        $fonct = new FonctionGenerique();
        $users = Auth::user()->id;

        $yearNow = Carbon::now()->format('Y');
        // $idAnnee = annee_plan::where('Annee', $yearNow)->value('id');
        // $test = annee_plan::where('Annee', $yearNow)->exists();
        $domaine = Domaine::all();
        $stagiaire = stagiaire::all();

        if (Gate::allows('isReferent') or Gate::allows('isReferentSimple')) {
            $entreprise_id = responsable::where('user_id', $users)->value('entreprise_id');
            $plan = DB::select('select * from plan_formation_valide where entreprise_id = ?', [$entreprise_id]);
            $count = count($plan);

            if ($count == 0)
            {
                return view('referent.ajout_plan',compact('entreprise_id'));
            }
            else{
                $besoin_count  = PlanFormation::where('entreprise_id',$entreprise_id)->withcount(['besoins'])->get();
                $besoinV_count = PlanFormation::where('entreprise_id',$entreprise_id)->withcount(['besoins'=>function($query){
                    $query->where('statut','=','1');
                }])->get();
                $besoinN_count = PlanFormation::where('entreprise_id',$entreprise_id)->withcount(['besoins'=>function($query){
                    $query->where('statut','=','1');
                }])->get();
                $employ = DB::select('select * from stagiaires where entreprise_id = ?', [$entreprise_id]);
                $nombr = count($employ);
                return view('referent.listeDemandeFormation', compact( 'domaine', 'stagiaire', 'yearNow', 'users','entreprise_id','plan','employ','nombr','besoin_count','besoinV_count','besoinN_count'));
            }
        }
    }

    public function getEmailEmploye(Request $req){
        $fonct = new FonctionGenerique();
        
        $users = Auth::user()->id;
        if (Gate::allows('isManager')) {
            $departement_id = $fonct->findWhereMulitOne("employers",["user_id"],[$users])->departement_entreprises_id;
            $entreprise_id = $fonct->findWhereMulitOne("chef_departements",["user_id"],[$users])->entreprise_id;
            $employe = $fonct->findWhereMulitOne('employers',["id","departement_entreprises_id","entreprise_id"],[$req->id, $departement_id, $entreprise_id])->email_emp;
        //    $employe = DB::select('select email_emp from employers where id = ?,departement_entreprises_id = ? ,entreprise_id', [$req->id, $departement_id, $entreprise_id]);
            return response()->json($employe);
        }
    }

    public function  listes_demandes_stagiaires(){
        $fonct = new FonctionGenerique();
        $users = Auth::user()->id;
        if (Gate::allows('isManager')) {
            $departement_id = $fonct->findWhereMulitOne("employers",["user_id"],[$users])->departement_entreprises_id;
            $entreprise_id = $fonct->findWhereMulitOne("chef_departements",["user_id"],[$users])->entreprise_id;
            
            $plan = DB::select('select * from plan_formation_valide where entreprise_id = ?', [$entreprise_id]);
            $besoins = $fonct->findWhere("v_besoins_stagiaires", ["entreprise_id","departement_entreprises_id","reponse_stagiaire"], [$entreprise_id,$departement_id,1]);
            $propositions = $fonct->findWhereParam("v_besoins_stagiaires",["entreprise_id","departement_entreprises_id","reponse_stagiaire"],["=","=","<>"],[$entreprise_id,$departement_id,1]);
            // // $liste = recueil_information::with('formation', 'annee_plan')->where('entreprise_id', $entreprise_id)->get();
            return view('manager.demande_stagiaires.listeDemandeStagiaire', compact( 'plan','besoins','propositions'));
        }
    }

    public function envoye_demande_stg(Request $req,$anneePlan_id){
        $fonct = new FonctionGenerique();
        $users =Auth::user()->id;
        $planAn_id = PlanFormation::where('id',$anneePlan_id)->value('id');
        if(Gate::allows('isManager')){
            $entreprise_id = ChefDepartement::where('user_id', $users)->value('entreprise_id');
            $departement_id = $fonct->findWhereMulitOne("employers",["user_id"],[$users])->departement_entreprises_id;
            $stagiaires = $fonct->findWhereParam("stagiaires",["entreprise_id","departement_entreprises_id","user_id"],["=","=","<>"],[$entreprise_id,$departement_id,$users]);
            // dd($stagiaires);
            $domaines = Domaine::all();
            $themes =formation::all();
            return view('manager.autreDemandeFormation',compact('stagiaires','domaines','planAn_id'));
        }
    }

    public function enregistrer_demande_stagiaire(Request $request,$id){
        $fonct = new FonctionGenerique();
        $users =Auth::user()->id;
        if(Gate::allows('isManager')){
            $entreprise_id = ChefDepartement::where('user_id', $users)->value('entreprise_id');
            $plan_id = $id;
            $statut = 1;
            $reponse = 0;
           
            $validator = Validator::make(
                $request->all(),
                [
                    'stagiaire_id'=>'required',
                    'domaines_id'=>'required',
                    'thematique_id'=>'required',
                    'objectif'=>'required',
                    'date_previsionnelle'=>'required',
                    'organisme'=>'required',
                    'type'=>'required'
                ],
                [
                    'stagiaire_id'=>'Veuillez remplir le champ',
                    'domaines_id'=>'Veuillez remplir le champ',
                    'thematique_id'=>'Veuillez remplir le champ',
                    'objectif'=>'Veuillez remplir le champ',
                    'date_previsionnelle'=>'Veuillez remplir le champ',
                    'organisme'=>'Veuillez remplir le champ',
                    'type'=>'Veuillez remplir le champ',
                ]
            );
            if ($validator->fails()) {
               return back();
            } else {
                $stagiaire_id = $request->stagiaire_id;
                $domaine_id = $request->domaines_id;
                $thematique_id =$request->thematique_id;
                $objectif= $request->objectif;
                $date_prev = $request->date_previsionnelle;
                $organisme = $request->organisme;
                $type = $request->type;

                $demande_manager = DB::insert('insert into besoin_stagiaire (stagiaire_id,entreprise_id,domaines_id,thematique_id,anneePlan_id,objectif,date_previsionnelle,organisme,statut,type,reponse_stagiaire) 
            values (?,?,?,?,?,?,?,?,?,?,?)', [$stagiaire_id,$entreprise_id,$domaine_id,$thematique_id,$plan_id,$objectif,$date_prev,$organisme,$statut,$type,$reponse]);
                DB::commit();
                return redirect()->route('listes_demandes_stagiaires');                                                                                                           
            }
            
            
        }
    }

    public function modif_demande_stagiaire($id){
        $users = Auth::user()->id;
        if (Gate::allows('isManager')) {
            $entreprise_id = ChefDepartement::where('user_id', $users)->value('entreprise_id');
            $besoin = besoins::find($id);
            $domaines = Domaine::all();
            $themes =formation::all();

            return view('manager.demande_stagiaires.modifDemandeStagiaire',compact('besoin','domaines','themes'));
        }
    }

    public function update_demande_stg(Request $request,$id){
        $users = Auth::user()->id;
        $stagiaire_id = $request->stagiaire_id;

        if (Gate::allows('isManager')) {
            $entreprise_id = ChefDepartement::where('user_id', $users)->value('entreprise_id');
            $data = DB::table('besoin_stagiaire')->where('id',$id)
            ->where('entreprise_id',$entreprise_id)->where('stagiaire_id',$stagiaire_id)
            ->update([
                'domaines_id'=>$request->domaines_id,
                'thematique_id'=>$request->thematique_id,
                'objectif'=>$request->objectif,
                'date_previsionnelle'=>$request->date_previsionnelle,
                'organisme'=>$request->organisme,
                'type'=>$request->type
            ]);
            return redirect()->route('listes_demandes_stagiaires');
        }
        
    }

    public function valideStatut($id){
        $users = Auth::user()->id;
        $status = 1;
        if (Gate::allows('isReferent')) {
            $entreprise_id = responsable::where('user_id', $users)->value('entreprise_id');
        }

        if (Gate::allows('isManager')) {
            $entreprise_id = ChefDepartement::where('user_id', $users)->value('entreprise_id');
        }
        $data =DB::table('besoin_stagiaire')
        ->where('id',$id)
        ->where('entreprise_id',$entreprise_id)
        ->update(['statut'=>$status]);
        if($data){
            return back();
        }
    }
    public function refuseSatut($id){
        $users = Auth::user()->id;
        $status = 2;
        if (Gate::allows('isReferent')) {
            $entreprise_id = responsable::where('user_id', $users)->value('entreprise_id');
        }

        if (Gate::allows('isManager')) {
            $entreprise_id = ChefDepartement::where('user_id', $users)->value('entreprise_id');
        }
        $data =DB::table('besoin_stagiaire')
        ->where('id',$id)
        ->where('entreprise_id',$entreprise_id)
        ->update(['statut'=>$status]);
        if($data){
            return back();
        }
    }

    // public function formulaire_email($id){
    //     $plan = DB::select('select debut_rec,fin_rec from plan_formation_valide where id = ?', [$id]);
    //     // dd($plan);
    //     return view('referent.formulaire_email',compact('plan'));
    // }

    public function sendEmail(Request $req){
        $user = Auth::user()->id;
        $id = $req->id;
        if (Gate::allows('isReferent')) {
            $entreprise_id =  responsable::where('user_id', $user)->value('entreprise_id');
            $email_resp = responsable::where('user_id', $user)->value('email_resp');
        
            $date_debut = PlanFormation::where('id',$id)->where('entreprise_id',$entreprise_id)->value('debut_rec');
            $date_fin = PlanFormation::where('id',$id)->where('entreprise_id',$entreprise_id)->value('fin_rec');
        
            $email =  responsable::where('user_id', $user)->value('email_resp');
            $employes = DB::select('select * from employers where entreprise_id = ?', [$entreprise_id]);
            $date_debut = $date_debut;
            $date_fin =  $date_fin;
            $mail_resp = $email_resp;

            foreach($employes as $employe){
                $nom_empl = $employe->nom_emp;
                $prenom_empl =$employe->prenom_emp;
                $mail_emp = $employe->email_emp;

                Mail::to($email_resp)->send(new \App\Mail\PlanStagiaire($mail_resp,$nom_empl,$prenom_empl,$date_debut, $date_fin));
            }
        
            return back()->withText("Message envoyé");
        }
    }

    public function show()
    {
    }

    //modification plan formation
    public function edit($id)
    {
        $liste_plan = PlanFormation::findOrFail($id);
        return view('referent.liste_planFormation', compact('liste_plan'));
    }

    public function update(Request $request, $id)
    {
        $liste_plan = PlanFormation::findOrFail($id);
        $liste_plan->update([
            'cout_previsionnel' => $request->cout, 'mode_financement' => $request->mode_financement
        ]);
        return   redirect()->route('listePlanFormation');
    }

    public function destroy($id)
    {
        //
    }
    public function formation_demandee()
    {

        $liste_domaine = Domaine::all();
        $id =stagiaire::where('mail_stagiaire', Auth::user()->email)->value('id');
        $recueilInfo = recueil_information::with('formation')->where('stagiaire_id', $id)->get();

        return view('stagiaire.liste_demande', compact('recueilInfo', 'liste_domaine'));
    }
    //accepter une demande de formation
    public function accepter_demande(Request $request)
    {
        $idRecueil = $request->Id;
        $Statut = $request->Statut;
        DB::table('recueil_informations')
            ->where('id', $idRecueil)

            ->update(['statut' => $Statut]);
        $liste =  recueil_information::where('id', $idRecueil)
            ->get();
        return response()->json($liste);
    }
    //enregistrer plan de formation
    public function enregistrer_planFormation(Request $request)
    {
        $entreprise_id = responsable::where('email_resp', Auth::user()->email)->value('entreprise_id');
        //condition de validation de formulaire
        $request->validate(
            [
                'cout' =>  ["required"]
            ],
            [
                'cout.required' => 'Entrez le coût previsionnel'
            ]
        );

        $planFormation = new PlanFormation();
        $planFormation->entreprise_id = $entreprise_id;
        $planFormation->cout_previsionnel = $request->cout;
        $planFormation->mode_financement = $request->mode_financement;
        $planFormation->recueil_information_id = $request->idRecueil;
        $planFormation->status = "A venir";

        $planFormation->annee_plan_id = $request->idAnnee;
        $planFormation->save();
        return redirect()->route('listePlanFormation');
    }

    //liste des plans de formation de l'année
    public function liste_plan()
    {
        $formations = formation::with('domaine')->get();
        $stagiaire = stagiaire::all();
        $entreprise_id = responsable::where('email_resp', Auth::user()->email)->value('entreprise_id');
        $liste_plan = PlanFormation::with('recueil_information','entreprise')->where('entreprise_id', $entreprise_id)->get();
        return view('referent.liste_planFormation', compact('liste_plan', 'formations', 'stagiaire'));
    }

    //liste de formations par domaines
    public function domaineParFormation(Request $request)
    {
        $idDomaine = $request->id;
        $formation_domaine = formation::where('domaine_id', $idDomaine)->get();
        return response()->json($formation_domaine);
    }

    //autocomplete
    public function getAnnee(Request $request)
    {
        $search = $request->annee;

        if ($search == '') {
            $annee = annee_plan::orderby('Annee', 'desc')->select('id', 'Annee')->limit(5)->get();
        } else {
            $annee = annee_plan::orderby('Annee', 'desc')->select('id', 'Annee')->where('Annee', 'like', $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($annee as $annees) {
            $response[] = array("value" => $annees->id, "label" => $annees->Annee);
        }
        return response()->json($response);
    }

    //recherche de demande par année
    public function rechercheDemandeAnnee(Request $request)
    {
        $annee = $request->annee;
        $entreprise_id =stagiaire::where('mail_stagiaire', Auth::user()->email)->value('entreprise_id');
        if ($annee == '') {
            $liste = recueil_information::get();
        } else {
            $idAnnee = annee_plan::where('Annee', $annee)->value('id');
            $liste = recueil_information::where(['annee_plan_id' => $idAnnee], ['entreprise_id' => $entreprise_id])->get();
        }
        $domaine = Domaine::all();
        $stagiaire = stagiaire::all();
        return view('referent.listeDemandeFormation', compact('liste', 'domaine', 'stagiaire'));
    }
    //ajout annee_plan

    public function enregistrer_plan(Request $request)
    {

        $entreprise_id = responsable::where('email_resp', Auth::user()->email)->value('entreprise_id');
        //condition de validation de formulaire
        $request->validate(
            [
                'annee' => ["required"],

            ],
            [
                'annee.required' => 'Veuillez remplir le champ',
            ]
        );
        $annee_plan = new annee_plan();
        $annee_plan->entreprise_id = $entreprise_id;
        $annee_plan->Annee = $request->annee;
        $annee_plan->Etat = "Ouvert";
        $annee_plan->save();
        return redirect()->route('listePlanFormation');
    }
    //AFFICHER Detail recueil informations
    public function afficherDetail()
    {
        $id = request()->id;
        $plan = recueil_information::with('stagiaire', 'formation')->where('id', $id)->get();
        return view('referent.ajout', compact('plan'));
    }
    //budgetisation
    public function budgetisation(){
        $rqt =DB::select('select * from responsables where user_id = ?', [Auth::user()->id]);
        $departement = DB::select('select * from departement_entreprises where entreprise_id = ?', [$rqt[0]->entreprise_id]);
        return view('referent.budget',compact('departement'));
    }
    //afficher le total cout previsionnel par département
    public function cout_previsionnel(Request $request){
        $current_year = Carbon::now()->format('Y');
        $departement_id = $request->dep_id;
        $nom_dep = DB::select('select * from v_plan_formation where departement_entreprise_id = ?', [$departement_id]);
        $rqt = DB::select('select SUM(cout_previsionnel) as cout_prev from v_plan_formation where departement_entreprise_id = ? and annee = ?', [$departement_id,$current_year]);
        return response()->json(['total_budget'=>$rqt,'nom_dep'=>$nom_dep[0]]);
    }
    //enregistrer le budget
    public function enregistrer_budget(Request $request){
        $entreprise_id = DB::select('select * from responsables where user_id = ?', [Auth::user()->id]);
        $budget = $request->budget;
        $departement = $request->departement;
        $annee = $request->annee;
        $todayDate = Carbon::now()->format('Y-m-d');
        DB::insert('insert into budgetisation (entreprise_id, departement_entreprise_id,budget_total,date_creation,annee) values (?, ?,?,?,?)', [$entreprise_id[0]->entreprise_id,$departement,$budget,$todayDate,$annee]);
        return back()->with('success','Budget previsionnel enregistré avec succès');
    }
}
