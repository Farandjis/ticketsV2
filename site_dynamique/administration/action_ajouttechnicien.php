<?php

require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connection = pageAccess(array('Administrateur Site'));


if (isset($_POST["ajout_libelle"]) && !empty($_POST["ajout_libelle"])){
	executeSQL("INSERT INTO `Libelle` (`NOM_LIBELLE`) VALUES (?);",array($_POST["ajout_libelle"]),$connection);
}

header('Location: administration.php');
?>