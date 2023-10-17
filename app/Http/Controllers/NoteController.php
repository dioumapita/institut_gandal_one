<?php

namespace App\Http\Controllers;

use App\mes_models\Annee;
use App\mes_models\Inscrit;
use App\mes_models\Matiere;
use App\mes_models\Niveau;
use Illuminate\Http\Request;
use App\Traits\InfosUserThemeActive;
use App\mes_models\Note;
use App\mes_models\Trimestre;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Aws\Textract\TextractClient;
use Aws\Rekognition\RekognitionClient;
use Aws\Textract\Exception\TextractException;

class NoteController extends Controller
{
    //
    /**
     * le trait InfosUserThemeActive contient deux:traits
     * 1-le trait permettant de selectionner les informations
     *   de l'utilisateur connecté
     * 2-le trait permettant de selectionner le theme activer
     */
    use InfosUserThemeActive;

    public function all_classes(Request $request)
    {
        $this->InfosUser_AND_ThemeActive();
        $chemin_theme_actif = $this->chemin_theme_actif;
        $nom = $this->nom;
        $avatar = $this->avatar;
        $annee_courante = $this->annee_courante;

         $all_niveaux = Niveau::all();
         $all_annee = Annee::all();

        return view('pages.notes/index',compact('chemin_theme_actif','nom','avatar','all_niveaux','all_annee','annee_courante'));
    }

    public function note_par_niveau($id)
    {

        // $niveau = Niveau::where('id',$id)->first()->nom_niveau.' '.Niveau::where('id',$id)->first()->options;
        // $nom_permission = 'Note des élèves de la '.$niveau;
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
            $id_niveau = $id;

            $this->InfosUser_AND_ThemeActive();
            $chemin_theme_actif = $this->chemin_theme_actif;
            $nom = $this->nom;
            $avatar = $this->avatar;
            $annee_courante = $this->annee_courante;

            $all_niveaux = Niveau::all();
            $all_matieres = Niveau::where('id',$id_niveau)->first()->matieres;
            $all_trimestre = Trimestre::all();
            $all_annee = Annee::all();

            $niveau_choisi = Niveau::where('id',$id_niveau)->first();

            return view('pages.notes/index',compact('chemin_theme_actif','nom','avatar','all_matieres','all_trimestre','all_annee','niveau_choisi','annee_courante'));
        // }
        // else
        // {
        //     return view('errors.403');
        // }

    }
    /**
     * methode utiliser pour afficher la liste des notes par matières
     */
    public function note_filtrer(Request $request)
    {
        // $niveau = Niveau::where('id',$request->niveau_choisi)->first()->nom_niveau.' '.Niveau::where('id',$request->niveau_choisi)->first()->options;
        // $nom_permission = 'Liste des notes des élèves de la '.$niveau;
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
            $this->InfosUser_AND_ThemeActive();
            $chemin_theme_actif = $this->chemin_theme_actif;
            $nom = $this->nom;
            $avatar = $this->avatar;
            $annee_courante = $this->annee_courante;
            $all_annee = Annee::all();

            $niveau_choisi =Niveau::where('id',$request->niveau_choisi)->first();
            $matiere_choisie = Matiere::where('id',$request->matiere)->first();
            $trimestre_choisit = Trimestre::where('id',$request->trimestre)->first();
            $annee_choisie = $annee_courante;
            $coefficient = $niveau_choisi->matieres->find($request->matiere)->pivot->coefficient;
            $bareme = $niveau_choisi->matieres->find($request->matiere)->pivot->bareme;

            $notes = Note::where('matiere_id',$request->matiere)
                        ->where('trimestre_id',$request->trimestre)
                        ->where('niveau_id',$niveau_choisi->id)
                        ->where('annee_id',$annee_choisie->id)
                        ->orderBy('moyenne','desc')
                        ->with(['eleve','matiere','trimestre','annee'])->get();


            // dd($notes);
            $all_trimestres = Trimestre::all();
            $all_niveaux = Niveau::all();
            $rang = 1;
            $rang2 = 1;
            return view('pages.notes.liste_notes',compact('chemin_theme_actif','nom','avatar','niveau_choisi','matiere_choisie','trimestre_choisit','annee_choisie', 'coefficient', 'bareme', 'notes','annee_courante','all_annee','all_trimestres','all_niveaux','rang','rang2'));
        // }
        // else
        // {
        //     return view('errors.403');
        // }
    }

