<?php
require '../ressources/fonctions/PHPfunctions.php';
global $host, $database, $USER_FICTIF_MDP;

$connexionUtilisateur = pageAccess(array('Utilisateur', 'Technicien', 'Administrateur Site', 'Administrateur Système'));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon espace</title>
    <link rel="stylesheet" href="../ressources/style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../ressources/images/logo_sans_texte.png" type="image/x-icon">

    <script src="../ressources/script/infoLigneTab.js"></script>
    <script src="../ressources/script/hamburger.js"></script>
    <script src="../ressources/script/demandeServeurPourPOP-UP_MonEspace.js"></script>
</head>
<body class="profile">
          <?php
          affichageMenuDuHaut("profil", $connexionUtilisateur);
          ?>
  <h1 class="titre_page">
      Mon compte
  </h1>
    <div class="info_profile">
        <div class="info_perso">
            <h2>Informations Personnelles</h2>
            <div class="conteneur_table">
            <?php
            $entete_profile = array('Login', 'Nom Complet', 'Email', 'Role','Mot de passe');
            $requete = "SELECT login_user,  nom_user, email_user, role_user,  prenom_user FROM vue_Utilisateur_client;";
            $reponse =  mysqli_query($connexionUtilisateur, $requete);
            $row = mysqli_fetch_row($reponse);
            $row[1] = $row[4] . " " . $row[1];
            $row[3] = recupererRoleDe($connexionUtilisateur);
            $row[4] = "*******";
            echo "<table class='table-perso'>
                <tbody>";
                    for($i=0 ;$i<count($row); $i++) {
                        echo " <tr class='ligne_profile pasLigneHover'>
                                    <td class='entete_profile' >$entete_profile[$i]</td >
                                    <td > $row[$i]</td >";
                        if ($i == 2){
                            echo "<td><a href='modifEmail.php'><img src='../ressources/images/icone_modif.svg' class='iconeModif' alt='icone de modification'></a></td>";
                        }else if ($i == 4 && !in_array($row[3], ['Administrateur Site', 'Administrateur Système'])){
                            echo "<td><a href='modifMdp.php'><img src='../ressources/images/icone_modif.svg' class='iconeModif' alt='icone de modification'></a></td>";
                        }else{
                            echo "<td></td>";
                        }
                        echo "</tr>";
                    }
                   echo"</tbody>
            </table>";
            ?>
            </div>
        </div>

        <div class="demandes">
            <h2>Mes demandes</h2>
            <div class="conteneur_table-demandes-perso conteneur_table">
                <table class="table-demandes-perso table-popup" id="monespace">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Date de Création</th>
                        <th>Niv. Urgence</th>
                        <th>Description</th>
                        <th>État</th>
                    </tr>
                    </thead>
                    <tbody class="table-ticket-profil">
                    <?php
                        $reqSQL = "SELECT ID_TICKET, TITRE_TICKET, DATE_FORMAT(HORODATAGE_CREATION_TICKET, 'le %d/%m/%Y à %Hh%i'),NIV_URGENCE_DEFINITIF_TICKET, DESCRIPTION_TICKET, ETAT_TICKET FROM vue_Ticket_client ORDER BY HORODATAGE_CREATION_TICKET DESC";

                    $getResultSQL = mysqli_query($connexionUtilisateur, $reqSQL);

                    if (! (mysqli_num_rows($getResultSQL) == 0)) { // S'il y a au moins 1 ticket à affiché, on affiche la section
                        $attributsLignes = 'onclick="ligneMonEspace(this.id)"';
                        tableGenerate($getResultSQL, $attributsLignes);
                    } else {
                        echo '<tr class="pasLigneHover"><td colspan="6" style="text-align: center; height: 639px">Créez un ticket via le tableau de bord et il s\'affichera ici.</td></tr>';
                    }
                    ?>
                    </tbody>
                </table>

                <div class="overlay" id="overlay" onclick="closePopup()">
                    <!-- Contenu de la pop-up -->

                    <div role="form" id="pop-up" class="formModifTicket formAuthentification formConnexion popupInfo">

                        <div id="informations_ticket_popup">

                        </div>

                        <button id="fermer_pop-up" onclick="closePopup()" tabindex="0">x</button>
                    </div>


                </div>
            </div>
        </div>
    </div>



</body>
</html>
