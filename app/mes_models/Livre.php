<?php

namespace App\mes_models;

use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    //
    protected $table = 'livre';

    protected $fillable = ['titre','isbn','annee','nbre_page','nbre_examplaire','auteur_id','category_id'];

    public function auteur()
    {
        return $this->belongsTo('App\mes_models\Auteur');
    }

    public function category()
    {
        return $this->belongsTo('App\mes_models\Category');
    }

    public function emprunts()
    {
        return $this->hasMany('App\mes_models\Emprunt');
    }
}
