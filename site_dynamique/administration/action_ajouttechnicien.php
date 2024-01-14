<?php

require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connection = pageAccess(array('Administrateur Site'));


try{
	if (isset($_POST["tech_option"]) && !empty($_POST["tech_option"])){

	$utilisateurs = $connection->query("SELECT ID_USER FROM affiche_utilisateurs_pour_adm_web;");

	$verifPrivilege = $connection->query("SELECT ID_USER FROM vue_technicien");
	$totTechnicien = array();
	while ($tech = mysqli_fetch_row($verifPrivilege)) {
		array_push($totTechnicien,$tech[0]);
	}

	foreach ($totTechnicien as $userID) {
        if (!in_array($userID, $_POST["tech_option"])) {
            $revokePrivilege = $connection->query("REVOKE 'role_technicien' FROM '$userID'@localhost;");
			try {
				$roleUpdate = $connection->query("CALL activerUnRoleTechOuUtiParAdminWeb($userID, 'role_utilisateur');");
			} catch (Exception $e) {
				header('Location: action_ajouttechnicien.php');
			}
        }
    }


	foreach ($_POST["tech_option"] as $userID) {
		$userID = htmlspecialchars($userID);
		$grantPrivilege = $connection->query("GRANT 'role_technicien' TO '$userID'@localhost;");
		$roleUpdate = $connection->query("CALL activerUnRoleTechOuUtiParAdminWeb($userID, 'role_technicien');");
	}
	}
}
catch(Exception $e){
	header('Location: administration.php?id=1');
	return;
}

header('Location: administration.php');
?>