<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMoisPaiementEnseignantInTablePaiementEnseignant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paiement_enseignant', function (Blueprint $table) {
            //
            $table->integer('mois_paiement')->after('type_paiement');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paiement_enseignant', function (Blueprint $table) {
            //
            $table->dropColumn('mois_paiement');
        });
    }
}
