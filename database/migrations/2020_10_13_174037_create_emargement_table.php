<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmargementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emargement', function (Blueprint $table) {
            $table->id();
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->date('date_emarg');
            $table->string('heure_effectuer');
            $table->integer('gains');
            $table->timestamps();

            /**
             * référecement des clés
             */
            //pour la table user
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            //pour la table matiere
            $table->unsignedBigInteger('matiere_id');
            $table->foreign('matiere_id')->references('id')->on('matiere')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            //pour la table niveau
            $table->unsignedBigInteger('niveau_id');
            $table->foreign('niveau_id')->references('id')->on('niveau')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            //pour la table annee
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
        Schema::dropIfExists('emargement');
    }
}
