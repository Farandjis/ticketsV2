<?php
require "../ressources/fonctions/PHPfunctions.php";
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link href="../ressources/style/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../ressources/images/logo_sans_texte.png" type="image/x-icon">

    <script src="../ressources/script/afficheMDP.js"></script>
    <script src="../ressources/script/verifChamp.js"></script>
    <script src="../ressources/script/infoChamps.js"></script>
</head>
<body>
<header>
    <div class="retour">
        <a href="javascript:window.history.go(-1)"><img src="../ressources/images/fleche_retour.png" alt="flèche retour"> Retour</a>
    </div>
</header>
<div class="page_authentification_modif_perso">
    <img src="../ressources/images/logo.png" class="logo_plein" alt="logo du site">

    <div class="formAuthentification formInscription">

        <form action="action_inscription.php" method="post" id="inscriptionForm">
            <h1>Je m'inscris !</h1>
            <?php

            if (isset($_GET["id"])) {
                echo "<div class='erreur'>";
                echo "<p>";

                if ($_GET["id"] == 1) {
                    echo "ERREUR : Merci de passer par ce formulaire.";
                } else if ($_GET["id"] == 2) {
                    echo "ERREUR : Un ou plusieurs champs n'ont pas été remplis.";
                } else if ($_GET["id"] == 3) {
                    echo "ERREUR : Les mots de passe ne sont pas identiques.";
                } else if ($_GET["id"] == 4) {
                    echo "ERREUR : Le compte existe déjà.";
                } else if ($_GET["id"] == 5) {
                    echo "ERREUR : La connexion à l'application a échoué.";
                } else if ($_GET["id"] == 6) {
                    echo "ERREUR : Une erreur interne est survenue, votre compte n'a pas pu être créé.";
                } else if ($_GET["id"] == 7) {
                    echo "ERREUR : Ce login est déjà utilisé.";
                } else if ($_GET["id"] == "8a") { echo "ERREUR : Mot de passe invalide : il doit être compris en 12 et 32 caractères compris."; }
                else if ($_GET["id"] == "8b") { echo "ERREUR : Mot de passe invalide : il doit comporter au moins une lettre majuscule."; }
                else if ($_GET["id"] == "8c") { echo "ERREUR : Mot de passe invalide : il doit comporter au moins une lettre minuscule."; }
                else if ($_GET["id"] == "8d") { echo "ERREUR : Mot de passe invalide : il doit comporter au moins un chiffre."; }
                else if ($_GET["id"] == "8e") { echo "ERREUR : Mot de passe invalide : il doit comporter au moins un caractère spécial (hors lettres et chiffres)."; }
                else if ($_GET["id"] == "9") { echo "ERREUR : Prénom invalide : seuls les caractères suivants sont valides : lettres alphabêtiques, lettres avec accent, tirets"; }
                else if ($_GET["id"] == "10") { echo "ERREUR : Nom invalide : seuls les caractères suivants sont valides : lettres alphabêtiques, lettres avec accent, tirets, espaces"; }
                else if ($_GET["id"] == "11") { echo "ERREUR : Adresse email invalide : mauvais format ou caractère interdit."; }
                else if ($_GET["id"] == "12") { echo "ERREUR : Le prénom doit être compris entre 1 et 30 caractère."; }
                else if ($_GET["id"] == "13") { echo "ERREUR : Le nom doit être compris entre 1 et 30 caractère."; }
                else if ($_GET["id"] == "14") { echo "ERREUR : Le login doit être compris entre 5 et 20 caractère."; }
                else if ($_GET["id"] == "15") { echo "ERREUR : L'adresse email doit être compris entre 5 et 100 caractère."; }
                else if ($_GET["id"] == "16") { echo "ERREUR : Le captcha n'est pas correcte, recommencez."; }
                else if ($_GET["id"] == "17") { echo "ERREUR : Le captcha doit être complété !"; }
                else { echo "ERREUR : Une erreur est survenue."; }
                echo "</p>";
                echo "</div>";
            }
                echo '<div id="conteneur_infoChamps">
            </div>
            <div class="champs-inscription">
                <div class="inscription-gauche">


                    <div class="info-bulle">
                        <label for="login">Login <br>
                            <input id="login" type="text" name="login" ' . (isset($_SESSION['login']) ? 'value="' . $_SESSION["login"] . '"' : '') . '>
                            <span class="text-info-bulle">Le login doit contenir<br> Entre <span>5 et 32 caractères</span>.</span>
                        </label>
                    </div><span id="infoLogin" class="infosChamps" onclick="afficheInfo(this)">?</span><br>

                    <br>

                    <div class="champs-password">
                        <div class="info-bulle">
                            <label for="mdp">Mot de passe <br>
                                <input id="mdp" type="password" name ="mdp" ' . (isset($_SESSION['mdp']) ? 'value="' . $_SESSION["mdp"] . '"' : '') . '>
                                <span class="text-info-bulle">Le mot de passe doit contenir entre <span>12 et 32 caractères</span> et au moins une <span>minuscule</span>, <br>une <span>majuscule</span>, un <span>chiffre</span> et <br>un <span> caractère spécial</span>.</span>
                            </label>
                        </div><span id="infoMdp" class="infosChamps" onclick="afficheInfo(this)">?</span><br>


                        <div class="password-show" onclick="showPassword(this)">
                            <img src="../ressources/images/visible.png" alt="mot de passe est visible">
                        </div>
                        <div class="password-hide" onclick="hidePassword(this)">
                            <img src="../ressources/images/hidden.png" alt="Le mot de pass est caché">
                        </div>
                    </div>
                    <br>

                    <div class="champs-password">

                        <div class="info-bulle">
                            <label for="verifMdp">Vérification mot de passe <br>
                                <input id="verifMdp" type="password" name ="verifMdp" ' . (isset($_SESSION['verifMdp']) ? 'value="' . $_SESSION["verifMdp"] . '"' : '') . '>
                                <span class="text-info-bulle">La vérification du mot de passe <span>doit être identique au mot de passe</span>.</span>
                            </label>
                        </div> <span id="infoVerifMdp" class="infosChamps" onclick="afficheInfo(this)">?</span><br>

                        <div class="password-show" onclick="showPassword(this)">
                            <img src="../ressources/images/visible.png" alt="mot de passe est visible">
                        </div>
                        <div class="password-hide" onclick="hidePassword(this)">
                            <img src="../ressources/images/hidden.png" alt="Le mot de passe est caché">
                        </div>
                    </div>

                </div>

                <div class="inscription-droite">


                    <div class="info-bulle">
                        <label for="nom">Nom <br>
                            <input id="nom" type="text" name ="nom" ' . (isset($_SESSION['nom']) ? 'value="' . $_SESSION["nom"] . '"' : '') . '>
                            <span class="text-info-bulle">Le Nom ne doit contenir <span><br>que des lettres ou le caractère "-"</span> et posséder entre <span>2 et 50 caractères</span>.</span>
                        </label>
                    </div> <span id="infoNom" class="infosChamps" onclick="afficheInfo(this)">?</span><br>
                    <br>


                    <div class="info-bulle">
                        <label for="prenom">Prénom <br>
                            <input id="prenom" type="text" name ="prenom" ' . (isset($_SESSION['prenom']) ? 'value="' . $_SESSION["prenom"] . '"' : '') . '>
                            <span class="text-info-bulle">Le Prénom ne doit contenir <span>que des lettres ou le caractère "-"</span> et posséder entre <span>2 et 50 caractères</span>.</span>
                        </label>
                    </div> <span id="infoPrenom" class="infosChamps" onclick="afficheInfo(this)">?</span> <br>

                    <br>


                    <div class="info-bulle">
                        <label for="email">Email <br>
                            <input id="email" type="text" name ="email" ' . (isset($_SESSION['email']) ? 'value="' . $_SESSION["email"] . '"' : '') . '>
                            <span class="text-info-bulle">L"email doit avoir<br>un <span>format standard</span><br>(ex: etudiant@ens.uvsq.fr)</span>
                        </label>
                    </div> <span id="infoEmail" class="infosChamps" onclick="afficheInfo(this)">?</span><br>
                </div>
            </div>';

            ?>
            <br>
                <div class="capcha">
                    <label for="captcha">Captcha</label>

                    <p><?php operationCAPTCHA(); ?></p>
                </div>

                <a href="connexion.php" class="oublie">Déjà un compte ?</a>

                <input type="submit" name="Connexion" value="Inscription">

        </form>

    </div>
</div>

</body>
</html>