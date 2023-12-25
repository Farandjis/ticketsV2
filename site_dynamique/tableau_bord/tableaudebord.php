<?php
require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connexionUtilisateur = pageAccess(array('Utilisateur', 'Technicien', 'Administrateur Site', 'Administrateur Système')); // Renvoi vers e403 si la personne n'a pas accès

global $database, $host;

/*
 * Par rapport à au bouton modifier :
 *
 * Etape 1 :
 *      Lors de la génération du tableau, j'associe ma fonction JavaScript à chaque ligne qui récupéra l'identifiant de la ligne du tableau.
 * Etape 2 :
 *      La fonction JS va récupérer l'ID du ticket :
 *              On récupère le tableau avec l'id "tableaudebord", on récupère toute ses lignes,
 *              et pour la ligne n°idLigneDuTicket on récupère toute ses cases afin de récupérer l'identifiant du ticket
 * Etape 3 :
 *      On envoi l'ID Ticket au serveur, qui à l'aide des infos du cookie SESSION, va vérifier si l'utilisateur
 *      peut modifier (ou s'attribuer) le ticket.
 * Etape 4 :
 *      Le serveur répond, si c'est possible, on affiche le bouton, sinon, on ne l'affiche pas.
 *      Le serveur revérifie les informations liés à la session en cours.
 */
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="../ressources/style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../ressources/images/logo_sans_texte.png" type="image/x-icon">
    <script src="../ressources/script/libelle.js"></script>
    <script src="../ressources/script/infoLigneTab.js"></script>
    <script src="../ressources/script/demandeServeurPourBoutonPOP-UP_TDB.js"></script>


</head>
<body>
<?php affichageMenuDuHaut("tableaudebord", $connexionUtilisateur);?>
<?php

