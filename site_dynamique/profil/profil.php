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
            $entete_profile = array('Login', 'Nom Complet', 'Email', 'Role','Mot de passe');
            $requete = "SELECT login_user,  prenom_user, email_user, role_user,  nom_user FROM vue_UserFictif_selectionDB1 WHERE id_user = $id;";
            $reponse =  mysqli_query($connexion, $requete);
            $row = mysqli_fetch_row($reponse);
            $row[1] = $row[4] . " " . $row[1];
            $row[4] = "*******";
            echo "<table class='table-perso'>
                <tbody>";
                    for($i=0 ;$i<count($row); $i++) {
                        echo " <tr>
                                    <td class='entete_profile' >$entete_profile[$i]</td >
                                    <td > $row[$i]</td >";
                        if ($i == 2){
                            echo "<td><a href='modifEmail.html'>Modifier</a></td>";
                        }else if ($i == 4){
                            echo "<td><a href='modifMdp.html'>Modifier</a></td>";
                        }else{
                            echo "<td></td>";
                        }
                        echo "</tr>";
                    }
                   echo"</tbody>
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