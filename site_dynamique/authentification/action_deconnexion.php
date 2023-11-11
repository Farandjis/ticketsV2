<?php
// Démarre une session
session_start();

// Vérifie si les variables de session 'login' et 'mdp' sont définies
if (isset($_SESSION['login'], $_SESSION['mdp'])){
    // Supprime les variables de session 'login' et 'mdp'
    unset($_SESSION['login'], $_SESSION['mdp']);
}

// Détruit toutes les données de session existantes.
session_destroy();

// Après avoir effectuer les lignes précédentes,
// cette ligne redirige l'utilisateur vers la page 'index.php'

header('Location: index.php');
?>


