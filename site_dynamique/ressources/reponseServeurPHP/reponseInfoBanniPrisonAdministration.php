<?php
/**
 * Principe :
 *      Répond à la demande de l'utilisateur.
 *      Il lui envoi des informations supplémentaires concernant le ticket demandé pour la page Mon Espace.
 *

 */

require(dirname(__FILE__) . "/../../ressources/fonctions/PHPfunctions.php");
$connexionUtilisateur = pageAccess(array('Administrateur Système')); // Renvoi vers e403 si la personne n'a pas accès


session_start();

if ((isset($_SESSION['logadm'], $_SESSION['mdpadm'])) and $_SESSION['logadm'] == "administration_tix"){
    $cmd = shell_exec("echo '".htmlspecialchars($_SESSION['mdpadm'])."' | su administration_tix -c 'echo \"Accès à la page Modération de TIX [COOKIE].\"'");
    if ($cmd == null){ header('Location: ../authentification/action_deconnexion.php'); return;} // Si on a PAS réussit à se connecter, on déconnecte l'admin sys (car piratage)
} else { header('Location: ../authentification/action_deconnexion.php'); return;}


$logadm = "administration_tix";
$mdpadm = $_SESSION['mdpadm'];
// On change d'utilisateur Linux. On passe d'Apache à celui indiqué
$debutcmdADM = "echo '$mdpadm' | su $logadm -c 'echo \"$mdpadm\" | sudo -S "; // Ne pas oublier le ' à la fin de la commande.



$recup = file_get_contents("php://input"); // On récupère le fichier reçus (ici notre liste)
$headers = getallheaders();

if (! array_key_exists("Content-Type", $headers)){ // Cas où on accède à la page sans passer par le formulaire (donc "Content-Type" n'existe pas)
    header("Location: ../../erreurs/403.html");
    return;
}



try {
    if ($headers["Content-Type"] == "application/json") { // Si le fichier reçu est bien de type JSON (?)
        $_POST = ["ok"]; // ???
        $data = json_decode($recup, true);

        if (json_last_error() == JSON_ERROR_NONE) { // ???
            if (isset($data['maListe'])) {
                $maListe = $data['maListe']; // On récupère notre liste (créer en JavaScript, utilisable en PHP)
                $prison = $maListe[0]; // On récupère le nom de la prison
                // $typeFormulaire = $maListe[1]; // Le nom du formulaire dont on reçois la demande

                $dicoDesInfosSupplementaires = array($prison);

                $output = shell_exec($debutcmdADM . 'fail2ban-client status | grep "Jail list" | sed -E "s/^[^:]+:[ \t]+//" | sed "s/,//g" | grep -o "[^ ]*"\'');
                $prisons = explode("\n", trim($output));

                // On s'assure que la prison existe bien et peut être manipuler
                if (in_array($prison, $prisons)) {

                    // On récupère les informations sur tous les bannis de la prison
                    // $cmd = shell_exec($debutcmdADM . "fail2ban-client status $prison | grep -E \"IP_ADDRESS|Banned Since|Failures\"'");
                    $cmd = shell_exec($debutcmdADM . "fail2ban-client status $prison | grep -E \"Banned IP list\"  | sed \"s/.*: *//\" | sed \"s/^[ \\t]*//\"'");
                    // On réorganise les données en tableau
                    $lesBannis = explode(" ", trim($cmd));

                    header('Content-Type: application/json');
                    echo json_encode($lesBannis);
                    return;
                }
                header('Content-Type: application/json');
                echo json_encode(array($maListe[0]));
                return;
            }
        }
    }
}catch(Exception $e){
    header('Content-Type: application/json');
    $dicoDesInfosSupplementaires = array("Oups... " => "Impossible de charger des informations supplémentaires.");
    echo json_encode($dicoDesInfosSupplementaires);
    return;
}
