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
          require '../ressources/fonctions/PHPfunctions.php';
          global $host, $database, $USER_FICTIF_MDP;
          $connexion = mysqli_connect($host, 'fictif_connexionDB', $USER_FICTIF_MDP['fictif_connexionDB'], $database);

          session_start();
          if (isset($_SESSION['login'], $_SESSION['mdp'])){
              $loginSite = $_SESSION['login'];
              $resSQL = mysqli_fetch_row(executeSQL("SELECT ID_USER FROM UserFictif_connexionDB1 WHERE login_user = ?", array($loginSite), $connexion));
              mysqli_close($connexion);
              $loginMariaDB = $resSQL[0];
              $mdp = $_SESSION['mdp'];
              $connexion = mysqli_connect($host, $loginMariaDB, $mdp, $database);
              $role = recupererRoleDe($connexion);
              if ($role == 'Administrateur Système') {
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
            $requete = "SELECT login_user,  nom_user, email_user, role_user,  prenom_user FROM vue_Utilisateur_client;";
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
                            echo "<td><a href='modifEmail.php'>Modifier</a></td>";
                        }else if ($i == 4){
                            echo "<td><a href='modifMdp.php'>Modifier</a></td>";
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
                    <th>Objet</th>
                    <th>Niv. Urgence Estimée</th>
                    <th>Niv. Urgence Définif</th>
                    <th>Description</th>
                    <th>Etat</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $reqSQL = "SELECT DATE_FORMAT(HORODATAGE_CREATION_TICKET, 'le %d/%m/%Y à %Hh%i'), OBJET_TICKET, NIV_URGENCE_ESTIMER_TICKET,NIV_URGENCE_DEFINITIF_TICKET, DESCRIPTION_TICKET, ETAT_TICKET FROM vue_Ticket_client ORDER BY HORODATAGE_CREATION_TICKET DESC";

                $getResultSQL = mysqli_query($connexion, $reqSQL);

                tableGenerate($getResultSQL);
                ?>
                </tbody>
            </table>
        </div>
    </div>



</body>
</html>