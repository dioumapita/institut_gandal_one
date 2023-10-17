<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDocDepensesInDepenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('depense', function (Blueprint $table) {
            //
            $table->string('doc_depenses')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('depense', function (Blueprint $table) {
            //
            $table->dropColumn('doc_depenses');
        });
    }
}
