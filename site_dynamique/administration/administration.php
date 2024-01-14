<?php
require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");

$connection = pageAccess(array('Administrateur Site', 'Administrateur Système'));
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
  <script src="../ressources/script/menuCheckbox.js"></script>
</head>
<body>
<?php affichageMenuDuHaut("administration", $connection);?>

  <h1 class="titre_page">
    Administration
  </h1>
   <?php

	if (recupererRoleDe($connection) == 'Administrateur Site'){
	  echo '
<div class="conteneur_administration_general conteneur_administration">
    <div class="conteneur_ajout_administration">
        <form action="action_ajouttechnicien.php" method="post" name="Ajout Technicien" class="ajout" onsubmit="return confirmerAvantEnvoi(this.name)">
          <label for="ajout_technicien">Gestion de Technicien :</label><br>
          <div class="conteneur_ajout_technicien">
          <div class="menu_checkbox" id="menu_deroulant_checkbox" tabindex="0" onkeydown="toggleDropdown(this)">
            <span class="entete_menu_checkbox modif_entete_checkbox" onclick= toggleDropdown(document.getElementById("menu_deroulant_checkbox"))>--Liste des Utilisateurs--</span>
            <div class="option_checkbox" id="ajout_technicien">';
				
				menuDeroulantTousLesUtilisateurs($connection);
				
			echo '
             </div>
          </div>
          <input type="submit" name="submit_ajout_technicien" value="Modifier">
          </div>
        </form>
		</div>';
		    echo '<div class="conteneur_ajout_administration">
                          <form action="action_ajouttitre.php" method="post" name="Ajout Titre" class="ajout" onsubmit="return confirmerAvantEnvoi(this.name)">
                              <label for="ajout_titre">Ajout de Titre :</label><br><br>
                              <input id="ajout_titre" type="text" name ="ajout_titre" placeholder="Écrire un titre">
                              <input type="submit" name="ajouter_titre" value="Ajouter">
                          </form>

                          <form action="action_supptitre.php" method="post" name="Suppression Titre" class="suppression" onsubmit="return confirmerAvantEnvoi(this.name)">
                              <label>Suppression de Titre :</label><br>

                              <div class="conteneur_administration">
                                  <div class="menu_checkbox" id="menu_deroulant_titre" tabindex="0" onkeydown="toggleDropdown(this)" >
                                      <span class="entete_menu_checkbox" onclick=toggleDropdown(document.getElementById("menu_deroulant_titre"))>Sélectionnez un/des titre(s)</span>
                                      <div class="option_checkbox">';
									  menuDeroulant(mysqli_query($connection, "SELECT TITRE_TICKET FROM TitreTicket"),"checked");

									echo '
                                      </div>

                                  </div>

                                  <input type="submit" name="suppression_titre" value="Supprimer">
                              </div>
                          </form>

                      </div>';

			echo ' 
		    <div class="conteneur_ajout_administration">
      <form action="action_ajoutmotcle.php" method="post" name="Ajout Libelle" class="ajout" onsubmit="return confirmerAvantEnvoi(this.name)">
        <label for="ajout_motcle">Ajout de Mots-clés :</label><br><br>
        <input id="ajout_motcle" type="text" name ="ajout_motcle" placeholder="Écrire un mot-clé">
        <input type="submit" name="submit_ajout_motcle" value="Ajouter">
      </form>
      <form action="action_suppmotcle.php" method="post" name="Suppression Motcle" class="suppression" onsubmit="return confirmerAvantEnvoi(this.name)">
                  <label>Suppression de Mots-clés :</label><br>

                  <div class="conteneur_administration">
                      <div class="menu_checkbox" id="menu_deroulant_libelle" tabindex="0" onkeydown="toggleDropdown(this)" >
                          <span class="entete_menu_checkbox" onclick=toggleDropdown(document.getElementById("menu_deroulant_libelle"))>Sélectionnez un/des mot-clé(s)</span>
                          <div class="option_checkbox">';

						  menuDeroulant(mysqli_query($connection, "SELECT NOM_MOTCLE FROM MotcleTicket"),"checked");

						echo '
                          </div>

                      </div>

                      <input type="submit" name="suppression_motcle" value="Supprimer">
                  </div>
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
				  <th>Titre</th>
				  <th>Niv.Urgence</th>
				  <th>Description</th>
				  <th>ID Utilisateur</th>
				  <th>ID Technicien</th>
				</tr>
				</thead>
				<tbody>
				';
				$historique_res = $connection->query("SELECT DATE_FORMAT(HORODATAGE_CREATION_TICKET, 'le %d/%m/%Y à %Hh%i'),DATE_FORMAT(HORODATAGE_DERNIERE_MODIF_TICKET, 'le %d/%m/%Y à %Hh%i'),TITRE_TICKET,NIV_URGENCE_DEFINITIF_TICKET,DESCRIPTION_TICKET,ID_USER,ID_TECHNICIEN FROM vue_historique");
				tableGenerate($historique_res);
				echo '
				</tbody>
			  </table>
			</div>
		  </div>';
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
					csvToHtmlTable("logs/journauxActvCoInf.csv");
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
					<th>ID Ticket</th>
				  </tr>
				  </thead>
				  <tbody>';
					
					csvToHtmlTable("logs/journauxActvCreTck.csv");
					echo '
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>';
		  
		    echo '<form action="action_telechargement.php" method="post" class="telechargement">
    <label for="journal">Sélection</label><br>

    <div class="custom-select">
      <select name="journal" id="journal">
        <option value="">--Choisir une option--</option>
        <option value="historique">Historique</option>
        <option value="connexion_infructueuse">Connexions infructueuses</option>
        <option value="ouverture_ticket">Ouvertures de tickets</option>

      </select>
    </div>

    <input type="submit" name="Telecharger" value="Télécharger"><br>

  </form>

  <div class="overlay" id="overlay" onclick="closePopup()">
    <!-- Contenu de la pop-up -->

    <div role="form" id="test" class="formAuthentification formConnexion popupInfo">

      <div id="informations_ticket_popup">

      </div>


      <button id="fermer_pop-up" onclick="closePopup()" tabindex="0">x</button>
    </div>


  </div>';
	}
?>

</body>
</html>