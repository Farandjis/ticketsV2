<?php

require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connection = pageAccess(array('Administrateur Système'));


if (isset($_POST["supp_arch"]) && !empty($_POST["supp_arch"])){
	$verif = explode("/",$_POST["supp_arch"])[0];
	if ($verif == "ActvCreTck" || $verif == "ActvCoInf"){
		$redirect = 'Location: administration.php#activite';
	}
	else {
		$redirect = 'Location: administration.php#historique';
	}
} else{
	header('Location: administration.php?id=0');
	return;
}
try{
	$chemin_fichier = "../../../logs/archives/".$_POST["supp_arch"];
	if (file_exists($chemin_fichier)) {
		unlink($chemin_fichier);
	}
}
catch(Exception $e){
	header($redirect);
	return;
}

header($redirect);
?>