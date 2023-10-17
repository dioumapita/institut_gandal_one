<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mes_models\Annee;
use App\Traits\InfosUserThemeActive;
use Illuminate\Support\Facades\DB;
use App\mes_models\Inscrit;
use App\mes_models\Niveau;
use App\mes_models\RemisePaiementEleve;

class RemisePaiementEleveController extends Controller
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
        /**
         * on selectionne l'id de la dernière année scolaire tous simplement parce que on
         * fait le payement que pour les élèves inscrit pour la dernières années scolaire
         */
        $id_annee = DB::table('annee')->latest('id')->first()->id;

        $all_inscriptions = Inscrit::where('annee_id',$id_annee)->with('eleve','niveau')->get();

        return view('pages.reduction_paiement_eleve.index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_inscriptions'));
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
        /**
         * on récupère l'id dernière année scolaire
         */
        $id_annee = DB::table('annee')->latest('id')->first()->id;

        $scolarite = Niveau::where('id',$request->niveau_id)->first()
                            ->frais_scolaires->where('annee_id',$id_annee)
                            ->first()->scolarite;


        $calcul_pourcentage = $scolarite * ((100 - $request->montant_reduit) / 100);

        $montant_reduit = $scolarite - $calcul_pourcentage;


        $new_reduction = RemisePaiementEleve::create([
                                                        'montant_reduit' => $montant_reduit,
                                                        'type' => $request->type,
                                                        'date_reduction' => $request->date_reduction,
                                                        'eleve_id' => $request->eleve_id,
                                                        'annee_id' => $id_annee
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
        $info_eleve = Inscrit::where('eleve_id',$id)->where('annee_id',$annee_id)->with('eleve')->first();

        $all_remises = RemisePaiementEleve::where('eleve_id',$id)->where('annee_id',$annee_id)->with('eleve')->get();

        return view('pages.reduction_paiement_eleve.show',compact('chemin_theme_actif','nom','avatar','all_annee','annee_courante','info_eleve','all_remises'));
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
        $update_remise = RemisePaiementEleve::where('id',$id)->update([
                                                                        'montant_reduit' => $request->montant_reduit,
                                                                        'type' => $request->type,
                                                                        'date_reduction' => $request->date_reduction
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
        $sup_remise = RemisePaiementEleve::where('id',$id)->delete();

        return back();
    }
}
