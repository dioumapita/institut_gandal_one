<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mediumart\Orange\SMS\SMS;
use Mediumart\Orange\SMS\Http\SMSClient;
use App\mes_models\Annee;
use App\mes_models\Inscrit;
use App\Traits\InfosUserThemeActive;
use App\mes_models\PaiementEleve;
use App\mes_models\Personnel;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\URL;

class MessagerieController extends Controller
{
    //
    use InfosUserThemeActive;

    public function index(Request $request,$id)
    {

        // dd($request->all());

        //  dd('bonjour'."<br/>".'le monde ');

        $all_inscrits = Inscrit::where('niveau_id',$request->niveau)->get();
        // dd($all_inscrits);
        $client = SMSClient::getInstance('T69uOGbBMyfhDepsG4PFLL4AIC6KVPyE', '2usPK3yisG7lktTm');

        $sms = new SMS($client);

        foreach($all_inscrits as $inscrit)
        {
            // dd("bonjour");
            if(
                (($inscrit->niveau->mensualite * 3) + $inscrit->niveau->mensualite)
                >
                ($inscrit->eleve->paiementEleves->sum('somme_payer') + $inscrit->eleve->remisePaiementEleves->sum('montant_reduit'))
                )
            {
                $tel = $inscrit->eleve->telephone_parent;
                $sms->message('Chers parents'."\n".'la comptailité de l\'ecole Elhadj Moussa Balde a le grand plaisir de vous rappeler par ce présent message le paiement des frais scolaires de vos enfants d\'ici le 05 du mois.'."\n".'En espérent une suite favorable à notre demande, veuillez recevoir nos salutations les plus distinguées.')
                        ->from('+224623897708')
                        ->to('+224'.$tel)
                        ->send();
            }
            if($inscrit->niveau->tranche1 > ($inscrit->eleve->paiementEleves->sum('somme_payer') + $inscrit->eleve->remisePaiementEleves->sum('montant_reduit')))
            {
                $tel = $inscrit->eleve->telephone_parent;
                $sms->message('Chers parents'."\n".'la comptailité de l\'ecole Elhadj Moussa Balde à le grand plaisir de vous rappeler par ce présent message le paiement des frais scolaires de vos enfants d\'ici le 05 du mois.'."\n".'En espérent une suite favorable à notre demande, veuillez recevoir nos salutations les plus distinguer')
                        ->from('+224623897708')
                        ->to('+224'.$tel)
                        ->send();
            }
            else
            {

            }
        }

        $nums = ['623897708','626913299','621698987'];

        foreach($nums as $num)
        {
            $sms->message('Chers parents'."\n".'la comptailité de l\'ecole Elhadj Moussa Balde a le grand plaisir de vous rappeler par ce présent message le paiement des frais scolaires de vos enfants d\'ici le 05 du mois.'."\n".'En espérent une suite favorable à notre demande, veuillez recevoir nos salutations les plus distinguées')
                        ->from('+224623897708')
                        ->to('+224'.$num)
                        ->send();
        }

        dd("messsage envoye");
        // return  route(url()->previous());

        // return view('pages.messagerie.index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee'));
    }

    public function msg_professionnel()
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

        return view('pages.messagerie.index',compact('chemin_theme_actif','nom','avatar','annee_courante','all_annee'));

    }

    public function send_message(Request $request)
    {


        $client = SMSClient::getInstance('T69uOGbBMyfhDepsG4PFLL4AIC6KVPyE', '2usPK3yisG7lktTm');


        $sms = new SMS($client);
        // $response = $sms->balance('GIN');
        $message = $request->message;

        $all_enseignants = Role::where('name','Enseignant')->first()->users;

        foreach($all_enseignants as $enseignant)
        {
            if($enseignant->telephone != null)
            {
                $sms->message($message)
                    ->from('+224623897708')
                    ->to('+224'.$enseignant->telephone)
                    ->send();
            }
        }

        $all_personnels = Personnel::all();

        foreach($all_personnels as $personnel)
        {
            if($personnel->telephone != null)
            {
                $sms->message($message)
                ->from('+224623897708')
                ->to('+224'.$personnel->telephone)
                ->send();
            }
        }

        $nums = ['623897708','626913299','621698987'];

        foreach($nums as $num)
        {
            $sms->message($message)
                        ->from('+224623897708')
                        ->to('+224'.$num)
                        ->send();
        }

        return back();
    }


public function our_backup_database(){

    //ENTER THE RELEVANT INFO BELOW
    $mysqlHostName      = env('DB_HOST');
    $mysqlUserName      = env('DB_USERNAME');
    $mysqlPassword      = env('DB_PASSWORD');
    $DbName             = env('DB_DATABASE');
    $backup_name        = "mybackup.sql";
    $tables             = array("users","messages","posts"); //here your tables...

    $connect = new \PDO("mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword",array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    $get_all_table_query = "SHOW TABLES";
    $statement = $connect->prepare($get_all_table_query);
    $statement->execute();
    $result = $statement->fetchAll();


    $output = '';
    foreach($tables as $table)
    {
     $show_table_query = "SHOW CREATE TABLE " . $table . "";
     $statement = $connect->prepare($show_table_query);
     $statement->execute();
     $show_table_result = $statement->fetchAll();

     foreach($show_table_result as $show_table_row)
     {
      $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
     }
     $select_query = "SELECT * FROM " . $table . "";
     $statement = $connect->prepare($select_query);
     $statement->execute();
     $total_row = $statement->rowCount();

     for($count=0; $count<$total_row; $count++)
     {
      $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
      $table_column_array = array_keys($single_result);
      $table_value_array = array_values($single_result);
      $output .= "\nINSERT INTO $table (";
      $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
      $output .= "'" . implode("','", $table_value_array) . "');\n";
     }
    }
    $file_name = 'database_backup_on_' . date('y-m-d') . '.sql';
    $file_handle = fopen($file_name, 'w+');
    fwrite($file_handle, $output);
    fclose($file_handle);
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file_name));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
       header('Pragma: public');
       header('Content-Length: ' . filesize($file_name));
       ob_clean();
       flush();
       readfile($file_name);
       unlink($file_name);


}
}
