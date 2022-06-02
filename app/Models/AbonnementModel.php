<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class AbonnementModel extends Model
{
          /**  insertion de données dans la table tarif catégorie*/
        public function insert_tarif_categories($idTypeAbonneRole,$categorie_paiement,$tarif_ab){
            DB::insert('insert into tarif_categories (type_abonnement_role_id,categorie_paiement_id, tarif) values (?, ?, ?)', [$idTypeAbonneRole, $categorie_paiement, $tarif_ab]);
        }
          /**  Find value max  */
        public function findMax($nomTab, $nomCol)
        {
            $maxVal =  DB::select('SELECT MAX('.$nomCol.') as id_max from '.$nomTab.'');
            return $maxVal;
        }
        /** insertion de données dans factures_abonnements_cfp */
        public function insert_factures_abonnements_cfp($abonnement_cfps_id,$invoice_date,$due_date,$montant_facture){
          //generation du numero de facture
            $max_cfp_id = $this->findMax('factures_abonnements_cfp','num_facture')[0]->id_max;;
            $max_etp_id = $this->findMax('factures_abonnements','num_facture')[0]->id_max;;

            if($max_cfp_id == null &&  $max_etp_id == null) $num_facture = 1;
            if($max_cfp_id == null && $max_etp_id != null) $num_facture = $max_etp_id +=  1;
            if($max_cfp_id != null && $max_etp_id == null) $num_facture = $max_cfp_id +=  1;
            if($max_cfp_id != null && $max_etp_id != null) {
              if($max_cfp_id > $max_etp_id) $num_facture = $max_cfp_id +=  1;
              if($max_etp_id > $max_cfp_id) $num_facture = $max_etp_id +=  1;
            }

            DB::insert('insert into factures_abonnements_cfp (abonnement_cfps_id, invoice_date,due_date,num_facture,montant_facture) values (?,?,?,?,?)', [$abonnement_cfps_id,$invoice_date,$due_date,$num_facture,$montant_facture]);
        }

          /** insertion de données dans factures_abonnements */
          public function insert_factures_abonnements_etp($abonnement_id,$invoice_date,$due_date,$montant_facture){
            //generation du numero de facture
            $max_cfp_id = $this->findMax('factures_abonnements_cfp','num_facture')[0]->id_max;
            $max_etp_id = $this->findMax('factures_abonnements','num_facture')[0]->id_max;

            if($max_cfp_id == null &&  $max_etp_id == null) $num_facture = 1;
            if($max_cfp_id == null && $max_etp_id != null) $num_facture = $max_etp_id +=  1;
            if($max_cfp_id != null && $max_etp_id == null) $num_facture = $max_cfp_id +=  1;
            if($max_cfp_id != null && $max_etp_id != null) {
              if($max_cfp_id > $max_etp_id) $num_facture = $max_cfp_id +=  1;
              if($max_etp_id > $max_cfp_id) $num_facture = $max_etp_id +=  1;
            }
            DB::insert('insert into factures_abonnements (abonnement_id, invoice_date,due_date,num_facture,montant_facture) values (?,?,?,?,?)', [$abonnement_id,$invoice_date,$due_date,$num_facture,$montant_facture]);
          }
}
