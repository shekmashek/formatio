<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;


class PDFController extends Controller
{

    // generate PDF pour Catalogue de Formation
    public function pagePDF()
    {
        $data = ['title' => 'Laravel 7 Generate PDF From View Example Tutorial'];
        return view('teste',$data);
    }

    public function generatePDF()
    {
        PDF::setOptions([
            "defaultFont" => "Courier",
            "defaultPaperSize" => "a4",
            "dpi" => 130
        ]);

        $data = ['title' => 'Laravel 7 Generate PDF From View Example Tutorial'];
        $pdf = PDF::loadView('teste', $data);

        return $pdf->download('Nicesnippets.pdf');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
