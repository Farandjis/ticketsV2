Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../../../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test boite noire 
## Site dynamique - Authentification : Inscription

<br><br>
Ce dossier permet de s'assurer que la page inscription soit conforme à ce qui est attendu.

</div>

<br><br><br><br><br><br><br>

## Plan
- ### [I - Introduction](#I)
- ### [II - Description de la procédure de test](#II)
- ### [III - Contexte des tests](#III)
- ### [IV - Test PHP](#IV)



<br><br><br>

----------

<br><br><br>

## <a name="I"></a>I - Introduction

Le document suivant a pour but de tester les différents cas de tests réalisé pour l'inscription de l'utilisateur.
<br>

## <a name="II"></a>II - Description de la procédure de test
En fonction des paramètres de la base de données et de la conception, nous allons tester une par une chaque case.

<br>

## <a name="III"></a>III - Contexte des tests

| Définition               | Situation pour le test                                                   |
|--------------------------|--------------------------------------------------------------------------|
| Produit testé            | Page inscription PHP                                                     |
| Config. logicielle Enzo  | Navigateur : Firefox 118.0.1 (64 bits)<br>OS : Windows 10 22h2 64 bits)  |
| Conf. logicielle Matthieu| Navigateur : Firefox 119.0.1 (64 bits)<br>OS : Ubuntu 22.04.3 LTS 64bits |
| Config. matérielle Enzo  | Dell Optiplex 9020                                                       |
| Conf. Matérielle Matthieu| Acer Nitro 50-600                                                        |
| Date de début            | 05/11/2023                                                               |
| Date de finalisation     | 24/03/2024                                                               |
| Test à appliquer         | Vérification de la validité du site                                      |
| Participant              | Enzo GUIGNOLLE et terminé par Matthieu FARANDJIS                         |

<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

### Partitions d'équivalence

Les données qui nous permettent de nous inscrire sur la plateforme sont les suivantes : le login, le mdp, sa confirmation, le prénom, nom, email et il faut remplir correctement un captcha afin que l'inscription soit effectuée. 
<br> Le login peut être correct, incorrect ou vide, le mot de passe quant à lui est conforme, vide ou non conforme, s'il ne respecte pas certaines caractéristiques. Sa confirmation peut être également conforme, non conforme ou incorrect, si elle n'est pas identique au mdp. 
<br> Le prénom, nom et captcha sont corrects, vides ou incorrects. Enfin, l'email est conforme ou non conforme, s'il ne respecte pas un certain affichage. 
<br> Les résultats attendus sont OK si l'inscription a bien été effectué et KO sinon. 

### Conception des tests

