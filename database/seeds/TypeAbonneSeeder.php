<?php

use Illuminate\Database\Seeder;
use App\type_abonne;
class TypeAbonneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        type_abonne::FirstOrCreate(
            ['abonne_name' => 'entreprises']
        );
        type_abonne::FirstOrCreate(
            ['abonne_name' => 'cfps']
        );
    }
}
