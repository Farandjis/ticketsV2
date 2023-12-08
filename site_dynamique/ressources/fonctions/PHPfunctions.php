<?php

// Info BDD

require (dirname(__FILE__) . "/../info_db/connexion_db.php");
require (dirname(__FILE__) . "/../info_db/user_fictif.php");

$empSite = "/nouveau";

function connectUser($loginMariaDB, $loginSite, $mdpMariaDB){
    /**
     * Connecte l'utilisateur à la base de données et lui crée sa session.
     *
     * @param string $loginMariaDB L'id de l'utilisateur.
     * @param string $loginSite Le login utilisé lors de la correction de l'utilisateur
     * @param string $mdpMariaDB Le mot de passe de l'utilisateur.
     * @return bool Retourne True si la connexion réussit. False sinon.
     */
    global $host, $database, $USER_FICTIF_MDP;
    
    
    
    // Vérifie si l'utilisateur existe dans la base de données
    if ($loginMariaDB) { // true si le $loginMariaDB contient quelque chose

        // Connexion à la base de données en tant que l'utilisateur
        $connexionUtilisateur = mysqli_connect($host, $loginMariaDB, $mdpMariaDB, $database);

        // Vérifie si la connexion a été établie (donc que le mdp est valide (et l'id aussi, mais normalement ça c'est OK))
        if ($connexionUtilisateur) {

            // On récupère l'adresse IP de l'utilisateur
            $ipUtilisateur = gethostbyname($_SERVER['REMOTE_ADDR']);

            // Récupère la date et l'heure à laquelle l'utilisateur s'est connecté la dernière fois
            $dateConnexion = date('Y-m-d H:i:s');

	       $connectionUserFictifConnexion = mysqli_connect($host, 'fictif_connexionDB', $USER_FICTIF_MDP['fictif_connexionDB'], $database);

	
            // On met à jour les colonnes liées à la dernière connexion et l'IP du serveur de l'utilisateur
          
            $arguments = array($dateConnexion, $ipUtilisateur, $loginMariaDB);
            executeSQL("UPDATE UserFictif_updateDB1 SET HORODATAGE_DERNIERE_CONNECTION_USER = ?, IP_DERNIERE_CONNECTION_USER = ? WHERE ID_USER = ?",$arguments,$connectionUserFictifConnexion); // Insère des infos sur la connexion de l'utilisateur

            // On démarre la session
            session_start();
            $_SESSION['login'] = $loginSite;
            $_SESSION['mdp'] = $mdpMariaDB;

            return true;
        }
    }
    return false;
}

function executeSQL($reqSQL,$params,$connection){
    /**
     * Insère une commande SQL préparée dans la base de données.
     *
     * @param string $reqSQL - La requete SQL.
     * @param array $params - La liste des paramètres de la requete.
     * @param mysqli $connection - La connexion à la base de données.
     * @return void
     */
    $CONST_TYPE = array("integer" => 'i', "string" => 's', "boolean" => 'b', "double" => 'd');
    
    $reqSQLPre = mysqli_prepare($connection,$reqSQL); // On prépare la requête
    $argsCommandePHP = array($reqSQLPre,''); // liste des arguments de la fonction mysqli_stmt_bind_param
    
    $typeParams = "";

    
    for ($i = 0 ; $i < count($params) ; $i++){
    	$params[$i] = htmlspecialchars($params[$i]); // On protège chaque paramètre

	$argsCommandePHP[$i + 2] = &$params[$i]; // On l'insère à la suite des arguments pour la fonction mysqli_stmt_bind_param
        $typeParams = $typeParams . $CONST_TYPE[gettype(htmlspecialchars($params[$i]))]; // On stock le type du paramètre

    }
    $argsCommandePHP[1] = $typeParams; // On indique le type des paramètres précédements protégés


    call_user_func_array('mysqli_stmt_bind_param',$argsCommandePHP); // On appel la fonction mysqli_stmt_bind_param avec nos arguments
    //call_user_func_array('mysqli_stmt_bind_param',array($reqSQLPre, $typeParams, &$paramsCommandePHP[2]));


    mysqli_stmt_execute($reqSQLPre); // On l'execute

    return mysqli_stmt_get_result($reqSQLPre); // On renvoie le résultat de la requête SQL

}


