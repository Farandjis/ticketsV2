<?php

require '../ressources/fonctions/PHPfunctions.php';
global $host, $database, $USER_FICTIF_MDP; // Viennent de connexion_db.php (importé grâce à PHPfunctions.php)

if (! isset($_SESSION["login"], $_SESSION["mdp"], $_SESSION["verifMdp"], $_SESSION["nom"], $_SESSION["prenom"], $_SESSION["email"])) {
    session_destroy();
}
session_start();


// operationCAPTCHA();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['captcha'])) {
    $reponseUtilisateur = $_POST['captcha'];

    if (!empty($reponseUtilisateur)) {
        $estValideCAPTCHA = verifyCAPTCHA($reponseUtilisateur, $_SESSION['chiffre1'], $_SESSION['chiffre2']);

        if (!$estValideCAPTCHA) {
            $_SESSION['preLogin'] = $_POST['login'];
            $_SESSION['nom'] = $_POST['nom'];
            $_SESSION['prenom'] = $_POST['prenom'];
            $_SESSION['email'] = $_POST['email'];
            header('Location: inscription.php?id=16'); // ERREUR : Captcha incorrect.
            return;
        }
    } else {
        $_SESSION['preLogin'] = $_POST['login'];
        $_SESSION['nom'] = $_POST['nom'];
        $_SESSION['prenom'] = $_POST['prenom'];
        $_SESSION['email'] = $_POST['email'];
        header('Location: inscription.php?id=17'); // ERREUR : La case CAPTCHA doit être remplie.
        return;
    }
}

