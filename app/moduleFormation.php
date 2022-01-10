<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleFormation extends Model
{
    protected $table = "moduleFormation";
    protected $fillable = [
        'module_id','reference','nom_module','prix','duree','formation_id','nom_formation'
    ];
    public function formation(){
        return $this->belongsTo('App\formation');
    }
}
