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


    
    public function service ()
    {
        return $this->belongsTo('App\Service', 'service_id');
    }



    public function entreprise()
    {
        return $this->belongsTo('App\Entreprise', 'entreprise_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function niveau_etude(){
        return $this->hasOne(Niveau::class, 'niveau_etude_id');
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
        DB::insert('insert into stagiaires (matricule,nom_stagiaire,prenom_stagiaire,cin,mail_stagiaire,entreprise_id,user_id,created_at) values (?,?,?,?,?,?,?,NOW())', $data);
        DB::commit();
    }

    
    public function desactiver($user_id, $emp_id,$entreprise_id){
        DB::update("UPDATE stagiaires SET activiter=FALSE WHERE user_id=? AND id=? AND entreprise_id=?",[$user_id, $emp_id,$entreprise_id]);
        return ["status" =>"activer"];
    }
    public function activer($user_id, $emp_id,$entreprise_id){
        DB::update("UPDATE stagiaires SET activiter=TRUE WHERE user_id=? AND id=? AND entreprise_id=?",[$user_id, $emp_id,$entreprise_id]);
        return ["status" =>"desactiver"];
    }
}
