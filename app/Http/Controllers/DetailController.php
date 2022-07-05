<?php

namespace App\Http\Controllers;

use PDF;
// use Barryvdh\DomPDF\PDF;
use App\cfp;
use App\User;
use Exception;
use App\detail;
use App\groupe;
use App\module;
use App\projet;
use App\session;
use App\formateur;
use App\formation;
use App\stagiaire;
use App\entreprise;
use App\responsable;
use App\responsable_cfp;
use App\chefDepartement;
use App\GroupeEntreprise;
use App\participant_groupe;
use RecursiveArrayIterator;
use Illuminate\Http\Request;
use RecursiveIteratorIterator;
use App\Models\FonctionGenerique;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
        $this->fonct = new FonctionGenerique();
        $this->groupes = new groupe();
    }

    // calendrier coté cfp
    public function calendrier(){

        $cfp_id = responsable_cfp::where('user_id', Auth::user()->id)->first()->cfp_id;

        $events = array();

        // si l'utilisateur est un résponsable d'entreprise
        if (Gate::allows('isCFP')) {
        
            // getting the cfp if the connected user
            $cfp = cfp::find($cfp_id);



            // get the details from model detail where cfp_id = $cfp_id and group it by groupe_id
            $list_details = detail::where('cfp_id', $cfp_id)->get();
            
            // Group $list_details by groupe_id
            $details = $list_details->groupBy('groupe_id');

            // $details get all data but it is a multidimansionnal array.
            // We need to get each details as raveled_details (ref numpy.ravel() in python)
            // we don't use collapse() since we neet to add the $numeroè_session and the color
            // foreach group of event
            

            foreach ($details as $key => $detail) {
                $numero_session = 0;

                // // generate a random color as another attribute
                $detail->color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                foreach ($detail as $key => $value) {
                    $value->color = $detail->color;
                    $value->numero_session = $numero_session;
                    $numero_session += 1;
                    $raveled_details[] = $value;
                }
               
                
            }
           
            // the collapse() method give the same result as the foreach to get the details (ravel() method in numpy)   
            // $d = collect($details);
            // $s = $d->collapse();

            // getting the elements for ech events from the groupe class relationships 
            foreach ($raveled_details as $key => $value) {

                
                foreach ($value->groupe->groupe_entreprise as $key => $group) {
                    
                }

                $events[] = array(
                    

                    'detail_id' => $value->id,
                    'title' => $value->groupe->module->formation->nom_formation.' - '.$value->lieu,
                    'start' => date( 'Y-m-d H:i:s', strtotime("$value->date_detail $value->h_debut")),
                    'end' => date( 'Y-m-d H:i:s', strtotime("$value->date_detail $value->h_fin")),
                    'description' => $value->groupe->module->nom_module.' - '.$value->groupe->projet->cfp->nom,
                    'nom_projet' => $value->groupe->projet->nom_projet,
                    'lieu' => $value->lieu,
                    'formation' => $value->groupe->module->formation,
                    'formateur_obj' => $value->formateur,
                    'formateur' => ucfirst($value->formateur->nom_formateur).' '.ucfirst($value->formateur->prenom_formateur),
                    'groupe' => $value->groupe,
                    'groupe_entreprise' => $value->groupe->groupe_entreprise,
                    'participants' => $value->groupe->participants->pluck('stagiaire'),
                    'materiel' => $value->groupe->ressources,

                    // Etabli la relation entre un participant(stagiaire) et son entreprise(entreprise)
                    // La relation 'entreprises' devient en attribut du 'participants' et contient le tableau d'entreprises
                    'participants_entreprises' => $value->groupe->participants->pluck('stagiaire')->pluck('entreprise'),
                    // get all the groupe_entreprise->entreprise as an array of objects
                    // the pluck() method return an array of the specified attribute of each objects
                    'entreprises' => $value->groupe->groupe_entreprise->pluck('entreprise')->toArray(),

                    'sessions' => $value->groupe->detail,
                    'numero_session' => $value->numero_session,
                    // 'duree' => date_diff(strtotime("$value->date_detail $value->h_debut"),strtotime("$value->date_detail $value->h_fin")),
                    'projet' => $value->groupe->projet,
                    'type_formation' => $value->groupe->projet->type_formation,
                    'nom_cfp' => $value->groupe->projet->cfp->nom,
                    'backgroundColor' => $value->color,
                    'borderColor' => $value->color,
                );
            }

            // return( $events);

        }

        if (Gate::allows('isFormateur')) {
        
            $formateur_id = formateur::where('user_id', Auth::user()->id)->value('id');
            
            $cfp = cfp::find($cfp_id);



            // get the details from model detail where cfp_id = $cfp_id and group it by groupe_id
            $list_details = detail::where('formateur_id', $formateur_id)->get();
            
            // Group $list_details by groupe_id
            $details = $list_details->groupBy('groupe_id');

            // $details get all data but it is a multidimansionnal array.
            // We need to get each details as raveled_details (ref numpy.ravel() in python)
            // we don't use collapse() since we neet to add the $numeroè_session and the color
            // foreach group of event
            

            foreach ($details as $key => $detail) {
                $numero_session = 0;

                // // generate a random color as another attribute
                $detail->color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                foreach ($detail as $key => $value) {
                    $value->color = $detail->color;
                    $value->numero_session = $numero_session;
                    $numero_session += 1;
                    $raveled_details[] = $value;
                }
               
                
            }
           
            // the collapse() method give the same result as the foreach to get the details (ravel() method in numpy)   
            // $d = collect($details);
            // $s = $d->collapse();

            // getting the elements for ech events from the groupe class relationships 
            foreach ($raveled_details as $key => $value) {

                
                foreach ($value->groupe->groupe_entreprise as $key => $group) {
                    
                }

                $events[] = array(
                    

                    'detail_id' => $value->id,
                    'title' => $value->groupe->module->formation->nom_formation.' - '.$value->lieu,
                    'start' => date( 'Y-m-d H:i:s', strtotime("$value->date_detail $value->h_debut")),
                    'end' => date( 'Y-m-d H:i:s', strtotime("$value->date_detail $value->h_fin")),
                    'description' => $value->groupe->module->nom_module.' - '.$value->groupe->projet->cfp->nom,
                    'nom_projet' => $value->groupe->projet->nom_projet,
                    'lieu' => $value->lieu,
                    'formation' => $value->groupe->module->formation,
                    'formateur_obj' => $value->formateur,
                    'formateur' => ucfirst($value->formateur->nom_formateur).' '.ucfirst($value->formateur->prenom_formateur),
                    'groupe' => $value->groupe,
                    'groupe_entreprise' => $value->groupe->groupe_entreprise,
                    'participants' => $value->groupe->participants->pluck('stagiaire'),
                    'materiel' => $value->groupe->ressources,

                    // Etabli la relation entre un participant(stagiaire) et son entreprise(entreprise)
                    // La relation 'entreprises' devient en attribut du 'participants' et contient le tableau d'entreprises
                    'participants_entreprises' => $value->groupe->participants->pluck('stagiaire')->pluck('entreprise'),
                    // get all the groupe_entreprise->entreprise as an array of objects
                    // the pluck() method return an array of the specified attribute of each objects
                    'entreprises' => $value->groupe->groupe_entreprise->pluck('entreprise')->toArray(),

                    'sessions' => $value->groupe->detail,
                    'numero_session' => $value->numero_session,
                    // 'duree' => date_diff(strtotime("$value->date_detail $value->h_debut"),strtotime("$value->date_detail $value->h_fin")),
                    'projet' => $value->groupe->projet,
                    'type_formation' => $value->groupe->projet->type_formation,
                    'nom_cfp' => $value->groupe->projet->cfp->nom,
                    'backgroundColor' => $value->color,
                    'borderColor' => $value->color,
                );
            }

            // return( $events);

        }

 

        // return view('admin.calendrier.planning_etp',compact('domaines','formations','statut'));
        return view('admin.calendrier.calendrier',compact('events'));
    }
    //calendrier entreprise
    public function calendrier_formation(){

        $domaines = $this->fonct->findAll('domaines');
        $rqt = $this->fonct->findWhere('responsables_cfp',['user_id'],[Auth::user()->id]);
        $statut = $this->fonct->findAll('status');
        $formations = DB::select('select * from formations ');
       

        $events = array();

        // si l'utilisateur est un résponsable d'entreprise ou un superadmin

        if (Gate::allows('isReferent') || Gate::allows('isSuperAdmin')) {
            $entreprise_id = responsable::where('user_id', Auth::user()->id)->first()->entreprise_id;
        
            // getting the entreprise if the connected user
            $entreprise = entreprise::find($entreprise_id);

            // getting the groupe_entreprises belonging to $entreprise
            $groupe_etp = GroupeEntreprise::where('entreprise_id', $entreprise_id)->get();

            // we get many groupe_entreprises so loop foreach element to get the details
            // matching with the groupe_id


            // details['groupe_id'] -> groupe_entreprises['groupe_id'] -> groupe['id']
            foreach ($groupe_etp as $key => $value) {
                $details[] = detail::whereHas('groupe', function($query) use($value){
                    $query->where('id', $value->groupe_id);
                })->get();
            
            }

            // dd($details);

            // $details get all data but it is a multidimansionnal array.
            // We need to get each details as raveled_details (ref numpy.ravel() in python)
           

            foreach ($details as $key => $detail) {
                $numero_session = 0;
                // generate a random color as another attribute
                $detail->color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                foreach ($detail as $key => $value) {
                    $value->color = $detail->color;
                    $value->numero_session = $numero_session;
                    $numero_session += 1;
                    $raveled_details[] = $value;
                }
                
                
            }


            
            // the collapse() method give the same result as the foreach to get the details (ravel() method in numpy)   
            // $d = collect($details);
            // $s = $d->collapse();

            

            // getting the elements for ech events from the groupe class relationships 
            foreach ($raveled_details as $key => $value) {

                
                foreach ($value->groupe->groupe_entreprise as $key => $group) {
                    
                }

                $events[] = array(
                    

                    'detail_id' => $value->id,
                    'title' => $value->groupe->module->formation->nom_formation.' - '.$value->lieu,
                    'start' => date( 'Y-m-d H:i:s', strtotime("$value->date_detail $value->h_debut")),
                    'end' => date( 'Y-m-d H:i:s', strtotime("$value->date_detail $value->h_fin")),
                    'description' => $value->groupe->module->nom_module.' - '.$value->groupe->projet->cfp->nom,
                    'nom_projet' => $value->groupe->projet->nom_projet,
                    'lieu' => $value->lieu,
                    'formation' => $value->groupe->module->formation,
                    'formateur_obj' => $value->formateur,
                    'formateur' => ucfirst($value->formateur->nom_formateur).' '.ucfirst($value->formateur->prenom_formateur),
                    'groupe' => $value->groupe,
                    'groupe_entreprise' => $value->groupe->groupe_entreprise,
                    'participants' => $value->groupe->participants->pluck('stagiaire'),
                    'materiel' => $value->groupe->ressources,

                    // Etabli la relation entre un participant(stagiaire) et son entreprise(entreprise)
                    // La relation 'entreprises' devient en attribut du 'participants' et contient le tableau d'entreprises
                    'participants_entreprises' => $value->groupe->participants->pluck('stagiaire')->pluck('entreprise'),
                    // get all the groupe_entreprise->entreprise as an array of objects
                    // the pluck() method return an array of the specified attribute of each objects
                    'entreprises' => $value->groupe->groupe_entreprise->pluck('entreprise')->toArray(),

                    'sessions' => $value->groupe->detail,
                    'numero_session' => $value->numero_session,
                    // 'duree' => date_diff(strtotime("$value->date_detail $value->h_debut"),strtotime("$value->date_detail $value->h_fin")),
                    'projet' => $value->groupe->projet,
                    'type_formation' => $value->groupe->projet->type_formation,
                    'nom_cfp' => $value->groupe->projet->cfp->nom,
                    'backgroundColor' => $value->color,
                    'borderColor' => $value->color,
                );
            }

            // return( $events);

            // grouping groupe, entreprise, module, projet, formation related to the connected user
            foreach ($groupe_etp as $key => $value) {
                $groupe_entreprises[] = array(
                    'id' => $value->id,
                    'groupe_id' => $value->groupe_id,
                    'groupe' => $value->groupe,
                    'entreprise' => $value->entreprise,
                    'module' => $value->groupe->module,
                    'projet' => $value->groupe->projet,
                    'formation' => $value->groupe->module->formation,
                );

            }

        }
        if (Gate::allows('isStagiaire')) {
            // dd('stagiaire');
            // getting the stagiaire_id of the connected user
            $stagiaire_id = stagiaire::where('user_id', Auth::user()->id)->first()->id;

            $participant_groupe = participant_groupe::where('stagiaire_id', $stagiaire_id)->get();
            // $groupe_id = $participant_groupe->id;
            // getting the groupe_entreprises belonging to $entreprise

            // we get many groupe_entreprises so loop foreach element to get the details
            // matching with the groupe_id


            // details['groupe_id'] -> groupe_entreprises['groupe_id'] -> groupe['id']
            foreach ($participant_groupe as $key => $value) {
                $details[] = detail::whereHas('groupe', function($query) use($value){
                    $query->where('id', $value->groupe_id);
                })->get();
            
            }


            // $details get all data but it is a multidimansionnal array.
            // We need to get each details as raveled_details (ref numpy.ravel() in python)
           

            foreach ($details as $key => $detail) {
                $numero_session = 0;
                // generate a random color as another attribute
                $detail->color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                foreach ($detail as $key => $value) {
                    $value->color = $detail->color;
                    $value->numero_session = $numero_session;
                    $numero_session += 1;
                    $raveled_details[] = $value;
                }
                
                
            }


            
            // the collapse() method give the same result as the foreach to get the details (ravel() method in numpy)   
            // $d = collect($details);
            // $s = $d->collapse();

            

            // getting the elements for ech events from the groupe class relationships 
            foreach ($raveled_details as $key => $value) {

                
                foreach ($value->groupe->groupe_entreprise as $key => $group) {
                    
                }

                $events[] = array(
                    

                    'detail_id' => $value->id,
                    'title' => $value->groupe->module->formation->nom_formation.' - '.$value->lieu,
                    'start' => date( 'Y-m-d H:i:s', strtotime("$value->date_detail $value->h_debut")),
                    'end' => date( 'Y-m-d H:i:s', strtotime("$value->date_detail $value->h_fin")),
                    'description' => $value->groupe->module->nom_module.' - '.$value->groupe->projet->cfp->nom,
                    'nom_projet' => $value->groupe->projet->nom_projet,
                    'lieu' => $value->lieu,
                    'formation' => $value->groupe->module->formation,
                    'formateur_obj' => $value->formateur,
                    'formateur' => ucfirst($value->formateur->nom_formateur).' '.ucfirst($value->formateur->prenom_formateur),
                    'groupe' => $value->groupe,
                    'groupe_entreprise' => $value->groupe->groupe_entreprise,
                    'participants' => $value->groupe->participants->pluck('stagiaire'),
                    'materiel' => $value->groupe->ressources,

                    // Etabli la relation entre un participant(stagiaire) et son entreprise(entreprise)
                    // La relation 'entreprises' devient en attribut du 'participants' et contient le tableau d'entreprises
                    'participants_entreprises' => $value->groupe->participants->pluck('stagiaire')->pluck('entreprise'),
                    // get all the groupe_entreprise->entreprise as an array of objects
                    // the pluck() method return an array of the specified attribute of each objects
                    'entreprises' => $value->groupe->groupe_entreprise->pluck('entreprise')->toArray(),

                    'sessions' => $value->groupe->detail,
                    'numero_session' => $value->numero_session,
                    // 'duree' => date_diff(strtotime("$value->date_detail $value->h_debut"),strtotime("$value->date_detail $value->h_fin")),
                    'projet' => $value->groupe->projet,
                    'type_formation' => $value->groupe->projet->type_formation,
                    'nom_cfp' => $value->groupe->projet->cfp->nom,
                    'backgroundColor' => $value->color,
                    'borderColor' => $value->color,
                );
            }

            // return( $events);

            // grouping groupe, entreprise, module, projet, formation related to the connected user
            foreach ($participant_groupe as $key => $value) {
                $groupe_entreprises[] = array(
                    'id' => $value->id,
                    'groupe_id' => $value->groupe_id,
                    'groupe' => $value->groupe,
                    'entreprise' => $value->stagiaire->entreprise,
                    'module' => $value->groupe->module,
                    'projet' => $value->groupe->projet,
                    'formation' => $value->groupe->module->formation,
                );

            }


        }



        // return view('admin.calendrier.planning_etp',compact('domaines','formations','statut'));
        return view('admin.calendrier.calendrier_formation',compact('domaines','statut','formations','events', 'groupe_entreprises'));
    }

    // evenements for cfps
    // public function listEvent(Request $request)
    // {
    //     $id_user = Auth::user()->id;
    //     $module = $request->module;
    //     $type_formation = $request->types_formation;
    //     $statut_projet = $request->statut_projet;
    //     $domaines = $request->domaines;
    //     $formations = $request->formations;


    //     if (Gate::allows('isSuperAdmin')) {
    //         $detail = $this->fonct->findAll('v_detailmodule');
    //     }


    //     if (Gate::allows('isCFP')) {
    //         $fonct = new FonctionGenerique();
    //         $rqt = $this->fonct->findWhere('responsables_cfp',['user_id'],[$id_user]);
    //         $cfp_id = $rqt[0]->cfp_id;
    //         // $detail =  $this->fonct->findWhere('v_detailmodule',['cfp_id'],[$cfp_id]);
    //         $detail = DB::select('SELECT details.id as details_id,h_debut,h_fin,date_detail,groupe_id FROM details
    //         INNER JOIN projets ON details.projet_id = projets.id
    //         INNER JOIN groupes ON details.groupe_id = groupes.id
    //         INNER JOIN formateurs ON details.formateur_id = formateurs.id
    //         INNER JOIN cfps ON details.cfp_id = cfps.id
    //         WHERE details.cfp_id = ? order by details.groupe_id
    //         ',[$cfp_id]);

    //         $modules = array();
    //         $formations = array();
    //         for ($i=0; $i < count($detail); $i++) {
    //             array_push($modules,DB::select('select * from groupes inner join modules on groupes.module_id = modules.id where groupes.id = ?',[$detail[$i]->groupe_id]));
    //         }

    //         for ($i=0; $i < count($modules); $i++) {
    //             array_push($formations,DB::select('select * from modules inner join formations on modules.formation_id = formations.id where modules.id = ?',[$modules[$i][0]->id]));
    //         }

    //         // $groupe_entreprise = DB::select('
    //         //     SELECT * FROM groupes
    //         //     INNER JOIN modules ON groupes.module_id = modules.id
    //         //     INNER JOIN type_payement ON groupes.type_payement_id = type_payement.id
    //         //     INNER JOIN status ON groupes.statut_id = status.id
    //         //     INNER JOIN groupe_entreprises
    //         //     WHERE groupes.id =
    //         // ');


    //     }



    //     if (Gate::allows('isFormateur')) {
    //         $formateur_id = formateur::where('user_id', $id_user)->value('id');
    //         $detail = DB::select('SELECT *,details.id as details_id FROM details
    //         INNER JOIN projets ON details.projet_id = projets.id
    //         INNER JOIN groupes ON details.groupe_id = groupes.id
    //         INNER JOIN formateurs ON details.formateur_id = formateurs.id
    //         INNER JOIN cfps ON details.cfp_id = cfps.id
    //         WHERE details.formateur_id = ?
    //         ',[$formateur_id]);

    //         $modules = array();
    //         $formations = array();
    //         for ($i=0; $i < count($detail); $i++) {
    //             array_push($modules,DB::select('select * from groupes inner join modules on groupes.module_id = modules.id where groupes.id = ?',[$detail[$i]->groupe_id]));
    //         }

    //         for ($i=0; $i < count($modules); $i++) {
    //             array_push($formations,DB::select('select * from modules inner join formations on modules.formation_id = formations.id where modules.id = ?',[$modules[$i][0]->id]));
    //         }
    //         // $detail =  $this->fonct->findWhere('v_detailmodule',['formateur_id'],[$formateur_id]);
    //     }

    //     return response()->json(['detail'=>$detail,'modules'=>$modules,'formations'=>$formations]);
    // }

    
    //liste event pour entreprise
