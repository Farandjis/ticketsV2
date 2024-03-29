<?php
require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connexionUtilisateur = pageAccess(array('Utilisateur', 'Technicien', 'Administrateur Site', 'Administrateur Système')); // Renvoi vers e403 si la personne n'a pas accès
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modification Email</title>
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

        <div role="form" class="formModifEmail formAuthentification formConnexion">

            <form action='action_modifEmail.php' method='post'>
                <h1 class="h1Conexion">Modification : Email</h1><br>

                <?php
                if(isset($_GET['id'])) {
                    echo '<div class="erreur">';
                    echo '<p>';
                    if ($_GET['id'] == 1) { echo "ERREUR : Le champ mot de passe ou nouvel email est manquant "; }
                    else if ($_GET['id'] == 2) { echo "ERREUR : Le mot de passe ou nouvel email ou les deux champs sont vides"; }
                    else if ($_GET['id'] == 3) { echo "ERREUR : Le champ mot de passe est incorrect"; }
                    else if ($_GET['id'] == 4) { echo "ERREUR : Le champ nouvel email est invalide"; }
                    else if ($_GET['id'] == 5) { echo "ERREUR : Erreur lors de la mise à jour"; }
                    else if ($_GET['id'] == 6) { echo "ERREUR : Connexion à la base de données impossible"; }
                    else { echo "ERREUR : Une erreur est survenue"; }
                    echo '</p>';
                    echo '</div>';
                }
                ?>


                <div class="champs-password">
                    <div class="info-bulle">
                        <label for='mdp'>Mot de passe </label><br>
                        <input id='mdp' type='password' name ='mdp'>
                        <span class="text-info-bulle">Le mot de passe doit être similaire au mot de passe inscrit lors de l'inscription <span>s'il n'a pas été changé</span>.</span>
                    </div><span id="infoMdp" class="infosChamps" onclick="afficheInfo(this)"></span><br>

                    <div class="password-show" onclick="showPassword(this)">
                        <img src="../ressources/images/visible.png" alt="mot de passe est visible">
                    </div>
                    <div class="password-hide" onclick="hidePassword(this)">
                        <img src="../ressources/images/hidden.png" alt="Le mot de passe est caché">
                    </div>
                </div>
                <br>

                <label for='Nemail'>Nouvel email</label><br>
                <input id='Nemail' type='text' name ='Nemail'><br>
                <br>

                <input type='submit' name='Modification' value='Modification'><br>

            </form>
        </div>
    </div>
</body>
</html>
