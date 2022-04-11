<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\FonctionGenerique;

class Facture extends Model
{
    protected $table = "factures";
    protected $fillable = [
        'id', 'bon_de_commande', 'reference_bc', 'devise', 'projet_id', 'groupe_id', 'type_financement_id', 'type_payement_id', 'type_facture_id', 'tax_id', 'description', 'description', 'pu',
        'qte', 'hors_taxe', 'invoice_date', 'due_date', 'num_facture', 'activiter', 'remise', 'other_message', 'cfp_id'
    ];


    public function entreprise()
    {
        return $this->belongsTo('App\entreprise');
    }

    /*=======================separateur_chiffre===================*/
    public function separateur_chiffre($montant)
    {
        return number_format($montant, 2, ",", ".");
    }

    public function int2str($a)
    {
        $convert = explode('.', $a);

        /*if (isset($convert[1]) && $convert[1]!=''){
return $this->int2str($convert[0]).' et '.$this->int2str($convert[1]).' Centimes' ;
// return $this->int2str($convert[0]).'Dinars'.' et '.$this->int2str($convert[1]).'Centimes' ;
} */

        if ($a < 0) return 'moins ' . $this->int2str(-$a);
        if ($a < 17) {
            switch ($a) {
                    // case 0: return 'zero';
                case 1:
                    return 'un';
                case 2:
                    return 'deux';
                case 3:
                    return 'trois';
                case 4:
                    return 'quatre';
                case 5:
                    return 'cinq';
                case 6:
                    return 'six';
                case 7:
                    return 'sept';
                case 8:
                    return 'huit';
                case 9:
                    return 'neuf';
                case 10:
                    return 'dix';
                case 11:
                    return 'onze';
                case 12:
                    return 'douze';
                case 13:
                    return 'treize';
                case 14:
                    return 'quatorze';
                case 15:
                    return 'quinze';
                case 16:
                    return 'seize';
            }
        } else if ($a < 20) {
            return 'dix-' . $this->int2str($a - 10);
        } else if ($a < 100) {
            if ($a % 10 == 0) {
                switch ($a) {
                    case 20:
                        return 'vingt';
                    case 30:
                        return 'trente';
                    case 40:
                        return 'quarante';
                    case 50:
                        return 'cinquante';
                    case 60:
                        return 'soixante';
                    case 70:
                        return 'soixante-dix';
                    case 80:
                        return 'quatre-vingt';
                    case 90:
                        return 'quatre-vingt-dix';
                }
            } elseif (substr($a, -1) == 1) {
                if (((int)($a / 10) * 10) < 70) {
                    return $this->int2str((int)($a / 10) * 10) . '-et-un';
                } elseif ($a == 71) {
                    return 'soixante-et-onze';
                } elseif ($a == 81) {
                    return 'quatre-vingt-un';
                } elseif ($a == 91) {
                    return 'quatre-vingt-onze';
                }
            } elseif ($a < 70) {
                return $this->int2str($a - $a % 10) . '-' . $this->int2str($a % 10);
            } elseif ($a < 80) {
                return $this->int2str(60) . '-' . $this->int2str($a % 20);
            } else {
                return $this->int2str(80) . '-' . $this->int2str($a % 20);
            }
        } else if ($a == 100) {
            return 'cent';
        } else if ($a < 200) {
            return $this->int2str(100) . ' ' . $this->int2str($a % 100);
        } else if ($a < 1000) {
            return $this->int2str((int)($a / 100)) . ' ' . $this->int2str(100) . ' ' . $this->int2str($a % 100);
        } else if ($a == 1000) {
            return 'mille';
        } else if ($a < 2000) {
            return $this->int2str(1000) . ' ' . $this->int2str($a % 1000) . ' ';
        } else if ($a < 1000000) {
            return $this->int2str((int)($a / 1000)) . ' ' . $this->int2str(1000) . ' ' . $this->int2str($a % 1000);
        } else if ($a == 1000000) {
            return 'millions';
        } else if ($a < 2000000) {
            return 'un million ' . $this->int2str($a % 1000000) . ' ';
        } else if ($a == 1000000000) {
            return 'un milliard ';
        } else if ($a < 1000000000) {
            return $this->int2str((int)($a / 1000000)) . ' millions ' . $this->int2str($a % 1000000);
        } else if ($a < 10000000000) {
            return $this->int2str((int)($a / 1000000000)) . ' milliard ' . $this->int2str($a % 1000000000);
        }
    }
    /*----------------  fonction TVA,TTC,HT ---------------*/

