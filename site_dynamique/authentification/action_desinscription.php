<?php
require '../ressources/fonctions/PHPfunctions.php';

$connexionUtilisateur = pageAccess(array('Utilisateur', 'Technicien'));

//Récupération des données de la base de données
global $database, $host;

try{
// Vérifie que les champs 'login', 'Amdp' et 'captcha' sont définis
    if (isset($_POST['login'], $_POST['Amdp'], $_POST['captcha'])) {

        // Vérifie que les champs 'login', 'Amdp' ne sont pas vides
        if (!empty($_POST['login']) && !empty($_POST['Amdp'])) {

            // Démarrage d'une session
            session_start();

            // Récupération des données de session
            $mdpentre = htmlspecialchars($_POST['Amdp']);
            $loginentre = htmlspecialchars($_POST['login']);

            $loginSite = htmlspecialchars($_SESSION['login']);
            $mdpMariaDB = htmlspecialchars(htmlspecialchars_decode($_SESSION['mdp']));

            // Vérification que le login et mdp entrés sont identiques à ceux inscrit lors de la connexion
            if ($mdpentre !== $mdpMariaDB || $loginentre !== $loginSite) {
                header('Location: desinscription.php?id=3'); // Le mdp et login entrés ne correspondent pas à ceux entrés lors de la connexion
                exit;
            }

            //Récupération de la valeur du captcha entré par l'utilisateur
            $reponseUtilisateur = $_POST['captcha'];

            //Si le champ captcha n'est pas vide
            if (!empty($reponseUtilisateur)) {
                $estValideCAPTCHA = verifyCAPTCHA($reponseUtilisateur, $_SESSION['chiffre1'], $_SESSION['chiffre2']);

                //Si la valeur du captcha entré par l'utilisateur est invalide
                if (!$estValideCAPTCHA) {
                    header('Location: desinscription.php?id=5'); // ERREUR : Captcha incorrect.
                    exit;
                }
            } else {
                header('Location: desinscription.php?id=4'); // ERREUR : La case CAPTCHA doit être remplie.
                exit;
            }

            //Requête pour se désinscrire de la plateforme

            $resultatDesinsc = mysqli_query($connexionUtilisateur, "CALL ATTENTION_SupprimerSonCompte()");

            if($resultatDesinsc){
                header('Location: ../index.php');  //Si la desinscription a été effectuée
            }
            else{
                header('Location: desinscription.php?id=6'); //erreur lors de la desinscription
            }

        } else {
            header('Location: desinscription.php?id=2'); // Champs vides
            exit;
        }
    } else {
        header('Location: desinscription.php?id=1'); // Les données du POST ne sont pas définies
        exit;
    }
} catch (Exception $e) {

    header('Location: desinscription.php?id=6&error=' . urlencode($e->getMessage()));
    exit;
}