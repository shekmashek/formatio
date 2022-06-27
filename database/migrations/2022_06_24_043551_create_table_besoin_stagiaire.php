<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBesoinStagiaire extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('besoin_stagiaire', function (Blueprint $table) {
            $table->id();
            $table->integer('stagiaire_id');
            $table->integer('entreprise_id');
            $table->integer('domaines_id');
            $table->string('nom_domaine');
            $table->integer('thematique_id');
            $table->string('nom_formation');
            $table->integer('anneePlan_id');
            $table->string('objectif');
            $table->string('date_previsionnelle');
            $table->string('organisme');
            $table->string('statut');
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
        Schema::dropIfExists('besoin_stagiaire');
    }
}
