<?php

namespace App\mes_models;

use Illuminate\Database\Eloquent\Model;

class CreditPersonnel extends Model
{
    //
    protected $table = 'credit_personnel';

    protected $fillable = ['montant_credit','montant_rembourser','motif','date_credit','personnel_id','annee_id'];

    protected $dates = ['date_credit'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongTo
     */
    public function personnel()
    {
        return $this->belongsTo('App\mes_models\Personnel');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function annee()
    {
        return $this->belongsTo('App\mes_models\Annee');
    }
}
