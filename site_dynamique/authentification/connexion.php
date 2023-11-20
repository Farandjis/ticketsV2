<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../ressources/style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../ressources/logo_sans_texte.png" type="image/x-icon">
</head>
<body>
    <header>
        <div class="retour">
            <a href="../index.php"><img src="../ressources/images/fleche_retour.png" alt=""> Retour</a>
        </div>
    </header>
    <div class="page_authentification_modif_perso">
        <img src="../ressources/images/logo.png" class="logo_plein" alt="logo du site">

        <div role="form" class="formAuthentification formConnexion">

            <form action='action_connexion.php' method='post'>
                <h1 class="h1Conexion">Je me connecte</h1>


                <?php
                if(isset($_GET['id'])) {
                    echo '<div class="erreur">';
                    echo '<p>';
                    if ($_GET['id'] == 2) {
                        echo "ERREUR : Le champ login ou mot de passe est incorrect";
                    }
                    else if ($_GET['id'] == 3) {
                        echo "ERREUR : Le champ login ou mot de passe est vide";
                    }
                    else {
                        echo "ERREUR : Une erreur est survenue";
                    }
                    echo '</p>';
                    echo '</div>';
                }
                ?>





                <label for='login'>Login</label><br>
                <input id='login' type='text' name ='login'>
                <br><br>
                <label for='mdp'>Mdp</label><br>
                <input id='mdp' type='password' name ='mdp'><br>
                <a href="MdpOublie.php" class="oublie">Mot de passe oublié ?</a>
                <input type='submit' name='Connexion' value='Connexion'><br>
                <a href="inscription.php" class="oublie">Pas de compte ?</a>
            </form>
        </div>
    </div>
</body>
</html>
