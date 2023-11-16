<!DOCTYPE html>
<html lang="fr">
<head>
      <meta charset="UTF-8">
      <title>Inscription</title>
      <link href="../ressources/style/style.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
      <link rel="shortcut icon" href="../ressources/images/logo_sans_texte.png" type="image/x-icon">
</head>
<body>
<header>
  <div class="retour">
    <a href="index.php"><img src="../ressources/images/fleche_retour.png" alt=""> Retour</a>
  </div>
</header>
    <div class="page_authentification_modif_perso">
      <img src="../ressources/images/logo.png" class="logo_plein" alt="logo du site">

      <div role="form" class="formAuthentification formInscription">

        <form action='action_inscription.php' method='post'>
            <h1>Je m'inscris !</h1><br>
            <div class="champs-inscription">
               <div class="inscription-gauche">
                  <label for='login'>Login</label><br>
                  <input id='login' type='text' name ='login'>
                  <br><br>
                  <label for='mdp'>Mot de passe</label><br>
                  <input id='mdp' type='password' name ='mdp'>
                  <br><br>
                  <label for='mdp2'>Vérificaction mot de passe</label><br>
                  <input id='mdp2' type='password' name ='mdp2'>
               </div>

               <div class="inscription-droite">
                  <label for='nom'>Nom</label><br>
                  <input id='nom' type='text' name ='nom'>
                  <br><br>
                  <label for='prenom'>Prénom</label><br>
                  <input id='prenom' type='text' name ='prenom'>
                  <br><br>
                  <label for='email'>Email</label><br>
                  <input id='email' type='text' name ='email'>
               </div>
           </div>
          <br>
            <div class ="capcha">
              <label for='capcha'>Capcha</label>
              <input id='capcha' type='text' name ='capcha'>
            </div>
          <br>
          <input type='submit' name='Connexion' value='Inscription'>

        </form>

      </div>
    </div>

</body>
</html>

<?php

if (isset($_GET['id'])) {
    if ($_GET['id'] == 1) {
        echo "Merci de passer par ce formulaire";
    } else if ($_GET['id'] == 2) {
        echo "Un ou plusieurs n'ont pas été rempli";
    } else if ($_GET['id'] == 3) {
        echo 'Les mots de passe ne sont pas pareils';
    } else if ($_GET['id'] == 4) {
        echo 'Le compte existe déjà';
    } else if ($_GET['id'] == 5) {
        echo "La connexion à l'application à échouer";
    }
}
?>