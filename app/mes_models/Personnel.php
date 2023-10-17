<?php

namespace App\mes_models;

use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    //
    protected $table = 'personnel';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['nom','prenom','poste','telephone','quartier','document'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function creditPersonnels()
    {
        return $this->hasMany('App\mes_models\CreditPersonnel');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paiementPersonnels()
    {
        return $this->hasMany('App\mes_models\PaiementPersonnel');
    }
}
