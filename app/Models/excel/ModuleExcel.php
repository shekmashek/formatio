<?php

namespace App\Models\excel;

use Illuminate\Database\Eloquent\Model;

class ModuleExcel extends Model
{
    protected $table = "v_exportcatalogue";
    protected $fillable = [
        'reference','nom_module','prix','duree','nom_formation'
    ];
}
