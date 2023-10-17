<?php

namespace App\mes_models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $matiere_id
 * @property integer $niveau_id
 * @property int $coefficient
 * @property int $bareme
 * @property string $created_at
 * @property string $updated_at
 * @property Matiere $matiere
 * @property Niveau $niveau
 */
class MatiereNiveau extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'matiere_niveau';

    /**
     * @var array
     */
    protected $fillable = ['matiere_id', 'niveau_id', 'coefficient', 'bareme', 'created_at', 'updated_at'];

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
}
