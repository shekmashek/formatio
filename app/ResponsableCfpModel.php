<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\FonctionGenerique;

class ResponsableCfpModel extends Model
{
    protected $table="responsables_cfp";
    public function verify_form($input)
    {
        $rules = [
            'nom.required' => 'le Nom ne doit pas être null',
            'cin.required' => 'invalid',
             'phone.required' => 'le numero de télephone ne doit pas être null',
            'email.required' => 'le mail ne doit pas être null',
            'fonction.required' => 'le fonction ne doit pas être null'
        ];
        $critereForm = [
            'nom' => 'required',
            'cin' => 'required',
            'fonction' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ];
        $input->validate($critereForm, $rules);
    }

    // public function concat_nb_cin($input)
    // {
    //     $cin = $input["cin_1"] . $input["cin_2"] . $input["cin_3"] . $input["cin_4"] . $input["cin_5"] . $input["cin_6"] . $input["cin_7"] . $input["cin_8"] . $input["cin_9"] . $input["cin_10"] . $input["cin_11"] . $input["cin_12"];
    //     return $cin;
    // }

    public function verify_cin($cin)
    {
        // $cin = $this->concat_nb_cin($input);
        $data = DB::select('select * from users WHERE cin =?', [$cin]);
        return $data;
    }


    public function insert_resp_CFP($doner, $cfp_id, $user_id)
    {
        $data = [
            $doner["nom"], $doner["prenom"], $doner["cin"], $doner["email"], $doner["phone"], $doner["fonction"],
            $cfp_id, $user_id
        ];
        DB::beginTransaction();
        try {
            DB::insert('insert into employers(nom_emp,prenom_emp,cin_emp,email_emp,telephone_emp,fonction_emp
        ,entreprise_id,user_id,activiter,prioriter,created_at) values(?,?,?,?,?,?,?,?,1,0,NOW())', $data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
        return back()->with('success', 'Votre responsable a été enregistré avec succès!');
    }

    public function delete_resp_CFP($id_delete)
    {
        $fonct = new FonctionGenerique();
        $resp = $fonct->findWhereMulitOne("responsables_cfp", ["id"], [$id_delete]);

        DB::beginTransaction();
        try {
            DB::delete('delete from responsables_cfp where id=?', [$id_delete]);
            DB::delete('delete from users where id=?', [$resp->user_id]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
        return back()->with('success', 'terminé!');
    }
}
