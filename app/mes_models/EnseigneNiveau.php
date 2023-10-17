<?php

namespace App\mes_models;

use Illuminate\Database\Eloquent\Model;

class EnseigneNiveau extends Model
{
    //

    protected $table = 'enseigne_niveau';

    protected $fillable = ['user_id','niveau_id','status','salaire'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function niveau()
    {
        return $this->belongsTo('App\mes_models\Niveau');
    }
}
