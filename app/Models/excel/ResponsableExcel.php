<?php

namespace App\Models\excel;

use Illuminate\Database\Eloquent\Model;

class ResponsableExcel extends Model
{
    protected $table = "v_exportresponsable";
    protected $fillable = [
        'nom_resp','prenom_resp','fonction_resp','email_resp','telephone_resp','nom_etp','adresse','email_etp','telephone_etp'
    ];

}
