<?php
/**
 * Principe :
 *      Répond à la demande de l'utilisateur.
 *      Il lui envoi des informations supplémentaires concernant le ticket demandé pour la page Mon Espace.
 *

 */

require(dirname(__FILE__) . "/../../ressources/fonctions/PHPfunctions.php");
$connexionUtilisateur = pageAccess(array('Administrateur Site', 'Administrateur Système')); // Renvoi vers e403 si la personne n'a pas accès


session_start();

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
                $nomOuIpDuBanni = $maListe[0]; // On récupère le nom du banni ou l'ip banni
                $quiCest = $maListe[1]; // Si c'est une IP ou un compte


                if ($quiCest == "ip"){
                    $prison = $maListe[2]; // On récupère la prison

                    // On se reconnecte au compte adm tix sur le rpi, sinon on déconnecte l'administrateur du site par précaution
                    if ((isset($_SESSION['logadm'], $_SESSION['mdpadm'])) and $_SESSION['logadm'] == "administration_tix"){
                        $cmd = shell_exec("echo '".htmlspecialchars($_SESSION['mdpadm'])."' | su administration_tix -c 'echo \"Accès à la page Modération de TIX [COOKIE].\"'");
                        if ($cmd == null){ echo("marchepas1"); return;} // Si on a PAS réussit à se connecter, on déconnecte l'admin sys (car piratage)
                    } else { echo("marchepas2"); return;}


                    $logadm = "administration_tix";
                    $mdpadm = $_SESSION['mdpadm'];
                    // On change d'utilisateur Linux. On passe d'Apache à celui indiqué
                    $debutcmdADM = "echo '$mdpadm' | su $logadm -c 'echo \"$mdpadm\" | sudo -S "; // Ne pas oublier le ' à la fin de la commande.




                    $ip = $nomOuIpDuBanni; // Pour que ce soit plus compréhensible
                    // On vérifie la validité de l'IP. Si elle n'est pas valide :
                    if (! filter_var($ip, FILTER_VALIDATE_IP)){ echo json_encode(array("ddd")); return; }

                    $nomFichierPrison = "";
                    if ($prison == "TIX_connexionSite_PRISON") { $nomFichierPrison = "journauxActvCoInf.csv"; }
                    elseif ($prison == "TIX_inscriptFailSite_PRISON") { $nomFichierPrison = "journauxActvInsc.csv"; }
                    elseif ($prison == "TIX_inscriptOKSite_PRISON") { $nomFichierPrison = "journauxActvInsc.csv"; }

                    $infoDerniereTentative = shell_exec($debutcmdADM . " cat /var/www/logs/$nomFichierPrison| grep $ip | tail -n 1'");

                    if ($infoDerniereTentative === null){
                        header('Content-Type: application/json');
                        echo ("<p>Désoler, impossible de charger les informations depuis le journal d'activité. Vous l'avez peut-être banni manuellement ou le bannissement est ancien ?</p>");
                        return;
                    }

                    // Diviser la chaîne en utilisant la virgule comme délimiteur
                    $parts = explode(',', $infoDerniereTentative);

                    $infoHorodatage = str_replace('"', '', $parts[0]); // Récupérer la première partie
                    $info1 = $parts[1];
                    $infoIP = $parts[2];
                    $info2 = $parts[3];

                    if ($prison == "TIX_connexionSite_PRISON"){
                        header('Content-Type: application/json');
                        echo "<p style=\"color:white;\"><b><i>Dernière tentative</i></b><br><b>IP : </b>$infoIP<br><b>Banni le : </b>$infoHorodatage<br><b>Login tenté : </b>$info1<br><b>Mot de passe tenté : </b>$info2</p>";
                        return;
                    }
                    elseif ($prison == "TIX_inscriptFailSite_PRISON" or $prison == "TIX_inscriptOKSite_PRISON"){
                        header('Content-Type: application/json');

                        if ($info1 == 'echec') { $info1 = 'échec'; }
                        else { $info1 = 'succès'; }

                        if ($info2 == '0') { $info2 = 'succès'; }
                        else { $info2 = 'échec'; }
                        
                        echo "<p style=\"color:white;\"><b><i>Dernière tentative</i></b><br><b>IP : </b>$infoIP<br><b>Banni le : </b>$infoHorodatage<br><b>Tentative d'inscription : </b>$info1<br><b>Résolution du Captcha : </b>$info2</p>";
                        return;
                    }




                    header('Content-Type: application/json');
                    echo json_encode(array($maListe[0]));

                }
                elseif ($quiCest == "compte"){
                    $lesInfoUtilisateurs = explode(' ', $nomOuIpDuBanni); // Pour que ce soit plus compréhensible

                    if ($lesInfoUtilisateurs[0] == ""){
                        echo "<p style='color:#ffffff;'>Veuillez sélectionner un utilisateur.</p>";
                        return;
                    }

                    $idUserCompte = $lesInfoUtilisateurs[0];
                    $nomCompte = $lesInfoUtilisateurs[1];
                    $prenomCompte = $lesInfoUtilisateurs[2];

                    $dateDeban = mysqli_fetch_row(executeSQL("SELECT BANNI_JUSQUA FROM affiche_utilisateurs_pour_adm_web WHERE ID_USER = ?", array($idUserCompte), $connexionUtilisateur))[0];
                    $dateDeban = date("d/m/Y", strtotime($dateDeban));
                    echo "<p style=\"color:white;\"><b><i>Information sur le bannissement</i></b><br><b>Identifiant : </b>$idUserCompte<br><b>Prénom : </b>$prenomCompte<br><b>Nom : </b>$nomCompte<br><b>Banni jusqu'au : </b>$dateDeban compris</p>";
                    return;
                }


            }




        }
    }
}catch(Exception $e){
    header('Content-Type: application/json');
    $dicoDesInfosSupplementaires = array("Oups... " => "Impossible de charger des informations supplémentaires.");
    echo json_encode($dicoDesInfosSupplementaires);
    return;
}