//     public function listEvent_entreprise(Request $request){
//         $id_user = Auth::user()->id;


//         if(Gate::allows('isStagiaire')) {
//             dd('here');
//             $stagiaire_id = stagiaire::where('user_id', $id_user)->value('id');

//             $module = $request->module;
//             $type_formation = $request->types_formation;
//             $statut_projet = $request->statut_projet;
//             $domaines = $request->domaines;
//             $formations = $request->formations;


//             $groupe_id = DB::select('SELECT * FROM participant_groupe
//                  WHERE stagiaire_id = ?',[$stagiaire_id]);

//             $groupe_entreprises = array();
//             for ($i=0; $i < count($groupe_id); $i++) {
//                 array_push($groupe_entreprises,DB::select('SELECT * FROM groupe_entreprises
//                 INNER JOIN groupes ON groupe_entreprises.groupe_id = groupes.id
//                 INNER JOIN entreprises ON groupe_entreprises.entreprise_id = entreprises.id
//                 INNER JOIN modules ON groupes.module_id = modules.id
//                 INNER JOIN formations ON modules.formation_id = formations.id
//                 WHERE groupe_entreprises.groupe_id = ?',[$groupe_id[$i]->groupe_id]));
//             }

//             $details = array();
//             $detail_id = array();

//             $details = DB::select('
//                 SELECT  *,details.id as details_id  from details
//                 inner join participant_groupe on details.groupe_id =  participant_groupe.groupe_id
//                 inner join formateurs on details.formateur_id = formateurs.id
//                 inner join projets on details.projet_id = projets.id
//                 inner join type_formations on projets.type_formation_id = type_formations.id
//                 inner join cfps on details.cfp_id = cfps.id
//                 INNER JOIN groupes ON details.groupe_id = groupes.id
//                 INNER JOIN modules ON groupes.module_id = modules.id
//                 INNER JOIN formations ON modules.formation_id = formations.id
//                 where participant_groupe.stagiaire_id = ?',[$stagiaire_id]);

