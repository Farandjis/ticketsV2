<?php
require (dirname(__FILE__) . "/ressources/fonctions/PHPfunctions.php");
session_start();

$connexionUtilisateur = null; // On part du principe que c'est in visiteur (donc non connecté)

if (isset($_SESSION['login'], $_SESSION['mdp'])) {
    // Vérifie que le login et le mot de passe est bien définit
    if (!empty($_SESSION['login']) && !empty($_SESSION['mdp'])) {
        // Vérifie que ce n'est pas vide

        session_abort();
        $connexionUtilisateur = pageAccess(array("Utilisateur", "Technicien", "Administrateur Site", "Administrateur Système"));

    }
}

// A partir d'ici, on sait si l'utilisateur est bien connecté ou non
// Si sa session a expiré, la personne a été redirigé automatiquement vers la page de connexion.
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="ressources/style/style.css">
    <link href="ressources/style/googleAPI.css" rel="stylesheet">
    <link rel="shortcut icon" href="ressources/images/logo_sans_texte.png" type="image/x-icon">

    <script src="ressources/script/infoLigneTab.js"></script>
    <script src="ressources/script/hamburger.js"></script>
</head>
<body class="body_accueil">

<?php affichageMenuDuHaut("index", $connexionUtilisateur);?>

<div class="hero">
    <div class="presentation">
        <div class="texte-presentation">
            <?php

            if ( 8 <= date( "H", time()) and date( "Hi", time()) <= 1730){ $salutation = "Bonjour"; }
            elseif (1730 <= date( "Hi", time()) and date( "H", time()) < 21) { $salutation = "Bonsoir"; }
            else{ $salutation = "Bonne nuit"; }

            if ($connexionUtilisateur == null){ echo "<h1>Bienvenue sur <strong>TIX</strong> !</h1>"; }
            else {
                $prenomUtilisateur = mysqli_fetch_row(mysqli_query($connexionUtilisateur, "SELECT PRENOM_USER FROM vue_Utilisateur_client;"))[0];

                if (strlen($prenomUtilisateur) > 10) {
                    $prenomUtilisateur = substr($prenomUtilisateur, 0, 10) . "...";
                }

                echo "<h1>$salutation <strong>$prenomUtilisateur</strong>&nbsp;!</h1>";
            }
            ?>

            <p>
            La plateforme <strong>TIX</strong> vous permet de reporter les problèmes des salles machines de l'IUT de Vélizy-Villacoublay.<br><br>
            Signalez avec facilité les problèmes que vous rencontrez aux techniciens de votre parc, puis constatez leur résolution à l'aide du tableau de bord.<br><br>
            La vidéo ci-contre vous présente <strong>TIX</strong> dans les moindres détails.<br><br>
            </p>
        </div>
        <div class="video-presentation">
            <!--<iframe src="https://www.youtube.com/embed/UKRYHQALlAI?si=RteuZWQKMDy-d63F" title="YouTube video player"  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>-->
            <video controls autoplay muted loop controlsList="nodownload">
                <source src="ressources/video/presentation_tix.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

    </div>
    <div class='inscription'>
        <?php if ($connexionUtilisateur == null){ echo "<a href='authentification/inscription.php' >Je m'inscris</a>"; }
        else { echo "<a href='profil/profil.php' >Mon espace</a>"; }
        ?>
    </div>

</div>

<?php
    global $host, $database, $USER_FICTIF_MDP;

    $connexion = mysqli_connect($host, 'visiteur', $USER_FICTIF_MDP['visiteur'], $database);

    $reqSQL = "SELECT ID_Ticket, DATE_FORMAT(HORODATAGE_CREATION_TICKET, 'le %d/%m/%Y à %Hh%i'), TITRE_TICKET, NIV_URGENCE_DEFINITIF_TICKET, DESCRIPTION_TICKET, ETAT_TICKET FROM vue_Ticket_visiteur";

    $getResultSQL = mysqli_query($connexion, $reqSQL);
    if (! (mysqli_num_rows($getResultSQL) == 0)){ // S'il y a au moins 1 ticket à affiché, on affiche la section
        echo '
                <div class="affichage_ticket">
                    <h1 class="titre_page"> ' . mysqli_num_rows($getResultSQL) . ' derniers Tickets</h1>
                    <div class="conteneur_table_accueil conteneur_table">
                        <table class="table-accueil tableau table-popup">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Titre</th>
                                <th>Niv. Urgence</th>
                                <th>Description</th>
                                <th>État</th>
                            </tr>
                            </thead>
                            <tbody class="table-ticket">
            ';
                            tableGenerate($getResultSQL); // génère le tableau avec les tickets
            echo '
                            </tbody>
                        </table>
                    </div>
                </div>
                ';
                }
                ?>
<footer>
    <a href="https://www.uvsq.fr/" target="_blank"><img src="ressources/images/logo-UVSQ.png" alt="redirige vers site UVSQ"></a>
</footer>

<div class="overlay" id="overlay" onclick="closePopup()">
        <!-- Contenu de la pop-up -->

        <div id="test" class="formModifTicket formAuthentification formConnexion popupInfo">

            <div id="informations_ticket_popup">
            </div>

            <button id="fermer_pop-up" onclick="closePopup()" tabindex="0">x</button>
        </div>
    </div>

</body>
</html>
