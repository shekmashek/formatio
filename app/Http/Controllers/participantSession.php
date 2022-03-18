<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\detail;
use App\projet;
use App\stagiaire;
use App\entreprise;

class participantSession extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
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

    public function show()
    {
        $id = request()->id_detail;
        $detail = detail::where('id', $id)->get();
        $id_groupe = detail::where('id', $id)->value('groupe_id');
        $id_projet = detail::where('id', $id)->value('projet_id');
        $id_etp = projet::where('id', $id_projet)->value('entreprise_id');
        $nom_etp = entreprise::where('id', $id_etp)->value('nom_etp');
        $stagiaire = stagiaire::where('entreprise_id', $id_etp)->get();

        $date_horaire_formation = detail::where([
            'projet_id' => $id_projet,
            'groupe_id' => $id_groupe
        ])->get();
        $nb_meme_horaire = detail::where([
            'projet_id' => $id_projet,
            'groupe_id' => $id_groupe
        ])->count();

        return view('admin.execution.liste_execution', compact('stagiaire', 'detail', 'nom_etp', 'date_horaire_formation', 'nb_meme_horaire'));
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
