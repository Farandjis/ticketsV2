<?php

require '../ressources/fonctions/PHPfunctions.php';
global $host, $database, $USER_FICTIF_MDP; // Viennent de connexion_db.php (importé grâce à PHPfunctions.php)

if (isset($_POST['login'], $_POST['mdp'], $_POST['mdp2'], $_POST['nom'], $_POST['prenom'], $_POST['email'])) {
    if (!empty($_POST['login']) & !empty($_POST['mdp']) & !empty($_POST['mdp2']) & !empty($_POST['nom']) & !empty($_POST['prenom']) & !empty($_POST['email'])) {
        if ($_POST['mdp'] == $_POST['mdp2']) {
            $login = htmlspecialchars($_POST['login']); $mdp = htmlspecialchars($_POST['mdp']); $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']); $email = htmlspecialchars($_POST['email']);

            $coUFInscription = mysqli_connect($host, 'fictif_inscriptionDB', $USER_FICTIF_MDP['fictif_inscriptionDB'], $database);

            // Avant de faire quoique ce soit, on fait des vérifications

            // VERIF LOGIN
            $coUFConnexion = mysqli_connect($host, 'fictif_connexionDB', $USER_FICTIF_MDP['fictif_connexionDB'], $database);
            $res = mysqli_fetch_row(executeSQL("SELECT COUNT(LOGIN_USER) FROM vue_UserFictif_connexionDB1 WHERE LOGIN_USER = ?", array($login), $coUFConnexion))[0];
            if ($res == 1) { // login déjà présent dans la BD
                $coUFInscription->close(); $coUFConnexion->close();
                header('Location: inscription.php?id=7'); // ERREUR : Le login est déjà utilisé.
            } else { $coUFConnexion->close(); }
            if (! (strlen($login) >= 5 and strlen($login) <= 30)) { header('Location: inscription.php?id=14'); return;}

            // VERIF MDP
            $resvalidemdp = valideMDP($mdp);
            if ($resvalidemdp == 0){ header('Location: inscription.php?id=8a'); } // ERREUR : Mot de passe invalide taille
            if ($resvalidemdp == -1){ header('Location: inscription.php?id=8b'); } // manque maj
            if ($resvalidemdp == -2){ header('Location: inscription.php?id=8c'); } // manque min
            if ($resvalidemdp == -3){ header('Location: inscription.php?id=8d'); return;} // manque chiffre
            if ($resvalidemdp == -4){ header('Location: inscription.php?id=8e'); return;} // manque caractère spécial

            // VERIF PRENOM
            $pattern = '/^[A-Za-zÀ-ÖØ-öø-ÿ\-]+$/u'; // "u" indique qu'il faut utilisé UTF-8. Il autorise uniquement les caractères alphabêtique, les accents et les tirets
            if (! preg_match($pattern, $prenom)){ header('Location: inscription.php?id=9'); return;}
            if (! (strlen($prenom) >= 1 and strlen($prenom) <= 30)) { header('Location: inscription.php?id=12'); return;}

            // VERIF NOM
            $pattern = '/^[A-Za-zÀ-ÖØ-öø-ÿ\-\s]+$/u'; // de même que pour prénom mais l'espace est autorisé en plus
            if (! preg_match($pattern, $nom)){ header('Location: inscription.php?id=10'); return;}
            if (! (strlen($nom) >= 1 and strlen($nom) <= 30)) { header('Location: inscription.php?id=13'); return;}

            // VERIF EMAIL
            if (! filter_var($email, FILTER_VALIDATE_EMAIL)) { // Fonction PHP qui vérifie si l'email est valide.
                header('Location: inscription.php?id=11'); // Si l'email n'est pas valide
                return;
            }
            if (! (strlen($email) >= 5 and strlen($email) <= 100)) { header('Location: inscription.php?id=15'); return;}

            // Maintenant que nous sommes certain que les valeurs entrées sont correctes, nous pouvons tenter d'insérer notre utilisateur


            $coUFDroit = mysqli_connect($host, 'fictif_droitDB', $USER_FICTIF_MDP['fictif_droitDB'], $database);

            $id_nouvel_utilisateur = null; // Nous le l'avons pas encore créer

            try {
                executeSQL("INSERT INTO vue_UserFictif_inscriptionDB1 (LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER, HORODATAGE_OUVERTURE_USER) VALUES (?, ?, ?, 'utilisateur', ?, current_timestamp())", array($login, $prenom, $nom, $email), $coUFInscription);

                // A partir de là, on considère qu'on a bien inséré le nouvel utilisateur, on peut donc créer sa session (utilisateur) MariaDB.

                $loginMariaDBProtege = htmlspecialchars($coUFInscription->insert_id); // On protège l'ID du dernier enregistrement inséré par l'UF Inscription.
                $mdpProtege = htmlspecialchars($mdp);
                $create_user_query = "CREATE USER '$loginMariaDBProtege'@localhost IDENTIFIED BY '$mdpProtege';"; // On créer un Utilisateur MariaDB
                mysqli_query($coUFInscription, $create_user_query);

                $req = "GRANT 'role_utilisateur' TO '$loginMariaDBProtege'@'localhost';";
                mysqli_query($coUFDroit, $req);


                // On va connecter temporairement l'utilisateur pour se donner l'autorisation d'activité dès sa connexion son rôle.
                $connexionUtilisateur = mysqli_connect($host, $loginMariaDBProtege, $mdpProtege);
                mysqli_query($connexionUtilisateur, "SET DEFAULT ROLE 'role_utilisateur' FOR CURRENT_USER();");
                $connexionUtilisateur->close();

                $coUFInscription->close(); // L'utilisateur fictif inscription se déconnecte de la base de donnée
                $coUFDroit->close();

            }catch(Exception $e){
                echo $e;
                // Exécution de la requête SQL pour supprimer l'utilisateur s'il existe
                mysqli_query($coUFInscription, "DROP USER IF EXISTS '$id_nouvel_utilisateur'@'localhost';");
                // Note : l'enregistrement dans la table Utilisateur ne peut être retiré

                // Fermer les connexions
                $coUFDroit->close();
                $coUFInscription->close(); // L'utilisateur fictif inscription se déconnecte de la base de donnée
                header('Location: inscription.php?id=6'); // ERREUR : Une erreur interne est survenue, votre compte n'a pas pu être créer.
                return;
            }

            try{
                $res = connectUser($loginMariaDBProtege, $mdpProtege); // Si la connexion au site est possible (= true, false sinon) (mdp valide)
                if(!$res) { header('Location: connexion.php?id=4'); } // ERREUR : Votre compte à été créer, mais vous n'avez pas pu être connecté
                header('Location: ../tableau_bord/tableauBord.php');
            }catch(Exception $e){
                header('Location: connexion.php?id=4'); // ERREUR : Votre compte à été créer, mais vous n'avez pas pu être connecté
                return;
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
