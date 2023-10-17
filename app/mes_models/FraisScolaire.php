<?php

namespace App\mes_models;

use Illuminate\Database\Eloquent\Model;

class FraisScolaire extends Model
{
    //

    protected $table = 'frais_scolaire';

    protected $fillable = ['scolarite','tranche1','tranche1_reinscription','tranche2','tranche3','frais_inscription','frais_reinscription','mensualite','niveau_id','annee_id'];

    public function niveau()
    {
        return  $this->belongsTo('App\mes_models\Niveau');
    }
}
