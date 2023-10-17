<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\InfosUserThemeActive;
use App\mes_models\Annee;
use App\mes_models\Inscrit;
use App\mes_models\Niveau;
use App\mes_models\Note;
use App\mes_models\Trimestre;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
class ClassementEleveController extends Controller
{
    //
     /**
     * le trait InfosUserThemeActive contient deux:traits
     * 1-le trait permettant de selectionner les informations
     *   de l'utilisateur connecté
     * 2-le trait permettant de selectionner le theme activer
     */
    use InfosUserThemeActive;

    public function index()
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

        $all_classes = Niveau::all();
        $all_trimestres = Trimestre::all();
        /**
         * on selectionne une classe par defaut(la première classe)
         */
        $niveau_choisi = Niveau::first();
        $trimestre_choisi = Trimestre::first();

        $classements =  Note::groupBy('eleve_id')
                            ->selectRaw('sum(moyenne)/sum(coefficient) as moy, eleve_id')
                            ->where('moyenne','!=',null)
                            ->where('niveau_id',$niveau_choisi->id)
                            ->where('trimestre_id',$trimestre_choisi->id)
                            ->where('annee_id',$annee_courante->id)
                            ->orderBy('moy','desc')
                            ->with('eleve')
                            ->get();

        //on récupère le total d'élève inscrit pour la classe
        $total_inscrit = Inscrit::where('niveau_id',$niveau_choisi->id)
                                ->where('annee_id',$annee_courante->id)
                                ->get();



        $i = 1;
        $b = 1;
        return view('pages.classement.index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','classements','all_classes','all_trimestres' ,'niveau_choisi','trimestre_choisi','i','b','total_inscrit'));
    }

    /**
     * method utiliser pour filtre le classement par niveau ou par trimestre
     */
    public function show(Request $request)
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

        $all_classes = Niveau::all();
        $all_trimestres = Trimestre::all();

        /**
         * on selectionne une classe par defaut(la première classe)
         */

        $niveau_choisi = Niveau::where('id',$request->niveau_id)->first();
        $trimestre_choisi = Trimestre::where('id',$request->trimestre_id)->first();
        $id_annee = $annee_courante->id;
        //on récupère le total d'élève inscrit pour la classe
        $total_inscrit = Inscrit::where('niveau_id',$niveau_choisi->id)
        ->where('annee_id',$annee_courante->id)
        ->get();
        /**
         * on verifit si le trimestre choisit ou la periode choisit est final
         * on affiche le classement final au contraire on affiche le classement
         * par trimestre ou periode
         */
        if($request->trimestre_id != 'final')
            {
                $classements =  Note::groupBy('eleve_id')
                                    ->selectRaw('sum(moyenne)/sum(coefficient) as moy, eleve_id')
                                    ->where('moyenne','!=',null)
                                    ->where('niveau_id',$niveau_choisi->id)
                                    ->where('trimestre_id',$trimestre_choisi->id)
                                    ->where('annee_id',$annee_courante->id)
                                    ->orderBy('moy','desc')
                                    ->with('eleve')
                                    ->get();

                /** utiliser pour le comptage au niveau des tableaux(1,2,3 ....) */
                $i = 1;
                $b = 1;

                return view('pages.classement/index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','classements','all_classes','all_trimestres' ,'niveau_choisi','trimestre_choisi', 'i','b','total_inscrit'));
            }
        else
        {
            $moy_semestre1 =  Note::groupBy('eleve_id')
                        ->selectRaw('sum(moyenne)/sum(coefficient) as moy, eleve_id')
                        ->where('moyenne','!=',null)
                        ->where('niveau_id',$niveau_choisi->id)
                        ->where('trimestre_id',1)
                        ->where('annee_id',$annee_courante->id)
                        ->orderBy('moy','desc')
                        ->with('eleve');
            // dd($moy_semestre1->get());
            $moy_semestre2 =  Note::groupBy('eleve_id')
                        ->selectRaw('sum(moyenne)/sum(coefficient) as moy, eleve_id')
                        ->where('moyenne','!=',null)
                        ->where('niveau_id',$niveau_choisi->id)
                        ->where('trimestre_id',2)
                        ->where('annee_id',$annee_courante->id)
                        ->orderBy('moy','desc')
                        ->with('eleve');
            // dd($moy_semestre2->get());
            $moy1_and_moy2 = $moy_semestre1->unionAll($moy_semestre2)->get()->groupBy('eleve_id');
            // dd($moy1_and_moy2);

            $collection = new Collection();
                foreach($moy1_and_moy2 as $moy)
                {
                    $collection->push((object)[
                        'eleve' => $moy[0]->eleve,
                        'total' => floor($moy->sum('moy') * 100) / 100,
                        'moyenne' => floor(($moy->sum('moy') / $moy->count()) * 100) / 100
                    ]);
                }

            $classements =   $collection->sortByDesc('moyenne');
            // dd($classements);
            /**
             * on selectionne toutes les classe et les trimestre pour permettre à l'utilisateur de choisir
             */
                $all_classes = Niveau::all();
                $all_trimestres = Trimestre::all();

                $i = 1;
                $b = 1;

                return view('pages.classement.final',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','classements','all_classes','all_trimestres' ,'niveau_choisi','trimestre_choisi','i','b','total_inscrit'));
        }

    }

    public function final()
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

        $all_classes = Niveau::all();
        $all_trimestres = Trimestre::all();
        /**
         * on selectionne une classe par defaut(la première classe)
         */
        $niveau_choisi = Niveau::first();
        $trimestre_choisi = Trimestre::first();

        $classements =  Note::groupBy('eleve_id')
                            ->selectRaw('sum(moyenne)/sum(coefficient) as moy, eleve_id')
                            ->where('moyenne','!=',null)
                            ->where('niveau_id',$niveau_choisi->id)
                            ->where('annee_id',$annee_courante->id)
                            ->orderBy('moy','desc')
                            ->with('eleve')
                            ->get();

        //on récupère le total d'élève inscrit pour la classe
        $total_inscrit = Inscrit::where('niveau_id',$niveau_choisi->id)
                                ->where('annee_id',$annee_courante->id)
                                ->get();



        $i = 1;
        $b = 1;
        return view('pages.classement/final',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','classements','all_classes','all_trimestres' ,'niveau_choisi','trimestre_choisi','i','b','total_inscrit'));

    }
}
