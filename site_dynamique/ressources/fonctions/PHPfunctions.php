<?php

// Info BDD
$host = 'localhost';
$database = 'DB_TIX';

function insertRequest($reqSQL,$params,$connection){
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


function valideMDP($a){
    /**
     * Vérifie la solidité du mot de passe.
     *
     * @param string $a Le mot de passe à valider.
     * @return bool Retourne True si le mot de passe est valide. False sinon.
     */
    if (strlen($a) < 12 || strlen($a) > 32) {
        if (!preg_match('/[A-Z]/', $a)) {
            if (!preg_match('/[a-z]/', $a)) {
                if (!preg_match('/[0-9]/', $a)) {
                    if (!preg_match('/[^a-zA-Z0-9]/', $a)) {
                        return true;
                    }
                }
            }
        }
    }
    return false;
}


function newUser($id, $mdp){
    /**
     * Crée un utilisateur et lui fait don de ses droits
     *
     * @param string $id - L'id de l'utilisateur.
     * @param string $mdp - Le mot de passe de l'utilisateur.
     * @return bool - Retourne True si l'utilisateur a pu être créé. False sinon.
     */
    $connection = mysqli_connect($host, '' . $id, $mdp, $database);
    $create_user_query = "CREATE USER '$id' IDENTIFIED BY '$mdp';";
    if(mysqli_query($connection, $create_user_query)){
        $requete = "GRANT SELECT ON vue_Utilisateur_client TO '$id';";
        mysqli_query($connection, $requete);
        $requete = "GRANT SELECT ON vue_Ticket_client TO '$id';";
        mysqli_query($connection, $requete);
        $requete = "GRANT UPDATE ON vue_Utilisateur_insertion_client TO '$id';";
        mysqli_query($connection, $requete);
        $requete = "GRANT UPDATE ON vue_Ticket_insertion_client TO '$id';";
        mysqli_query($connection, $requete);
        return true;
    }
    return false;
}


function connectUser($loginMariaDB, $mdpMariaDB){
    /**
     * Connecte l'utilisateur à la base de données et lui crée sa session.
     *
     * @param string $loginMariaDB L'id de l'utilisateur.
     * @param string $mdpMariaDB Le mot de passe de l'utilisateur.
     * @return bool Retourne True si la connexion réussit. False sinon.
     */
    global $host, $database;
    
    
    
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


	    $connectionUserFictifConnexion = mysqli_connect($host, 'fictif_connexionDB', 't!nt1n_connexionDB45987645', $database);

	
            // On met à jour les colonnes liées à la dernière connexion et l'IP du serveur de l'utilisateur
          
            $arguments = array($dateConnexion, $ipUtilisateur, $loginMariaDB); 
            insertRequest("UPDATE vue_UserFictif_updateDB1 SET HORODATAGE_DERNIERE_CONNECTION_USER = ?, IP_DERNIERE_CONNECTION_USER = ? WHERE ID_USER = ?",$arguments,$connectionUserFictifConnexion); // Insère des infos sur la connexion de l'utilisateur

            // On démarre la session
            session_start();
            $_SESSION['login'] = $loginMariaDB;
            $_SESSION['mdp'] = $mdpMariaDB;


            return true;
        }

    }
    return false;
}

