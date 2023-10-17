<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depense', function (Blueprint $table) {
            $table->id();
            $table->string('depense');
            $table->integer('montant');
            $table->date('date_depense');
            $table->timestamps();
            /**
             * referencement de clé étrangère
             */
            $table->unsignedBigInteger('annee_id');
            $table->foreign('annee_id')->references('id')->on('annee')
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
        Schema::dropIfExists('depense');
    }
}
