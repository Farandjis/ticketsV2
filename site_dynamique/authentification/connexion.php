<?php
require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");

session_start()
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../ressources/style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../ressources/images/logo_sans_texte.png" type="image/x-icon">

    <script src="../ressources/script/afficheMDP.js"></script>
</head>
<body>
    <header>
        <div class="retour">
            <a href="javascript:window.history.go(-1)"><img src="../ressources/images/fleche_retour.png" alt="bouton retour"> Retour</a>
        </div>
    </header>
    <div class="page_authentification_modif_perso">
        <a href="../index.php"><img src="../ressources/images/logo.png" class="logo_plein" alt="logo du site"></a>

        <div role="form" class="formAuthentification formConnexion">

            <form action='action_connexion.php' method='post'>
                <h1 class="h1Conexion">Je me connecte</h1>


                <?php
                if(isset($_GET['id'])) {
                    echo '<div class="erreur">';
                    echo '<p>';
                    if ($_GET['id'] == 2) { echo "ERREUR : Le champ login ou mot de passe est incorrect ou votre compte n'existe pas"; }
                    else if ($_GET['id'] == 3) { echo "ERREUR : Le champ login ou mot de passe est vide"; }
                    else if ($_GET['id'] == 4) { echo "ERREUR : Votre compte à été créer, mais vous n'avez pas pu être connecté."; }
                    else if ($_GET['id'] == 5) { echo "ERREUR : Vous n'avez aucun rôle pour accéder au site."; }
                    else if ($_GET['id'] == 6) { echo "ERREUR : Votre rôle ne permet par la connexion."; }
                    elseif ($_GET['id'] == 7) { echo "ERREUR : Impossible de de vérifier que vous n'êtes pas bannis"; }
                    elseif ($_GET['id'] == 8) { echo "ERREUR : Vous n'êtes pas autorisé à vous connecter à votre compte. Veuillez vous rapprocher de l'administrateur du site."; }
                    else { echo "ERREUR : Une erreur est survenue"; }
                    echo '</p>';
                    echo '</div>';
                }
                ?>


                <label for='login'>Login</label><br>
                <input id='login' type='text' name ='login'>
                <br><br>
                
                <div class="champs-password">
		    <label for='mdp'>Mot de passe</label><br>
                    <input id='mdp' type='password' name ='mdp'><br>
                    <div class="password-show" onclick="showPassword(this)">
                        <img src="../ressources/images/visible.png" alt="mot de passe est visible">
                    </div>
                    <div class="password-hide" onclick="hidePassword(this)">
                        <img src="../ressources/images/hidden.png" alt="Le mot de pass est caché">
                    </div>
                </div>

                <a href="../erreurs/404.html" class="oublie">Mot de passe oublié ?</a>
                <input type='submit' name='Connexion' value='Connexion'><br>
                <a href="inscription.php" class="oublie">Pas de compte ?</a>
            </form>
        </div>
    </div>
</body>
</html>
