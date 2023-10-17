<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnScolariteInTableNiveau extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('niveau', function (Blueprint $table) {
            //
            $table->integer('scolarite')->nullable()->after('moyennee_admission');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('niveau', function (Blueprint $table) {
            //
            $table->dropColumn('scolarite');
        });
    }
}
