<?php

namespace App\Http\Controllers;

use App\Models\FonctionGenerique;
use Illuminate\Http\Request;
use App\Niveau;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class SalleFormationController extends Controller
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
        $user_id = Auth::user()->id;
        $fonct = new FonctionGenerique();
        $salle = [];
        if(Gate::allows('isCFP')){
            $resp = $fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
            $cfp_id = $resp->cfp_id;
            $domaine = $this->fonct->findAll("domaines");

            $salles = DB::select('select * from salle_formation_of where cfp_id = ?',[$cfp_id]);
            return view('admin.salle_formation.salle_formation', compact('salles','domaine'));
        }
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        try{
            if($request->ville == null){
                throw new Exception('Vous devez completer le champ ville.');
            }
            if($request->salle == null){
                throw new Exception('Vous devez completer le champ salle de formation.');
            }
            $fonct = new FonctionGenerique();
            $resp = $fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id]);
            $cfp_id = $resp->cfp_id;
            DB::insert('insert into salle_formation_of(cfp_id,salle_formation,ville) values(?,?,?)',[$cfp_id,$request->salle,$request->ville]);
            return back();
                // return redirect()->back()->withInput(['tabName'=>'insertion_salle']);
        }catch(Exception $e){
            return back()->with('salle_error', $e->getMessage());
        }
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
        try{
            if($request->salle == null){
                throw new Exception('Vous devez completer le champ salle de formation.');
            }
            if($request->ville == null){
                throw new Exception('Vous devez completer le champ ville.');
            }
            DB::update('update salle_formation_of set salle_formation = ? ,ville = ? where id  = ?',[$request->salle,$request->ville,$id]);
            return back();
        }catch(Exception $e){
            return back()->with('salle_error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        DB::delete('delete from salle_formation_of where id = ?',[$id]);
        return back();
    }
}
