<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFroidEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('froid_evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cours_id')->constrained('cours');
            $table->string('status');
            $table->foreignId('projet_id')->constrained('projets');
            $table->foreignId('stagiaire_id')->constrained('stagiaires');
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
        Schema::dropIfExists('froid_evaluations');
    }
}
