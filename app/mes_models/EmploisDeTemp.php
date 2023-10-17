<?php

namespace App\mes_models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $niveau_id
 * @property integer $annee_id
 * @property int $jr
 * @property string $hr
 * @property integer $matiere_id
 * @property string $heure_debut
 * @property string $heure_fin
 * @property string $created_at
 * @property string $updated_at
 * @property Annee $annee
 * @property Matiere $matiere
 * @property Niveau $niveau
 */
class EmploisDeTemp extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['matiere_id', 'heure_debut', 'heure_fin', 'created_at', 'updated_at', 'niveau_id', 'annee_id', 'jr', 'hr'];

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
}
