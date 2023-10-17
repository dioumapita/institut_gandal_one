<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * utiliser pour le système de langue
 */
Route::group(['prefix' => LaravelLocalization::setLocale(),
   'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
  ], function()
{

Route::view('/','pages/index')->name('index')->middleware('guest');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth','first.login','licence.key');
Route::get('/liste_themes','ThemesController@all_themes')->name('liste_des_themes')->middleware('auth','licence.key');
Route::get('/mon_profil','ProfilsController@mon_profil')->name('mon_profil')->middleware('auth','licence.key');
Route::get('/change_password','ChangePasswordController@create')->name('form_change_password')->middleware('auth','licence.key');
Route::post('/change_password','ChangePasswordController@store')->name('update_password')->middleware('auth','licence.key');
Route::get('/etablissement','EtablissementController@infos_general')->name('etablissement_infos_general')->middleware('auth','licence.key');
Route::get('/classes','ClassesController@all_classes')->name('liste_des_classes')->middleware('auth','licence.key');
Route::get('/OutilsClasse','ClassesController@OutilsClasse')->name('print_excel_pdf_copy_classe')->middleware('auth','licence.key');
Route::resource('annees','AnneeController')->middleware(['auth','licence.key']);
//Route utiliser pour selectionner l'annee active
Route::get('/annee_active/{id}','AnneeController@annee_active')->name('annee_active')->middleware('auth','licence.key');
Route::resource('niveaux','NiveauController')->middleware(['auth','licence.key','permission:Gestion des classes']);
//Route utiliser pour gerer la configuration du paiement des frais scolaires par tranche
Route::get('/config_niveau','NiveauController@config_niveau')->name('config_niveau')->middleware(['auth','licence.key','permission:Gestion des classes']);
Route::put('/config_niveau/{id}','NiveauController@update_config_niveau')->name('update_config_niveau')->middleware(['auth','licence.key','permission:Gestion des classes']);
//utiliser pour afficher les niveaux par année scolaire a supprimer
// Route::get('/annee/{id}/niveaux','NiveauController@niveau_par_annee')->name('niveau_par_annee')->middleware('auth');
Route::resource('eleve','EleveController')->middleware(['auth','licence.key']);
//utiliser pour afficher les eleves par niveau de classe
Route::get('/eleve/{id}/niveau','EleveController@eleve_par_niveau')->name('eleve_par_niveau')->middleware('auth','licence.key');
//afficher les élèves en mode grille
Route::get('/eleves_mode_grille','EleveController@eleve_mode_grille')->name('afficher_les_eleves_en_mode_grille')->middleware('auth','licence.key');
//gestions des matières
Route::resource('matiere','MatiereController')->middleware(['auth','licence.key']);
//Configurations des matieres
Route::get('/config/matiere','MatiereController@config')->name('config_matiere')->middleware('auth','licence.key');
Route::post('/config/matiere','MatiereController@store_config_matiere')->name('store_config_matiere')->middleware('auth','licence.key');
//utiliser pour afficher les matières par classe
Route::get('/matiere/{id}/classe','MatiereController@matiere_par_classe')->name('matiere_par_classe')->middleware('auth','licence.key');
//utiliser pour modifier une matière (le nom de la matiere)
Route::put('/modif/matiere/{id}','MatiereController@modification')->name('modification_de_matiere')->middleware('auth','licence.key');
//utiliser pour la suppression d'ume matiere
Route::delete('/delete/matiere/{id}','MatiereController@suppression')->name('suppression_de_matiere')->middleware('auth','licence.key');
//utiliser pour permettre à l'utilisateur de selectionner une classe
Route::get('/note','NoteController@all_classes')->name('liste_des_notes')->middleware('auth','licence.key');
//utiliser pour selectionner un niveau
Route::get('/note/{id}/niveau','NoteController@note_par_niveau')->name('note_par_niveau')->middleware('auth','licence.key');
//utiliser pour afficher les notes par matiere,niveau,trimestre,annee scolaire pour la saisie
Route::get('/note/filtrer','NoteController@note_filtrer')->name('note_filtrer')->middleware('auth','licence.key');
//utiliser pour permettre à l'utilisateur de saisir les notes avec le mode unique
Route::get('/saisie/note','NoteController@saisie_note')->name('saisie_note')->middleware('auth','licence.key');
//utiliser pour enregistrer les notes dans la base de données
Route::post('/enregistre/note','NoteController@enregistre_note')->name('enregistre_note')->middleware('auth','licence.key');
//utiliser pour permettre à l'utilisateur de saisir les notes avec le mode multiple
Route::get('/saisi/note/mode_multiple','NoteController@saisie_note_mode_multiple')->name('saisie_note_mode_multiple')->middleware('auth','licence.key');
//utiliser pour enregistrer les notes en mode multiple dans la base de données
Route::post('/enregistre/mode_multiple/note','NoteController@enregistre_multiple_note')->name('enregistre_multiple_note')->middleware('auth','licence.key');
//utiliser pour modifier une note
Route::put('/note/update/eleve/{id}','NoteController@update')->name('modification_note')->middleware('auth','licence.key');
//utiliser pour la suppression de la note d'un élève
Route::delete('/note/delete/{id}','NoteController@destroy')->name('suppression_note')->middleware('auth','licence.key');
//gestions des enseignants
Route::resource('enseignant','EnseignantController')->middleware(['auth','licence.key','permission:Gestion des enseignants']);
//Gestion d'attribution de matiere au enseignant
Route::resource('attribution','AttributionMatiereController')->middleware(['auth','licence.key','permission:Attribution de matière ou classe aux enseignants']);
//attribution de matiere par niveau ou classe
Route::get('/attribution/{id}/niveau','AttributionMatiereController@attribution_par_niveau')->name('attribution_de_matiere_par_niveau')->middleware('auth','licence.key','permission:Attribution de matière ou classe aux enseignants');
//Detail enseignement
Route::get('/enseignant/niveau/{id}','AttributionMatiereController@enseignant_matiere_niveau')->name('enseignant_matiere_niveau')->middleware('auth','licence.key','permission:Attribution de matière ou classe aux enseignants');
//Gestion d'emargement des enseignants
Route::resource('emargement','EmargementEnseignantController')->middleware(['auth','licence.key','permission:Gestion des emargements']);
//emargement par niveau
Route::get('/emargement/{id}/niveau','EmargementEnseignantController@emargement_par_niveau')->name('emargement_par_niveau')->middleware('auth','licence.key','permission:Gestion des emargements');
//Detail emargement
Route::get('/emargement/niveau/{id}','EmargementEnseignantController@detail_emargement')->name('detail_emargement')->middleware('auth','licence.key','permission:Gestion des emargements');
//Gestion de l'emplois de temps
Route::resource('emploi','EmploisDeTempsController')->middleware(['auth','licence.key']);
//Création de l'emplois par niveau ou classe
Route::get('emploi/niveau/{id}','EmploisDeTempsController@create')->name('create_emplois_by_niveau')->middleware('auth','licence.key');
//Gestion de la réinscriptions des élèves
Route::get('/reinscriptions/eleve','EleveController@reinscription')->name('eleve_reinscription')->middleware('auth','licence.key');
Route::get('/reinscription/eleve/par_niveau/{id}','EleveController@reinscription_par_niveau')->name('reinscription_par_niveau')->middleware('auth');
//Gestion de la réinscriptions d'un élève
Route::post('/reinscription/eleve/{id}','EleveController@reinscription_eleve')->name('reinscription_eleve')->middleware('auth','licence.key');
//Liste des élèves réinscrits
Route::get('/reinscriptions/eleve/liste','EleveController@listes_eleves_reinscrits')->name('listes_eleves_reinscrits')->middleware('auth','licence.key');
Route::get('/reinscriptions/eleve/par_niveau/{id}','EleveController@listes_eleves_reinscrits_par_niveau')->name('listes_eleves_reinscrits_par_niveau')->middleware('auth');
//Modification de la réinscription d'un élève
Route::put('/update/reinscripton/eleve/{id}','EleveController@update_reinscription_eleve')->name('update_reinscription_eleve')->middleware('auth','licence.key');
//Suppression de la réinscription d'un élève
Route::delete('/delete/reinscription/eleve/{id}','EleveController@delete_reinscription_eleve')->name('delete_reinscription_eleve')->middleware('auth','licence.key');
//Gestion de la réinscriptions d'un élève unique
Route::get('/reinscriptions/eleve/{id}','EleveController@reinscriptions_par_eleve')->name('reinscriptions_par_eleve')->middleware('auth','licence.key');
Route::post('/reinscriptions/eleve/{id}','EleveController@store_reinscriptions_par_eleve')->name('store_reinscriptions_par_eleve')->middleware('auth','licence.key');
//Gestion Des absences Des Eleve
Route::resource('absence','AbsenceEleveController')->middleware(['auth','licence.key']);
//Gestion Des absences par niveau avec choix de matière(permet de choisir la matiere  dans la quelle on veut saisir ou afficher l'absence)
Route::get('/absence/choix_matiere/niveau/{id}','AbsenceEleveController@absence_par_matiere')->name('absence_par_matiere')->middleware('auth','licence.key');
//Gestion des absences par niveau
Route::get('/absence/niveau/{id}','AbsenceEleveController@absence_par_niveau')->name('absence_par_niveau')->middleware('auth','licence.key');
//Gestion des détails des absences par niveau et matiere
Route::get('/absence/detail/niveau/{id}','AbsenceEleveController@detail_absence_eleve')->name('detail_absence_eleve')->middleware('auth','licence.key');
//Gestion de l'impression des absences des élèves
Route::get('/absence/print/niveau/{id}','AbsenceEleveController@print_absences_eleves')->name('print_absences_eleves')->middleware('auth','licence.key');
//Gestion de la configuration des moyennes
Route::resource('config_moyenne','ConfigMoyenneController')->middleware(['auth','licence.key']);
//Gestion du paiement des élèves
Route::resource('paiement_eleve','PaiementEleveController')->middleware(['auth','licence.key','permission:Paiement des frais scolaire']);
Route::get('default_situation_journaliere','PaiementEleveController@default_situation_journaliere')->name('default_situation_journaliere')->middleware('auth','licence.key','permission:Paiement des frais scolaire');
Route::post('show_situation_journaliere','PaiementEleveController@show_situation_journaliere')->name('show_situation_journaliere')->middleware('auth','licence.key','permission:Paiement des frais scolaire');
//Etat de paiement des élèves
Route::get('/etat_paiement_eleve','PaiementEleveController@etat_paiement_eleve')->name('etat_paiement_eleve')->middleware('auth','licence.key','permission:Paiement des frais scolaire');
//Elèves en rétard de paiement
Route::get('/retard_paiement_eleve','PaiementEleveController@retard_paiement_eleve')->name('retard_paiement_eleve')->middleware('auth','licence.key','permission:Paiement des frais scolaire');
//Elèves en règle de paiement
Route::get('/total_paiement_eleve','PaiementEleveController@total_paiement_eleve')->name('total_paiement_eleve')->middleware('auth','licence.key','permission:Paiement des frais scolaire');
//Etat de paiement des élèves par niveau ou classe
Route::post('/etat_paiement_eleve_par_classe','PaiementEleveController@etat_paiement_eleve_par_classe')->name('etat_paiement_eleve_par_classe')->middleware('auth','licence.key','permission:Paiement des frais scolaire');
//Paiement des élèves par classe
Route::get('paiement_eleve_par_classe/{id}','PaiementEleveController@paiement_eleve_par_classe')->name('paiement_eleve_par_classe')->middleware('auth','licence.key','permission:Paiement des frais scolaire');
//Gestion du paiement des enseignants
Route::resource('paiement_enseignant','PaiementEnseignantController')->middleware(['auth','licence.key','permission:Paiement des enseignants']);
Route::get('/paiement_enseignant_par_mois/{id}','PaiementEnseignantController@paiement_enseignant_par_mois')->name('paiement_des_enseignants_par_mois')->middleware(['auth','licence.key','permission:Paiement des enseignants']);
//Etat de paiement des enseignants
Route::get('/etat_paiement_enseignant','PaiementEnseignantController@etat_paiement_enseignant')->name('etat_paiement_enseignant')->middleware('auth','licence.key','permission:Paiement des enseignants');
//Enseignant en rétard de paiement
Route::get('/retard_paiement_enseignant','PaiementEnseignantController@retard_paiement_enseignant')->name('retard_paiement_enseignant')->middleware('auth','licence.key','permission:Paiement des enseignants');
//Enseignant en règle de paiement
Route::get('/tatal_paiment_enseignant','PaiementEnseignantController@total_paiement_enseignant')->name('total_paiement_enseignant')->middleware('auth','licence.key','permission:Paiement des enseignants');
Route::resource('toto','TotoController')->middleware(['auth','licence.key']);
Route::get('/bulletin','TotoController@bulletin')->name('bulletin_de_note')->middleware('auth','licence.key');
Route::get('/classement','TotoController@classement')->name('classement')->middleware('auth','licence.key');
Route::get('/carte','TotoController@carte')->name('carte')->middleware('auth','licence.key');
// classement des eleves par defaut(on selectionne une classe et un trimestre par defaut)
Route::get('/classements_eleves/par_defaut','ClassementEleveController@index')->name('classement_des_eleves')->middleware('auth','licence.key');
// classement des élèves par niveau ou classe et par trimestre
Route::get('/classements_eleves/par_niveau','ClassementEleveController@show')->name('classements_des_eleves_par_niveau')->middleware('auth','licence.key');
// Bulletin individuel de note par defaut(on selectionne une classe et un trimestre par defaut)
Route::get('/bulletins_des_eleves/par_defaut','BulletinEleveController@index')->name('bulletins_des_eleves_par_defaut')->middleware('auth','licence.key');
// Bulletin par eleve(impression du bulletin par eleve)
Route::get('/bulletin_par_eleve/eleve/{id}','BulletinEleveController@bulletin_par_eleve')->name('bulletin_par_eleve')->middleware('auth','licence.key');
// Bulletin des élèves par niveau ou classe et par trimestre
Route::get('/bulletin_des_eleves/par_niveau','BulletinEleveController@bulletin_par_niveau')->name('bulletin_par_niveau')->middleware('auth','licence.key');
//Route pour tester le webcam
Route::get('/webcam','WebcamController@index')->name('webcam');
//Système de crédit des enseignants
Route::resource('Credit','CreditEnseignantController')->middleware(['auth','licence.key','permission:Gestion des avances de salaire des enseignants']);
Route::get('/credit_enseignant_par_mois/{id}','CreditEnseignantController@credit_enseignant_par_mois')->name('credit_enseignant_par_mois')->middleware(['auth','licence.key','permission:Gestion des avances de salaire des enseignants']);
//Gestion du personnel(ajout,modification,liste,suppression)
Route::resource('Personnel', 'PersonnelController')->middleware(['auth','licence.key','permission:Gestion Du Personnel']);
//Gestion des crédits du personnels
Route::resource('creditpersonnel','CreditPersonnelController')->middleware(['auth','licence.key','permission:Gestion Du Personnel']);
//Gestion des paiements du personnels
Route::resource('paiement_personnel','PaiementPersonnelController')->middleware(['auth','licence.key','permission:Gestion Du Personnel']);
//si la licence de l'utilisateur expire on le rediriger vers cette page
Route::get('/licence','LicenceController@index')->name('licence');

//start gestion de la bibliothèque
Route::resource('auteur','AuteurController')->middleware(['auth','permission:Gestion De La Bibliothèque']);
Route::resource('category','CategoryController')->middleware(['auth','permission:Gestion De La Bibliothèque']);
Route::resource('livre','LivreController')->middleware(['auth','permission:Gestion De La Bibliothèque']);
Route::resource('emprunteur','EmprunteurController')->middleware(['auth','permission:Gestion De La Bibliothèque']);
Route::get('/emprunt_invalide','EmprunteurController@emprunt_invalide')->name('emprunt_invalide')->middleware(['auth','permission:Gestion De La Bibliothèque']);
//end gestion de la bibliothèque

//Route permettant de gérer les trimestres

Route::get('/config_trimestre','EmploisDeTempsController@config_trimestre')->name('config_trimestre')->middleware('auth');
Route::put('/config_trimestre/{id}','EmploisDeTempsController@update_config_trimestre')->name('update_config_trimestre')->middleware('auth');

//Route permettant de gérer l'attribution d'une classe à un enseignant

Route::resource('enseigne_niveau','EnseigneNiveauController')->middleware(['auth','permission:Attribution de matière ou classe aux enseignants']);

//Route permettant de gérer les depenses de l'école

Route::resource('depense','DepenseController')->middleware(['auth','permission:Gestion des dépenses']);

//Route permettant de gérer les frais d'inscription  de l'école

Route::resource('paiement_frais_inscription','PaiementFraisInscriptionController')->middleware(['auth','permission:paiement des inscriptions']);

//Route permettant de gérer les frais de réincription de l'école
Route::resource('paiement_frais_reinscription','PaiementFraisReinscriptionController')->middleware(['auth','permission:paiement des réinscriptions']);

//Route permettant de gérer les arriéres des élèves réinscrit
Route::resource('arrierer','ArriererController')->middleware(['auth','permission:gestion des arriérés']);

//Route permettant de gérer la comptabilité
Route::get('/comptabilite','ComptabiliteController@index')->name('comptabilite')->middleware('auth');

//Gestion des comptes d'utilisateurs
Route::get('/compte_user','CompteUserController@index')->name('compte_user')->middleware(['auth','role:Superviseur']);
Route::post('/compte_user','CompteUserController@store')->name('store.compte_user')->middleware(['auth','role:Superviseur']);
Route::delete('/delete/compte_user/{id}','CompteUserController@destroy')->name('delete_compte')->middleware(['auth','role:Superviseur']);
//Gestion des permissions
Route::resource('privilege','PrivilegeController')->middleware(['auth','role:Superviseur']);
//Gestion des remises
Route::resource('remise_paiement_eleve','RemisePaiementEleveController')->middleware('auth');

// Gestion des fiches de notes

Route::get('/fiche_modulaire','FicheDeNoteController@fiche_modulaire')->name('fiche_modulaire')->middleware('auth');
/**
 * Gestion des documents du personnel
 */

Route::resource('document_personnel','DocumentPersonnelController');

/**
 * Gestion de messagerie
 */

Route::post('/messagerie/{id}','MessagerieController@index')->name('messagerie');
Route::get('/messagerie/professionnel','MessagerieController@msg_professionnel')->name('msg_professionnel');
Route::post('/messagerie','MessagerieController@send_message')->name('send_message');

Route::get('/our_backup_database', 'MessagerieController@our_backup_database')->name('our_backup_database');


/**
 * Gestion des paiements de scolarité groupé
 */
Route::resource('paiement_groupe_eleve','PaiementGroupeEleveController');
Route::get('get_validation_scolarite','PaiementGroupeEleveController@get_validation_scolarite')->name('get_validation_scolarite');
Route::post('validation_scolarite','PaiementGroupeEleveController@validation_scolarite')->name('validation_scolarite');

Route::resource('paiement_inscription_groupe','PaiementInscriptionGroupeController');

/**
 * Gestion historique reçu scolarité
 */
Route::get('recu_scolarite','RecuScolariteController@gestion_recu')->name('gestion_recu');
Route::get('historique_recu_scolarite/num_recu/{id}','RecuScolariteController@historique_recu_scolarite')->name('historique_recu_scolarite');


});
