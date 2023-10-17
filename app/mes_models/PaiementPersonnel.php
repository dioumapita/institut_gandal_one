<?php

namespace App\mes_models;

use Illuminate\Database\Eloquent\Model;

class PaiementPersonnel extends Model
{
    //
    protected $table = 'paiement_personnel';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

     /**
     * @var array
     */

    protected $fillable = ['somme_payer','type_paiement','date_paiement','personnel_id','annee_id'];

    protected $dates = ['date_paiement'];
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
