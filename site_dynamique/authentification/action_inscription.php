<?php

require '../ressources/fonctions/PHPfunctions.php';
global $host, $database, $USER_FICTIF_MDP; // Viennent de connexion_db.php (importé grâce à PHPfunctions.php)

if (isset($_POST['login'], $_POST['mdp'], $_POST['mdp2'], $_POST['nom'], $_POST['prenom'], $_POST['email'])) {
    if (!empty($_POST['login']) & !empty($_POST['mdp']) & !empty($_POST['mdp2']) & !empty($_POST['nom']) & !empty($_POST['prenom']) & !empty($_POST['email'])) {
        if ($_POST['mdp'] == $_POST['mdp2']) {
            $login = $_POST['login']; $mdp = $_POST['mdp']; $nom = $_POST['nom'];
            $prenom = $_POST['prenom']; $email = $_POST['email'];

            $coUFInscription = mysqli_connect($host, 'fictif_inscriptionDB', $USER_FICTIF_MDP['fictif_inscriptionDB'], $database);

            $coUFInscription->begin_transaction(); // On commence une transaction SQL

            try {
                executeSQL("INSERT INTO vue_UserFictif_inscriptionDB1 (LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER, HORODATAGE_OUVERTURE_USER) VALUES (?, ?, ?, 'utilisateur', ?, current_timestamp())", array($login, $prenom, $nom, $email), $coUFInscription);

                // A partir de là, on considère qu'on a bien inséré le nouvel utilisateur, on peut donc créer sa session (utilisateur) MariaDB.


                $loginMariaDBProtege = htmlspecialchars($coUFInscription->insert_id);
                $mdpProtege = htmlspecialchars($mdp);
                $create_user_query = "CREATE USER '$loginMariaDBProtege'@localhost IDENTIFIED BY '$mdpProtege';";
                mysqli_query($coUFInscription, $create_user_query);



                //$coUFInscription->rollback();
                $coUFDroit = mysqli_connect($host, 'fictif_droitDB', $USER_FICTIF_MDP['fictif_droitDB'], $database);

                $requete = "GRANT SELECT ON vue_Utilisateur_client TO '$loginMariaDBProtege'@localhost;";
                mysqli_query($coUFDroit, $requete);
                $requete = "GRANT SELECT ON vue_Ticket_client TO '$loginMariaDBProtege'@localhost;";
                mysqli_query($coUFDroit, $requete);
                $requete = "GRANT UPDATE ON vue_Utilisateur_insertion_client TO '$loginMariaDBProtege'@localhost;";
                mysqli_query($coUFDroit, $requete);
                $requete = "GRANT UPDATE ON vue_Ticket_insertion_client TO '$loginMariaDBProtege'@localhost;";
                mysqli_query($coUFDroit, $requete);

                echo "ok";
                $coUFInscription->commit(); // Si tout s'est bien passé durant la transaction, on valide les modifications
                $coUFInscription->close(); // L'utilisateur fictif inscription se déconnecte de la base de donnée
            }catch(Exception $e){
                echo "oh lalalalala il y a une erreur : $e";
                $coUFInscription->rollback();
                $coUFInscription->close(); // L'utilisateur fictif inscription se déconnecte de la base de donnée
            }
 
            // A partir de là, on sait que l'utilisateur a été créer. Il peut donc se connecter
            

            try{
                connectUser($loginMariaDBProtege, $mdpProtege); // Si la connexion au site est possible (mdp valide)
                header('Location: ../tableau_bord/tableauBord.php');
            }catch(Exception $e){
                header('Location: connexion.php?id=4');
            }
            

            /*
            $login = htmlspecialchars($_POST['login']);
            $mdp = htmlspecialchars($_POST['mdp']);
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $email = htmlspecialchars($_POST['email']);

            $host = 'localhost';
            $database = 'DB_TIX';
            $connection = mysqli_connect($host, 'fictif_inscriptionDB', 't!nt1n_inscriptionDB45987645', $database);

            $requete = "INSERT INTO vue_UserFictif_inscriptionDB1 (LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER, HORODATAGE_OUVERTURE_USER, HORODATAGE_DERNIERE_CONNECTION_USER, IP_DERNIERE_CONNECTION_USER) VALUES (?, ?, ?, 'utilisateur', ?, current_timestamp(), current_timestamp(), NULL)";
            $stmt = mysqli_prepare($connection, $requete);
            mysqli_stmt_bind_param($stmt, "ssss", $login, $prenom, $nom, $email);

            if (mysqli_stmt_execute($stmt)) {
                $connection = mysqli_connect($host, 'fictif_connexionDB', 't!nt1n_connexionDB45987645', $database);

                $requete = "SELECT ID_USER FROM vue_UserFictif_connexionDB1 WHERE login_user = ?";

                $stmt = mysqli_prepare($connection, $requete);
                mysqli_stmt_bind_param($stmt, "s", $login);
                mysqli_stmt_execute($stmt);
                $row = mysqli_fetch_row(mysqli_stmt_get_result($stmt));

                newUser($row[0], $mdp, $connection);

                // Vérification de la connexion
                if (connectUser($row[0], $mdp)) {
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
            */
        } else {
            header('Location: inscription.php?id=3');
        }
    } else {
        header('Location: inscription.php?id=2');
    }
} else {
    header('Location: inscription.php?id=1');
}
