<?php
global $technicien;
global $infoTicket;
global $etatDuTicket;
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
													DATE_FORMAT(HORODATAGE_CREATION_TICKET, ' %d/%m/%Y à %Hh%i'),
													DATE_FORMAT(horodatage_derniere_modif_ticket, ' %d/%m/%Y à %Hh%i'),
													TITRE_TICKET,
													description_ticket,
													niv_urgence_estimer_ticket,
													niv_urgence_definitif_ticket,
													id_technicien,
													prenom_tech,
													nom_tech
													FROM vue_tableau_bord WHERE id_ticket = ?;",array($id_ticket),$connection));

// (TOUT LE MONDE) TRUE si ticket en attente de l'utilisateur
$modifPossibleUti = (boolean)mysqli_fetch_row(executeSQL("SELECT COUNT(ID_TICKET) FROM vue_modif_creation_ticket_utilisateur WHERE ID_TICKET = ?;", array($id_ticket), $connection))[0];

if (in_array(recupererRoleDe($connection), array("Technicien", "Administrateur Site"))) {
    $modifPossibleAdmTech = (boolean)mysqli_fetch_row(executeSQL("SELECT COUNT(ID_TICKET) FROM vue_modif_ticket_adm_tech WHERE ID_TICKET = ?;", array($id_ticket), $connection))[0];

}
if(! ($modifPossibleUti or $modifPossibleAdmTech)){ // TRUE (avec ! -> False) s'il est modifiable par le technicien, l'utilisateur ou l'administrateur faisant la demande
    pageAccess(array()); // A remplacer par un vrai truc au propre mais c'est juste pour que ça fonctionne
}




/*
	// $echo var_dump(array($info_ticket[0],$user_id[0]));
	// return;
	if ($info_ticket[0] == $user_id[0] && $info_ticket[1] == "En attente"){
		$connection = pageAccess(array('Utilisateur','Administrateur Système','Technicien','Administrateur Site'));
	}
	elseif($user_id[0] == $info_ticket[10]){
		$connection = pageAccess(array('Technicien','Administrateur Site'));
	}
	else{
		$connection = pageAccess(array('Administrateur Site'));
	}
*/
//$user_id = array_merge(mysqli_fetch_array($connection->query("SELECT substring_index(user(),'@',1);")),mysqli_fetch_array($connection->query("SELECT prenom_user, nom_user FROM vue_Utilisateur_client;")));
$user_id = mysqli_fetch_array($connection->query("SELECT id_user, prenom_user, nom_user FROM vue_Utilisateur_client;"));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modification de Ticket</title>
    <link rel="stylesheet" href="../ressources/style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../ressources/images/logo_sans_texte.png" type="image/x-icon">
    <script src="../ressources/script/menuCheckbox.js"></script>
</head>
<body>
<header>
    <div class="retour">
        <a href="javascript:window.history.go(-1)"><img src="../ressources/images/fleche_retour.png" alt="bouton retour"> Retour</a>
    </div>
