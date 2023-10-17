<?php
/**
 * Je rémercie Dieu Tous ce projet c'est grâce à dieu ,
 * c'est Dieu qui me guide
 */
namespace App\Http\Controllers;

use App\mes_models\Annee;
use App\mes_models\EmploisDeTemp;
use App\mes_models\Niveau;
use Illuminate\Http\Request;
use App\Traits\InfosUserThemeActive;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;
use App\mes_models\Trimestre;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class EmploisDeTempsController extends Controller
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
        $all_niveau = Niveau::all();

        return view('pages.emplois_de_temps/index',compact('chemin_theme_actif','nom','avatar','all_niveau','annee_courante','all_annee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // $nom_niveau = Niveau::where('id',$id)->first()->nom_niveau.' '.Niveau::where('id',$id)->first()->options;
        // $nom_permission = 'Gestion de l\'emplois de temps de la '.$nom_niveau;
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

            $niveau_id = Niveau::where('id',$id)->first()->id;
            $niveau_choisit = Niveau::where('id',$id)->first();
            /**
             * on selectionne la dernière année scolaire tous simplement parce que on peut pas créer
             * un emplois de temps pour une année anterieur
             */
            $annee_id = DB::table('annee')->latest('id')->first()->id;

            $all_matiere = Niveau::where('id',$id)->first()->matieres;

            return view('pages.emplois_de_temps/create',compact('chemin_theme_actif','nom','avatar','all_matiere','niveau_id','annee_id','annee_courante','all_annee','niveau_choisit'));
        // }
        // else
        // {
        //     return view('errors.403');
        // }
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
       $heure_debut = $request->heure_debut;
       $heure_fin = $request->heure_fin;
       $recreation = $request->recreation;
       $niveau = $request->niveau;
       $annee = $request->annee;
        /**
         * empecher la création d'emplois de temps 2 fois pour une classe durant
         * une année scolaire
         */

        if(EmploisDeTemp::where('niveau_id',$request->niveau_choisi)
                        ->where('annee_id',$request->annee_choisi)
                        ->exists()
        )
        {
            alert('Attention','Vous avez déjà crée un emploi de temps pour cette classe','success')->addImage('/assets/asset_principal/img_sweat_alert/alert4.jpg')->autoclose(false);
                return back();
        }
        else
        {

                /**
                 * insertion pour le premier jour(Lundi)
                 */
                foreach($request->L_matiere as $key => $matiere)
                {

                    if(EmploisDeTemp::where('niveau_id',$request->niveau_choisi)
                                    ->where('annee_id',$request->annee_choisi)
                                    ->where('hr',$heure_debut[$key].$heure_fin[$key])
                                    ->exists()
                    )
                    {
                        /**si on une duplication de la clé primaire on supprimer l'emplois de
                         * temps de la classe et on n'imforme à l'utilisateur y'a un problème
                         */
                        $suppression = EmploisDeTemp::where('niveau_id',$request->niveau_choisi)
                                                    ->where('annee_id',$request->annee_choisi)
                                                    ->delete();

                        alert('Attention','Veuillez vérifier vos plages horaires','success')->addImage('/assets/asset_principal/img_sweat_alert/alert4.jpg')->autoclose(false);
                        return back();
                    }
                    else
                    {
                        $insertion1 = EmploisDeTemp::create([
                            'heure_debut' => $heure_debut[$key],
                            'heure_fin' => $heure_fin[$key],
                            'niveau_id' => $niveau[$key],
                            'annee_id' => $annee[$key],
                            'matiere_id' => $matiere,
                            'jr' => 1,
                            'hr' => $heure_debut[$key].$heure_fin[$key]
                            ]);
                    }
                }
                /**
                * insertion pour le deuxième jour (Mardi)
                */
                foreach($request->M_matiere as $key => $matiere)
                {

                    $insertion2 = EmploisDeTemp::create([
                                                        'heure_debut' => $heure_debut[$key],
                                                        'heure_fin' => $heure_fin[$key],
                                                        'niveau_id' => $niveau[$key],
                                                        'annee_id' => $annee[$key],
                                                        'matiere_id' => $matiere,
                                                        'jr' => 2,
                                                        'hr' => $heure_debut[$key].$heure_fin[$key]
                                                        ]);
                }
                /**
                 * insertion pour le troixième jour (Mercredi)
                 */
                foreach($request->Me_matiere as $key => $matiere)
                {
                    $insertion3 = EmploisDeTemp::create([
                                                            'heure_debut' => $heure_debut[$key],
                                                            'heure_fin' => $heure_fin[$key],
                                                            'niveau_id' => $niveau[$key],
                                                            'annee_id' => $annee[$key],
                                                            'matiere_id' => $matiere,
                                                            'jr' => 3,
                                                            'hr' => $heure_debut[$key].$heure_fin[$key]
                                                        ]);
                }
                /**
                 * insertion pour le quartrième jour (Jeudi)
                 */
                foreach($request->J_matiere as $key => $matiere)
                {
                    $insertion4 = EmploisDeTemp::create([
                                                            'heure_debut' => $heure_debut[$key],
                                                            'heure_fin' => $heure_fin[$key],
                                                            'niveau_id' => $niveau[$key],
                                                            'annee_id' => $annee[$key],
                                                            'matiere_id' => $matiere,
                                                            'jr' => 4,
                                                            'hr' => $heure_debut[$key].$heure_fin[$key]
                                                        ]);
                }
                /**
                 * insertion pour le cinquième jour (Vendredi)
                 */
                foreach($request->V_matiere as $key => $matiere)
                {
                    $insertion5 = EmploisDeTemp::create([
                                                            'heure_debut' => $heure_debut[$key],
                                                            'heure_fin' => $heure_fin[$key],
                                                            'niveau_id' => $niveau[$key],
                                                            'annee_id' => $annee[$key],
                                                            'matiere_id' => $matiere,
                                                            'jr' => 5,
                                                            'hr' => $heure_debut[$key].$heure_fin[$key]
                                                        ]);
                }
                /**
                 * insertion pour le sixième jour (Samedi)
                 */
                foreach($request->S_matiere as $key => $matiere)
                {
                    $insertion6 = EmploisDeTemp::create([
                                                            'heure_debut' => $heure_debut[$key],
                                                            'heure_fin' => $heure_fin[$key],
                                                            'niveau_id' => $niveau[$key],
                                                            'annee_id' => $annee[$key],
                                                            'matiere_id' => $matiere,
                                                            'jr' => 6,
                                                            'hr' => $heure_debut[$key].$heure_fin[$key]
                                                        ]);
                }
        }
            //message flash
            Flashy::success('L\'emploi du temps a été cré avec succès');
            return redirect()->route('emploi.show',$request->niveau_choisi);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $nom_niveau = Niveau::where('id',$id)->first()->nom_niveau.' '.Niveau::where('id',$id)->first()->options;
        // $nom_permission = 'Gestion de l\'emplois de temps de la '.$nom_niveau;

        // if(auth()->user()->hasPermissionTo($nom_permission))
        // {
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

            $annee_id = $annee_courante->id;

            $emplois_du_temps =EmploisDeTemp::where('niveau_id',$id)
                            ->where('annee_id',$annee_id)
                            ->orderBy('heure_debut')
                            ->with(['matiere','annee','niveau'])
                            ->get()->groupBy('heure_debut');
            //  dd($emplois_du_temps);


            $niveau_id = Niveau::where('id',$id)->first()->id;
            $niveau = Niveau::where('id',$id)->first();
            return view('pages.emplois_de_temps/show',compact('chemin_theme_actif','nom','avatar','emplois_du_temps','niveau_id','niveau','annee_courante','all_annee'));
        // }
        // else
        // {
        //     return view('errors.403');
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // $nom_niveau = Niveau::where('id',$id)->first()->nom_niveau.' '.Niveau::where('id',$id)->first()->options;
        // $nom_permission = 'Gestion de l\'emplois de temps de la '.$nom_niveau;

        // if(auth()->user()->hasPermissionTo($nom_permission))
        // {
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

            $all_matiere = Niveau::where('id',$id)->first()->matieres;

            /**
             * on selectionne la dernière année scolaire tous simplement parce que les modifications
             * ne sont autoriser que pour cette année scolaire
             */
            $annee_id = DB::table('annee')->latest('id')->first()->id;;

            $emplois_du_temps =EmploisDeTemp::where('niveau_id',$id)
                                ->where('annee_id',$annee_id)
                                ->orderBy('heure_debut')
                                ->with(['matiere','annee','niveau'])
                                ->get()->groupBy('heure_debut');

            $niveau_id = Niveau::where('id',$id)->first()->id;
            $niveau_choisit = Niveau::where('id',$id)->first();

            return view('pages.emplois_de_temps/edit',compact('chemin_theme_actif','nom','avatar','all_matiere','emplois_du_temps','niveau_id','annee_id','all_annee','annee_courante','niveau_choisit'));
        // }
        // else
        // {
        //     return view('errors.403');
        // }
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
        $heure_debut = $request->heure_debut;
        $heure_fin = $request->heure_fin;
        $niveau = $request->niveau;
        $annee = $request->annee;

        /**
         * Modification pour le prémier jour (Lundi)
         */
        foreach($request->L_matiere as $key => $matiere)
        {
            $modification = EmploisDeTemp::where('niveau_id',$niveau[$key])
                                         ->where('annee_id',$annee[$key])
                                         ->where('jr',1)
                                         ->where('hr',$heure_debut[$key].$heure_fin[$key])
                                         ->update([
                                                    'heure_debut' => $heure_debut[$key],
                                                    'heure_fin' => $heure_fin[$key],
                                                    'niveau_id' => $niveau[$key],
                                                    'annee_id' => $annee[$key],
                                                    'matiere_id' => $matiere,
                                                    'jr' => 1,
                                                    'hr' => $heure_debut[$key].$heure_fin[$key]
                                                 ]);
        }

        /**
         * Modification pour le deuxième jour (Mardi)
         */
        foreach($request->M_matiere as $key => $matiere)
        {
            $modification = EmploisDeTemp::where('niveau_id',$niveau[$key])
                                         ->where('annee_id',$annee[$key])
                                         ->where('jr',2)
                                         ->where('hr',$heure_debut[$key].$heure_fin[$key])
                                         ->update([
                                                    'heure_debut' => $heure_debut[$key],
                                                    'heure_fin' => $heure_fin[$key],
                                                    'niveau_id' => $niveau[$key],
                                                    'annee_id' => $annee[$key],
                                                    'matiere_id' => $matiere,
                                                    'jr' => 2,
                                                    'hr' => $heure_debut[$key].$heure_fin[$key]
                                                 ]);
        }

        /**
         * Modification pour le troisieme jour (Mercredi)
         */
        foreach($request->Me_matiere as $key => $matiere)
        {
            $modification = EmploisDeTemp::where('niveau_id',$niveau[$key])
                                         ->where('annee_id',$annee[$key])
                                         ->where('jr',3)
                                         ->where('hr',$heure_debut[$key].$heure_fin[$key])
                                         ->update([
                                                    'heure_debut' => $heure_debut[$key],
                                                    'heure_fin' => $heure_fin[$key],
                                                    'niveau_id' => $niveau[$key],
                                                    'annee_id' => $annee[$key],
                                                    'matiere_id' => $matiere,
                                                    'jr' => 3,
                                                    'hr' => $heure_debut[$key].$heure_fin[$key]
                                                 ]);
        }

        /**
         * Modification pour le quatrième jour (Jeudi)
         */
        foreach($request->J_matiere as $key => $matiere)
        {
            $modification = EmploisDeTemp::where('niveau_id',$niveau[$key])
                                         ->where('annee_id',$annee[$key])
                                         ->where('jr',4)
                                         ->where('hr',$heure_debut[$key].$heure_fin[$key])
                                         ->update([
                                                    'heure_debut' => $heure_debut[$key],
                                                    'heure_fin' => $heure_fin[$key],
                                                    'niveau_id' => $niveau[$key],
                                                    'annee_id' => $annee[$key],
                                                    'matiere_id' => $matiere,
                                                    'jr' => 4,
                                                    'hr' => $heure_debut[$key].$heure_fin[$key]
                                                 ]);
        }

        /**
         * Modification pour le cinquième jour (Vendredi)
         */
        foreach($request->V_matiere as $key => $matiere)
        {
            $modification = EmploisDeTemp::where('niveau_id',$niveau[$key])
                                         ->where('annee_id',$annee[$key])
                                         ->where('jr',5)
                                         ->where('hr',$heure_debut[$key].$heure_fin[$key])
                                         ->update([
                                                    'heure_debut' => $heure_debut[$key],
                                                    'heure_fin' => $heure_fin[$key],
                                                    'niveau_id' => $niveau[$key],
                                                    'annee_id' => $annee[$key],
                                                    'matiere_id' => $matiere,
                                                    'jr' => 5,
                                                    'hr' => $heure_debut[$key].$heure_fin[$key]
                                                 ]);
        }

        /**
         * Modification pour le sixième jour (Samedi)
         */
        foreach($request->S_matiere as $key => $matiere)
        {
            $modification = EmploisDeTemp::where('niveau_id',$niveau[$key])
                                         ->where('annee_id',$annee[$key])
                                         ->where('jr',6)
                                         ->where('hr',$heure_debut[$key].$heure_fin[$key])
                                         ->update([
                                                    'heure_debut' => $heure_debut[$key],
                                                    'heure_fin' => $heure_fin[$key],
                                                    'niveau_id' => $niveau[$key],
                                                    'annee_id' => $annee[$key],
                                                    'matiere_id' => $matiere,
                                                    'jr' => 6,
                                                    'hr' => $heure_debut[$key].$heure_fin[$key]
                                                 ]);
        }

        //message flash
        Flashy::success('L\'emploi du temps a été modifié avec succès');
        return redirect()->route('emploi.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $nom_niveau = Niveau::where('id',$id)->first()->nom_niveau.' '.Niveau::where('id',$id)->first()->options;
        // $nom_permission = 'Gestion de l\'emplois de temps de la '.$nom_niveau;

        // if(auth()->user()->hasPermissionTo($nom_permission))
        // {
            /**
             * on selectionne la dernière année scolaire tous simplement
             * parce que la modification est permise que pour cette année
             * scolaire
             */
            $annee_id = DB::table('annee')->latest('id')->first()->id;

            $suppression = EmploisDeTemp::where('niveau_id',$id)
                                        ->where('annee_id',$annee_id)
                                        ->delete();

            //message flash
            Flashy::success('L\'emploi du temps a été supprimé avec succès');
            return back();
        // }
        // else
        // {
        //     return view('errors.403');
        // }
    }

    /**
     * Methode permettant de gérer les trimestres
     */
    public function config_trimestre()
    {
        if(auth()->user()->hasPermissionTo('Gestion Des Trimestres'))
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
            $all_trimestres = Trimestre::all();
            $i = 1;
             return view('pages.trimestre/index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_trimestres','i'));
        }
        else
        {
            return view('errors.403');
        }
    }

    public function update_config_trimestre(Request $request,$id)
    {

        $update_config = Trimestre::where('id',$request->trimestre_id)
                            ->update([
                                        'mois1' => $request->mois1,
                                        'mois2' => $request->mois2,
                                        'mois3' => $request->mois3
                                    ]);

                    return back();

    }
}
