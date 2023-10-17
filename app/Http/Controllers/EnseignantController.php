<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\InfosUserThemeActive;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\mes_models\Annee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use MercurySeries\Flashy\Flashy;
use Spatie\Permission\Models\Role;
class EnseignantController extends Controller
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

        $all_enseignants = Role::where('name','Enseignant')->first()->users;
        // dd($all_enseignants);

        return view('pages.enseignants.index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','all_enseignants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

        return view('pages.enseignants/create',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if(user::where('telephone',$request->telephone)->exists())
        // {

        //     alert('Attention','Ce numéro de téléphone est déjà utiliser par un enseignant','success')->addImage('/assets/asset_principal/img_sweat_alert/alert4.jpg')->autoclose(false);
        //     return back();
        // }

        //validation du formulaire enseignant
        $request->validate([
            'nom' => 'required|string|min:2|max:15',
            'prenom' => 'required|string|min:4|max:25',
            'civilite' => 'string|max:12',
            'quartier' => 'required|string|max:15'
        ]);
        /**on verifit si l'utilisateur à selectionner selectionner l'image et la prise
         * via le webcam si c'est le cas on prend l'image du webcam
         */
        if($request->webcame != null And $request->photo_upload != null)
        {
            //on recupère l'image prise via le webcam
            $img = $request->webcame;
            //on precise le chemin du stockage de l'image
                $folderPath = "images/photos/enseignants/";
            //on fait des traitement avec explode
                $image_parts = explode(";base64,", $img);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
            //on decode l'image
                $image_base64 = base64_decode($image_parts[1]);
            //on donne un nom unique a l'image avec la function time()
                $fileName = time() . '.jpg';
            //on concatene le nom du dossier au nom du fichier
                $file = $folderPath . $fileName;
            //on utilise la fonction file_put_contents pour deplace l'image vers la destination
                file_put_contents($file, $image_base64);
        }
        //traitement de l'image prise via le webcam
        if($request->webcame != null)
            {
                //on recupère l'image prise via le webcam
                    $img = $request->webcame;
                //on precise le chemin du stockage de l'image
                    $folderPath = "images/photos/enseignants/";
                //on fait des traitement avec explode
                    $image_parts = explode(";base64,", $img);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
                //on decode l'image
                    $image_base64 = base64_decode($image_parts[1]);
                //on donne un nom unique a l'image avec la function time()
                    $fileName = time() . '.jpg';
                //on concatene le nom du dossier au nom du fichier
                    $file = $folderPath . $fileName;
                //on utilise la fonction file_put_contents pour deplace l'image vers la destination
                    file_put_contents($file, $image_base64);
            }
        //traitement de l'image uploader
        else if($request->photo_upload != null){
            $request->validate([
                'photo_upload' => 'image|mimes:png,jpg,jpeg|max:1024'
            ]);
            //on récupère l'extension de l'image(png,jpg,jpeg,...)
                $extension = $request->file('photo_upload')->extension();
            //on donne un nom à l'image en utilisant la fonction time()
                $fileName = time().'.'.$extension;
            //on deplace l'image vers le dossier eleves
                $request->file('photo_upload')->storeAs('enseignants',$fileName);
        }
        else{
            $fileName = "default.png";
        }
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
        $email = 'harounaya'.$valeur2.'@gmail.com';
        // dd($matricule);
        // inscription d'un enseignant
        $enseignant = User::create([
            'nom' => Str::title($request->nom),
            'prenom' => Str::title($request->prenom),
            'civilite' => $request->civilite,
            'email' => $email,
            'telephone' => $request->telephone,
            'adresse' => Str::title($request->quartier),
            'avatar' => $fileName,
            'diplome_obtenu' => $request->diplome_obtenu,
            'username' => 'EN'.$caractere_nom.$caractere_prenom.$valeur,
            'password' => Hash::make('sjckaloum224'),
            'document' => Str::title($request->nom).' '.Str::title($request->prenom).'.pdf'
        ]);

        /**
         * on attribut à utilisateur le rôle enseignant
         */
        $enseignant->assignRole('Enseignant');
        //message flash
        Flashy::success('L\'enseignant a été inscrit avec succès');

        return redirect()->route('enseignant.index');
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

        $infos_enseignant = User::where('id',$id)->first();
        $i = 1;
        $b = 1;
       return view('pages.enseignants.show',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','infos_enseignant','i','b'));
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

        $infos_enseignant = User::where('id',$id)->first();

        return view('pages.enseignants.edit',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee','infos_enseignant'));
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

        //les règles de validation
        // $request->validate([
        //     'nom' => 'required|string|min:2|max:15',
        //     'prenom' => 'required|string|min:4|max:25',
        //     'telephone' => 'required|unique:users,telephone,'.$id,
        //     'quartier' => 'required|string|max:15'
        // ]);

        /**on verifit si l'utilisateur à selectionner selectionner l'image et la prise
         * via le webcam si c'est le cas on prend l'image du webcam
         */
        if($request->webcame != null And $request->photo_upload != null)
        {
            //on recupère l'image prise via le webcam
            $img = $request->webcame;
            //on precise le chemin du stockage de l'image
                $folderPath = "images/photos/enseignants/";
            //on fait des traitement avec explode
                $image_parts = explode(";base64,", $img);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
            //on decode l'image
                $image_base64 = base64_decode($image_parts[1]);
            //on donne un nom unique a l'image avec la function time()
                $fileName = time() . '.jpg';
            //on concatene le nom du dossier au nom du fichier
                $file = $folderPath . $fileName;
            //on utilise la fonction file_put_contents pour deplace l'image vers la destination
                file_put_contents($file, $image_base64);
        }
        //traitement de l'image prise via le webcam
        if($request->webcame != null)
            {
                //on recupère l'image prise via le webcam
                    $img = $request->webcame;
                //on precise le chemin du stockage de l'image
                    $folderPath = "images/photos/enseignants/";
                //on fait des traitement avec explode
                    $image_parts = explode(";base64,", $img);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
                //on decode l'image
                    $image_base64 = base64_decode($image_parts[1]);
                //on donne un nom unique a l'image avec la function time()
                    $fileName = time() . '.jpg';
                //on concatene le nom du dossier au nom du fichier
                    $file = $folderPath . $fileName;
                //on utilise la fonction file_put_contents pour deplace l'image vers la destination
                    file_put_contents($file, $image_base64);
                //on passe à la modification de l'image
                $update_image = User::where('id',$id)->update(['avatar' => $fileName]);
            }
        //traitement de l'image uploader
        else if($request->photo_upload != null){
            $request->validate([
                'photo_upload' => 'image|mimes:png,jpg,jpeg|max:1024'
            ]);
            //on récupère l'extension de l'image(png,jpg,jpeg,...)
                $extension = $request->file('photo_upload')->extension();
            //on donne un nom à l'image en utilisant la fonction time()
                $fileName = time().'.'.$extension;
            //on deplace l'image vers le dossier eleves
                $request->file('photo_upload')->storeAs('enseignants',$fileName);

            //on passe à la modification de l'image
            $update_image = User::where('id',$id)->update(['avatar' => $fileName]);
        }
        else{

        }

        $modification_enseignant = User::where('id',$id)
                                        ->update([
                                                    'nom' => Str::title($request->nom),
                                                    'prenom' => Str::title($request->prenom),
                                                    'civilite' => $request->civilite,
                                                    'telephone' => $request->telephone,
                                                    'adresse' => Str::title($request->quartier),
                                                    'diplome_obtenu' => $request->diplome_obtenu
                                                ]);
        //message flash
        Flashy::success('Les informations ont été modifier avec succès');
        //redirection
        return redirect()->route('enseignant.show',$id);
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
        $suppression_enseignant = User::where('id',$id)->delete();

         //message flash
         Flashy::success('L\'enseignant à été supprimer avec succès');
         //redirection
         return back();
    }
}
