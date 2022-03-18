<?php

use Illuminate\Database\Seeder;
use App\offre_gratuit;
class OffreGratuitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        offre_gratuit::create([
            'limite' => '2',
            'type_abonne_id' => '2'
        ]);
        offre_gratuit::create([
            'limite' => '5',
            'type_abonne_id' => '1'
        ]);
    }
}
