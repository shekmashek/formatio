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
        $fonct = new FonctionGenerique();

        if (Gate::allows('isReferent')) {
            // $user = responsable::where('user_id', $id_user)->value('photos');
            $user = $fonct->findWhereMulitOne(("responsables"),["user_id"],[$id_user])->photos;
            $photo ='';
            if($user == null){
                $user = DB::select('select SUBSTRING(nom_resp, 1, 1) AS nm,  SUBSTRING(prenom_resp, 1, 1) AS pr from responsables where user_id = ?', [$id_user]);
                $photo = 'non';
                // $user = 'users/users.png';
            } else{
                 $user = 'images/responsables/' . $user;
                $photo = 'oui';
            }
            // $user = 'responsables/' . $user;
            return response()->json(['user'=>$user,'photo'=>$photo]);
        }

        if (Gate::allows('isFormateur')) {

            $user = $fonct->findWhereMulitOne(("formateurs"),["user_id"],[$id_user])->photos;
            $photo ='';
            if($user == null){
                $user = DB::select('select SUBSTRING(nom_formateur, 1, 1) AS nm,  SUBSTRING(prenom_formateur, 1, 1) AS pr from formateurs where user_id = ?', [$id_user]);
                $photo = 'non';
                // $user = 'users/users.png';
            } else{
                $user = 'images/formateurs/' . $user;
                $photo = 'oui';
            }
            // google drive image storage $user = 'formateurs/' . $user;
            return response()->json(['user'=>$user,'photo'=>$photo]);
        }
        if (Gate::allows('isManager')) {
            $user = $fonct->findWhereMulitOne(("chef_departements"),["user_id"],[$id_user])->photos;
            $photo ='';
            if($user == null){
                $user = DB::select('select SUBSTRING(nom_chef, 1, 1) AS nm,  SUBSTRING(prenom_chef, 1, 1) AS pr from chef_departements where user_id = ?', [$id_user]);
                $photo = 'non';
                //  $user = 'users/users.png';
            } else{
                $user = 'images/chefDepartement/' . $user;
                $photo = 'oui';
            }

            // $user = 'chefDepartement/' . $user;
            return response()->json(['user'=>$user,'photo'=>$photo]);
        }

        if (Gate::allows('isCFP')) {
            $user = $fonct->findWhereMulitOne(("v_responsable_cfp"),["user_id"],[$id_user])->photos_resp_cfp;
            $photo ='';
            if($user == null){
                $user = DB::select('select SUBSTRING(nom_resp_cfp, 1, 1) AS nm,  SUBSTRING(prenom_resp_cfp, 1, 1) AS pr from v_responsable_cfp where user_id = ?', [$id_user]);
                $photo = 'non';
                // $user = 'users/users.png';
            } else{
                $user = 'images/responsables/' . $user;
                $photo = 'oui';
            }
            // $user = 'CFP/' . $user;
            return response()->json(['user'=>$user,'photo'=>$photo]);
        }
        if (Gate::allows('isStagiaire')) {
            $user = $fonct->findWhereMulitOne(("stagiaires"),["user_id"],[$id_user])->photos;
            $photo ='';
            if($user == null){
                $user = DB::select('select SUBSTRING(nom_stagiaire, 1, 1) AS nm,  SUBSTRING(prenom_stagiaire, 1, 1) AS pr from stagiaires where user_id = ?', [$id_user]);
                $photo = 'non';
                // $user = 'users/users.png';
            } else{
                $user = 'images/stagiaires/' . $user;
                $photo = 'oui';
            }
            // $user = 'stagiaires/' . $user;
            return response()->json(['user'=>$user,'photo'=>$photo]);
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
                $etp = 'entreprises/' . $etp;
            }

            // $etp = 'entreprises/' . $etp;
            return response()->json($etp);
        }

        if (Gate::allows('isCFP')) {
            // $etp = $fonct->findWhereMulitOne("v_responsable_cfp",["substring(user_id,1,1)"],["substring('".$id_user."',1,1)"])->logo_cfp;
            $etp = $fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$id_user])->logo_cfp;

            if($etp == null){
                // $etp = DB::select('SELECT SUBSTRING(prenom_resp_cfp, 1, 1) AS prenom FROM v_responsable_cfp where user_id = ?', [$id_user]);
                $etp = 'users/users.png';
            } else{
                $etp = 'CFP/' . $etp;
            }
            // $etp = 'CFP/' . $etp;
            return response()->json($etp);
        }
        if (Gate::allows('isFormateur')) {

            // $etp_id = Formateur::where('user_id', $id_user)->value('entreprise_id');
            // $etp = entreprise::where('id', $etp_id)->value('logo');
              $etp = $fonct->findWhereMulitOne(("v_demmande_cfp_formateur"),["user_id"],[$id_user])->logo;

            if($etp == null){
                $etp = 'users/users.png';
            } else{
                $etp = 'CFP/' . $etp;
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