?>

    <div class="tableau_bord_bouton">
        <h1 class="titre_tableau_bord">
            Tableau de Bord
        </h1>
        <div class="bouton_ticket">
            <a href="creerTicket.php">Créer un ticket</a>
        </div>
    </div>

    <div class="tableau-bord">
        <div class="conteneur_table-tableau-bord conteneur_table">
        <table class="table-tableau-bord table-popup" id="tableaudebord">
            <thead>
            <tr>
                <th>Id</th>
                <th>Date</th>
                <th>Titre</th>
                <th>Niv. Urgence</th>
                <th>Description</th>
                <th>Etat</th>
            </tr>
            </thead>
            <tbody class="table-ticket">

            <?php

            if (isset($_POST["resetRecherche"]) and $_POST["resetRecherche"]) { header("Location: " . basename(__FILE__)); return; }


            $vueTDB = "vue_tableau_bord"; $vueRTL = "vue_tdb_relation_ticket_libelle";
            $reqSQL = "SELECT $vueTDB.ID_TICKET, DATE_FORMAT(HORODATAGE_CREATION_TICKET, 'le %d/%m/%Y à %Hh%i'), OBJET_TICKET, NIV_URGENCE_DEFINITIF_TICKET, DESCRIPTION_TICKET, ETAT_TICKET FROM $vueTDB";


            $paramsReqSQL = array(); $lesLibellesCoches = array();

            if (isset($_POST["date"]) && isset($_POST["date2"]) && isset($_POST["titre"])){
                $valeurDejaDansWhere = false;

                if (isset($_POST["libelle_option"]) && $_POST["libelle_option"]){ // Si au moins 1 libellé à été coché
                    $reqSQL = $reqSQL . " JOIN $vueRTL ON $vueRTL.ID_TICKET = $vueTDB.ID_TICKET ";

                    $listeSQL = "("; $premierLibelle = true;
                    foreach ($_POST["libelle_option"] as $unLibelle){
                        if (!$premierLibelle) {$listeSQL = $listeSQL . ","; } else { $premierLibelle = false; }
                        $listeSQL = $listeSQL . "?";
                        $paramsReqSQL[] = $unLibelle;
                        $lesLibellesCoches[] = $unLibelle;
                    }
                    $listeSQL = $listeSQL . ")";

                    $reqSQL = $reqSQL . " WHERE $vueRTL.NOM_LIBELLE IN " . $listeSQL;
                    $valeurDejaDansWhere = true; // Indique qu'après le WHERE, il y a bien une valeur



                }


                if ($_POST["titre"]){
                    if (!$valeurDejaDansWhere) { $reqSQL = $reqSQL . " WHERE "; $valeurDejaDansWhere = true;}
                    else{ $reqSQL = $reqSQL . " AND ";}

                    $reqSQL = $reqSQL . "$vueTDB.OBJET_TICKET LIKE '%" . htmlspecialchars($_POST["titre"]) . "%'";
                }

                if ($_POST["date"] and ($_POST["date"] <= $_POST["date2"] or (!$_POST["date2"])) ){
                    if (!$valeurDejaDansWhere) { $reqSQL = $reqSQL . " WHERE "; $valeurDejaDansWhere = true;}
                    else{ $reqSQL = $reqSQL . " AND ";}

                    $reqSQL = $reqSQL . "$vueTDB.horodatage_creation_ticket >= ?";
                    $paramsReqSQL[] = $_POST["date"] . " 00:00:00"; // 00:00:00 précise que c'est la journée comprise
                }

                if ($_POST["date2"] and ($_POST["date"] <= $_POST["date2"] or (!$_POST["date"]))){
                    if (!$valeurDejaDansWhere) { $reqSQL = $reqSQL . " WHERE "; $valeurDejaDansWhere = true;}
                    else{ $reqSQL = $reqSQL . " AND ";}

                    $reqSQL = $reqSQL . "$vueTDB.horodatage_creation_ticket <= ?";
                    $paramsReqSQL[] = $_POST["date2"] . " 23:59:59"; // 23:59:59 précise que c'est la journée comprise
                }
            }


            if ($paramsReqSQL) {
                $POSTResultSQL = executeSQL($reqSQL, $paramsReqSQL, $connexionUtilisateur);
            }
            else {
                $POSTResultSQL = mysqli_query($connexionUtilisateur, $reqSQL);
            }
            if (! (mysqli_num_rows($POSTResultSQL) == 0)){ // S'il y a au moins 1 ticket à affiché, on affiche la section
                $attributsLignes = 'onclick="ligneTableauDeBord(this.id)"';
                tableGenerate($POSTResultSQL, $attributsLignes);
            }
            else {
                echo '<tr class="pasLigneHover"><td colspan="6" style="text-align: center; height: 639px">Aucun ticket à afficher pour le moment.</td></tr>';
            }

            ?>

            </tbody>
        </table>
        </div>
        <div class="form-recherche">
            <h2>Recherche</h2>
            <form action='#' method='POST'>
                <?php

                echo "<label for='date'>Date</label><br>";
                if (isset($_POST["date"]) and $_POST["date"] and ($_POST["date"] <= $_POST["date2"] or (!$_POST["date2"]))) { echo "<input id='date' type='date' name ='date' value='" . htmlspecialchars($_POST["date"]) . "'>"; }
                else { echo "<input id='date' type='date' name ='date'>"; }

                echo "<label for='date2'> à </label>";
                if (isset($_POST["date2"]) and $_POST["date2"] and ($_POST["date"] <= $_POST["date2"] or (!$_POST["date"]))) { echo "<input id='date2' type='date' name ='date2' value='" . htmlspecialchars($_POST["date2"]) . "'>"; }
                else { echo "<input id='date2' type='date' name ='date2'>"; }

                echo "<br>";

                echo "<label for='titre'>Titre</label><br>";
                if (isset($_POST["titre"]) and $_POST["titre"]) { echo "<input id='titre' type='text' name ='titre' value='" . htmlspecialchars($_POST["titre"]) . "'>"; }
                else { echo "<input id='titre' type='text' name ='titre'>"; }
                ?>
                <br>
                <span>Libellé</span><br>
                <div class="menu_libelle" id="menu_deroulant_libelle" tabindex="0" onkeydown="toggleDropdown()">
                    <?php
                    if (count($lesLibellesCoches) == 0){ $texteBouton = "Cliquez pour sélectionner des libellés"; }
                    elseif (count($lesLibellesCoches) == 1) { $texteBouton = "1 libellé sélectionné";}
                    else { $texteBouton = count($lesLibellesCoches) . " libellés sélectionnés";}

                    echo "<span class='entete_libelle' onclick='toggleDropdown()'>$texteBouton</span>";
                    ?>
                    <div class="option_libelle">
                        <?php
                        menuDeroulantTousLesLibelles($connexionUtilisateur, $lesLibellesCoches);
                        ?>

                    </div>

                </div>


                <div class="bouton-recherche">
                    <input type='submit' name='recherche' value='Recherche'>
                    <input type='submit' name='resetRecherche' value='Annuler'>
                </div>
            </form>
        </div>
    </div>

    <div class="overlay" id="overlay" onclick="closePopup()">
        <!-- Contenu de la pop-up -->

        <div role="form" id="pop-up" class="formModifTicket formAuthentification formConnexion popupInfo">

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