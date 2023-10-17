<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFraisScolaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frais_scolaire', function (Blueprint $table) {
            $table->id();
            $table->integer('scolarite')->nullable();
            $table->integer('tranche1')->nullable();
            $table->integer('tranche2')->nullable();
            $table->integer('tranche3')->nullable();
            $table->integer('frais_inscription')->nullable();
            $table->integer('frais_reinscription')->nullable();
            $table->integer('mensualite')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('niveau_id');
            $table->foreign('niveau_id')->references('id')->on('niveau')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

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
        Schema::dropIfExists('frais_scolaire');
    }
}
