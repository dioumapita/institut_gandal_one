<?php

namespace App;

use App\mes_models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'matricule', 'nom', 'prenom', 'username', 'email', 'telephone' ,'date_naiss', 'civilite', 'adresse', 'biographie', 'avatar', 'diplome_obtenu', 'password',
       'document'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * utilisation de la methode isOnline pour
     * verifier et afficher les utilisateurs connectés
     * on utilise Cache::has() pour verifier si la clé exite
     */
    public function isOnline()
    {
        return Cache::has('user-is-online' . $this->id);
    }

    protected $dates = ['last_seen'];


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
    public function emargements()
    {
        return $this->hasMany('App\mes_models\Emargement');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paiementEnseignants()
    {
        return $this->hasMany('App\mes_models\PaiementEnseignant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function creditEnseignants()
    {
        return $this->hasMany('App\mes_models\CreditEnseignant');
    }

    public function enseigneNiveaux()
    {
        return $this->hasMany('App\mes_models\EnseigneNiveau');
    }
}
