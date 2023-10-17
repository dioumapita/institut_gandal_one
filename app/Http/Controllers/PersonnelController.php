<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\InfosUserThemeActive;
use App\mes_models\Annee;
use App\mes_models\Personnel;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Str;
class PersonnelController extends Controller
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

        $all_personnels = Personnel::orderBy('id','desc')->get();
        $i = 1;

        return view('pages.personnels.index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_personnels','i'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

        return view('pages.personnels/create',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee'));
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
         * on passe à l'ajout du personnel dans la base
         */
        $ajout = Personnel::create([
                                        'nom' => Str::title($request->nom),
                                        'prenom' => Str::title($request->prenom),
                                        'poste' => $request->poste,
                                        'telephone' => $request->telephone,
                                        'quartier' => $request->quartier,
                                        'document' => Str::title($request->nom).' '.Str::title($request->prenom).'.pdf'
                                    ]);
        //message flash
         Flashy::success('Personnel ajouter avec succès');
         return redirect()->route('Personnel.index');
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

        $infos_personnel = Personnel::where('id',$id)->first();


        return view('pages.personnels.show',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','infos_personnel'));
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

        return view('pages.personnels/edit',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','personnel'));
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
        $modification = Personnel::where('id',$id)->update([
                                                            'nom' => Str::title($request->nom),
                                                            'prenom' => Str::title($request->prenom),
                                                            'poste' => $request->poste,
                                                            'telephone' => $request->telephone,
                                                            'quartier' => $request->quartier
                                                            ]);

       //message flash
       Flashy::success('Personnel modifier avec succès');
       return redirect()->route('Personnel.index');
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
            $suppression = Personnel::where('id',$id)->delete();
            //message flash
            Flashy::success('Personnel supprimeer avec succès');
       return redirect()->route('Personnel.index');

    }
}