    /**
     * methode utiliser pour gerer la saisi des notes en mode unique
     */
    public function saisie_note(Request $request)
    {
        //  dd("bonjour");
        // dd($request->all());

        $this->InfosUser_AND_ThemeActive();
        $chemin_theme_actif = $this->chemin_theme_actif;
        $nom = $this->nom;
        $avatar = $this->avatar;
        $annee_courante = $this->annee_courante;
        $all_annee = Annee::all();

        $niveau_choisi =Niveau::where('id',$request->niveau_choisi)->first();
        $matiere_choisie = Matiere::where('id',$request->matiere)->first();
        $trimestre_choisit = Trimestre::where('id',$request->trimestre)->first();

        /** selectionne la dernière année scolaire parce que la saisie des notes n'est pas autoriser pour les
         * année scolaire précedente
         */
        $annee_choisie = DB::table('annee')->latest('id')->first();
        /**
         * on selectionne les élèves inscrits au niveau de la dernière année scolaire
         * pour le niveau choisi
         */
        $eleves_inscrits = Inscrit::where('annee_id',$annee_choisie->id)
                                  ->where('niveau_id',$request->niveau_choisi)
                                  ->with('eleve')
                                  ->get();
        //pas utiliser je pense donc supprimer lors du refactoring

        // $note_niveau = Note::where('matiere_id',$matiere)->get();

        $bareme = $niveau_choisi->matieres->find($request->matiere)->pivot->bareme;
        $coefficient = $niveau_choisi->matieres->find($request->matiere)->pivot->coefficient;
        $bareme = $niveau_choisi->matieres->find($request->matiere)->pivot->bareme;


        /**
         * on selectionne tous les trimestres
         */
        $all_trimestres = Trimestre::all();


        return view('pages.notes/saisi_note',compact('chemin_theme_actif','nom','avatar','matiere_choisie','eleves_inscrits','trimestre_choisit','annee_choisie','niveau_choisi','coefficient','bareme','all_annee','annee_courante','all_trimestres'));
    }

