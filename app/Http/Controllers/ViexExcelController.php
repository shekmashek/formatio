<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;

class ViexExcelController extends Controller
{
    //

    public function index(){
        // Excel::create('New file', function($excel) {

        //     $excel->sheet('New sheet', function($sheet) {

        //         $sheet->loadView('teste_view_excel');

        //         // $sheet->unsetView();

        //     });

        // });
        //Excel::shareView('teste_view_excel')->create();
        return view('teste_view_excel');
    }
}
