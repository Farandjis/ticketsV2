<?php

require "PHPfunctions.php";
require (dirname(__FILE__) . "/../info_db/connexion_db.php");

global $host, $database;

/*
Test de la fonction connectUser (à faire)
*/


/*
Test de la fonction valideMDP
*/

assert(valideMDP("Azertyalice!123") == 1);
assert(valideMDP("azertyalice!123") == -1);
assert(valideMDP("Azertyalice123") == -4);
assert(valideMDP("Azertyalice!") == -3);
assert(valideMDP("Azerty!123") == 0);
assert(valideMDP("Azertyaliceavrilbonjourrrr!123456") == 0);
assert(valideMDP("AZERTYALICE!123") == -2);

/*
Test de la fonction executeSQL (à faire)
*/

/*
Test de la fonction recupereRoleDe
*/

assert(recupererRoleDe(mysqli_connect($host, "1", "azerty!123", $database)) == "Utilisateur");
assert(recupererRoleDe(mysqli_connect($host, "5", "Assuranc3t0ur!x", $database)) == "Administrateur Système");
assert(recupererRoleDe(mysqli_connect($host, "6", "P0rqu3p!x", $database)) == "Administrateur Site");
assert(recupererRoleDe(mysqli_connect($host, "visiteur", "t9t+<Q33Pe%o4woPNwDhNdhZBz", $database)) == "Rôle manquant");
assert(recupererRoleDe(mysqli_connect($host, "4", "azerty!123", $database)) == "Technicien");
