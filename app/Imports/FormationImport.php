<?php

namespace App\Imports;

use App\Module;
use Maatwebsite\Excel\Concerns\ToModel;

class FormationImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Module([
            'nom_module' => $row['nom_module'],
            'formation_id' => $row['formation_id']
        ]);
    }

}
