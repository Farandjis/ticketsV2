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

        if (isset($data['ID_TICKET'])) {
            $ID_TICKET = $data["ID_TICKET"][0];
            if (json_last_error() == JSON_ERROR_NONE) { // ???
                if (in_array(recupererRoleDe($connexionUtilisateur), array("Technicien"))) {
                    // (TECH / ADMIN SITE) : TRUE si le ticket peut être attribué à un technicien (ticket ouvert)
                    $attributionPossible = (boolean)mysqli_fetch_row(executeSQL("SELECT COUNT(ID_TICKET) FROM vue_associe_ticket_tech WHERE ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur))[0];

                    if ($attributionPossible and (recupererRoleDe($connexionUtilisateur) == "Technicien")) {
                        // Uniquement attribuable
                        //$infoBouton[0] = "S'attribuer ce ticket";

                        $ID_USER = mysqli_fetch_row(mysqli_query($connexionUtilisateur, "SELECT ID_USER FROM vue_Utilisateur_client;"))[0];
                        executeSQL("UPDATE vue_associe_ticket_tech SET ID_TECHNICIEN = ? WHERE ID_TICKET = ?", array($ID_USER, $ID_TICKET), $connexionUtilisateur);

                        header('Content-Type: application/json');
                        echo json_encode(array("Modifier ce ticket", $ID_TICKET));
                        return;
                    }


                }

            }
        }
        header('Content-Type: application/json');
        echo json_encode(array("Une erreur s'est produite", $ID_TICKET));
        return;
    }
}
catch(Exception $e){
    header('Content-Type: application/json');
    echo json_encode(array("Une erreur s'est produite", $ID_TICKET));
    return;
}