//             for ($i=0; $i < count($groupe_id); $i++) {
//                 array_push($detail_id,DB::select('
//                      SELECT  id as details_id  from details
//                      where details.groupe_id = ?',[$groupe_id[$i]->groupe_id]));
//             }
//             return response()->json(['details'=>$details,'groupe_entreprises'=>$groupe_entreprises,'formations'=>$formations,'detail_id' =>$detail_id]);

//         }



//         if( Gate::allows('isReferent')){

//             $entreprise_id = responsable::where('user_id', $id_user)->value('entreprise_id');
//             $module = $request->module;
//             $type_formation = $request->types_formation;
//             $statut_projet = $request->statut_projet;
//             $domaines = $request->domaines;
//             $formations = $request->formations;

//             $groupe_entreprises = DB::select('SELECT * FROM groupe_entreprises
//                 INNER JOIN groupes ON groupe_entreprises.groupe_id = groupes.id
//                 INNER JOIN entreprises ON groupe_entreprises.entreprise_id = entreprises.id
//                 INNER JOIN modules ON groupes.module_id = modules.id
//                 INNER JOIN formations ON modules.formation_id = formations.id
//                 WHERE groupe_entreprises.entreprise_id = ?',[$entreprise_id]);

//             $details = array();
//             $detail_id = array();
 

