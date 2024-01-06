<?php

require (dirname(__FILE__) . "/fonction_rc4.php");

function tests(){

    echo "<h1>Bienvenue sur cette page de test de notre fonction RC4 !</h1>";

    $clef = array("Key", "Wiki", "Secret");
    $suiteChiffrante = array("EB9F7781B734CA72A719", "6044DB6D41B7", "04D46B053CA87B59");
    $texte = array("Plaintext", "pedia", "Attack at down");
    $texteChiffre = array("BBF316E8D940AF0AD3", "1021BF0420", "45A01F645FC35B383552544B9BF5");

    var_dump($clef); echo "<br>";
    var_dump($suiteChiffrante); echo "<br>";
    var_dump($texte); echo "<br>";
    var_dump($texteChiffre); echo "<br>";


    echo "<br><br><h4>Test A1</h4>";
    $resSuiteChiffrante = convertionArrayDeBytesEnHexadecimal(suite_chiffrante(KSA($clef[0])));
    $res = (! stristr($resSuiteChiffrante, $suiteChiffrante[0]) === false);
    echo "<p>Génération de la suite chiffrante <b>$clef[0]</b> : " . $resSuiteChiffrante . "</b> - <b>" . $suiteChiffrante[0] . "...</b></p>";
    if ($res){ echo "<p>Succès !</p>"; } else { echo "<p> Échec !</p>"; }

    echo "<br><br><h4>Test A2</h4>";
    $resSuiteChiffrante = convertionArrayDeBytesEnHexadecimal(suite_chiffrante(KSA($clef[1])));
    $res = (! stristr($resSuiteChiffrante, $suiteChiffrante[1]) === false);
    echo "<p>Génération de la suite chiffrante <b>$clef[1]</b> : " . $resSuiteChiffrante . "</b> - <b>" . $suiteChiffrante[1] . "...</b></p>";
    if ($res){ echo "<p>Succès !</p>"; } else { echo "<p> Échec !</p>"; }

    echo "<br><br><h4>Test A3</h4>";
    $resSuiteChiffrante = convertionArrayDeBytesEnHexadecimal(suite_chiffrante(KSA($clef[2])));
    $res = (! stristr($resSuiteChiffrante, $suiteChiffrante[2]) === false);
    echo "<p>Génération de la suite chiffrante <b>$clef[2]</b> : " . $resSuiteChiffrante . "</b> - <b>" . $suiteChiffrante[2] . "...</b></p>";
    if ($res){ echo "<p>Succès !</p>"; } else { echo "<p> Échec !</p>"; }




    echo "<br><br><h4>Test B1</h4>";
    $res = rc4_chiffrement($clef[0], $texte[0]) == $texteChiffre[0];
    echo "<p>Chiffrement de <b>$texte[0]</b> avec la clef <b>$clef[0]</b> : <b>" . rc4_chiffrement($clef[0], $texte[0]) . "</b> - <b>" . $texteChiffre[0] . "</b></p>";
    if ($res){ echo "<p>Succès !</p>"; } else { echo "<p> Échec !</p>"; }

    echo "<br><br><h4>Test B2</h4>";
    $res = rc4_chiffrement($clef[1], $texte[1]) == $texteChiffre[1];
    echo "<p>Chiffrement de <b>$texte[1]</b> avec la clef <b>$clef[1]</b> : <b>" . rc4_chiffrement($clef[1], $texte[1]) . "</b> - <b>" . $texteChiffre[1] . "</b></p>";
    if ($res){ echo "<p>Succès !</p>"; } else { echo "<p> Échec !</p>"; }

    echo "<br><br><h4>Test B3</h4>";
    $res = rc4_chiffrement($clef[2], $texte[2]) == $texteChiffre[2];
    echo "<p>Chiffrement de <b>$texte[2]</b> avec la clef <b>$clef[2]</b> : <b>" . rc4_chiffrement($clef[2], $texte[2]) . "</b> - <b>" . $texteChiffre[2] . "</b></p>";
    if ($res){ echo "<p>Succès !</p>"; } else { echo "<p> Échec !</p>"; }

}


tests();
