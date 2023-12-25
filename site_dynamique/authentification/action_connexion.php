<?php
require("../ressources/fonctions/PHPfunctions.php");
global $host, $database, $USER_FICTIF_MDP; // Viennent de connexion_db.php (importé grâce à PHPfunctions.php)
// Définir les informations de connexion à la base de données

$host = 'localhost';
$database = 'DB_TIX';

// Connexion à la base de données

$connection = mysqli_connect($host, 'fictif_connexionDB', $USER_FICTIF_MDP['fictif_connexionDB'], $database);

try {
    // Vérifie que les champs 'login' et 'mdp' sont définis

    if (isset($_POST['login'], $_POST['mdp'])) {

        // Vérifie si les champs 'login' et 'mdp' sont vides

	$loginSite = htmlspecialchars($_POST['login']);
	$mdpMariaDB = htmlspecialchars($_POST['mdp']);

        if (empty($loginSite) || empty($mdpMariaDB)) {
            throw new Exception("3"); // Erreur : champs vide
        }
        
        // Récupère l'ID_USER de l'utilisateur par rapport au login
        //$id = mysqli_fetch_row(executeSQL("SELECT ID_USER FROM vue_UserFictif_connexion WHERE login_user = ?",array($_POST['login']),$connection))[0];
        $resSQL = mysqli_fetch_row(executeSQL("SELECT ID_USER FROM UserFictif_connexion WHERE login_user = ?", array($loginSite), $connection));



	if ($resSQL === null){ header('Location: connexion.php?id=2'); } // Mauvais login (la requête SQL n'a rien renvoyé)
	else { $loginMariaDB = $resSQL[0]; } // On récupère l'ID_USER qui est le login MariaDB.



        $connexion = mysqli_connect($host, $loginMariaDB, $mdpMariaDB);
        $verifRole = recupererRoleDe($connexion);
        mysqli_close($connexion);

        if ($verifRole == "Rôle manquant"){ header('Location: connexion.php?id=5'); return; } // L'utilisateur n'a pas de rôle permettant l'accès au site
        else if ($verifRole == "Rôle inconnu"){ header('Location: connexion.php?id=6'); return; } // L'utilisateur possède un rôle inconnu par le système


        $connexion = connectUser($loginMariaDB, $loginSite, $mdpMariaDB);
        if ($connexion){ // Si la connexion au site est possible (mdp valide)
            header('Location: ../tableau_bord/tableaudebord.php');
        }
        else{ // Echec de l'authentification de l'utilisateur
            header('Location: connexion.php?id=2');
            return;
        }



    }
} catch (Exception $e) {

    $msg_erreur = $e->getMessage();

    if ("Access denied" == substr($msg_erreur, 0, 13)) {
        // Si MariaDB refuse la connexion de l'utilisateur (normalement, cela signifie mauvais mot de passe
        $msg_erreur = 2; // Erreur : login ou mdp incorrecte
    }
    header('Location: connexion.php?id=' . urlencode($msg_erreur));
}
?>
