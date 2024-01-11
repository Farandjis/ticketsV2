<?php
// Inclusion des fonctions
require '../ressources/fonctions/PHPfunctions.php';

// Vérification des droits d'accès
$connexionUtilisateur = pageAccess(array('Utilisateur', 'Technicien', 'Administrateur Site', 'Administrateur Système'));

if (isset($_SESSION["titre"], $_SESSION["nivUrg"], $_SESSION["explication"])) {
    session_destroy();
}
// Démarrage de la session
session_start();

try {
    // Vérification de l'existence des paramètres
    if (isset($_POST['titre'], $_POST['nivUrg'], $_POST['explication'])) {

        // Vérification que les paramètres ne sont pas vides
        if (!empty($_SESSION['login']) && !empty($_SESSION['mdp']) && !empty($_POST['titre']) &&
            !empty($_POST['nivUrg']) && !empty($_POST['explication']) && !empty($_POST['motcle_option'])) {

            // Récupération des données
            global $host, $database, $USER_FICTIF_MDP;

            $titre = $_POST['titre'];
            $niveauUrgence = $_POST['nivUrg'];
            $explication = $_POST['explication'];

            $niveauUrgenceAutorise = ['Faible', 'Moyen', 'Important', 'Urgent'];

            if (in_array($niveauUrgence, $niveauUrgenceAutorise)) {
                // Vérification si le titre existe
                $requeteVerifTitre = 'SELECT titre_ticket FROM TitreTicket WHERE titre_ticket = ?';
                $resultVerifTitre = executeSQL($requeteVerifTitre, array($titre), $connexionUtilisateur);
                $existingTitre = mysqli_fetch_assoc($resultVerifTitre);

                // Si le titre existe
                if ($existingTitre) {
                    // Requête permettant d'insérer un nouveau ticket
                    $requete = 'INSERT INTO vue_modif_creation_ticket_utilisateur(TITRE_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET) VALUES (?, ?, ?);';
                    $result = executeSQL($requete, array($titre, $explication, $niveauUrgence), $connexionUtilisateur);

                    // Récupération de l'ID du ticket
                    $idTicket = mysqli_insert_id($connexionUtilisateur);


                    $idres = $connexionUtilisateur->query('SELECT id_user FROM vue_Utilisateur_client;');
                    $id_user = mysqli_fetch_array($idres, MYSQLI_ASSOC)["ID_USER"];
                    echo $id_user;

                    // Ajout du journal d'activité
		            date_default_timezone_set('Europe/Paris');
                    appendToCSV("../administration/logs/journauxActvCreTck.csv",array(date("d/m/y H:i:s"),$id_user." ".$_SESSION['login'],getIp(),$idTicket));

                    foreach ($_POST['motcle_option'] as $unMotcleTicket) {
                        $requeteMotcleTicket = 'INSERT INTO RelationTicketsMotscles (ID_TICKET, NOM_MOTCLE) VALUES (?, ?)';
                       	executeSQL($requeteMotcleTicket, array($idTicket, $unMotcleTicket), $connexionUtilisateur);
                    }

                    // Redirection vers la page principale après la création du ticket
                    header('Location: tableaudebord.php');

                } else {
                    $_SESSION["titre"] = $_POST['titre'];
                    $_SESSION["nivUrg"] = $_POST['nivUrg'];
                    $_SESSION["explication"] = $_POST['explication'];
                    header('Location: creerTicket.php?id=3'); // Le titre n'existe pas
                }
            } else {
                $_SESSION["titre"] = $_POST['titre'];
                $_SESSION["nivUrg"] = $_POST['nivUrg'];
                $_SESSION["explication"] = $_POST['explication'];
                header('Location: creerTicket.php?id=4'); // Niveau d'urgence est incorrect
            }

        } else {
            $_SESSION["titre"] = $_POST['titre'];
            $_SESSION["nivUrg"] = $_POST['nivUrg'];
            $_SESSION["explication"] = $_POST['explication'];
            header('Location: creerTicket.php?id=2'); // Données essentielles ne sont pas fournies ou incohérentes
        }
    } else {
        $_SESSION["titre"] = $_POST['titre'];
        $_SESSION["nivUrg"] = $_POST['nivUrg'];
        $_SESSION["explication"] = $_POST['explication'];
        header('Location: creerTicket.php?id=1'); // Données manquantes
    }
} catch (Exception $ex) {
    $_SESSION["titre"] = $_POST['titre'];
    $_SESSION["nivUrg"] = $_POST['nivUrg'];
    $_SESSION["explication"] = $_POST['explication'];
    // Affichage de l'erreur générale
    echo "Erreur générale : " . $ex->getMessage();
    header('Location: creerTicket.php?id=-1'); // Erreur générale
}
?>
