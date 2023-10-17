<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mes_models\Annee;
use App\mes_models\Niveau;
use App\mes_models\Inscrit;
use Illuminate\Support\Facades\DB;
use App\Traits\InfosUserThemeActive;
class PaiementFraisReinscriptionController extends Controller
{
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
        /**
         * on selectionne l'id de la dernière année scolaire tous simplement parce que on
         * fait le payement que pour les élèves inscrit pour la dernières années scolaire
         */
        $id_annee = DB::table('annee')->latest('id')->first()->id;

        $all_inscriptions = Inscrit::where('annee_id',$id_annee)->where('status',1)->with('eleve','niveau')->get();
        $all_niveaux = Niveau::all();

        return view('pages.paiement_frais_reinscription/index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_inscriptions','all_niveaux'));
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
        //
        /**
         * on récupère l'id dernière année scolaire
         */
        $id_annee = DB::table('annee')->latest('id')->first()->id;
        $ancien_versement = Inscrit::where('annee_id',$id_annee)->where('niveau_id',$request->niveau_id)
                                    ->where('eleve_id',$request->eleve_id)
                                    ->first()->frais_reinscription;

        $update_versement = Inscrit::where('eleve_id',$request->eleve_id)->where('niveau_id',$request->niveau_id)
                                   ->where('annee_id',$id_annee)
                                   ->update([
                                               'frais_reinscription' => ($ancien_versement + $request->montant)
                                            ]);

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
        $annee_courante = $this->annee_courante;
        $all_annee = Annee::all();
        /**
         * on selectionne l'id de la dernière année scolaire tous simplement parce que on
         * fait le payement que pour les élèves inscrit pour la dernières années scolaire
         */
        $id_annee = DB::table('annee')->latest('id')->first()->id;

        $all_inscriptions = Inscrit::where('annee_id',$id_annee)->where('niveau_id',$id)->where('status',1)->with('eleve','niveau')->get();
        $all_niveaux = Niveau::all();
        $niveau_choisit = Niveau::where('id',$id)->first();

        return view('pages.paiement_frais_reinscription/paiement_frais_reinscription_par_niveau',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_inscriptions','all_niveaux','niveau_choisit'));
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
        //
         /**
         * on selectionne l'id de la dernière année scolaire tous simplement parce que on
         * fait le payement que pour les élèves inscrit pour la dernières années scolaire
         */
        $id_annee = DB::table('annee')->latest('id')->first()->id;
        $update_versement = Inscrit::where('eleve_id',$id)
                                   ->where('annee_id',$id_annee)
                                   ->update([
                                               'frais_reinscription' => $request->montant
                                            ]);


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
    }
}
