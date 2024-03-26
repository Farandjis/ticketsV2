<?php

require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connection = pageAccess(array('Administrateur Site'));


try{
	if (isset($_POST["selectionPossible"]) && !empty($_POST["selectionPossible"])){
		$userID = explode(" ",$_POST["selectionPossible"])[0];
		$userID = htmlspecialchars($userID);
        $grantPrivilege = $connection->query("GRANT 'role_technicien' TO '$userID'@localhost;");
        $roleUpdate = $connection->query("CALL activerUnRoleTechOuUtiParAdminWeb($userID, 'role_technicien');");
	}
}
catch(Exception $e){
	header('Location: administration.php?id=10');
}

header('Location: administration.php');
?>