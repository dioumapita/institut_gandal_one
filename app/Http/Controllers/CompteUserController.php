<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\InfosUserThemeActive;
use App\mes_models\Annee;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class CompteUserController extends Controller
{
    use InfosUserThemeActive;
    //

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

        $all_roles = Role::where('name','!=','Enseignant')->where('name','!=','Superviseur')->get();


        return view('pages.compte_user/index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
                              'nom' => 'required|max:15',
                              'prenom' => 'required|max:25'
                          ]);

        /**
         * on récupère l'id de la dernière personne inscrit pour le concatener
         * au nom de l'utilisateur pour générer son username
         */
        $id_last_user = DB::table('users')->latest('id')->first()->id;
        /**
         * pour créer le username on récupère un caractère du nom,du prenom
         * et on fait une concatenation à la valeur ci-desous
         */
        $caractere_nom = Str::substr($request->nom,0,1);
        $caractere_prenom = Str::substr($request->prenom,0,1);
        // dd($id_role_enseignant);
        $valeur = 1111+$id_last_user;
        $valeur2 = 11+$id_last_user;
        $email = 'fugguinnee'.$valeur2.'@gmail.com';

        $new_compte = User::create([
                                        'nom' => Str::title($request->nom),
                                        'prenom' => Str::title($request->prenom),
                                        'email' => $email,
                                        'username' => 'UT'.$caractere_nom.$caractere_prenom.$valeur,
                                        'password' => Hash::make('emblabe224')
                                   ]);
        /**
         * on l'assigne un role utilisateur
         */
        $new_compte->assignRole('Utilisateur');

        return back();
    }

    public function destroy($id)
    {

         $delete_user = User::where('id',$id)->delete();

         return back();
    }
}
