<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoriePaiementIdAbonnementCfps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('abonnement_cfps', function (Blueprint $table) {
            $table->unsignedBigInteger('categorie_paiement_id');
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
        Schema::table('abonnement_cfps', function (Blueprint $table) {
            //
        });
    }
}
