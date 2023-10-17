<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementEnseignantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiement_enseignant', function (Blueprint $table) {
            $table->id();
            $table->integer('somme_payer');
            $table->string('type_paiement');
            $table->date('date_paiement');
            $table->timestamps();

            /**
             * référecement des clés étrangères
             */
            /**
             * table users
             */
             $table->unsignedBigInteger('user_id');
             $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            /**
             * table annee
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
        Schema::dropIfExists('paiement_enseignant');
    }
}
