<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\FonctionGenerique;

class NouveauCompte extends Model
{

    public function insert_CFP($doner,$user_id){
        $data=[$doner["nom_cfp"],$doner["domaine_cfp"],$doner["lot"],
        $doner["ville"],$doner["region"],$doner["email_cfp"],$doner["tel_cfp"],$doner["web_cfp"],
        $doner["nif"],$doner["stat"],$doner["rcs"],$doner["cif"],$user_id
    ];

        DB::insert('insert into cfps(nom,domaine_de_formation,adresse_lot,adresse_ville,adresse_region,email,telephone,site_cfp,created_at, updated_at,nif,stat,rcs,cif,user_id) values (?,?,?,?,?,?,?,?, NOW(), NOW(),?,?,?,?,?)', $data);
        DB::commit();
    }

    public function insert_Responsable($doner,$entreprise_id,$user_id){
            $data=[$doner["nom_resp"],$doner["prenom_resp"],$doner["function_resp"],
            $doner["email_resp"],$doner["tel_resp"],$entreprise_id,$user_id
        ];
        DB::insert('insert into responsables(nom_resp,prenom_resp,fonction_resp,email_resp,telephone_resp,created_at, updated_at,entreprise_id,user_id,photos) values (?,?,?,?,?, NOW(), NOW(),?,?,"AAAA")', $data);
        DB::commit();
    }

    public function verify_cfp($nom,$mail){
        $dta = DB::select('select * from cfps WHERE UPPER(nom)=UPPER(?) OR email=?',[$nom,$mail]);
        return $dta;
    }

    public function verify_resp($email,$tel){
        $data = DB::select('select * from responsables where email_resp=? OR telephone_resp=?',[$email,$tel]);
        return $data;
    }

    public function search_etp($nom_etp){
        // dd('select * from v_exportresponsable WHERE UPPER(nom_etp) LIKE UPPER("%'.$nom_etp.'%")');

        // $data = DB::select('select * from v_responsables WHERE UPPER(nom_etp) LIKE UPPER("%'.$nom_etp.'%")');
        $data = DB::select('select * from entreprises WHERE UPPER(nom_etp) LIKE UPPER("%'.$nom_etp.'%")');

        // $data = DB::select('select * from v_responsables');

        return $data;
    }



    // public function verify_resp($entreprise_id,$data){
    //     $fonct = new FonctionGenerique();
    //     $verify = DB::select('select * from responsables email_resp=? OR tel=?',[$data["email_resp"],$data["tel_resp"]]);
    //    if(count($verify)<=0){
    //     $resp = $fonct->findWhere("responsables",["entreprise_id"],[$entreprise_id]);
    //     if(count($resp)<=0){

    //     } else{}
    //    } else{
    //     return back()->with('error','information invalid');
    //    }

    // }


}
