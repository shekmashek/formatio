<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FonctionGenerique;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->fonct = new FonctionGenerique();
    }
    /**Recuperer les informations de l'utilisateur */
    public function profil($id){
        $employes = $this->fonct->findWhereMulitOne("employers",["user_id"],[$id]);
        return response()->json([
            'info_profil' =>  $employes
        ], 200);
    }
    /**Recuperer liste des collaborateurs */
    public function liste_collaborateur($id){
        $entreprise_id = $this->fonct->findWhereMulitOne("employers",["user_id"],[$id])->entreprise_id;
        $liste_collaborateur = DB::select('select * from employers where user_id != ? and entreprise_id = ?', [$id,$entreprise_id]);
        return response()->json([
            'info_collaborateur' =>  $liste_collaborateur
        ], 200);
    }
    /**Recuperer la liste des projets de l'entreprise */
    public function liste_projet($id){
        $entreprise_id = $this->fonct->findWhereMulitOne("employers",["user_id"],[$id])->entreprise_id;
        $liste_projets = DB::select('select * from groupe_entreprises where entreprise_id = ?', [$entreprise_id]);
        return response()->json([
            'liste_projets' =>  $liste_projets
        ], 200);
    }

    
}
