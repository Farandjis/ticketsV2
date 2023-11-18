<?php


function insertRequest($a,$b,$connection){

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


function newUser($login, $mdp){
    $connection = mysqli_connect($host, '' . $login, $mdp, $database);
    $create_user_query = "CREATE USER '$login' IDENTIFIED BY '$mdp';";
    if(mysqli_query($connection, $create_user_query)){
        $requete = "GRANT SELECT ON vue_Utilisateur_client TO '$login';";
        mysqli_query($connection, $requete);
        $requete = "GRANT SELECT ON vue_Ticket_client TO '$login';";
        mysqli_query($connection, $requete);
        $requete = "GRANT UPDATE ON vue_Utilisateur_insertion_client TO '$login';";
        mysqli_query($connection, $requete);
        $requete = "GRANT UPDATE ON vue_Ticket_insertion_client TO '$login';";
        mysqli_query($connection, $requete);
        return true;
    }
    return false;
}


function connectUser($login, $mdp){

    // Vérifie si l'utilisateur existe dans la base de données
    if ($row = mysqli_fetch_row($reponse)) {
        // Connexion à la base de données spécifique à l'utilisateur
        $connexion = mysqli_connect($host, $row[0], $mdp, $database);

        // Vérifie si la connexion a été établie

        if ($connexion) {

            // On récupère l'adresse IP de l'utilisateur
            $ipUtilisateur = gethostbyname($_SERVER['REMOTE_ADDR']);

            // Récupère la date et l'heure à laquelle l'utilisateur s'est connecté la dernière fois
            $dateConnexion = date('Y-m-d H:i:s');

            // On met à jour les colonnes liées à la dernière connexion et l'IP du serveur de l'utilisateur
            insertRequest("UPDATE vue_UserFictif_updateDB1 SET HORODATAGE_DERNIERE_CONNECTION_USER = ?, IP_DERNIERE_CONNECTION_USER = ? WHERE ID_USER = ?",array( $dateConnexion, $ipUtilisateur, $row[0]),$connexion);

            // On démarre la session
            session_start();
            $_SESSION['login'] = $row[0];
            $_SESSION['mdp'] = $mdp;
            return true;
        }
    }
    return false;
}
