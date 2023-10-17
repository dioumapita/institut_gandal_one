<?php

namespace App\mes_models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $eleve_id
 * @property integer $annee_id
 * @property int $somme_payer
 * @property string $mois
 * @property string $date_paiement
 * @property string $created_at
 * @property string $updated_at
 * @property Annee $annee
 * @property Eleve $eleve
 */
class PaiementEleve extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'paiement_eleve';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['eleve_id', 'annee_id', 'somme_payer', 'type_paiement', 'mois' ,'tranche', 'num_recu' ,'date_paiement','status','created_at', 'updated_at'];

    protected $dates = ['date_paiement'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function annee()
    {
        return $this->belongsTo('App\mes_models\Annee');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function eleve()
    {
        return $this->belongsTo('App\mes_models\Eleve');
    }
}
