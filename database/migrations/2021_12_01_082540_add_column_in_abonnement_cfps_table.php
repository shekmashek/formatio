<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInAbonnementCfpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('abonnement_cfps', function (Blueprint $table) {
            $table->foreignId('categorie_paiement_id')->constrained('categorie_paiements');
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
