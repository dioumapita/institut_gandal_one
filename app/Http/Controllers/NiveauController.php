<?php

namespace App\Http\Controllers;

use App\Http\Requests\NiveauFormRequest;
use App\mes_models\Niveau;
use Illuminate\Http\Request;
use App\Traits\InfosUserThemeActive;
use MercurySeries\Flashy\Flashy;
use App\mes_models\Annee;
use Illuminate\Support\Facades\Auth;
use Alert;
use App\mes_models\FraisScolaire;

class NiveauController extends Controller
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
        $this->InfosUser_AND_ThemeActive();
        $chemin_theme_actif = $this->chemin_theme_actif;
        $nom = $this->nom;
        $avatar = $this->avatar;
        $listes_niveaux = Niveau::orderBy('id')->get();
        $annee_courante = $this->annee_courante;
        $all_annee = Annee::all();

        return view('pages.niveaux.index',compact('chemin_theme_actif','nom','avatar','listes_niveaux','annee_courante','all_annee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->InfosUser_AND_ThemeActive();
        $chemin_theme_actif = $this->chemin_theme_actif;
        $nom = $this->nom;
        $avatar = $this->avatar;
        $annee_courante = $this->annee_courante;
        $all_annee = Annee::all();
        return view('pages.niveaux/create',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * empecher l'utilisateur de saisir deux classe identiques
         */
        if(Niveau::where('nom_niveau',$request->nom_niveau)
                 ->where('options',$request->options)
                 ->exists()
         )
         {
            alert('Attention','Vous avez déjà ajouter cette classe','success')->addImage('/assets/asset_principal/img_sweat_alert/alert4.jpg')->autoclose(false);
            return back();
         }

        $insertion = Niveau::create([
                                      'nom_niveau' => $request->nom_niveau,
                                      'options' => $request->options
                                    ]);

        //message flash
        Flashy::success('La classe a été ajouter avec succès');
        //redirection
        return redirect()->route('niveaux.index');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Niveau $niveau)
    {
        //
        $this->InfosUser_AND_ThemeActive();
        $chemin_theme_actif = $this->chemin_theme_actif;
        $nom = $this->nom;
        $avatar = $this->avatar;
        $annee_courante = $this->annee_courante;
        $all_annee = Annee::all();

        return view('pages.niveaux/edit',compact('chemin_theme_actif','nom','avatar','niveau','annee_courante','all_annee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Niveau $niveau)
    {
        /**
         * verifit si cette classe n'exite pas déjà
         */
        if(Niveau::where('nom_niveau',$request->nom_niveau)
                ->where('options',$request->options)
                ->exists()
            )
            {
                alert('Attention','Vous avez déjà ajouter cette classe','success')->addImage('/assets/asset_principal/img_sweat_alert/alert4.jpg')->autoclose(false);
                return back();
            }

        $modification = Niveau::where('id',$niveau->id)->update([
                                                                   'nom_niveau' => $request->nom_niveau,
                                                                   'options' => $request->options
                                                                ]);
        //message flash
        Flashy::success('La classe a été modifier avec succès');
        //redirection
        return redirect()->route('niveaux.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Niveau $niveau)
    {
        //
        $suppression = Niveau::where('id',$niveau->id)->delete();
        //message flash
        Flashy::success('La classe a été supprimer avec succès');
        //redirection
        return redirect()->route('niveaux.index');
    }

    /**
     *Configurations method get
     */
    public function config_niveau()
    {
        $this->InfosUser_AND_ThemeActive();
        $chemin_theme_actif = $this->chemin_theme_actif;
        $nom = $this->nom;
        $avatar = $this->avatar;
        $annee_courante = $this->annee_courante;
        $all_annee = Annee::all();
       /**
        * on affiche toute les salles de classe
        */
        $all_niveaux = Niveau::all();
        $i = 1;

        return view('pages.niveaux/config_niveau',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_niveaux','i'));

    }

    public function update_config_niveau(Request $request,$id)
    {
        // dd(Niveau::first()->frais_scolaires->first()->frais_inscription);
        // dd($request->mensualite);
        // dd($request->frais_reinscription);

        if(FraisScolaire::where('niveau_id',$id)->where('annee_id',$request->annee_id)
            ->exists()
        )
        {
            FraisScolaire::where('niveau_id',$id)->where('annee_id',$request->annee_id)
                    ->update([
                                'frais_inscription' => $request->frais_inscription,
                                'frais_reinscription' => $request->frais_reinscription,
                                'scolarite' => $request->scolarite_annuel,
                                'mensualite' => $request->mensualite,
                                'tranche1' => $request->tranche1,
                                'tranche1_reinscription' => $request->tranche1_reinscription,
                                'tranche2' => $request->tranche2,
                                'tranche3' => $request->tranche3,
                            ]);
        }
        else
        {
            FraisScolaire::create([
                'frais_inscription' => $request->frais_inscription,
                'frais_reinscription' => $request->frais_reinscription,
                'scolarite' => $request->scolarite_annuel,
                'mensualite' => $request->mensualite,
                'tranche1' => $request->tranche1,
                'tranche1_reinscription' => $request->tranche1_reinscription,
                'tranche2' => $request->tranche2,
                'tranche3' => $request->tranche3,
                'niveau_id' => $id,
                'annee_id' => $request->annee_id
             ]);
        }

        //message flash
        Flashy::success('Configuration effecutée avec succès');
       return back();
    }


}
