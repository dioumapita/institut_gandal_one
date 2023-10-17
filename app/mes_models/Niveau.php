<?php

namespace App\mes_models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nom_niveau
 * @property string $options
 * @property string $created_at
 * @property string $updated_at
 * @property Inscrit[] $inscrits
 * @property MatiereNiveau[] $matiereNiveaus
 */
class Niveau extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'niveau';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['nom_niveau', 'options', 'moyennee_admission', 'scolarite','mensualite','tranche1', 'tranche2','tranche3','frais_inscription','frais_reinscription','created_at', 'updated_at'];

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
    public function inscrits()
    {
        return $this->hasMany('App\mes_models\Inscrit');
    }
    /**code ajouter */
    public function matieres()
    {
        return $this->belongsToMany(Matiere::class)->withPivot('coefficient','bareme');
    }
    /**end code ajouter */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matiereNiveaus()
    {
        return $this->hasMany('App\mes_models\MatiereNiveau');
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

     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany('App\mes_models\Note');
    }

    public function frais_scolaires()
    {
        return $this->hasMany('App\mes_models\FraisScolaire');
    }
}
