<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        DB::insert('insert into responsables(nom_resp,prenom_resp,fonction_resp,email_resp,telephone_resp,created_at, updated_at,entreprise_id,user_id) values (?,?,?,?,?, NOW(), NOW(),?,?)', $data);
        DB::commit();
    }


}
