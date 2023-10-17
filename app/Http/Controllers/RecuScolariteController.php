<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mes_models\Annee;
use App\mes_models\PaiementEleve;
use App\Traits\InfosUserThemeActive;
use App\mes_models\Eleve;
class RecuScolariteController extends Controller
{
    use InfosUserThemeActive;
    //

    public function gestion_recu()
    {
        /**
         * on appelle la methode InfosUser_AND_ThemeActive qui contient
         * le chemin du theme actif,le nom de l'utilisateur connecter,
         * la photo de profil de l'utilisateur connecter
         */
        $this->InfosUser_AND_ThemeActive();

        $chemin_theme_actif = $this->chemin_theme_actif;
        $nom = $this->nom;
        $avatar = $this->avatar;
        $annee_courante = $this->annee_courante;
        $all_annee = Annee::all();

        $all_recus = PaiementEleve::where('annee_id',$annee_courante->id)->groupBy('num_recu')->get();


        return view('pages.recu_scolarite.gestion_recu',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_recus'));
    }

    public function historique_recu_scolarite($id)
    {
        /**
         * on appelle la methode InfosUser_AND_ThemeActive qui contient
         * le chemin du theme actif,le nom de l'utilisateur connecter,
         * la photo de profil de l'utilisateur connecter
         */
        $this->InfosUser_AND_ThemeActive();

        $chemin_theme_actif = $this->chemin_theme_actif;
        $nom = $this->nom;
        $avatar = $this->avatar;
        $annee_courante = $this->annee_courante;
        $all_annee = Annee::all();

      $all_paiements =  PaiementEleve::where('annee_id',$annee_courante->id)->where('num_recu',$id)->get();

      $ids = array();

      foreach($all_paiements as $paiement)
      {
        $ids[] = $paiement->eleve_id;
      }

      $all_eleves = Eleve::whereIn('id',$ids)->get();
      $eleve = $all_eleves->first();
      if(empty($eleve))
      {
          return redirect()->route('gestion_recu');
      }

      $date_paiement = $all_paiements->first()->date_paiement->format('d/m/Y');
      $num_recu = $id;

      return view('pages.paiement_groupe_eleve.validation',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_eleves','eleve','num_recu','date_paiement'));
    }
}
