<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemisePaiementEleveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remise_paiement_eleve', function (Blueprint $table) {
            $table->id();
            $table->integer('montant_reduit');
            $table->string('type');
            $table->date('date_reduction');
            $table->timestamps();

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
        Schema::dropIfExists('remise_paiement_eleve');
    }
}
