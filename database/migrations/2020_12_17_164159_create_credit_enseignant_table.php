<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditEnseignantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_enseignant', function (Blueprint $table) {
            $table->id();
            $table->integer('somme_credit')->nullable();
            $table->string('motif')->nullable();
            $table->integer('somme_rembourser')->nullable();
            $table->string('type_paiement');
            $table->timestamps();
            /**
             * réferencement des clés étrangère
             */
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('credit_enseignant');
    }
}
