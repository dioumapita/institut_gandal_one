<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\InfosUserThemeActive;
use App\mes_models\Annee;
use App\mes_models\PaiementPersonnel;
use App\mes_models\Personnel;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;

class PaiementPersonnelController extends Controller
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

        $all_personnels = Personnel::all();

        return view('pages.paiement_personnel/index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_personnels'));
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
         *  on recupère la dernière année scolaire
         */
        $annee_id = DB::table('annee')->latest('id')->first()->id;
        $paiement_du_personnel = PaiementPersonnel::create([
                                                              'somme_payer' => $request->montant,
                                                              'type_paiement' => $request->type_paiement,
                                                              'date_paiement' => $request->date_paiement,
                                                              'personnel_id' => $request->personnel_id,
                                                              'annee_id' => $annee_id
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
        $annee_courante = $this->annee_courante;
        $all_annee = Annee::all();
        $personnel = Personnel::where('id',$id)->first();
        return view('pages.paiement_personnel/show',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','personnel'));

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
        $modif_paiement = PaiementPersonnel::where('id',$id)
                                           ->update([
                                                      'somme_payer' => $request->montant,
                                                      'type_paiement' => $request->type_paiement,
                                                      'date_paiement' => $request->date_paiement
                                                   ]);
         //message flash
         Flashy::success('Modification effectué avec succès');
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
        $suppression_paiement = PaiementPersonnel::where('id',$id)->delete();

        //message flash
        Flashy::success('Suppression effectué avec succès');
         return back();

    }
}
