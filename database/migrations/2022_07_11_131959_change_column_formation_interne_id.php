<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnFormationInterneId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('module_internes', function (Blueprint $table) {
            $table->renameColumn('formation_id', 'formation_interne_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('module_internes', function (Blueprint $table) {
            $table->renameColumn('formation_interne_id', 'formation_id');
        });
    }
}
