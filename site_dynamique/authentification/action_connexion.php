<?php

$host = 'localhost';
$database = 'db_tix';

$connection = mysqli_connect($host, 'root', '', $database);

if (isset($_POST['login'], $_POST['mdp'])) {
    $login = htmlspecialchars($_POST['login']);
    $mdp = htmlspecialchars($_POST['mdp']);
    $requete = "SELECT ID_USER FROM utilisateur WHERE login_user = '$login'";
    $reponse = mysqli_query($connection, $requete);
    if ($row = mysqli_fetch_row($reponse)) {
        $connexion = mysqli_connect($host, $row[0], $mdp, $database);
        if ($connexion) {
            session_start();
            $_SESSION['login'] = $row[0];
            $_SESSION['mdp'] = $mdp;
            header('Location: tableauBord.php');
        } else {
            header('Location: connexion.php?id=3');
        }
    }else {
        header('Location: connexion.php?id=2');
    }
}else {
    header('Location: connexion.php?id=1');
}






