<?php

namespace App\Exports;

use App\Models\excel\ResponsableExcel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResponsableExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ResponsableExcel::all();
    }

    public function headings():array{

        return ['Nom Responsable','Prenom Pesponable','Poste','Email Responsable','Télephone Responsable','Nom Entreprise','Adresse Entreprise','Email Entreprise','Telephone Entreprise'];
    }
}
