<?php

namespace App\mes_models;

use Illuminate\Database\Eloquent\Model;

class RemisePaiementEleve extends Model
{
    //

    protected $table = 'remise_paiement_eleve';

    protected $fillable = ['montant_reduit','type','date_reduction','eleve_id','annee_id'];

    protected $dates = ['date_reduction'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function eleve()
    {
        return $this->belongsTo('App\mes_models\Eleve');
    }

}
