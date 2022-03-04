<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\cfp;
use App\responsable;
use App\Stagiaire;
use App\ChefDepartement;
use App\Formateur;
use App\entreprise;

use App\Models\FonctionGenerique;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }
    public function admin()
    {
        $id_user = Auth::user()->id;
        $id_cfp = cfp::where('user_id', $id_user)->value('id');

        $cfp_etp = DB::select('select COUNT(*) as cfp_etp FROM `demmande_cfp_etp` where demmandeur_cfp_id = ? and activiter = ?', [$id_cfp, 1])[0]->cfp_etp;
        $etp_cfp = DB::select('select COUNT(*) as etp_cfp FROM `demmande_etp_cfp` where inviter_cfp_id = ? and activiter = ?', [$id_cfp, 1])[0]->etp_cfp;
        $entreprise = $etp_cfp + $cfp_etp;

        $projet_en_cours = DB::select('select count(*) as projet_en_cours FROM `projets` where cfp_id = ? and status = ?', [$id_cfp, 'En Cours'])[0]->projet_en_cours;
        $projet_termime = DB::select('select count(*) as projet_termine FROM `projets` where cfp_id = ? and status = ?', [$id_cfp, 'termine'])[0]->projet_termine;
        $projet_a_venir = DB::select('select count(*) as projet_a_venir FROM `projets` where cfp_id = ? and status = ?', [$id_cfp, 'A venir'])[0]->projet_a_venir;
        $projet = DB::select('select count(*) as all_projet from projets where cfp_id =?', [$id_cfp])[0]->all_projet;

        $cfp_formateur = DB::select('select count(*) as cfp_formateur from demmande_cfp_formateur where demmandeur_cfp_id = ? and activiter = ?', [$id_cfp, 1])[0]->cfp_formateur;
        $formateur_cfp = DB::select('select count(*) as formateur_cfp from demmande_formateur_cfp where inviter_cfp_id = ? and activiter = ?', [$id_cfp, 1])[0]->formateur_cfp;
        $formateur = $cfp_formateur + $formateur_cfp;

        return response()->json([$entreprise, $projet_en_cours, $projet_termime, $projet_a_venir, $projet, $formateur]);
    }
    public function admin_etp()
    {
        $id_user = Auth::user()->id;

        $id_etp = responsable::where('user_id', $id_user)->value('id');

        $cfp_etp = DB::select('select COUNT(*) as cfp_etp FROM `demmande_cfp_etp` where inviter_etp_id = ? and activiter = ?', [$id_etp, 1])[0]->cfp_etp;
        $etp_cfp = DB::select('select COUNT(*) as etp_cfp FROM `demmande_etp_cfp` where demmandeur_etp_id = ? and activiter = ?', [$id_etp, 1])[0]->etp_cfp;
        $cfp = $etp_cfp + $cfp_etp;

        $projet_en_cours_etp = DB::select('select count(*) as projet_en_cours FROM `projets` where entreprise_id = ? and status = ?', [$id_etp, 'En Cours'])[0]->projet_en_cours;
        $projet_termime_etp = DB::select('select count(*) as projet_termine FROM `projets` where entreprise_id = ? and status = ?', [$id_etp, 'termine'])[0]->projet_termine;
        $projet_a_venir_etp = DB::select('select count(*) as projet_a_venir FROM `projets` where entreprise_id = ? and status = ?', [$id_etp, 'A venir'])[0]->projet_a_venir;
        $projet_etp = DB::select('select count(*) as all_projet from projets where entreprise_id =?', [$id_etp])[0]->all_projet;

        $stagiaire = DB::select('select count(*) as stagiaire_dans_entreprise from stagiaires where entreprise_id = ?', [$id_etp])[0]->stagiaire_dans_entreprise;

        $manager = DB::select('select count(*) as manager_entreprise from chef_departements where entreprise_id = ?', [$id_etp])[0]->manager_entreprise;

        return response()->json([$cfp, $projet_en_cours_etp, $projet_termime_etp, $projet_a_venir_etp, $projet_etp, $stagiaire, $manager]);
    }
    public function get_name_etp()
    {
        $id_user = Auth::user()->id;

        if (Gate::allows('isReferent')) {
            $etp_id = responsable::where('user_id', $id_user)->value('entreprise_id');
            $etp = DB::select('select *  from entreprises where id=?', [$etp_id]);
            $data["donner"] = $etp[0];
            $data["status"] = "RESP";
            return response()->json($data);
        }
        if (Gate::allows('isManager')) {
            $etp_id = chefDepartement::where('user_id', $id_user)->value('entreprise_id');

            $etp = DB::select('select * from entreprises where id=?', [$etp_id]);
            $data["donner"] = $etp[0];
            $data["status"] = "CHEF";
            return response()->json($data);
        }
        if (Gate::allows('isStagiaire')) {
            $etp_id = stagiaire::where('user_id', $id_user)->value('entreprise_id');
            $etp = DB::select('select * from entreprises where id=?', [$etp_id]);
            $data["donner"] = $etp[0];
            $data["status"] = "STG";
            return response()->json($data);
        }
        if (Gate::allows('isCFP')) {
            $rqt = DB::select('select * from responsables_cfp where user_id = ?', [$id_user]);
            $cfp_id = $rqt[0]->cfp_id;
            $etp = DB::select('select * from cfps where id=?', [$cfp_id]);
            $data["donner"] = $etp[0];
            $data["status"] = "CFP";
            return response()->json($data);
        }

        if (Gate::allows('isFormateur')) {
            $etp_id = formateur::where('user_id', $id_user)->value('entreprise_id');
            $etp = DB::select('select * from entreprises where id=?', [$etp_id]);
            $data["donner"] = $etp[0];
            $data["status"] = "FORMT";
            return response()->json($data);
        }
    }
    public function profile_resp()
    {
        $id_user = Auth::user()->id;

        if (Gate::allows('isReferent')) {
            $user = responsable::where('user_id', $id_user)->value('photos');
            if($user == null){
                $user = 'users/users.png';
            } else{
                $user = 'responsables/' . $user;
            }
            // $user = 'responsables/' . $user;
            return response()->json($user);
        }

        if (Gate::allows('isFormateur')) {
            $user = Formateur::where('user_id', $id_user)->value('photos');
            if($user == null){
                $user = 'users/users.png';
            } else{
                $user = 'formateurs/' . $user;
            }
            // $user = 'formateurs/' . $user;
            return response()->json($user);
        }
        if (Gate::allows('isManager')) {
            $user = ChefDepartement::where('user_id', $id_user)->value('photos');
            if($user == null){
                $user = 'users/users.png';
            } else{
                $user = 'chefDepartement/' . $user;
            }

            // $user = 'chefDepartement/' . $user;
            return response()->json($user);
        }

        if (Gate::allows('isCFP')) {
            $fonct = new FonctionGenerique();
            $user = $fonct->findWhereMulitOne(("v_responsable_cfp"),["user_id"],[$id_user])->photos_resp_cfp;
            if($user == null){
                $user = 'users/users.png';
            } else{
                $user = 'responsables/' . $user;
            }
            // $user = 'CFP/' . $user;
            return response()->json($user);
        }
        if (Gate::allows('isStagiaire')) {
            $user = stagiaire::where('user_id', $id_user)->value('photos');
            if($user == null){
                $user = 'users/users.png';
            } else{
                $user = 'stagiaires/' . $user;
            }
            // $user = 'stagiaires/' . $user;
            return response()->json($user);
        }
    }
    public function logo()
    {
        $fonct = new FonctionGenerique();
        $id_user = Auth::user()->id;
        if (Gate::allows('isManager')) {

            $etp_id = ChefDepartement::where('user_id', $id_user)->value('entreprise_id');

            $etp = entreprise::where('id', $etp_id)->value('logo');

            if($etp == null){
                $etp = 'users/users.png';
            } else{
                $etp = 'entreprises/' . $etp;
            }

            return response()->json($etp);
        }


        if (Gate::allows('isReferent')) {
            $etp_id = responsable::where('user_id', $id_user)->value('entreprise_id');
            $etp = entreprise::where('id', $etp_id)->value('logo');

            if($etp == null){
                $etp = 'users/users.png';
            } else{
                $etp = 'responsables/' . $etp;
            }

            // $etp = 'entreprises/' . $etp;
            return response()->json($etp);
        }

        if (Gate::allows('isCFP')) {

            $etp = $fonct->findWhereMulitOne(("v_responsable_cfp"),["user_id"],[$id_user])->logo_cfp;
            if($etp == null){
                $etp = 'users/users.png';
            } else{
                $etp = 'CFP/' . $etp;
            }
            // $etp = 'CFP/' . $etp;
            return response()->json($etp);
        }
        if (Gate::allows('isFormateur')) {

            $etp_id = Formateur::where('user_id', $id_user)->value('entreprise_id');
            $etp = entreprise::where('id', $etp_id)->value('logo');
            if($etp == null){
                $etp = 'users/users.png';
            } else{
                $etp = 'formateurs/' . $etp;
            }
            // $etp = 'entreprises/' . $etp;
            return response()->json($etp);
        }
        if (Gate::allows('isStagiaire')) {

            $etp_id = stagiaire::where('user_id', $id_user)->value('entreprise_id');

            $etp = entreprise::where('id', $etp_id)->value('logo');
            if($etp == null){
                $etp = 'users/users.png';
            } else{
                $etp = 'stagiaires/' . $etp;
            }
            // $etp = 'entreprises/' . $etp;
            return response()->json($etp);
        }
    }
}
