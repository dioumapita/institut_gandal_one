<?php

namespace App\mes_models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $annee_id
 * @property int $somme_payer
 * @property string $type_paiement
 * @property string $date_paiement
 * @property string $created_at
 * @property string $updated_at
 * @property Annee $annee
 * @property User $user
 */
class PaiementEnseignant extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'paiement_enseignant';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'annee_id', 'somme_payer','mois_paiement','type_paiement', 'date_paiement', 'created_at', 'updated_at'];

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
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