    public function TVA($HT, $taux)
    {
        // TVA = HT * (%/100)
        $result = $HT * ($taux / 100);
        return $result;
    }

    public function TTC($HT, $taux)
    {
        // TTC = HT + TVA
        return ($HT + $this->TVA($HT, $taux));
    }


    public function findAll()
    {
        return Programme::get();
    }

    public function findById($id)
    {
        return Facture::where('id', $id)->get()[0];
    }

    public function findWhere($para = [], $val = [])
    {
        $fonction = new FonctionGenerique();
        $data =  $fonction->findWhere("factures", $para, $val);
        return $data;
    }

    public function findWhereOne($para, $opt, $val)
    {
        $fonction = new FonctionGenerique();
        $data =  $fonction->findWhereOne("factures", $para, $opt, $val);
        return $data;
    }

    public function detailFacture($idProject)
    {
        $fonction = new FonctionGenerique();
        $data =  $fonction->findWhereOne("v_projetentreprise", "projet_id", "=", $idProject);
        return $data;
    }

    public function verifyExistsFacture($cfp_id, $idProject, $idGroupe_etp, $id_type_facture)
    {
        $verify = DB::select('select (count(id)) verify from ' . $this->table . ' where projet_id = ? and groupe_entreprise_id=? and type_facture_id=? and cfp_id=?', [$idProject, $idGroupe_etp, $id_type_facture, $cfp_id]);
        return $verify[0]->verify;
    }

    public function verifyExistsNumFacture($num_fact, $cfp_id)
    {
        $verify = DB::select("select * from factures where num_facture = '" . $num_fact . "' and cfp_id='" . $cfp_id . "'");
        return $verify;
    }

    public function verifyExistsReferenceBC($reference_bc, $cfp_id)
    {
        $verify = DB::select("select * from factures where reference_bc = '" . $reference_bc . "' and cfp_id='" . $cfp_id . "'");
        return $verify;
    }

    // fonction update facture
    public function edit($idProject, $imput)
    {
        $update = [
            'montant_total' => $imput['facture'],
            'description' => $imput['description'],
            'qte' => $imput['qte'],
            'other_message' => $imput['other_message'],
            'invoice_date' => $imput['invoice_date'],
            'due_date' => $imput['due_date']
        ];
        Facture::where('projet_id', $idProject)->update($update);
    }



    public function insert($cfp_id, $idProject, $entrerpsie_id, $idGroupe_etp, $tabData, $taux, $tabDataDate, $tabDataTypeFinance, $tabDataDesc, $num_facture, $reference_bc, $remise, $type_facture_id)
    {
        $ttc = $this->TTC(($tabData['facture'] * $tabData['qte']), $taux);
        $ht = $tabData['facture'] * $tabData['qte'];
        $data = [
            $ht, $idProject,
            $tabDataTypeFinance['id_type_payement'], $tabDataDate['invoice_date'],
            $tabDataDate['due_date'], $tabDataTypeFinance['tax_id'], $tabDataDesc['description'], $tabDataDesc['other_message'],
            $tabData['qte'], $num_facture, $tabDataTypeFinance['id_mode_financement'], $idGroupe_etp, $tabData['facture'], $reference_bc, $remise, $type_facture_id, $cfp_id, $entrerpsie_id, $tabDataDesc['remise_id']
        ];

        DB::insert('insert into factures (hors_taxe,projet_id,type_payement_id,invoice_date,due_date,tax_id,description,other_message,qte,num_facture,type_financement_id,groupe_entreprise_id,created_at, updated_at,pu,reference_bc,remise,type_facture_id,cfp_id,entreprise_id,remise_id) values (?,?,?,?,?,?,?,?,?,?,?,?, NOW(), NOW(),?,?,?,?,?,?,?)', $data);

        DB::commit();
    }

