<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStagiairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stagiaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom_stagiaire');
            $table->string('prenom_stagiaire');
            $table->string('genre_stagiaire');
            $table->string('fonction_stagiaire');
            $table->string('mail_stagiaire');
            $table->string('telephone_stagiaire');
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
        Schema::dropIfExists('stagiaires');
    }
}
