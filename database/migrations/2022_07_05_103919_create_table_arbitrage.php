<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableArbitrage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arbitrage', function (Blueprint $table) {
            $table->id();
            $table->string('departement');
            $table->string('service');
            $table->string('thematique');
            $table->string('cout');
            $table->integer('stagiaire_id');
            $table->integer('plan_id');
            $table->integer('besoin_id');
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
        Schema::dropIfExists('table_arbitrage');
    }
}
