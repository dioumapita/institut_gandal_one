<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEleveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eleve', function (Blueprint $table) {
            $table->id();
            $table->string('matricule',50)->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->string('sexe');
            $table->date('date_naissance');
            $table->integer('telephone')->nullable();
            $table->string('quartier');
            $table->string('photo_profil')->default('photo_eleve.png');
            $table->string('nom_parent')->nullable();
            $table->string('prenom_parent')->nullable();
            $table->string('profession')->nullable();
            $table->string('telephone_parent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eleve');
    }
}
