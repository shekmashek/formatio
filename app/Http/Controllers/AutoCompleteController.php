<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\stagiaire;

class AutoCompleteController extends Controller
{
    public function search()
    {
        return view('admin.search');
    }

    /*
   AJAX request
   */
    public function getStagiaires(Request $request)
    {

        $search = $request->search;

        if ($search == '') {
            $stagiaires = stagiaire::orderby('matricule', 'asc')->select('id', 'matricule')->limit(5)->get();
        } else {
            $stagiaires = stagiaire::orderby('matricule', 'asc')->select('id', 'matricule')->where('matricule', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($stagiaires as $stagiaire) {
            $response[] = array("value" => $stagiaire->id, "label" => $stagiaire->matricule);
        }
        return response()->json($response);
    }
}
