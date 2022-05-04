<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class testController extends Controller
{
    public function filtrereferent(){
        $referents = Responsable::select('id,genre_id,case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end sexe_resp,photos,matricule,nom_resp,prenom_resp,fonction_resp,email_resp,telephone_resp,cin_resp,entreprise_id,prioriter,user_id,url_photo, SUBSTRING(prenom_resp, 1, 1) AS pr, SUBSTRING(nom_resp, 1, 1) AS nm from responsables where entreprise_id = 1 and prioriter=false')
           ;
        // $role = DB::table('users')
        //         ->join('v_role_user_etp_stg', 'v_role_user_etp_stg.user_id', 'users.id')
        //         ->join('stagiaires', 'stagiaires.user_id', 'v_role_user_etp_stg.user_id')
        //         ->select('telephone_stagiaire' ,'role_name', 'matricule', 'nom_stagiaire', 'prenom_stagiaire',
        //             'role_id', 'mail_stagiaire', 'photos',
        //             'stagiaires.user_id', 'fonction_stagiaire', 
        //             'users.name', 'users.telephone', 'users.email')
        //         ->get();
        dd($referents);
    }
}
