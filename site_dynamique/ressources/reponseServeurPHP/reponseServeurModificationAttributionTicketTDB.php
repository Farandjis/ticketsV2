<?php

/**
 *
 */

require(dirname(__FILE__) . "/../../ressources/fonctions/PHPfunctions.php");
$connexionUtilisateur = pageAccess(array('Utilisateur', 'Technicien', 'Administrateur Site', 'Administrateur Système')); // Renvoi vers e403 si la personne n'a pas accès

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
                $ID_TICKET = $maListe[0];


                // (TOUT LE MONDE) TRUE si ticket en attente de l'utilisateur
                $modifPossibleUti = (boolean)mysqli_fetch_row(executeSQL("SELECT COUNT(ID_TICKET) FROM vue_modif_creation_ticket_utilisateur WHERE ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur))[0];

                $infoBouton = array(null, $ID_TICKET); // Envoi le texte du bouton (case 1) et l'ID TICKET correspondant (case 2)


                if (in_array(recupererRoleDe($connexionUtilisateur), array("Technicien", "Administrateur Site"))) {
                    // (TECHNICIEN) TRUE si c'est un ticket en cours de résolution attribué au technicien
                    // (ADMIN SITE) TRUE si le ticket n'est pas fermé
                    $modifPossibleAdmTech = (boolean)mysqli_fetch_row(executeSQL("SELECT COUNT(ID_TICKET) FROM vue_modif_ticket_adm_tech WHERE ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur))[0];

                    // (TECH / ADMIN SITE) : TRUE s'il est modifiable par le technicien ou l'administrateur faisant la demande
                    $modifPossibleAdmTech = ($modifPossibleUti or $modifPossibleAdmTech);

                    // (TECH / ADMIN SITE) : TRUE si le ticket peut être attribué à un technicien (ticket ouvert)
                    $attributionPossible = (boolean)mysqli_fetch_row(executeSQL("SELECT COUNT(ID_TICKET) FROM vue_associe_ticket_tech WHERE ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur))[0];

                    if ($modifPossibleAdmTech and $attributionPossible) {
                        // Possible de le modifier et de l'attribuer
                        $infoBouton[0] = "Attribuer ou modifier ce ticket";
                    } elseif ($modifPossibleAdmTech) {
                        // Uniquement modifiable
                        $etatDuTicket = (boolean)mysqli_fetch_row(executeSQL("SELECT COUNT(ID_TICKET) FROM vue_tableau_bord WHERE ETAT_TICKET = 'En attente' AND ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur))[0];
                        if ($etatDuTicket and recupererRoleDe($connexionUtilisateur) == "Administrateur Site") {
                            $infoBouton[0] = "Définir l'urgence de ce ticket";
                        } else {
                            $infoBouton[0] = "Modifier ce ticket";
                        }
                    } elseif ($attributionPossible) {
                        // Uniquement attribuable
                        if (recupererRoleDe($connexionUtilisateur) == "Technicien") {
                            $infoBouton[0] = "S'attribuer ce ticket";
                        } else {
                            $infoBouton[0] = "Attribuer ce ticket";
                        }
                    } else {
                        // La personne n'a pas le droit de touché au ticket
                        $infoBouton[0] = null;
                    }

                    // On envoie la réponse en format json à l'utilisateur (liste infoBouton au format [TXT_BOUTON, ID_TICKET])
                    header('Content-Type: application/json');
                    echo json_encode($infoBouton);
                    return;


                } else { // Si l'utilisateur n'est ni un technicien ni l'dministrateur web
                    if ($modifPossibleUti) {
                        // Uniquement modifiable
                        $infoBouton[0] = "Modifier mon ticket";
                    } else {
                        // La personne n'a pas le droit de touché au ticket
                        $infoBouton[0] = null;
                    }

                    // On envoie la réponse en format json à l'utilisateur (liste infoBouton au format [TXT_BOUTON, ID_TICKET])
                    header('Content-Type: application/json');
                    echo json_encode($infoBouton);
                    return;
                }
            }

        } else echo json_encode(array(null, -1)); // "Erreur dans le format JSON"
    }
}
catch(Exception $e){
    echo "aaa";
    //echo json_encode(array(null, -2)); // Erreur lors du traitement de la demande
    return;
}
?>