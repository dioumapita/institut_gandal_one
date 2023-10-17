<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArriererTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrierer', function (Blueprint $table) {
            $table->id();
            $table->integer('montant_arrierer')->nullable();
            $table->integer('montant_rembourser')->nullable();
            $table->date('date_ajout');
            $table->timestamps();
            /**
             * réferencement de clé étrangère
             */
            $table->unsignedBigInteger('eleve_id');
            $table->foreign('eleve_id')->references('id')->on('eleve')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            //la table annee
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
        Schema::dropIfExists('arrierer');
    }
}
