<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="../ressources/style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../ressources/images/logo_sans_texte.png" type="image/x-icon">
</head>
<body class="profile">
  <header>
      <nav>
          <div class="logo">
              <img src="../ressources/images/logo_blanc.png" alt="logo du site">
          </div>
          <div class="nav-conteneur">
          <a href="../" aria-current="page">Accueil</a>
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
                  echo "<a href='../logs/journalActivite.html'>Journal d'activité</a>
                        <a href='../logs/Historique.html'>Historique</a>";
                  echo "<a href='../tableau_bord/tableauBord.php'>Tableau de bord</a>";
              }
              else
                  echo "<a href='../tableau_bord/tableauBord.php'>Tableau de bord</a>";
          }
          ?>
          </div>
          <div class="deconnexion">
              <a href="../authentification/action_deconnexion.php">Déconnexion</a>
          </div>
      </nav>
  </header>

  <h1 class="titre_page">
      Mon compte
  </h1>
    <div class="info_profile">
        <div class="info_perso">
            <h2>Informations Personnelles</h2>
            <?php
            $requete = "SELECT login_user, nom_user, prenom_user, email_user, role_user FROM vue_UserFictif_selectionDB1 WHERE id_user = $id;";
            $reponse =  mysqli_query($connexion, $requete);
            $row = mysqli_fetch_row($reponse);
            echo "<table class='table-perso'>
                <tbody>
                    <tr>
                        <td class='entete_profile'>Login</td>
                        <td>$row[0]</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class='entete_profile'>Nom Complet</td>
                        <td>$row[1] $row[2]</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class='entete_profile'>Email</td>
                        <td>$row[3]</td>
                        <td><a href='modifEmail.html'>Modifier</a></td>
                    </tr>
                    <tr>
                        <td class='entete_profile'>Role</td>
                        <td>$row[4]</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class='entete_profile'>Mot de passe</td>
                        <td>************</td>
                        <td><a href='modifMdp.html'>Modifier</a></td>
                    </tr>
                </tbody>
            </table>";
            ?>
        </div>

        <div class="demandes">
            <h2>Mes demandes</h2>
            <table class="table-demandes-perso">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Libellé</th>
                    <th>Niv. Urgence</th>
                    <th>Description</th>
                    <th>Etat</th>
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
                </tbody>
            </table>
        </div>
    </div>



</body>
</html>