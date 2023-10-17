<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsTranchesInTableInNiveau extends Migration
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
            $table->integer('tranche1')->nullable()->after('scolarite');
            $table->integer('tranche2')->nullable()->after('tranche1');
            $table->integer('tranche3')->nullable()->after('tranche2');
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
            $table->dropColumn(['tranche1','tranche2','tranche3']);
        });
    }
}
