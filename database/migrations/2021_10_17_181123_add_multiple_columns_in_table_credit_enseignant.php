<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleColumnsInTableCreditEnseignant extends Migration
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
            $table->string('type_de_credit');
            $table->integer('mois_remboursement')->nullable();
            $table->integer('debut_remboursement')->nullable();
            $table->integer('fin_remboursement')->nullable();
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
            $table->dropColumn(['type_de_credit','mois_remboursement','debut_remboursement','fin_remboursement']);
        });
    }
}
