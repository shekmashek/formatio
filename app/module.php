<?php

namespace App;

use App\Models\FonctionGenerique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Module extends Model
{
    protected $table = "modules";
    protected $fillable = [
        'id','nom_module','formation_id'
    ];
    public function formation(){
        return $this->belongsTo('App\formation', 'formation_id');
    }
    public function Niveau(){
        return $this->belongsTo('App\Niveau');
    }

    public function getInfo_programme(){
        $tab =  DB::select('select * from v_programme');
        return $tab;
    }

    public function list_export_excel(){
        $tab = DB::select('SELECT reference,nom_module,prix,duree,nom_formation FROM v_exportcatalogue');
        return $tab;
    }

    public function findAll(){
        $fonction = new FonctionGenerique();
        return $fonction->findAll($this->table);
    }


    public function selectDataHTML($id=[]){
        $para=['formation_id'];
        $fonction = new FonctionGenerique();
        $data=[];
        $modules = $fonction->findWhere('modules',['formation_id'],$id);
        foreach($modules as $result){
            $data[$result->id] = $result->nom_module;
        }
        return $data;
    }

}
