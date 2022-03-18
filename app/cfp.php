<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\FonctionGenerique;
use Illuminate\Support\Facades\DB;

class Cfp extends Model
{
    protected $table = "cfps";

    protected $fillable = [
        'id', 'Nom', 'Adresse', 'Email', 'Telephone', 'Domaine_de_formation', 'NIF', 'STAT', 'RCS', 'CIF', 'logo', 'user_id',
        'adresse_rue', 'adresse_quartier', 'adresse_code_postal'
    ];



    // ----------------------------------------
    public function getCfpIdCollaborer($list)
    {
        $tab = array();
        for ($i = 0; $i < count($list); $i += 1) {
            $tab[$i] = "" . $list[$i]->cfp_id;
        }

        return $tab;
    }

    public function getCfpIdNotCollaborer($list)
    {
        $tab = array();
        for ($i = 0; $i < count($list); $i += 1) {
            $tab[$i] = "" . $list[$i]->id;
        }

        return $tab;
    }

    public function queryCfpCollaborer($list)
    {
        $query = "select * from cfps where ";
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

    public function queryCfpNotCollaborer($list)
    {
        $para = "";
        $query = "select * from cfps where ";
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

    public function getCfpNotCollaborer($list)
    {
        $data = DB::select($this->queryCfpNotCollaborer($list));

        if (count($list) > 0) {
            $data = DB::select($this->queryCfpNotCollaborer($list));
        } else {
            $data = DB::select("select * from cfps");
        }

        for ($i = 0; $i < count($data); $i += 1) {
            $data[$i]->collaboration = "0";
        }

        return $data;
    }
    public function getCfpCollaborer($list)
    {


        if (count($list) > 0) {
            $data = DB::select($this->queryCfpCollaborer($list));
            for ($i = 0; $i < count($data); $i += 1) {
                $data[$i]->collaboration = "1";
            }
        } else {
            $data = DB::select("select * from  cfps");
            for ($i = 0; $i < count($data); $i += 1) {
                $data[$i]->collaboration = "0";
            }
        }

        return $data;
    }
    // ------------------------------

}
