<?php

require "PHPfunctions.php";
require (dirname(__FILE__) . "/../info_db/connexion_db.php");

global $host, $database;

/*
Test de la fonction connectUser (à faire)
*/

assert(connectUser(1, "alice", "azerty!123") == true);
assert(connectUser(0, "alice", "azerty!123") == false);
assert(connectUser(1, "alice", "123!azerty") == false);
assert(connectUser(1, "alice", "") == false);
assert(connectUser(145689, "alice", "azerty!123") == false);
assert(connectUser(145689, "alice", "123!azerty") == false);
assert(connectUser(0, "alice", "") == false);

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
Test de la fonction executeSQL
*/
$connexion = mysqli_connect($host, "root", "", $database);
assert(mysqli_fetch_row(executeSQL("SELECT ID_USER FROM UserFictif_connexion WHERE login_user = ? ", array("alice"), $connexion)) == array(1));
assert(mysqli_fetch_row(executeSQL("SELECT ID_USER FROM UserFictif_connexion WHERE login_user = ? ", array(1), $connexion)) == array());
assert(mysqli_fetch_row(executeSQL("SELECT LOGIN_USER FROM UserFictif_connexion WHERE id_user = ?", array("alice"), $connexion)) == array());
assert(executeSQL("INSERT INTO UTILISATEUR (ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, EMAIL_USER) VALUES (?, ?, ?, ?, ?)", array(10000, "jmarc", "JeanMarc", "DELAVILLE", "jmarc@gmail.com"), $connexion) == false);
assert(executeSQL("UPDATE vue_Utilisateur_maj_email SET email_user= ? WHERE ID_USER = ?", array("jeanmarc@gmail.com", 10000), $connexion) == false);
assert(executeSQL( "DELETE FROM Utilisateur WHERE ID_USER = ? ;", array(10000), $connexion) == false);

/*
Test de la fonction recupereRoleDe
*/

assert(recupererRoleDe(mysqli_connect($host, "1", "azerty!123", $database)) == "Utilisateur");
assert(recupererRoleDe(mysqli_connect($host, "5", "Assuranc3t0ur!x", $database)) == "Administrateur Système");
assert(recupererRoleDe(mysqli_connect($host, "6", "P0rqu3p!x", $database)) == "Administrateur Site");
assert(recupererRoleDe(mysqli_connect($host, "visiteur", "t9t+<Q33Pe%o4woPNwDhNdhZBz", $database)) == "Rôle manquant");
assert(recupererRoleDe(mysqli_connect($host, "4", "azerty!123", $database)) == "Technicien");

/*
Test de la fonction valideEMAIL
*/

assert(valideEMAIL("alice@email.com") == true);
assert(valideEMAIL("alice.avril@email.com") == true);
assert(valideEMAIL(" ") == false);
assert(valideEMAIL("alice#email.com") == false);
assert(valideEMAIL("alicé@email.com") == false);
assert(valideEMAIL("alice@email.c") == false);
assert(valideEMAIL("alice@email.cooom") == false);
assert(valideEMAIL("alice.avrilemail.com") == false);
assert(valideEMAIL("@email.com") == false);
assert(valideEMAIL("alice.avril@") == false);
assert(valideEMAIL("alice.avril@.com") == false);
assert(valideEMAIL("alice.avril@email") == false);
assert(valideEMAIL("@emailalice.avril.fr") == false);
assert(valideEMAIL("alice.avril@.fremail") == false);
assert(valideEMAIL("avril@email.fr.de") == false);
assert(valideEMAIL("alice.avril@email.fr.de") == false);

/*
Test de la fonction verifyCAPCHAT
*/

assert(verifyCAPTCHA(" ", 12, 20 ) == false);
assert(verifyCAPTCHA("!!", 12, 20 ) == false);
assert(verifyCAPTCHA("45", 12, 20 ) == false);
assert(verifyCAPTCHA("32", 12, 20 ) == true);
