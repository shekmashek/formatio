<?php

namespace App\Exports;

use App\Models\excel\ParticipantExcel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParticipantExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ParticipantExcel::all();
    }

    public function headings():array{

        return ['Matricule','Nom Stagiaire','Prenom Stagiaire','Genre','Post','Email','Télephone','Nom Entreprise','Adresse Entreprise','Email Entreprise','Telephone Entreprise'];
    }
}
