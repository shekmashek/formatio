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

    public function verifyExistsFacture($cfp_id, $idProject, $idGroupe, $id_type_facture)
    {
        $verify = DB::select('select (count(id)) verify from ' . $this->table . ' where projet_id = ? and groupe_id=? and type_facture_id=? and cfp_id=?', [$idProject, $idGroupe, $id_type_facture, $cfp_id]);
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

    // fonction update frais annexe
    public function update_frais_annexe($id, $montant)
    {
        DB::update("update montant_frais_annexes set montant=?, updated_at=NOW()  where id=?", [$montant, $id]);
        DB::commit();
    }


    public function insert($cfp_id, $idProject, $idGroupe, $tabData, $taux, $tabDataDate, $tabDataTypeFinance, $tabDataDesc, $num_facture, $path, $reference_bc, $remise, $type_facture_id)
    {
        $ttc = $this->TTC(($tabData['facture'] * $tabData['qte']), $taux);
        $ht = $tabData['facture'] * $tabData['qte'];
        $data = [
            $path['path_bc'], $path['path_fa'], $ht, $idProject,
            $tabDataTypeFinance['id_type_payement'], $tabDataDate['invoice_date'],
            $tabDataDate['due_date'], $tabDataTypeFinance['tax_id'], $tabDataDesc['description'], $tabDataDesc['other_message'],
            $tabData['qte'], $num_facture, $tabDataTypeFinance['id_mode_financement'], $idGroupe, $tabData['facture'], $reference_bc, $remise, $type_facture_id, $cfp_id
        ];

        DB::insert('insert into factures (bon_de_commande,devise,hors_taxe,projet_id,type_payement_id,invoice_date,due_date,tax_id,description,other_message,qte,num_facture,type_financement_id,groupe_id,created_at, updated_at,pu,reference_bc,remise,type_facture_id,cfp_id) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?, NOW(), NOW(),?,?,?,?,?)', $data);

        DB::commit();
    }

    // fonction insert nouveau frais annexe par project
    public function insert_frais_annexe($cfp_id, $num_facture, $qte, $idFrais, $montant, $desc, $taux)
    {
        $ttc = $this->TTC(($montant * $qte), $taux);
        $ht = $montant * $qte;
        $data = [$idFrais, $num_facture, $ttc, $ht, $desc, $qte, $montant, $cfp_id];

        DB::insert('insert into montant_frais_annexes (frais_annexe_id,num_facture,montant,hors_taxe,description,qte, created_at, updated_at,pu,date_frais_annexe,cfp_id) values (?,?,?,?,?,?, NOW(), NOW(),?, NOW(),?)', $data);
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
            'down_bc.required' => 'la fiche Bon de Commande ne doit pas etre null',
            'down_bc.min' => 'le fichier Bon de Commande est corrompu ou pas de donner! veuillez choisir une autre',
            'down_bc.max' => 'le fichier Bon de Commande est invalid car trop lourd!',
            'down_bc.mimes' => 'Seul le fichier type "PDF" est autorisé pour le Bon de Commande',
            'down_bc.pdf' => 'Seul le fichier type "PDF" est autorisé pour le Bon de Commande',
            'down_fa.required' => 'la fiche Facture ne doit pas etre null ',
            'down_fa.min' => 'la fiche Facture  est corrompu ou pas de donner! veuillez choisir une autre',
            'down_fa.max' => 'la fiche Facture est invalid car trop lourd!',
            'down_fa.mimes' => 'Seul le fichier type "PDF" est autorisé pour la Facture',
            'down_fa.pdf' => 'Seul le fichier type "PDF" est autorisé pour la Facture',
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
        $critereForm = [
            'down_bc' => 'required|min:3|max:10000|file|mimes:pdf',
            'down_fa' => 'required|min:3|max:10000|file|mimes:pdf',
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
        $pathFA = 'Facture_Projet_' . $pathFA . '.' . $extense_fa;

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

    public function verifyCreationFacture($cfp_id, $idProject, $idGroupe, $imput, $tabData, $taux, $tabDataDate, $tabDataTypeFinance, $tabDataDesc, $num_facture, $path)
    {
        $this->validation_form($imput);
        $fonction = new FonctionGenerique();
        $verify = $this->verifyExistsFacture($cfp_id, $idProject, $idGroupe, $imput["type_facture"]);

        if ($verify == 0) {

            $this->insert($cfp_id, $idProject, $idGroupe, $tabData, $taux, $tabDataDate, $tabDataTypeFinance, $tabDataDesc, $num_facture, $path, $imput["reference_bc"], $imput["remise"], $imput["type_facture"]);

            return back()->with('success', 'creation de la facture du project est effectué');
        } else {
            return back()->with('error', 'Oups! la facture existe déjà!');
        }
    }

    //====================================== modification de facture ===============

    public function verifyUpdateFacture($idProject, $imput)
    {
        $this->validation_form_update($imput);
        $frais_annexes = $this->getFraisAnnexe($idProject);

        DB::beginTransaction();
        try {
            foreach ($frais_annexes as $frais) {
                $data = $imput["montant_frais_annexe_" . $frais->montant_frais_annexe_id];
                if ($data != null) {
                    $this->update_frais_annexe($frais->montant_frais_annexe_id, $data);
                }
            }
            $this->edit($idProject, $imput);
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }

        return back()->with('success', 'modification de la facture du project est effectuer');
    }

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

    public function search_intervale_dte_generique_cfp($nomTab, $invoice_dte, $due_dte, $cfp_id)
    {
        $data = DB::select("select * from " . $nomTab . " where invoice_date>=? or due_date=? and cfp_id=?", [$invoice_dte, $due_dte, $cfp_id]);
        return $data;
    }

    public function search_num_factgenerique_cfp($nomTab, $num_fact, $cfp_id)
    {
        $data = DB::select("select * from " . $nomTab . " where num_facture like %" . $num_fact . "% and cfp_id=?", [$num_fact, $cfp_id]);
        return $data;
    }

    // ---------------------------------


    public function search_intervale_dte_generique_etp($nomTab, $invoice_dte, $due_dte, $entreprise_id)
    {
        $data = DB::select("select * from " . $nomTab . " where invoice_date>=? or due_date=? and entreprise_id=?", [$invoice_dte, $due_dte, $entreprise_id]);
        return $data;
    }

    public function search_num_factgenerique_etp($nomTab, $num_fact, $entreprise_id)
    {
        $data = DB::select("select * from " . $nomTab . " where num_facture like %" . $num_fact . "% and entreprise_id=?", [$num_fact, $entreprise_id]);
        return $data;
    }

    /*
    public function search_intervale_dte_en_cour($invoice_dte,$due_dte,$cfp_id){
        $data = DB::select("select * from v_facture_actif where invoice_date>=? or due_date=? and cfp_id=?",[$invoice_dte,$due_dte,$cfp_id]);
        return $data;
    }

    public function search_num_fact_en_cour($num_fact,$cfp_id){
        $data = DB::select("select * from v_facture_actif where num_facture like %".$num_fact."% and cfp_id=?",[$cfp_id]);
        return $data;
    }

    public function search_intervale_dte_payer($invoice_dte,$due_dte,$cfp_id){
        $data = DB::select("select * from v_facture_actif where invoice_date>=? or due_date=? and cfp_id=?",[$invoice_dte,$due_dte,$cfp_id]);
        return $data;
    }

    public function search_num_fact_payer($num_fact,$cfp_id){
        $data = DB::select("select * from v_facture_actif where num_facture like %".$num_fact."% and cfp_id=?",[$cfp_id]);
        return $data;
    }

    public function search_intervale_dte_actif($invoice_dte,$due_dte,$cfp_id){
        $data = DB::select("select * from v_facture_actif where invoice_date>=? or due_date=? and cfp_id=?",[$invoice_dte,$due_dte,$cfp_id]);
        return $data;
    }

    public function search_num_fact_actif($num_fact,$cfp_id){
        $data = DB::select("select * from v_facture_actif where num_facture like %".$num_fact."% and cfp_id=?",[$cfp_id]);
        return $data;
    }
    public function search_intervale_dte_actif($invoice_dte,$due_dte,$cfp_id){
        $data = DB::select("select * from v_facture_actif where invoice_date>=? or due_date=? and cfp_id=?",[$invoice_dte,$due_dte,$cfp_id]);
        return $data;
    }

    public function search_num_fact_actif($num_fact,$cfp_id){
        $data = DB::select("select * from v_facture_actif where num_facture like %".$num_fact."% and cfp_id=?",[$cfp_id]);
        return $data;
    }
*/
}
