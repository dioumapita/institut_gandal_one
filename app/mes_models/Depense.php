<?php

namespace App\mes_models;

use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    //

    protected $table = 'depense';

    protected $fillable = ['depense','montant','date_depense','annee_id','doc_depenses'];

    protected $dates = ['date_depense'];

    public function annee()
    {
        return $this->belongsTo('App\mes_models\Annee');
    }
}
