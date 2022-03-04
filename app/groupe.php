<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Groupe extends Model
{
    protected $table = "groupes";
    protected $fillable = [
        'nom_groupe','projet_id','max_participant','min_participant','module_id','date_debut','date_fin','status','activiter'
    ];
    public function projet(){
        return $this->belongsTo('App\projet');
    }

    public function generateNomSession($projet_id){
        $num_projet = DB::select("select max(nom_groupe) as nom_groupe from groupes where projet_id=?",[$projet_id]);
       $num_session = 0;
        if($num_projet[0]->nom_groupe==NULL){
            $num_session=1;
        } else{
            $str = explode(" ",$num_projet[0]->nom_groupe);
            $num_session=intval($str[1])+1;
        }
            $nom_session ="Session ".$num_session;
            return $nom_session;
    }
}
