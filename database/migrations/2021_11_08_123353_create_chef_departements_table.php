<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChefDepartementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chef_departements', function (Blueprint $table) {
            $table->id();
            $table->string('nom_chef');
            $table->string('prenom_chef');
            $table->string('genre_chef');
            $table->string('fonction_chef');
            $table->string('mail_chef');
            $table->string('telephone_chef');
            $table->foreignId('entreprise_id')->constrained('entreprises');
            $table->foreignId('user_id')->constrained('users');
            $table->string('photos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chef_departements');
    }
}
