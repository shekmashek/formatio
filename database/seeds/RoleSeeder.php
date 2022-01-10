<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::FirstOrCreate(
            ['role_name' => 'admin']
        );
        Role::FirstOrCreate(
            ['role_name' => 'SuperAdmin']
        );
        Role::FirstOrCreate(
            ['role_name' => 'referent']
        );
        Role::FirstOrCreate(
            ['role_name' => 'manager']
        );
        Role::FirstOrCreate(
            ['role_name' => 'stagiaire']
        );
        Role::FirstOrCreate(
            ['role_name' => 'formateur']
        );
        Role::FirstOrCreate(
            ['role_name' => 'cfp']
        );

    }
}
