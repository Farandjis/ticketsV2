<?php

require "../ressources/info_db/connexion_db.php";
require "../ressources/fonctions/PHPfunctions.php";

if (isset($_POST['mdp'], $_POST['Nemail'])){
    if (!empty($_POST['mdp']) && !empty($_POST['Nemail'])){
        global $host, $database;
        session_start();
        $login = $_SESSION['login'];
        $mdp = $_SESSION['mdp'];
        $mdpEntre = $_POST['mdp'];
        $nouvelleEmail = $_POST['Nemail'];
        if ($mdp == $mdpEntre){
            $connexion = mysqli_connect($host, $login, $mdp, $database);
            executeSQL("UPDATE vue_utilisateur_insertion_client SET email_user= ? WHERE ID_USER = ?", array($nouvelleEmail, $login), $connexion);
            header('Location: profil.php');
        }else{
            header('Location: modifEmail.html?erreur=3');
        }
    }else{
        header('Location: modifEmail.html?erreur=2');
    }
}else{
    header('Location: modifEmail.html?erreur=1');
}