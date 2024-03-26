<?php
require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connexionUtilisateur = pageAccess(array('Utilisateur', 'Technicien')); // Renvoi vers e403 si la personne n'a pas accès


// Vérifie que les champs 'mdp' et 'Nemail' sont définis
if (isset($_POST['mdp'], $_POST['Nemail'])) {

    // Vérifie que les deux champs ne sont pas vides
    if (!empty($_POST['mdp']) && !empty($_POST['Nemail'])) {

        // Récupération des informations de connexion
        global $host, $database;

        // Démarrage de la session
        session_start();

        // Récupération des données de session
        $loginSite = htmlspecialchars($_SESSION["jeton"]['login']);
        $mdp = htmlspecialchars(htmlspecialchars_decode(dechiffre($_SESSION["jeton"]['mdp'])));
        $mdpEntre = htmlspecialchars($_POST['mdp']);
        $nouvelleEmail = htmlspecialchars($_POST['Nemail']);

        $loginMariaDB = mysqli_fetch_row(mysqli_query($connexionUtilisateur, "SELECT substring_index(user(),'@',1);"))[0]; // Récupère l'ID de l'utilisateur (juste avant le @ ex pour Roberto : 3@localhost, donc 3)


        // Vérifie si le mot de passe saisi correspond à celui entré
        if ($mdp == $mdpEntre) {

            /*
            // Connexion à la base de données (fait par pageAcess normalement)
            try {
            	$connexion = mysqli_connect($host, $loginMariaDB, $mdp, $database);
            } catch (Exception $e) {
                header('Location: modifEmail.php?id=6'); // Erreur connexion BD
                return;
            }
            */


            // Vérifie si l'e-mail est valide
            if (valideEMAIL($nouvelleEmail)) {

                try {
                    // Mise à jour de l'email dans la vue
                    executeSQL("UPDATE vue_Utilisateur_maj_email SET email_user= ? WHERE ID_USER = ?", array($nouvelleEmail, $loginMariaDB), $connexionUtilisateur);

                    // Redirection si la mise à jour réussie
                    header('Location: profil.php');
                    return;

                } catch (Exception $e) {
                    header('Location: modifEmail.php?id=5'); // Erreur lors de la mise à jour
                    return;
                }
            } else {
                header('Location: modifEmail.php?id=4'); // Adresse email invalide
                return;
            }
        } else {
            header('Location: modifEmail.php?id=3'); // Mot de passe incorrect
            return;
        }
    } else {
        header('Location: modifEmail.php?id=2'); // Si l'un ou les deux champs sont vides
        return;
    }
} else {
    header('Location: modifEmail.php?id=1'); // Si il manque un champ
    return;
}
?>
