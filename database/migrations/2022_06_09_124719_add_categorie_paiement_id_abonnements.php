<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoriePaiementIdAbonnements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('abonnements', function (Blueprint $table) {
            $table->unsignedBigInteger('categorie_paiement_id')->nullable();
            $table->foreign('categorie_paiement_id')->references('id')->on('categorie_paiements');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('abonnements', function (Blueprint $table) {
            //
        });
    }
}
