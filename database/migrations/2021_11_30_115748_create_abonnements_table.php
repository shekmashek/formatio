<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonnementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonnements', function (Blueprint $table) {
            $table->id();
            $table->date('date_demande');
            $table->date('date_debut')->nullable($value = true);
            $table->date('date_fin')->nullable($value = true);
            $table->string('mode_paiement');
            $table->string('status');
            $table->foreignId('type_abonnement_role_id')->constrained('type_abonnement_roles');
            $table->foreignId('entreprise_id')->constrained('entreprises');
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
        Schema::dropIfExists('abonnements');
    }
}
