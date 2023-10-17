<?php

namespace App\Http\Controllers;

use App\mes_models\EnseigneNiveau;
use Illuminate\Http\Request;
use App\mes_models\Annee;
use App\Traits\InfosUserThemeActive;
use App\mes_models\Niveau;
class EnseigneNiveauController extends Controller
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
         * on verifit si ce niveau n'a pas été affecté déjà à un enseignant
         */
        if(EnseigneNiveau::where('niveau_id',$request->niveau_id)->exists())
        {
            alert('Attention','Cette classe à été déjà attribuer à un enseignant Veuillez consulter le détail des attributions de classe','success')->addImage('/assets/asset_principal/img_sweat_alert/alert4.jpg')->autoclose(false);
            return back();
        }
        else
        {
            $new = EnseigneNiveau::create([
                'user_id' => $request->user_id,
                'niveau_id' => $request->niveau_id,
                'salaire' => $request->salaire
            ]);

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

        $enseignant_niveau = EnseigneNiveau::where('niveau_id',$id)->where('status',1)->with(['niveau','user'])->first();
        $niveau_choisit = Niveau::where('id',$id)->first();

        return view('pages.attribution_classe.show',compact('chemin_theme_actif','all_annee','annee_courante','nom','avatar','niveau_choisit','enseignant_niveau'));
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
        $update_config_salaire = EnseigneNiveau::where('niveau_id',$id)->update([
                                                                                    'salaire' => $request->salaire
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
        $delete_enseignant = EnseigneNiveau::where('id',$id)->delete();

        return back();
    }
}
