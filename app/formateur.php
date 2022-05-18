<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Formateur extends Model
{
    protected $table = "formateurs";
    protected $fillable = [
        'id', 'nom_formateur', 'prenom_formateur', 'photos', 'mail_formateur', 'numero_formateur'
    ];
    public function genre()
    {
        return $this->belongsTo('App\genre');
    }

    public function getFormateur($etp1, $etp2)
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

    // ----------------------------------------
    public function getIdCollaborer($list)
    {
        $tab = array();
        for ($i = 0; $i < count($list); $i += 1) {
            $tab[$i] = "" . $list[$i]->formateur_id;
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
        $tab = $this->getIdCollaborer($list);
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
        $para = "";
        $query = "select * from " . $nomTab . " where ";
        $tab = $this->getIdNotCollaborer($list);
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
        if (count($list) > 0) {
            $data = DB::select($this->queryNotCollaborer($nomTab, $list));
        } else {
            $data = DB::select("select * from " . $nomTab);
        }

        for ($i = 0; $i < count($data); $i += 1) {
            $data[$i]->collaboration = "0";
        }

        return $data;
    }
    public function getCollaborer($nomTab, $list)
    {
        if (count($list) > 0) {
            $data = DB::select($this->queryCollaborer($nomTab, $list));
            for ($i = 0; $i < count($data); $i += 1) {
                $data[$i]->collaboration = "1";
            }
        } else {
            $data = DB::select("select * from " . $nomTab);
            for ($i = 0; $i < count($data); $i += 1) {
                $data[$i]->collaboration = "0";
            }
        }

        return $data;
    }
    // ------------------------------

}
