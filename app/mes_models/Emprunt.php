<?php

namespace App\mes_models;

use Illuminate\Database\Eloquent\Model;

class Emprunt extends Model
{
    //
    protected $table = 'emprunt';

    protected $fillable = ['date_debut','date_fin','status','livre_id','emprunteur_id'];

    public function emprunteur()
    {
        return $this->belongsTo('App\mes_models\Emprunteur');
    }

    public function livre()
    {
        return $this->belongsTo('App\mes_models\Livre');
    }

    protected $dates = ['date_debut','date_fin'];
}
