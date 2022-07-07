<?php

namespace App\Http\Controllers;

use App\Models\FonctionGenerique;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalleFormationEtpController extends Controller
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
        $user_id = Auth::user()->id;
        $entreprise_id = $fonct->findWhereMulitOne("employers",["user_id"],[$user_id])->entreprise_id;
        $salles = DB::select('select * from salle_formation_etp where etp_id = ?',[$entreprise_id]);
        return view('admin.salle_formation.salle_formation_etp', compact('salles'));
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
            $user_id = Auth::user()->id;
            $entreprise_id = $fonct->findWhereMulitOne("employers",["user_id"],[$user_id])->entreprise_id;
            DB::insert('insert into salle_formation_etp(etp_id,salle_formation,ville) values(?,?,?)',[$entreprise_id,$request->salle,$request->ville]);
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
            DB::update('update salle_formation_etp set salle_formation = ? ,ville = ? where id  = ?',[$request->salle,$request->ville,$id]);
            return back();
        }catch(Exception $e){
            return back()->with('salle_error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        DB::delete('delete from salle_formation_etp where id = ?',[$id]);
        return back();
    }
}
