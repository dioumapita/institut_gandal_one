<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementPersonnelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiement_personnel', function (Blueprint $table) {
            $table->id();
            $table->integer('somme_payer');
            $table->string('type_paiement');
            $table->timestamps();

             /**
             * referencement des clés étrangères(id_personnel,annee_scolaire)
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
        Schema::dropIfExists('paiement_personnel');
    }
}
