<?php

require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connection = pageAccess(array('Administrateur Site'));

try{
	if (isset($_POST["ajout_titre"]) && !empty($_POST["ajout_titre"])){
		executeSQL("INSERT INTO `TitreTicket` (`TITRE_TICKET`) VALUES (?);",array($_POST["ajout_titre"]),$connection);
	}
}
catch(Exception $e){
	header('Location: administration.php?id=1');
	return;
}


header('Location: administration.php');
?>