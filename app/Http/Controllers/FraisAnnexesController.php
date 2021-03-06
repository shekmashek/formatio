<?php

namespace App\Http\Controllers;

use App\ChefDepartement;
use App\Models\FonctionGenerique;
use Illuminate\Http\Request;
use App\Niveau;
use App\responsable;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class FraisAnnexesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
        $this->fonct = new FonctionGenerique();
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $fonct = new FonctionGenerique();
        $salle = [];
        $etp_id = $this->fonct->findWhereMulitOne("employers",["user_id"],[$user_id]);
        $frais = DB::select('select * from frais_annexe_etp where entreprise_id = ?',[$etp_id->entreprise_id]);
        return view('admin.frais_annexe.frais_annexe', compact('frais'));

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        try{
            $etp_id = $this->fonct->findWhereMulitOne("employers",["user_id"],[$user_id]);
            if($request->description == null){
                throw new Exception('Vous devez completer le champ description.');
            }
            DB::insert('insert into frais_annexe_etp(description,entreprise_id) values(?,?)',[$request->description,$etp_id->entreprise_id]);
            return back();
                // return redirect()->back()->withInput(['tabName'=>'insertion_salle']);
        }catch(Exception $e){
            return back()->with('frais_error', $e->getMessage());
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
            if($request->description == null){
                throw new Exception('Vous devez completer le champ description.');
            }
            DB::update('update frais_annexe_etp set description = ? where id  = ?',[$request->description,$id]);
            return back();
        }catch(Exception $e){
            return back()->with('salle_error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        DB::delete('delete from frais_annexe_etp where id = ?',[$id]);
        return back();
    }
}
