<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnseigneNiveauTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enseigne_niveau', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(1);
            $table->timestamps();
            /**
             * Referencement de clé étrangère
             */
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                                      ->onDelete('cascade')
                                      ->onUpdate('cascade');
            $table->unsignedBigInteger('niveau_id');
            $table->foreign('niveau_id')->references('id')->on('niveau')
                                       ->onDelete('cascade')
                                       ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enseigne_niveau');
    }
}
