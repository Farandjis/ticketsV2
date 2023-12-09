<?php
require (dirname(__FILE__) . "/ressources/fonctions/PHPfunctions.php");
session_start();

$estConnecter = false; // On part du principe que c'est in visiteur (donc non connecté)

if (isset($_SESSION['login'], $_SESSION['mdp'])) {
    // Vérifie que le login et le mot de passe est bien définit
    if (!empty($_SESSION['login']) && !empty($_SESSION['mdp'])) {
        // Vérifie que ce n'est pas vide

        session_abort();
        $connexionUtilisateur = pageAccess(array("Utilisateur", "Technicien", "Administrateur Site", "Administrateur Système"));
        $estConnecter = true; // La personne accède bien à la page en étant connecté
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
</head>
<body class="body_accueil">
<header>
    <nav>
        <a href="#" aria-current="page">
            <div class="logo">
                <img src="ressources/images/logo_blanc.png" alt="logo du site">
                <p>TIX</p>
            </div>
        </a>

        <?php
        if ($estConnecter){

            echo '<div class="nav-conteneur">';

                echo '<a href="#" aria-current="page">Accueil</a>';
                echo '<a href="tableau_bord/tableauBord.php">Tableau de bord</a>';
                // Si la personne est connecté...
                if (recupererRoleDe($connexionUtilisateur) == "Administrateur Site"){
                    // ... et que c'est l'administrateur du site
                    echo '<a href="administration/administration.php">Administration</a>';
                }
                elseif (recupererRoleDe($connexionUtilisateur) == "Administrateur Système"){
                    echo '<a href="administration/administration.php">Administration</a>';
                }

            echo '</div>';
        }
        ?>

        <div class="nav-authentification">
            <a href="profil/profil.php" class="user-icon" aria-label="Page de connexion">
                <img src="ressources/images/user.svg" alt="icone utilisateur">
            </a>
            <div class="authentification">
                <?php
                if ($estConnecter) {
                    // Si la personne est connecté...
                    echo "<a href = 'profil/profil.php'> Mon Espace </a>";
                }
                else {
                    // Sinon, c'est un visiteur
                    echo '<a href = "authentification/connexion.php"> Connexion</a>';
                    echo '<a href = "authentification/inscription.php"> Inscription</a>';
                }
                ?>
            </div>
        </div>
    </nav>
</header>
<div class="hero">
    <div class="presentation">
        <div class="texte-presentation">
            <h1>Présentation du <strong>Site</strong></h1>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat.
            </p>
        </div>
        <div class="video-presentation">
            <!--<iframe src="https://www.youtube.com/embed/UKRYHQALlAI?si=RteuZWQKMDy-d63F" title="YouTube video player"  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>-->
            <video controls autoplay muted>
                <source src="ressources/video/presentation_tix.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

    </div>
    <div class="inscription">
        <a href="authentification/inscription.php" >Je m'inscris</a>
    </div>
</div>

<?php
    global $host, $database, $USER_FICTIF_MDP;

    $connexion = mysqli_connect($host, 'visiteur', $USER_FICTIF_MDP['visiteur'], $database);

    $reqSQL = "SELECT ID_Ticket, DATE_FORMAT(HORODATAGE_CREATION_TICKET, 'le %d/%m/%Y à %Hh%i'), OBJET_TICKET, NIV_URGENCE_DEFINITIF_TICKET, DESCRIPTION_TICKET, ETAT_TICKET FROM vue_Ticket_visiteur ORDER BY HORODATAGE_CREATION_TICKET, ID_TICKET DESC LIMIT 10";

    $getResultSQL = mysqli_query($connexion, $reqSQL);
    if (! (mysqli_num_rows($getResultSQL) == 0)){ // S'il y a au moins 1 ticket à affiché, on affiche la section
        echo '
                <div class="affichage_ticket">
                    <h1 class="titre_page"> ' . mysqli_num_rows($getResultSQL) . ' derniers Tickets</h1>
                    <div class="conteneur_table_accueil conteneur_table">
                        <table class="table-accueil tableau">
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

        <div class="informations_ticket_popup">

            <p><strong>Ticket n°</strong> <span id="popupId"></span></p>
            <p><strong>Date : </strong> <span id="popupDate"></span></p>
            <p><strong>Niveau d'urgence : </strong> <span id="popupNiveau"></span></p>
            <p><strong>État : </strong> <span id="popupEtat"></span></p>
            <p><strong>Objet : </strong> <span id="popupObjet"></span></p>
            <p><strong>Description : </strong> <br> <span id="popupDescription"></span></p>
        </div>

        <button id="fermer_pop-up" onclick="closePopup()">x</button>
    </div>


</div>
</body>
</html>