if (isset($_POST['login'], $_POST['mdp'], $_POST['verifMdp'], $_POST['nom'], $_POST['prenom'], $_POST['email'])) {
    if (!empty($_POST['login']) & !empty($_POST['mdp']) & !empty($_POST['verifMdp']) & !empty($_POST['nom']) & !empty($_POST['prenom']) & !empty($_POST['email'])) {
        if ($_POST['mdp'] == $_POST['verifMdp']) {
            $login = htmlspecialchars($_POST['login']); $mdp = htmlspecialchars($_POST['mdp']); $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']); $email = htmlspecialchars($_POST['email']);

            $coUFInscription = mysqli_connect($host, 'fictif_inscriptionDB', $USER_FICTIF_MDP['fictif_inscriptionDB'], $database);

            // Avant de faire quoique ce soit, on fait des vérifications

            // VERIF LOGIN
            $coUFConnexion = mysqli_connect($host, 'fictif_connexionDB', $USER_FICTIF_MDP['fictif_connexionDB'], $database);
            $res = mysqli_fetch_row(executeSQL("SELECT COUNT(LOGIN_USER) FROM UserFictif_connexion WHERE LOGIN_USER = ?", array($login), $coUFConnexion))[0];
            if ($res == 1) { // login déjà présent dans la BD
                $_SESSION['preLogin'] = $_POST['login'];
                $_SESSION['nom'] = $_POST['nom'];
                $_SESSION['prenom'] = $_POST['prenom'];
                $_SESSION['email'] = $_POST['email'];
                $coUFInscription->close(); $coUFConnexion->close();
                header('Location: inscription.php?id=7'); return; // ERREUR : Le login est déjà utilisé.
            } else { $coUFConnexion->close(); }
            if (! (strlen($login) >= 5 and strlen($login) <= 30)) {
                $_SESSION['preLogin'] = $_POST['login'];
                $_SESSION['nom'] = $_POST['nom'];
                $_SESSION['prenom'] = $_POST['prenom'];
                $_SESSION['email'] = $_POST['email'];
                header('Location: inscription.php?id=14');
                return;
            }

            // VERIF MDP
            $resvalidemdp = valideMDP($mdp);
            if ($resvalidemdp == 0){
                $_SESSION['preLogin'] = $_POST['login'];
                $_SESSION['nom'] = $_POST['nom'];
                $_SESSION['prenom'] = $_POST['prenom'];
                $_SESSION['email'] = $_POST['email'];
                header('Location: inscription.php?id=8a');
                return;
            } // ERREUR : Mot de passe invalide taille
            if ($resvalidemdp == -1){
                $_SESSION['preLogin'] = $_POST['login'];
                $_SESSION['nom'] = $_POST['nom'];
                $_SESSION['prenom'] = $_POST['prenom'];
                $_SESSION['email'] = $_POST['email'];
                header('Location: inscription.php?id=8b');
                return;
            } // manque maj
            if ($resvalidemdp == -2){
                $_SESSION['preLogin'] = $_POST['login'];
                $_SESSION['nom'] = $_POST['nom'];
                $_SESSION['prenom'] = $_POST['prenom'];
                $_SESSION['email'] = $_POST['email'];
                header('Location: inscription.php?id=8c');
                return;
            } // manque min
            if ($resvalidemdp == -3){
                $_SESSION['preLogin'] = $_POST['login'];
                $_SESSION['nom'] = $_POST['nom'];
                $_SESSION['prenom'] = $_POST['prenom'];
                $_SESSION['email'] = $_POST['email'];
                header('Location: inscription.php?id=8d');
                return;
            } // manque chiffre
            if ($resvalidemdp == -4){
                $_SESSION['preLogin'] = $_POST['login'];
                $_SESSION['nom'] = $_POST['nom'];
                $_SESSION['prenom'] = $_POST['prenom'];
                $_SESSION['email'] = $_POST['email'];
                header('Location: inscription.php?id=8e');
                return;
            } // manque caractère spécial

            // VERIF PRENOM
            $pattern = '/^[A-Za-zÀ-ÖØ-öø-ÿ\-]+$/u'; // "u" indique qu'il faut utilisé UTF-8. Il autorise uniquement les caractères alphabêtique, les accents et les tirets
            if (! preg_match($pattern, $prenom)){
                $_SESSION['preLogin'] = $_POST['login'];
                $_SESSION['nom'] = $_POST['nom'];
                $_SESSION['prenom'] = $_POST['prenom'];
                $_SESSION['email'] = $_POST['email'];
                header('Location: inscription.php?id=9');
                return;
            }
            if (! (strlen($prenom) >= 1 and strlen($prenom) <= 30)) {
                $_SESSION['preLogin'] = $_POST['login'];
                $_SESSION['nom'] = $_POST['nom'];
                $_SESSION['prenom'] = $_POST['prenom'];
                $_SESSION['email'] = $_POST['email'];
                header('Location: inscription.php?id=12');
                return;
            }

            // VERIF NOM
            $pattern = '/^[A-Za-zÀ-ÖØ-öø-ÿ\-\s]+$/u'; // de même que pour prénom mais l'espace est autorisé en plus
            if (! preg_match($pattern, $nom)){
                $_SESSION['preLogin'] = $_POST['login'];
                $_SESSION['nom'] = $_POST['nom'];
                $_SESSION['prenom'] = $_POST['prenom'];
                $_SESSION['email'] = $_POST['email'];
                header('Location: inscription.php?id=10');
                return;
            }
            if (! (strlen($nom) >= 1 and strlen($nom) <= 30)) {
                $_SESSION['preLogin'] = $_POST['login'];
                $_SESSION['nom'] = $_POST['nom'];
                $_SESSION['prenom'] = $_POST['prenom'];
                $_SESSION['email'] = $_POST['email'];
                header('Location: inscription.php?id=13');
                return;
            }

            // VERIF EMAIL
            if (! valideEMAIL($email)) { // Vérification que l'email est valide.
                $_SESSION['preLogin'] = $_POST['login'];
                $_SESSION['nom'] = $_POST['nom'];
                $_SESSION['prenom'] = $_POST['prenom'];
                $_SESSION['email'] = $_POST['email'];
                header('Location: inscription.php?id=11'); // Si l'email n'est pas valide
                return;
            }
            if (! (strlen($email) >= 5 and strlen($email) <= 100)) {
                $_SESSION['preLogin'] = $_POST['login'];
                $_SESSION['nom'] = $_POST['nom'];
                $_SESSION['prenom'] = $_POST['prenom'];
                $_SESSION['email'] = $_POST['email'];
                header('Location: inscription.php?id=15');
                return;}

            // Maintenant que nous sommes certain que les valeurs entrées sont correctes, nous pouvons tenter d'insérer notre utilisateur


            $coUFDroit = mysqli_connect($host, 'fictif_droitDB', $USER_FICTIF_MDP['fictif_droitDB'], $database);

            $id_nouvel_utilisateur = null; // Nous le l'avons pas encore créer

            try {
                executeSQL("INSERT INTO UserFictif_inscription (LOGIN_USER, PRENOM_USER, NOM_USER, EMAIL_USER) VALUES (?, ?, ?, ?)", array($login, $prenom, $nom, $email), $coUFInscription);

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

                $_SESSION['preLogin'] = $_POST['login'];
                $_SESSION['nom'] = $_POST['nom'];
                $_SESSION['prenom'] = $_POST['prenom'];
                $_SESSION['email'] = $_POST['email'];

                header('Location: inscription.php?id=6'); // ERREUR : Une erreur interne est survenue, votre compte n'a pas pu être créer.
                return;
            }

            try{
                $res = connectUser($loginMariaDBProtege, $login, $mdpProtege); // Si la connexion au site est possible (= true, false sinon) (mdp valide)
                if(!$res) { header('Location: connexion.php?id=4'); return;} // ERREUR : Votre compte à été créer, mais vous n'avez pas pu être connecté
                header('Location: ../tableau_bord/tableaudebord.php'); return;
            }catch(Exception $e){
                $_SESSION['preLogin'] = $_POST['login'];
                $_SESSION['nom'] = $_POST['nom'];
                $_SESSION['prenom'] = $_POST['prenom'];
                $_SESSION['email'] = $_POST['email'];
                header('Location: connexion.php?id=4'); // ERREUR : Votre compte à été créer, mais vous n'avez pas pu être connecté
                return;
            }

        } else {
            $_SESSION['preLogin'] = $_POST['login'];
            $_SESSION['nom'] = $_POST['nom'];
            $_SESSION['prenom'] = $_POST['prenom'];
            $_SESSION['email'] = $_POST['email'];
            header('Location: inscription.php?id=3'); return;
        }
    } else {
        $_SESSION['preLogin'] = $_POST['login'];
        $_SESSION['nom'] = $_POST['nom'];
        $_SESSION['prenom'] = $_POST['prenom'];
        $_SESSION['email'] = $_POST['email'];
        header('Location: inscription.php?id=2'); return;
    }
} else {
    $_SESSION['preLogin'] = $_POST['login'];
    $_SESSION['nom'] = $_POST['nom'];
    $_SESSION['prenom'] = $_POST['prenom'];
    $_SESSION['email'] = $_POST['email'];
    header('Location: inscription.php?id=1'); return;
}
