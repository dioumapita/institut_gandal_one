<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mes_models\Annee;
use App\mes_models\Depense;
use App\Traits\InfosUserThemeActive;
use NumberFormatter;
class DepenseController extends Controller
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

        $all_depenses = Depense::where('annee_id',$annee_courante->id)->get();
        $i = 1;
        $convertisseur = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
        return view('pages.depense/index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_depenses','i','convertisseur'));
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

        $request->validate([
            'doc' => 'mimes:pdf|max:1024'
        ]);
        if($request->file('doc'))
        {
             //on récupère l'extension de l'image(png,jpg,jpeg,...)
            $extension = $request->file('doc')->extension();
            //on donne un nom à l'image en utilisant la fonction time()
                $fileName = time().'.'.$extension;
            //on deplace l'image vers le dossier eleves
            $request->file('doc')->storeAs('doc_depenses',$fileName);
        }
        else
        {
            $fileName = null;
        }


        // dd("stop");
        $new_depense = Depense::create([
                                         'depense' => $request->depense,
                                         'montant' => $request->montant,
                                         'date_depense' => $request->date_depense,
                                         'annee_id' => $request->annee_id,
                                         'doc_depenses' => $fileName
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
        $request->validate([
            'doc' => 'mimes:pdf|max:1024'
        ]);
        if($request->file('doc'))
        {
            //on récupère l'extension de l'image(png,jpg,jpeg,...)
            $extension = $request->file('doc')->extension();
            //on donne un nom à l'image en utilisant la fonction time()
                $fileName = time().'.'.$extension;
            //on deplace l'image vers le dossier eleves
                $request->file('doc')->storeAs('doc_depenses',$fileName);
        }
        else
        {
            $fileName = null;
        }
        //
        $update = Depense::where('id',$id)->update([
                                                        'depense' => $request->depense,
                                                        'montant' => $request->montant,
                                                        'date_depense' => $request->date_depense,
                                                        'doc_depenses' => $fileName
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
        $delete = Depense::where('id',$id)->delete();

        return back();
    }
}
