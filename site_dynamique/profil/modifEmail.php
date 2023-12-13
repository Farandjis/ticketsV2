<?php
require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connexionUtilisateur = pageAccess(array('Utilisateur', 'Technicien')); // Renvoi vers e403 si la personne n'a pas accès
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modification Email</title>
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

                <label for='mdp'>Mot de passe</label><br>
                <input id='mdp' type='password' name ='mdp'>
                <br><br>
                <label for='Nemail'>Nouvel email</label><br>
                <input id='Nemail' type='text' name ='Nemail'><br>
                <br>

                <input type='submit' name='Modification' value='Modification'><br>



            </form>
        </div>
    </div>
</body>
</html>