    public function enregistre_note(Request $request)
    {
        /**
         * mode de saisie unique: au niveau du mode de saisi unique
         * on saisi les notes de l'élève étape par étape autrement
         * on saisi la première note on valide la seconde ainsi de suite
         * pour tous les élèves
         */

        // dd($request->except('_tokent'));
        //  $request->eleve_id;
        //  $matiere = $request->matiere_id;
        //  $trimestre = $request->trimestre_id;
        //  $annee = $request->annee_id;
        //  $note = $request->note1;

        // foreach($request->eleve_id as $key => $eleve)
        // {
        //      echo $eleve.PHP_EOL;
        //      echo $matiere[$key].PHP_EOL;
        //      echo $trimestre[$key].PHP_EOL;
        //      echo $annee[$key].PHP_EOL;
        //      echo $note[$key].PHP_EOL;
        //      echo "<br>";

        //     if(Note::where('eleve_id',$eleve)
        //            ->where('matiere_id',$matiere[$key])
        //            ->where('trimestre_id',$trimestre[$key])
        //            ->where('annee_id',$annee[$key])->exists()
        //     )
        //     {
        //          Note::where('eleve_id',$eleve)
        //              ->where('matiere_id',$matiere[$key])
        //              ->where('trimestre_id',$trimestre[$key])
        //              ->where('annee_id',$annee[$key])
        //              ->update([
        //                         'eleve_id' => $eleve,
        //                         'matiere_id' => $matiere[$key],
        //                         'trimestre_id' => $trimestre[$key],
        //                         'annee_id' => $annee[$key],
        //                         'note1' => $note[$key]
        //                     ]);
        //     }
        //     else
        //     {
        //         Note::create([
        //             'eleve_id' => $eleve,
        //             'matiere_id' => $matiere[$key],
        //             'trimestre_id' => $trimestre[$key],
        //             'annee_id' => $annee[$key],
        //             'note1' => $note[$key]
        //         ]);
        //     }
        // }

        /**
         * on verifit si l'élève à déjà eu une note: si c'est le cas
         * on fait une mise à jour de la note
         * on contraire on ajoute la note pour l'élève
         */

        if(Note::where('eleve_id',$request->eleve_id)
             ->where('matiere_id',$request->matiere_id)
             ->where('trimestre_id',$request->trimestre_id)
             ->where('annee_id',$request->annee_id)->exists())
            {
                $modification_note = Note::where('eleve_id',$request->eleve_id)
                                           ->where('matiere_id',$request->matiere_id)
                                           ->where('trimestre_id',$request->trimestre_id)
                                           ->where('annee_id',$request->annee_id)
                                           ->update($request->except('_token'));


                dd("cet enregistrement à été mis à jour");

            }
            /**
             * on ajoute une note pour l'élève comme il n'as pas de note
             */
            else
            {
                $insert_note = Note::create($request->except('_token'));

                dd("note ajouter");
            }

    }
    /**
     * methode utiliser pour la saisie des notes en mode multiples
     * ou autrement dit en mode groupe
     */
    public function saisie_note_mode_multiple(Request $request)
    {


        // $niveau = Niveau::where('id',$request->niveau_choisi)->first()->nom_niveau.' '.Niveau::where('id',$request->niveau_choisi)->first()->options;
        // $nom_permission = 'Saisi des notes des élèves de la '.$niveau;
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
            $this->InfosUser_AND_ThemeActive();
            $chemin_theme_actif = $this->chemin_theme_actif;
            $nom = $this->nom;
            $avatar = $this->avatar;
            $annee_courante = $this->annee_courante;
            $all_annee = Annee::all();

            $niveau_choisi =Niveau::where('id',$request->niveau_choisi)->first();
            $matiere_choisie = Matiere::where('id',$request->matiere)->first();
            $trimestre_choisit = Trimestre::where('id',$request->trimestre)->first();

            /** selectionne la dernière année scolaire parce que la saisie des notes n'est pas autoriser pour les
             * année scolaire précedente
             */
            $annee_choisie = DB::table('annee')->latest('id')->first();

            /**
             * on selectionne les élèves inscrits au niveau de la dernière année scolaire
             * pour le niveau choisi
             */
            // $eleves_inscrits = Inscrit::where('annee_id',$annee_choisie->id)
            //                         ->where('niveau_id',$request->niveau_choisi)
            //                         ->with('eleve')
            //                         ->get();

            $eleves_inscrits = Inscrit::select('*')
                                        ->join('eleve','inscrit.eleve_id','=','eleve.id')
                                        ->orderBy('eleve.prenom','ASC')
                                        ->where('niveau_id',$request->niveau_choisi)
                                        ->where('annee_id',$annee_choisie->id)
                                        ->get();

            // dd($eleves_inscrits);

            // dd($eleve);
            /**
             * on selectionne tous les trimestres
             */
            $all_trimestres = Trimestre::all();
            $all_niveaux = Niveau::all();

            $bareme = $niveau_choisi->matieres->find($request->matiere)->pivot->bareme;
            $coefficient = $niveau_choisi->matieres->find($request->matiere)->pivot->coefficient;


            return view('pages.notes.saisi_note_mode_multiple',compact('chemin_theme_actif','nom','avatar','matiere_choisie','eleves_inscrits','trimestre_choisit','annee_choisie','niveau_choisi','coefficient','bareme','annee_courante','all_annee','all_trimestres','all_niveaux'));
        // }
        // else
        // {
        //     return view('errors.403');
        // }
    }

