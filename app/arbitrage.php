<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class arbitrage extends Model
{
    protected $table="arbitrage";
    protected $fillable = [
        'departement','service','thematique','cout','stagiaire_id','Plan_id','besoin_id',
    ];
}