    public function update_facture($cfp_id, $idProject, $entrerpsie_id, $idGroupe_etp, $tabData, $taux, $tabDataDate, $tabDataTypeFinance, $tabDataDesc, $num_facture, $reference_bc, $remise, $type_facture_id)
    {
        $ttc = $this->TTC(($tabData['facture'] * $tabData['qte']), $taux);
        $ht = $tabData['facture'] * $tabData['qte'];
        $data = [
            $ht, $idProject, $tabDataDate['invoice_date'], $tabDataDate['due_date'], $tabDataTypeFinance['tax_id'],
            $tabDataDesc['description'], $tabDataDesc['other_message'], $tabData['qte'], $tabDataTypeFinance['id_mode_financement'], $tabData['facture'],
            $reference_bc, $remise, $type_facture_id, $num_facture, $idGroupe_etp, $entrerpsie_id, $cfp_id
        ];
        DB::update('update factures set hors_taxe=?, projet_id=?, invoice_date=?, due_date=?, tax_id=?, description=?, other_message=?,
        qte=?, type_financement_id=?, pu=?, reference_bc=?, remise=?, type_facture_id=? where num_facture=? and groupe_entreprise_id=? and entreprise_id=? and cfp_id=?', $data);
        DB::commit();
    }

    // fonction insert nouveau frais annexe par project
    public function insert_frais_annexe($cfp_id, $projet_id, $entreprise_id, $num_facture, $qte, $idFrais, $montant, $desc)
    {
        $ht = $montant * $qte;
        $data = [$idFrais, $num_facture, $ht, $desc, $qte, $montant, $cfp_id, $projet_id, $entreprise_id];

        DB::insert('insert into montant_frais_annexes (frais_annexe_id,num_facture,hors_taxe,description,qte, created_at, updated_at,pu,date_frais_annexe,cfp_id,projet_id,entreprise_id) values (?,?,?,?,?, NOW(), NOW(),?, NOW(),?,?,?)', $data);
        DB::commit();
    }

    // fonction update frais annexe
    public function update_frais_annexe($cfp_id, $projet_id, $entreprise_id, $num_facture, $qte, $idFrais, $montant, $desc)
    {
        $ht = $montant * $qte;
        $data = [$ht, $desc, $qte, $montant, $num_facture, $idFrais, $cfp_id, $projet_id, $entreprise_id];

        // dd($data);

        DB::update("update montant_frais_annexes set hors_taxe=?, description=?,
            qte=?,pu=? where num_facture=?  and frais_annexe_id=? and cfp_id=? and projet_id=? and entreprise_id=?", $data);
        DB::commit();
    }

    public function suprime($num_facture, $cfp_id)
    {
        DB::beginTransaction();
        try {
            DB::delete('delete from factures where num_facture = ? and cfp_id=?', [$num_facture, $cfp_id]);
            DB::delete('delete from montant_frais_annexes where num_facture = ? and cfp_id=?', [$num_facture, $cfp_id]);
            DB::delete('delete from encaissements where num_facture = ? and cfp_id=?', [$num_facture, $cfp_id]);
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
    }

    public function suprime_frais_annexe($num_facture, $cfp_id)
    {
        DB::delete('delete from montant_frais_annexes where num_facture = ? and cfp_id=?', [$num_facture, $cfp_id]);
    }

    //fonction de verification validation formulaire
    public function validation_form($imput)
    {
        $rules = [
            'facture.required' => 'le montant du facture ne doit pas etre null ou inferieur 100 AR ',
            'facture.regex' => 'le montant ne doit pas contenir des lettres',
            'facture.min' => 'le montant doit etre superieur 100 AR',
            'facture.max' => 'le montant doit etre inférieur 100 0000 0000 0000 AR',
            'invoice_date.required' => 'la date ne doit pas etre null',
            'invoice_date.date' => 'la date seulement est autoriser',
            'due_date.required' => 'la date ne doit pas etre null',
            'due_date.date' => 'la date seulement est autoriser',
            'num_facture.required' => 'le numero de la fzcture ne doit pas etre null',
            'reference_bc.required' => 'le reference de bon de commande ne peut pas etre null',
            'remise.number' => 'le remise est de type nombre'
        ];
        /*   $critereForm = [
            'down_bc' => 'required|min:3|max:10000|file|mimes:pdf',
            'down_fa' => 'required|min:3|max:10000|file|mimes:pdf',
            'invoice_date' => 'required|date',
            'num_facture' => 'required',
            'due_date' => 'required|date',
            'reference_bc' => 'required'
        ];
*/
        $critereForm = [
            'invoice_date' => 'required|date',
            'num_facture' => 'required',
            'due_date' => 'required|date',
            'reference_bc' => 'required'
        ];

        // 'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        $imput->validate($critereForm, $rules);
    }

    public function validation_form_update($imput)
    {
        $rules = [
            'facture.required' => 'le montant du facture ne doit pas etre null ou inferieur 100 AR ',
            'facture.min' => 'le montant doit etre superieur 100 AR',
            'facture.integer' => 'le montant ne doit pas contenir des lettres ',
            'facture.regex' => 'le montant ne doit pas contenir des lettres ',
            'invoice_date.required' => 'la date ne doit pas etre null',
            'invoice_date.date' => 'la date seulement est autoriser',
            'due_date.required' => 'la date ne doit pas etre null',
            'due_date.date' => 'la date seulement est autoriser',
            'num_facture.date' => 'le numero de facture du client ne doit pas etre ignoré ou null'
        ];
        $critereForm = [
            'facture' => 'required|integer|regex:/^([0-9\s\-\+\(\)]*)$/|min:0',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',
            'num_facture' => 'required|string'
        ];
        $imput->validate($critereForm, $rules);
    }

    //===============================  validation de creation de facture ====================

    public function lectureFileProjet($file)
    {
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $file . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        @readfile($file);
    }


    public function stockBcetFa($extense_bc, $extense_fa, $nameDossier, $pathBC, $pathFA)
    {

        $str = 'Bon_commande_Facture/' . $nameDossier;
        $pathBC = 'BonCommande_Projet_' . $pathBC . '.' . $extense_bc;
        $pathFA = 'Devis_Projet_' . $pathFA . '.' . $extense_fa;

        $result['str'] = $str;
        $result['path_bc'] = $str . '/' . $pathBC;
        $result['path_fa'] = $str . '/' . $pathFA;
        $result['name_bc'] = $pathBC;
        $result['name_fa'] = $pathFA;

        return $result;
    }
    public function SaveBCetFA($path, $imput)
    {
        $imput->down_bc->move(public_path($path['str']), $path['name_bc']);
        $imput->down_fa->move(public_path($path['str']), $path['name_fa']);
    }


    public function verifyCreationFacture($cfp_id, $idProject, $entreprise_id, $idGroupe_etp, $imput, $tabData, $taux, $tabDataDate, $tabDataTypeFinance, $tabDataDesc, $num_facture)
    {
        $this->validation_form($imput);
        $fonction = new FonctionGenerique();
        $verify = $this->verifyExistsFacture($cfp_id, $idProject, $idGroupe_etp, $imput["type_facture"]);

        if ($verify == 0) {

            $this->insert($cfp_id, $idProject, $entreprise_id, $idGroupe_etp, $tabData, $taux, $tabDataDate, $tabDataTypeFinance, $tabDataDesc, $num_facture, $imput["reference_bc"], $tabDataDesc["remise"], $imput["type_facture"]);

            return back()->with('success', 'creation de la facture du project est effectué');
        } else {
            return back()->with('error', 'Oups! la facture existe déjà!');
        }
    }

    //====================================== modification de facture ===============

    // public function verifyUpdateFacture($idProject, $imput)
    // {
    //     $this->validation_form_update($imput);
    //     $frais_annexes = $this->getFraisAnnexe($idProject);

    //     DB::beginTransaction();
    //     try {
    //         foreach ($frais_annexes as $frais) {
    //             $data = $imput["montant_frais_annexe_" . $frais->montant_frais_annexe_id];
    //             if ($data != null) {
    //                 $this->update_frais_annexe($frais->montant_frais_annexe_id, $data);
    //             }
    //         }
    //         $this->edit($idProject, $imput);
    //     } catch (Exception $e) {
    //         DB::rollback();
    //         echo $e->getMessage();
    //     }

    //     return back()->with('success', 'modification de la facture du project est effectuer');
    // }

    //====================================== modification de facture ===============

    public function verifyDeleteFacture($num_facture, $cfp_id)
    {
        $fonction = new FonctionGenerique();
        $info = $fonction->findWhereMulitOne("factures", ["num_facture", "cfp_id"], [$num_facture, $cfp_id]);
        $this->suprime($info->num_facture, $cfp_id);
        $this->suprime_frais_annexe($info->num_facture, $cfp_id);
        File::delete($info->bon_de_commande);
        File::delete($info->devise);

        return back()->with('success', 'suppression de la facture du project est effectuer');
    }

    public function valider_facture_inactif($num_facture, $cfp_id)
    {
        DB::update('update factures set activiter = True where num_facture = ? and cfp_id=?', [$num_facture, $cfp_id]);
    }

    // ================= recherche par multi critère

    public function search_intervale_dte_generique_cfp_en_courPagination($invoice_dte, $due_dte, $cfp_id, $factue_id, $nbPage)
    {
        if ($factue_id <= 0) {
            $factue_id = 1;
        }
        $data = DB::select("select * from v_facture_actif where invoice_date>='" . $invoice_dte . "' and invoice_date<='" . $due_dte . "' and cfp_id=? and facture_encour='en_cour' and facture_id>=? limit " . $nbPage, [$cfp_id, $factue_id]);
        return $data;
    }

    public function search_intervale_dte_generique_cfp_actifPagination($invoice_dte, $due_dte, $cfp_id, $factue_id, $nbPage)
    {
        if ($factue_id <= 0) {
            $factue_id = 1;
        }
        $facture = DB::select("select * from v_facture_actif where facture_encour='valider' and invoice_date>=? and invoice_date<=? and cfp_id=?  and facture_id>=? limit " . $nbPage, [$invoice_dte, $due_dte, $cfp_id, $factue_id]);
        for ($i = 0; $i < count($facture); $i += 1) {
            $sessionConactener = $this->listSessionInFacture($facture[$i]->num_facture, $facture[$i]->cfp_id, $facture[$i]->projet_id);
            $data[$i] = $facture[$i];
            $data[$i]->session_facture = $sessionConactener["getSession"];
            $data[$i]->module_session = $sessionConactener["getModule"];
            $data[$i]->ref_session = $sessionConactener["getRefModule"];
        }
        return $data;
    }

    public function search_intervale_dte_generique_cfp_payerPagination($invoice_dte, $due_dte, $cfp_id, $factue_id, $nbPage)
    {
        if ($factue_id <= 0) {
            $factue_id = 1;
        }
        $facture = DB::select("select * from v_facture_actif where invoice_date>=? and invoice_date<=?  and cfp_id=? and UPPER(facture_encour)=UPPER('terminer') and facture_id>=? limit " . $nbPage, [$invoice_dte, $due_dte, $cfp_id, $factue_id]);
        for ($i = 0; $i < count($facture); $i += 1) {
            $sessionConactener = $this->listSessionInFacture($facture[$i]->num_facture, $facture[$i]->cfp_id, $facture[$i]->projet_id);
            $data[$i] = $facture[$i];
            $data[$i]->session_facture = $sessionConactener["getSession"];
            $data[$i]->module_session = $sessionConactener["getModule"];
            $data[$i]->ref_session = $sessionConactener["getRefModule"];
        }
        return $data;
    }

    public function search_intervale_dte_generique_cfp_inactifPagination($invoice_dte, $due_dte, $cfp_id, $factue_id, $nbPage)
    {
        if ($factue_id <= 0) {
            $factue_id = 1;
        }
        $facture = DB::select("select * from v_facture_inactif where invoice_date>=? and invoice_date<=? and cfp_id=? and facture_id>=? limit " . $nbPage, [$invoice_dte, $due_dte, $cfp_id, $factue_id]);
        $data = array();
        for ($i = 0; $i < count($facture); $i += 1) {
            $sessionConactener = $this->listSessionInFacture($facture[$i]->num_facture, $facture[$i]->cfp_id, $facture[$i]->projet_id);
            $data[$i] = $facture[$i];
            $data[$i]->session_facture = $sessionConactener["getSession"];
            $data[$i]->module_session = $sessionConactener["getModule"];
            $data[$i]->ref_session = $sessionConactener["getRefModule"];
        }
        return $data;
    }

    public function search_num_fact_inactif_cfp($num_fact, $cfp_id)
    {
        $facture = DB::select("select * from v_facture_inactif where UPPER(num_facture) like ('%" . $num_fact . "%') and cfp_id=?", [$cfp_id]);
        $data = array();
        for ($i = 0; $i < count($facture); $i += 1) {
            $sessionConactener = $this->listSessionInFacture($facture[$i]->num_facture, $facture[$i]->cfp_id, $facture[$i]->projet_id);

            $data[$i] = $facture[$i];
            $data[$i]->session_facture = $sessionConactener["getSession"];
            $data[$i]->module_session = $sessionConactener["getModule"];
            $data[$i]->ref_session = $sessionConactener["getRefModule"];
        }
        return $data;
    }
    public function search_num_fact_actif_cfp($nomTab, $num_fact, $satut_fact, $cfp_id)
    {
        $facture = DB::select("select * from " . $nomTab . " where UPPER(num_facture) like ('%" . $num_fact . "%') and  UPPER(facture_encour)=UPPER(?) and cfp_id=?", [$satut_fact, $cfp_id]);
        $data = array();
        for ($i = 0; $i < count($facture); $i += 1) {
            $sessionConactener = $this->listSessionInFacture($facture[$i]->num_facture, $facture[$i]->cfp_id, $facture[$i]->projet_id);
            $data[$i] = $facture[$i];
            $data[$i]->session_facture = $sessionConactener["getSession"];
            $data[$i]->module_session = $sessionConactener["getModule"];
            $data[$i]->ref_session = $sessionConactener["getRefModule"];
        }
        return $data;
    }


    // --------------------------------- show facture pagination
    public function pagination($cfp_id)
    {
        $fonction = new FonctionGenerique();
        $tmp = $fonction->findWhereMulitOne("v_pagination_facture", ["cfp_id"], [$cfp_id]);
        $data["pagination"] = $tmp;
        $data["totale"] = 10;
        return $data;
    }

    public function listSessionInFacture($num_fact, $cfp_id, $projet_id)
    {
        $fonction = new FonctionGenerique();

        $data = array();
        $concatRefModule = "";
        $concatSession = "";
        $concatModule = "";
        $facture = $fonction->findWhere(
            "factures",
            ["num_facture", "cfp_id", "projet_id"],
            [$num_fact, $cfp_id, $projet_id]
        );

        for ($i = 0; $i < count($facture); $i += 1) {
            $tabSession = $fonction->findWhereMulitOne(
                "v_groupe_projet_entreprise_module",
                ["groupe_entreprise_id", "entreprise_id", "projet_id"],
                [$facture[$i]->groupe_entreprise_id, $facture[$i]->entreprise_id, $facture[$i]->projet_id]
            );
            $concatModule .= "" . $tabSession->nom_formation . "->" . $tabSession->nom_module;
            $concatSession .= "" . $tabSession->nom_groupe;
            $concatRefModule .= "" . $tabSession->reference;
            if ($i + 1 < count($facture)) {
                $concatModule .= "/<br>";
                $concatSession .= "/<br>";
                $concatRefModule .= "/<br>";
            }
        }
        $concatSession = "<p>" . $concatSession . "</p>";
        $concatModule = "<p>" . $concatModule . "</p>";
        $concatRefModule = "<p>" . $concatRefModule . "</p>";
        $data["getSession"] = $concatSession;
        $data["getModule"] = $concatModule;
        $data["getRefModule"] = $concatRefModule;
        return $data;
    }

    public function getListDataFacture($nomTab, $para = [], $val = [], $nbDebutPagination, $nbPage)
    {
        $fonction = new FonctionGenerique();
        $data = array();
        $facture = $fonction->findWherePagination($nomTab, $para, $val, $nbDebutPagination, $nbPage);

        for ($i = 0; $i < count($facture); $i += 1) {
            $sessionConactener = $this->listSessionInFacture($facture[$i]->num_facture, $facture[$i]->cfp_id, $facture[$i]->projet_id);

            $data[$i] = $facture[$i];
            $data[$i]->session_facture = $sessionConactener["getSession"];
            $data[$i]->module_session = $sessionConactener["getModule"];
            $data[$i]->ref_session = $sessionConactener["getRefModule"];
        }
        return $data;
    }

    public function queryWhereParam($nomTab, $para = [], $opt = [], $val = [])
    {
        $query = "SELECT * FROM " . $nomTab . " WHERE ";
        if (count($para) != count($val)) {
            return "ERROR: tail des onnees parametre et value est different";
        } else {
            for ($i = 0; $i < count($para); $i++) {
                $query .= "" . $para[$i] . "" . $opt[$i] . " '" . $val[$i] . "'";
                if ($i + 1 < count($para)) {
                    $query .= " AND ";
                }
            }
            return $query;
        }
    }

    public function queryWhereParamAndCritere($query_tmp, $para = [], $val = [])
    {
        $query = $query_tmp . " AND ";
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

    public function findWhereParam($nomTab, $paraNot = [], $optNot = [], $valNot = [], $paraCrt = [], $valCrt = [])
    {
        $query_tmp = $this->queryWhereParam($nomTab, $paraNot, $optNot, $valNot);
        $query = $this->queryWhereParamAndCritere($query_tmp, $paraCrt, $valCrt);

        $data =  DB::select($query, $valCrt);
        return $data;
    }


    public function nb_liste_fact_cfp($nb_debut_pag, $cfp_id)
    {
        $nb_limit=10;
        $query = "SELECT cfp_id,( COUNT(num_facture)) totale_pagination FROM v_montant_facture WHERE cfp_id=? GROUP BY cfp_id";
        $totale_pagination =  DB::select($query, [$cfp_id])[0]->totale_pagination; // 20
        $debut_aff = 0;
        $fin_aff = 1;

        if($totale_pagination==1){
            $nb_debut_pag = 1;
            $fin_aff = 1;
        }
        if ($nb_debut_pag <= 0 || $nb_debut_pag==null) {
            $nb_debut_pag = 1;
        }

        if($nb_debut_pag == 1){
            $debut_pagination=0;
            $debut_aff = 1;
            if($nb_debut_pag >=$totale_pagination  ){
                $fin_aff = $totale_pagination;
            } else {
                $fin_aff = $nb_limit;
            }
        }
        elseif($nb_debut_pag  == $totale_pagination){
            $debut_pagination = ($nb_debut_pag-1) * $nb_limit;
            $fin_aff = ($nb_debut_pag-1) * $nb_limit;
            $debut_aff = $nb_debut_pag;
        } else {
            $debut_pagination = ($nb_debut_pag-1) * $nb_limit;
            $fin_aff = ($nb_debut_pag-1) * $nb_limit;
            $debut_aff = $nb_debut_pag * $nb_limit;
        }
        $data["nb_limit"] = $nb_limit;
        $data["debut_aff"] = $debut_aff;
        $data["fin_aff"] = $fin_aff;
        $data["totale_pagination"] = $totale_pagination;
        return $data;
    }
}
