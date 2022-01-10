<?php

use Illuminate\Database\Seeder;
use App\Domaine;
class DomaineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Domaine::FirstOrCreate(
            ['nom_domaine' => 'Bureautique']
        );
        Domaine::FirstOrCreate(
            ['nom_domaine' => 'Développement Personnel']
        );
        Domaine::FirstOrCreate(
            ['nom_domaine' => 'Management']
        );
        Domaine::FirstOrCreate(
            ['nom_domaine' => 'Projet']
        );
        Domaine::FirstOrCreate(
            ['nom_domaine' => 'Ressources Humaines']
        );
        Domaine::FirstOrCreate(
            ['nom_domaine' => 'Communication - WebMarketing']
        );
    }
}