| Cas | $login       | $mdp         | $mdp2        | $prenom   | $nom      | $email       | $captcha  | Résultat attendu | Résultat obtenu | Commentaires                                                                                                                          |
|-----|--------------|--------------|--------------|-----------|-----------|--------------|-----------|------------------|-----------------|---------------------------------------------------------------------------------------------------------------------------------------|
| P1  | Correct      | Conforme     | Correct      | Correct   | Correct   | Conforme     | Correct   | OK               | OK              | 5 <= login <= 32 <br> 12 <= mdp <= 32 <br> 1 <= prénom <= 50 (compris) <br> 1 <= nom <= 50 (compris) <br> 5 <= email <= 100 (compris) |
| P2  | Incorrect    | Conforme     | Correct      | Correct   | Correct   | Conforme     | Correct   | KO               | KO              | Login trop court (< 5)                                                                                                                |
| P3  | Non conforme | Conforme     | Correct      | Correct   | Correct   | Conforme     | Correct   | KO               | KO              | Login trop long (> 32)                                                                                                                |
| P4  | Non conforme | Conforme     | Correct      | Correct   | Correct   | Conforme     | Correct   | KO               | KO              | Login compris entre 5 (compris) et 32 (compris)                                                                                       |
| P5  | Vide         | Conforme     | Conforme     | Correct   | Correct   | Conforme     | Correct   | KO               | KO              | Absence du login                                                                                                                      |
| P6  | Correct      | Vide         | Conforme     | Correct   | Correct   | Conforme     | Correct   | KO               | KO              | Absence mot de passe 1                                                                                                                |
| P7  | Correct      | Conforme     | Incorrect    | Correct   | Correct   | Conforme     | Correct   | KO               | KO              | mdp 1 et mdp 2 différents                                                                                                             |
| P8  | Correct      | Non conforme | Non conforme | Correct   | Correct   | Conforme     | Correct   | KO               | KO              | mdp trop court (< 12)                                                                                                                 |
| P9  | Correct      | Non conforme | Non conforme | Correct   | Correct   | Conforme     | Correct   | KO               | KO              | mdp trop grand (> 32)                                                                                                                 |
| P10 | Correct      | Conforme     | Conforme     | Correct   | Correct   | Conforme     | Correct   | OK               | OK              | mdp compris entre 12 (compris) et 32 (compris)                                                                                        |
| P11 | Correct      | Non conforme | Non conforme | Correct   | Correct   | Conforme     | Correct   | KO               | KO              | mdp : manque un chiffre                                                                                                               |
| P12 | Correct      | Non conforme | Non conforme | Correct   | Correct   | Conforme     | Correct   | KO               | KO              | mdp : manque un caractère spécial (ou accent)                                                                                         |
| P13 | Correct      | Non conforme | Non conforme | Correct   | Correct   | Conforme     | Correct   | KO               | KO              | mdp : manque une majuscule                                                                                                            |
| P14 | Correct      | Non conforme | Non conforme | Correct   | Correct   | Conforme     | Correct   | KO               | KO              | mdp : manque une minuscule                                                                                                            |
| P15 | Correct      | Conforme     | Conforme     | Correct   | Correct   | Non conforme | Correct   | KO               | KO              | email : Caractère invalide                                                                                                            |
| P16 | Correct      | Conforme     | Conforme     | Correct   | Correct   | Non conforme | Correct   | KO               | KO              | email : Absence @                                                                                                                     |
| P17 | Correct      | Conforme     | Conforme     | Correct   | Correct   | Non conforme | Correct   | KO               | KO              | email : Manque caractère(s) avant le @                                                                                                |
| P18 | Correct      | Conforme     | Conforme     | Correct   | Correct   | Non conforme | Correct   | KO               | KO              | email : Manque caractère(s) après le @                                                                                                |
| P19 | Correct      | Conforme     | Conforme     | Correct   | Correct   | Non conforme | Correct   | KO               | KO              | email : Manque nom de domaine                                                                                                         |
| P20 | Correct      | Conforme     | Conforme     | Correct   | Correct   | Non conforme | Correct   | KO               | KO              | email : Manque le ".com" ou ".fr" etc                                                                                                 |
| P21 | Correct      | Conforme     | Conforme     | Correct   | Correct   | Non conforme | Correct   | KO               | KO              | email : Mauvais ordre                                                                                                                 | 
| P22 | Correct      | Conforme     | Conforme     | Correct   | Correct   | Non conforme | Correct   | KO               | KO              | email : Mauvais ordre                                                                                                                 |
| P23 | Correct      | Conforme     | Conforme     | Correct   | Correct   | Non conforme | Correct   | OK               | OK              | email : sous domaine                                                                                                                  |
| P24 | Correct      | Conforme     | Conforme     | Correct   | Correct   | Non conforme | Correct   | OK               | OK              | email : pas de "x.x", directement "x"                                                                                                 |
| P25 | Correct      | Conforme     | Conforme     | Incorrect | Correct   | Conforme     | Correct   | KO               | KO              | Caractère interdit prénom (caractère spécial)                                                                                         |
| P26 | Correct      | Conforme     | Conforme     | Incorrect | Correct   | Conforme     | Correct   | KO               | KO              | Caractère interdit prénom (chiffre)                                                                                                   |
| P27 | Correct      | Conforme     | Conforme     | Incorrect | Correct   | Conforme     | Correct   | KO               | KO              | Caractère interdit prénom (espace)                                                                                                    |
| P28 | Correct      | Conforme     | Conforme     | Incorrect | Correct   | Conforme     | Correct   | KO               | KO              | Caractère interdit prénom (tirer du bas)                                                                                              | 
| P29 | Correct      | Conforme     | Conforme     | Correct   | Incorrect | Non conforme | Correct   | KO               | KO              | email : Manque le ".com" ou ".fr" etc                                                                                                 |
| P30 | Correct      | Conforme     | Conforme     | Correct   | Incorrect | Conforme     | Correct   | KO               | KO              | Caractère interdit nom (caractère spécial)                                                                                            | 
| P31 | Correct      | Conforme     | Conforme     | Correct   | Incorrect | Conforme     | Correct   | KO               | KO              | Caractère interdit nom (chiffre)                                                                                                      |
| P32 | Correct      | Conforme     | Incorrect    | Correct   | Incorrect | Conforme     | Correct   | KO               | KO              | Caractère interdit nom (tiret du bas)                                                                                                 |
| P33 | Correct      | Conforme     | Incorrect    | Correct   | Incorrect | Conforme     | Correct   | KO               | KO              | mdp : différence avec confirmation (accent)                                                                                           |
| P34 | Correct      | Conforme     | Conforme     | Correct   | Correct   | Conforme     | Vide      | KO               | KO              | mdp : différence avec confirmation (majuscule)                                                                                        |
| P35 | Correct      | Conforme     | Conforme     | Correct   | Correct   | Conforme     | Incorrect | KO               | KO              | Captcha incorrect                                                                                                                     |
| P36 | Correct      | Conforme     | Conforme     | Correct   | Correct   | Conforme     | Incorrect | KO               | KO              | Captcha incorrect                                                                                                                     |

