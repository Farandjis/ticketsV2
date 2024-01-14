<?php
require '../ressources/fonctions/PHPfunctions.php';

$connexionUtilisateur = pageAccess(array('Utilisateur', 'Technicien'));
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Desinscription</title>
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

        <form action='action_desinscription.php' method='post'>
            <h1 class="h1Conexion">Désinscription</h1><br>

            <?php
            if(isset($_GET['id'])) {
                echo '<div class="erreur">';
                echo '<p>';
                if ($_GET['id'] == 1) { echo "ERREUR : Les données ne sont pas définies"; }
                else if ($_GET['id'] == 2) { echo "ERREUR : Un ou plusieurs champs sont vides"; }
                else if ($_GET['id'] == 3) { echo "ERREUR : Le champ login ou mdp ou les deux sont incorrect"; }
                else if ($_GET['id'] == 4) { echo "ERREUR : Le champ Captcha est vide"; }
                else if ($_GET['id'] == 5) { echo "ERREUR : Le champ Captcha est incorrect"; }
                else if ($_GET['id'] == 6) { echo "ERREUR : Une erreur est survenue lors de la desinscription"; }
                else { echo "ERREUR : Une erreur est survenue"; }
                echo '</p>';
                echo '</div>';
            }
            ?>

            <label for='login'>Login</label>
            <input id='login' type='text' name ='login'>
            <br><br>
            <div class="champs-password">
                <label for='Amdp'>Mot de passe</label>
                <input id='Amdp' type='password' name ='Amdp'>

                <div class="password-show" onclick="showPassword(this)">
                    <img src="../ressources/images/visible.png">
                </div>
                <div class="password-hide" onclick="hidePassword(this)">
                    <img src="../ressources/images/hidden.png">
                </div>
            </div>
            <br>
            <div class="capcha">
                <label for="captcha">Captcha</label>

                <p><?php operationCAPTCHA(); ?></p>
            </div>
            <br>

            <h1 class="h1Conexion">Confirmation</h1><br>
            <h3>Je confirme ma demande de suppression</h3>

                <div>
                    <label for="confirmationOui">
                        <div class="info-bulle">
                            <span class="text-info-bulle"><span>J'ai conscience que la suppression de mon compte est définitive et irréversible</span>.</span>
                            <input type="checkbox" name="confirmation" id="confirmationOui" required>
                        OUI
                        </div>
                    </label>
                </div>

            <br>
            <input type='submit' name='Validation' value='Valider'><br>


        </form>
    </div>
</div>
</body>
</html>

