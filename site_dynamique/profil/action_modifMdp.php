<?php
require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connexionUtilisateur = pageAccess(array('Utilisateur', 'Technicien')); // Renvoi vers e403 si la personne n'a pas accès

global $database, $host;

// Vérifie si les champs 'Nmdp', 'Cmdp' et 'Amdp' sont définis
if (isset($_POST['Nmdp'],$_POST['Cmdp'], $_POST['Amdp'])) {

    // Vérifie si les champs ne sont pas vides
    if (!empty($_POST['Nmdp']) && !empty($_POST['Cmdp']) && !empty($_POST['Amdp'])) {

        // Démarrage de la session
        session_start();

        // Récupération des données de session
        $nouveauMdp = htmlspecialchars($_POST['Nmdp']);
        $confirmationMdp = htmlspecialchars($_POST['Cmdp']);
        $mdpentre = htmlspecialchars($_POST['Amdp']);

        $loginSite = htmlspecialchars($_SESSION["jeton"]['login']);
        $mdpMariaDB = htmlspecialchars(htmlspecialchars_decode(dechiffre($_SESSION["jeton"]['mdp'])));

        $loginMariaDB = mysqli_fetch_row(mysqli_query($connexionUtilisateur, "SELECT substring_index(user(),'@',1);"))[0]; // Récupère l'ID de l'utilisateur (juste avant le @ ex pour Roberto : 3@localhost, donc 3)

        // Vérifie si le mot de passe entré correspond au mot de passe MariaDB


        if ($mdpentre == $mdpMariaDB) {

            // Vérifie si le nouveau mot de passe et la confirmation de ce mdp sont similaires
            if ($nouveauMdp == $confirmationMdp) {

                // Vérifie que le nouveau mot de passe est valide
                $resvalidemdp = valideMDP($nouveauMdp);

                if ($resvalidemdp == 0) {
                    header('Location: modifMdp.php?id=4');
                } // ERREUR : Mot de passe invalide taille
                elseif ($resvalidemdp == -1) {
                    header('Location: modifMdp.php?id=5');
                } // manque maj
                elseif ($resvalidemdp == -2) {
                    header('Location: modifMdp.php?id=6');
                } // manque min
                elseif ($resvalidemdp == -3) {
                    header('Location: modifMdp.php?id=7');
                    return;
                } // manque chiffre
                elseif ($resvalidemdp == -4) {
                    header('Location: modifMdp.php?id=8');
                    return;
                } // manque caractère spécial
                else {
                    try {
                        // Connexion à la base de données
                        // $connexion = mysqli_connect($host, $loginMariaDB, $mdpMariaDB, $database);

                        // Utilisation de la requête UPDATE pour mettre à jour le mot de passe
                        $requete = "SET PASSWORD = PASSWORD('$nouveauMdp');";
                        mysqli_query($connexionUtilisateur, $requete);

                        // Fermeture de la session avec l'ancien mot de passe
                        mysqli_close($connexionUtilisateur);

                        // Nouvelle connexion avec le nouveau mot de passe
                        $connexion = mysqli_connect($host, $loginMariaDB, $nouveauMdp, $database);

                        // Vérifie la connexion avec le nouveau mot de passe
                        if (connectUser($loginMariaDB, $loginSite, $nouveauMdp)) {
                            $_SESSION["jeton"]['mdp'] = chiffre(getIp(), $_SESSION["jeton"]['echeance'], $nouveauMdp);
                            header('Location: profil.php');
                            return;
                        }
                    } catch (Exception $e) {
                        try {
                            // On remet l'ancien mot de passe et on tente de reconnecter l'utilisateur
                            $connexion = mysqli_connect($host, $loginMariaDB, $mdpMariaDB, $database);
                            if (connectUser($loginMariaDB, $loginSite, $mdpMariaDB)) {
                                header('Location: modifMdp.php?id=9'); // Erreur lors de la mise à jour du mot de passe
                                return;
                            }
                        } catch (Exception $ex) {
                            header('Location: modifMdp.php?id=10'); // Erreur lors de la reconnexion avec l'ancien mot de passe
                            return;
                        }
                    }
                }
            } else {
                header('Location: modifMdp.php?id=3'); // Mot de passe et confirmation ne correspondent pas
                return;
            }
        } else {
            header('Location: modifMdp.php?id=11'); // Le mot de passe entré ne correspond pas au mot de passe actuel
            return;
        }
    } else {
        header('Location: modifMdp.php?id=2'); // Champs vides
        return;
    }
} else {
    header('Location: modifMdp.php?id=1'); // Champs manquants
    return;
}
?>
