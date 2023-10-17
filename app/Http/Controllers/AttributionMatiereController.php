<?php

namespace App\Http\Controllers;

use App\mes_models\Annee;
use App\mes_models\Enseigner;
use App\mes_models\Niveau;
use Illuminate\Http\Request;
use App\Traits\InfosUserThemeActive;
use Alert;
use MercurySeries\Flashy\Flashy;
use Spatie\Permission\Models\Role;
class AttributionMatiereController extends Controller
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

        $all_niveau = Niveau::all();


        return view('pages.attribution_matiere/index',compact('chemin_theme_actif','nom','avatar','all_niveau','all_annee','annee_courante'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd("bonjour");
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
        $niveau_choisi = Niveau::find(12)->first();
        $all_matiere  = $niveau_choisi->matieres;
        $annee_scolaire = Annee::first();

        return view('pages.attribution_matiere/create',compact('chemin_theme_actif','nom','avatar','all_enseignant','niveau_choisi','all_matiere','annee_scolaire','all_annee','annee_courante'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach($request->matiere as $key => $matiere)
        {

           if(Enseigner::where('matiere_id',$matiere)
                       ->where('niveau_id',$request->niveau_id)
                       ->exists()
            )
           {
                alert('Attention','Cette matière a été déjà attribuée à un enseignant pour cette classe','success')->addImage('/assets/asset_principal/img_sweat_alert/alert4.jpg')->autoclose(false);
                return back();
            }
            else
                {
                    $insertion = Enseigner::create([
                        'prix_heure' => $request->prix_heure,
                        'user_id' => $request->user_id,
                        'matiere_id' => $matiere,
                        'niveau_id' => $request->niveau_id
                    ]);
                }
        }
        //message flash
        Flashy::success('Attribution réussit avec succès');
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
        $modification = Enseigner::where('matiere_id',$id)
                                 ->where('user_id',$request->user_id)
                                 ->where('niveau_id',$request->niveau_id)
                                 ->update([
                                            'prix_heure' => $request->prix_heure
                                         ]);
        //message flash
        Flashy::success('Modification éffectuée avec succès');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        /**
         * retirer la matiere pour un enseignant donnée
         */

        $user_id = $request->user_id;
        $niveau_id = $request->niveau_id;

        $suppression = Enseigner::where('matiere_id',$id)
                                ->where('user_id',$user_id)
                                ->where('niveau_id',$niveau_id)
                                ->delete();
        //message flash
        Flashy::success('Matière retirée avec succès');
        return back();
    }

    /**
     * attribution de matiere par niveau
     */
    public function attribution_par_niveau($id)
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

        $all_enseignant = Role::where('name','Enseignant')->first()->users;
        $all_matiere = Niveau::where('id',$id)->first()->matieres;
        $niveau_id = Niveau::where('id',$id)->first()->id;
        $niveau_choisit = Niveau::where('id',$id)->first();
        $all_niveaux = Niveau::all();

        return view('pages.attribution_matiere/attribution_par_niveau',compact('chemin_theme_actif','nom','avatar','all_enseignant','all_matiere','niveau_id','all_annee','annee_courante','niveau_choisit','all_niveaux'));
    }
    /**
     * Détail attribution matière
     * liste des enseignants et de leurs matières enseigners
     */
    public function enseignant_matiere_niveau($id)
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

        /**
         * on selectionne tous les enseignants de ce niveau
         *
         */
        $all_enseignement = Enseigner::where('niveau_id',$id)->with('user','matiere','niveau')->get();
        // $all_matiere = Niveau::where('id',$id)->first()->matieres;
        $niveau_id = Niveau::where('id',$id)->first()->id;
        $niveau_choisit = Niveau::where('id',$id)->first();

        return view('pages.attribution_matiere/detail_attribution_par_niveau',compact('chemin_theme_actif','nom','avatar','all_enseignement','all_annee','annee_courante','niveau_id','niveau_choisit'));
    }
}
