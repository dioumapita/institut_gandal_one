<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditPersonnelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_personnel', function (Blueprint $table) {
            $table->id();
            $table->integer('montant_credit')->nullable();
            $table->integer('montant_rembourser')->nullable();
            $table->string('motif')->nullable();
            $table->date('date_credit');
            $table->timestamps();

            /**
             * Réferencement des clé étrangères
             */

              /**
             * table personnel
             */
            $table->unsignedBigInteger('personnel_id');
            $table->foreign('personnel_id')->references('id')->on('personnel')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            /**
             * table année
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
        Schema::dropIfExists('credit_personnel');
    }
}
