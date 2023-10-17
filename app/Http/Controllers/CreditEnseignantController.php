<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mes_models\Annee;
use App\mes_models\CreditEnseignant;
use App\Traits\InfosUserThemeActive;
use App\User;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
class CreditEnseignantController extends Controller
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

        $all_enseignant = Role::where('name','Enseignant')->first()->users;

        return view('pages/credits_enseignants/index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_enseignant'));
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

        if($request->montant_credit)
        {
            /**
             * on selectionne l'id de la dernière année scolaire tous simplement parce que on
             * fait le payement que pour les élèves inscrit pour la dernières années scolaire
             */
            $id_annee = DB::table('annee')->latest('id')->first()->id;
            //
            $ajout = CreditEnseignant::create([
                    'somme_credit' => $request->montant_credit,
                    'motif' => $request->motif,
                    'date_credit' => $request->date_credit,
                    'type_de_credit' => $request->type_de_credit,
                    'mois_remboursement' => $request->mois_remboursement,
                    'debut_remboursement' => $request->debut_remboursement,
                    'fin_remboursement' => $request->fin_remboursement,
                    'montant_par_mois' => $request->montant_par_mois,
                    'user_id' => $request->user_id,
                    'annee_id' => $id_annee
            ]);
            //message flash
            Flashy::success('Crédit effectuez avec succès');

            return back();
        }
        else
        {
            $id_annee = DB::table('annee')->latest('id')->first()->id;
            //
            $ajout = CreditEnseignant::create([
                    'somme_rembourser' => $request->montant_rembourser,
                    'type_de_credit' => $request->type_de_credit,
                    'mois_remboursement' => $request->mois_remboursement,
                    'date_credit' => $request->date_credit,
                    'user_id' => $request->user_id,
                    'annee_id' => $id_annee
            ]);
            //message flash
            Flashy::success('Remboursement effectuez avec succès');

            return back();
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
         * on affiche les détails du paiement d'un enseignant au cour
         * de l'année scolaire
         */
        $id_annee = DB::table('annee')->latest('id')->first()->id;

        $enseignant = User::where('id',$id)->first();


        return view('pages/credits_enseignants/show',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','enseignant'));
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
        if($request->montant_credit)
        {
            //dd($id);
            $modification = CreditEnseignant::where('id',$id)
                                            ->update([
                                                'somme_credit' => $request->montant_credit,
                                                'motif' => $request->motif,
                                                'date_credit' => $request->date_credit,
                                                'mois_remboursement' => $request->mois_remboursement,
                                                'debut_remboursement' => $request->debut_remboursement,
                                                'fin_remboursement' => $request->fin_remboursement,
                                                'montant_par_mois' => $request->montant_par_mois
                                            ]);
            //message flash
            Flashy::success('Modification effectuez avec succès');

            return back();
        }
        else
        {
            $modification = CreditEnseignant::where('id',$id)
                                            ->update([
                                                'somme_rembourser' => $request->montant_rembourser,
                                                'date_credit' => $request->date_credit,
                                                'mois_remboursement' => $request->mois_remboursement
                                            ]);
            //message flash
            Flashy::success('Modification effectuez avec succès');

            return back();
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
        //
        $suppression = CreditEnseignant::where('id',$id)->delete();

        //message flash
        Flashy::success('Suppression effectuez avec succès');

        return back();
    }

    /**
     * gestion crédit enseignant par mois
     */
    public function credit_enseignant_par_mois($id)
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

        $all_enseignant = Role::where('name','Enseignant')->first()->users;

        $num_mois = $id;

        return view('pages/credits_enseignants/index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_enseignant','num_mois'));
    }
}
