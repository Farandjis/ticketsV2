<?php
	require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
	
	$connection = pageAccess(array('Utilisateur', 'Technicien', 'Administrateur Site', 'Administrateur Système'));
	if (!isset($_POST["id_ticket"]) || empty($_POST["id_ticket"])){
		header('Location: tableaudebord.php');
	}
	$id_ticket = $_POST["id_ticket"];
	$info_ticket = mysqli_fetch_array(executeSQL("	SELECT id_crea,
													etat_ticket,
													prenom_crea,
													nom_crea,
													horodatage_creation_ticket,
													horodatage_derniere_modif_ticket,
													objet_ticket,
													description_ticket,
													niv_urgence_estimer_ticket,
													niv_urgence_definitif_ticket,
													id_technicien,
													prenom_tech,
													nom_tech
													
													FROM vue_tableau_bord WHERE id_ticket = ?;",array($id_ticket),$connection));
	
	$user_id = mysqli_fetch_array($connection->query("SELECT substring_index(user(),'@',1);"));
	if ($user_id[0] == $info_ticket[0]){
		$connection = pageAccess(array('Utilisateur','Administrateur Système'));
	}
	elseif($user_id[0] == $info_ticket[10]){
		$connection = pageAccess(array('Technicien','Administrateur Site'));
	}
	else{
		$connection = pageAccess(array('Administrateur Site'));
	}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modification de Ticket</title>
    <link rel="stylesheet" href="../ressources/style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../ressources/images/logo_sans_texte.png" type="image/x-icon">
    <script src="../ressources/script/libelle.js"></script>
</head>
<body>
    <header>
        <div class="retour">
            <a href="javascript:window.history.go(-1)"><img src="../ressources/images/fleche_retour.png" alt="bouton retour"> Retour</a>
        </div>
    </header>
    <div class="page_cree-modif_ticket">
        <h1 class="h1Creation">Modification ticket</h1>
        <div role="form" class="formModifTicket formAuthentification formConnexion">
<?php
		echo"
            <div class='informations_ticket'>
                <div class='info-ticket-gauche'>
                <p>ID TICKET : $id_ticket</p>
                <p>ID USER : $info_ticket[0]</p>
                <p>Utilisateur : $info_ticket[2] $info_ticket[3]</p>
                </div>

                <div class='info-ticket-droite'>
                <p>$info_ticket[1]</p>
                <p>Crée le $info_ticket[4]</p>
                <p>Modifié le </p>
                </div>
            </div>
			";
?>
            <form action='action_modificationTicket.php' method='post'>
			    <?php
                if(isset($_GET['id'])) {
                    echo '<div class="erreur"> <p>';
                    if ($_GET['id'] == 1) {
						echo "ERREUR : Des données du formulaire sont manquantes";
						}
                    else if ($_GET['id'] == 2) {
						echo "ERREUR : Veuillez remplir ce formulaire pour modifier un ticket";
					}
                    else { 
						echo "ERREUR : Une erreur est survenue";
					}
                    echo '/p> </div>';
                }
                ?>

                <div class="form-modif-ticket">
                    <div class="champs_ticket_gauche">
                        <label for='login'>Nature du problème *</label><br>
                        <input id='nature' type='text' name='nature' value='<?php echo $info_ticket[6];?>'>

                        <br><br>

                        <label for='explication2'>Explication</label><br>
                        <textarea id="explication2" name="explication2" ><?php 
						echo "$info_ticket[7]";
						?></textarea><br>
                    </div>

                    <div class="champs_ticket_droit">
                        <p>Niveau d'urgence estimé</p>
						<?php
						if (recupererRoleDe($connection) == 'Utilisateur'){
							echo "
							<div class='custom-select'>
							<select name='nivUrg' id='nivUrg' required>
								<option value=''>--Choisir une option--</option>
								<option value='Faible'";
								echo isSelected('Faible',$info_ticket[8]);
								echo " 
								>Faible</option>
								<option value='Moyen'
								";
								echo isSelected('Moyen',$info_ticket[8]);
								echo " 
								>Moyen</option>
								<option value='Important'
								";
								echo isSelected('Important',$info_ticket[8]);
								echo "
								>Important</option>
								<option value='Urgent'
								";
								echo isSelected('Urgent',$info_ticket[8]);
								echo " 
								>Urgent</option>
							</select>
							</div>
							";
						}
						else{
							echo '<input type="hidden" name="nivUrg" value="<?php echo $info_ticket[8]; ?>">';
							echo "<p id='nivUrgEstime'>$info_ticket[8]</p>";
						}
						?>
						<br>
                        <label for='nivUrg2'>Niveau d'urgence définitif</label><br>
						<?php
						if (recupererRoleDe($connection) == 'Administrateur Site'){
							echo "
							<div class='custom-select'>
							<select name='nivUrg2' id='nivUrg2' required>
								<option value=''>--Choisir une option--</option>
								<option value='Faible'";
								echo isSelected('Faible',$info_ticket[9]);
								echo " 
								>Faible</option>
								<option value='Moyen'
								";
								echo isSelected('Moyen',$info_ticket[9]);
								echo " 
								>Moyen</option>
								<option value='Important'
								";
								echo isSelected('Important',$info_ticket[9]);
								echo "
								>Important</option>
								<option value='Urgent'
								";
								echo isSelected('Urgent',$info_ticket[9]);
								echo " 
								>Urgent</option>
							</select>
							</div>
							";
						}
						else{
							echo '<input type="hidden" name="nivUrg2" value="<?php echo $info_ticket[9]; ?>">';
							echo "<p id='nivUrgEstime'>$info_ticket[9]</p>";
						}
						?>

                        <br>
                        <label for='ch_technicien'>Technicien affecté</label><br>
						<?php
						if (recupererRoleDe($connection) == 'Administrateur Site'){
							$liste_technicien = $connection->query('SELECT id_user,prenom_user,nom_user FROM vue_technicien;');
							echo "
							<div class='custom-select'>
								<select name='ch_technicien' id='ch_technicien' required>
									<option value=''>--Choisir une option--</option>
									";
									while ($row = mysqli_fetch_row($liste_technicien)){
										echo "<option value='$row[0]'";
										echo isSelected($row[0],$info_ticket[10]);
										echo "
										>$row[0] $row[1] $row[2]</option>";
									}
									echo "
								</select>
							</div>
							";
						}
						else {
							echo '<input type="hidden" name="ch_technicien" value="<?php echo $info_ticket[10]; ?>">';
							if ($info_ticket[10] == null){
								echo "<p id='nivUrgEstime'>Aucun</p>";
							}
							else{
								echo "<p id='nivUrgEstime'>$info_ticket[10] $info_ticket[11] $info_ticket[12]</p>";
							}
						}
						?>
						<br>

                        <span>Libellé</span><br>
                        <div class="menu_libelle" id="menu_deroulant_libelle">
                            <span class="entete_libelle modif_entete_libelle" onclick="toggleDropdown()">--Liste des libellés--</span>
                            <div class="option_libelle">
								<?php
								$listeLibelle = array();
								$result = executeSQL("SELECT nom_libelle FROM vue_tdb_relation_ticket_libelle WHERE id_ticket = ?",array($id_ticket),$connection);
								while($row = mysqli_fetch_array($result)){
									array_push($listeLibelle,$row[0]);
								}
								menuDeroulantTousLesLibelles($connection,$listeLibelle);
								?>


                            </div>
                        </div>
                    </div>
                </div>
				<input type="hidden" name="id_ticket" value='<?php echo $id_ticket; ?>'>
                <input type='submit' name='modif' value='Modifier le ticket'><br>
            </form>
        </div>
    </div>
</body>
</html>