    public function enregistre_multiple_note(Request $request)
    {

       $eleve_id = $request->eleve_id;
       $niveau_id = $request->niveau_id;
       $matiere_id = $request->matiere_id;
       $trimestre_id = $request->trimestre_id;
       $annee_id = $request->annee_id;
       $coefficient = $request->coefficient;
       $composition = $request->composition;

         //secondaire
            if($niveau_id > 18 AND $niveau_id <= 34)
            {
                $note2 = $request->note2;
                $note3 = $request->note3;
                $note1 = $request->note1;
                foreach($eleve_id as $key => $eleve)
                {
                    if(is_null($note1[$key]))
                    {
                        $a = 0;
                    }
                    else
                    {
                        $a = 1;
                    }
                    if(is_null($note2[$key]))
                    {
                        $b = 0;
                    }
                    else
                    {
                        $b = 1;
                    }
                    if(is_null($note3[$key]))
                    {
                        $c = 0;
                    }
                    else
                    {
                        $c = 1;
                    }
                    $nbre_notes = ($a + $b + $c);

                    /**
                     * on calcul la moyenne modulaire (les notes de cours)
                     */
                    $moy_modulaire = 0;

                    if($nbre_notes == 0)
                    {
                        $moy_modulaire = null;
                    }
                    else
                    {
                        $moy_modulaire = (($note1[$key] * $coefficient) + ($note2[$key] * $coefficient) + ($note3[$key] * $coefficient)) / $nbre_notes;
                        // dd($moy_modulaire);
                    }
                    /**
                     * on calcul la moyenne de composition
                     */
                    $moy_composition = 0;

                    // dd($composition[$key]);

                    if(is_null($composition[$key]))
                    {
                        $moy_composition = null;
                    }
                    elseif($nbre_notes == 0)
                    {
                        $moy_composition = $composition[$key] * $coefficient;
                    }
                    else
                    {
                        $moy_composition = (str_replace(',','.',$composition[$key]) * 2);

                        $toto[] = str_replace(',','.',$composition[$key]);

                        $moy_composition = $moy_composition * $coefficient;

                    }

                    /**
                     * on calcul la moyenne générale
                     */

                    $moy_generale = 0;

                    if(isset($moy_composition) and $nbre_notes == 0)
                    {
                        $moy_generale = $moy_composition;
                    }
                    elseif(isset($moy_composition) and isset($moy_modulaire))
                    {
                        $moy_generale = ($moy_composition + $moy_modulaire)/ 3;
                    }
                    elseif(is_null($moy_composition) and isset($moy_modulaire))
                    {
                        $moy_generale = $moy_modulaire;
                    }
                    else
                    {
                        $moy_generale = null;
                    }

                    /**
                     * la moyenne final c'est la moyenne coefficier
                     */

                    $moy_finale = 0;

                    if(is_null($moy_generale))
                    {
                        $moy_finale = null;
                    }
                    else
                    {
                        $moy_finale = floor($moy_generale * 100)/100;
                        /**
                         * utilisation de floor pour éviter les arrondissement
                         */
                        // $moy_finale = floor($moy_finale * 100)/100;
                    }

                    /**
                     * On verifit si l'élève à déja été note on fait une mis à jour au
                     * contraire on l'attribut la note
                     *
                     * */
                    if(Note::where('eleve_id',$eleve)->where('matiere_id',$matiere_id)->where('trimestre_id',$trimestre_id)
                        ->where('niveau_id',$niveau_id)->where('annee_id',$annee_id)->exists()
                    )
                        {
                            // dd($composition[$key]);
                            // // dd($composition[$key]);
                            Note::where('eleve_id',$eleve)->where('matiere_id',$matiere_id)->where('trimestre_id',$trimestre_id)
                                ->where('niveau_id',$niveau_id)->where('annee_id',$annee_id)
                                ->update([
                                        'note1' => $note1[$key],
                                        'note2' => $note2[$key],
                                        'note3' => $note3[$key],
                                        'composition' => $composition[$key],
                                        'moyenne' => $moy_finale,
                                        'coefficient' => $coefficient,
                                        'nbre_notes' => $nbre_notes
                                    ]);
                        }
                    else
                    {
                        Note::create([
                            'eleve_id' => $eleve,
                            'matiere_id' => $matiere_id,
                            'trimestre_id' => $trimestre_id,
                            'niveau_id' => $niveau_id,
                            'annee_id' => $annee_id,
                            'note1' => $note1[$key],
                            'note2' => $note2[$key],
                            'note3' => $note3[$key],
                            'composition' => $composition[$key],
                            'moyenne' => $moy_finale,
                            'coefficient' => $coefficient,
                            'nbre_notes' => $nbre_notes
                        ]);
                    }
                }
            }
        //primaire
            if($niveau_id <= 18 || $niveau_id == 35)
            {
                $note3 = $request->note3;

                foreach($eleve_id as $key => $eleve)
                    {

                        if(Note::where('eleve_id',$eleve)->where('matiere_id',$matiere_id[$key])->where('trimestre_id',$trimestre_id)
                        ->where('niveau_id',$niveau_id)->where('annee_id',$annee_id)->exists()
                        )
                        {
                            // dd($eleve);
                            if(isset($note3[$key]))
                            {

                                Note::where('eleve_id',$eleve)->where('matiere_id',$matiere_id[$key])->where('trimestre_id',$trimestre_id)
                                            ->where('niveau_id',$niveau_id)->where('annee_id',$annee_id)
                                            ->update([
                                                    'note3' => $note3[$key],
                                                    'moyenne' => $note3[$key] * $coefficient,
                                                    'coefficient' => $coefficient
                                                ]);
                            }
                            else
                            {
                                Note::where('eleve_id',$eleve)->where('matiere_id',$matiere_id[$key])->where('trimestre_id',$trimestre_id)
                                ->where('niveau_id',$niveau_id)->where('annee_id',$annee_id)
                                ->update([
                                        'note3' => $note3[$key],
                                        'moyenne' => $note3[$key],
                                        'coefficient' => $coefficient
                                    ]);
                            }
                        }
                        else
                        {
                            if(isset($note3[$key]))
                            {
                                Note::create([
                                                'note3' => $note3[$key],
                                                'matiere_id' => $matiere_id[$key],
                                                'eleve_id' => $eleve,
                                                'trimestre_id' => $trimestre_id,
                                                'niveau_id' => $niveau_id,
                                                'annee_id' => $annee_id,
                                                'moyenne' => $note3[$key] * $coefficient,
                                                'coefficient' => $coefficient
                                            ]);
                            }
                            else
                            {
                                Note::create([
                                    'note3' => $note3[$key],
                                    'matiere_id' => $matiere_id[$key],
                                    'eleve_id' => $eleve,
                                    'trimestre_id' => $trimestre_id,
                                    'niveau_id' => $niveau_id,
                                    'annee_id' => $annee_id,
                                    'moyenne' => $note3[$key],
                                    'coefficient' => $coefficient
                                ]);
                            }
                        }
                }
            }
    //    dd("stop");
        Flashy::success('Note ajouter avec succès');
            return back();
    }

