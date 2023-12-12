<?php
require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");

deconnexionSite();

// Après avoir effectuer les lignes précédentes,
// cette ligne redirige l'utilisateur vers la page 'index.php'

header('Location: ../');
?>


