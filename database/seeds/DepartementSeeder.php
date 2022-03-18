<?php

use Illuminate\Database\Seeder;
use App\Departement;
class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departement::FirstOrCreate(
            ['nom_departement' => 'Achat']
        );
        Departement::FirstOrCreate(
            ['nom_departement' => 'Administratio,comptabilité et finance']
        );
        Departement::FirstOrCreate(
            ['nom_departement' => 'IT et Télécommunications ']
        );

        Departement::FirstOrCreate(
            ['nom_departement' => 'Ingénierie et Technique']
        );
        Departement::FirstOrCreate(
            ['nom_departement' => 'Management et Direction']
        );
        Departement::FirstOrCreate(
            ['nom_departement' => 'Marketing, Publicité et Evénement']
        );
        Departement::FirstOrCreate(
            ['nom_departement' => 'Production']
        );
        Departement::FirstOrCreate(
            ['nom_departement' => 'Recherche et développement']
        );
        Departement::FirstOrCreate(
            ['nom_departement' => 'Ressources humaines']
        );
        Departement::FirstOrCreate(
            ['nom_departement' => 'Secrétariat et Support Administratif']
        );
        Departement::FirstOrCreate(
            ['nom_departement' => 'Service légal']
        );
        Departement::FirstOrCreate(
            ['nom_departement' => 'Transport et Logistique']
        );
        Departement::FirstOrCreate(
            ['nom_departement' => 'Vente']
        );

    }
}
