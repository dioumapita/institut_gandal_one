<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDateCreditInCreditEnseignant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('credit_enseignant', function (Blueprint $table) {
            //
            $table->date('date_credit')->after('type_paiement');
            $table->dropColumn('type_paiement');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('credit_enseignant', function (Blueprint $table) {
            //
            $table->dropColumn('date_credit');
            $table->string('type_paiement');
        });
    }
}
