<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatiereFormRequest;
use App\mes_models\Associer;
use App\mes_models\Matiere;
use App\mes_models\Niveau;
use Illuminate\Http\Request;
use App\Traits\InfosUserThemeActive;
use Illuminate\Support\Arr;
use App\mes_models\Annee;
use App\mes_models\MatiereNiveau;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MatiereController extends Controller
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
        $all_matieres = Matiere::orderBy('nom_matiere')->get();
        $all_classes = Niveau::all();

        $i = 1;

        return view('pages.matieres/index',compact('chemin_theme_actif','nom','avatar','all_matieres','all_classes','annee_courante','all_annee','i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(auth()->user()->hasPermissionTo('Ajout de matière'))
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

            $all_niveau = Niveau::all();
            return view('pages.matieres/create',compact('chemin_theme_actif','nom','avatar','all_niveau','annee_courante','all_annee'));
        }
        else
        {
            return view('errors.403');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->hasPermissionTo('Ajout de matière'))
        {
            //règle de validation
            $request->validate([
                'nom_matiere' => 'required|string|unique:matiere,nom_matiere',
            ]);

            $nom_matiere = Str::title($request->nom_matiere);

            $matiere = Matiere::create([
                                        'nom_matiere' => $nom_matiere
                                    ]);
            //message flash
            Flashy::success('La matière à été ajouter avec succès');

            return back();
        }
        else
        {
            return view('errors.403');
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
        // $nom_niveau = Niveau::where('id',$request->niveau_id)->first()->nom_niveau.' '.Niveau::where('id',$request->niveau_id)->first()->options;
        // $nom_permission = 'Configuration des matières de la '.$nom_niveau;

        // if(auth()->user()->hasPermissionTo($nom_permission))
        // {
                /**
                * modification de la configuration de la matière pour
                *  le niveau choisit
                */
                $modif = MatiereNiveau::where('matiere_id',$id)
                                    ->where('niveau_id',$request->niveau_id)
                                    ->update([
                                                'coefficient' => $request->coefficient,
                                                'bareme' => $request->bareme
                                            ]);
                //message flash
                Flashy::success('Modification éffectuée avec succès');
                return back();
        // }
        // else
        // {
        //     return view('errors.403');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // $nom_niveau = Niveau::where('id',$request->niveau_id)->first()->nom_niveau.' '.Niveau::where('id',$request->niveau_id)->first()->options;
        // $nom_permission = 'Configuration des matières de la '.$nom_niveau;

        // if(auth()->user()->hasPermissionTo($nom_permission))
        // {
            /**
             * suppression de la matière pour le niveau choisit
             */
            $suppression = MatiereNiveau::where('matiere_id',$id)
                                        ->where('niveau_id',$request->niveau_id)
                                        ->delete();

            //message flash
            Flashy::success('La matière à été supprimée pour cette classe avec succès');
            //redirection
            return back();
        // }
        // else
        // {
        //     return view('errors.403');
        // }

    }

    /**
     * utiliser pour afficher les par classe
     */
    public function matiere_par_classe($id)
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

        $niveau = Niveau::where('id',$id)->first();

        $all_classes = Niveau::all();
        $i = 1;
        return view('pages.matieres.matiere_par_classe',compact('chemin_theme_actif','nom','avatar','niveau','all_classes','annee_courante','all_annee','i'));
    }

    /**
     * utiliser pour la configuration des matières
     */
    public function config()
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

        $all_matieres = Matiere::orderBy('nom_matiere')->get();
        $all_niveau = Niveau::all();
        $i = 1;

        return view('pages.matieres/config_matiere',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_matieres','all_niveau','i'));
    }

    /**
     * utiliser pour enregistrer la configuration des matières
     */
    public function store_config_matiere(Request $request)
    {
        $niveau = $request->niveau;
        // dd($niveau);
        $coefficient = $request->coefficient;
        $bareme = $request->bareme;
        $matiere = $request->matiere_id;

        // $nom_niveau = Niveau::where('id',$niveau)->first()->nom_niveau.' '.Niveau::where('id',$niveau)->first()->options;
        // $nom_permission = 'Configuration des matières de la '.$nom_niveau;
        // if(Permission::where('name',$nom_permission)->exists())
        // {

        // }
        // else
        // {
        //     $permission = Permission::create(['name' => $nom_permission]);
        //     $role = Role::where('name','Superviseur')->first();
        //     $role->givePermissionTo($nom_permission);
        // }
        // if(auth()->user()->hasPermissionTo($nom_permission))
        // {
            /**
             * onverifit si la matière choisi n'a pas été déjà attribuer à cette
             * classe. Si c'est le cason informe à l'utilisateur que cette matière
             *  à été déjà attribuer à cette classe
             */
            if(MatiereNiveau::where('niveau_id',$niveau)
                            ->where('matiere_id',$matiere)
                            ->exists()
            )
            {
                alert('Attention','Cette matière a été déjà attribuée à cette classe','success')->addImage('/assets/asset_principal/img_sweat_alert/alert4.jpg')->autoclose(false);
            }
            else
            {
                MatiereNiveau::create([
                    'niveau_id' => $niveau,
                    'matiere_id' => $matiere,
                    'coefficient' => $coefficient,
                    'bareme' => $bareme
                ]);

                //message flash
                Flashy::success('La matière a été attriubée à cette classe avec succès');

            }

            return back();
        // }
        // else
        // {
        //     return view('errors.403');
        // }
    }

    /** methode utiliser pour la modification d'une matiere */
    public function modification(Request $request,$id)
    {
        if(auth()->user()->hasPermissionTo('Modification de matière'))
        {
            $nom_matiere = Str::title($request->nom_matiere);
            /**
             * on passe à la modification du nom de la matière
             */
            $update = Matiere::where('id',$id)->update(['nom_matiere' => $nom_matiere]);
            //message flash
            Flashy::success('Modification éffectuée avec succès');
            return back();
        }
        else
        {
            return view('errors.403');
        }
    }

    /** methode permettan de supprimer une matiere */
    public function suppression($id)
    {
        if(auth()->user()->hasPermissionTo('Suppression de matière'))
        {
            /**
             * on passe à la suppression de la matière
             */
            $suppression = Matiere::where('id',$id)->delete();
            //message flash
            Flashy::success('Suppression éffectuée avec succès');
            return back();
        }
        else
        {
            return view('errors.403');
        }
    }

}
