<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMoyenneAdmissionInTableNiveau extends Migration
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
            $table->double('moyennee_admission')->default(0)->nullable()->after('options');
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
            $table->dropColumn('moyennee_admission');
        });
    }
}
