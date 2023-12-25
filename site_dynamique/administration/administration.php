<?php
require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");

$connection = pageAccess(array('Administrateur Site', 'Administrateur Système'));
	
	
function tableCSV($filename,$colonnes){
	$fp = fopen($filename,"r",True);
	$notHeader = False;
	while($data = fgetcsv($fp,1024,";")){
		if ($notHeader){
			echo "<tr>";
			$n = 0;
			foreach ($data as $cell){
				$n++;
				if (in_array($n,$colonnes)){
					echo "<td>$cell</td>";
				}
			}
			echo "</tr>";
		}
		$notHeader = True;
	}
	fclose($fp);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Administration</title>
  <link rel="stylesheet" href="../ressources/style/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="../ressources/images/logo_sans_texte.png" type="image/x-icon">

  <script src="../ressources/script/infoLigneTab.js"></script>
  <script src="../ressources/script/hamburger.js"></script>
  <script src="../ressources/script/confirmation.js"></script>
</head>
<body>
<?php affichageMenuDuHaut("administration", $connection);?>

  <h1 class="titre_page">
    Administration
  </h1>
   <?php
	/*
	if (recupererRoleDe($connection) == 'Administrateur Site'){
	  echo '
	  <div class="conteneur_administration">
		<div class="conteneur_ajout_administration">
			<form action="#" method="post" name="Ajout Technicien" class="ajout" onsubmit="return confirmerAvantEnvoi(this.name)">
                <span class="entete_motcle modif_entete_motcle" onclick="toggleDropdown()">-- Liste des utilisateurs --</span>
                <div class="option_technicien">';
				
				menuDeroulantTousLesMotcleTickets($connection);
				
			echo '
            <option value="tec_1">Technicien 1</option>
            <option value="tec_2">Technicien 2</option>
          </select>

          <input type="submit" name="ajout_technicien" value="Ajouter">
        </form>
		</div>
		</div>';
	}
	*/

	if (recupererRoleDe($connection) == 'Administrateur Site'){
		echo ' 
		<div class="conteneur_ajout_administration">
		  <form action="action_ajoutmotcle.php" method="post" name="Ajout MotcleTicket" class="ajout" onsubmit="return confirmerAvantEnvoi(this.name)">
			<label for="ajout_motcle">Ajout de Mots-clés :</label><br><br>
			<input id="ajout_motcle" type="text" name ="ajout_motcle" placeholder="Écrire un Mot-clé">
			<input type="submit" name="ajout" value="Ajouter">
		  </form>
		</div>
	  </div>';
	}


	if (recupererRoleDe($connection) == 'Administrateur Système'){
		echo ' 
		  <h1 class="titre_page">
			Historique
		  </h1>
		  <div class="historique">
			<div class="conteneur_table conteneur_table-historique">
			  <table class="table-historique table-popup">
				<thead>
				<tr>
				  <th>Date</th>
				  <th>Date Résolution</th>
				  <th>Objet</th>
				  <th>Niv.Urgence</th>
				  <th>Description</th>
				  <th>ID Utilisateur</th>
				  <th>Technicien</th>
				</tr>
				</thead>
				<tbody>
				';
				$historique_res = $connection->query("SELECT HORODATAGE_CREATION_TICKET,HORODATAGE_DERNIERE_MODIF_TICKET,TITRE_TICKET,NIV_URGENCE_DEFINITIF_TICKET,DESCRIPTION_TICKET,ID_USER,ID_TECHNICIEN FROM vue_historique");
				tableGenerate($historique_res);
				echo '
				</tbody>
			  </table>
			</div>
		  </div>';
	}

	if (recupererRoleDe($connection) == 'Administrateur Système'){
		echo ' 
		  <h1 class="titre_page">
			Journal d\'activité
		  </h1>
		  <div class="activite">
			<div class="connexInfructeurse">
			  <h2>Connexions infructueuses</h2>
			  <div class="conteneur_table conteneur_table-infructueuse_ouverture-tickets">
				<table class="table-infructueuse table-popup">
				  <thead>
				  <tr>
					<th>Date</th>
					<th>Login</th>
					<th>IP</th>
					<th>Tentative</th>
					<th class="ligneCacher">Test</th>
				  </tr>
				  </thead>
				  <tbody>';
					tableCSV("logs/journauxActvCoInf.csv",array(1,2,3,4));
					echo '
				  </tr>
				  </tbody>
				</table>
			  </div>
			</div>

			<div class="ouvertureTickets">
			  <h2>Ouvertures de tickets</h2>
			  <div class="conteneur_table conteneur_table-infructueuse_ouverture-tickets">
				<table class="table-ouverture-tickets table-popup">
				  <thead>
				  <tr>
					<th>Date</th>
					<th>Login</th>
					<th>IP</th>
					<th>Niv.Urgence</th>
				  </tr>
				  </thead>
				  <tbody>';
					
					tableCSV("logs/journauxActvCreTck.csv",array(1,2,3,4));
					echo '
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>';
	}
?>
  <form action='action_telechargement.php' method='post' class="telechargement">
    <label for='journal'>Sélection</label><br>

    <div class="custom-select">
      <select name="journal" id="journal">
        <option value="">--Choisir une option--</option>
        <option value="historique">Historique</option>
        <option value="connexion_infructueuse">Connexions infructueuses</option>
        <option value="ouverture_ticket">Ouvertures de tickets</option>

      </select>
    </div>

    <input type='submit' name='Telecharger' value='Télécharger'><br>

  </form>

  <div class="overlay" id="overlay" onclick="closePopup()">
    <!-- Contenu de la pop-up -->

    <div role="form" id="test" class="formAuthentification formConnexion popupInfo">

      <div id="informations_ticket_popup">

      </div>

      <form action='modificationTicket.html' method='post'>

        <input type='submit' name='modif' value='Modifier le ticket'><br>
      </form>

      <button id="fermer_pop-up" onclick="closePopup()" tabindex="0">x</button>
    </div>


  </div>


</body>
</html>