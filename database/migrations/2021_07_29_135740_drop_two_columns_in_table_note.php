<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTwoColumnsInTableNote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('note', function (Blueprint $table) {
            //
            $table->dropColumn(['note4','composition']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('note', function (Blueprint $table) {
            //
            $table->double('note4')->nullable();
            $table->double('composition')->nullable();
        });
    }
}
