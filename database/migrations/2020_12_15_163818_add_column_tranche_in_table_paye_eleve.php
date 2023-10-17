<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTrancheInTablePayeEleve extends Migration
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
            $table->string('tranche')->after('type_paiement');
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
            $table->dropColumn('type_paiement');
        });
    }
}
