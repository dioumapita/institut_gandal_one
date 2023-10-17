<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livre', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('isbn');
            $table->year('annee');
            $table->integer('nbre_page');
            $table->integer('nbre_examplaire');
            $table->timestamps();

            /**
             * Réferencement de clé étrangère
             */
            $table->unsignedBigInteger('auteur_id');
            $table->foreign('auteur_id')->references('id')->on('auteur')
                                        ->onDelete('cascade')
                                        ->onUpdate('cascade');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('category')
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
        Schema::dropIfExists('livre');
    }
}
