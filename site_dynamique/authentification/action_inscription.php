<?php

require '../mesfonctions.php';

if (isset($_POST['login'], $_POST['mdp'], $_POST['mdp2'], $_POST['nom'], $_POST['prenom'], $_POST['email'])) {
    if (!empty($_POST['login']) & !empty($_POST['mdp']) & !empty($_POST['mdp2']) & !empty($_POST['nom']) & !empty($_POST['prenom']) & !empty($_POST['email'])) {
        if ($_POST['mdp'] == $_POST['mdp2']) {
            $login = htmlspecialchars($_POST['login']);
            $mdp = htmlspecialchars($_POST['mdp']);
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $email = htmlspecialchars($_POST['email']);

            $host = 'localhost';
            $database = 'DB_TIX';
            $connection = mysqli_connect($host, 'fictif_inscriptionDB', 't!nt1n_inscriptionDB45987645', $database);

            $requete = "INSERT INTO vue_UserFictif_inscriptionDB1 (ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER, HORODATAGE_OUVERTURE_USER, HORODATAGE_DERNIERE_CONNECTION_USER, IP_DERNIERE_CONNECTION_USER) VALUES (NULL, ?, ?, ?, 'utilisateur', ?, current_timestamp(), current_timestamp(), NULL)";
            $stmt = mysqli_prepare($connection, $requete);
            mysqli_stmt_bind_param($stmt, "ssss", $login, $prenom, $nom, $email);

            if (mysqli_stmt_execute($stmt)) {
                $requete = "SELECT ID_USER FROM vue_UserFictif_inscriptionDB1 WHERE login_user = ?";
                $stmt = mysqli_prepare($connection, $requete);
                mysqli_stmt_bind_param($stmt, "s", $login);
                mysqli_stmt_execute($stmt);
                $row = mysqli_fetch_row(mysqli_stmt_get_result($stmt));

                newUser($row[0], $mdp, $connection);

                // Vérification de la connexion
                if (connectUser($host, $row[0], $mdp, $database)) {
                    session_start();
                    $_SESSION['login'] = $row[0];
                    $_SESSION['mdp'] = $mdp;

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