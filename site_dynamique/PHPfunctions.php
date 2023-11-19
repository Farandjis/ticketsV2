<?php


function insertRequest($a,$b,$connection){
    /**
    * Insère une commande SQL préparée dans la base de données.
    *
    * @param string $a - La requete SQL.
    * @param array $b - La liste des paramètres de la requete.
    * @param mysqli $connection - La connexion à la base de données.
    * @return void
    */
    $CONST_TYPE = array("integer" => 'i', "string" => 's', "boolean" => 'b', "double" => 'd');
    $parameters = array($a,'');
    $requete = mysqli_prepare($connection,$a);
    for ($i=0;i<count($b);i++){
        array_push($parameters, htmlspecialchars($b[$i]));

        $parameters[1] = $parameters[1]."".$CONST_TYPE[gettype(htmlspecialchars($b[i]))];
    }
    call_user_func_array('mysqli_stmt_bind_param',$parameters);
    return mysqli_stmt_execute($requete);
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


function connectUser($reponse, $mdp){
    /**
    * Connecte l'utilisateur à la base de données et lui crée sa session.
    *
    * @param string $reponse L'id de l'utilisateur.
    * @param string $mdp Le mot de passe de l'utilisateur.
    * @return bool Retourne True si la connexion réussit. False sinon.
    */
    // Vérifie si l'utilisateur existe dans la base de données
    if ($reponse) {
        // Connexion à la base de données spécifique à l'utilisateur
        $connexion = mysqli_connect($host, $reponse, $mdp, $database);

        // Vérifie si la connexion a été établie

        if ($connexion) {

            // On récupère l'adresse IP de l'utilisateur
            $ipUtilisateur = gethostbyname($_SERVER['REMOTE_ADDR']);

            // Récupère la date et l'heure à laquelle l'utilisateur s'est connecté la dernière fois
            $dateConnexion = date('Y-m-d H:i:s');

            // On met à jour les colonnes liées à la dernière connexion et l'IP du serveur de l'utilisateur
            insertRequest("UPDATE vue_UserFictif_updateDB1 SET HORODATAGE_DERNIERE_CONNECTION_USER = ?, IP_DERNIERE_CONNECTION_USER = ? WHERE ID_USER = ?",array( $dateConnexion, $ipUtilisateur, $reponse),$connexion);

            // On démarre la session
            session_start();
            $_SESSION['login'] = $reponse;
            $_SESSION['mdp'] = $mdp;
            return true;
        }
    }
    return false;
}