//             $details = DB::select('
//                 SELECT  *,details.id as details_id  from details
//                 inner join groupe_entreprises on details.groupe_id =  groupe_entreprises.groupe_id
//                 INNER JOIN groupes ON groupe_entreprises.groupe_id = groupes.id
//                 INNER JOIN entreprises ON groupe_entreprises.entreprise_id = entreprises.id
//                 INNER JOIN modules ON groupes.module_id = modules.id
//                 INNER JOIN formations ON modules.formation_id = formations.id
//                 inner join formateurs on details.formateur_id = formateurs.id
//                 inner join projets on details.projet_id = projets.id
//                 inner join type_formations on projets.type_formation_id = type_formations.id
//                 inner join cfps on details.cfp_id = cfps.id
//                 where groupe_entreprises.entreprise_id = ?',[$entreprise_id]);

// // $entrepise_id = responsable::where('user_id', Auth::user()->id)->entreprise_id;


//             for ($i=0; $i < count($groupe_entreprises); $i++) {
//                 array_push($detail_id,DB::select('
//                      SELECT  id as details_id  from details
//                      where details.groupe_id = ?',[$groupe_entreprises[$i]->groupe_id]));
//             }
//         return response()->json(['details'=>$details,'groupe_entreprises'=>$groupe_entreprises,'formations'=>$formations,'detail_id' =>$detail_id]);

