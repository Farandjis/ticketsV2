<?php
require("../ressources/fonctions/PHPfunctions.php");
// Définir les informations de connexion à la base de données
$host = 'localhost';
$database = 'DB_TIX';

// Connexion à la base de données

$connection = mysqli_connect($host, 'fictif_connexionDB', 't!nt1n_connexionDB45987645', $database);

try {
    // Vérifie que les champs 'login' et 'mdp' sont définis

    if (isset($_POST['login'], $_POST['mdp'])) {

        // Vérifie si les champs 'login' et 'mdp' sont vides

	$loginSite = $_POST['login'];
	$mdpMariaDB = $_POST['mdp'];

        if (empty($loginSite) || empty($mdpMariaDB)) {
            throw new Exception("3"); // Erreur : champs vide
        }
        
        // Récupère l'ID_USER de l'utilisateur par rapport au login
        //$id = mysqli_fetch_row(insertRequest("SELECT ID_USER FROM vue_UserFictif_connexionDB1 WHERE login_user = ?",array($_POST['login']),$connection))[0];
        $test = insertRequest("SELECT ID_USER FROM vue_UserFictif_connexionDB1 WHERE login_user = ?",array($_POST['login']),$connection);

	$id = mysqli_fetch_row($test);
	
	echo $id[0];
	/*
        if (connectUser($id,$_POST['mdp'])){
            header('Location: ../tableau_bord/tableauBord.php');
        }
        else{
            header('Location: connexion.php?id=2');
        }
        */

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
