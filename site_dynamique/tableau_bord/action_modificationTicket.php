<?php
require '../ressources/fonctions/PHPfunctions.php';

// Vérifie l'accès à la page en fonction des rôles
$connexionUtilisateur = pageAccess(array('Utilisateur', 'Technicien', 'Administrateur Site', 'Administrateur Système'));

session_start();

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['fermer_ticket'])) {
            if (!empty($_POST['id_ticket'])) {
                $id_ticket = $_POST['id_ticket'];

                // On ferme le ticket. Si c'est possible, renvoi 1, sinon 0. On convertit en booléen True/False
                $resultatFermeture = (bool) mysqli_fetch_row(executeSQL("SELECT FermerUnTicket(?)", array($id_ticket), $connexionUtilisateur))[0];

                if ($resultatFermeture) {
                    // Succès, on redirige vers le tableau de bord
                    header('Location: tableaudebord.php');
                    return;
                } else {
                    // Echec, on prépare la redirection vers la page modifTicket
                    // Source de l'envoi auto d'un formulaire : https://www.developpez.net/forums/d1589344/javascript/general-javascript/envoyer-automatiquement-formulaire/

                    echo "
                        <form id='retourPageModifTicket' action='modificationTicket.php' method='post'>
                            <input type='hidden' name='id_ticket' value=$id_ticket>
                            <input type='hidden' name='id' value=99>
                        </form>";
                    echo "<script>document.getElementById('retourPageModifTicket').submit();</script>"; // On envoie automatiquement le formulaire
                }
                return;
            }

        } elseif (isset($_POST['titre'], $_POST['nivUrg'], $_POST["explication2"])) {
            // Si la demande est une modification de ticket
            if (!empty($_POST["explication2"]) && !empty($_POST['nivUrg']) && !empty($_POST['titre']) && !empty($_POST['motcle_option'])) {
                global $host, $database, $USER_FICTIF_MDP;

                $id_ticket = $_POST['id_ticket'];
                $titre = $_POST['titre'];
                $niveauUrgence = $_POST['nivUrg'];
                $explication = $_POST['explication2'];

                $niveauUrgenceAutorise = ['Faible', 'Moyen', 'Important', 'Urgent'];

                if (in_array($niveauUrgence, $niveauUrgenceAutorise)) {

                    // Vérifie si le titre existe déjà
                    $requeteVerifTitre = 'SELECT titre_ticket FROM TitreTicket WHERE titre_ticket = ?';
                    $resultVerifTitre = executeSQL($requeteVerifTitre, array($titre), $connexionUtilisateur);
                    $existingTitre = mysqli_fetch_assoc($resultVerifTitre);

                    if ($existingTitre) {
                        $infoTicket = mysqli_fetch_array(executeSQL("SELECT etat_ticket, id_technicien FROM vue_tableau_bord WHERE id_ticket = ?;", array($id_ticket), $connexionUtilisateur));
                        $etatDuTicket = $infoTicket[0];

                        // Modifier le ticket en fonction des rôles et de l'état du ticket
                        if (($etatDuTicket == "En attente") && (recupererRoleDe($connexionUtilisateur) != 'Administrateur Site')) {
                            executeSQL("UPDATE vue_modif_creation_ticket_utilisateur SET TITRE_TICKET = ?,DESCRIPTION_TICKET = ?, NIV_URGENCE_ESTIMER_TICKET = ? WHERE ID_TICKET  = ?;", array($titre, $explication, $niveauUrgence, $id_ticket), $connexionUtilisateur);
                        }

                        if (recupererRoleDe($connexionUtilisateur) == 'Technicien' || recupererRoleDe($connexionUtilisateur) == 'Administrateur Site') {
                            if (isset($_POST['nivUrg2']) && !empty($_POST['nivUrg2']) && recupererRoleDe($connexionUtilisateur) == 'Administrateur Site') {
                                $niveauUrgence2 = $_POST['nivUrg2'];
                                if ($etatDuTicket == 'En attente') {
                                    $etatDuTicket = "Ouvert";
                                }
                                executeSQL("UPDATE vue_modif_ticket_adm_tech SET TITRE_TICKET = ?,DESCRIPTION_TICKET = ?, NIV_URGENCE_DEFINITIF_TICKET = ? WHERE ID_TICKET  = ?;", array($titre, $explication, $niveauUrgence2, $id_ticket), $connexionUtilisateur);
                                $technicien = $_POST['ch_technicien'];
                                if (isset($_POST['ch_technicien']) && !empty($_POST['ch_technicien']) && $technicien != $infoTicket[1]) {
                                    if ($etatDuTicket == 'Ouvert')
                                        executeSQL("UPDATE vue_associe_ticket_tech SET id_technicien = ? WHERE ID_TICKET = ?;", array($technicien, $id_ticket), $connexionUtilisateur);
                                    else
                                        executeSQL("UPDATE vue_modif_ticket_adm_tech SET ID_TECHNICIEN = ? WHERE ID_TICKET  = ?;", array($technicien, $id_ticket), $connexionUtilisateur);
                                }
                            } else {
                                executeSQL("UPDATE vue_modif_ticket_adm_tech SET TITRE_TICKET = ?,DESCRIPTION_TICKET = ? WHERE ID_TICKET  = ?;", array($titre, $explication, $id_ticket), $connexionUtilisateur);
                            }
                        }

                        // Supprimer les relations mots-clés existantes
                        executeSQL("DELETE FROM vue_suppr_rtm_tdb WHERE id_ticket = ?;", array($id_ticket), $connexionUtilisateur);

                        // Ajouter de nouvelles relations mots-clés
                        foreach ($_POST["motcle_option"] as $unMotcleTicket) {
                            executeSQL('INSERT INTO RelationTicketsMotscles (ID_TICKET, NOM_MOTCLE) VALUES (?, ?)', array($id_ticket, $unMotcleTicket), $connexionUtilisateur);
                            echo "*";
                        }
                        // Rediriger vers le tableau de bord après la modification
                        header('Location: tableaudebord.php');
                        return;
                    } else {
                        // Rediriger avec un code d'erreur si le titre n'existe pas
                        // Données essentielles ne sont pas fournies ou incohérentes
                        echo "
                        <form id='retourPageModifTicket' action='modificationTicket.php' method='post'>
                            <input type='hidden' name='id_ticket' value=$id_ticket>
                            <input type='hidden' name='id' value=1>
                        </form>";
                        echo "<script>document.getElementById('retourPageModifTicket').submit();</script>"; // On envoie automatiquement le formulaire
                        return;
                    }
                }else {
                    echo "
                        <form id='retourPageModifTicket' action='modificationTicket.php' method='post'>
                            <input type='hidden' name='id_ticket' value=$id_ticket>
                            <input type='hidden' name='id' value=4>
                        </form>";
                    echo "<script>document.getElementById('retourPageModifTicket').submit();</script>"; // On envoie automatiquement le formulaire
                    return;
                }
            } else {
                // Rediriger avec un code d'erreur si des données manquent
                // Données manquantes
                $id_ticket = $_POST['id_ticket'];
                echo "
                        <form id='retourPageModifTicket' action='modificationTicket.php' method='post'>
                            <input type='hidden' name='id_ticket' value=$id_ticket>
                            <input type='hidden' name='id' value=2>
                        </form>";
                echo "<script>document.getElementById('retourPageModifTicket').submit();</script>"; // On envoie automatiquement le formulaire
                return;
            }
        }
    }
    header('Location: erreurs/403.html');
    return;
} catch (Exception $e) {
    // Gestion des exceptions
    echo 'Erreur : ' . $e->getMessage();
}

