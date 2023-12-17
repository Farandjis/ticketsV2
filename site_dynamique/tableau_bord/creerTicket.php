<?php
require '../ressources/fonctions/PHPfunctions.php';

$connexionUtilisateur = pageAccess(array('Utilisateur', 'Technicien', 'Administrateur Site', 'Administrateur Système'));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Création de Ticket</title>
    <link rel="stylesheet" href="../ressources/style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../ressources/images/logo_sans_texte.png" type="image/x-icon">
    <script src="../ressources/script/script.js"></script>
</head>
<body>
    <header>
        <div class="retour">
            <a href="tableaudebord.php"><img src="../ressources/images/fleche_retour.png" alt=""> Retour</a>
        </div>
    </header>
    <div class="page_cree-modif_ticket">
        <h1 class="h1Creation">Création de Ticket</h1>
        <div role="form" class="formCreeTicket formAuthentification formConnexion">
            <form action='action_creationTicket.php' method='post'>
                <?php
                if(isset($_GET['id'])) {
                    echo '<div class="erreur">';
                    echo '<p>';
                    if ($_GET['id'] == 1) { echo "ERREUR : Des données du formulaire sont manquantes"; }
                    else if ($_GET['id'] == 2) { echo "ERREUR : Des données essentielles du formulaire sont manquantes ou incohérentes"; }
                    else { echo "ERREUR : Une erreur est survenue"; }
                    echo '</p>';
                    echo '</div>';
                }
                ?>
                <label for='nature'>Nature du problème *</label><br>
                <input id='nature' type='text' name ='nature'>
                <br><br>
                <div class="div_separ">
                    <div class="gauche">
                        <label for='nivUrg'>Niveau d'urgence</label><br>
                        <div class="custom-select">
                            <select name="nivUrg" id="nivUrg" class="creer_select">
                                <option value="">--Choisir une option--</option>
                                <option value="faible">Faible</option>
                                <option value="moyen">Moyen</option>
                                <option value="important">Important</option>
                                <option value="urgent">Urgent</option>
                            </select>
                        </div>
                    </div>

                    <div class="droite">
                        <span>Libellé</span><br>
                        <div class="menu_libelle" id="menu_deroulant_libelle">
                            <span class="entete_libelle" onclick="toggleDropdown()">Sélectionnez un/des libellé(s) ↓</span>
                            <div class="option_libelle">
                                <?php
                                menuDeroulantTousLesLibelles($connexionUtilisateur);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>


                <br>
                <label for='explication'>Explication</label><br>
                <textarea id="explication" name="explication" ></textarea><br>

                <input type='submit' name='cree' value='Créer'><br>
            </form>
        </div>
    </div>
</body>
</html>