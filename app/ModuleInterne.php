<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleInterne extends Model
{
    protected $table = "modules_interne";

    protected $fillable = [
        'id', 'nom_module', 'formation_interne_id', 'status', 'activiter'
    ];

    public function formation_interne()
    {
        return $this->belongsTo('App\FormationInterne', 'formation_interne_id');
    }

}
