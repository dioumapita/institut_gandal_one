<?php

namespace App\Http\Controllers;

use App\mes_models\AbsenceEleve;
use App\mes_models\Niveau;
use Illuminate\Http\Request;
use App\Traits\InfosUserThemeActive;
use Illuminate\Support\Facades\DB;
use App\mes_models\Annee;
use App\mes_models\Inscrit;
use App\mes_models\Matiere;
use Carbon\Carbon;
use MercurySeries\Flashy\Flashy;
use Alert;

class AbsenceEleveController extends Controller
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

        $all_niveaux = Niveau::all();


        return view('pages.absences_eleves/index',compact('chemin_theme_actif','nom','avatar','all_niveaux','all_annee','annee_courante'));
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
        $matiere_id = $request->matiere_id;
        $d_ab = $request->date_absence;
        $niveau_id = $request->niveau_id;
        $annee_id = $request->annee_id;
        $status = $request->status;
        $duree = $request->duree;
        $motif = $request->motif;
        $commentaire = $request->commentaire;

        foreach($request->eleve_id as $key => $eleve)
            {

                /**
                 * on verifit si l'absence de l'élève n'as pas été enregistre aujourd'hui
                 * pour cette matiere si c'est le cas on informe à l'utilisateur risque de doublons
                 */
                if(AbsenceEleve::where('eleve_id',$eleve)
                               ->where('matiere_id',$matiere_id)
                               ->where('niveau_id',$niveau_id)
                               ->where('annee_id',$annee_id)
                               ->where('d_ab',$d_ab)
                               ->exists()
                )
                {
                    alert('Attention','Risque de doublons','success')->addImage('/assets/asset_principal/img_sweat_alert/alert4.jpg')->autoclose(false);
                    return back();
                }
                /**
                 * insertion dans la table absence des élèves
                 */
                /**
                 * si le status est présent donc on a pas besoin de motif
                 * ou de commentaire
                 */
                if($status[$key] == 'present' OR $status[$key] == 'presente')
                    {
                        $insertion = AbsenceEleve::create([
                                                            'eleve_id' => $eleve,
                                                            'matiere_id' => $matiere_id,
                                                            'niveau_id' => $niveau_id,
                                                            'annee_id' => $annee_id,
                                                            'd_ab' => $d_ab,
                                                            'status' => $status[$key],
                                                        ]);
                    }
                elseif($status[$key] == 'absent' and $motif[$key] == null)
                {
                    /**
                     * si le motif de l'absence est null on prend non justifier
                     */
                    $insertion = AbsenceEleve::create([
                        'eleve_id' => $eleve,
                        'matiere_id' => $matiere_id,
                        'niveau_id' => $niveau_id,
                        'annee_id' => $annee_id,
                        'd_ab' => $d_ab,
                        'status' => $status[$key],
                        'motif' => 'non_justifier',
                        'commentaires' => $commentaire[$key]
                    ]);

                }
                elseif($status[$key] == 'absente' and $motif[$key] == null)
                {
                    /**
                     * si le motif de l'absence est null on prend non justifier
                     */
                    $insertion = AbsenceEleve::create([
                        'eleve_id' => $eleve,
                        'matiere_id' => $matiere_id,
                        'niveau_id' => $niveau_id,
                        'annee_id' => $annee_id,
                        'd_ab' => $d_ab,
                        'status' => $status[$key],
                        'motif' => 'non_justifier',
                        'commentaires' => $commentaire[$key]
                    ]);

                }
                else
                {
                    /**
                     * si le motif de l'absence exite on l'enregistre autrement dit est différent de null
                     */
                    /**
                     * si le motif de l'absence est null on prend non justifier
                     */
                    $insertion = AbsenceEleve::create([
                        'eleve_id' => $eleve,
                        'matiere_id' => $matiere_id,
                        'niveau_id' => $niveau_id,
                        'annee_id' => $annee_id,
                        'd_ab' => $d_ab,
                        'status' => $status[$key],
                        'motif' => $motif[$key],
                        'commentaires' => $commentaire[$key]
                    ]);
                }
            }
            //message flash
            Flashy::success('Absence Enregistrer avec succès');
            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        //

    }
    /**
     * methode permettant d'afficher les détails des absences  des élèves dans une matiere
     */
    public function detail_absence_eleve(Request $request,$id)
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
        $niveau = Niveau::where('id',$id)->first();
        /**
         * on selectionne la dernière annee scolaire pour
         * afficher les élèves du niveau choisi pour cette année
         */
        $annee_id = DB::table('annee')->latest('id')->first()->id;

        //on selectionne les absence du niveau choisi pour la dernière année scolaire
        $all_absences = AbsenceEleve::where('niveau_id',$id)
                                    ->where('matiere_id',$request->matiere_id)
                                    ->where('annee_id',$annee_id)
                                    ->orderBy('d_ab','desc')
                                    ->with('eleve')->get();
        /**
         * on selectionne toutes les absences effectuer par les élèves dans la matiere choisie
         */
        $all_inscrits = Inscrit::where('niveau_id',$id)->where('annee_id',$annee_id)->get();

        $matiere_choisie = matiere::where('id',$request->matiere_id)->first();

        return view('pages.absences_eleves/detail_absence',compact('chemin_theme_actif','nom','avatar','all_absences','all_annee','annee_courante','niveau','matiere_choisie','all_inscrits'));
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
        $eleve_id = $id;
        $matiere_id = $request->matiere_id;
        $niveau_id = $request->niveau_id;
        $date_absence = $request->date_absence;
        /**
         * on selectionne la dernière année scolaire parce que les modification ne sont autoriser
         * que pour cette année scolaire
         */
        $annee_id = DB::table('annee')->latest('id')->first()->id;
        /**
         * on passe à la modification de l'absence de l'élève
         */
        if($request->status == 'present' OR $request->status == 'presente')
        {

            /**
             * si le status de l'élève est present ou presente on enregistre pas le motif
             * et le commentaire
             */
            $modification = AbsenceEleve::where('eleve_id',$eleve_id)
                                        ->where('matiere_id',$matiere_id)
                                        ->where('niveau_id',$niveau_id)
                                        ->where('annee_id',$annee_id)
                                        ->where('d_ab',$date_absence)
                                        ->update([
                                                    'status' => $request->status,
                                                    'motif' => null,
                                                    'commentaires' => null
                                                ]);
        }
        else if($request->status == 'absent' and $request->motif == null OR $request->status == 'absente' and $request->motif == null)
        {
            /**
             * si le motif de l'absence est null on met non justifier
             */
            $modification = AbsenceEleve::where('eleve_id',$eleve_id)
                                        ->where('matiere_id',$matiere_id)
                                        ->where('niveau_id',$niveau_id)
                                        ->where('annee_id',$annee_id)
                                        ->where('d_ab',$date_absence)
                                        ->update([
                                                    'status' => $request->status,
                                                    'motif' => 'non_justifier',
                                                    'commentaires' => $request->commentaire
                                                ]);
        }
        else
        {
            // dd($request->motif);
            /**
             * on stock les valeurs choisi par l'utilisateur
             */
            $modification = AbsenceEleve::where('eleve_id',$eleve_id)
                                        ->where('matiere_id',$matiere_id)
                                        ->where('niveau_id',$niveau_id)
                                        ->where('annee_id',$annee_id)
                                        ->where('d_ab',$date_absence)
                                        ->update([
                                                    'status' => $request->status,
                                                    'motif' => $request->motif,
                                                    'commentaires' => $request->commentaire
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
    public function destroy(Request $request,$id)
    {
            $eleve_id = $id;
            $matiere_id = $request->matiere_id;
            $niveau_id = $request->niveau_id;
            $date_absence = $request->date_absence;

        /**
         * on selectionne la dernière année scolaire parce que les modification ne sont autoriser
         * que pour cette année scolaire
         */
        $annee_id = DB::table('annee')->latest('id')->first()->id;

        /**
         * on passe à la suppression
         */
        $suppression = AbsenceEleve::where('eleve_id',$eleve_id)
                                   ->where('matiere_id',$matiere_id)
                                   ->where('niveau_id',$niveau_id)
                                   ->where('annee_id',$annee_id)
                                   ->where('d_ab',$date_absence)
                                   ->delete();

        //message flash
        Flashy::success('Suppression effectuée avec succès');
        return back();
    }

    /**
     * Absence des élèves cette methode permet de choisir la matière pour la quelle
     * on veut saisir ou afficher les absences des élèves
     */
    public function absence_par_matiere($id)
    {
        /**
         * A ce niveau on affiche les matière en fonctions de l'emplois du temps
         * je pense que ce pas j'affiche pas en fonction de l'emplois du temps
         */
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

        $niveau_choisi = Niveau::where('id',$id)->first();
        $all_matieres = $niveau_choisi->matieres;

         return view('pages.absences_eleves.absence_par_matiere',compact('nom','avatar','chemin_theme_actif','annee_courante','all_annee','niveau_choisi','all_matieres'));
    }



    //absence des eleves par niveaux
    public function absence_par_niveau(Request $request,$id)
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

        $niveau = Niveau::where('id',$id)->first();

        /**
         * on selectionne la dernière annee scolaire pour
         * afficher les élèves du niveau choisi pour cette année
         */
        $annee_id = DB::table('annee')->latest('id')->first()->id;

        /**
         * on verifit si l'utilisateur à selectionner la date d'absence des élèves
         * si c'est le cas on prend cette date au contraire on prend la date du
         * système par défaut
         */
        if($request->d_absence == null)
        {
            $date_absence = Carbon::now()->format('Y-m-d');
        }
        else
        {
           $date_absence = $request->d_absence;
        }



        /**
         * on selectionne les élèves inscrit dans le niveau selectionner
         * pour la dernière année scolaire
         */
        $all_inscrits = Inscrit::where('niveau_id',$id)
                                ->where('annee_id',$annee_id)
                                ->with('eleve')
                                ->get();

        $matiere_choisie = Matiere::where('id',$request->matiere_id)->first();
        $all_niveaux = Niveau::all();
        return view('pages.absences_eleves/absence_par_niveau',compact('chemin_theme_actif','nom','avatar','niveau','all_inscrits','annee_id','annee_courante','all_annee','matiere_choisie','all_niveaux','date_absence'));
    }
    /**
     * methode permettant de gerer l'impression des absences des élèves par niveau et par matière
     */
    public function print_absences_eleves($id)
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
        $niveau = Niveau::where('id',$id)->first();
        /**
         * on recupère la dernière année scolaire
         */
        $annee_id = DB::table('annee')->latest('id')->first()->id;
        /**
         * on recupère tous les élèves inscrits dans cette classe(niveau choisi)
         */
        $all_inscrits = Inscrit::where('niveau_id',$id)
                               ->where('annee_id',$annee_id)
                               ->with('eleve')
                               ->get();
        return view('pages.absences_eleves/print_absences_eleves',compact('nom','avatar','chemin_theme_actif','annee_courante','all_annee','all_inscrits','niveau'));
    }
}
