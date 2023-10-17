<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\InfosUserThemeActive;
use App\mes_models\Annee;
use App\mes_models\PaiementEnseignant;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;
use Alert;
use App\mes_models\CreditEnseignant;
use App\User;
use Spatie\Permission\Models\Role;

class PaiementEnseignantController extends Controller
{
    /**
     * le trait InfosUserThemeActive contient deux:traits
     * 1-le trait permettant de selectionner les informations
     *   de l'utilisateur connecté
     * 2-le trait permettant de selectionner le theme activer
     */
    use InfosUserThemeActive;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


        $all_enseignant = Role::where('name','Enseignant')->first()->users;

        return view('pages.paiement_enseignant/index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_enseignant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id_annee = DB::table('annee')->latest('id')->first()->id;

        $paiement_enseignant = PaiementEnseignant::create([
                                                            'user_id' => $request->user_id,
                                                            'mois_paiement' => $request->mois_paiement,
                                                            'somme_payer' => $request->montant,
                                                            'type_paiement' => $request->type_paiement,
                                                            'date_paiement' => $request->date_paiement,
                                                            'mois_paiement' => $request->mois_paiement,
                                                            'annee_id' => $id_annee
                                                         ]);
        //message flash
        Flashy::success('Paiement effectué avec succès');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
         /**
         * on appelle la methode InfosUser_AND_ThemeActive qui contient
         * le chemin du theme actif,le nom de l'utilisateur connecter,
         * la photo de profil de l'utilisateur connecter
         */
        $this->InfosUser_AND_ThemeActive();

        $chemin_theme_actif = $this->chemin_theme_actif;
        $nom = $this->nom;
        $avatar = $this->avatar;
        $all_annee = Annee::all();
        $annee_courante = $this->annee_courante;

        /**
         * on affiche les détails du paiement d'un enseignant au cour
         * de l'année scolaire
         */
        $id_annee = DB::table('annee')->latest('id')->first()->id;

        $all_paiement = PaiementEnseignant::where('user_id',$id)
                                          ->where('annee_id',$id_annee)
                                          ->orderBy('date_paiement','desc')
                                          ->with('user')
                                          ->get();
        $enseignant = User::where('id',$id)->first();
        return view('pages.paiement_enseignant/show',compact('chemin_theme_actif','nom','avatar','all_annee','annee_courante','all_paiement','enseignant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $modification = PaiementEnseignant::where('id',$id)->update([
                'somme_payer' => $request->montant,
                'mois_paiement' => $request->mois_paiement,
                'type_paiement' => $request->type_paiement,
                'date_paiement' => $request->date_paiement
        ]);

        //message flash
        Flashy::success('Modification effectuée avec succès');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $suppression = PaiementEnseignant::where('id',$id)->delete();

       //message flash
       Flashy::success('Suppression effectué avec succès');

       return back();
    }

    /**
     * Fonction permettant de afficher le paiement des enseignants par mois
     */

    public function paiement_enseignant_par_mois($id)
    {
                //
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

        $all_enseignant = Role::where('name','Enseignant')->first()->users;

        $num_mois = $id;

        return view('pages.paiement_enseignant/index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_enseignant','num_mois'));
    }

    /**
     * Gestion de l'état de paiement des enseignant
     */

    public function etat_paiement_enseignant()
    {
    //    /**
    //      * on appelle la methode InfosUser_AND_ThemeActive qui contient
    //      * le chemin du theme actif,le nom de l'utilisateur connecter,
    //      * la photo de profil de l'utilisateur connecter
    //      */
    //     $this->InfosUser_AND_ThemeActive();

    //     $chemin_theme_actif = $this->chemin_theme_actif;
    //     $nom = $this->nom;
    //     $avatar = $this->avatar;
    //     $annee_courante = $this->annee_courante;
    //     $all_annee = Annee::all();

    //     /**
    //      * on affiche seulement les enseignant qui ont emarger autrement qui ont enseigner
    //      */
    //     $all_enseignant = Role::find(3)->users;

    //     return view('pages.paiement_enseignant/etat_paiement_enseignant',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_enseignant'));
    }

    /**
     * Rétard paiement des enseignants
     */
    public function retard_paiement_enseignant()
    {
    //    /**
    //      * on appelle la methode InfosUser_AND_ThemeActive qui contient
    //      * le chemin du theme actif,le nom de l'utilisateur connecter,
    //      * la photo de profil de l'utilisateur connecter
    //      */
    //     $this->InfosUser_AND_ThemeActive();

    //     $chemin_theme_actif = $this->chemin_theme_actif;
    //     $nom = $this->nom;
    //     $avatar = $this->avatar;
    //     $annee_courante = $this->annee_courante;
    //     $all_annee = Annee::all();

    //     /**
    //      * on affiche seulement les enseignant qui ont emarger autrement qui ont enseigner
    //      */
    //     $all_enseignant = Role::find(3)->users;

    //     return view('pages.paiement_enseignant/retard_paiement_enseignant',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_enseignant'));
    }

    /**
     * Les enseignants en régle de paiement
     */
    public function total_paiement_enseignant()
    {
    //    /**
    //      * on appelle la methode InfosUser_AND_ThemeActive qui contient
    //      * le chemin du theme actif,le nom de l'utilisateur connecter,
    //      * la photo de profil de l'utilisateur connecter
    //      */
    //     $this->InfosUser_AND_ThemeActive();

    //     $chemin_theme_actif = $this->chemin_theme_actif;
    //     $nom = $this->nom;
    //     $avatar = $this->avatar;
    //     $annee_courante = $this->annee_courante;
    //     $all_annee = Annee::all();

    //     /**
    //      * on affiche seulement les enseignant qui ont emarger autrement qui ont enseigner
    //      */
    //     $all_enseignant = Role::find(3)->users;

    //     return view('pages.paiement_enseignant/total_paiement_enseignant',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_enseignant'));
    }
}
