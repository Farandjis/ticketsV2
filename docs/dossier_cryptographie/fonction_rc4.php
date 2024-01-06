<?php
// Vide pour le moment


function generation_suite_chiffrante($clef){

}

function rc4_chiffrement($clef, $texte){

}

function rc4_dechiffrement($clef, $texteChiffre){

}

function tests(){

    echo "<h1>Bienvenue sur cette page de test de notre fonction RC4 !</h1>";

    $clef = array("Key", "Wiki", "Secret");
    $suiteChiffrante = array("", "", "04D46B053CA87B59");
    $texte = array("Plaintext", "pedia", "Attack at down");
    $texteChiffre = array("BBF316E8D940AF0AD3", "1021BF0420", "45A01F645FC35B383552544B9BF5");

    var_dump($clef); echo "<br>";
    var_dump($suiteChiffrante); echo "<br>";
    var_dump($texte); echo "<br>";
    var_dump($texteChiffre); echo "<br>";

    echo "<br><br><h4>Test 0</h4>";
    $res0 = rc4_chiffrement($clef[0], $texte[0]) == $texteChiffre[0];
    echo "<p>Génération de la suite chiffrante <b>$clef[2]</b> : " . generation_suite_chiffrante($clef[2]) . "</b> - <b>" . $suiteChiffrante[2] . "</b></p>";
    if ($res0){ echo "<p>Succès !</p>"; } else { echo "<p> Échec !</p>"; }
    
    echo "<br><br><h4>Test 1</h4>";
    $res1 = rc4_chiffrement($clef[0], $texte[0]) == $texteChiffre[0];
    echo "<p>Chiffrement de <b>$texte[0]</b> avec la clef <b>$clef[0]</b> : <b>" . rc4_chiffrement($clef[0], $texte[0]) . "</b> - <b>" . $texteChiffre[0] . "</b></p>";
    if ($res1){ echo "<p>Succès !</p>"; } else { echo "<p> Échec !</p>"; }

    echo "<br><br><h4>Test 2</h4>";
    $res2 = rc4_chiffrement($clef[1], $texte[1]) == $texteChiffre[1];
    echo "<p>Chiffrement de <b>$texte[1]</b> avec la clef <b>$clef[1]</b> : <b>" . rc4_chiffrement($clef[1], $texte[1]) . "</b> - <b>" . $texteChiffre[1] . "</b></p>";
    if ($res2){ echo "<p>Succès !</p>"; } else { echo "<p> Échec !</p>"; }

    echo "<br><br><h4>Test 2</h4>";
    $res3 = rc4_chiffrement($clef[2], $texte[2]) == $texteChiffre[2];
    echo "<p>Chiffrement de <b>$texte[2]</b> avec la clef <b>$clef[2]</b> : <b>" . rc4_chiffrement($clef[2], $texte[2]) . "</b> - <b>" . $texteChiffre[2] . "</b></p>";
    if ($res3){ echo "<p>Succès !</p>"; } else { echo "<p> Échec !</p>"; }

}


tests();