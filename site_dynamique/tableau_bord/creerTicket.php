<?php
global $lesMotcleTicketsCoches;
$lesMotcleTicketsCoches = array();
require '../ressources/fonctions/PHPfunctions.php';

$connexionUtilisateur = pageAccess(array('Utilisateur', 'Technicien', 'Administrateur Site', 'Administrateur Système'));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Création de Ticket</title>
    <link rel="stylesheet" href="../ressources/style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../ressources/images/logo_sans_texte.png" type="image/x-icon">
    <script src="../ressources/script/motcle.js"></script>
</head>
<body>
<header>
    <div class="retour">
        <a href="javascript:window.history.go(-1)"><img src="../ressources/images/fleche_retour.png" alt=""> Retour</a>
    </div>
</header>
<div class="page_cree-modif_ticket">
    <h1 class="h1Creation">Création de Ticket</h1>
    <div role="form" class="formCreeTicket formAuthentification formConnexion">
        <form action='action_creationTicket.php' method='POST'>
            <?php
            if(isset($_GET['id'])) {
                echo '<div class="erreur">';
                echo '<p>';
                if ($_GET['id'] == 1) { echo "ERREUR : Des données du formulaire sont manquantes"; }
                else if ($_GET['id'] == 2) { echo "ERREUR : Des données essentielles du formulaire sont manquantes ou incohérentes"; }
                else if ($_GET['id'] == 3) { echo "ERREUR : Le titre du problème n'existe pas "; }
                else { echo "ERREUR : Une erreur est survenue"; }
                echo '</p>';
                echo '</div>';
            }
            ?>
            <label for='titre'>Titre du problème</label><br>
            <input id='titre' type='text' name ='titre'>
            <br><br>
            <div class="div_separ">
                <div class="gauche">
                    <label for='nivUrg'>Niveau d'urgence</label><br>
                    <div class="custom-select">
                        <select name="nivUrg" id="nivUrg" class="creer_select" required>
                            <option value="">--Choisir une option--</option>
                            <option value="Faible">Faible</option>
                            <option value="Moyen">Moyen</option>
                            <option value="Important">Important</option>
                            <option value="Urgent">Urgent</option>
                        </select>
                    </div>
                </div>
             <div class="droite"
                <span>Mots-clés</span><br>
                <div class="menu_checkbox" id="menu_deroulant_motcle" tabindex="0" onkeydown="toggleDropdown()">
                    <?php
                    if (count($lesMotcleTicketsCoches) == 0){ $texteBouton = "-- Sélectionner des mots-clés --"; }
                    elseif (count($lesMotcleTicketsCoches) == 1) { $texteBouton = "1 mot-clé sélectionné";}
                    else { $texteBouton = count($lesMotcleTicketsCoches) . " mots-clés sélectionnés";}

                    echo "<span class='entete_menu_checkbox' onclick='toggleDropdown()'>$texteBouton</span>";
                    ?>
                    <div class="option_checkbox">
                        <?php
                        menuDeroulantTousLesMotcleTickets($connexionUtilisateur, $lesMotcleTicketsCoches);
                        ?>

                    </div>

                </div>
            </div>
            </div>

            <br>
            <label for='explication'>Explication</label><br>
            <textarea id="explication" name="explication" ></textarea><br>

            <input type='submit' name='cree' value='Créer'><br>
        </form>
    </div>
</div>
</body>
</html>