function valideMDP($mdp){
    /**
     * Vérifie la solidité du mot de passe.
     *
     * @param string $mdp Le mot de passe à valider.
     * @return int Retourne 1 si le mot de passe est valide. 0 si pb taille, -1 à -4 si pb caractère (voir les commentaires)
     */
    if (strlen($mdp) >= 12 and strlen($mdp) <= 32) { // entre 12 et 32 caractères compris uniquement
        if (preg_match('/[A-Z]/', $mdp)) { // doit contenir au moins une majuscule
            if (preg_match('/[a-z]/', $mdp)) { // doit contenir au moins une minuscule
                if (preg_match('/[0-9]/', $mdp)) { // doit contenir au moins un chiffre
                    if (preg_match('/[^a-zA-Z0-9]/', $mdp)) { // doit contenur un caractère spécial
                        return 1; // mdp valide
                    } else { return -4; } // manque caractère spécial
                } else { return -3; } // manque chiffre
            } else { return -2; } // manque min
        } else { return -1; } // manque maj
    } else { return 0; } // pb taille
}

function recupererRoleDe($connexion){
    /**
     * Récupère le rôle associé à l'utilisateur
     * @param string $utilisateur - La connexion à la base de donnée
     * @return string - Le rôle de l'utilisateur associé à la connexion
     */

     $rolebrute = mysqli_fetch_row(mysqli_query($connexion, "SELECT CURRENT_ROLE();"))[0];

     if ($rolebrute == 'role_utilisateur') { return "Utilisateur"; }
     else if ($rolebrute == 'role_technicien') { return "Technicien"; }
     else if ($rolebrute == 'role_admin_web') { return "Administrateur Site"; }
     else if ($rolebrute == 'role_admin_sys') { return "Administrateur Système"; }
     else if ($rolebrute == NULL) { return "Rôle manquant"; }
     else { return "Rôle inconnu"; }
}

function tableGenerate($getResultSQL){
    /**
     * Présente sous forme d'un tableau HTML (sans balises <table>) le résultat d'une requête MySQL de type SELECT.
     *
     * @param mysqli_result $getResultSQL - le mysqli_stmt_get_result de l'exécution de la requête, le tableau sera généré là dessus.
     * @return void
     */

    while($enregistrements = mysqli_fetch_row($getResultSQL)){
        echo '<tr>';
        for ($noAttributRes = 0; $noAttributRes < count($enregistrements); $noAttributRes++){
            echo '<td>' . $enregistrements[$noAttributRes] . '</td>';
        }
        echo '</tr>';
    }
}

function valideEMAIL($email){
    /**
     * Test de la validité de l'adresse email
     * @param $email -> Email dont on va vérifier sa conformité
     * @return bool  -> True si valide, false sinon
     */

    // echo htmlspecialchars($email); echo "<br>";
    if (! filter_var($email, FILTER_VALIDATE_EMAIL)){
        // Fonction de base vérifiant le format
        return false;
    }
    elseif (substr($email, -2, 1) == "."){
        // S'il y a un point à l'avant dernier caractère, cela veut dire que le DNS est trop court (1 caractère)
        return false;
    }
    elseif (!strpos(substr($email, -6, 6), ".")){
        // S'il n'y a pas de point sur les 4 derniers caractères, alors le DNS est trop long (plus de 4 caractères).
        // Remarque +2 car il doit vérifier que dans la chaîne il y ai un point et un caractère avant le point (je ne sais pas pourquoi)
        // ex : o.frrr  ou oo.frr -> ok (il y a le . et un caractère avant)
        // ex : .frrrr -> ko (absence de caractère avant le .)
        // ex : frrrrr -> ko (pas de .)
        return false;
    }
    else {
        return true;
    }
}


function operationCAPTCHA()
{
    /**
     * Affiche un champs de formulaire servant de captcha.
     * Ce captcha est un calcul dont le résultat est enregistré sur ...
     */
    $chiffre1 = rand(-20, 20);
    $chiffre2 = rand(-20, 20);
    $operateur = array("+", "*")[rand(0, 1)];
    if ($operateur == "+") {
        $res = $chiffre1 + $chiffre2;
	}
	else{
		$res = $chiffre1 * $chiffre2;
	}
	$calcul = strval($chiffre1).$operateur.strval($chiffre2);
	echo "<input id='capcha' type='text' name ='capcha' placeholder=$calcul>";
}


