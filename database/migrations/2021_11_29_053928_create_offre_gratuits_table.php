<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffreGratuitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offre_gratuits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('limite');
            $table->foreignId('type_abonne_id')->constrained('type_abonnes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offre_gratuits');
    }
}
