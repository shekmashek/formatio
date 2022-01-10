<?php

use Illuminate\Database\Seeder;
use App\chefDepartement;
class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        chefDepartement::create([
            "nom_chef" => "Rakoto",
            "prenom_chef" => "Randria",
            "genre_chef" => "H",
            "fonction_chef" => "Chef de projet",
            "mail_chef" => "Rakoto@gmail.com",
            "telephone_chef" => "0341234566",
            "entreprise_id" => 8,
            "user_id" => 62,
            "photos" => 'manager.jpg'
         ]);
    }
}
