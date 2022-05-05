<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class FonctionGenerique extends Model
{
    // sql generique
    public function queryWhereVerify($nomTab, $para = [], $val = [])
    {
        $query = "SELECT COUNT(id) id FROM " . $nomTab . " WHERE ";
        if (count($para) != count($val)) {
            return "ERROR: tail des onnees parametre et value est different";
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
            return "ERROR: tail des onnees parametre et value est different";
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
            return "ERROR: tail des onnees parametre et value est different";
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
            return "ERROR: tail des onnees parametre et value est different";
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
            return "ERROR: tail des onnees parametre et value est different";
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
            return "ERROR: tail des onnees parametre et value est different";
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

    public function insert_role_user($user_id, $role_id, $activiter)
    {
        DB::insert('insert into role_users (user_id, role_id,activiter) values (?, ?,?)', [$user_id, $role_id, $activiter]);
    }

    //insertion iframe pour enntreprise et of dans la bd

    public function insert_iframe($table, $colonnes, $id, $iframe)
    {
        DB::insert('insert into ' . $table . ' (' . $colonnes . ', iframe) values (?, ?)', [$id, $iframe]);
    }

    //modification iframe
    public function update_iframe($table, $col1, $col2, $id, $iframe)
    {
        DB::update('update ' . $table . ' set ' . $col1 . ' = "' . $iframe . '" where ' . $col2 . ' = ?', [$id]);
    }

    //suppressionn iframe
    public function supprimer_iframe($table, $colonne, $id)
    {
        DB::delete('delete from ' . $table . ' where ' . $colonne . ' = ?', [$id]);
    }

    // find where avec odrer by
    public function queryWhereTrieOrderBy($nomTab, $para = [], $opt = [], $val = [], $tabOrderBy = [], $order, $nbPag, $nb_limit)
    {
        if ($nbPag == null) {
            $nbPag = 0;
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
            $query .= " " . $order . "  limit " . $nb_limit . " offset " . $nbPag;
            return $query;
        }
    }

    public function findWhereTrieOrderBy($nomTab, $para = [], $opt = [], $val = [], $tabOrderBy = [], $order, $nbPag, $nb_limit)
    {

        // $nbPag= ($nbPag-1);
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
        // $nb_limit = 5;
        if ($totaleDataList != null) {
            $totale_pagination = $totaleDataList;
        } else {
            $totale_pagination = 0;
        }
        $debut_aff = 0;
        $fin_aff = 0;



     /*   if ($totale_pagination == 1) {
            $nb_debut_pag = 1;
            $fin_aff = 1;
        } */
        if ($nb_debut_pag <= 0 || $nb_debut_pag == null) {
            $nb_debut_pag = 1;
        }

        if ($nb_debut_pag == 1) { // 1
            $nb_debut_pag = 1;
            $debut_pagination = 0; //
            $debut_aff = 1;
            $fin_aff = $nb_debut_pag + $nb_limit;
            if($fin_aff>=$totale_pagination){
                $fin_aff = $totale_pagination;
            }
        }
        if ($nb_debut_pag > 1 && $nb_debut_pag < $totale_pagination) {
            $debut_pagination = ($nb_debut_pag - 1) + $nb_limit;
            $fin_aff = $nb_debut_pag + $nb_limit;

            $debut_aff = $nb_debut_pag;
        }
        if ($nb_debut_pag  == $totale_pagination) {
            $debut_pagination = ($nb_debut_pag - 1) + $nb_limit;
            $fin_aff = ($nb_debut_pag - 1) + $nb_limit;
            if($fin_aff>=$totale_pagination){
                $fin_aff = $totale_pagination;
            }
            $debut_aff = $nb_debut_pag;
        }

        // if($fin_aff>=$totale_pagination){
        //     $fin_aff = $totale_pagination;
        // } else {
        //     $fin_aff = $nb_debut_pag+$nb_limit;
        // }

        $data["nb_limit"] = $nb_limit;
        $data["debut_aff"] = $debut_aff;
        $data["fin_aff"] = $fin_aff;
        $data["totale_pagination"] = $totale_pagination;
        return $data;
    }

}