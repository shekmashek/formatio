<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->string('lieu');
            $table->string('h_debut');
            $table->string('h_fin');
            $table->date('date');
            $table->foreignId('projet_id')->constrained('projets');
            $table->foreignId('groupe_id')->constrained('groupes');
            $table->foreignId('session_id')->constrained('sessions');
            $table->foreignId('module_id')->constrained('modules');
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
        Schema::dropIfExists('details');
    }
}
