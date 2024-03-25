<?php

require(dirname(__FILE__) . "/../../ressources/fonctions/PHPfunctions.php");

$connexionUtilisateur = pageAccess(array('Administrateur Site', 'Administrateur Système'));


echo '

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Administration</title>
        <link rel="stylesheet" href="../style/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="../ressources/images/logo_sans_texte.png" type="image/x-icon">

    </head>
    <body>';




$recupNom = $_GET["nom"];
$recupFichier = $_GET["fichier"];
$recupToday = $_GET["today"];


if (strcmp($recupToday, "true") == -1){
    extractFile("/var/www/logs/archives/". $recupNom ."/" . $recupFichier);
}


echo '<div class="conteneur_table conteneur_table-infructueuse_ouverture-tickets tableau_popup_log">
  <table class="table-infructueuse table-archive-popup">
    <thead>
    <tr id="entete_popup_log">';
if ($recupNom == "ActvCoInf") {
    echo '<th>Date</th>
      <th>Login</th>
      <th>IP</th>
      <th>Tentative</th>';
}

if ($recupNom == "ActvCreTck") {
    echo '<th>Date</th>
      <th>Login</th>
      <th>IP</th>
      <th>Niv.Urgence</th>';
}

if ($recupNom == "Histo"){

    echo '<th>Creation Ticket</th>
      <th>Derniere modif ticket</th>
      <th>Titre</th>
      <th>Niv.Urgence</th>
      <th>Description</th>
      <th>Id User</th>
      <th>Id Technicien</th>';
}

echo '</tr>
  </thead>
  <tbody id="contenu_popup_log">';


if (strcmp($recupToday, "true") == 0){
    csvToHtmlTable("/var/www/logs/journaux". $recupNom . ".csv");
}else{
    csvToHtmlTable("/var/www/logs/temp/var/www/logs/journaux". $recupNom . ".csv");
}

echo '
    </tr>
    </tbody>
</table>
</div>';


?>
</body>
</html>