function dechiffre($mdpchiffre){
    /**
     * Cette fonction ne déchiffre rien pour le moment.
     */
    return $mdpchiffre;
}

function miseAJourJeton($loginSite, $mdpMariaDBClair){
    /**
     * Fonction par encore conçus et non utilisé.
     * L'idée serait de redonner du temps avant l'expiration de la session de l'Utilisateur.
     * Pour cela, on remet à jour le jeton associé à la connexion et placé dans un endroit dans la BD dédié aux connexions par ex.
     * Donc on rechiffre le mdp et on remet à jour le fichier session aussi.
     *
     */
    return;
}

function verifJeton(){
    /**
     * Fonction qui testera si la connexion de l'utilisateur a expiré ou pas
     * renvoi true si à jour
     * renvoi false si dépassé
     */
    return true;
}

// A TERMINER + MANQUE TRY
function pageAccess($listeDesRolesAutoriser){
    /**
     * Récupère, déchiffre et vérifie le login et le mot de passe puis tente une connexion à la base de données avec ces informations.
     * Il vérifie par la suite le rôle de l'utilisateur.
     * S'il y a les informations nécessaire et les droits d'accès à la page, la fonction renvoi sa connexion mysqlMariaDB, false sinon
     *
     * Renvoie la connxion si l'utilisateur est autorisé à accéder à cette page.
     *
     * @param array $listeDesRolesAutoriser -> Liste des rôles qui sont autorisés à accéder à la page
     * @return mysqli -> Succès de l'accès à la page
     * @return false  -> Echec de l'accès à la page
     */

    global $USER_FICTIF_MDP, $database, $host, $empSite;
    session_start();

    if (isset($_SESSION['login'], $_SESSION['mdp'])){
        // Vérifie que le login et le mot de passe est bien définit

        if (!empty($_SESSION['login']) && !empty($_SESSION['mdp'])){
            // Vérifie que ce n'est pas vide


            // VÉRIFICATION DE LA VALIDITÉ DU JETON
            if (! verifJeton()){
                header("Location: " . $empSite . "/authentification/connexion.php?id=7"); // erreur : le jeton de connexion a expiré
                session_abort();
                return false;
            }


            // RECUPERATION DES DONNEES DU COOKIE SESSION
            $loginSite = htmlspecialchars(htmlspecialchars_decode($_SESSION['login']));
            $mdpMariaDB = htmlspecialchars(htmlspecialchars_decode(dechiffre($_SESSION['mdp']))); // On vire le htmlspecialchars d'avant pour le refaire (mesure de protection)



            // RECUPERATION DE L'ID_USER DE L'UTILISATEUR PAR RAPPORT A SON LOGIN
            $connexionUFConnect = mysqli_connect($host, 'fictif_connexionDB', $USER_FICTIF_MDP['fictif_connexionDB'], $database);
            $resSQL = mysqli_fetch_row(executeSQL("SELECT ID_USER FROM UserFictif_connexionDB1 WHERE login_user = ?", array($loginSite), $connexionUFConnect));
            mysqli_close($connexionUFConnect);

            if ($resSQL === null){ return false; } // Mauvais login (la requête SQL n'a rien renvoyé)
            else { $loginMariaDB = $resSQL[0]; } // On récupère l'ID_USER qui est le login MariaDB.



            // TENTATIVE DE CONNEXION DE L'UTILISATEUR A LA BASE DE DONNEES
            $connexionUtilisateur = mysqli_connect($host, $loginMariaDB, $mdpMariaDB, $database);
            if ($connexionUtilisateur){
                // CONNEXION DE L'UTILISATEUR A LA PLATEFORME POSSIBLE



                // VERIFICATION SI L'UTILISATEUR A LE DROIT D'ACCEDER A LA PAGE
                $roleUtilisateur = recupererRoleDe($connexionUtilisateur);
                if (in_array($roleUtilisateur, $listeDesRolesAutoriser)){

                    miseAJourJeton($loginSite, $mdpMariaDB);
                    session_abort();
                    return $connexionUtilisateur;

                }
            }
        }
    }

    header("Location: " . $empSite . "/erreurs/403.html");
    session_abort();
    return false;
}