<?php

/**
 * Principe :
 *      Répond à la demande de l'utilisateur.
 *      Il lui envoi des informations supplémentaires concernant le ticket demandé pour la page Mon Espace.
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
                $ID_TICKET = $maListe[0]; // On récupère l'identifiant du ticket (qui était contenu dans la liste)

                // Dictionnaire au format : clé -> le nom du texte (ex : Titre), valeur -> le contenu du texte (ex: Le 28/12/2023 à 18h16)
                $dicoDesInfosSupplementaires = array(); // Envoi le texte du bouton (case 1) et l'ID TICKET correspondant (case 2)

                // On regarde si c'est le créateur du ticket (et donc que le ticket fait parti de sa liste de ticket)
                // Si 0, alors non -> FALSE
                // Si 1, alors oui -> TRUE
                // rappel ID_TICKET est une clé primaire, donc elle est forcément unique

                // ===================== DATE DE LA DERNIÈRE MODIFICATION DU TICKET
                $nivUEstimer = mysqli_fetch_row(executeSQL("SELECT NIV_URGENCE_ESTIMER_TICKET FROM vue_Ticket_client WHERE ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur))[0];
                $dicoDesInfosSupplementaires["Niv. Urgence estimé"] = $nivUEstimer ;


                // ===================== PRÉNOM ET NOM DE LA DERNIERE PERSONNE A MODIFIER LE TICKET
                $dernierePersonneModifDuTicket = mysqli_fetch_row(executeSQL("SELECT PRENOM_MODIFIEUR, NOM_MODIFIEUR, EMAIL_MODIFIEUR FROM vue_Ticket_client WHERE ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur));
                if ($dernierePersonneModifDuTicket[0] != NULL){
                    $personneAyantModifierLeTicket = " par $dernierePersonneModifDuTicket[0] $dernierePersonneModifDuTicket[1] ($dernierePersonneModifDuTicket[2])"; // Prénom et nom du technicien
                }
                else{
                    $personneAyantModifierLeTicket = " par Administrateur BASE DE DONNEES"; // Si c'est NULL, c'est alors le compte administrateur de la base de données
                }
                // ===================== DATE DE LA DERNIÈRE MODIFICATION DU TICKET
                $dateDerniereModifTicket = mysqli_fetch_row(executeSQL("SELECT DATE_FORMAT(HORODATAGE_DERNIERE_MODIF_TICKET, 'le %d/%m/%Y à %Hh%i') FROM vue_Ticket_client WHERE ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur))[0];
                $dicoDesInfosSupplementaires["Dernière modification"] = $dateDerniereModifTicket . $personneAyantModifierLeTicket;

                // ===================== DATE DEBUT TRAITEMENT DU TICKET
                $dateTraitementTicket = mysqli_fetch_row(executeSQL("SELECT DATE_FORMAT(HORODATAGE_DEBUT_TRAITEMENT_TICKET, 'le %d/%m/%Y à %Hh%i') FROM vue_Ticket_client WHERE ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur))[0];
                if ($dateTraitementTicket != NULL){ $dicoDesInfosSupplementaires["Début de traitement"] = $dateTraitementTicket; }


                // ===================== DATE DE LA RÉSOLUTION DU TICKET
                $dateResolutionTicket = mysqli_fetch_row(executeSQL("SELECT DATE_FORMAT(HORODATAGE_RESOLUTION_TICKET, 'le %d/%m/%Y à %Hh%i') FROM vue_Ticket_client WHERE ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur))[0];
                if ($dateResolutionTicket != NULL){ $dicoDesInfosSupplementaires["Fin de traitement"] = $dateResolutionTicket; }

                // ===================== PRÉNOM ET NOM DU TECHNICIEN ASSOCIÉ
                $technicienDuTicket = mysqli_fetch_row(executeSQL("SELECT PRENOM_TECH, NOM_TECH, EMAIL_TECH FROM vue_Ticket_client WHERE ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur));
                if ($technicienDuTicket[0] != NULL) { // si un technicien est affecté au ticket
                    $dicoDesInfosSupplementaires["Technicien"] = "$technicienDuTicket[0] $technicienDuTicket[1] ($technicienDuTicket[2])"; // Prénom et nom du technicien
                }

                // ===================== LES MOTS-CLÉS DU TICKET (tout le monde)
                $tousLesMotsClesDuTicket = executeSQL("SELECT NOM_MOTCLE FROM vue_tv_relation_ticket_motcle WHERE ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur);
                if ( mysqli_num_rows($tousLesMotsClesDuTicket) != 0) {
                    $ensembleDesMotsCles = "";
                    while ($unMotCle = mysqli_fetch_row($tousLesMotsClesDuTicket)) {
                        if ($ensembleDesMotsCles != "") {
                            $ensembleDesMotsCles = $ensembleDesMotsCles . ", ";
                        }
                        $ensembleDesMotsCles = $ensembleDesMotsCles . $unMotCle[0];
                    }

                    if (strlen($ensembleDesMotsCles) > 300) { // Cas où les mots-clés risquent de prendre beaucoup trop de place pour la pop-up
                        $ensembleDesMotsCles = substr($ensembleDesMotsCles, 0, 300) . "...";
                    }

                    $dicoDesInfosSupplementaires["Mots-clés associés"] = $ensembleDesMotsCles;
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
