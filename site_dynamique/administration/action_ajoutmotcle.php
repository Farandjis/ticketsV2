<?php

require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connection = pageAccess(array('Administrateur Site'));

try {
	if (isset($_POST["ajout_motcle"]) && !empty($_POST["ajout_motcle"])){
		executeSQL("INSERT INTO `MotcleTicket` (`NOM_MOTCLE`) VALUES (?);",array($_POST["ajout_motcle"]),$connection);
	}
}
catch(Exception $e){
	header('Location: administration.php?id=1');
	return;
}

header('Location: administration.php');
?>