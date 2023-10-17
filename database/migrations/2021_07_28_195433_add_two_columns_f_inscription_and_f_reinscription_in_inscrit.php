<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTwoColumnsFInscriptionAndFReinscriptionInInscrit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inscrit', function (Blueprint $table) {
            //
            $table->integer('frais_inscription')->nullable();
            $table->integer('frais_reinscription')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inscrit', function (Blueprint $table) {
            //
            $table->dropColumn(['frais_inscription','frais_reinscription']);
        });
    }
}
