<?php

namespace App\mes_models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $eleve_id
 * @property integer $matiere_id
 * @property integer $niveau_id
 * @property integer $annee_id
 * @property string $d_ab
 * @property string $status
 * @property string $duree
 * @property string $motif
 * @property string $commentaires
 * @property string $created_at
 * @property string $updated_at
 * @property Annee $annee
 * @property Eleve $eleve
 * @property Matiere $matiere
 * @property Niveau $niveau
 */
class AbsenceEleve extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'abs_eleve';

    /**
     * @var array
     */
    protected $fillable = ['status', 'duree', 'motif', 'commentaires', 'created_at', 'updated_at','eleve_id','matiere_id','niveau_id','annee_id','d_ab'];

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
