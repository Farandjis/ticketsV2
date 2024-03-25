<?php
require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");

$connection = pageAccess(array('Administrateur Système'));
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration</title>
    <link rel="stylesheet" href="../ressources/style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../ressources/images/logo_sans_texte.png" type="image/x-icon">
    <script src="../ressources/script/afficheMDP.js"></script>
    <script src="../ressources/script/demandeMajPrisonAdministrationEnFonctionDeTitre.js"></script>
    <script src="../ressources/script/demandeInfoBanniPrisonAdministration.js"></script>
    <script src="../ressources/script/demandeInfoSurLeBanniAdministration.js"></script>

</head>
<body>
    <?php affichageMenuDuHaut("administration", $connection);?>

    <h1 class="titre_page">Modération</h1>


    <?php

    $connexionValide = false;

    if ((isset($_POST['logadm'], $_POST['mdpadm'])) and $_POST['logadm'] == "administration_tix"){
        $cmd = shell_exec("echo '".htmlspecialchars($_POST['mdpadm'])."'  | su administration_tix -c 'echo \"Accès à la page Modération de TIX [FORMULAIRE CONNEXION].\"'");
        if ($cmd != null){
            // Si on a réussit à se connecter en tant que administration_tix
            $connexionValide = true;
            $_SESSION['logadm'] = $_POST['logadm'];
            $_SESSION['mdpadm'] = $_POST['mdpadm'];
            session_commit();
        }
    }

    if ((isset($_SESSION['logadm'], $_SESSION['mdpadm'])) and $_SESSION['logadm'] == "administration_tix"){
        $cmd = shell_exec("echo '".htmlspecialchars($_SESSION['mdpadm'])."' | su administration_tix -c 'echo \"Accès à la page Modération de TIX [COOKIE].\"'");
        if ($cmd != null){ $connexionValide = true; } // Si on a réussit à se connecter en tant que administration_tix
    }

    if (! $connexionValide) {
        echo "
    <div role=\"form\" class=\"formAuthentification formConnexion\">

        <form action='moderation.php' method='post'>
            <h1 class=\"h1Conexion\">Connexion au RPi4</h1>
            "?><?php
            if(isset($_GET['id'])) {
                echo '<div class=\"erreur\"><p>';
                if ($_GET['id'] == 2) { echo "ERREUR : Le champ login ou mot de passe est incorrect"; }
                else { echo "ERREUR : Une erreur est survenue"; }
                echo '</p></div>';
            } ?><?php echo "

            <label for='logadm'>Login</label><br>
            <input id='logadm' type='text' name ='logadm'>
            <br><br>

            <div class=\"champs-password\">
                <label for='mdpadm'>Mot de passe</label><br>
                <input id='mdpadm' type='password' name ='mdpadm'><br>
                <div class=\"password-show\" onclick=\"showPassword(this)\">
                    <img src=\"../ressources/images/visible.png\" alt=\"mot de passe est visible\">
                </div>
                <div class=\"password-hide\" onclick=\"hidePassword(this)\">
                    <img src=\"../ressources/images/hidden.png\" alt=\"Le mot de passe est caché\">
                </div>
            </div>

            <input type='submit' name='Connexion' value='Connexion'><br>

        </form>
    </div>
    </body>
    </html>
    ";
    return;
    }



    // La connexion est valide, on affiche la page modération

    // En premier lieu, on insère les données de la prison sélectionné par défaut dans les formulaires
    echo '
    <script>
        window.onload = init;

        function init(){
            demandeMajPrisonAdministrationEnFonctionDeTitre(document.getElementById("prison").value, "appelAutreFonction");
            // note : appelAutreFonction signifie quon appelera à la fin : demandeDonneesBannisPrisonAdministration(document.getElementById("prison2").value)
            // car sinon, elles se font concurrence, donc mieux vaut que lautre lance delle meme la fonction
        }
    </script>
    ';




    $logadm = "administration_tix";
    $mdpadm = $_SESSION['mdpadm'];
    $debutcmdADM = "echo '$mdpadm' | su $logadm -c 'echo \"$mdpadm\" | sudo -S "; // Ne pas oublier le ' à la fin de la commande.
    $output = shell_exec($debutcmdADM . 'fail2ban-client status | grep "Jail list" | sed -E "s/^[^:]+:[ \t]+//" | sed "s/,//g" | grep -o "TIX[^ ]*"\'');
    $prisons = explode("\n", trim($output));
    $output = shell_exec($debutcmdADM . 'fail2ban-client status | grep "Jail list" | sed -E "s/^[^:]+:[ \t]+//" | sed "s/,//g" | grep -o "[^ ]*"\'');
    $allprisons = explode("\n", trim($output));

    ?>

    <div class="moderation">
        <div class="conteneur_table conteneur_table-moderation">
            <table class="table-moderation table-popup">
                <thead>
                <tr>
                    <th>Archive</th>
                    <th>Suppression</th>
                    <th>Télécharger</th>

                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>TEST</td>
                        <td>X</td>
                        <td>TEL</td>

                    </tr>
                    <tr>
                        <td>TEST</td>
                        <td>X</td>
                        <td>TEL</td>

                    </tr>
                    <tr>
                        <td>TEST</td>
                        <td>X</td>
                        <td>TEL</td>

                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <div class="conteneur_config-ban" id="lesFormulaires">
        <div class="conteneur_config-prison">
            <h1>Configuration des prisons</h1>

            <?php
            if(isset($_GET['id']) and ($_GET['id'] > -20 and $_GET['id'] < 20)) {
                echo '<br><div class="erreur">';
                if ($_GET['id'] > -20 and $_GET['id'] <= 0) {
                    echo '<p>';
                    if ($_GET['id'] == 0) {  echo "ERREUR : Une erreur est survenue sur l'un des deux formulaires."; }
                    elseif ($_GET['id'] == -1) {  echo "ERREUR : Données entrées invalide."; }
                    elseif ($_GET['id'] == -2) { echo "ERREUR : Échec de l'exécution de la commande Linux."; }
                    else { echo "ERREUR : Une erreur est survenue"; }
                    echo '</p>';
                }
                elseif ($_GET['id'] > 0 and $_GET['id'] < 20){
                    echo '<p style="color:#00d900;">';
                    if ($_GET['id'] == 1) { echo "SUCCÈS : Les paramètres de la prison ont bien été modifiés."; }
                    else { echo "SUCCÈS : Action effectuée avec succès mais sans message."; }
                    echo '</p>';
                }
                echo '</div><br>';
            }
            ?>

            <form action="action_moderation.php" method="post" class="config-prison" id="formprison1">
                <label for="prison">Prison</label><br>
                <select id="prison" name="prison" onchange="demandeMajPrisonAdministrationEnFonctionDeTitre(value)">
                    <?php foreach ($prisons as $prison) { echo "<option value='$prison'>$prison</option>"; } // On affiche toutes les prisons de TIX (récupérés précédemment) ?>
                </select><br>
                <label for="nb-tentative">Nombre de tentatives autorisées</label><br>
                <input type="number" min="0" max="10" placeholder="0 à 10 essais" id="nb-tentative" name="nb-tentative"><br> <!-- Ajout du nom "nb-tentative" -->
                <label for="nb-temps-oubli">Temps avant l'oubli de la dernière tentative</label><br>
                <input type="number" min="300" max="1800" placeholder="Temps en seconde : 300 à 1800 (5 à 30min)" id="nb-temps-oubli" name="nb-temps-oubli"><br> <!-- Ajout du nom "nb-temps-oubli" -->
                <label for="temps-banni">Temps de banissement</label><br>
                <input type="number" min="120" max="3600" placeholder="Temps en seconde : 120 à 3600 (2min à 1h)" id="temps-banni" name="temps-banni"><br> <!-- Ajout du nom "temps-banni" -->

                <div class="config-prison-submit">
                    <input type="submit" name="modif-config-prison" value="Configurer">
                </div>
            </form>


        </div>
        <div class="conteneur_ban-deban_IP">
            <form action="action_moderation.php" method="post" name="Bannir IP" onsubmit="return confirmerAvantEnvoi(this.name)">
                <h1>SSH / SFTP</h1>

                <?php
                echo '<br><div class="erreur" id="divErreur1">';
                if (isset($_GET['id']) and $_GET['id'] <=-20) {
                    echo '<p>';
                    if ($_GET['id'] == -20) {  echo "ERREUR : Format de l'adresse IP invalide."; }
                    else if ($_GET['id'] == -21) { echo "ERREUR : Échec de l'exécution de la commande Linux."; }
                    else if ($_GET['id'] == -22) { echo "ERREUR : Vous ne pouvez pas bannir votre ordinateur."; }
                    else if ($_GET['id'] == -23) { echo "ERREUR : Vous ne pouvez pas bannir le serveur."; }
                    else if ($_GET['id'] == -24) { echo "ERREUR : Cette IP n'est pas bannis."; }
                    else if ($_GET['id'] == -25) { echo "ERREUR : Veuillez sélectionner une IP."; }
                    else if ($_GET['id'] == -26) { echo "ERREUR : Format de l'adresse IP invalide. Impossible de charger les informations sur le bannissement."; }
                    else { echo "ERREUR : Une erreur est survenue"; }
                    echo '</p>';
                }
                elseif (isset($_GET['id']) and $_GET['id'] >= 20) {
                    echo '<p style="color:#00d900;">';
                    if ($_GET['id'] == 20) { echo "SUCCÈS : L'IP a bien été bannis."; }
                    else if ($_GET['id'] == 21) { echo "SUCCÈS : L'IP a bien été débannis."; }
                    else { echo "SUCCÈS : Action effectuée avec succès mais sans message."; }
                    echo '</p>';
                }
                else {
                    echo '<p style="color:#ffffff;">';
<<<<<<< HEAD
                    echo "<b>IP :</b> XXX.XXX.XXX.XXX<br><b>Banni le :</b> XX/XX/XXXX à XXhXX<br><b>Tentatives :</b> XX";
=======
                    echo "Aucune information à afficher pour le moment.";
>>>>>>> moderation
                    echo '</p>';
                }
                echo '</div><br>';

                ?>

                <label for="prison2">Prison</label><br>
                <select id="prison2" name="prison2" onchange="demandeDonneesBannisPrisonAdministration(document.getElementById('prison2').value)"> <!-- Ajout du nom "prison" -->
                    <?php foreach ($allprisons as $prison) { echo "<option value='$prison'>$prison</option>"; } // On affiche toutes les prisons de TIX (récupérés précédemment) ?>
                </select><br>
                <label for="bannir_ip">Bannir une IP :</label><br>
                <div class="ban-deban_ip">
                    <input type="text" name="bannir_ip" id="bannir_ip" placeholder="XXX.XXX.XXX.XXX">
                    <br>
                    <input type="submit" name="submit_bannir_ip" value="Bannir">
                </div>

                <label for="debannir_ip">Débannir une IP :</label><br>
                <div class="ban-deban_ip">
                    <div class="custom-select">
                        <select name="debannir_ip" id="debannir_ip">
                            <option value="" selected>Attente de chargement...</option>
                        </select>
                    </div><br>
                    <input type="submit" name="submit_debannir_ip" value="Débannir">
                </div>
            </form>
        </div>
    </div>

</body>
</html>
