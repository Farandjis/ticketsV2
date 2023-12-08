<?php
require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connexionUtilisateur = pageAccess(array('Utilisateur', 'Technicien')); // Renvoi vers e403 si la personne n'a pas accès
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modification mot de passe</title>
    <link rel="stylesheet" href="../ressources/style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../ressources/images/logo_sans_texte.png" type="image/x-icon">
</head>
<body>
    <header>
        <div class="retour">
            <a href="javascript:window.history.go(-1)"><img src="../ressources/images/fleche_retour.png" alt=""> Retour</a>
        </div>
    </header>
    <div class="page_authentification_modif_perso">
        <a href="../index.php"><img src="../ressources/images/logo.png" class="logo_plein" alt="logo du site"></a>

        <div role="form" class="formAuthentification formConnexion">

            <form action='action_modifMdp.php' method='post'>
                <h1 class="h1Conexion">Modification : Mot de passe</h1><br>

                <?php
                if(isset($_GET['id'])) {
                    echo '<div class="erreur">';
                    echo '<p>';
                    if ($_GET['id'] == 1) { echo "ERREUR : Un des champs ou tout les champs sont manquants "; }
                    else if ($_GET['id'] == 2) { echo "ERREUR : Un des champs ou tout les champs sont vides"; }
                    else if ($_GET['id'] == 3) { echo "ERREUR : Le champ nouveau mot de passe et sa confirmation sont différents "; }
                    else if ($_GET['id'] == 4) { echo "ERREUR : Le nouveau mot de passe est trop court ou trop long"; }
                    else if ($_GET['id'] == 5) { echo "ERREUR : Le nouveau mot de passe necessite une majuscule"; }
                    else if ($_GET['id'] == 6) { echo "ERREUR : Le nouveau mot de passe necessite une minuscule"; }
                    else if ($_GET['id'] == 7) { echo "ERREUR : Le nouveau mot de passe necessite un chiffre"; }
                    else if ($_GET['id'] == 8) { echo "ERREUR : Le nouveau mot de passe necessite un caractère spécial"; }
                    else if ($_GET['id'] == 9) { echo "ERREUR : Erreur lors de la mise à jour du mot de passe"; }
                    else if ($_GET['id'] == 10) { echo "ERREUR : Erreur lors de la reconnexion avec l'ancien mot de passe"; }
                    else if ($_GET['id'] == 11) { echo "ERREUR : Le mot de passe entré ne correspond pas au mot de passe actuel"; }
                    else { echo "ERREUR : Une erreur est survenue"; }
                    echo '</p>';
                    echo '</div>';
                }
                ?>

                <label for='Amdp'>Mot de passe</label><br>
                <input id='Amdp' type='password' name ='Amdp'>
                <br><br>
                <label for='Nmdp'>Nouveau mot de passe</label><br>
                <input id='Nmdp' type='password' name ='Nmdp'><br>
                <br>
                <label for='Cmdp'>Confirmation mot de passe</label><br>
                <input id='Cmdp' type='password' name ='Cmdp'><br><br>

                <input type='submit' name='Modification' value='Modification'><br>

            </form>
        </div>
    </div>
</body>
</html>