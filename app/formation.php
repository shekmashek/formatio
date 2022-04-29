<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\FonctionGenerique;

class Formation extends Model
{
    protected $table = "formations";
    protected $fillable = [
        'id','nom_formation','cfp_id','domaine_id','formation_id'
    ];
    public function domaine(){
        return $this->belongsTo('App\Domaine');
    }
    public function categories_formation(){
        return $this->belongsTo('App\categories_formation');
    }

    public function queryWhere_entiter($nomTab, $para_col, $nom_entiter)
    {
        $query = "SELECT ( COUNT(".$para_col.")) totale FROM " . $nomTab . " WHERE  " . $para_col . " LIKE '%" . $nom_entiter . "%'";
            return $query;
    }

    public function getNbPagination_entiter($para_col, $nom_entiter)
    {
        $data =  DB::select($this->queryWhere_entiter("cfps", $para_col, $nom_entiter));
        return $data[0];
    }

    public function nb_entiter_pagination($nom_entiter,$nbPagination,$nbLimit)
    {
        $fonct = new FonctionGenerique();

        $totaleData = $this->getNbPagination_entiter("nom",$nom_entiter);
        $pagination = $fonct->nb_liste_pagination($totaleData->totale,  $nbPagination,$nbLimit);
        return $pagination;
    }

}
