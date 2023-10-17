<?php

namespace App\mes_models;
use App\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $eleve_id
 * @property integer $matiere_id
 * @property integer $trimestre_id
 * @property integer $niveau_id
 * @property integer $annee_id
 * @property float $note1
 * @property float $note2
 * @property float $note3
 * @property float $moyenne
 * @property string $created_at
 * @property string $updated_at
 * @property Annee $annee
 * @property Eleve $eleve
 * @property Matiere $matiere
 * @property Niveau $niveau
 * @property Trimestre $trimestre
 */
class Note extends Model
{
    use HasCompositePrimaryKey;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'note';
    protected $primaryKey = ['eleve_id','matiere_id','trimestre_id' ,'niveau_id','annee_id'];
    /**
     * @var array
     */
    protected $fillable = ['note1', 'note2', 'note3', 'note4', 'composition', 'moyenne' ,'coefficient', 'nbre_notes', 'eleve_id','matiere_id','trimestre_id','niveau_id','annee_id', 'created_at', 'updated_at'];

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trimestre()
    {
        return $this->belongsTo('App\mes_models\Trimestre');
    }
}
