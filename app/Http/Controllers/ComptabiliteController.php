<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\InfosUserThemeActive;
use App\mes_models\Annee;
use App\mes_models\Arrierer;
use App\mes_models\CreditEnseignant;
use App\mes_models\CreditPersonnel;
use App\mes_models\Inscrit;
use App\mes_models\PaiementEnseignant;
use App\mes_models\PaiementPersonnel;
use App\mes_models\Depense;
class ComptabiliteController extends Controller
{
    //
    use InfosUserThemeActive;


    public function index()
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

        $total_paiement_enseignant = PaiementEnseignant::sum('somme_payer');

        $total_paiement_personnel = PaiementPersonnel::sum('somme_payer');

        $total_depense = Depense::sum('montant');

        $credit_enseignant = CreditEnseignant::sum('somme_credit');

        $remboursement_enseignant = CreditEnseignant::sum('somme_rembourser');

        $total_credit_enseignant = $credit_enseignant - $remboursement_enseignant;

        $credit_personnel = CreditPersonnel::sum('montant_credit');

        $remboursement_personnel = CreditPersonnel::sum('montant_rembourser');

        $total_credit_personnel = $credit_personnel - $remboursement_personnel;

        $total_arrierer = Arrierer::sum('montant_arrierer') - Arrierer::sum('montant_rembourser');

        $all_inscrits = Inscrit::where('annee_id',$annee_courante->id)->with('niveau','eleve')->get();

        return view('pages.comptabilite/index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_inscrits','total_paiement_enseignant','total_paiement_personnel','total_depense','total_credit_enseignant','total_credit_personnel','total_arrierer'));
    }
}
