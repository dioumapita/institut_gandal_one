<?php

namespace App\Http\Controllers;

use App\Traits\InfosUserThemeActive;
use Illuminate\Http\Request;
use App\mes_models\Annee;
use App\mes_models\Niveau;
use MercurySeries\Flashy\Flashy;
class ConfigMoyenneController extends Controller
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
         * on selectionne tous les niveau pour pouvoir paramètrer les moyennes de passage
         * pour chaque niveau ou classe
         */
        $all_niveaux = Niveau::all();

        $i = 1;


        return view('pages.config_moyenne/index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_niveaux','i'));
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
        if(auth()->user()->hasPermissionTo('Configuration des moyennes d\'admission'))
        {
            /**
             * modification de la moyenne d'admission
             */
            $update_moyenne_admission = Niveau::where('id',$id)
                                            ->update([
                                                            'moyennee_admission' => $request->moyenne_admission
                                                        ]);
            //message flash
            Flashy::success('Configuration effectuée avec succès');
            return back();
        }
        else
        {
            return view('errors.403');
        }
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
