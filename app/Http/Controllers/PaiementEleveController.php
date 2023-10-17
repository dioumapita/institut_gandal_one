<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\InfosUserThemeActive;
use App\mes_models\Annee;
use App\mes_models\Eleve;
use App\mes_models\Inscrit;
use App\mes_models\Niveau;
use App\mes_models\PaiementEleve;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use MercurySeries\Flashy\Flashy;
use Mediumart\Orange\SMS\SMS;
use Mediumart\Orange\SMS\Http\SMSClient;
class PaiementEleveController extends Controller
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

        /**
         * on selectionne l'id de la dernière année scolaire tous simplement parce que on
         * fait le payement que pour les élèves inscrit pour la dernières années scolaire
         */
        $id_annee = DB::table('annee')->latest('id')->first()->id;

        $all_inscriptions = Inscrit::where('annee_id',$annee_courante->id)->with('eleve','niveau')->get();
        $all_niveaux = Niveau::all();

        return view('pages.paiement_eleve.index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_inscriptions','all_niveaux'));
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

        // dd($request->eleve_id);

        if(auth()->user()->hasPermissionTo('Effectuez un paiement de frais scolaire'))
        {

            $id_annee = DB::table('annee')->latest('id')->first()->id;


            $paiment_eleve = PaiementEleve::create([
                                                    'eleve_id' => $request->eleve_id,
                                                    'somme_payer' => $request->montant,
                                                    'type_paiement' => $request->type_paiement,
                                                    'mois' => 'indefinit',
                                                    'tranche' => $request->tranche,
                                                    'num_recu' => 22,
                                                    'date_paiement' => $request->date_paiement,
                                                    'annee_id' => $id_annee
                                                ]);


            Flashy::success('Paiement effectuer avec succès');

            // return back();

            return redirect()->route('paiement_groupe_eleve.index',['id' => $request->eleve_id]);
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
        /**
         * on appelle la methode InfosUser_AND_ThemeActive qui contient
         * le chemin du theme actif,le nom de l'utilisateur connecter,
         * la photo de profil de l'utilisateur connecter
         */
        $this->InfosUser_AND_ThemeActive();

        $chemin_theme_actif = $this->chemin_theme_actif;
        $nom = $this->nom;
        $avatar = $this->avatar;
        $all_annee = Annee::all();
        $annee_courante = $this->annee_courante;

        /**
         * on selectionne l'année scolaire courante
         */
        $annee_id = $annee_courante->id;


        $all_paiement = PaiementEleve::where('eleve_id',$id)
                                     ->where('annee_id',$annee_id)
                                     ->where('status',1)
                                     ->with('eleve')
                                     ->get();

        $info_eleve = Inscrit::where('eleve_id',$id)->where('annee_id',$annee_id)->with('eleve')->first();

       return view('pages.paiement_eleve.show',compact('chemin_theme_actif','nom','avatar','all_annee','annee_courante','all_paiement','info_eleve'));
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
        if(auth()->user()->hasPermissionTo('Modifier un paiement de frais scolaire'))
        {
            $modification = PaiementEleve::where('id',$id)->update([
                                                                    'somme_payer' => $request->montant,
                                                                    'tranche' => $request->tranche,
                                                                    'mois' => 'indefinit',
                                                                    'type_paiement' => $request->type_paiement,
                                                                    'date_paiement' => $request->date_paiement
                                                                    ]);
            //message flash
            Flashy::success('Modification effectuée avec succès');
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
        if(auth()->user()->hasPermissionTo('Supprimer un paiement de frais scolaire'))
        {
            //
            $suppression = PaiementEleve::where('id',$id)->delete();
            //message flash
            Flashy::success('Suppression effectuée avec succès');
            return back();
        }
        else
        {
            return view('errors.403');
        }
    }

    /**
     * Etat de paiement des élèves
     */

     public function etat_paiement_eleve()
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
         * on selectionne l'id de la dernière année scolaire tous simplement parce que on
         * fait le payement que pour les élèves inscrit pour la dernières années scolaire
         */
        $id_annee = DB::table('annee')->latest('id')->first()->id;

        $all_inscriptions = Inscrit::where('annee_id',$annee_courante->id)->with('eleve','niveau')->get();

        $all_niveaux = Niveau::all();

        return view('pages.paiement_eleve/etat_paiement_eleve',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_inscriptions','all_niveaux'));
     }

     /**
      * Elève en rétard de paiement
      */

      public function retard_paiement_eleve()
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
             * on selectionne l'id de la dernière année scolaire tous simplement parce que on
             * fait le payement que pour les élèves inscrit pour la dernières années scolaire
            */
            $id_annee = DB::table('annee')->latest('id')->first()->id;

            $all_inscriptions = Inscrit::where('annee_id',$annee_courante->id)->with('eleve','niveau')->get();

            $all_niveaux = Niveau::all();

            return view('pages.paiement_eleve/retard_paiement_eleve',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_inscriptions','all_niveaux'));
      }

      /**
       * Elève en règle
       */
      public function total_paiement_eleve()
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
             * on selectionne l'id de la dernière année scolaire tous simplement parce que on
             * fait le payement que pour les élèves inscrit pour la dernières années scolaire
            */
            $id_annee = DB::table('annee')->latest('id')->first()->id;

            $all_inscriptions = Inscrit::where('annee_id',$annee_courante->id)->with('eleve','niveau')->get();

            $all_niveaux = Niveau::all();

            return view('pages.paiement_eleve/total_paiement_eleve',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_inscriptions','all_niveaux'));
      }

      /**
       * Etat de paiement des élèves par classe ou niveau
       */
      public function etat_paiement_eleve_par_classe(Request $request)
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
             * on selectionne l'id de la dernière année scolaire tous simplement parce que on
             * fait le payement que pour les élèves inscrit pour la dernières années scolaire
            */
            $id_annee = DB::table('annee')->latest('id')->first()->id;

            $all_inscriptions = Inscrit::where('niveau_id',$request->niveau_id)
                                       ->where('annee_id',$annee_courante->id)->with('eleve','niveau')->get();

            /**
             * on verifit ce que nous renvoi le status si le status est égal à fa-rotate-1
             * on affiche tous les élèves,si c'est égal à 2 on affiche les élèves en retard de
             * paiement si c'est égal à 3 on affiche les élèves en rèble de paiement
             */
            if($request->status == 1)
                {
                    $etat = 1;
                }
            elseif($request->status == 2)
                {
                    $etat = 2;
                }
            elseif($request->status == 3)
                {
                    $etat = 3;
                }
            elseif($request->status == 4)
                {
                    $etat = 4;
                }
            elseif($request->status == 5)
                {
                    $etat = 5;
                }
            else
                {
                    $etat = 6;
                }
            /**
             * on renvoi le niveau choisi ou le niveau selectionner par l'utilisateur
             */
            $niveau = Niveau::where('id',$request->niveau_id)->first();

            $all_niveaux = Niveau::all();

            return view('pages.paiement_eleve.etat_paiement_eleve_par_niveau',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','etat','all_inscriptions','niveau','all_niveaux'));
      }
      /**
       * Paiement des frais scolaires par classe
       */
      public function paiement_eleve_par_classe($id)
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
             * on selectionne l'id de la dernière année scolaire tous simplement parce que on
             * fait le payement que pour les élèves inscrit pour la dernières années scolaire
             */
            $id_annee = DB::table('annee')->latest('id')->first()->id;

            $all_inscriptions = Inscrit::where('annee_id',$annee_courante->id)->where('niveau_id',$id)->with('eleve','niveau')->get();
            $all_niveaux = Niveau::all();
            $classe = Niveau::where('id',$id)->first();

        return view('pages.paiement_eleve/paiement_des_frais_par_classe',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_inscriptions','all_niveaux','classe'));
      }

      public function default_situation_journaliere()
        {
            $this->InfosUser_AND_ThemeActive();

            $chemin_theme_actif = $this->chemin_theme_actif;
            $nom = $this->nom;
            $avatar = $this->avatar;
            $annee_courante = $this->annee_courante;
            $all_annee = Annee::all();

            $date = now();
            $all_paiements = PaiementEleve::where('annee_id',$annee_courante->id)->where('status',1)->where('date_paiement',$date->format('Y-m-d'))->get();
            // dd($all_paiements);
            $i = 1;

            return view('pages.paiement_eleve.situation_journaliere',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','date','all_paiements','i'));
        }

    public function show_situation_journaliere(Request $request)
        {
            $this->InfosUser_AND_ThemeActive();

            $chemin_theme_actif = $this->chemin_theme_actif;
            $nom = $this->nom;
            $avatar = $this->avatar;
            $annee_courante = $this->annee_courante;
            $all_annee = Annee::all();

            $all_paiements = PaiementEleve::where('annee_id',$annee_courante->id)->where('status',1)->where('date_paiement',$request->date_choisie)->get();
            // dd($all_paiements);
            $i = 1;

            $date = Carbon::create($request->date_choisie);

            return view('pages.paiement_eleve.situation_journaliere',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','date','all_paiements','i'));
        }
}
