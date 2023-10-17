<?php

namespace App\mes_models;

use Illuminate\Database\Eloquent\Model;

class Auteur extends Model
{
    //
    protected $table = 'auteur';

    protected $fillable = ['nom','prenom','date_naiss','nationnalite'];

    protected $dates = ['date_naiss'];
}
