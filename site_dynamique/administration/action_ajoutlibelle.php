<?php

require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connection = pageAccess(array('Administrateur Site'));


if (isset($_POST["ajout_motcle"]) && !empty($_POST["ajout_motcle"])){
	executeSQL("INSERT INTO `MotcleTicket` (`NOM_MOTCLE`) VALUES (?);",array($_POST["ajout_motcle"]),$connection);
}

header('Location: administration.php');
?>