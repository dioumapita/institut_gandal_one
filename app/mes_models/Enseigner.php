<?php

namespace App\mes_models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $user_id
 * @property integer $matiere_id
 * @property integer $niveau_id
 * @property int $nbre_heure
 * @property int $prix_heure
 * @property int $prix_total
 * @property string $created_at
 * @property string $updated_at
 * @property Matiere $matiere
 * @property Niveau $niveau
 * @property User $user
 */
class Enseigner extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'enseigner';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'matiere_id', 'niveau_id', 'prix_heure', 'created_at', 'updated_at'];

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
