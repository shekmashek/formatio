<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cfp extends Model
{
    protected $table="cfps";
    protected $fillable = [
        'Nom','Adresse','Email','Telephone','Domaine_de_formation','NIF','STAT','RCS','CIF','logo','user_id'
    ];
}
