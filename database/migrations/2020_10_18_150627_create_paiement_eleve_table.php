<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementEleveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiement_eleve', function (Blueprint $table) {
            $table->id();
            $table->integer('somme_payer');
            $table->string('type_paiement');
            $table->date('date_paiement');
            $table->timestamps();

            /**
             * référecement des clés 
             */
            //la table élève

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
        Schema::dropIfExists('paiement_eleve');
    }
}
