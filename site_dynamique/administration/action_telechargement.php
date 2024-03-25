<?php

require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connection = pageAccess(array('Administrateur Site', 'Administrateur Système'));

try{
	if (isset($_POST["tele_arch"]) && !empty($_POST["tele_arch"])){
		if (recupererRoleDe($connection) == 'Administrateur Système'){
			$chemin_fichier = '../../../logs/archives/'.$_POST["tele_arch"];
			if (file_exists($chemin_fichier)) {
    				// Envoyer les en-t�tes HTTP appropri�s pour le t�l�chargement
    				header('Content-Type: application/octet-stream');
   				header('Content-Disposition: attachment; filename="' . basename($chemin_fichier) . '"');
    				header('Content-Length: ' . filesize($chemin_fichier));

    				// Lire le fichier et l'envoyer au client
    				readfile($chemin_fichier);
    				exit;
			}
		}
	}
}catch(Exception $e){
	header('Location: administration.php?id=1');
	return;
}

?>