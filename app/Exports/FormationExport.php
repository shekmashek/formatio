<?php

namespace App\Exports;

use App\Models\excel\ModuleExcel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FormationExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return ModuleExcel::all();
    }

    public function headings():array{

        return ['Reference','Module','Prix(Ar)','Durer(hr)','Formation'];
    }
}
