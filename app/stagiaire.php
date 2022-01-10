<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stagiaire extends Model
{
    protected $table = "stagiaires";
    protected $fillable = [
       'nom_stagiaire','prenom_stagiaire','genre_stagiaire','fonction_stagiaire','mail_stagiaire','telephone_stagiaire','entreprise_id','user_id','photos','departement_id','CIN','date_delivrance','date_naissance','adresse','niv_etude'
    ];
    public function departement(){
        return $this->belongsTo('App\Departement');
    }
    public function entreprise(){
        return $this->belongsTo('App\entreprise');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function checkEmail($email){
        $mail = stagiaire::where("mail_stagiaire",$email)->get();
        if(count($mail)>0){
            return true;
        }else{
            return false;
        }
    }
    public function checkMatricule($matricule){
        $mat = stagiaire::where("matricule",$matricule)->get();
        if(count($mat)>0){
            return true;
        }else{
            return false;
        }
    }
    public function presence(){
        return $this->hasMany(presence::class);
    }
    public function FroidEvaluation() {
        return $this->hasMany(FroidEvaluation::class);
    }
}
