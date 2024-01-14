<?php

require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connection = pageAccess(array('Administrateur Site'));

try{
	if (isset($_POST["motcle_option"]) && !empty($_POST["motcle_option"])){
		foreach($_POST["motcle_option"] as $motcle){
			executeSQL("DELETE FROM `TitreTicket` WHERE TITRE_TICKET = ? ;",array($motcle),$connection);
		}
	}
}
catch(Exception $e){
	header('Location: administration.php?id=1');
	return;
}


header('Location: administration.php');
?>