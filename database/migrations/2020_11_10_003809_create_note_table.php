<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note', function (Blueprint $table) {
            $table->double('note1')->nullable();
            $table->double('note2')->nullable();
            $table->double('note3')->nullable();
            $table->double('note4')->nullable();
            $table->double('composition')->nullable();
            $table->double('moyenne')->nullable();
            $table->double('coefficient')->nullable();
            $table->double('nbre_notes')->nullable();
            $table->timestamps();
            //referencement des clés étrangères
            //eleve
            $table->unsignedBigInteger('eleve_id');
            $table->foreign('eleve_id')->references('id')->on('eleve')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            //matiere
            $table->unsignedBigInteger('matiere_id');
            $table->foreign('matiere_id')->references('id')->on('matiere')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            //trimestre
            $table->unsignedBigInteger('trimestre_id');
            $table->foreign('trimestre_id')->references('id')->on('trimestre')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            //niveau
            $table->unsignedBigInteger('niveau_id');
            $table->foreign('niveau_id')->references('id')->on('niveau')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            //annee
            $table->unsignedBigInteger('annee_id');
            $table->foreign('annee_id')->references('id')->on('annee')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
                  
            //cle primaire
            $table->primary(['eleve_id','matiere_id','trimestre_id','niveau_id','annee_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('note');
    }
}
