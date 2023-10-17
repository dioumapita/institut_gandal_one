<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsMonthInTrimestre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trimestre', function (Blueprint $table) {
            //
            $table->integer('mois1')->nullable();
            $table->integer('mois2')->nullable();
            $table->integer('mois3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trimestre', function (Blueprint $table) {
            //
            $table->dropColumn(['mois1','mois2','mois3']);
        });
    }
}
