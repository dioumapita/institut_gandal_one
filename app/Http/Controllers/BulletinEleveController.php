<?php

namespace App\Http\Controllers;

use App\mes_models\Annee;
use App\mes_models\Inscrit;
use App\mes_models\Note;
use Illuminate\Http\Request;
use App\Traits\InfosUserThemeActive;
use App\mes_models\Niveau;
use App\mes_models\Trimestre;
use App\mes_models\Eleve;
use Illuminate\Support\Collection;
class BulletinEleveController extends Controller
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

        /**
         * on selectionne une classe par defaut(la première classe)
         */
        $niveau_choisi = Niveau::first();
        $trimestre_choisi = Trimestre::first();

        $classements =  Note::groupBy('eleve_id')
                            ->selectRaw('sum(moyenne)/sum(coefficient) as moy,sum(moyenne) as total_moy, eleve_id')
                            ->where('moyenne','!=',null)
                            ->where('niveau_id',$niveau_choisi->id)
                            ->where('trimestre_id',$trimestre_choisi->id)
                            ->where('annee_id',$annee_courante->id)
                            ->orderBy('moy','desc')
                            ->with('eleve')
                            ->get();
        /** Total élèves */
        $total_eleves = Inscrit::where('niveau_id',$niveau_choisi->id)
                                ->where('annee_id',$annee_courante->id)
                                ->count();

        $notes = Note::where('niveau_id',$niveau_choisi->id)
                     ->where('trimestre_id',$trimestre_choisi->id)
                     ->where('annee_id',$annee_courante->id)
                     ->get();
        // dd($notes);

        /**
         * on selectionne toutes les classe et les trimestre pour permettre à l'utilisateur de choisir
         */
        $all_classes = Niveau::all();
        $all_trimestres = Trimestre::all();

        $i = 1;
        $b = 1;


        return view('pages.bulletins.index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','classements','i','notes','niveau_choisi','trimestre_choisi','b','total_eleves','all_classes','all_trimestres'));
    }
    /**
     * creation de la methode bulletin par élève
     */
    public function bulletin_par_eleve(Request $request, $id)
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

        $niveau_choisi = Niveau::where('id',$request->niveau_id)->first();
        $trimestre_choisi = Trimestre::where('id',$request->trimestre_id)->first();
        $rang = $request->rang;
        $moyenne_generale = $request->moyenne_generale;
        $total_eleves = $request->total_eleves;

        $notes_eleve = Note::where('eleve_id',$id)
                            ->where('niveau_id',$niveau_choisi->id)
                            ->where('trimestre_id',$trimestre_choisi->id)
                            ->where('annee_id',$annee_courante->id)
                            ->get();

        $infos_eleve = Eleve::where('id',$id)->first();


        return view('pages.bulletins/bulletin_par_eleve',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','niveau_choisi','trimestre_choisi','rang','moyenne_generale','total_eleves','notes_eleve','infos_eleve'));
    }

    /**
     * methode utiliser pour afficher les bulletins des élèves par niveau
     */
    public function bulletin_par_niveau(Request $request)
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

        /**on recupère le niveau choisi et le trimestre choisi */
        $niveau_choisi = Niveau::where('id',$request->niveau_id)->first();
        $trimestre_choisi = Trimestre::where('id',$request->trimestre_id)->first();
        /** Total élèves */
        $total_eleves = Inscrit::where('niveau_id',$niveau_choisi->id)
                                ->where('annee_id',$annee_courante->id)
                                ->count();
        if($request->trimestre_id != 'resultat_annuel')
        {

                $classements =  Note::groupBy('eleve_id')
                                ->selectRaw('sum(moyenne)/sum(coefficient) as moy,sum(moyenne) as total_moy,eleve_id')
                                ->where('moyenne','!=',null)
                                ->where('niveau_id',$niveau_choisi->id)
                                ->where('trimestre_id',$trimestre_choisi->id)
                                ->where('annee_id',$annee_courante->id)
                                ->orderBy('moy','desc')
                                ->with('eleve')
                                ->get();


                $notes = Note::where('niveau_id',$niveau_choisi->id)
                            ->where('trimestre_id',$trimestre_choisi->id)
                            ->where('annee_id',$annee_courante->id)
                            ->get();
                // dd($notes);

                /**
                 * on selectionne toutes les classe et les trimestre pour permettre à l'utilisateur de choisir
                 */
                $all_classes = Niveau::all();
                $all_trimestres = Trimestre::all();

                $i = 1;
                $b = 1;

            return view('pages.bulletins.index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','classements','i','notes','niveau_choisi','trimestre_choisi','b','total_eleves','all_classes','all_trimestres'));
        }
        else
        {
            if($niveau_choisi->id <= 18 || $niveau_choisi->id == 35)
            {
                $notes = Note::where('niveau_id',$niveau_choisi->id)
                        ->where('annee_id',$annee_courante->id)
                        ->where('moyenne','!=',null)
                        ->where('trimestre_id',13)
                        ->orwhere('trimestre_id',14)
                        ->orwhere('trimestre_id',15)
                        ->get()->groupBy(['matiere_id']);

                $moy_trimestre1 =  Note::groupBy('eleve_id')
                                    ->selectRaw('sum(moyenne)/sum(coefficient) as moy, eleve_id')
                                    ->where('moyenne','!=',null)
                                    ->where('niveau_id',$niveau_choisi->id)
                                    // ->where('eleve_id',675)
                                    ->where('trimestre_id',13)
                                    ->where('annee_id',$annee_courante->id)
                                    ->orderBy('moy','desc')
                                    ->with('eleve');
            // dd($moy_trimestre1->get());
                $moy_trimestre2 =  Note::groupBy('eleve_id')
                                    ->selectRaw('sum(moyenne)/sum(coefficient) as moy, eleve_id')
                                    ->where('moyenne','!=',null)
                                    ->where('niveau_id',$niveau_choisi->id)
                                    ->where('trimestre_id',14)
                                    ->where('annee_id',$annee_courante->id)
                                    ->orderBy('moy','desc')
                                    ->with('eleve');

                $moy_trimestre3 =  Note::groupBy('eleve_id')
                                    ->selectRaw('sum(moyenne)/sum(coefficient) as moy, eleve_id')
                                    ->where('moyenne','!=',null)
                                    ->where('niveau_id',$niveau_choisi->id)
                                    ->where('trimestre_id',15)
                                    ->where('annee_id',$annee_courante->id)
                                    ->orderBy('moy','desc')
                                    ->with('eleve');



                $t1 = $moy_trimestre1->get();
                $t2 = $moy_trimestre2->get();
                $t3 = $moy_trimestre3->get();

                $moy1_and_moy2_and_moy3 = $moy_trimestre1->unionAll($moy_trimestre2)->unionAll($moy_trimestre3)->get()->groupBy('eleve_id');


                $collection = new Collection();
                foreach($moy1_and_moy2_and_moy3 as $moy)
                {
                    // dd($moy);
                    $collection->push((object)[
                        'eleve' => $moy[0]->eleve,
                        'total' => bcdiv($moy->sum('moy'),1,2),
                        'moyenne' => bcdiv(($moy->sum('moy') / $moy->count()),1,2)
                    ]);
                }
                // dd("stop");
                $classements =   $collection->sortByDesc('moyenne');

                /** Total élèves */
                $total_eleves = Inscrit::where('niveau_id',$niveau_choisi->id)
                ->where('annee_id',$annee_courante->id)
                ->count();

                /**
                 * on selectionne toutes les classe et les trimestre pour permettre à l'utilisateur de choisir
                */
                $all_classes = Niveau::all();
                $all_trimestres = Trimestre::all();

                $i = 1;
                $b = 1;


                return view('pages.bulletins.bulletin_annuel_primaire',compact('chemin_theme_actif','nom','avatar','annee_courante',
                    'all_annee','classements','i','niveau_choisi','b',
                    'total_eleves','all_classes','all_trimestres','notes','t1','t2','t3'));
                }
            else
            {

                    $notes = Note::where('niveau_id',$niveau_choisi->id)
                                ->where('annee_id',$annee_courante->id)
                                ->get()->groupBy(['matiere_id']);



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
                                    's1' => $moy[0]->moy ?? null,
                                    's2' => $moy[1]->moy ?? null,
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

                    return view('pages.bulletins.bulletin_annuel',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_classes','all_trimestres','b','i','niveau_choisi','total_eleves','notes','classements'));
            }
        }
    }
}
