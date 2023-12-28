<?php

/**
 * Principe :
 *      Répond à la demande de l'utilisateur.
 *      Il lui envoi des informations supplémentaires concernant le ticket demandé.
 *
 *      Les informations envoyées sont :
 *          - Administrateur WEB et Technicien uniquement : prénom + nom du créateur, Adresse email du créateur
 *          - Tout le monde : Date de la dernière modification du ticket, prénom et nom du technicien, mots-clés associés au ticket
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
                $ID_TICKET = $maListe[0]; // On récupère l'identifiant du ticket (qui était contenu dans la liste)

                // Dictionnaire au format : clé -> le nom du texte (ex : Titre), valeur -> le contenu du texte (ex: Le 28/12/2023 à 18h16)
                $dicoDesInfosSupplementaires = array(); // Envoi le texte du bouton (case 1) et l'ID TICKET correspondant (case 2)

                // ===================== DATE DE CRÉATION DU TICKET (tout le monde)
                $dateDerniereModifTicket = mysqli_fetch_row(executeSQL("SELECT DATE_FORMAT(HORODATAGE_DERNIERE_MODIF_TICKET, 'le %d/%m/%Y à %Hh%i') FROM vue_tableau_bord WHERE ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur))[0];
                $dicoDesInfosSupplementaires["Dernière modification effectuée"] = $dateDerniereModifTicket;


                if (recupererRoleDe($connexionUtilisateur) == "Technicien" or recupererRoleDe($connexionUtilisateur) == "Administrateur Site"){
                    // ===================== ADRESSE EMAIL DU CREATEUR (tech et adm w uniquement)
                    $createurDuTicket = mysqli_fetch_row(executeSQL("SELECT EMAIL_CREA FROM vue_tableau_bord WHERE ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur));
                    $dicoDesInfosSupplementaires["Adresse email du créateur"] = "$createurDuTicket[0]"; // Prénom et nom du technicien


                    // ===================== PRÉNOM ET NOM DU CREATEUR (tech et adm w uniquement)
                    $createurDuTicket = mysqli_fetch_row(executeSQL("SELECT PRENOM_CREA, NOM_CREA FROM vue_tableau_bord WHERE ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur));
                    $dicoDesInfosSupplementaires["Créateur"] = "$createurDuTicket[0] $createurDuTicket[1]"; // Prénom et nom du technicien
                }


                // ===================== PRÉNOM ET NOM DU TECHNICIEN ASSOCIÉ (tout le monde)
                $technicienDuTicket = mysqli_fetch_row(executeSQL("SELECT PRENOM_TECH, NOM_TECH FROM vue_tableau_bord WHERE ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur));
                if ($technicienDuTicket[0] != null) { // si un technicien est affecté au ticket
                    $dicoDesInfosSupplementaires["Technicien affecté"] = "$technicienDuTicket[0] $technicienDuTicket[1]"; // Prénom et nom du technicien
                }

                header('Content-Type: application/json');
                echo json_encode($dicoDesInfosSupplementaires);
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
