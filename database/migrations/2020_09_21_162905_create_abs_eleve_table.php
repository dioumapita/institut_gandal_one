<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsEleveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abs_eleve', function (Blueprint $table) {
            $table->string('status');
            $table->string('duree')->nullable();
            $table->string('motif')->nullable();
            $table->string('commentaires')->nullable();
            $table->timestamps();
            //référencements des clés étrangères

            //pour l'élève
            $table->unsignedBigInteger('eleve_id');
            $table->foreign('eleve_id')->references('id')->on('eleve')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            //pour la matière
            $table->unsignedBigInteger('matiere_id');
            $table->foreign('matiere_id')->references('id')->on('matiere')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            //pour le niveau
            $table->unsignedBigInteger('niveau_id');
            $table->foreign('niveau_id')->references('id')->on('niveau')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            //pour l'annee
            $table->unsignedBigInteger('annee_id');
            $table->foreign('annee_id')->references('id')->on('annee')
                 ->onDelete('cascade')
                 ->onUpdate('cascade');
            //la date d'absence fait partir de la clé primaire
            $table->date('d_ab');
            //création de la clé composite
            $table->primary(['d_ab','eleve_id','matiere_id','niveau_id','annee_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abs_eleve');
    }
}
