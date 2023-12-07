<?php

require "../ressources/info_db/connexion_db.php";
require "../ressources/fonctions/PHPfunctions.php";

// Vérifie que les champs 'mdp' et 'Nemail' sont définis
if (isset($_POST['mdp'], $_POST['Nemail'])) {

    // Vérifie que les deux champs ne sont pas vides
    if (!empty($_POST['mdp']) && !empty($_POST['Nemail'])) {

        // Récupération des informations de connexion
        global $host, $database;

        // Démarrage de la session
        session_start();

        // Récupération des données de session
        $login = $_SESSION['login'];
        $mdp = $_SESSION['mdp'];
        $mdpEntre = $_POST['mdp'];
        $nouvelleEmail = $_POST['Nemail'];

        // Vérifie si le mot de passe saisi correspond à celui entré
        if ($mdp == $mdpEntre) {

            // Connexion à la base de données
            try {
            	$connexion = mysqli_connect($host, $login, $mdp, $database);
            } catch (Exception $e) {
                header('Location: modifEmail.php?erreur=6'); // Erreur connexion BD
                return;
            }

            // Vérifie si l'e-mail est valide
            if (filter_var($nouvelleEmail, FILTER_VALIDATE_EMAIL)) {

                try {
                    // Mise à jour de l'email dans la vue
                    executeSQL("UPDATE vue_utilisateur_insertion_client SET email_user= ? WHERE ID_USER = ?", array($nouvelleEmail, $login), $connexion);

                    // Redirection si la mise à jour réussie
                    header('Location: profil.php');
                } catch (Exception $e) {
                    header('Location: modifEmail.php?erreur=5'); // Erreur lors de la mise à jour
                    return;
                }
            } else {
                header('Location: modifEmail.php?erreur=4'); // Adresse email invalide
                return;
            }
        } else {
            header('Location: modifEmail.php?erreur=3'); // Mot de passe incorrect
            return;
        }
    } else {
        header('Location: modifEmail.php?erreur=2'); // Si l'un ou les deux champs sont vides
        return;
    }
} else {
    header('Location: modifEmail.php?erreur=1'); // Si il manque un champ
    return;
}
?>
