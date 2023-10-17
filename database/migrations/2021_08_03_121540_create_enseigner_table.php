<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnseignerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enseigner', function (Blueprint $table) {
            $table->integer('prix_heure')->nullable();
            $table->timestamps();

            //pour la table users
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

            //création de la clé primaire
            $table->primary(['user_id','matiere_id','niveau_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enseigner');
    }
}
