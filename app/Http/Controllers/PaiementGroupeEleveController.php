<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\InfosUserThemeActive;
use App\mes_models\Annee;
use App\mes_models\Eleve;
use App\mes_models\PaiementEleve;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
class PaiementGroupeEleveController extends Controller
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
    public function index(Request $request)
    {
        // dd("bonjour");

        $eleve = Eleve::where('id',$request->id)->first();
        $contact = Eleve::where('id',$request->id)->first()->telephone_parent;
        $all_eleves = Eleve::where('telephone_parent',$contact)->get();

        // dd($all_eleves);

        $this->InfosUser_AND_ThemeActive();

        $chemin_theme_actif = $this->chemin_theme_actif;
        $nom = $this->nom;
        $avatar = $this->avatar;
        $annee_courante = $this->annee_courante;
        $all_annee = Annee::all();

        return view('pages.paiement_groupe_eleve.index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_eleves','eleve'));
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
        //
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
    }


    public function validation_scolarite(Request $request)
    {
        // dd("bonjour");
        // dd("bonjour");
        $this->InfosUser_AND_ThemeActive();

        $annee_courante = $this->annee_courante;

       $all_eleves = Eleve::whereIn('id',$request->eleve_id)->get();

       if(PaiementEleve::where('status',1)->where('annee_id',$annee_courante->id)->get()->last() == null)
       {
          $num_recu = 1;
       }
       else
       {
          $num_recu = PaiementEleve::where('status',1)->where('annee_id',$annee_courante->id)->get()->last()->num_recu + 1;
       }
       foreach($all_eleves as $eleve)
       {
           PaiementEleve::where('eleve_id',$eleve->id)->where('annee_id',$annee_courante->id)->where('status',0)->get()->last()->update([
               'status' => 1,
               'num_recu' => $num_recu
            ]);
       }

        return redirect()->route('get_validation_scolarite',['id' => $request->eleve_id,'num_recu' => $num_recu]);

    }

    public function get_validation_scolarite(Request $request)
    {
        // dd("bine");
        $this->InfosUser_AND_ThemeActive();

        $chemin_theme_actif = $this->chemin_theme_actif;
        $nom = $this->nom;
        $avatar = $this->avatar;
        $annee_courante = $this->annee_courante;
        $all_annee = Annee::all();

        $all_eleves = Eleve::whereIn('id',$request->id)->get();


        foreach($all_eleves as $eleve)
        {
            PaiementEleve::where('eleve_id',$eleve->id)->where('annee_id',$annee_courante->id)->where('status',0)->delete();
        }
        // dd("bonjour");
        $eleve = $all_eleves->first();
        $num_recu = $request->num_recu;
        $all_paiements =  PaiementEleve::where('num_recu',$num_recu)->where('annee_id',$annee_courante->id)->get();

        if($all_paiements->count() == 0)
        {
            return redirect()->route('paiement_eleve.index');
        }

        $date_paiement = $all_paiements->first()->date_paiement->format('d/m/Y');

    return view('pages.paiement_groupe_eleve.validation',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_eleves','eleve','num_recu','date_paiement'));

    }
}
