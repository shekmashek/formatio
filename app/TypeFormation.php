<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeFormation extends Model
{
    protected $table = "type_formations";
    protected $fillable = [
        'id','type_formation',
    ];

    public function projets()
    {
        return $this->hasMany('App\projet', 'type_formation_id');
    }

}
