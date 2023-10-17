<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mes_models\Annee;
use App\mes_models\Auteur;
use App\mes_models\Category;
use App\mes_models\Livre;
use App\Traits\InfosUserThemeActive;
class LivreController extends Controller
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
        $all_auteurs = Auteur::all();
        $all_categories = Category::all();
        $all_livres = Livre::with(['auteur','category'])->get();
        $i = 1;
        return view('pages.livres/index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_auteurs','all_categories','i','all_livres'));
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
        $new_livre = Livre::create([
                                        'titre' => $request->titre,
                                        'isbn' => $request->ibsn,
                                        'annee' => $request->annee,
                                        'nbre_page' => $request->nbre_page,
                                        'nbre_examplaire' => $request->nbre_examplaire,
                                        'auteur_id' => $request->auteur_id,
                                        'category_id' => $request->category_id
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
        $modif = Livre::where('id',$id)->update([
                                                    'titre' => $request->titre,
                                                    'isbn' => $request->ibsn,
                                                    'annee' => $request->annee,
                                                    'nbre_page' => $request->nbre_page,
                                                    'nbre_examplaire' => $request->nbre_examplaire,
                                                    'auteur_id' => $request->auteur_id,
                                                    'category_id' => $request->category_id
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
       $delete = Livre::where('id',$id)->delete();

       return back();
    }
}
