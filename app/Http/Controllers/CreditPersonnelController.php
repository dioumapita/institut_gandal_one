<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\InfosUserThemeActive;
use App\mes_models\Personnel;
use App\mes_models\Annee;
use App\mes_models\CreditPersonnel;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;
class CreditPersonnelController extends Controller
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

        $all_personnels = Personnel::all();
        $i = 1;

        return view('pages.credits_personnels/index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_personnels','i'));
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
        // dd($request->all());
        /**
         * on recupère la dernière année scolaire
         */
        $id_annee = DB::table('annee')->latest('id')->first()->id;
        if($request->montant_credit)
        {
            $ajout_credit = CreditPersonnel::create([
                    'montant_credit' => $request->montant_credit,
                    'motif' => $request->motif,
                    'date_credit' => $request->date_credit,
                    'personnel_id' => $request->personnel_id,
                    'annee_id' => $id_annee
            ]);
        }
        else
        {
            $remboursement_credit = CreditPersonnel::create([
                        'montant_rembourser' => $request->montant_rembourser,
                        'date_credit' => $request->date_credit,
                        'personnel_id' => $request->personnel_id,
                        'annee_id' => $id_annee
            ]);
        }

         //message flash
         Flashy::success('Prêt effectuer avec succès');
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
        $annee_courante = $this->annee_courante;
        $all_annee = Annee::all();
        $personnel = Personnel::where('id',$id)->first();
        return view('pages.credits_personnels/show',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','personnel'));
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

        $id_annee = DB::table('annee')->latest('id')->first()->id;
        if($request->montant_credit)
        {
            $update_credit = CreditPersonnel::where('id',$id)
                                            ->update([
                                                        'montant_credit' => $request->montant_credit,
                                                        'motif' => $request->motif,
                                                        'date_credit' => $request->date_credit
                                                    ]);
        }
        else
        {
            $update_remboursement = CreditPersonnel::where('id',$id)
                                                ->update([
                                                        'montant_rembourser' => $request->montant_rembourser,
                                                        'date_credit' => $request->date_credit
                                                    ]);
        }

         //message flash
        Flashy::success('Modification effectuez avec succès');
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

        $delete = CreditPersonnel::where('id',$id)->delete();

        Flashy::success('Suppresion effectuez avec succès');
        return back();
    }
}
