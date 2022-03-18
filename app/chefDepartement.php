<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChefDepartement extends Model
{
    protected $table = "chef_departements";
    protected $fillable = [
        'nom_chef','prenom_chef','genre_chef','fonction_chef','mail_chef','telephone_chef','entreprise_id',
        'user_id','photos','departement_id','cin_chef'
    ];

    public function checkEmail($email){
        $mail = chefDepartement::where("mail_chef",$email)->get();
        if(count($mail)>0){
            return true;
        }else{
            return false;
        }
    }
    public function entreprise(){
        return $this->belongsTo('App\entreprise');

    }
    public function departement(){
        return $this->belongsTo('App\Departement');
    }
}
