<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\FonctionGenerique;

class NouveauCompte extends Model
{

    public function insert_CFP($doner, $user_id)
    {
        if($doner["web_cfp"] == null){
            $doner["web_cfp"]=NULL;
        }
        $data = [
            $doner["logo_cfp"], $doner["nom_cfp"], $doner["ville"],
            $doner["email_cfp"], $doner["tel_cfp"], $doner["web_cfp"],
            $doner["nif"], $doner["rue"],
            $doner["quartier"], $doner["region"], $doner["code_postal"], $user_id
        ];

        DB::insert('insert into cfps(logo,nom,adresse_ville,email,telephone,site_cfp,nif,adresse_lot,adresse_quartier,adresse_region,adresse_code_postal,created_at,user_id) values (?,?,?,?,?,?,?,?,?,?,?,NOW(),?)', $data);
        DB::commit();

        // insert into cfps(logo,nom,adresse_ville,email,telephone,site_cfp,nif,adresse_lot,adresse_quartier,adresse_code_postal,adresse_region,created_at,user_id) values ('noam_cfp','Numerika Center','Tana','antoenjara1998@gmail.com','0328683700','ituniversity.com','1324567897865434','Analamahitsy','Q-analamahitsy','s','43','NOW()','41');
    }


    public function insert_resp_CFP($doner, $cfp_id, $user_id)
    {
        $data = [
            $doner["nom_resp"], $doner["prenom_resp"], $doner["sexe_resp"],
            $doner["dte_naissance_resp"], $doner["cin_resp"], $doner["email_resp"], $doner["tel_resp"], $doner["fonction_resp"],
            $cfp_id, $user_id
        ];
        DB::insert('insert into responsables_cfp(nom_resp_cfp,prenom_resp_cfp,sexe_resp_cfp,date_naissance_resp_cfp,cin_resp_cfp,email_resp_cfp,telephone_resp_cfp,fonction_resp_cfp
        ,cfp_id,user_id,activiter,created_at) values(?,?,?,?,?,?,?,?,?,?,1,NOW())', $data);
        DB::commit();
    }


    public function insert_ETP($doner)
    {
        if($doner["web_etp"] == null){
            $doner["web_etp"]=NULL;
        }
        $data = [
            $doner["nom_etp"], $doner["rue"], $doner["quartier"],
            $doner["ville"], $doner["region"], $doner["email_etp"], $doner["tel_etp"], $doner["web_etp"],
            $doner["nif"], $doner["stat"], $doner["rcs"], $doner["cif"], $doner["logo_etp"], $doner["code_postal"],$doner["secteur_id"]
        ];

        DB::insert('insert into entreprises(nom_etp,adresse_rue,adresse_quartier,adresse_ville,adresse_region,email_etp,telephone_etp,site_etp,nif,stat,rcs,cif,logo,adresse_code_postal,created_at,secteur_id) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?, NOW(),?)', $data);
        DB::commit();
    }
    public function insert_resp_ETP($doner, $entreprise_id, $user_id)
    {
        $data = [
            $doner["nom_resp"], $doner["prenom_resp"], $doner["sexe_resp"],
            $doner["dte_naissance_resp"], $doner["cin_resp"], $doner["email_resp"], $doner["tel_resp"], $doner["fonction_resp"],
            $entreprise_id, $user_id
        ];
        DB::insert('insert into responsables(nom_resp,prenom_resp,sexe_resp,date_naissance_resp,cin_resp,email_resp,telephone_resp,fonction_resp
        ,entreprise_id,user_id,activiter,created_at) values(?,?,?,?,?,?,?,?,?,?,1,NOW())', $data);
        DB::commit();
    }
    //     $data=[$doner["nom_resp"],$doner["prenom_resp"],$doner["sexe_resp"],
    //     $doner["dte_naissance_resp"],$doner["cin_resp"],$doner["email_resp"],$doner["tel_resp"],$doner["fonction_resp"],
    //     $doner["poste_resp"],$doner["departement_resp"],$doner["rue_resp"],$doner["quartier_resp"],$doner["poste_resp"],$doner["lot_resp"],$doner["ville_resp"],
    //     $doner["region_resp"],$doner["photo_resp"],$entreprise_id,$user_id
    // ];
    //     DB::insert('insert into responsables(nom_resp,prenom_resp,sexe_resp,date_naissance_resp,cin_resp,email_resp,telephone_resp,fonction_resp,poste_resp,departement_id,adresse_rue,adresse_quartier,
    //     adresse_code_postal,adresse_lot,adresse_ville,adresse_region,photos,entreprise_id,user_id,activiter,created_at) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,1,NOW())',$data);
    //     DB::commit();
    // }

    public function verify_cfp($nom, $mail)
    {
        $dta = DB::select('select * from cfps WHERE UPPER(nom)=UPPER(?) OR email=?', [$nom, $mail]);
        return $dta;
    }
    public function verify_NIF_cfp($nif)
    {
        $dta = DB::select('select * from cfps WHERE UPPER(nif)=UPPER(?)', [$nif]);
        return $dta;
    }

    public function verify_NIF_etp($nif)
    {
        $dta = DB::select('select * from entreprises WHERE UPPER(nif)=UPPER(?)', [$nif]);
        return $dta;
    }
    public function verify_etp($nom, $mail)
    {
        $dta = DB::select('select * from entreprises WHERE UPPER(nom_etp)=UPPER(?) OR email_etp=?', [$nom, $mail]);
        return $dta;
    }

    public function verify_resp($email, $tel)
    {
        $data = DB::select('select * from responsables where email_resp=? OR telephone_resp=?', [$email, $tel]);
        return $data;
    }

    public function search_etp($nom_etp)
    {
        $data = DB::select('select * from entreprises WHERE UPPER(nom_etp) LIKE UPPER("%' . $nom_etp . '%")');
        return $data;
    }

public function verify_cin_user($valiny){
    $data = DB::select('select * from users WHERE cin =?',[$valiny]);
    return $data;
}

public function verify_tel_user($valiny){
    $data = DB::select('select * from users WHERE telephone =?',[$valiny]);
    return $data;
}

public function verify_mail_user($valiny){
    $data = DB::select('select * from users WHERE email =?',[$valiny]);
    return $data;
}


}
