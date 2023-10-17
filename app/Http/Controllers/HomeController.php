<?php

namespace App\Http\Controllers;

use App\mes_models\Annee;
use App\mes_models\Inscrit;
use App\mes_models\Matiere;
use App\mes_models\Niveau;
use App\Traits\AnneeCourante;
use App\Traits\InfosUser;
use Illuminate\Http\Request;
use App\Traits\ThemeActive;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{


    use ThemeActive;
    use InfosUser;
    use AnneeCourante;
    /**
     * ThemeActive est un trait qui permet de recuperer le chemin du
     * theme activer avec la methode verifit_theme_active()
     * InfosUser est un trait permettant de recuperer les informations de
     * l'utilisateur connecté
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      //on récupère le chemin du thème actif
        $chemin_theme_actif = $this->verifit_theme_actif();

        //on récupère les informations de l'utilisateur connecter

        $info_user_connecter = $this->user_connecter();
        $nom = $info_user_connecter->nom;
        $avatar = $info_user_connecter->avatar;

        $annee_courante = $this->verifit_annee_courante();

        // dd($annee_courante);

        /**
         * on affiche toutes les années scolaire permettant à l'utilisateur de selectionner
         * l'année scolaire dans la qu'elle il veut travailler
         */

        $all_annee = Annee::all();
        /**
          *on selectionne l'id de la dernière année scolaire
          *on verifit si c'est id est égal à l'id de l'année courante
          *on peut autoriser l'inscription et la réinscription
          *au contraire on les desactives
        */
          $id_derniere_annee = DB::table('annee')->latest('id')->first()->id;
        //total inscrits pour l'année courante
        $total_inscrits = Inscrit::where('annee_id',$annee_courante->id)->count();
        //total enseignants
        $total_enseignants = Role::where('name','Enseignant')->first()->users->count();
        //total niveau
        $total_niveau = Niveau::count();
        //total matiere
        $total_matieres = Matiere::count();


        return view('pages.accueil/home',compact('chemin_theme_actif','nom','avatar','all_annee','annee_courante','id_derniere_annee','total_inscrits','total_niveau','total_enseignants','total_matieres'));
    }
}
