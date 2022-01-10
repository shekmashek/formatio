<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsables', function (Blueprint $table) {
            $table->id();
            $table->string('nom_resp');
            $table->string('prenom_resp');
            $table->string('fonction_resp');
            $table->string('email_resp');
            $table->string('telephone_resp');
            $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('responsables');
    }
}