    /**
     * methode permettant de modifier la note d'un élève
     */
    public function update(Request $request,$id)
    {

        if(auth()->user()->hasPermissionTo('Modification de note'))
        {
            $coefficient = $request->coefficient;

            if(is_null($request->note1))
                {
                    $a = 0;
                }
                else
                {
                    $a = 1;
                }
                if(is_null($request->note2))
                {
                    $b = 0;
                }
                else
                {
                    $b = 1;
                }
                if(is_null($request->note3))
                {
                    $c = 0;
                }
                else
                {
                    $c = 1;
                }

                $nbre_notes = ($a + $b + $c);

                /**
                 * on calcul la moyenne modulaire (les notes de cours)
                 */
                $moy_modulaire = 0;

                if($nbre_notes == 0)
                {
                   $moy_modulaire = null;
                }
                else
                {
                    $moy_modulaire = (($request->note1 * $coefficient) + ($request->note2 * $coefficient) + ($request->note3 * $coefficient)) / $nbre_notes;
                    // dd($moy_modulaire);
                }
                /**
                 * on calcul la moyenne de composition
                 */
                $moy_composition = 0;

                if(is_null($request->composition))
                {
                    $moy_composition = null;
                }
                elseif($nbre_notes == 0)
                {
                    $moy_composition = $request->composition * $coefficient;
                }
                else
                {
                    $moy_composition = ($request->composition * 2);
                    $moy_composition = ($moy_composition * $coefficient);
                    // dd($moy_composition);
                }

                /**
                 * on calcul la moyenne générale
                 */

                $moy_generale = 0;

                if(isset($moy_composition) and is_null($moy_modulaire))
                {
                    $moy_generale = $moy_composition;
                }
                elseif(isset($moy_composition) and isset($moy_modulaire))
                {
                    $moy_generale = ($moy_composition + $moy_modulaire) / 3;
                }
                elseif(is_null($moy_composition) and isset($moy_modulaire))
                {
                    $moy_generale = $moy_modulaire;
                }
                else
                {
                    $moy_generale = null;
                }

                /**
                 * la moyenne final c'est la moyenne coefficier
                 */

                $moy_finale = 0;


                if(is_null($moy_generale))
                {
                    $moy_finale = null;
                }
                else
                {
                    $moy_finale = floor($moy_generale * 100)/100;
                    // dd($moy_finale);
                    // $moy_finale = floor($moy_finale * 100)/100;
                }
            /**
             * pour faire la modification d'une note on a besoin de la matiere,du trimestre
             * de l'élève et de l'année scolaire(la dernière année scolaire)
            */
            $matiere_id = $request->matiere_id;
            $trimestre_id = $request->trimestre_id;
            $niveau_id = $request->niveau_id;
            //on récupère le coefficient

            $annee_id = DB::table('annee')->latest('id')->first()->id;

            /**
             * Modification des notes de lélève
             */

            $modification_note = Note::where('eleve_id',$id)
                                        ->where('niveau_id',$niveau_id)
                                        ->where('matiere_id',$matiere_id)
                                        ->where('trimestre_id',$trimestre_id)
                                        ->where('annee_id',$annee_id)
                                        ->update([
                                                    'note1' => $request->note1,
                                                    'note2' => $request->note2,
                                                    'note3' => $request->note3,
                                                    'composition' => $request->composition,
                                                    'moyenne' => $moy_finale,
                                                    'nbre_notes' => $nbre_notes
                                                ]);
                //message flash
                Flashy::success('Modification réussit avec succès');

                return back();


        }
        else
        {
            return view('errors.403');
        }
    }


    /**
     * methode permettant de supprimer la note d'un élève
     */
   public function destroy(Request $request, $id)
   {
        if(auth()->user()->hasPermissionTo('Suppression de note'))
        {
            # code...
            /**
             * pour faire la suppression d'une note on a besoin de la matiere,du trimestre
             * de l'élève et de l'année scolaire(la dernière année scolaire)
             */

            $id_matiere = $request->matiere_choisie;
            $id_trimestre = $request->trimestre_choisit;

            /**
             *  on selectionne la dernière année scolaire parce que la suppression
            * n'est autoriser que pendant la dernière année scolaire
            */
            $id_annee = DB::table('annee')->latest('id')->first()->id;

            /**
             * on effectue la suppression
             */
            $suppression_note = Note::where('eleve_id',$id)
                                    ->where('matiere_id',$id_matiere)
                                    ->where('trimestre_id',$id_trimestre)
                                    ->where('annee_id',$id_annee)
                                    ->delete();

            //message flash
            Flashy::success('Les notes de l\'élève ont été supprimer avec succès');
            return back();
        }
        else
        {
            return view('errors.403');
        }

   }


}
