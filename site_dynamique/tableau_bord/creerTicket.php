<?php
global $lesMotcleTicketsCoches;
$lesMotcleTicketsCoches = array();
require '../ressources/fonctions/PHPfunctions.php';

$connexionUtilisateur = pageAccess(array('Utilisateur', 'Technicien', 'Administrateur Site', 'Administrateur Système'));

session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Création de Ticket</title>
    <link rel="stylesheet" href="../ressources/style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../ressources/images/logo_sans_texte.png" type="image/x-icon">
    <script src="../ressources/script/menuCheckbox.js"></script>
</head>
<body>
<header>
    <div class="retour">
        <a href="javascript:window.history.go(-1)"><img src="../ressources/images/fleche_retour.png" alt=""> Tableau de bord</a>
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
                else if ($_GET['id'] == 4) { echo "ERREUR : Le niveau d'urgence est pas complété "; }
                else if ($_GET['id'] == 5) { echo "ERREUR : Aucun mot clé n'est sélectionné "; }
                else { echo "ERREUR : Une erreur est survenue"; }
                echo '</p>';
                echo '</div>';
            }
            ?>
            <label for='titre'>Titre du problème</label><br>
            <div class="custom-select">
                <select name="titre" id="titre" class="creer_select" required>
                    <?php
                    $resSQL = mysqli_query($connexionUtilisateur, "SELECT TITRE_TICKET FROM `TitreTicket` ORDER BY TITRE_TICKET ASC;");

                    echo "<option value=''>--Choisir une option--</option>";
                    if (isset($_SESSION['titre'])) {
                        menuDeroulant($resSQL, "selected", array($_SESSION['titre']));
                    }else{
                        menuDeroulant($resSQL, "selected");
                    }

                    ?>
                </select>
            </div>

            <br>
            <div class="div_separ">
                <div class="gauche">
                    <label for='nivUrg'>Niveau d'urgence estimé</label><br>
                    <div class="custom-select">
                            <select name="nivUrg" id="nivUrg" class="creer_select" required>
                                <?php

                                $resSQL = mysqli_query($connexionUtilisateur, "SELECT VALEUR_URGENCE_TICKET FROM `UrgenceTicket` WHERE IMPORTANCE_URGENCE != '999' ORDER BY IMPORTANCE_URGENCE DESC;");

                                echo "<option value=''>--Choisir une option--</option>";
                                if (isset($_SESSION['nivUrg'])) {
                                    menuDeroulant($resSQL, "selected", array($_SESSION['nivUrg']));
                                }else{
                                    menuDeroulant($resSQL, "selected");
                                }

                                ?>
                        </select>
                    </div>
                </div>
             <div class="droite">
                 <span>Mots-clés</span><br>
                 <div class="menu_checkbox" id="menu_deroulant_motcle" tabindex="0" onkeydown="toggleDropdown(this)">
                     <?php
                     if (isset($_SESSION['motcle'])) {
                         $lesMotcleTicketsCoches = $_SESSION['motcle'];
                     }
                     if (count($lesMotcleTicketsCoches) == 0){ $texteBouton = "-- Sélectionner des mots-clés --"; }
                     elseif (count($lesMotcleTicketsCoches) == 1) { $texteBouton = "1 mot-clé sélectionné";}
                     else { $texteBouton = count($lesMotcleTicketsCoches) . " mots-clés sélectionnés";}

                     echo "<span class='entete_menu_checkbox' onclick=toggleDropdown(document.getElementById('menu_deroulant_motcle'))>$texteBouton</span>";
                     ?>
                     <div class="option_checkbox">
                         <?php
                         $resSQL = mysqli_query($connexionUtilisateur, "SELECT NOM_MOTCLE FROM `MotcleTicket` ORDER BY NOM_MOTCLE ASC;");
                         menuDeroulant($resSQL, "checked", $lesMotcleTicketsCoches);
                         ?>

                     </div>

                 </div>


             </div>
            </div>

            <br>
            <label for='explication'>Description du problème</label><br>
            <?php
            $explicationValue = $_SESSION['explication'] ?? '';
            echo "<textarea id='explication' name='explication' minlength='5' maxlength='250' placeholder=\"Expliquez ici votre problème. N'oubliez pas d'associer au moins un mot-clé à votre ticket.\">$explicationValue</textarea><br>";
            unset($_SESSION["titre"], $_SESSION["nivUrg"], $_SESSION["explication"], $_SESSION["motcle"]);
            ?>

            <input type='submit' name='cree' value='Créer'><br>
        </form>
    </div>
</div>
</body>
</html>