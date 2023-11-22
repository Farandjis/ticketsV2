<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="ressources/style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="ressources/images/logo_sans_texte.png" type="image/x-icon">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                    <img src="ressources/images/logo_blanc.png" alt="logo du site">
            </div>

            <div class="nav-conteneur">
                <a href="" aria-current="page">Accueil</a>
                <?php
                session_start();
                if (isset($_SESSION['login'], $_SESSION['mdp'])){
                    $host = 'localhost';
                    $database = 'DB_TIX';
                    $connexion = mysqli_connect($host, 'fictif_selectionDB', 't!nt1n_selectionDB45987645', $database);
                    $id = $_SESSION['login'];
                    $requete = "SELECT role_user FROM vue_UserFictif_selectionDB1 WHERE id_user = $id;";
                    $reponse =  mysqli_query($connexion, $requete);
                    $row = mysqli_fetch_row($reponse);
                    if ($row[0] == 'admin_sys') {
                        echo "<a href='logs/journalActivite.html'>Journal d'activité</a>
                        <a href='logs/historique.html'>Historique</a>";
                        echo "<a href='tableau_bord/tableauBord.php'>Tableau de bord</a>";
                    }
                    else
                        echo "<a href='tableau_bord/tableauBord.php'>Tableau de bord</a>";
                }
                ?>
            </div>


            <div class="nav-authentification">
                <a href="profil.html" class="user-icon" aria-label="Page de connexion">
                    <img src="ressources/user.svg" alt="icone utilisateur">
                </a>
                <div class="authentification">
                    <?php
                    if (isset($_SESSION['login'], $_SESSION['mdp'])) {
                        $host = 'localhost';
                        $database = 'DB_TIX';
                        $connexion = mysqli_connect($host, ''.$_SESSION['login'], ''.$_SESSION['mdp'], $database);
                        if ($connexion){
                            echo "<a href='profil/profil.php'>Mon Espace</a>";
                        }
                        else {
                            echo "<a href='authentification/connexion.php'>Connexion</a>
                            <a href='authentification/inscription.php'>Inscription</a>";
                        }
                    }
                    else {
                        echo "<a href='authentification/connexion.php'>Connexion</a>
                            <a href='authentification/inscription.php'>Inscription</a>";
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>

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
            <iframe src="https://www.youtube.com/embed/UKRYHQALlAI?si=RteuZWQKMDy-d63F" title="YouTube video player"  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>

    </div>
        <div class="inscription">
        <?php
        if (!isset($_SESSION['login'], $_SESSION['mdp'])) {
            echo "<a href='authentification/inscription.php' >Je m'inscris</a>";
        }
         ?>
        </div>


    <div class="affichage_ticket">
        <table class="table-accueil">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Libellé</th>
                    <th>Niv. Urgence</th>
                    <th>Description</th>
                    <th>Utilisateur</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                </tr>
                <tr>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                </tr>
                <tr>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                </tr>
                <tr>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                </tr>
                <tr>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                </tr>
                <tr>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                </tr>
                <tr>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                </tr>
                <tr>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                </tr>
                <tr>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                </tr>
                <tr>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                    <td>Contenu</td>
                </tr>

            </tbody>
        </table>
  </div>

  <footer>
      <a href="https://www.uvsq.fr/"><img src="ressources/images/logo-UVSQ.png" alt="redirige vers site UVSQ"></a>
  </footer>

</body>
</html>