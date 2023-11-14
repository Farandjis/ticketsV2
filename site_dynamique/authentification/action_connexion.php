<?php

// Définir les informations de connexion à la base de données
$host = 'localhost';
$database = 'DB_TIX';

//Connexion à la base de données

// $connection = mysqli_connect($host, 'root', '', $database);
$connection = mysqli_connect($host, 'fictif_connexionDB', 't!nt1n_connexionDB45987645', $database);

try {
    //Vérifie que les champs 'login' et 'mdp' sont définis

    if (isset($_POST['login'], $_POST['mdp'])) {

        //Evite les injections SQL

        $login = htmlspecialchars($_POST['login']);
        $mdp = htmlspecialchars($_POST['mdp']);

        //Vérifie si les champs 'login' et 'mdp' sont vides

        if (empty($login) || empty($mdp)) {
            throw new Exception("3"); // Erreur : champs vide
        }
        //Récupère l'ID_USER de l'utilisateur par rapport au login

        // $requete = "SELECT ID_USER FROM utilisateur WHERE login_user = '$login'";
        $requete = "SELECT ID_USER FROM vue_UserFictif_connexionDB1 WHERE login_user = '$login'";
        $reponse = mysqli_query($connection, $requete);

        //Vérifie si l'utilisateur existe dans la base de données
        if ($row = mysqli_fetch_row($reponse)) {

            //Connexion à la base de données spécifique à l'utilisateur
            $connexion = mysqli_connect($host, $row[0], $mdp, $database);

            //Vérifie si la connexion a été établie
            
            if ($connexion) {


                //On récupère l'adresse IP du serveur
                $ipServeur = gethostbyname($_SERVER['SERVER_NAME']);
                
                //Récupère la date et l'heure à laquelle l'utilisateur s'est connecté la dernière fois
                $dateConnexion = date('Y-m-d H:i:s');
                
                //On met à jour les colonnes liées à la dernière connexion et l'IP du serveur de l'utilisateur 
                
                $updateRequete = "UPDATE vue_UserFictif_updateDB1 SET HORODATAGE_DERNIERE_CONNECTION_USER = '$dateConnexion', IP_DERNIERE_CONNECTION_USER = '$ipServeur' WHERE ID_USER = {$row[0]}";
                mysqli_query($connection, $updateRequete);


                //On démarre la session
                session_start();
                $_SESSION['login'] = $row[0];
                $_SESSION['mdp'] = $mdp;
                
                //Redirige l'utilisateur vers le tableau bord si la connexion est réussie
                header('Location: ../tableau_bord/tableauBord.html');
            }
        } else {
            header('Location: connexion.php?id=2'); // Erreur : identifiant ou mdp incorrecte
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
