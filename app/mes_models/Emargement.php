<?php

namespace App\mes_models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $matiere_id
 * @property integer $niveau_id
 * @property integer $annee_id
 * @property string $heure_debut
 * @property string $heure_fin
 * @property string $date_emarg
 * @property string $heure_effectuer
 * @property int $gains
 * @property string $created_at
 * @property string $updated_at
 * @property Annee $annee
 * @property Matiere $matiere
 * @property Niveau $niveau
 * @property User $user
 */
class Emargement extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'emargement';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'matiere_id', 'niveau_id', 'annee_id', 'heure_debut', 'heure_fin', 'date_emarg', 'heure_effectuer', 'gains', 'created_at', 'updated_at'];

    /**
     * utiliser pour faire le casting des colonnes en date
     */
    protected $dates = [
        'heure_debut',
        'heure_fin',
        'date_emarg'
    ];

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
    public function matiere()
    {
        return $this->belongsTo('App\mes_models\Matiere');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function niveau()
    {
        return $this->belongsTo('App\mes_models\Niveau');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
