p<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       // $this->call(UsersTableSeeder::class);
         $this->call([
              // RoleSeeder::class,
              // DepartementSeeder::class,
              // ManagerSeeder::class,
              // DomaineSeeder::class,
              // CategoriePaiement::class,
              // TypeAbonneSeeder::class,
              // OffreGratuitSeeder::class
              
            ]);


    }
}
