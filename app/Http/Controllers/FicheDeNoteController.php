<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mes_models\Annee;
use App\Traits\InfosUserThemeActive;
use App\mes_models\Note;
use App\mes_models\Niveau;
use App\mes_models\Trimestre;
class FicheDeNoteController extends Controller
{
    use InfosUserThemeActive;
    //

    public function fiche_modulaire()
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

        $liste_des_matieres = Note::groupBy('matiere_id')
                                    ->where('niveau_id',$niveau_choisi->id)
                                    ->where('trimestre_id',$trimestre_choisi->id)
                                    ->where('annee_id',$annee_courante->id)
                                    ->with('eleve','matiere')
                                    ->get();
        // dd($liste_des_matieres);


        $classements =  Note::groupBy('eleve_id')
                            ->selectRaw('(sum(note1) + sum(note2) + sum(note3))/sum(nbre_notes) as moy ,eleve_id')
                            ->where('moyenne','!=',null)
                            ->where('niveau_id',$niveau_choisi->id)
                            ->where('trimestre_id',$trimestre_choisi->id)
                            ->where('annee_id',$annee_courante->id)
                            ->orderBy('moy','desc')
                            ->with('eleve','matiere')
                            ->get();

        // $total_par_matiere =  Note::groupBy('eleve_id','matiere_id')
        //                         ->selectRaw('(sum(note1) + sum(note2) + sum(note3))/sum(nbre_notes) as moy ,eleve_id,matiere_id')
        //                         ->where('moyenne','!=',null)
        //                         ->where('niveau_id',$niveau_choisi->id)
        //                         ->where('trimestre_id',$trimestre_choisi->id)
        //                         ->where('annee_id',$annee_courante->id)
        //                         ->orderBy('moy','desc')
        //                         ->with('eleve','matiere')
        //                         ->get();
        // dd($total_par_matiere);
        //  dd($classements);

        $notes = Note::where('niveau_id',$niveau_choisi->id)
                     ->where('trimestre_id',$trimestre_choisi->id)
                     ->where('annee_id',$annee_courante->id)
                     ->with('eleve','matiere')
                     ->get();

            // dd($notes);
        $n = 1;
        $i = 1;

        return view('pages.fiche_de_note.fiche_modulaire',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','notes','liste_des_matieres','classements','n','i','niveau_choisi'));
    }
}
