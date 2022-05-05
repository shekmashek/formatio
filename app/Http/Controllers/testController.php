<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class testController extends Controller
{
    public function filtrereferent(){
        $referents = DB::select('select id,genre_id,
        case when genre_id = 1 then "Femme" when genre_id = 2 then "Homme" end 
        sexe_resp,photos,matricule,nom_resp,prenom_resp,
        fonction_resp,email_resp,telephone_resp,cin_resp,
        entreprise_id,prioriter,user_id,url_photo, 
        SUBSTRING(prenom_resp, 1, 1) AS pr, 
        SUBSTRING(nom_resp, 1, 1) AS nm from responsables 
        where entreprise_id = ? and prioriter=false', [1]);

    $referents = DB::table('users')
        ->join('v_role_user_etp_referent', 'v_role_user_etp_referent.user_id', 'users.id')
        ->join('responsables', 'responsables.user_id', 'users.id')
        ->join('entreprises', 'entreprises.id', 'responsables.entreprise_id')
        ->select('responsables.entreprise_id' ,'telephone_resp' ,'role_name', 
        'matricule', 
        'nom_resp', 'prenom_resp',
            'role_id', 'email_resp', 'photos',
            'responsables.user_id', 'fonction_resp', 
            'users.name', 'users.telephone', 'users.email')
        // ->where('stagiaires.entreprise_id', '=', $etp_id)
        // ->where('nom_stagiaire', 'like', '%'.$request->get('name').'%')
        // ->orWhere('matricule', 'like', '%'.$request->get('name').'%')
        ->get();
        dd($referents);
    }
}
