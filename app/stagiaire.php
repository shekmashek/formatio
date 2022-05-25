<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\FonctionGenerique;

class Stagiaire extends Model
{
    protected $table = "stagiaires";
    protected $fillable = [
        'nom_stagiaire', 'prenom_stagiaire', 'genre_stagiaire', 'fonction_stagiaire', 'mail_stagiaire', 'telephone_stagiaire', 'entreprise_id', 'user_id', 'photos', 'service_id', 'cin', 'date_delivrance', 'date_naissance', 'adresse', 'niv_etude'
    ];
    public function departement()
    {
        return $this->belongsTo('App\Departement');
    }

    public function entreprise()
    {
        return $this->belongsTo('App\entreprise');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function checkEmail($email)
    {
        $mail = stagiaire::where("mail_stagiaire", $email)->get();
        if (count($mail) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function checkMatricule($matricule)
    {
        $mat = stagiaire::where("matricule", $matricule)->get();
        if (count($mat) > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function presence()
    {
        return $this->hasMany(presence::class);
    }
    public function FroidEvaluation()
    {
        return $this->hasMany(FroidEvaluation::class);
    }

    // insert multi stagiaire

    public function insert_multi($doner, $user_id,$entreprise_id)
    {
        $data = [
            $doner["matricule"],$doner["nom"],$doner["prenom"],$doner["cin"],$doner["email"],
            $entreprise_id,$user_id
        ];
        DB::insert("insert into employers(matricule_emp,nom_emp,prenom_emp,cin_emp,email_emp,entreprise_id,user_id,activiter,created_at,genre_id) values(?,?,?,?,?,?,?,1,NOW(),1)", $data);

        // DB::insert('insert into stagiaires (matricule,nom_stagiaire,prenom_stagiaire,cin,mail_stagiaire,entreprise_id,user_id,created_at) values (?,?,?,?,?,?,?,NOW())', $data);
        DB::commit();
    }

    public function desactiver($user_id, $emp_id,$entreprise_id){
        DB::update("UPDATE employers SET activiter=FALSE WHERE user_id=? AND id=? AND entreprise_id=?",[$user_id, $emp_id,$entreprise_id]);
        return ["status" =>"activer"];
    }
    public function activer($user_id, $emp_id,$entreprise_id){
        DB::update("UPDATE employers SET activiter=TRUE WHERE user_id=? AND id=? AND entreprise_id=?",[$user_id, $emp_id,$entreprise_id]);
        return ["status" =>"desactiver"];
    }

    //========================= liste des employer

    public function getEmployer($employers){
        $fonct = new FonctionGenerique();
        $ep_avec_role_ref_connected = $fonct->findWhere("v_employers_as_role_referent", ["entreprise_id", "id"], [$employers->entreprise_id, $employers->id]);
        if (count($ep_avec_role_ref_connected) > 0) {
            if ($ep_avec_role_ref_connected[0]->prioriter_role_user == true) {
                $employers->role_referent_prioriter = true;
            } else {
                $employers->role_referent_prioriter = false;
            }
            $employers->role_referent_activiter = $ep_avec_role_ref_connected[0]->activiter_role_user;
            $employers->role_referent_exist = true;
        } else {
            $employers->role_referent_prioriter = false;
            $employers->role_referent_exist = false;
            $employers->role_referent_activiter = false;
        }

        return $employers;
    }
}
