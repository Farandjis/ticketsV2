<?php
require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connexionUtilisateur = pageAccess(array('Utilisateur', 'Technicien', 'Administrateur Site', 'Administrateur Système')); // Renvoi vers e403 si la personne n'a pas accès

global $database, $host;

/*
 *            <div class="hamburger-menu">
                <div class="slice"></div>
                <div class="slice"></div>
                <div class="slice"></div>
            </div>
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
        <table class="table-tableau-bord">
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
            $vueTDB = "vue_tableau_bord"; $vueRTL = "vue_tdb_relation_ticket_libelle";
            $reqSQL = "SELECT $vueTDB.ID_TICKET, DATE_FORMAT(HORODATAGE_CREATION_TICKET, 'le %d/%m/%Y à %Hh%i'), OBJET_TICKET, NIV_URGENCE_DEFINITIF_TICKET, DESCRIPTION_TICKET, ETAT_TICKET FROM $vueTDB";


            $paramsReqSQL = array();

            if (isset($_GET["date"]) && isset($_GET["date2"]) && isset($_GET["titre"])){
                $valeurDejaDansWhere = false;

                if (isset($_GET["libelle_option"]) && $_GET["libelle_option"]){ // Si au moins 1 libellé à été coché
                    $reqSQL = $reqSQL . " JOIN $vueRTL ON $vueRTL.ID_TICKET = $vueTDB.ID_TICKET ";

                    $listeSQL = "("; $premierLibelle = true;
                    foreach ($_GET["libelle_option"] as $unLibelle){
                        if (!$premierLibelle) {$listeSQL = $listeSQL . ","; } else { $premierLibelle = false; }
                        $listeSQL = $listeSQL . "?";
                        $paramsReqSQL[] = $unLibelle;
                    }
                    $listeSQL = $listeSQL . ")";

                    $reqSQL = $reqSQL . " WHERE $vueRTL.NOM_LIBELLE IN " . $listeSQL;
                    $valeurDejaDansWhere = true; // Indique qu'après le WHERE, il y a bien une valeur



                }


                if ($_GET["titre"]){
                    if (!$valeurDejaDansWhere) { $reqSQL = $reqSQL . " WHERE "; $valeurDejaDansWhere = true;}
                    else{ $reqSQL = $reqSQL . " AND ";}

                    $reqSQL = $reqSQL . "$vueTDB.OBJET_TICKET LIKE '%" . htmlspecialchars($_GET["titre"]) . "%'";
                }

                if ($_GET["date"]){
                    if (!$valeurDejaDansWhere) { $reqSQL = $reqSQL . " WHERE "; $valeurDejaDansWhere = true;}
                    else{ $reqSQL = $reqSQL . " AND ";}

                    $reqSQL = $reqSQL . "$vueTDB.horodatage_creation_ticket >= ?";
                    $paramsReqSQL[] = $_GET["date"];
                }

                if ($_GET["date2"]){
                    if (!$valeurDejaDansWhere) { $reqSQL = $reqSQL . " WHERE "; $valeurDejaDansWhere = true;}
                    else{ $reqSQL = $reqSQL . " AND ";}

                    $reqSQL = $reqSQL . "$vueTDB.horodatage_creation_ticket < ?";
                    $paramsReqSQL[] = $_GET["date2"];
                }
            }


            if ($paramsReqSQL) {
                $getResultSQL = executeSQL($reqSQL, $paramsReqSQL, $connexionUtilisateur);
            }
            else {
                $getResultSQL = mysqli_query($connexionUtilisateur, $reqSQL);
            }
            if (! (mysqli_num_rows($getResultSQL) == 0)){ // S'il y a au moins 1 ticket à affiché, on affiche la section
            tableGenerate($getResultSQL);
            }
            else {
                echo '<tr><td colspan="6" style="text-align: center; height: 639px">Aucun ticket à afficher pour le moment.</td></tr>';
            }

            ?>

            </tbody>
        </table>
        </div>
        <div class="form-recherche">
            <h2>Recherche</h2>
            <form action='#' method='get'>
                <label for='date'>Date</label><br>
                <input id='date' type='date' name ='date'>
                <label for='date2'> à </label>
                <input id='date2' type='date' name ='date2'><br>
                <br>
                <label for='titre'>Titre</label><br>
                <input id='titre' type='text' name ='titre'><br>
                <br>
                <span>Libellé</span><br>
                <div class="menu_libelle" id="menu_deroulant_libelle" tabindex="0">
                    <span class="entete_libelle" onclick="toggleDropdown()" onkeydown="toggleDropdown()">Sélectionnez un/des libellé(s)</span>
                    <div class="option_libelle">
                        <?php
                        menuDeroulantTousLesLibelles($connexionUtilisateur);
                        ?>

                    </div>

                </div>

                <div class="bouton-recherche">
                    <input type='submit' name='recherche' value='Recherche'>
                    <input type='reset' name='resetRecherche' value='Annuler'>
                </div>
            </form>
        </div>
    </div>

    <div class="overlay" id="overlay" onclick="closePopup()">
        <!-- Contenu de la pop-up -->

        <div role="form" id="test" class="formModifTicket formAuthentification formConnexion popupInfo">

            <div class="informations_ticket_popup">

                <p><strong>ID : </strong> <span id="popupId"></span></p>
                <p><strong>Date : </strong> <span id="popupDate"></span></p>
                <p><strong>Niveau Urgence : </strong> <span id="popupNiveau"></span></p>
                <p><strong>Etat : </strong> <span id="popupEtat"></span></p>
                <p><strong>Objet : </strong> <span id="popupObjet"></span></p>
                <p><strong>Description : </strong> <br> <span id="popupDescription"></span></p>


            </div>

            <form action='modificationTicket.php' method='post'>

                <input type='submit' name='modif' value='Modifier le ticket'><br>
            </form>

            <button id="fermer_pop-up" onclick="closePopup()">x</button>
        </div>


    </div>
</body>
</html>