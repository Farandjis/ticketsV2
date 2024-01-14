<?php

/**
 * Principe :
 *      Répond à la demande de l'utilisateur.
 *      Il lui envoi des informations supplémentaires concernant le ticket demandé.
 *
 *      Les informations envoyées sont :
 *          - Administrateur WEB, Technicien uniquement et le créateur lui même : prénom + nom du créateur + Adresse email du créateur, prénom + nom + email de celui qui a modifi le ticket en dernier
 *          - Tout le monde : Date de la dernière modification du ticket, prénom + nom + email du technicien, mots-clés associés au ticket
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
                $cestLeCreateur = (bool) mysqli_fetch_row(executeSQL("SELECT COUNT(ID_TICKET) FROM vue_Ticket_client WHERE ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur))[0];

                $personneAyantModifierLeTicket = ""; // Par défaut, on affiche par d'information sur celui qui a modifié le ticket.
                if ($cestLeCreateur or recupererRoleDe($connexionUtilisateur) == "Technicien" or recupererRoleDe($connexionUtilisateur) == "Administrateur Site") {
                    // ===================== PRÉNOM ET NOM DE LA DERNIERE PERSONNE A MODIFIER LE TICKET (tech, adm w, créateur uniquement)
                    $dernierePersonneModifDuTicket = mysqli_fetch_row(executeSQL("SELECT PRENOM_MODIFIEUR, NOM_MODIFIEUR, EMAIL_MODIFIEUR FROM vue_tableau_bord WHERE ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur));
                    if ($dernierePersonneModifDuTicket[0] != NULL){
                        $personneAyantModifierLeTicket = " par $dernierePersonneModifDuTicket[0] $dernierePersonneModifDuTicket[1] ($dernierePersonneModifDuTicket[2])"; // Prénom et nom du technicien
                    }
                    else{
                        $personneAyantModifierLeTicket = " par Administrateur BASE DE DONNEES"; // Si c'est NULL, c'est alors le compte administrateur de la base de données
                    }
               }

                // ===================== DATE DE LA DERNIÈRE MODIFICATION DU TICKET (tout le monde)
                $dateDerniereModifTicket = mysqli_fetch_row(executeSQL("SELECT DATE_FORMAT(HORODATAGE_DERNIERE_MODIF_TICKET, 'le %d/%m/%Y à %Hh%i') FROM vue_tableau_bord WHERE ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur))[0];
                $dicoDesInfosSupplementaires["Dernière modification"] = $dateDerniereModifTicket . $personneAyantModifierLeTicket;



                if ($cestLeCreateur or recupererRoleDe($connexionUtilisateur) == "Technicien" or recupererRoleDe($connexionUtilisateur) == "Administrateur Site"){
                    // ===================== PRÉNOM ET NOM DU CREATEUR (tech, adm w, créateur uniquement)
                    $createurDuTicket = mysqli_fetch_row(executeSQL("SELECT PRENOM_CREA, NOM_CREA, EMAIL_CREA FROM vue_tableau_bord WHERE ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur));
                    $dicoDesInfosSupplementaires["Créateur"] = "$createurDuTicket[0] $createurDuTicket[1] ($createurDuTicket[2])"; // Prénom et nom du technicien

                }


                // ===================== PRÉNOM ET NOM DU TECHNICIEN ASSOCIÉ (tout le monde)
                $technicienDuTicket = mysqli_fetch_row(executeSQL("SELECT PRENOM_TECH, NOM_TECH, EMAIL_TECH FROM vue_tableau_bord WHERE ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur));
                if ($technicienDuTicket[0] != NULL) { // si un technicien est affecté au ticket
                    $dicoDesInfosSupplementaires["Technicien"] = "$technicienDuTicket[0] $technicienDuTicket[1] ($technicienDuTicket[2])"; // Prénom et nom du technicien
                }

                // ===================== LES MOTS-CLÉS DU TICKET (tout le monde)
                $tousLesMotsClesDuTicket = executeSQL("SELECT NOM_MOTCLE FROM vue_tdb_relation_ticket_motcle WHERE ID_TICKET = ?;", array($ID_TICKET), $connexionUtilisateur);
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
