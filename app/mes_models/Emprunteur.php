<?php

namespace App\mes_models;

use Illuminate\Database\Eloquent\Model;

class Emprunteur extends Model
{
    //
    protected $table = 'emprunteur';

    protected $fillable = ['nom','prenom','quartier','contact'];

    public function emprunts()
    {
        return $this->hasMany('App\mes_models\Emprunt');
    }
}
