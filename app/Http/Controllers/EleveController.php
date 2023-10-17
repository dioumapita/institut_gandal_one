<?php

namespace App\Http\Controllers;

use App\mes_models\Annee;
use App\mes_models\Arrierer;
use App\mes_models\Eleve;
use App\mes_models\Inscrit;
use App\mes_models\Niveau;
use App\Traits\InfosUserThemeActive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Alert;
class EleveController extends Controller
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

        //on affiche seulement les élèves de l'année scolaire selectionner
        $id_annee_courante = $annee_courante->id;
        $all_inscriptions = Inscrit::where('annee_id',$id_annee_courante)
                                   ->orderBy('created_at','desc')
                                   ->get();

        /**
         * on selectionne toutes les années scolaires pour permettre à l'utilisateur
         * de selectionner l'année dans la qu'elle il veut travailler
         */

        $all_annee = Annee::all();
        /**
         * on selectionnne toutes les classes et les années scolaires
         */
        $all_classes = Niveau::all();
        $all_annees = Annee::all();
        $id_niveau = null;
        return view('pages.eleves/index',compact('chemin_theme_actif','nom','avatar','all_inscriptions','all_classes','all_annees','id_niveau','annee_courante','all_annee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(auth()->user()->hasPermissionTo('Inscription'))
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

            /**
             * on selectionne l'id la dernière année scolaire pour faire l'inscription
             * on doit  pasfaire l'inscription sur une année déjà ecouler
             */
            $id_annee = DB::table('annee')->latest('id')->first()->id;
            /**
             * on selectionnne toutes les classes et les années scolaires
             */
            $all_classes = Niveau::all();
            $all_annee = Annee::all();

            return view('pages.eleves.create',compact('chemin_theme_actif','nom','avatar','all_classes','all_annee','id_annee','annee_courante'));
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

        if(Eleve::where('nom',$request->nom)
                ->where('prenom',$request->prenom)
                ->where('sexe',$request->sexe)
                ->where('date_naissance',$request->date_naissance)
                ->where('quartier',$request->quartier)
                ->where('nom_parent',$request->nom_parent)
                ->where('prenom_parent',$request->prenom_parent)
                ->where('profession',$request->profession)
                ->where('telephone_parent',$request->telephone_parent)
                ->exists()
            )
            {
                alert('Attention','Cet élève a déjà été inscrit','success')->addImage('/assets/asset_principal/img_sweat_alert/alert4.jpg')->autoclose(false);
                return back();
            }
        else{
                /**on verifit si l'utilisateur à selectionner selectionner l'image et la prise
                 * via le webcam si c'est le cas on prend l'image du webcam
                 */
                if($request->images != null And $request->photo_eleve != null)
                {
                    //on recupère l'image prise via le webcam
                    $img = $request->images;
                    //on precise le chemin du stockage de l'image
                        $folderPath = "images/photos/eleves/";
                    //on fait des traitement avec explode
                        $image_parts = explode(";base64,", $img);
                        $image_type_aux = explode("image/", $image_parts[0]);
                        $image_type = $image_type_aux[1];
                    //on decode l'image
                        $image_base64 = base64_decode($image_parts[1]);
                    //on donne un nom unique a l'image avec la function time()
                        $fileName = time() . '.jpg';
                    //on concatene le nom du dossier au nom du fichier
                        $file = $folderPath . $fileName;
                    //on utilise la fonction file_put_contents pour deplace l'image vers la destination
                        file_put_contents($file, $image_base64);
                }
                //traitement de l'image prise via le webcam
                if($request->images != null)
                    {
                        //on recupère l'image prise via le webcam
                            $img = $request->images;
                        //on precise le chemin du stockage de l'image
                            $folderPath = "images/photos/eleves/";
                        //on fait des traitement avec explode
                            $image_parts = explode(";base64,", $img);
                            $image_type_aux = explode("image/", $image_parts[0]);
                            $image_type = $image_type_aux[1];
                        //on decode l'image
                            $image_base64 = base64_decode($image_parts[1]);
                        //on donne un nom unique a l'image avec la function time()
                            $fileName = time() . '.jpg';
                        //on concatene le nom du dossier au nom du fichier
                            $file = $folderPath . $fileName;
                        //on utilise la fonction file_put_contents pour deplace l'image vers la destination
                            file_put_contents($file, $image_base64);
                    }
                //traitement de l'image uploader
                else if($request->photo_eleve != null){
                    $request->validate([
                        'photo_eleve' => 'image|mimes:png,jpg,jpeg|max:1024'
                    ]);
                    //on récupère l'extension de l'image(png,jpg,jpeg,...)
                        $extension = $request->file('photo_eleve')->extension();
                    //on donne un nom à l'image en utilisant la fonction time()
                        $fileName = time().'.'.$extension;
                    //on deplace l'image vers le dossier eleves
                        $request->file('photo_eleve')->storeAs('eleves',$fileName);
                }
                else{
                    $fileName = "photo_eleve.png";
                }



                /**
                 * validation des données
                */
                $request->validate([
                        'matricule' => 'unique:eleve,matricule',
                ]);

                /**
                 * Gestions du matricule des élèves
                 * pour créer le matricule des élèves on récupère le
                 * premier caractère du nom,du prenom et on contatene
                 * à 1111
                 */
                /**
                 * utilisation de Str::title($value)
                */
                $nom_eleve = Str::title($request->nom);
                $prenom_eleve = Str::title($request->prenom);
                $quartier = Str::title($request->quartier);
                $nom_parent = Str::title($request->nom_parent);
                $prenom_parent = Str::title($request->prenom_parent);
                $profession = Str::title($request->profession);

                $id_last_eleve = DB::table('eleve')->latest('id')->first();
                if($id_last_eleve != null)
                {
                    /**
                     * on récupère le premier caractère du nom ainsi que du prénom
                     */
                    $caractere_nom = Str::substr($nom_eleve,0,1);
                    $caractere_prenom = Str::substr($prenom_eleve,0,1);
                    $debut_matricule = $caractere_nom.$caractere_prenom;
                    $valeur = 111111 + $id_last_eleve->id;
                    $matricule = 'S-'.$debut_matricule.$valeur;
                }
                else
                {
                    $caractere_nom = Str::substr($nom_eleve,0,1);
                    $caractere_prenom = Str::substr($prenom_eleve,0,1);
                    $debut_matricule = $caractere_nom.$caractere_prenom;
                    $valeur = 111111;
                    $matricule = 'S-'.$debut_matricule.$valeur;
                }


                $ajout_eleve = Eleve::create([
                    'matricule' => $matricule,
                    'nom' => $nom_eleve,
                    'prenom' => $prenom_eleve,
                    'sexe' => $request->sexe,
                    'date_naissance' => $request->date_naissance,
                    'telephone' => $request->telephone,
                    'photo_profil' => $fileName,
                    'quartier' => $quartier,
                    'nom_parent' => $nom_parent,
                    'prenom_parent' => $prenom_parent,
                    'profession' => $profession,
                    'telephone_parent' => $request->telephone_parent
                ]);
                if($request->status == 1)
                {
                    $new_arriere = Arrierer::create([
                                                    'montant_arrierer' => $request->montant_arrierer,
                                                    'date_ajout' => now(),
                                                    'eleve_id' => $ajout_eleve->id,
                                                    'annee_id' => $request->annee_id
                                                    ]);
                }
                $inscription = Inscrit::create([
                                                'date_inscription' => now(),
                                                'eleve_id' => $ajout_eleve->id,
                                                'niveau_id' => $request->classe,
                                                'annee_id' => $request->annee_id,
                                                'frais_inscription' => $request->frais_inscription,
                                                'frais_reinscription' => $request->frais_reinscription,
                                                'status' => $request->status,
                                            ]);

                //message flash
                    Flashy::success('L\'eleve a été inscrit avec succès');
                //redirection vers la page d'acceuil
                    return redirect()->route('eleve.index');
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Eleve $eleve)
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

        return view('pages.eleves/show',compact('chemin_theme_actif','nom','avatar','eleve','annee_courante','all_annee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Eleve $eleve)
    {
        //
        if(auth()->user()->hasPermissionTo('Modification D\'un Elève'))
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

            /**
             * on selectionne l'id la dernière année scolaire pour faire l'inscription
             * on doit faire l'inscription sur une année déjà ecouler
             */
            $id_annee = DB::table('annee')->latest('id')->first()->id;

            $niveau_courant = Inscrit::where('eleve_id',$eleve->id)
                                ->where('annee_id',$id_annee)
                                ->first();
            // dd($niveau_courant);
            // dd($niveau_courant);

            /**
             * on selectionnne toutes les classes et les années scolaires
             */
            $all_classes = Niveau::all();
            $all_annee = Annee::all();

            return view('pages.eleves.edit',compact('chemin_theme_actif','nom','avatar','eleve','all_classes','all_annee','annee_courante','niveau_courant'));
        }
        else
        {
            return view('errors.403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Eleve $eleve)
    {
        /**on verifit si l'utilisateur à selectionner selectionner l'image et la prise
         * via le webcam si c'est le cas on prend l'image du webcam
         */
        if($request->images != null And $request->photo_eleve != null)
        {
            //on recupère l'image prise via le webcam
            $img = $request->images;
            //on precise le chemin du stockage de l'image
                $folderPath = "images/photos/eleves/";
            //on fait des traitement avec explode
                $image_parts = explode(";base64,", $img);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
            //on decode l'image
                $image_base64 = base64_decode($image_parts[1]);
            //on donne un nom unique a l'image avec la function time()
                $fileName = time() . '.jpg';
            //on concatene le nom du dossier au nom du fichier
                $file = $folderPath . $fileName;
            //on utilise la fonction file_put_contents pour deplace l'image vers la destination
                file_put_contents($file, $image_base64);
            //on passe à la modification du nom de l'image dans la base de donnée

            $update_image = Eleve::where('id',$eleve->id)
            ->update([
                       'photo_profil' => $fileName
                     ]);
        }

        //traitement de l'image prise via le webcam
        if($request->images != null)
            {
                //on recupère l'image prise via le webcam
                    $img = $request->images;
                //on precise le chemin du stockage de l'image
                    $folderPath = "images/photos/eleves/";
                //on fait des traitement avec explode
                    $image_parts = explode(";base64,", $img);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
                //on decode l'image
                    $image_base64 = base64_decode($image_parts[1]);
                //on donne un nom unique a l'image avec la function time()
                    $fileName = time() . '.jpg';
                //on concatene le nom du dossier au nom du fichier
                    $file = $folderPath . $fileName;
                //on utilise la fonction file_put_contents pour deplace l'image vers la destination
                    file_put_contents($file, $image_base64);

                //on passe à la modification du nom de l'image dans la base de donnée

                $update_image = Eleve::where('id',$eleve->id)
                                     ->update([
                                                'photo_profil' => $fileName
                                              ]);
            }
        //traitement de l'image uploader
        else if($request->photo_eleve != null)
            {
                $request->validate([
                    'photo_eleve' => 'image|mimes:png,jpg,jpeg|max:1024'
                ]);
                //on récupère l'extension de l'image(png,jpg,jpeg,...)
                    $extension = $request->file('photo_eleve')->extension();
                //on donne un nom à l'image en utilisant la fonction time()
                    $fileName = time().'.'.$extension;
                //on deplace l'image vers le dossier eleves
                    $request->file('photo_eleve')->storeAs('eleves',$fileName);

                //on passe à la modification du nom de l'image dans la base de donnée

                $update_image = Eleve::where('id',$eleve->id)
                                     ->update([
                                                'photo_profil' => $fileName
                                              ]);
            }
        else{

            }

        /**
         * validation du matricule
         */
        // $request->validate([
        //     'matricule' => 'unique:eleve,matricule,'.$eleve->id
        // ]);
        /**
         * modification des informations de l'élève
         */
        $modification_eleve = Eleve::where('id',$eleve->id)->update([
                                            // 'matricule' => $request->matricule,
                                            'nom' => Str::title($request->nom),
                                            'prenom' => Str::title($request->prenom),
                                            'sexe' => 'Feminin',
                                            'date_naissance' => $request->date_naissance,
                                            'telephone' => $request->telephone,
                                            'quartier' => Str::title($request->quartier),
                                            'nom_parent' => Str::title($request->nom_parent),
                                            'prenom_parent' => Str::title($request->prenom_parent),
                                            'profession' => Str::title($request->profession),
                                            'telephone_parent' => $request->telephone_parent
                                        ]);
        /**
         * modification de l'inscription de l'élève(le niveau de l'élève)
         */
        /**
         * on selectionne l'id la dernière année scolaire pour faire l'inscription
         * on doit faire l'inscription sur une année déjà ecouler
         */
        $id_annee = DB::table('annee')->latest('id')->first()->id;

        $modification_inscription = Inscrit::where('annee_id',$id_annee)
                                           ->where('eleve_id',$eleve->id)
                                           ->update([
                                                        'niveau_id' => $request->classe
                                                    ]);

        //message flash
        Flashy::success('Les informations de l\'élève ont été modifier avec succès');
        //redirection vers la page d'acceuil
        return redirect()->route('eleve.show',$eleve->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Eleve $eleve)
    {
        if(auth()->user()->hasPermissionTo('Suppression D\'un Elève'))
        {
            /**
             * on ne supprimer pas definitivement un élève on le radie fonctionalite
             * a rajouter
             */
            //
            /**
             * suppression d'un eleve
             * on doit pouvoir supprimer que les élèves de l'année scolaire en courante
             * autrement dit la dernière année scolaire
             */

            /**
             * on selectionne l'id la dernière année scolaire pour faire l'inscription
             * on doit faire l'inscription sur une année déjà ecouler
             */
            $id_annee = DB::table('annee')->latest('id')->first()->id;
            //on supprime l'élève dans la table inscription
            $suppression_eleve = Inscrit::where('eleve_id',$eleve->id)
                                    ->where('annee_id',$id_annee)
                                        ->delete();
            // //on supprimer l'élève dans la table élève
            $suppression_total = Eleve::where('id',$eleve->id)->delete();

            // //message flash
            Flashy::success('l\'élève a été supprimer avec succès');
            //redirection vers la page d'acceuil
            return back();
        }
        else
        {
            return view('errors.403');
        }

    }

    /**
     * Afficher les eleves par niveau
     */
    public function eleve_par_niveau($id)
    {
        /**
         * on récupère le niveau
         */
        // $niveau = Niveau::where('id',$id)->first()->nom_niveau.' '.Niveau::where('id',$id)->first()->options;
        // $nom_permission = 'Liste des élèves de la '.$niveau;
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
             * on appelle la methode InfosUser_AND_ThemeActive qui contient
             * le chemin du theme actif,le nom de l'utilisateur connecter,
             * la photo de profil de l'utilisateur connecter
             */
            $this->InfosUser_AND_ThemeActive();

            $chemin_theme_actif = $this->chemin_theme_actif;
            $nom = $this->nom;
            $avatar = $this->avatar;
            $annee_courante = $this->annee_courante;

            /**
             * Afficher les eleves inscrits par niveau en fonction des année courante
             */
            $all_inscriptions = Inscrit::where('niveau_id',$id)
                                    ->where('annee_id',$annee_courante->id)
                                    ->orderBy('date_inscription','desc')
                                    ->with('eleve','niveau','annee')
                                    ->get();
            // dd($all_inscriptions);
            /**
             * on selectionnne toutes les classes et les années scolaires
             */
            $all_classes = Niveau::all();
            $all_annee = Annee::all();
            /**
             * on créer une variable id_niveau qui stock le niveau selectionner par l'utilisateur
             * pour le garder selectionner quand l'utilisateur le selectionne
             */
                $id_niveau = $id;
            //on selectionne le niveau choisi par l'utilisateur pour l'afficher qu'il est avec ce niveau
                $niveau_choisit = Niveau::where('id',$id)->first();

            return view('pages.eleves/eleve_par_niveau',compact('chemin_theme_actif','nom','avatar','all_inscriptions','all_classes','all_annee','id_niveau','annee_courante','niveau_choisit'));
        // }
        // else
        // {
        //     return view('errors.403');
        // }
    }
    /**
     * affichage des élèves en mode grille
     */

     public function eleve_mode_grille()
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

        return view('pages.eleves/eleves_mode_grille',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee'));
     }



     /** Gestion de la réinscriptions des eleves */
     public function reinscription()
     {
        if(auth()->user()->hasPermissionTo('Réinscription D\'un Elève'))
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

            /**
             * on selectionne l'id la dernière année scolaire pour faire l'inscription
             * on doit faire l'inscription sur une année déjà ecouler
             */
            $id_annee = $annee_courante->id;


            /**
             * on selectionne toutes les salles de classe
             */

            $all_classes = Niveau::all();

            $all_annee = Annee::all();

            return view('pages.eleves/reinscription',compact('chemin_theme_actif','nom','avatar','all_classes','annee_courante','all_annee','id_annee'));
        }
        else
        {
            return view('errors.403');
        }

     }

     public function reinscription_eleve(Request $request, $id)
     {
         /**
         * on selectionne l'id la dernière année scolaire pour faire l'inscription
         * on doit faire l'inscription sur une année déjà ecouler
         */
        $id_annee = DB::table('annee')->latest('id')->first()->id;

        /**
         * avant de réinscrire un élève on verifit si cet élève n'as pas été réinscrit
         */
        if(Inscrit::where('eleve_id',$id)
                  ->where('annee_id',$id_annee)
                  ->exists())
        {
            alert('Attention','Cet élève a été déjà réinscrit','success')->addImage('/assets/asset_principal/img_sweat_alert/alert4.jpg')->autoclose(false);
            return back();
        }
        else
        {
            $reinscription_eleve = Inscrit::create([
                'eleve_id' => $id,
                'niveau_id' => $request->niveau_id,
                'annee_id' =>  $id_annee,
                'date_inscription' => now(),
                'status' => 1
              ]);

            return back();
        }

     }
     public function listes_eleves_reinscrits()
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

            $all_reinscrits = Inscrit::where('annee_id',$annee_courante->id)
                                    ->where('status',1)
                                    ->where('niveau_id',1)
                                    ->with('eleve','niveau')
                                    ->get();


            /**
             * on selectionne tous les niveaux
             */
            $all_niveaux = Niveau::all();
            $niveau_choisit = Niveau::first();

            return view('pages.eleves.listes_eleves_reinscrits',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_reinscrits','all_niveaux','niveau_choisit'));
     }
     /**
      * modification de la réinscription de l'élève
      */
      public function update_reinscription_eleve(Request $request,$id)
      {
          /**
           * on effecute la modification
           */
          /**
           * on selectionne la dernière année scolaire parce que la modification
           * n'est autoriser que sur cette année et non sur les années précedentes
           */
          $id_annee = DB::table('annee')->latest('id')->first()->id;

          $modification_reinscription = Inscrit::where('eleve_id',$id)
                                               ->where('annee_id',$id_annee)
                                               ->update([
                                                            'niveau_id' => $request->niveau_id
                                                        ]);

            return back();
      }
      /**
       * suppression de la réinscription d'un élève
       */
      public function delete_reinscription_eleve($id)
      {
          /**
           * on effectue la suppression de la réinscription
           */

           /**
           * on selectionne la dernière année scolaire parce que la suppression
           * n'est autoriser que sur cette année et non sur les années précedentes
           */
          $id_annee = DB::table('annee')->latest('id')->first()->id;

          $suppression_reinscription = Inscrit::where('eleve_id',$id)
                                              ->where('annee_id',$id_annee)
                                              ->delete();

            return back();

      }
     public function reinscriptions_par_eleve($id)
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

        $eleve = Eleve::where('id',$id)->first();

        /**
         * on selectionnne toutes les classes et les années scolaires
         */
        $all_classes = Niveau::all();
        $all_annees = Annee::all();

        return view('pages.eleves/reinscription_par_eleve',compact('chemin_theme_actif','nom','avatar','eleve','all_classes','all_annees'));
     }

     public function store_reinscriptions_par_eleve(Request $request, $id)
     {

          Inscrit::create([
                             'eleve_id' => $id,
                             'niveau_id' => $request->niveau_id,
                             'annee_id' =>  $request->annee_id,
                             'date_inscription' => now(),
                         ]);

           return back();
     }

     public function reinscription_par_niveau(Request $request,$id)
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

            /**
             * on selectionne l'id la dernière année scolaire pour faire l'inscription
             * on doit faire l'inscription sur une année déjà ecouler
             */
            $id_annee_passer = Annee::orderby('id','desc')->skip(1)->take(1)->first()->id;
            $anciens_eleves = Inscrit::where('annee_id',$id_annee_passer)->where('niveau_id',$id)->with('eleve','niveau')->get();

            /**
             * on selectionne toutes les salles de classe
             */

            $all_niveaux = Niveau::all();

            $all_annee = Annee::all();

            $niveau_choisit = Niveau::where('id',$id)->first();


        return view('pages.eleves.reinscription_par_niveau',compact('chemin_theme_actif','nom','avatar','all_niveaux','annee_courante','all_annee','anciens_eleves','niveau_choisit'));
    }

    public function listes_eleves_reinscrits_par_niveau($id)
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

        $all_reinscrits = Inscrit::where('annee_id',$annee_courante->id)
                                ->where('niveau_id',$id)
                                ->where('status',1)
                                ->with('eleve','niveau')
                                ->get();

        /**
         * on selectionne tous les niveaux
         */
        $all_niveaux = Niveau::all();
        $niveau_choisit = Niveau::where('id',$id)->first();


        return  view('pages.eleves.liste_eleves_reinscrit_par_niveau',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_reinscrits','all_niveaux','niveau_choisit'));
    }

}