### Exécution des tests 

| Cas | $login                            | $mdp                              | $mdp2                             | $prenom | $nom   | $email                  | $captcha       | Résultat attendu   | Résultat obtenu  |
|-----|-----------------------------------|-----------------------------------|-----------------------------------|---------|--------|-------------------------|----------------|--------------------|------------------|
| P1  | alice                             | Azertyyy!123                      | Azertyyy!123                      | Alice   | AVRIL  | alice.avril@email.com   | (17 + 2) = 19  | OK                 | OK               |
| P2  | alic                              | Azertyyy!123                      | Azertyyy!123                      | Alice   | AVRIL  | alice.avril@email.com   | (17 + 2) = 19  | KO                 | KO               |
| P3  | aliceeeeeeeeeeeeeeeeeeeeeeeeeeeee | Azertyyy!123                      | Azertyyy!123                      | Alice   | AVRIL  | alice.avril@email.com   | (17 + 2) = 19  | KO                 | KO               |
| P4  | aliceeeeeeeeeeeeeee               | Azertyyy!123                      | Azertyyy!123                      | Alice   | AVRIL  | alice.avril@email.com   | (17 + 2) = 19  | KO                 | KO               |
| P5  | " "                               | Azertyyy!123                      | Azertyyy!123                      | Alice   | AVRIL  | alice.avril@email.com   | (17 + 2) = 19  | KO                 | KO               |
| P6  | alice                             | " "                               | Azertyyy!123                      | Alice   | AVRIL  | alice.avril@email.com   | (17 + 2) = 19  | KO                 | KO               |
| P7  | alice                             | Azertyyy!1234                     | Azertyyy!123                      | Alice   | AVRIL  | alice.avril@email.com   | (17 + 2) = 19  | KO                 | KO               |
| P8  | alice                             | Azertyyy!12                       | Azertyyy!12                       | Alice   | AVRIL  | alice.avril@email.com   | (17 + 2) = 19  | KO                 | KO               |
| P9  | alice                             | Azertyyybonjourcavaazertyuiopq!12 | Azertyyybonjourcavaazertyuiopq!12 | Alice   | AVRIL  | alice.avril@email.com   | (17 + 2) = 19  | KO                 | KO               |
| P10 | alice                             | Azertyyybonjourcavaazertyuiop!12  | Azertyyybonjourcavaazertyuiop!12  | Alice   | AVRIL  | alice.avril@email.com   | (17 + 2) = 19  | OK                 | OK               |
| P11 | alice                             | Azertyyy!!!!                      | Azertyyy!!!!                      | Alice   | AVRIL  | alice.avril@email.com   | (17 + 2) = 19  | KO                 | KO               |
| P12 | alice                             | Azertyyy1233                      | Azertyyy1233                      | Alice   | AVRIL  | alice.avril@email.com   | (17 + 2) = 19  | KO                 | KO               |
| P13 | alice                             | azertyyy!123                      | azertyyy!123                      | Alice   | AVRIL  | alice.avril@email.com   | (17 + 2) = 19  | KO                 | KO               |
| P14 | alice                             | AZERTYYY!123                      | AZERTYYY!123                      | Alice   | AVRIL  | alice.avril@email.com   | (17 + 2) = 19  | KO                 | KO               |
| P15 | alice                             | Azertyyy!123                      | Azertyyy!123                      | Alice   | AVRIL  | alice.avril#email.com   | (17 + 2) = 19  | KO                 | KO               |
| P16 | alice                             | Azertyyy!123                      | Azertyyy!123                      | Alice   | AVRIL  | alice.avrilemail.com    | (17 + 2) = 19  | KO                 | KO               |
| P17 | alice                             | Azertyyy!123                      | Azertyyy!123                      | Alice   | AVRIL  | @email.com              | (17 + 2) = 19  | KO                 | KO               |
| P18 | alice                             | AAzertyyy!123                     | Azertyyy!123                      | Alice   | AVRIL  | alice.avril@            | (17 + 2) = 19  | KO                 | KO               |
| P19 | alice                             | Azertyyy!123                      | Azertyyy!123                      | Alice   | AVRIL  | alice.avril@.com        | (17 + 2) = 19  | KO                 | KO               |
| P20 | alice                             | Azertyyy!123                      | Azertyyy!123                      | Alice   | AVRIL  | alice.avril@email       | (17 + 2) = 19  | KO                 | KO               |
| P21 | alice                             | Azertyyy!123                      | Azertyyy!123                      | Alice   | AVRIL  | @emailalice.avril.fr    | (17 + 2) = 19  | KO                 | KO               | 
| P22 | alice                             | Azertyyy!123                      | Azertyyy!123                      | Alice   | AVRIL  | alice.avril@.fremail    | (17 + 2) = 19  | KO                 | KO               |
| P23 | alice                             | Azertyyy!123                      | Azertyyy!123                      | Alice   | AVRIL  | alice.avril@email.fr.de | (17 + 2) = 19  | OK                 | OK               |
| P24 | alice                             | Azertyyy!123                      | Azertyyy!123                      | Alice   | AVRIL  | avril@email.fr.de       | (17 + 2) = 19  | OK                 | OK               |
| P25 | alice                             | Azertyyy!123                      | Azertyyy!123                      | Al!ce   | AVRIL  | alice.avril@email.com   | (17 + 2) = 19  | KO                 | KO               |
| P26 | alice                             | Azertyyy!123                      | Azertyyy!123                      | Al1ce   | AVRIL  | alice.avril@email.com   | (17 + 2) = 19  | KO                 | KO               |
| P27 | alice                             | Azertyyy!123                      | Azertyyy!123                      | Alic e  | AVRIL  | alice.avril@email.com   | (17 + 2) = 19  | KO                 | KO               |
| P28 | alice                             | Azertyyy!123                      | Azertyyy!123                      | Alic_e  | AVRIL  | alice.avril@email.com   | (17 + 2) = 19  | KO                 | KO               | 
| P29 | alice                             | Azertyyy!123                      | Azertyyy!123                      | Alice   | AVR!L  | alice.avril@email       | (17 + 2) = 19  | KO                 | KO               |
| P30 | alice                             | Azertyyy!123                      | Azertyyy!123                      | Alice   | AVR1L  | alice.avril@email.com   | (17 + 2) = 19  | KO                 | KO               | 
| P31 | alice                             | Azertyyy!123                      | Azertyyy!123                      | Alice   | AVRIL_ | alice.avril@email.com   | (17 + 2) = 19  | KO                 | KO               |
| P32 | alice                             | Azertyyy!123                      | Azèrtyyy!123                      | Alice   | AVR1L  | alice.avril@email.com   | (17 + 2) = 19  | KO                 | KO               |
| P33 | alice                             | Azertyyy!123                      | AzErtyyy!123                      | Alice   | AVRIL_ | alice.avril@email.com   | (17 + 2) = 19  | KO                 | KO               |
| P34 | alice                             | Azertyyy!123                      | Azertyyy!123                      | Alice   | AVRIL  | alice.avril@email.com   | (17 + 2) = " " | KO                 | KO               |
| P35 | alice                             | Azertyyy!123                      | Azertyyy!123                      | Alice   | AVRIL  | alice.avril@email.com   | (17 + 2) = 25  | KO                 | KO               |
| P36 | alice                             | Azertyyy!123                      | Azertyyy!123                      | Alice   | AVRIL  | alice.avril@email.com   | (17 + 2) = !!  | KO                 | KO               |

<br><br>
Les caractères spéciaux sont listés ici : https://fr.wikipedia.org/wiki/Aide:Liste_de_caract%C3%A8res_sp%C3%A9ciaux <br>
Note : nous ne considérons pas les accents comme des caractères spéciaux (sauf pour le mot de passe)<br>
<br>
Le test des cases vides a été effectués pour toutes les cases du formulaire. Le résultat KO a été obtenu à chaque fois. Tout va bien<br>
On a testé les limites des cas (cf cas 1 pour les limites), dans l'intervalle : OK à chaque fois, sinon, KO à chaque fois. Tout va bien<br>
<br>
Concernant l'injection de code SQL ou JavaScript, les caractères ">" et "<" sont stockés au format HTML, pas directement ">" "<" dans la base de données.<br>
Il a été vérifié assidûment que le code pour les requêtes préparé correspond à l'exemple de Monsieur HOGUIN.<br>
<br>
<br>
Les données de l'utilisateur sont correctement insérés dans la table Utilisateur.<br>
L'utilisateur MariaDB est bien créé, et il s'attribue de lui-même le rôle utilisateur.

----------
Ceci clôture le développement de la page inscription.php et action inscription php (jusqu'à la création du captcha du moins)
