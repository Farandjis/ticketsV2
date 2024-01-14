<?php

require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connection = pageAccess(array('Administrateur Site', 'Administrateur Système'));

try{
if (isset($_POST["journal"]) && !empty($_POST["journal"])){
	if (recupererRoleDe($connection) == 'Administrateur Système'){
		if ($_POST["journal"] == "connexion_infructueuse"){
			header('Location: logs/journauxActvCoInf.csv');
		}
		if ($_POST["journal"] == "ouverture_ticket"){
			header('Location: logs/journauxActvCreTck.csv');
		}
		if ($_POST["journal"] == "historique"){
			$result = $connection->query("SELECT HORODATAGE_CREATION_TICKET,HORODATAGE_DERNIERE_MODIF_TICKET,TITRE_TICKET,NIV_URGENCE_DEFINITIF_TICKET,DESCRIPTION_TICKET,ID_USER,ID_TECHNICIEN FROM vue_historique");

			$csvFileName = "logs/temp_historique.csv";
			$csvFile = fopen($csvFileName, 'w');

			$fields = $result->fetch_fields();
			$header = [];
			foreach ($fields as $field) {
				$header[] = $field->name;
			}
			fputcsv($csvFile, $header);
			while ($row = $result->fetch_assoc()) {
				fputcsv($csvFile, $row);
			}
			fclose($csvFile);
			$connection->close();
			header('Location: logs/temp_historique.csv');
		}
	}
}
}
catch(Exception $e){
	header('Location: administration.php?id=1');
	return;
}

?>