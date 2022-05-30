<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Niveau;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NiveauController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }
    public function index()
    {
        $niveau = Niveau::all();
        return view('admin.niveau.niveau', compact('niveau'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'niveau' => ["required"]
            ],
            [
                'niveau.required' => 'Veuillez remplir le champ'
            ]
        );
        $niveau = new Niveau();
        $niveau->niveau = $request->niveau;
        $niveau->save();
        return back();
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
        // $niveau = Niveau::find($id);
        // $niveau->delete();
        DB::delete('delete from niveaux where id = ?', [$id]);
        return back();
    }

    public function getNiveaux()
    {
        $niveaux = Niveau::all();
        return response()->json($niveaux);
    }


}
