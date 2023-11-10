<?php

$host = 'localhost';
$database = 'DB_TIX';

// $connection = mysqli_connect($host, 'root', '', $database);
$connection = mysqli_connect($host, 'fictif_connexionDB', 't!nt1n_connexionDB45987645', $database);

try {
    if (isset($_POST['login'], $_POST['mdp'])) {
        $login = htmlspecialchars($_POST['login']);
        $mdp = htmlspecialchars($_POST['mdp']);

        if (empty($login) || empty($mdp)) {
            throw new Exception("champ_vide");
        }

        // $requete = "SELECT ID_USER FROM utilisateur WHERE login_user = '$login'";
        $requete = "SELECT ID_USER FROM vue_UserFictif_connexionDB1 WHERE login_user = '$login'";
        $reponse = mysqli_query($connection, $requete);

        if ($row = mysqli_fetch_row($reponse)) {
            $connexion = mysqli_connect($host, $row[0], $mdp, $database);

            if ($connexion) {
                /*
                // MANQUE IP DERNIERE CONNEXION ! (10/11/2023)
                // ATTENTION : IMPOSSIBLE D'UTILISER CETTE PARTIE ACTUELLEMENT : IMPOSSIBLE DE MODIFIER LA BD (le 10/11/2023)
                $dateConnexion = date('Y-m-d H:i:s');
                $updateRequete = "UPDATE utilisateur SET HORODATAGE_DERNIERE_CONNECTION_USER = '$dateConnexion' WHERE ID_USER = {$row[0]}";
                mysqli_query($connection, $updateRequete);
                */

                session_start();
                $_SESSION['login'] = $row[0];
                $_SESSION['mdp'] = $mdp;
                header('Location: tableauBord.php');
            }
        } else {
            header('Location: connexion.php?id=2');
        }
    }
} catch (Exception $e) {
    header('Location: connexion.php?id=' . urlencode($e->getMessage()));
}
?>
