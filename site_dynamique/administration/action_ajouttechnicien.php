<?php

require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connection = pageAccess(array('Administrateur Site'));

if (isset($_POST["tech_option"]) && !empty($_POST["tech_option"])){
	foreach ($_POST["tech_option"] as $userID) {
		echo $userID;
		$userID = htmlspecialchars($userID);
		$grantPrivilege = $connection->query("GRANT 'role_technicien' TO '$userID'@localhost;");
		$roleUpdate = $connection->query("CALL activerUnRoleTechOuUtiParAdminWeb($userID, 'role_technicien');");
	}
	
	$totTechnicien = $connection->query("SELECT ID_USER FROM affiche_utilisateurs_pour_adm_web;");
	while ($row = mysqli_fetch_row($totTechnicien)) {
	$userID = $row[0];
		if (!(in_array($userID,$_POST["tech_option"]))){
			$roleUpdate = $connection->query("CALL activerUnRoleTechOuUtiParAdminWeb($userID, 'role_utilisaeur');");
		}
	}
}

header('Location: administration.php');
?>
