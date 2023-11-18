<?php

requires("PHPfonctions.php");
if (isset($_POST['login'], $_POST['mdp'], $_POST['mdp2'], $_POST['nom'], $_POST['prenom'], $_POST['email'])) {
    if (!empty($_POST['login']) & !empty($_POST['mdp']) & !empty($_POST['mdp2']) & !empty($_POST['nom']) & !empty($_POST['prenom']) & !empty($_POST['email'])) {
        if ($_POST['mdp'] == $_POST['mdp2']) {
            $login = $_POST['login'];
            $mdp = $_POST['mdp'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];

            $host = 'localhost';
            $database = 'DB_TIX';
            $connection = mysqli_connect($host, 'fictif_inscriptionDB', 't!nt1n_inscriptionDB45987645', $database);

            // On récupère l'adresse IP de l'utilisateur
            $ipUtilisateur = gethostbyname($_SERVER['REMOTE_ADDR']);
            $reponse = insertRequest("INSERT INTO vue_UserFictif_inscriptionDB1 (LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER, HORODATAGE_OUVERTURE_USER, HORODATAGE_DERNIERE_CONNECTION_USER, IP_DERNIERE_CONNECTION_USER) VALUES (?, ?, ?, 'utilisateur', ?, current_timestamp(), current_timestamp(), '$ipUtilisateur')",array($login, $prenom, $nom, $email),$connection);
            
            if ($reponse) {
                $id = mysqli_fetch_row(insertRequest("SELECT ID_USER FROM vue_UserFictif_connexionDB1 WHERE login_user = ?",array($login),$connection))[0];
                newUser($id,$mdp);

                // Vérification de la connexion
                if (connectUser($id,$mdp)) {
                    header('Location: ../tableau_bord/tableauBord.php');
                } else {
                    header('Location: inscription.php?id=5');
                }
            } else {
                header('Location: inscription.php?id=4');
            }
        } else {
            header('Location: inscription.php?id=3');
        }
    } else {
        header('Location: inscription.php?id=2');
    }
} else {
    header('Location: inscription.php?id=1');
}
