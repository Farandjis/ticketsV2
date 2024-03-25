<?php

require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connection = pageAccess(array('Administrateur Site'));

try {
    if ((!empty($_POST["selectionPossibleDeban"]))) {

        $userID = explode(" ",$_POST["selectionPossibleDeban"])[0]; // On récupère l'ID (valeur du String avant le premier espace)
        executeSQL("UPDATE affiche_utilisateurs_pour_adm_web SET BANNI = 'FALSE' WHERE ID_USER = ?",array($userID),$connection);
        header('Location: administration.php?id=100');
        return;


    } elseif ((!empty($_POST["selectionPossibleBan"]))) {
        $userID = explode(" ",$_POST["selectionPossibleBan"])[0]; // On récupère l'ID (valeur du String avant le premier espace)
        $dateBanJusqua = strtotime($_POST["dateBanJusqua"]); // On récupère le string HTML pour le convertir en Date PHP
        $dateBanJusqua = date('Y-m-d H:i:s', $dateBanJusqua); //On converti la date PHP en date SQL
        executeSQL("UPDATE affiche_utilisateurs_pour_adm_web SET BANNI = 'TRUE', BANNI_JUSQUA = ? WHERE ID_USER = ?",array($dateBanJusqua, $userID),$connection);
        header('Location: administration.php?id=101');
        return;
    } else {
        header('Location: administration.php?id=-101');
        return;
    }
}  catch(Exception $e){
    if ($e->getMessage() == "erreur"){
        header('Location: administration.php?id=' . $e->getCode());
    } else {
        header('Location: administration.php?id=-100');
    }
    return;
}
?>