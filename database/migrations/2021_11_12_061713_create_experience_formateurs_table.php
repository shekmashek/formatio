<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceFormateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience_formateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom_entreprise');
            $table->string('poste_occuper');
            $table->date('debut_travail');
            $table->date('fin_travail');
            $table->string('taches');
            $table->string('domaine');
            $table->string('skills');
            $table->foreignId('formateur_id')->constrained('formateurs');
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
        Schema::dropIfExists('experience_formateurs');
    }
}
