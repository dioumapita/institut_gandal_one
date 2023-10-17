<?php

namespace App\Http\Controllers;

use App\mes_models\Annee;
use App\mes_models\Emargement;
use App\mes_models\Enseigner;
use App\mes_models\Niveau;
use Illuminate\Http\Request;
use App\Traits\InfosUserThemeActive;
use App\mes_models\Role;
use Carbon\Carbon;
use Alert;
use App\mes_models\EmploisDeTemp;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;

class EmargementEnseignantController extends Controller
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

        $all_niveaux = Niveau::all();
        $date_du_jour = Carbon::now()->format('Y-m-d');

        $all_emargement = Emargement::where('date_emarg',$date_du_jour)->with('user','matiere','niveau')->get();

        return view('pages.emargement/index',compact('chemin_theme_actif','nom','avatar','all_niveaux','all_emargement','annee_courante','all_annee'));
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

        // $all_enseignant = Role::find(3)->users;
        $niveau_choisi = Niveau::find(12)->first();
        // $all_matiere = $niveau_choisi->matieres;
        $annee_scolaire = Annee::first();

        $all_enseignement = Enseigner::where('niveau_id',$niveau_choisi->id)
                                     ->where('annee_id',$annee_scolaire->id)
                                      ->get();
        dd($all_enseignement);

        return view('pages.emargement/create',compact('chemin_theme_actif','nom','avatar','all_enseignant','all_matiere','annee_scolaire','niveau_choisi','all_annee','annee_courante'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $date_emarg = Carbon::parse($request->date_choisie);
        $date_emarg = $date_emarg->isoformat('Y-M-D');

        /**
         * verifier si l'enseignant n'as pas  emarger pour cette date(date_emarg)
         * pour cet interval de temps(heure_debut et heure_fin)
        */

        if(Emargement::where('date_emarg',$date_emarg)
                     ->where('niveau_id',$request->niveau_id)
                     ->where('heure_debut',$request->heure_debut)
                     ->where('heure_fin',$request->heure_fin)
                     ->exists()
        )
         {
            alert('Attention','Ces heures de cours ont été déjà emarger pour cet enseignant aujourd\'hui','success')->addImage('/assets/asset_principal/img_sweat_alert/alert4.jpg')->autoclose(false);
            return back();
         }
         else
        {

            /**
             * on recupère le nombre d'heure effectuer: le nombre d'heure effectuer c'est la différence
            * entre heure debut et heure fin
            */
            $start = Carbon::parse($request->heure_debut);
            $end = Carbon::parse($request->heure_fin);
            $heure_effectuer = $start->diffInMinutes($end)/60;
            $heure_effectuer =number_format($heure_effectuer,2);


                $prix_par_heure = Enseigner::where('user_id',$request->user_id)
                                            ->where('matiere_id',$request->matiere_id)
                                            ->where('niveau_id',$request->niveau_id)
                                            ->first()->prix_heure;
                // dd($prix_par_heure);
                $gain =  $prix_par_heure * $heure_effectuer;
                //   dd($gain);
                /**
                 * on selectionne la dernière année scolaire tous simplement parce
                 * que l'emargement n'est autoriser que sur cette année scolaire
                 */
                $id_annee = DB::table('annee')->latest('id')->first()->id;
                // dd($id_annee);
                $insertion = Emargement::create([
                    'heure_debut' => $request->heure_debut,
                    'heure_fin' => $request->heure_fin,
                    'date_emarg' => $date_emarg,
                    'heure_effectuer' => $heure_effectuer,
                    'gains' => $gain,
                    'user_id' => $request->user_id,
                    'matiere_id' => $request->matiere_id,
                    'niveau_id' => $request->niveau_id,
                    'annee_id' => $id_annee
                ]);
        }

           //message flash
           Flashy::success('Emargement effectué avec succès');
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
        // dd($request->all());

        $start = Carbon::parse($request->heure_debut);
        $end = Carbon::parse($request->heure_fin);
        $heure_effectuer = $start->diffInMinutes($end)/60;
        $heure_effectuer =number_format($heure_effectuer,2);

        /**
         * on verifit si cette matière est toujours enseinger par l'enseignant
         * avant d'autoriser une modification sur l'emargement
         */
        if(Enseigner::where('user_id',$request->user_id)
                    ->where('matiere_id',$request->matiere_id)
                    ->where('niveau_id',$request->niveau_id)
                    ->exists())
            {
                $prix_par_heure = Enseigner::where('user_id',$request->user_id)
                                        ->where('matiere_id',$request->matiere_id)
                                        ->where('niveau_id',$request->niveau_id)
                                        ->first()->prix_heure;

                $gain =  $prix_par_heure * $heure_effectuer;
            }
            else{
                alert('Attention','Cette matière n\'est plus enseigner par cet enseignant. Pour faire une modification sur l\'emargement vous devez attribuer cette matière à cet enseignant','success')->addImage('/assets/asset_principal/img_sweat_alert/alert4.jpg')->autoclose(false);
                return back();
            }


            //   dd($gain);
            /**
             * on recupère la dernière année scolaire parce que la modification
             * n'est pas autoriser pour une année scolaire epuiser
             */
            $annee_id = DB::table('annee')->latest('id')->first()->id;

            if(Emargement::where('date_emarg',$request->date_emarg)
                            ->where('niveau_id',$request->niveau_id)
                            ->where('heure_debut',$request->heure_debut)
                            ->where('heure_fin',$request->heure_fin)
                            ->exists()
        )
        {
            alert('Attention','Ces heures de cours ont été déjà emarger aujourd\'hui','success')->addImage('/assets/asset_principal/img_sweat_alert/alert4.jpg')->autoclose(false);
            return back();
        }
        else
        {

            $modification = Emargement::where('user_id',$request->user_id)
                                        ->where('matiere_id',$request->matiere_id)
                                        ->where('niveau_id',$request->niveau_id)
                                        ->where('annee_id',$annee_id)
                                        ->where('date_emarg',$request->date_emarg)
                                            ->update([
                                                        'heure_debut' => $request->heure_debut,
                                                        'heure_fin' => $request->heure_fin,
                                                        'gains' => $gain,
                                                        'heure_effectuer' => $heure_effectuer
                                                    ]);
        }
       //message flash
        Flashy::success('Modification effectuée avec succès');
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
        $suppression_emargement = Emargement::where('id',$id)->delete();

       //message flash
       Flashy::success('Suppression effectuée avec succès');
        return back();
    }

    public function emargement_par_niveau(Request $request,$id)
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
        * l'année doit être la dernière année scolaire tous simplement emargement
        * n'est autoriser que pour cette année scolaire
        */
        $annee_id = DB::table('annee')->latest('id')->first()->id;

        $niveau_id = Niveau::where('id',$id)->first()->id;

        /**
         * on verifit si la date emargement a été selectionner, si c'est le cas
         * on affiche les matières enseigners pendant ce jour,au contraire on prend
         * la date du jour
         * on recupère le numéro du jour
         */
           if($request->date_emarg == null)
           {
              $date_emarg = Carbon::now()->isoFormat('d');

              $date_choisie = Carbon::now();
            //    $date_choisie = $date_choisie->format('d/m/Y');
           }
           else
           {
                /**
                 * on convertit la date en type carbon avant de la format de récupère le
                 * numéro du jour de la semaime
                 */
                    $date_emarg = Carbon::parse($request->date_emarg);
                    $date_emarg = $date_emarg->isoFormat('d');

                    $date_choisie = Carbon::parse($request->date_emarg);
           }
            $all_programmes = EmploisDeTemp::where('jr',$date_emarg)
                                           ->where('niveau_id',$id)
                                           ->with('matiere','niveau')
                                           ->get();
        //    dd($all_programmes);


        /**
         * on selectionne tous les niveaux pour permettre à l'utilisateur de choisir une autre classe
         */
        $all_niveaux = Niveau::all();
        $niveau_choisit = Niveau::where('id',$id)->first();

        return view('pages.emargement/enseignant_par_niveau',compact('chemin_theme_actif','nom','avatar','niveau_id','annee_id','all_annee','annee_courante','all_niveaux','all_programmes','date_choisie','niveau_choisit'));
    }

    /**
     * detail emargement
     */
    public function detail_emargement($id)
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
         * pour les details de l'emargement de chaque classe on affiche on fonction de l'année courante
         */
        $all_emargement_niveau = Emargement::where('niveau_id',$id)
                                           ->where('annee_id',$annee_courante->id)
                                           ->orderBy('created_at','desc')
                                           ->with('user','matiere','niveau','annee')->get();

        // on récupére l'id du niveau choisi utiliser au niveau du boutou retour
        $id_niveau = Niveau::where('id',$id)->first()->id;
        //niveau_choisit
        $niveau_choisit = Niveau::where('id',$id)->first();


        return view('pages.emargement/detail_emargement',compact('chemin_theme_actif','nom','avatar','all_emargement_niveau','all_annee','annee_courante','id_niveau','niveau_choisit'));
    }
}
