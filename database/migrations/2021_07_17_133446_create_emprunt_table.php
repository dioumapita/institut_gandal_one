<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpruntTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emprunt', function (Blueprint $table) {
            $table->id();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('status')->default(0);
            $table->timestamps();

            /**
             * Referencement de clé étrangère
             */
            $table->unsignedBigInteger('livre_id');
            $table->foreign('livre_id')->references('id')->on('livre')
                                      ->onDelete('cascade')
                                      ->onUpdate('cascade');

            $table->unsignedBigInteger('emprunteur_id');
            $table->foreign('emprunteur_id')->references('id')->on('emprunteur')
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
        Schema::dropIfExists('emprunt');
    }
}
