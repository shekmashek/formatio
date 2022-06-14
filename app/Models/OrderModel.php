<?php

namespace App\Models;

use App\Groupe;
use Illuminate\Database\Eloquent\Model;
class OrderModel extends Model
{
    public function __construct()
    {
        $this->group = new groupe();
    }
    public function ordre($ordre){
        if($ordre == 'ASC'){
            $ordre = 'DESC';
        }else{
            $ordre = 'ASC';
        }
        return $ordre;
    }
    public function ordonner_etp_resp($page,$ordre,$responsable_etp){
        $new_order = $this->ordre($ordre);
        $output='
                <thead>
                    <th> Logo </th>
                    <th><a id="order_etp" href="'.route('liste_utilisateur', [1,$page,$new_order,'nom_resp']).'"> Entreprises <span id="order_sign"></span></a></th>
                    <th> Responsables Principales </th>
                    <th> E-mail </th>
                    <th> Téléphone </th>
                    <th> Date d inscription </th>
                    <th> Action </th>
                </thead>
                <tbody>';
                foreach ($responsable_etp as $retp){
                    $output.="<tr>
                        <td>
                            <img  class='logo_responsable' alt='Responsive image' src='".asset('images/entreprises/'.$retp->entreprise->logo)."' cellspacing='0'>
                        </td>
                       
                        <td><span>".$retp->entreprise->nom_etp."</span></td>
                        <td><span>".$retp->nom_resp."</span><span class='ms-1'>".$retp->prenom_resp."</span></td>
                      
                        <td>".$retp->entreprise->email_etp."</td>
                        <td>".$this->group->formatting_phone($retp->telephone_resp)."</td>
                        <td>".$retp->created_at."</td>
                        <td>
                            <div class='dropdown'>
                                <div class='btn-group dropstart'>
                                    <button type='button' class='btn btn-default dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                                        <i class='fa fa-ellipsis-v'></i>
                                    </button>
                                    <ul class='dropdown-menu'>
                                        <a class='dropdown-item' href='".route('aff_parametre_referent',$retp->id)."'><button type='text' class='btn btn_enregistrer'>Afficher</button> </a>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>";
                }
                $output.="</tbody>";
            return $output;
    }
}
