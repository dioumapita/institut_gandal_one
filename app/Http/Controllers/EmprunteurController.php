<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mes_models\Annee;
use App\mes_models\Emprunt;
use App\mes_models\Emprunteur;
use App\mes_models\Livre;
use App\Traits\InfosUserThemeActive;
class EmprunteurController extends Controller
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
        $all_emprunteurs = Emprunteur::all();
        $i = 1;
        return view('pages.emprunteur/index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_emprunteurs','i'));
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
         //enregistrement d'un emprunt de livre
         if($request->livre_id and $request->emprunteur_id)
        {
             $new_emprunt = Emprunt::create([
                                              'livre_id' => $request->livre_id,
                                              'emprunteur_id' => $request->emprunteur_id,
                                              'date_debut' => $request->date_debut,
                                              'date_fin' => $request->date_fin
                                           ]);

            return redirect()->route('emprunteur.show',$request->emprunteur_id);
        }
         else
        {
            //enregistrement d'un nouveau adherent
            $new_adherent = Emprunteur::create([
                                                'nom' => $request->nom,
                                                'prenom' => $request->prenom,
                                                'quartier' => $request->quartier,
                                                'contact' => $request->contact
                                            ]);

            return redirect()->route('emprunteur.show',$new_adherent->id);
        }


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
        $all_livres = Livre::all();
        $adherent = Emprunteur::where('id',$id)->first();
        $i = 1;
        return view('pages.emprunteur/show',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_livres','adherent','i'));
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
       if($request->nom)
       {
         $update_emprunteur = Emprunteur::where('id',$id)->update([
                                                                    'nom' => $request->nom,
                                                                    'prenom' => $request->prenom,
                                                                    'quartier' => $request->quartier,
                                                                    'contact' => $request->contact
                                                                 ]);

            return back();
        }

        if($request->livre_id)
        {
            $update_emprunt = Emprunt::where('id',$id)->update([
                                                                  'livre_id' => $request->livre_id,
                                                                  'date_debut' => $request->date_debut,
                                                                  'date_fin' => $request->date_fin
                                                              ]);


             return back();
        }
        //

        /**
         * update emprunt le status
         */
        if($request->status_livre == 1)
        {
            $update_emprunt = Emprunt::where('id',$id)->update([
                                                                'status' => 1
                                                            ]);
        }
        elseif($request->status_livre == 0)
        {
            $update_emprunt = Emprunt::where('id',$id)->update([
                                                                  'status' => 0
                                                               ]);
        }
        else
        {

        }

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

    public function emprunt_invalide()
    {
        /**
         * on niveau des emprunts invalide on affiche seulement les
         * emprunt qui ont le status 0
         */

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
        $all_emprunts = Emprunt::where('status',0)->get();
        $i = 1;
        return view('pages.emprunteur/emprunt_invalide',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_emprunts','i'));
    }
}
