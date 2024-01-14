<?php


function convertionArrayDeBytesEnHexadecimal($arr){
    // fonction entièrement recopié de :
    // https://stackoverflow.com/questions/31211772/how-to-convert-an-array-of-bytes-to-a-hex-string
    // Et fonctionne parfaitement !

    $hex_str = "";
    foreach ($arr as $byte)
    {
        $hex_str .= sprintf("%02X", $byte);
        // echo sprintf("%02X", $byte); echo "<br>";
    }

    return $hex_str;
}


/** Principe :
 *      Génère une permutation à partir de la clef.
 *      Fondé sur l'algorithme 2 donné dans le sujet.
 *  Paramètre :
 *      - @param string $clefK : la clé dont on génère la permutation
 *  Renvoi :
 *      - @return array $permutationS : la permutation de la clé
 */
function KSA(string $clefK): array{
    // https://www.php.net/manual/en/function.ord.php
    // ord — Convert the first byte of a string to a value between 0 and 255

    $permutationS = array();
    $l = strlen($clefK); // taille de la clé

    $clefKbin = array(); // Liste représentant la clef où chaque valeur correspond à la convertion charactère -> int de la clef.
    for ($i = 0; $i < $l; $i++){
        $clefKbin[] = ord($clefK[$i]);
    }

    for ($i = 0; $i < 256; $i++){
        $permutationS[] = $i;
    }

    $j = 0;
    for ($i = 0; $i < 256; $i++){
        $j = ($j + $permutationS[$i] + $clefKbin[$i % $l]) % 256;

        // On permute
        // https://jf-blog.fr/comment-permuter-des-variables-en-php/
        [$permutationS[$i], $permutationS[$j]] = [$permutationS[$j], $permutationS[$i]];
    }

    return $permutationS;
}

/** Principe :
 *      Génère une suite chiffrante de RC4 à partir de la permutationS de la clefK.
 *      Fondé sur l'algorithme 1 donné dans le sujet.
 *  Paramètre :
 *      - @param array $permutationS : la clé permuté dont on va générer la suite chiffrante
 *  Renvoi :
 *      - @return array $suiteChiffranteK : la suite chiffrante
 */

function suite_chiffrante(array $permutationS, $n): array{
    $i = 0; $j = 0;

    $suiteChiffranteK = array();

    $parcours = 0;
    while ($parcours < $n){
        // Tant que nous avons pas traité tous les octets du messages

        $i = ($i + 1) % 256;
        $j = ($j + $permutationS[$i]) % 256;
        [$permutationS[$i], $permutationS[$j]] = [$permutationS[$j], $permutationS[$i]];
        // var_dump([$permutationS[$j], $permutationS[$i]]); echo "<br>";
        $suiteChiffranteK[] = $permutationS[($permutationS[$i] + $permutationS[$j]) % 256];

        $parcours += 1;
    }
    return $suiteChiffranteK;
}


function rc4_chiffrement($clef, $texte){
    $S = KSA($clef);

    // Génération du texte chiffré
    $res = '';
    $i = 0;
    foreach (suite_chiffrante($S,strlen($texte)) as $k) {
        $nOctet = ord($texte[$i]) ^ $k;
        $res .= chr($nOctet);
        $i++;
    }

    return strtoupper(bin2hex($res));
}


function rc4_dechiffrement($clef, $texteChiffre){
    // On convertit l'entrée en binaire.
    $texteChiffre = hex2bin($texteChiffre);

    // La fonction de déchiffrement de RC4 est la même que la fonction de chiffrement car RC4 est un algorithme symétrique.
    return hex2bin(rc4_chiffrement($clef, $texteChiffre));
    // On convertit la sortie en binaire.
}