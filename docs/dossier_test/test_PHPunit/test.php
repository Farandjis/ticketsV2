<?php

require "PHPfunctions.php";

/*
Test de la fonction connectUser (à faire)
*/


/*
Test de la fonction valideMDP (à faire)
*/

assert(valideMDP("Azertyalice!123") == 1);
assert(valideMDP("azertyalice!123") == -1);
assert(valideMDP("Azertyalice123") == -4);
assert(valideMDP("Azertyalice!") == -3);
assert(valideMDP("Azerty!123") == 0);
assert(valideMDP("Azertyaliceavrilbonjourrrr!123456") == 0);
assert(valideMDP("AZERTYALICE!123") == -2);
