<?php
require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");

global $database, $host;

//Vérifie si les champs 'Nmdp' et 'Cmdp' sont définis
if (isset($_POST['Nmdp'],$_POST['Cmdp'])) {

    //Vérifie si les champs ne sont vides
    if (!empty($_POST['Nmdp']) && !empty($_POST['Cmdp'])) {

        //Démarrage de la session
        session_start();

        //Récupération des données de session
        $nouveauMdp = $_POST['Nmdp'];
        $confirmationMdp = $_POST['Cmdp'];

        $loginMariaDB = $_SESSION['login'];
        $mdpMariaDB = $_SESSION['mdp'];

        //Vérifie si le nouveau mot de passe et la confirmation de ce mdp sont similaires
        if ($nouveauMdp == $confirmationMdp) {

            //Vérifie que le nouveau mot de passe est valide
            $resvalidemdp = valideMDP($nouveauMdp);

            if ($resvalidemdp == 0){
                header('Location: modifMdp.php?id=4a');
            } // ERREUR : Mot de passe invalide taille
            elseif ($resvalidemdp == -1){
                header('Location: modifMdp.php?id=4b');
            } // manque maj
            elseif ($resvalidemdp == -2){
                header('Location: modifMdp.php?id=4c');
            } // manque min
            elseif ($resvalidemdp == -3){
                header('Location: modifMdp.php?id=4d');
                return;
            } // manque chiffre
            elseif ($resvalidemdp == -4){
                header('Location: modifMdp.php?id=4e');
                return;
            } // manque caractère spécial
            else{
                try {
                    // Connexion à la base de données
                    $connexion = mysqli_connect($host, $loginMariaDB, $mdpMariaDB, $database);

                    // Utilisation de la requête UPDATE pour mettre à jour le mot de passe
                    $requete = "SET PASSWORD = PASSWORD('$nouveauMdp');";
                    mysqli_query($connexion, $requete);

                    //Fermetture de la session avec l'ancien mot de passe
                    mysqli_close($connexion);

                    //nouvelle connexion avec le nouveau mot de passe
                    $connexion = mysqli_connect($host, $loginMariaDB, $nouveauMdp, $database);

                    //Vérifie la connexion avec le nouveau mot de passe
                    if(connectUser($loginMariaDB, $nouveauMdp)) {
                        $_SESSION['mdp'] = $nouveauMdp;
                        header('Location: profil.php');
                        return;
                    }
                } catch (Exception $e) {
                    try {
                        // On remet l'ancien mot de passe et on tente de reconnecter l'utilisateur
                        $connexion = mysqli_connect($host, $loginMariaDB, $mdpMariaDB, $database);
                        if(connectUser($loginMariaDB, $mdpMariaDB)) {
                            header('Location: modifMdp.php?id=5'); // Erreur lors de la mise à jour du mot de passe
                            return;
                        }
                    } catch (Exception $ex) {
                        header('Location: modifMdp.php?id=6'); // Erreur lors de la reconnexion avec l'ancien mot de passe
                        return;
                    }
                }
            }
        } else {
            header('Location: modifMdp.php?id=3'); //Mot de passe et confirmation ne correspondent pas
            return;
        }
    } else {
        header('Location: modifMdp.php?id=2'); //Champs vides
        return;
    }
} else {
    header('Location: modifMdp.php?id=1'); //champs manquants
    return;
}
?>
