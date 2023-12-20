<?php
require '../ressources/fonctions/PHPfunctions.php';

$connexionUtilisateur = pageAccess(array('Utilisateur', 'Technicien', 'Administrateur Site', 'Administrateur Système'));

session_start();

if (isset($_POST['nature'], $_POST['nivUrg'], $_POST["explication2"])){
    if (!empty($_SESSION['login']) && !empty($_SESSION['mdp']) && !empty($_POST['nature'])) {
        global $host, $database, $USER_FICTIF_MDP;

		$id_ticket = $_POST['id_ticket'];
        $nature = $_POST['nature'];
        $niveauUrgence = $_POST['nivUrg'];
        $explication = $_POST['explication2'];
		
		$infoTicket = mysqli_fetch_array(executeSQL("SELECT etat_ticket, id_technicien FROM vue_tableau_bord WHERE id_ticket = ?;",array($id_ticket),$connexionUtilisateur));
		$etatDuTicket = $infoTicket[0];
		
		// recupererRoleDe($connexionUtilisateur) == 'Utilisateur' || recupererRoleDe($connexionUtilisateur) == 'Administrateur Système' ||

		if (($etatDuTicket == "En attente") && (recupererRoleDe($connexionUtilisateur) != 'Administrateur Site')){
			executeSQL("UPDATE vue_modif_creation_ticket_utilisateur SET OBJET_TICKET = ?,DESCRIPTION_TICKET = ?, NIV_URGENCE_ESTIMER_TICKET = ?, HORODATAGE_DERNIERE_MODIF_TICKET = CURRENT_TIMESTAMP() WHERE ID_TICKET  = ?;", array($nature, $explication, $niveauUrgence, $id_ticket), $connexionUtilisateur);
		}
		
		if (recupererRoleDe($connexionUtilisateur) == 'Technicien' || recupererRoleDe($connexionUtilisateur) == 'Administrateur Site'){
			if (isset($_POST['nivUrg2']) && !empty($_POST['nivUrg2']) && recupererRoleDe($connexionUtilisateur) == 'Administrateur Site'){
				$niveauUrgence2 = $_POST['nivUrg2'];

				executeSQL("UPDATE vue_modif_ticket_adm_tech SET OBJET_TICKET = ?,DESCRIPTION_TICKET = ?, NIV_URGENCE_DEFINITIF_TICKET = ?, ETAT_TICKET = ?,HORODATAGE_DERNIERE_MODIF_TICKET = CURRENT_TIMESTAMP() WHERE ID_TICKET  = ?;", array($nature, $explication, $niveauUrgence2, $etatDuTicket, $id_ticket), $connexionUtilisateur);

				$technicien = $_POST['ch_technicien'];
				if (isset($_POST['ch_technicien']) && !empty($_POST['ch_technicien']) && $technicien != $infoTicket[1]){
					$etatDuTicket = "Ouvert";
					executeSQL("UPDATE vue_associe_ticket_tech SET id_technicien = ?,horodatage_debut_traitement_ticket = current_timestamp() WHERE ID_TICKET = ?;", array($technicien,$id_ticket), $connexionUtilisateur);
				}		 
			}
			else {
				executeSQL("UPDATE vue_modif_ticket_adm_tech SET OBJET_TICKET = ?,DESCRIPTION_TICKET = ?, ETAT_TICKET = ?,HORODATAGE_DERNIERE_MODIF_TICKET = CURRENT_TIMESTAMP() WHERE ID_TICKET  = ?;", array($nature, $explication, $etatDuTicket, $id_ticket), $connexionUtilisateur);
			}
		}
		
		executeSQL("DELETE FROM vue_suppr_rtl_tdb WHERE id_ticket = ?;", array($id_ticket), $connexionUtilisateur);
		if (!empty($_POST['libelle_option'])){
			foreach ($_POST["libelle_option"] as $unLibelle){
				executeSQL('INSERT INTO RelationTicketsLibelles (ID_TICKET, NOM_LIBELLE) VALUES (?, ?)', array($id_ticket, $unLibelle), $connexionUtilisateur);
				echo "*";
			}
		}

        header('Location: tableaudebord.php');
    }
    else{
        header('Location: modificationTicket.php?id=1');
    }
}else{
    header('Location: modificationTicket.php?id=2');
}


