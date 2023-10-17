<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnNumRecuInTablePaiementEleve extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paiement_eleve', function (Blueprint $table) {
            //
            $table->string('num_recu')->after('tranche');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paiement_eleve', function (Blueprint $table) {
            //
            $table->dropColumn('num_recu');
        });
    }
}
