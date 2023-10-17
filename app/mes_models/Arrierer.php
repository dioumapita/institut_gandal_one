<?php

namespace App\mes_models;

use Illuminate\Database\Eloquent\Model;

class Arrierer extends Model
{
    //
    protected $table = 'arrierer';

    protected $fillable = ['montant_arrierer','montant_rembourser','date_ajout','eleve_id','annee_id'];

    public function eleve()
    {
        return $this->belongsTo('App\mes_models\Arriere');
    }

    public function annee()
    {
        return $this->belongsTo('App\mes_models\Annee');
    }
}
