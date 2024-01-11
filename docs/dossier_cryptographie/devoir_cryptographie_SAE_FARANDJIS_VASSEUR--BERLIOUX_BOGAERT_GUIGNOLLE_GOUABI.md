Matthieu FARANDJIS, Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Chiffrement RC4 et fonction de hachage

<br><br>
Ce document en lien à notre devoir de Cryptographie explique la création de notre module de chiffrement/déchiffrement RC4.<br>
Nous définirons également ce qu'est une fonction de hachage cryptographique, le fonctionnement de la fonction MD5 et leur importance.<br>
<br>
</div>

<br><br>

---

# Plan
- ## Algorithme RC4
  - ### Présentation

L'algorithme RC4 (Rivest Cipher 4) est un algorithme de chiffrement, créé par le cryptologue Ronald Rivest en 1987.

L'algorithme RC4 utilise une clé secrète pour générer une séquence "pseudo-aléatoire" appelée suite chiffrante. Cette suite est ensuite combinée avec les données à chiffrer en utilisant l'opérateur XOR sur chaque octet un à un.

C'est un algorithme symétrique, seule une clé est nécessaire pour le chiffrement et le déchiffrement.

  - ### Key Scheduling Algorithm (KSA)

 La première étape de l'algorithme consiste à créer un tableau (ici appelé A) de la longueur de la clé (ici appelé K) entrée en paramètre et contenant chacun de ses octets un à un dans chaque cellule.

Un deuxième tableau (ici appelé B) de taille 256 (pour les caractères ASCII). Chaque élément dans le tableau porte une numération allant de 0 à 255.

Ensuite, pour chaque valeur x de 0 à 255, on inverse la valeur du tableau B à l'indice x avec l'indice correspondant au calcul suivant :

('précédent résultat de ce calcul (valeur initiale = 0)' + A[x] + K[x % 'longueur de K']) % 256



  - ### Génération suite chiffrante - Pseudo Random Generator (PRGA)

Un tableau est d'abord généré pour stocker la future séquence chiffrante. Ce tableau est rempli progressivement.

Pour autant d'octets présents dans le message à crypter, ont interverti le code de l'octet avec celui associé dans le B (de l'algorithme KSA).


  - ### Module de chiffrement
L'algorithme de chiffrement RC4 combien l'algorithme KSA, puis PRGA afin d'obtenir la suite chiffrante associé à la clé de départ. Cette suite chiffrant est de même taille que la longueur du message.

Il ne reste alors plus qu'a effectué pour chaque octet un à un de la suite chiffrante et du message l'opération XOR.

On obtient alors le message chiffré.
  - ### Module de déchiffrement
La méthode de déchiffrement est identique à celle de chiffrement. On pense juste à convertir l'entrée et la sortie du message en binaire.
- ## Fonction de hachage cryptographique
  - ### Présentation
    - ##### Définition
Le terme fonction de hachage vient de l'anglais "hash function". Il s'agit d'une fonction mathématique prend en entrée une valeur de taille variable qu'elle altère pour lui donner une taille uniforme. Selon le site ionos.fr : "La fonction de hachage convertit des séquences de caractères de différentes longueurs en séquences de même longueur."


    - ##### Propriétés
    
On peut se référer au site Wikipedia pour trouver les propriétés suivantes :

    - Uniformité : La fonction de hachage doit répartir uniformément les entrées dans sa plage de sortie afin de limiter les collisions.

    - Efficacité : Une fonction de hachage doit être le plus efficace possible est limité le temps de recherche d'une valeur.

    - Universalité : Une fonction de hachage doit limiter la probabilité d'index identiques pour des clés différentes. L'objectif est encore de limiter les collisions.

    - Applicabilité : La fonction de hachage doit être adaptée à l'application qui l'utilise en termes de taille de la table, de longueur des chaînes...

    - Déterminisme : Une fonction de hachage doit toujours produire le même résultat pour une certaine entrée.

    - Plage définie : Une fonction de hachage doit avoir une taille (plage d'indexation) fixe.

    - Normalisation des données : La fonction de hachage doit normaliser les données indexées selon certains critères.

  - ### Fonction de hachage MD5
La fonction MD5 est d'abord constituée d'une partie de normalisation de l'entrée. Le texte en entrée est complété par un bit '1' suivi de plusieurs bits '0' afin de donner à l'entrée une taille étant un multiple de 512. La taille totale du message est aussi ajoutée au message lui-même sur les 64 derniers bits.

Ensuite, le MD5 traite les octets par pack de 128 (soit 512 bits). Ces packs de 128 bits sont répartis sur 4 zones A, B, C et D. Chaque zone traitant alors 32 octets. Ces zones contiennent, lors de l'initialisation, des constantes sur lesquelles seront effectués plusieurs calculs avec les octets du message afin d'en tirer une sortie chiffrée. Les résultats de chaque zone sont ensuite copiés sur la zone qui suit pour la prochaine itération de 512 octets. Les résultats de la boucle précédente deviennent alors les valeurs de base de la nouvelle boucle.

Les calculs pouvant être effectués sur une zone sont :
```
F(B,C,D) = (B ∧ C) ∨ (¬B ∧ D) ;

G(B,C,D) = (B ∧ D) ∨ (C ∧ ¬D) ;

H(B,C,D) = B ⊕ C ⊕ D ;

I(B,C,D) = C ⊕ (B ∨ ¬D).
```

  - ### Importance de ces fonctions dans le domaine cryptographique
  Les fonctions de hachage ont une importance capital dans le domaine de la cryptographie, et plus généralement dans le domaine de la sécurité informatique.
  En effet, la cryptographie concerne l'"Ensemble des procédés visant à crypter des informations pour en assurer la confidentialité entre l'émetteur et le destinataire." selon Le Robert. Alors, cette disipline vise l'étude et la conception de fonction de chiffrement de données.
  Les fonctions de hachage sont un bon moyen de chiffrer des données en utilisant des méthodes de hachage à sens unique (et donc non déchiffrable), ou encore des technique de chiffrement par clé (unique pour les algorithmes symétrique ou multiple pour les autres).

  Les méthodes de hachage comme la fonction RC4 assurent la confidentialité d'une donnée, en la chiffrant à partir d'une clé. Le message ne peut alors être déchiffré qu'avec la clé de chiffrement.
  Ainsi, les fonctions de hachages sont une composantes essdenciel du domaine de la cryptographie.
- ## Annexe
  - ### Code de chiffrement/déchiffrement RC4

```
  function convertionArrayDeBytesEnHexadecimal($arr){
    // fonction entierement recopié de :
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
 *      Génére une permutation à  partir de la clef.
 *      Fondé sur l'algorithme 2 donné dans le sujet.
 *  Paramètre :
 *      - @param string $clefK : la clÃ© dont on génère la permutation
 *  Renvoi :
 *      - @return array $permutationS : la permutation de la clé
 */
function KSA(string $clefK): array{
    // https://www.php.net/manual/en/function.ord.php
    // ord â€” Convert the first byte of a string to a value between 0 and 255

    $permutationS = array();
    $l = strlen($clefK); // taille de la clÃ©

    $clefKbin = array(); // Liste représentant la clef oÃ¹ chaque valeur correspond Ã  la convertion charactÃ¨re -> int de la clef.
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
 *      Génère une suite chiffrante de RC4 à  partir de la permutationS de la clefK.
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
```
