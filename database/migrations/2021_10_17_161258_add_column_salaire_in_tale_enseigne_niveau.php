<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSalaireInTaleEnseigneNiveau extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enseigne_niveau', function (Blueprint $table) {
            //
            $table->integer('salaire')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enseigne_niveau', function (Blueprint $table) {
            //
            $table->dropColumn('salaire');
        });
    }
}
