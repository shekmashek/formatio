<?php

namespace App\Models;

use App\Responsable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FonctionGenerique extends Model
{
    // sql generique
    public function queryWhereVerify($nomTab, $para = [], $val = [])
    {
        $query = "SELECT COUNT(id) id FROM " . $nomTab . " WHERE ";
        if (count($para) != count($val)) {
            return "ERROR: taille de donnees parametre et value est different";
        } else {
            for ($i = 0; $i < count($para); $i++) {
                $query .= "" . $para[$i] . "= ?";
                if ($i + 1 < count($para)) {
                    $query .= " AND ";
                }
            }
            return $query;
        }
    }

    public function queryWhereParam($nomTab, $para = [], $opt = [], $val = [])
    {
        $query = "SELECT * FROM " . $nomTab . " WHERE ";
        if (count($para) != count($val)) {
            return "ERROR: taille de donnees parametre et value est different";
        } else {
            for ($i = 0; $i < count($para); $i++) {
                $query .= "" . $para[$i] . "" . $opt[$i] . " ?";
                if ($i + 1 < count($para)) {
                    $query .= " AND ";
                }
            }
            return $query;
        }
    }

    public function queryWhereParamOr($nomTab, $para = [], $opt = [], $val = [])
    {
        $query = "SELECT * FROM " . $nomTab . " WHERE ";
        if (count($para) != count($val)) {
            return "ERROR: taille de donnees parametre et value est different";
        } else {
            for ($i = 0; $i < count($para); $i++) {
                $query .= "" . $para[$i] . "" . $opt[$i] . " ?";
                if ($i + 1 < count($para)) {
                    $query .= " OR ";
                }
            }
            return $query;
        }
    }

    public function queryWhere($nomTab, $para = [], $val = [])
    {
        $query = "SELECT * FROM " . $nomTab . " WHERE ";
        if (count($para) != count($val)) {
            return "ERROR: taille des donnees parametre et value est different";
        } else {
            for ($i = 0; $i < count($para); $i++) {
                $query .= "" . $para[$i] . "= ?";
                if ($i + 1 < count($para)) {
                    $query .= " AND ";
                }
            }
            return $query;
        }
    }

    public function queryWhereOr($nomTab, $para = [], $val = [])
    {
        $query = "SELECT * FROM " . $nomTab . " WHERE ";
        if (count($para) != count($val)) {
            return "ERROR: taille de donnees parametre et value est different";
        } else {
            for ($i = 0; $i < count($para); $i++) {
                $query .= "" . $para[$i] . "= ?";
                if ($i + 1 < count($para)) {
                    $query .= " OR ";
                }
            }
            return $query;
        }
    }

    public function queryWherePagination($nomTab, $para = [], $val = [])
    {
        $query = "SELECT * FROM " . $nomTab . " WHERE ";
        if (count($para) != count($val)) {
            return "ERROR: taille de donnees parametre et value est different";
        } else {
            for ($i = 0; $i < count($para); $i++) {
                $query .= "" . $para[$i] . "= '" . $val[$i] . "'";
                if ($i + 1 < count($para)) {
                    $query .= " AND ";
                }
            }
            return $query;
        }
    }

    //select colonne/* from table where value =  ... => tableau
    public function findWhere($nomTab, $para = [], $val = [])
    {
        $fonction = new FonctionGenerique();
        // echo $fonction->queryWhere($nomTab,$para,$val);
        $data =  DB::select($fonction->queryWhere($nomTab, $para, $val), $val);
        return $data;
    }

    public function findWhereParam($nomTab, $para = [], $opt = [], $val = [])
    {
        $fonction = new FonctionGenerique();
        // echo $fonction->queryWhere($nomTab,$para,$val);
        $data =  DB::select($fonction->queryWhereParam($nomTab, $para, $opt, $val), $val);
        return $data;
    }

    public function findWhereParamOr($nomTab, $para = [], $opt = [], $val = [])
    {
        $fonction = new FonctionGenerique();
        // echo $fonction->queryWhere($nomTab,$para,$val);
        $data =  DB::select($fonction->queryWhereParamOr($nomTab, $para, $opt, $val), $val);
        return $data;
    }
    //select colonne/* from table where value =  ... or  => tableau

    public function findWhereOr($nomTab, $para = [], $val = [])
    {
        $fonction = new FonctionGenerique();
        // echo $fonction->queryWhere($nomTab,$para,$val);
        $data =  DB::select($fonction->queryWhereOr($nomTab, $para, $val), $val);
        return $data;
    }


    //select colonne/* from table where value =  ... => une seule données
    public function findWhereMulitOne($nomTab, $para = [], $val = [])
    {
        $fonction = new FonctionGenerique();
        $data =  DB::select($fonction->queryWhere($nomTab, $para, $val), $val);
        if (count($data) <= 0) {
            return $data;
        } else {
            return $data[0];
        }
    }

    public function verifyGenerique($nomTab, $para = [], $val = [])
    {
        $fonction = new FonctionGenerique();
        $data =  DB::select($fonction->queryWhereVerify($nomTab, $para, $val), $val);
        return $data[0];
    }

    //select * from

    public function findAll($nomTab)
    {
        $query = "SELECT * FROM " . $nomTab;
        return DB::select($query);
    }


    public function findAllPagination($nomTab, $nom_id, $dernier_id, $nbPage)
    {
        if ($dernier_id <= 0) {
            $dernier_id = 1;
        }
        $query = "SELECT * FROM " . $nomTab . " WHERE " . $nom_id . ">=" . $dernier_id . " LIMIT " . $nbPage;
        return DB::select($query);
    }

    public function findWherePagination($nomTab, $para = [], $val = [], $nbDebutPagination, $nbPage, $col_order_by, $order)
    {
        $fonction = new FonctionGenerique();
        $query = $fonction->queryWherePagination($nomTab, $para, $val);
        if ($nbDebutPagination <= 0) {
            $nbDebutPagination = 0;
        } else {
            $nbDebutPagination = $nbDebutPagination - 1;
        }
        $query = $query . " ORDER BY " . $col_order_by . "  " . $order;
        $query = $query . " LIMIT " . $nbPage . " OFFSET " . $nbDebutPagination;
        //    dd($query);
        $data =  DB::select($query);
        return $data;
    }


    public function findAllQuery($query)
    {
        return DB::select($query);
    }

    public function findWhereOne($nomTab, $para, $opt, $val)
    {
        $query = "SELECT * FROM " . $nomTab . " WHERE " . $para . " " . $opt . "?";
        $data =  DB::select($query, [$val]);
        if (count($data) <= 0) {
            return $data;
        } else {
            return $data[0];
        }
    }

    public function findById($nomTab, $id)
    {
        $query = "SELECT * FROM " . $nomTab . " WHERE id=?";
        $data = DB::select($query, [$id]);
        if (count($data) <= 0) {
            return $data;
        } else {
            return $data[0];
        }
    }
    public function concatTwoList($etp1, $etp2)
    {
        $tab = array();
        for ($i = 0; $i < count($etp1); $i += 1) {
            $tab[] = $etp1[$i];
        }
        for ($j = 0; $j < count($etp2); $j += 1) {
            $tab[] = $etp2[$j];
        }

        return $tab;
    }



    // ---------------------------------------- Collaboration
    public function getIdCollaborer($list)
    {
        $tab = array();
        for ($i = 0; $i < count($list); $i += 1) {
            $tab[$i] = "" . $list[$i]->cfp_id;
        }

        return $tab;
    }

    public function getIdNotCollaborer($list)
    {
        $tab = array();
        for ($i = 0; $i < count($list); $i += 1) {
            $tab[$i] = "" . $list[$i]->id;
        }

        return $tab;
    }

    public function queryCollaborer($nomTab, $list)
    {
        $query = "select * from " . $nomTab . " where ";
        $para = "";
        $tab = $this->getCfpIdCollaborer($list);
        for ($i = 0; $i < count($tab); $i += 1) {
            $para .= " id = '" . $tab[$i] . "'";
            if ($i + 1 < count($tab)) {
                $para .= " OR ";
            }
        }
        $query = $query . " " . $para;
        return $query;
    }

    public function queryNotCollaborer($nomTab, $list)
    {
        $query = "select * from " . $nomTab . " where ";
        $para = "";
        $tab = $this->getCfpIdNotCollaborer($list);
        for ($i = 0; $i < count($tab); $i += 1) {
            $para .= $para . " id != '" . $tab[$i] . "'";
            if ($i + 1 < count($tab)) {
                $para .= " AND ";
            }
        }
        $query = $query . " " . $para;
        return $query;
    }

    //start refactor ------------------------------------------------

    // filtre employes
    public function filtreEmploye($search_param_name, $input){

        $user_id = Auth::user()->id;

        $etp_id = Responsable::where('user_id', [$user_id])->value('entreprise_id');

        $emps = DB::table('users')
                ->join('v_role_user_etp_stg', 'v_role_user_etp_stg.user_id', 'users.id')
                ->join('stagiaires', 'stagiaires.user_id', 'v_role_user_etp_stg.user_id')
                ->join('entreprises', 'entreprises.id', 'stagiaires.entreprise_id')
                ->select('stagiaires.entreprise_id' ,'telephone_stagiaire' ,'role_name', 'matricule', 'nom_stagiaire', 'prenom_stagiaire',
                    'role_id', 'mail_stagiaire', 'photos',
                    'stagiaires.user_id', 'fonction_stagiaire',
                    'users.name', 'users.telephone', 'users.email')
                ->where('stagiaires.entreprise_id', '=', $etp_id)
                ->where($search_param_name, 'like', '%'. $input .'%')
                ->get();

        return $emps;
    }

    //filtre employes new
    public function filtreEmployeNew($user_id){

        $emps = DB::table('stagiaires')
                ->select('*')
                ->where('user_id', '=', $user_id)
                // ->where('entreprise_id', '=', $etp_id)
                ->get();

        return $emps;
    }

    public function afficheInfoNewOne($id){
        // $emps = DB::table('users')
        //         ->join('v_role_user_etp_stg', 'v_role_user_etp_stg.user_id', 'users.id')
        //         ->join('stagiaires', 'stagiaires.user_id', 'v_role_user_etp_stg.user_id')
        //         ->join('entreprises', 'entreprises.id', 'stagiaires.entreprise_id')
        //         ->select('stagiaires.entreprise_id' ,'telephone_stagiaire' ,'role_name', 'matricule', 'nom_stagiaire', 'prenom_stagiaire',
        //             'role_id', 'mail_stagiaire', 'photos',
        //             'stagiaires.user_id', 'fonction_stagiaire',
        //             'users.name', 'users.telephone', 'users.email', 'stagiaires.user_id')
        //         ->where('stagiaires.user_id', '=', $id)
        //         ->get();
        $emps = DB::table('stagiaires')
                ->select('*')
                ->where('user_id', '=', $id)
                ->get();

        return $emps;
    }

    //filtre Réferent
    public function filtreReferent($search_param_name, $input){

        $user_id = Auth::user()->id;

        $etp_id = responsable::where('user_id', [$user_id])->value('entreprise_id');

        $referents = DB::table('users')
                ->join('v_role_user_etp_referent', 'v_role_user_etp_referent.user_id', 'users.id')
                ->join('responsables', 'responsables.user_id', 'users.id')
                ->join('entreprises', 'entreprises.id', 'responsables.entreprise_id')
                ->select('responsables.entreprise_id' ,'telephone_resp' ,'role_name',
                'matricule',
                'nom_resp', 'prenom_resp',
                    'role_id', 'email_resp', 'photos',
                    'responsables.user_id', 'fonction_resp')
                ->where('responsables.entreprise_id', '=', $etp_id)
                ->where($search_param_name, 'like', '%'. $input .'%')
                ->get();

        // dd($referents);
        return $referents;
    }

    //filtre Chef
    public function filtreChef($search_param_name, $input){

        $user_id = Auth::user()->id;

        $etp_id = responsable::where('user_id', [$user_id])->value('entreprise_id');

        $chefs = DB::table('users')
                ->join('v_role_user_etp_manager', 'v_role_user_etp_manager.user_id', 'users.id')
                ->join('chef_departements', 'chef_departements.user_id', 'users.id')
                ->join('entreprises', 'entreprises.id', 'chef_departements.entreprise_id')
                ->select('chef_departements.entreprise_id' ,'telephone_chef' ,'role_name',
                    'chef_departements.id', 'nom_chef', 'prenom_chef',
                    'role_id', 'mail_chef', 'photos',
                    'chef_departements.user_id', 'fonction_chef')
                ->where('chef_departements.entreprise_id', '=', $etp_id)
                ->where($search_param_name, 'like', '%'. $input .'%')
                ->get();

        // dd($chefs);
        return $chefs;
    }
    //end refactor -------------------------------------

    public function getNotCollaborer($nomTab, $list)
    {
        $data = DB::select($this->queryNotCollaborer($nomTab, $list));
        for ($i = 0; $i < count($data); $i += 1) {
            $data[$i]->collaboration = "0";
        }

        return $data;
    }
    public function getCollaborer($nomTab, $list)
    {

        $data = DB::select($this->queryCollaborer($nomTab, $list));
        for ($i = 0; $i < count($data); $i += 1) {
            $data[$i]->collaboration = "1";
        }
        return $data;
    }
    // ------------------------------

    public function insert_role_user($user_id, $role_id,$prioriter, $activiter)
    {
        DB::insert('insert into role_users (user_id, role_id,prioriter,activiter) values (?,?,?,?)', [$user_id, $role_id,$prioriter, $activiter]);
    }

    //insertion iframe pour enntreprise et of dans la bd

    public function insert_iframe($table, $colonnes, $id, $iframe)
    {
        DB::insert('insert into ' . $table . ' (' . $colonnes . ', iframe) values (?, ?)', [$id, $iframe]);
    }

    public function insert_iframe_invite($iframe)
    {
        DB::insert('insert into iframe_invite(iframe) values (?)', [$iframe]);
    }

    //modification iframe
    public function update_iframe($table, $col1, $col2, $id, $iframe)
    {
        DB::update('update ' . $table . ' set ' . $col1 . ' = "' . $iframe . '" where ' . $col2 . ' = ?', [$id]);
    }
    public function update_iframe_invite($id,$iframe)
    {
        DB::update('update iframe_invite set iframe = ? where id = ?', [$iframe,$id]);
    }

    //suppressionn iframe
    public function supprimer_iframe($table, $colonne, $id)
    {
        DB::delete('delete from ' . $table . ' where ' . $colonne . ' = ?', [$id]);
    }

    public function supprimer_iframe_invite($id)
    {
        DB::delete('delete from iframe_invite where id = ?', [$id]);
    }


    // find where avec odrer by

    public function queryWhereTrieOrderBy($nomTab, $para = [], $opt = [], $val = [], $tabOrderBy = [], $order, $nbPag, $nb_limit)
    {
        if ($nbPag == null) {
            $nbPag = 1;
        }
        $query="";
        $query1="SELECT * FROM ";
        $query2 = "(SELECT * FROM " . $nomTab;
        if (count($para) != count($val)) {
            return "ERROR: tail des onnees parametre et value est different";
        } else {

            if(count($para)>0 && count($val)>0){
                $query2 .= " WHERE ";
                for ($i = 0; $i < count($para); $i++) {
                    $query2 .= "" . $para[$i] . " " . $opt[$i] . " ? ";
                    if ($i + 1 < count($para)) {
                        $query2 .= " AND ";
                    }
                }
            }

            $query2 .= " LIMIT ".$nb_limit." OFFSET ".($nbPag-1).") AS t2";
   //   $query2 .= ") AS t2"; // vao2

            $query = $query1." ".$query2;
            $query .= "  ORDER BY ";

            for ($j1 = 0; $j1 < count($tabOrderBy); $j1++) {
                $query .= " " . $tabOrderBy[$j1];
                if ($j1 + 1 < count($tabOrderBy)) {
                    $query .= " , ";
                }
            }
            $query.=" ".$order;

            // vao2
          //  $query.=" LIMIT ".$nb_limit." OFFSET ".($nbPag-1)."";
            return $query;
        }
    }

  /*  public function queryWhereTrieOrderBy($nomTab, $para = [], $opt = [], $val = [], $tabOrderBy = [], $order, $nbPag, $nb_limit)
    {
        if ($nbPag == null) {
            $nbPag = 1;
        }
        $query = "SELECT * FROM " . $nomTab;
        if (count($para) != count($val)) {
            return "ERROR: tail des onnees parametre et value est different";
        } else {

            if(count($para)>0 && count($val)>0){
                $query .= " WHERE ";
                for ($i = 0; $i < count($para); $i++) {
                    $query .= "" . $para[$i] . " " . $opt[$i] . " ? ";
                    if ($i + 1 < count($para)) {
                        $query .= " AND ";
                    }
                }
            }

            $query .= "  ORDER BY ";

            for ($j1 = 0; $j1 < count($tabOrderBy); $j1++) {
                $query .= " " . $tabOrderBy[$j1];
                if ($j1 + 1 < count($tabOrderBy)) {
                    $query .= " , ";
                }
            }
            // $query .= " " . $order . "  limit " . $nb_limit . " offset " . $nbPag;
            $query .= " " . $order . "  limit " . $nb_limit . " offset " . ($nbPag-1);

            return $query;
        }
    } */

    public function findWhereTrieOrderBy($nomTab, $para = [], $opt = [], $val = [], $tabOrderBy = [], $order, $nbPag, $nb_limit)
    {
        $data =  DB::select($this->queryWhereTrieOrderBy($nomTab, $para, $opt, $val, $tabOrderBy, $order, $nbPag, $nb_limit), $val);
        return $data;
    }



    public function queryPagination($nomTab, $col_para, $para = [], $opt = [], $val = [],$constraint)
    {
        $query = "SELECT ( COUNT(".$col_para.")) totale FROM " . $nomTab ;
        if (count($para) != count($val)) {
            return "ERROR: tail des onnees parametre et value est different";
        } else {

            if(count($para)>0 && count($val)>0){
                $query .= " WHERE ";
                for ($i = 0; $i < count($para); $i++) {
                    $query .= "" . $para[$i] . " ".$opt[$i]." ?";
                    if ($i + 1 < count($para)) {
                        $query .= " ".$constraint." ";
                    }
                }
            }

            return $query;
        }
    }

    public function getNbrePagination($nomTab, $col_para, $para = [], $opt = [], $val = [],$constraint){
        $data =  DB::select($this->queryPagination($nomTab, $col_para, $para, $opt, $val,$constraint), $val);
        return $data[0]->totale;
    }

    public function nb_liste_pagination($totaleDataList, $nb_debut_pag,$nb_limit)
    {

        if ($totaleDataList != null) {
            $totale_pagination = $totaleDataList;
        } else {
            $totale_pagination = 0;
        }
        $debut_aff = 0;
        $fin_aff = 0;

        if ($nb_debut_pag <= 0 || $nb_debut_pag == null) {
            $nb_debut_pag = 1;
        }

        if ($nb_debut_pag == 1) { // 1
            $nb_debut_pag = 1;
            $debut_aff = 1;
            $fin_aff = $nb_debut_pag + $nb_limit;

            if($fin_aff>=$totale_pagination){
                $fin_aff = $totale_pagination;
            }
        }

        if ($nb_debut_pag > 1 && $nb_debut_pag < $totale_pagination) {
            $fin_aff = $nb_debut_pag + $nb_limit;
            $debut_aff = $nb_debut_pag;
        }
        if ($nb_debut_pag  == $totale_pagination) {
            $fin_aff = ($nb_debut_pag - 1) + $nb_limit;
            if($fin_aff>=$totale_pagination){
                $fin_aff = $totale_pagination;
            }
            $debut_aff = $nb_debut_pag;
        }

        if($fin_aff>=$totale_pagination){
            $fin_aff = $totale_pagination;
        }

        $data["nb_limit"] = $nb_limit;
        $data["debut_aff"] = $debut_aff;
        $data["fin_aff"] = $fin_aff;
        $data["totale_pagination"] = $totale_pagination;
        return $data;
    }

    function formatting_phone($phone){
        $format = '';
        if(preg_match('/([0-9]{3})([0-9]{2})([0-9]{3})([0-9]{2})$/', $phone, $value)) {
            $format = $value[1] . ' ' . $value[2] . ' ' . $value[3] .' '.$value[4];
        }
        return $format;
    }

}