<?php

require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connection = pageAccess(array('Administrateur Site'));


try{
	if (isset($_POST["selectionPossible"]) && !empty($_POST["selectionPossible"])){
		$userID = explode(" ",$_POST["selectionPossible"])[0];
		$userID = htmlspecialchars($userID);
        	$revokePrivilege = $connection->query("REVOKE 'role_technicien' FROM '$userID'@localhost;");		
		try {
                	$roleUpdate = $connection->query("CALL activerUnRoleTechOuUtiParAdminWeb($userID, 'role_utilisateur');");
            	} catch (Exception $e) {
                	header('Location: action_supptechnicien.php');
		}
	}
}
catch(Exception $e){
	header('Location: administration.php?id=1');
	return;
}

header('Location: administration.php');
?>