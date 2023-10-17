<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnNumRecuInTableInscrit extends Migration
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
            $table->integer('num_recu');
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
            $table->dropColumn('num_recu');
        });
    }
}
