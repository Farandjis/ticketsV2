<?php
//Récupération des fonctions

require '../ressources/fonctions/PHPfunctions.php';

//Vérification des droits d'accès

$connexionUtilisateur = pageAccess(array('Utilisateur', 'Technicien', 'Administrateur Site', 'Administrateur Système'));

//Démarrage de la session

session_start();

try {
    //Vérification de l'existence des paramètres

    if (isset($_POST['nature'], $_POST['nivUrg'], $_POST["motcle_option"], $_POST["explication"])) {

        //Vérification que les paramètres ne sont pas vides
        if (!empty($_SESSION['login']) && !empty($_SESSION['mdp']) && !empty($_POST['nature']) &&
            !empty($_POST['nivUrg']) && !empty($_POST["motcle_option"]) && !empty($_POST["explication"])) {

            //Récupération des données
            global $host, $database, $USER_FICTIF_MDP;

            $nature = $_POST['nature'];
            $niveauUrgence = $_POST['nivUrg'];
            $explication = $_POST['explication'];

            //Requête permettant d'insérer un nouveau ticket
            $requete = 'INSERT INTO vue_modif_creation_ticket_utilisateur(TITRE_TICKET,DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET) VALUES (?, ?, ?);';
            $result = executeSQL($requete, array($nature, $explication, $niveauUrgence), $connexionUtilisateur);

            //Récupération de l'ID du ticket
            $idTicket = mysqli_insert_id($connexionUtilisateur);

            //Insérer les mots-clés associés au ticket
            foreach ($_POST["motcle_option"] as $unMotcleTicket) {
                $requeteMotcleTicket = 'INSERT INTO RelationTicketsMotscles (ID_TICKET, NOM_MOTCLE) VALUES (?, ?)';
                executeSQL($requeteMotcleTicket, array($idTicket, $unMotcleTicket), $connexionUtilisateur);
            }
            header('Location: tableaudebord.php');
        } else {
            header('Location: creerTicket.php?id=2'); //Données essentielles ne sont pas fournies ou incohérentes
        }
    } else {
        header('Location: creerTicket.php?id=1'); // Données manquantes
    }
} catch (Exception $ex) {
    header('Location: creerTicket.php?id=3'); // Erreur générale
}
?>