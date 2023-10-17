<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDatePaiementInPaiementPersonnel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paiement_personnel', function (Blueprint $table) {
            //
            $table->date('date_paiement')->after('somme_payer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paiement_personnel', function (Blueprint $table) {
            //
            $table->dropColumn('date_paiement');
        });
    }
}
