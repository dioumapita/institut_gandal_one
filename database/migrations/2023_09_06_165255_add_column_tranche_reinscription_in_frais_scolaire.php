<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTrancheReinscriptionInFraisScolaire extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('frais_scolaire', function (Blueprint $table) {
            //
            $table->integer('tranche1_reinscription');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('frais_scolaire', function (Blueprint $table) {
            //
            $table->dropColumn('tranche1_reinscription');
        });
    }
}
