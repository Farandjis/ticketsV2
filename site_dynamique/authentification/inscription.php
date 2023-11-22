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
    <a href="../"><img src="../ressources/images/fleche_retour.png" alt=""> Retour</a>
  </div>
</header>
    <div class="page_authentification_modif_perso">
      <img src="../ressources/images/logo.png" class="logo_plein" alt="logo du site">

      <div role="form" class="formAuthentification formInscription">

        <form action='action_inscription.php' method='post'>
            <h1>Je m'inscris !</h1><br>
            <?php

            if (isset($_GET['id'])) {
                echo '<div class="erreur">';
                echo '<p>';

                if ($_GET['id'] == 1) {
                    echo "ERREUR : Merci de passer par ce formulaire.";
                } else if ($_GET['id'] == 2) {
                    echo "ERREUR : Un ou plusieurs champs n'ont pas été remplis.";
                } else if ($_GET['id'] == 3) {
                    echo 'ERREUR : Les mots de passe ne sont pas identiques.';
                } else if ($_GET['id'] == 4) {
                    echo 'ERREUR : Le compte existe déjà.';
                } else if ($_GET['id'] == 5) {
                    echo "ERREUR : La connexion à l'application a échoué.";
                } else if ($_GET['id'] == 6) {
                    echo "ERREUR : Une erreur interne est survenue, votre compte n'a pas pu être créé.";
                } else if ($_GET['id'] == 7) {
                    echo "ERREUR : Ce login est déjà utilisé.";
                } else if ($_GET['id'] == '8a') { echo "ERREUR : Mot de passe invalide : il doit être compris en 12 et 32 caractères compris."; }
                else if ($_GET['id'] == '8b') { echo "ERREUR : Mot de passe invalide : il doit comporter au moins une lettre majuscule."; }
                else if ($_GET['id'] == '8c') { echo "ERREUR : Mot de passe invalide : il doit comporter au moins une lettre minuscule."; }
                else if ($_GET['id'] == '8d') { echo "ERREUR : Mot de passe invalide : il doit comporter au moins un chiffre."; }
                else if ($_GET['id'] == '8e') { echo "ERREUR : Mot de passe invalide : il doit comporter au moins un caractère spécial (hors lettres et chiffres)."; }
                else if ($_GET['id'] == '9') { echo "ERREUR : Prénom invalide : seuls les caractères suivants sont valides : lettres alphabêtiques, lettres avec accent, tirets"; }
                else if ($_GET['id'] == '10') { echo "ERREUR : Nom invalide : seuls les caractères suivants sont valides : lettres alphabêtiques, lettres avec accent, tirets, espaces"; }
                else if ($_GET['id'] == '11') { echo "ERREUR : Adresse email invalide"; }
                else { echo "ERREUR : Une erreur est survenue."; }
                echo '</p>';
                echo '</div>';
            }
            ?>

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
              <label for='capcha'>Captcha non fonctionnel !</label>
              <input id='capcha' type='text' name ='capcha'>
            </div>
          <br>
          <input type='submit' name='Connexion' value='Inscription'>

        </form>

      </div>
    </div>

</body>
</html>