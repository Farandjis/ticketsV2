<?php


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

                /*
                email
                date création modif
                créateur
                technicien

                 */

                header('Content-Type: application/json');
                $infoBouton = array("chocolat" => "zip", "chaud" => "zap", "woaaaw" => "la deux m'épate !", "laZ" => $ID_TICKET); // Envoi le texte du bouton (case 1) et l'ID TICKET correspondant (case 2)
                echo json_encode($infoBouton);
                return;

            }
        }
    }
}catch(Exception $e){
    echo "bbb";
    //echo json_encode(array(null, -2)); // Erreur lors du traitement de la demande
    return;
}
