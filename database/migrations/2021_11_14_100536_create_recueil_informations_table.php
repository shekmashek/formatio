<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecueilInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recueil_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formation_id')->constrained('formations');
            $table->foreignId('stagiaire_id')->constrained('stagiaires');
            $table->foreignId('entreprise_id')->constrained('entreprises');
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
        Schema::dropIfExists('recueil_informations');
    }
}
