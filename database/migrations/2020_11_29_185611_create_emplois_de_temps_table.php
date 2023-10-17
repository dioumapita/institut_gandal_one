<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploisDeTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emplois_de_temps', function (Blueprint $table) {

            $table->string('heure_debut');
            $table->string('heure_fin');
            $table->timestamps();
            //référecement des clés étrangères

            //pour la table niveau
            $table->unsignedBigInteger('niveau_id');
            $table->foreign('niveau_id')->references('id')->on('niveau')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            //pour la table matière
            $table->unsignedBigInteger('matiere_id')->nullable();
            $table->foreign('matiere_id')->references('id')->on('matiere')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            //pour la table annee
            $table->unsignedBigInteger('annee_id');
            $table->foreign('annee_id')->references('id')->on('annee')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            //pour le jour
            $table->integer('jr');
            //pour l'heure du cour
            $table->string('hr');

            //la clé primaire
            $table->primary(['niveau_id','annee_id','jr','hr']);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emplois_de_temps');
    }
}
