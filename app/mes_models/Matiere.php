<?php

namespace App\mes_models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nom_matiere
 * @property string $created_at
 * @property string $updated_at
 * @property MatiereNiveau[] $matiereNiveaus
 * @property Note[] $notes
 */
class Matiere extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'matiere';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['nom_matiere', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function absEleves()
    {
        return $this->hasMany('App\mes_models\AbsEleve');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emargements()
    {
        return $this->hasMany('App\mes_models\Emargement');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matiereNiveaus()
    {
        return $this->hasMany('App\mes_models\MatiereNiveau');
    }
    /**code ajouter */
    public function niveaux()
    {
        return $this->belongsToMany(Niveau::class)->withPivot('coefficient','bareme');
    }
    /**end code ajouter */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany('App\mes_models\Note');
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function enseigners()
    {
        return $this->hasMany('App\mes_models\Enseigner');
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emploisDeTemps()
    {
        return $this->hasMany('App\mes_models\EmploisDeTemp');
    }
}