//         }
//     }


    // details sur l'event dans le calendrier
    public function informationModule(Request $request)
    {
        $id = $request->Id;
        // $detail = DB::select(' select statut,date_detail,h_debut,h_fin, detail_id,nom_projet,type_formation,lieu,nom_groupe,groupe_id,type_formation_id,nom_cfp,cfp_id,nom_etp,entreprise_id,photos,logo_entreprise,logo_cfp,nom_formateur,prenom_formateur,mail_formateur,numero_formateur,formateur_id,formation_id,nom_formation,module_id,nom_module  from v_detailmodule where detail_id = ' . $id);
        $detail = DB::select('
            SELECT *,details.id as detail_id FROM details
            inner join formateurs on details.formateur_id = formateurs.id
            inner join cfps on details.cfp_id = cfps.id
            inner join groupes on details.groupe_id = groupes.id
            inner join projets on details.projet_id = projets.id
            inner join type_formations on projets.type_formation_id = type_formations.id
            where details.id = ?',[$id]);
        

        $entreprises = DB::select('
            select * from groupe_entreprises
            inner join entreprises on groupe_entreprises.entreprise_id = entreprises.id
            where groupe_entreprises.groupe_id = ?
            ',[$detail[0]->groupe_id]);
            
        $formations = DB::select('
        select * from groupes
        inner join modules on groupes.module_id = modules.id
        inner join formations on modules.formation_id = formations.id
        where groupes.id = ?
        ',[$detail[0]->groupe_id]);

        $status = DB::select("

                select
                g.status as status_groupe,
                g.date_debut,
                g.date_fin,
                case
                    when g.status = 2 then
                        case
                            when (g.date_fin - curdate()) < 0 then 'Terminé'
                            when (g.date_debut - curdate()) < 0 then 'En cours'
                            else 'A venir' end
                    when g.status = 1 then 'Prévisionnel'
                    when g.status = 0 then 'Créer'end item_status_groupe
            from groupes g
            where g.id =?
        ",[$detail[0]->groupe_id]);

        $stg = DB::select('select * from  v_participant_groupe_detail where detail_id = ' . $id);

        $nombre_stg = DB::select('select count(stagiaire_id) as nombre from v_participant_groupe_detail where detail_id = ?',[$id])[0]->nombre;

        $initial_stg = array();
        //on récupère l'initial
        for ($i=0; $i < count($stg); $i++) {
            array_push($initial_stg,DB::select('select SUBSTRING(nom_stagiaire, 1, 1) AS nm,  SUBSTRING(prenom_stagiaire, 1, 1) AS pr from v_participant_groupe_detail where stagiaire_id =  ?', [$stg[$i]->stagiaire_id ]));
        }
        $id_groupe = $detail[0]->groupe_id;
     
        $date_groupe =  DB::select('select status_groupe,date_detail,h_debut,h_fin,detail_id,nom_projet,type_formation,lieu,nom_groupe,groupe_id,type_formation_id,nom_cfp,cfp_id,nom_etp,entreprise_id,photos,logo_entreprise,logo_cfp,nom_formateur,prenom_formateur,mail_formateur,numero_formateur,formateur_id,formation_id,nom_formation,module_id,nom_module  from v_detailmodule where groupe_id = ' . $id_groupe);
        $ressource = DB::select('select * from ressources where groupe_id =?',[$id_groupe]);

        /**Recuperer duree total de la session */
        $nb_seance = '';
        $info = $this->groupes->infos_session($id_groupe);
        if ($info->difference == null && $info->nb_detail == 0) {
            $nb_seance = $info->nb_detail.' séance , durée totale : '.gmdate("H", $info->difference).' h '.gmdate("i", $info->difference).' m';
        }elseif ($info->difference != null && $info->nb_detail == 1) {
            $nb_seance = $info->nb_detail. ' séance , durée totale : '.gmdate("H", $info->difference).' h '.gmdate("i", $info->difference).' m';
        }elseif ($info->difference != null && $info->nb_detail > 1) {
            $nb_seance = $info->nb_detail. ' séances , durée totale : '.gmdate("H", $info->difference).' h '.gmdate("i", $info->difference).' m';
        }

        //on teste d'abord si le formateur a une photo ou non
        $test_photo_formateur = $detail[0]->photos;

        //recuperation de l'initial
        $photo_form ='';
        if($test_photo_formateur == null){
            $test_photo_formateur = DB::select('select SUBSTRING(nom_formateur, 1, 1) AS nm,  SUBSTRING(prenom_formateur, 1, 1) AS pr from v_detailmodule where groupe_id =  ?', [$id_groupe]);

            $photo_form = 'non';
            // $user = 'users/users.png';
        } else{
            $test_photo_formateur = 'images/formateurs/' . $test_photo_formateur;
            $photo_form = 'oui';
        }

        return response()->json(['ressource'=>$ressource,'nombre_stg'=>$nombre_stg,'nb_seance'=>$nb_seance,'id_detail'=>$id,'formations'=>$formations,'entreprises'=>$entreprises,'status'=>$status[0]->item_status_groupe,'detail' => $detail, 'stagiaire' => $stg, 'date_groupe' => $date_groupe,'initial'=>$test_photo_formateur,'photo_form'=>$photo_form,'initial_stg'=>$initial_stg]);
    }
    //impression
    public function detail_printpdf($id)
    {
        // dd(request()->Id);
        $detail = DB::select('select * from v_detailmodule where detail_id = ' . $id);

        $stg = DB::select('select * from  v_participant_groupe_detail where detail_id = ' . $id);
        $nb_stg = count($stg);
        $id_groupe = $detail[0]->groupe_id;
        $date_groupe =  DB::select('select * from v_detailmodule where groupe_id = ' . $id_groupe);
        $status = DB::select("
        select
        g.status as status_groupe,
        g.date_debut,
        g.date_fin,
        case
            when g.status = 2 then
                case
                    when (g.date_fin - curdate()) < 0 then 'Terminé'
                    when (g.date_debut - curdate()) < 0 then 'En cours'
                    else 'A venir' end
            when g.status = 1 then 'Prévisionnel'
            when g.status = 0 then 'Créer'end item_status_groupe
            from groupes g
            where g.id =?
        ",[$id_groupe]);
        $lieu_formation = DB::select('select lieu from v_detailmodule where groupe_id = ?', [$id_groupe]);
        $ressource = DB::select('select * from ressources where groupe_id =?',[$id_groupe]);
        // dd($ressource);
        if(count($lieu_formation)>0){
            $lieu_formation = explode(',  ',$lieu_formation[0]->lieu);
        }else{
            $lieu_formation[0]='';
            $lieu_formation[1]='';
        }
         /** Recuperer duree total de la session */
         $nb_seance = '';
         $info = $this->groupes->infos_session($id_groupe);

         

         if ($info->difference == null && $info->nb_detail == 0) {
             $nb_seance = $info->nb_detail.' séance , durée totale : '.gmdate("H", $info->difference).' h '.gmdate("i", $info->difference).' m';
         }elseif ($info->difference != null && $info->nb_detail == 1) {
             $nb_seance = $info->nb_detail. ' séance , durée totale : '.gmdate("H", $info->difference).' h '.gmdate("i", $info->difference).' m';
         }elseif ($info->difference != null && $info->nb_detail > 1) {
             $nb_seance = $info->nb_detail. ' séances , durée totale : '.gmdate("H", $info->difference).' h '.gmdate("i", $info->difference).' m';
         }
         $pdf = PDF::loadView('admin.calendrier.detail_pdf', compact('nb_seance','lieu_formation','nb_stg','status','detail', 'stg', 'date_groupe','ressource'));
        //return view('admin.calendrier.detail_pdf' ,compact('nb_seance','status','detail', 'stg','date_groupe','nb_stg','lieu_formation','ressource'));
       return $pdf->download('Detail du projet.pdf');
    }
    //filtre calendrier
    public function rechercheModuleCalendar(Request $request){
        $nom_module = $request->module;
        $resultat = DB::select('select * from v_detailmodule where nom_module = "'.$nom_module.'"');
        return response()->json($resultat);
    }
    /*
    public function index()
    {
        $user_id = Auth::user()->id;
        $cfp_id = Cfp::where('user_id', $user_id)->value('id');
        $fonct = new FonctionGenerique();
        $id = request()->id_session;
        $formateur = Formateur::orderBy('nom_formateur')->get();
        $formation = Formation::orderBy('nom_formation')->get();
        $formation_id = Formation::orderBy('nom_formation')->first()->id;
        $module = Module::orderBy('nom_module')->where('formation_id', $formation_id)->get();
        $projet = $fonct->findWhere("v_projet", ["cfp_id"], [$cfp_id]);
        $entreprise = $fonct->findWhere("v_entreprise_par_projet", ["cfp_id"], [$cfp_id]);
        return view('admin.detail.nouveauDetail', compact('id', 'projet', 'formation', 'module', 'formateur','entreprise'));
    }
*/


    public function index()
    {
        $user_id = Auth::user()->id;
        $cfp_id = cfp::where('user_id', $user_id)->value('id');
        $id = request()->id_session;
        $fonct = new FonctionGenerique();
        $forma = new formateur();

        $formateur1 = $fonct->findWhere("v_demmande_formateur_cfp", ["cfp_id"], [$cfp_id]);
        $formateur2 = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id"], [$cfp_id]);
        $formateur = $forma->getFormateur($formateur1, $formateur2);
        $formation = $fonct->findWhere("formations", ["cfp_id"], [$cfp_id]);
        $projet = $fonct->findWhere("v_projet", ["cfp_id"], [$cfp_id]);
        $entreprise = $fonct->findWhere("v_entreprise_par_projet", ["cfp_id"], [$cfp_id]);

        return view('admin.detail.nouveauDetail', compact('id', 'projet', 'formation', 'formateur', 'entreprise'));
    }


    public function show_projet(Request $req)
    {
        $user_id = Auth::user()->id;
        $cfp_id = cfp::where('user_id', $user_id)->value('id');
        $fonct = new FonctionGenerique();
        $projet = $fonct->findWhere("v_projet", ["cfp_id", "entreprise_id"], [$cfp_id, $req->id]);
        return response()->json($projet);
    }

    public function create()
    {
        $users = Auth::user()->id;
        $fonct = new FonctionGenerique();
        $projet = projet::orderBy('nom_projet')->get();


        if (Gate::allows('isCFP')) {
            // $cfp_id = cfp::where('user_id', $users)->value('id');
            $resp = $fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$users]);
            $cfp_id = $resp->cfp_id;
            $forma = new formateur();

            $datas = $fonct->findWhere("v_detailmodule", ["cfp_id"], [$cfp_id]);
            $liste = $fonct->findWhere("v_entreprise_par_projet", ["cfp_id"], [$cfp_id]);
            $formateur1 = $fonct->findWhere("v_demmande_formateur_cfp", ["cfp_id"], [$cfp_id]);
            $formateur2 = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id"], [$cfp_id]);
            $formateur = $forma->getFormateur($formateur1, $formateur2);

            if (count($datas) <= 0) {
                return view('admin.detail.guide');
            } else {
                return view('admin.detail.detail', compact('formateur', 'datas', 'liste', 'projet'));
            }
        } elseif (Gate::allows('isFormateur')) {
            $form_id = formateur::where('user_id', $users)->value('id');
            $datas = $fonct->findWhere("v_detailmodule", ["formateur_id"], [$form_id]);
            $liste = $fonct->findAll("entreprises");
            return view('admin.detail.detail', compact('datas', 'liste', 'projet'));
        } elseif (Gate::allows('isReferent')) {
            $entreprise_id = responsable::where('user_id', $users)->value('entreprise_id');
            $datas = $fonct->findWhere("v_detailmodule", ["entreprise_id"], [$entreprise_id]);
            return view('admin.detail.detail', compact('datas', 'projet'));
        } elseif (Gate::allows('isStagiaire')) {
            $entreprise_id = stagiaire::where('user_id', $users)->value('entreprise_id');
            $datas = $fonct->findWhere("v_detailmodule", ["entreprise_id"], [$entreprise_id]);
            return view('admin.detail.detail', compact('datas', 'projet'));
        } elseif (Gate::allows('isManager')) {
            $entreprise_id = chefDepartement::where('user_id', $users)->value('entreprise_id');
            $datas = $fonct->findWhere("v_detailmodule", ["entreprise_id"], [$entreprise_id]);
            return view('admin.detail.detail', compact('datas', 'projet'));
        } else {
            return back();
        }

        return view('admin.detail.detail', compact('datas', 'liste', 'projet'));
    }


    public function store(Request $request)
    {
        try{
            $user_id = Auth::user()->id;
            DB::beginTransaction();
            $fonct = new FonctionGenerique();
            $resp = $fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [$user_id]);
            $cfp_id = $resp->cfp_id;
            for ($i = 0; $i < count($request['lieu']); $i++) {
                if($request['lieu'][$i]== null){
                    throw new Exception("Vous devez completer le champ lieu.");
                }
                if($request['formateur'][$i]== null){
                    throw new Exception("Vous devez choisir le formateur.");
                }
                if($request['debut'][$i]== null || $request['fin'][$i] == null){
                    throw new Exception("Vous devez completer l'heure de la scéance.");
                }
                if($request['debut'][$i] >= $request['fin'][$i] ){
                    throw new Exception("L'heure de debut doit être inférieur à l'heure de fin.");
                }
                DB::insert('insert into details(lieu,h_debut,h_fin,date_detail,formateur_id,groupe_id,projet_id,cfp_id) values(?,?,?,?,?,?,?,?)', [$request['lieu'][$i], $request['debut'][$i], $request['fin'][$i], $request['date'][$i], $request['formateur'][$i], $request->groupe, $request->projet, $cfp_id]);
            }
            DB::update('update groupes set status = 1 where id = ?', [$request->groupe]);
            DB::commit();
            return back();
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('detail_error',$e->getMessage());
        }
    }

    public function storeInter(Request $request)
    {
        $user_id = Auth::user()->id;
        $fonct = new FonctionGenerique();
        $resp = $fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [$user_id]);
        $cfp_id = $resp->cfp_id;
        //condition de validation de formulaire
        $request->validate(
            [
                'ville' => ["required"],
                'lieu' => ["required"],
                'debut' => ["required"],
                'fin' => ["required"]
            ],
            [
                'ville.required' => 'Veuillez remplir le champ',
                'lieu.required' => 'Veuillez remplir le champ',
                'debut.required' => 'Veuillez remplir le champ',
                'fin.required' => 'Veuillez remplir le champ'
            ]
        );
        $formateur_id = DB::select('select inviter_formateur_id from demmande_cfp_formateur where demmandeur_cfp_id = ?', [$cfp_id])[0]->inviter_formateur_id;

        for ($i = 0; $i < count($request['lieu']); $i++) {
            DB::insert('insert into details(lieu,h_debut,h_fin,date_detail,formateur_id,groupe_id,projet_id,cfp_id) values(?,?,?,?,?,?,?,?)', [$request['ville'][$i] . ' ' . $request['lieu'][$i], $request['debut'][$i], $request['fin'][$i], $request['date'][$i], $formateur_id, $request->groupe, $request->projet, $cfp_id]);
        }
        DB::update('update groupes set status = 1 where id = ?', [$request->groupe]);
        return back();
    }

    public function show_detail($id)
    {
        $liste = entreprise::orderBy('nom_etp')->get();
        $projet_id = projet::where('entreprise_id', $id)->value('id');
        $datas = detail::orderBy('date_detail')->where('projet_id', $id)->get();
        return view('admin.detail.detail', compact('datas', 'liste'));
    }


    public function show($id)
    {
        $module = module::where('formation_id', $id)->orderBy('Reference')->get();
        return response()->json($module);
    }

    public function edit(Request $request)
    {
        $id = $request->Id;
        $detail = detail::where('id', $id)->with('projet')->get();
        return response()->json($detail);
    }

    public function update(Request $request, $id)
    {
        //modifier les données
        $lieu = $request->lieu;
        $h_debut = $request->debut;
        $h_fin = $request->fin;
        $formateur = $request->formateur;
        $date_detail = $request->date;
        try{
            if($lieu== null){
                throw new Exception("Vous devez completer le champ lieu.");
            }
            if($formateur == null){
                throw new Exception("Vous devez choisir le formateur.");
            }
            if($h_debut == null || $h_fin == null){
                throw new Exception("Vous devez completer l'heure de la scéance.");
            }
            detail::where('id', $id)
            ->update([
                'formateur_id' => $formateur,
                'lieu' => $lieu,
                'h_debut' => $h_debut,
                'h_fin' => $h_fin,
                'date_detail' => $date_detail,
            ]);
            return back();
        }catch(Exception $e){
            return back()->with('detail_error',$e->getMessage());
        }

        // return response()->json(
        //     [
        //         'success' => true,
        //         'message' => 'Data updated successfully',

        //     ]
        // );

    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $detail = detail::find($id);
        $detail->delete();
        return back();
    }
    //affichage date en fonction session
    public function showDate(Request $request)
    {

        $id_groupe = $request->id;
        $date_groupe = groupe::findOrFail($id_groupe);
        return response()->json($date_groupe);
    }
}