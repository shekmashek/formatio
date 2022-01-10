<?php

use Illuminate\Database\Seeder;
use App\categorie_paiement;
class CategoriePaiement extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        categorie_paiement::FirstOrCreate(
            ['categorie' => 'Mensuel']
        );
        categorie_paiement::FirstOrCreate(
            ['categorie' => 'Annuel']
        );
    }
}