</header>
<div class="page_cree-modif_ticket">
    <h1 class="h1Creation">Modification du Ticket</h1>
    <div role="form" class="formModifTicket formAuthentification formConnexion">
        <?php
        if(isset($_POST['id'])) {
            echo '<div class="erreur">';
            echo '<p>';
            if ($_POST['id'] == 1) { echo "ERREUR : Des données du formulaire sont manquantes"; }
            else if ($_POST['id'] == 2) { echo "ERREUR : Des données essentielles du formulaire sont manquantes ou incohérentes"; }
            else if ($_POST['id'] == 4) { echo "ERREUR : Le niveau d'urgence est pas complété "; }
            else if ($_POST['id'] == 99) { echo "ERREUR : Impossible de fermer le ticket, vous n'avez pas les droits ou il est déjà fermé."; }
            else { echo "ERREUR : Une erreur est survenue"; }
            echo '</p>';
            echo '</div>';
        }
        ?>
        <?php
        echo "
            <div class='informations_ticket'>
                <div class='info-ticket-gauche'>
                <p>ID TICKET : $id_ticket</p>";
        if (recupererRoleDe($connection) == 'Utilisateur' || recupererRoleDe($connection) == 'Administrateur Système'){
            echo "
					<p>ID USER : $user_id[0]</p>
					<p>Utilisateur : $user_id[1] $user_id[2]</p>";
        }
        else{
            echo "
					<p>ID USER : $info_ticket[0]</p>
					<p>Utilisateur : $info_ticket[2] $info_ticket[3]</p>";
        }
        echo "
                </div>

                <div class='info-ticket-droite'>
                <p>$info_ticket[1]</p>
                <p>Crée le $info_ticket[4]</p>
                <p>Modifié le $info_ticket[5]</p>
                </div>
            </div>
			";
        ?>
        <form action='action_modificationTicket.php' method='post'>
            <div class="form-modif-ticket">
                <div class="champs_ticket_gauche">
                    <label for='titre'>Titre du problème</label><br>
                    <div class="custom-select">
                        <select name="titre" id="titre" class="creer_select" required>
                            <?php
                            $resSQL = mysqli_query($connection, "SELECT TITRE_TICKET FROM `TitreTicket` ORDER BY TITRE_TICKET ASC;");
                            menuDeroulant($resSQL, "selected", array($info_ticket[6]))
                            ?>
                        </select>
                    </div>
                    <br><br>

                    <label for='explication2'>Description du problème</label><br>
                    <textarea id="explication2" name="explication2" minlength="5" maxlength="250" placeholder="Expliquez ici votre problème. N'oubliez pas d'associer au moins un mot-clé à votre ticket."><?php
                        echo "$info_ticket[7]";
                        ?></textarea><br>
                </div>

                <div class="champs_ticket_droit">
                    <p>Niveau d'urgence estimé</p>
                    <?php
                    // recupererRoleDe($connection) == 'Utilisateur'
                    // $user_id[0] == $info_ticket[0] && $info_ticket[1] == "En attente"

                    if ($modifPossibleUti){
                        echo "
							<div class='custom-select'>
							<select name='nivUrg' id='nivUrg' required>
							";
						$resSQL = mysqli_query($connection, "SELECT VALEUR_URGENCE_TICKET FROM `UrgenceTicket` WHERE IMPORTANCE_URGENCE != '999' ORDER BY IMPORTANCE_URGENCE DESC;");
                        menuDeroulant($resSQL, "selected", array($info_ticket[8]));
                        echo "
							</select>
							</div>
							";
                    }
                    else{
                        echo '<input type="hidden" id="nivUrg" name="nivUrg" value=' . $info_ticket[8] .'>';
                        echo "<p id='champLocked'>$info_ticket[8]</p>";
                    }
                    ?>
                    <br>
                    <label for='nivUrg2'>Niveau d'urgence</label><br>
                    <?php
                    if (recupererRoleDe($connection) == 'Administrateur Site'){
                        echo "
							<div class='custom-select'>
							<select name='nivUrg2' id='nivUrg2' required>
							";
                        if ($info_ticket[9] == "Non complété !") { echo "<option value=''>--Choisir une option--</option>"; }
                        $resSQL = mysqli_query($connection, "SELECT VALEUR_URGENCE_TICKET FROM `UrgenceTicket` WHERE IMPORTANCE_URGENCE != '999' ORDER BY IMPORTANCE_URGENCE DESC;");
                        menuDeroulant($resSQL, "selected", array($info_ticket[9]));
                        echo "
							</select>
							</div>
							";
                    }
                    else{
                        echo '<input type="hidden" name="nivUrg2" value="<?php echo $info_ticket[9]; ?>">';
                        echo "<p id='champLocked'>$info_ticket[9]</p>";
                    }
                    ?>

                    <br>
                    <label for='ch_technicien'>Technicien affecté</label><br>
                    <?php
                    if (recupererRoleDe($connection) == 'Administrateur Site'){
                        $liste_technicien = $connection->query('SELECT id_user,prenom_user,nom_user FROM vue_technicien;');
                        echo "
							<div class='custom-select'>
								<select name='ch_technicien' id='ch_technicien'>
						";
                        if ($info_ticket[10] == Null) { echo "<option value=''>--Choisir une option--</option>"; }
                        while ($row = mysqli_fetch_row($liste_technicien)){
                            echo "<option value='$row[0]'";
                            echo isSelected($row[0],$info_ticket[10]);
                            echo "
										>$row[1] $row[2]</option>";
                        }
                        echo "
								</select>
							</div>
							";
                    }
                    else {
                        if ((!empty($info_ticket[11])) and (!empty($info_ticket[12]))){
                            echo '<input type="hidden" name="ch_technicien">'; // value="< ?php echo $info_ticket[10]; ? >"
                            echo "<p id='champLocked'>$info_ticket[11] $info_ticket[12]</p>";
                        }
                        else{
                            echo "<p id='champLocked'>Aucun</p>";
                        }
                    }
                    ?>
                    <br>
                    <div>
                    <span>Mots-clés</span><br>
                    <div class="menu_checkbox" id="menu_deroulant_motcle" tabindex="0" onkeydown="toggleDropdown(this)">
                        <?php

                        $lesMotcleTicketsCoches = array();
                        $resSQL = executeSQL("SELECT NOM_MOTCLE FROM vue_tdb_relation_ticket_motcle WHERE ID_TICKET = ?", array($id_ticket), $connection);
                        while($unMotcleTicket = mysqli_fetch_row($resSQL)){
                            $lesMotcleTicketsCoches[] = $unMotcleTicket[0];
                        }


                        if (count($lesMotcleTicketsCoches) == 0){ $texteBouton = "-- Listes des mots-clés --"; }
                        elseif (count($lesMotcleTicketsCoches) == 1) { $texteBouton = "1 mot-clé sélectionné à l'origine";}
                        else { $texteBouton = count($lesMotcleTicketsCoches) . " mots-clés sélectionnés à l'origine";}


                        echo "<span class='entete_menu_checkbox' onclick=toggleDropdown(document.getElementById('menu_deroulant_motcle'))>$texteBouton</span>";
                        ?>
                        <div class="option_checkbox">
                            <?php
                            $resSQL = mysqli_query($connection, "SELECT NOM_MOTCLE FROM `MotcleTicket` ORDER BY NOM_MOTCLE ASC;");
                            menuDeroulant($resSQL, "checked", $lesMotcleTicketsCoches);
                            ?>

                        </div>

                    </div>
                </div>
                </div>
            </div>
            <input type="hidden" name="id_ticket" value='<?php echo $id_ticket; ?>'>
            <input type='submit' name='modif' value='Modifier le ticket'><br>
        </form>
    <form action='action_modificationTicket.php' method='post' name="Finir le ticket" onsubmit="return confirmerAvantEnvoi(this.name)">
        <?php
            $estAdmin = (recupererRoleDe($connection) == 'Administrateur Site');
            $estTech = (recupererRoleDe($connection) == 'Technicien');
            if($estAdmin || $estTech){
                // True si le ticket peut être fermé (il peut user de ses privilèges de technicien/administrateur pour le fermer)
                $ticketPeutEtreFermer = (bool) mysqli_fetch_row(executeSQL("SELECT COUNT(*) FROM vue_modif_ticket_adm_tech WHERE ID_TICKET = ?", array($id_ticket), $connection))[0];

                if ($ticketPeutEtreFermer) {
                    echo "<input type='hidden' name='id_ticket' value=$id_ticket>";
                    echo '<input type="submit" name="fermer_ticket" value="Fermeture du Ticket" id="boutonFermerTicket"><br>';
                }
            }
            ?>

    </form>
    </div>
</div>
</body>
</html>
