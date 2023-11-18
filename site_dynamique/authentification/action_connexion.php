<?php
require(../PHPfunctions.php);
// Définir les informations de connexion à la base de données
$host = 'localhost';
$database = 'DB_TIX';

// Connexion à la base de données

$connection = mysqli_connect($host, 'fictif_connexionDB', 't!nt1n_connexionDB45987645', $database);

try {
    // Vérifie que les champs 'login' et 'mdp' sont définis

    if (isset($_POST['login'], $_POST['mdp'])) {

        // Vérifie si les champs 'login' et 'mdp' sont vides

        if (empty($_POST['login']) || $_POST['mdp']) {
            throw new Exception("3"); // Erreur : champs vide
        }
        if (connectUser($_POST['login'],$_POST['mdp'])){
            header('Location: ../tableau_bord/tableauBord.php');
        }
        else{
            header('Location: connexion.php?id=2');
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
