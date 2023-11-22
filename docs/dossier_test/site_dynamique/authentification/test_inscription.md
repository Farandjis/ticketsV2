Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../../../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test
## Site dynamique - Authentification : Inscription

<br><br>
Ce dossier permet de s'assurer que les pages web dynamique soient conforme à ce qui est attendu.

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

Le document suivant à pour but de tester les différentes pages du site dynamique réalisé pour l'inscription de l'utilisateur.
<br>

## <a name="II"></a>II - Description de la procédure de test
En fonction des paraètres de la base de données et de la conception, nous allons tester une par une chaque case.

<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                           |
|------------------------------------|------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                             |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2) |
| Configuration matérielle           | Dell Optiplex 9020                                               |
| Date de début                      | 21/11/2023                                                       |
| Date de finalisation               |                                                                  |
| Test à appliquer                   | Vérification de la validité du site                              |
| Responsable de la campagne de test | GUIGNOLLE Enzo                                                   |

| Définition               | Situation pour le test                                                   |
|--------------------------|--------------------------------------------------------------------------|
| Produit testé            | Page inscription PHP                                                     |
| Configuration logicielle | Navigateur : Firefox 119.0.1 (64 bits)<br>OS : Ubuntu 22.04.3 LTS 64bits |
| Configuration matérielle | Acer Nitro 50-600                                                        |
| Date de début            | 22/11/2023                                                               |
| Date de finalisation     | 22/11/2023                                                               |
| Test à appliquer         | Vérification de la validité du site                                      |
| Participant              | Matthieu FARANDJIS                                                       |

<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test PHP

- ### Inscription

| Cas n° | Critère                                                                                                                                                               | Résultat attendu | Résultat obtenu | Commentaire                                                                                                                           |
|:-------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------|------------------|-----------------|---------------------------------------------------------------------------------------------------------------------------------------|
| 1      | $login = "alice" <br> $mdp = "Azertyyy!123" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com                | OK               | OK              | 5 <= login <= 20 <br> 12 <= mdp <= 32 <br> 1 <= prénom <= 30 (compris) <br> 1 <= nom <= 30 (compris) <br> 5 <= email <= 100 (compris) |
| 2      | $login = "alic" <br> $mdp = "Azertyyy!123" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com                 | KO               | KO              | Login trop court (< 5)                                                                                                                |
| 3      | $login = "aliceeeeeeeeeeeeeeee" <br> $mdp = "Azertyyy!123" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com | KO               | KO              | Login trop long (> 20)                                                                                                                |
| 4      | $login = "aliceeeeeeeeeeeeeee" <br> $mdp = "Azertyyy!123" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com  | OK               | OK              | Login compris entre 5 (compris) et 20 (compris)                                                                                       |
| 5      | $login = " " <br> $mdp = "Azertyyy!123" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com                    | KO               | KO              | Absence du login                                                                                                                      |
| 6      | $login = "alice" <br> $mdp = " " <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com                           | KO               | KO              | Absence mot de passe 1                                                                                                                |
| 7      | $login = "alice" <br> $mdp = "Azertyyy!1234" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com               | KO               | KO              | mdp 1 et mdp 2 différents                                                                                                             |
| 8      | $login = "alice" <br> $mdp = "Azertyyy!12" <br> $mdp2 = "Azertyyy!12" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com                  | KO               | KO              | mdp trop court (< 12)                                                                                                                 |
| 9      | $mdp == $mdp2 <br> mdp possède les caractères demandés <br> mdp fait 33 caractères                                                                                    | KO               | KO              | mdp trop grand (> 32)                                                                                                                 |
| 10     | $mdp == $mdp2 <br> mdp possède les caractères demandés <br> mdp fait 32 caractères                                                                                    | OK               | OK              | mdp compris entre 12 (compris) et 32 (compris)                                                                                        |
| 11     | $login = "alice" <br> $mdp = "Azertyyy!!!!" <br> $mdp2 = "Azertyyy!!!!" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com                | KO               | KO              | mdp : manque un chiffre                                                                                                               |
| 12     | $login = "alice" <br> $mdp = "Azertyyy1233" <br> $mdp2 = "Azertyyy1233" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com                | KO               | KO              | mdp : manque un caractère spécial (ou accent)                                                                                         |
| 13     | $login = "alice" <br> $mdp = "azertyyy!123" <br> $mdp2 = "azertyyy!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com                | KO               | KO              | mdp : manque une majuscule                                                                                                            |
| 14     | $login = "alice" <br> $mdp = "AZERTYYY!123" <br> $mdp2 = "AZERTYYY!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com                | KO               | KO              | mdp : manque une minuscule                                                                                                            |
| 15     | $login = "alice" <br> $mdp = "Azertyyy!" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril#email.com                   | KO               | KO              | email : Caractère invalide                                                                                                            |
| 16     | $login = "alice" <br> $mdp = "Azertyyy!" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avrilemail.com                    | KO               | KO              | email : Absence @                                                                                                                     |
| 17     | $login = "alice" <br> $mdp = "Azertyyy!" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = @email.com                              | KO               | KO              | email : Manque caractère(s) avant le @                                                                                                |
| 18     | $login = "alice" <br> $mdp = "Azertyyy!" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@                            | KO               | KO              | email : Manque caractère(s) après le @                                                                                                |
| 19     | $login = "alice" <br> $mdp = "Azertyyy!" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@.com                        | KO               | KO              | email : Manque nom de domaine                                                                                                         |
| 20     | $login = "alice" <br> $mdp = "Azertyyy!" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@email                       | KO               | KO              | email : Manque le ".com" ou ".fr" etc                                                                                                 |
| 21     | $login = "alice" <br> $mdp = "Azertyyy!" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = @emailalice.avril.fr                    | KO               | KO              | email : Mauvais ordre                                                                                                                 |
| 22     | $login = "alice" <br> $mdp = "Azertyyy!" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@.fremail                    | KO               | KO              | email : Mauvais ordre                                                                                                                 |
| 23     | $login = "alice" <br> $mdp = "Azertyyy!" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@email.fr.de                 | OK               | OK              | email : sous domaine                                                                                                                  |
| 24     | $login = "alice" <br> $mdp = "Azertyyy!" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = avril@email.fr.de                       | OK               | OK              | email : pas de "x.x", directement "x"                                                                                                 |
| 25     | $login = "alice" <br> $mdp = "Azertyyy!123" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Al!ce" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com                | KO               | KO              | Caractère interdit prénom (caractère spécial)                                                                                         |
| 26     | $login = "alice" <br> $mdp = "Azertyyy!123" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Al1ce" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com                | KO               | KO              | Caractère interdit prénom (chiffre)                                                                                                   |
| 27     | $login = "alice" <br> $mdp = "Azertyyy!123" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alic e" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com               | KO               | KO              | Caractère interdit prénom (espace)                                                                                                    |
| 28     | $login = "alice" <br> $mdp = "Azertyyy!123" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alic_e" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com               | KO               | KO              | Caractère interdit prénom (tirer du bas)                                                                                              |
| 29     | $login = "alice" <br> $mdp = "Azertyyy!123" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alice" <br> $nom = "AVR!L" <br> $email = alice.avril@email.com                | KO               | KO              | Caractère interdit nom (caractère spécial)                                                                                            |
| 30     | $login = "alice" <br> $mdp = "Azertyyy!123" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alice" <br> $nom = "AVR1L" <br> $email = alice.avril@email.com                | KO               | KO              | Caractère interdit nom (chiffre)                                                                                                      |
| 31     | $login = "alice" <br> $mdp = "Azertyyy!123" <br> $mdp2 = "Azertyyy!123" <br> $prenom = "Alice" <br> $nom = "AVRIL_" <br> $email = alice.avril@email.com               | KO               | KO              | Caractère interdit nom (tiret du bas)                                                                                                 |

<br><br>
Les caractères spéciaux sont listés ici : https://fr.wikipedia.org/wiki/Aide:Liste_de_caract%C3%A8res_sp%C3%A9ciaux <br>
Note : nous ne considérons pas les accents comme des caractères spéciaux (sauf pour le mot de passe)<br>
<br>
Le test des cases vides à été effectués pour toute les cases du formulaire. Le résultat KO a été obtenu à chaque fois. Tout va bien<br>
On a testé les limites des cas (cf cas 1 pour les limites), dans l'intervalle : OK à chaque fois, sinon, KO à chaque fois. Tout va bien<br>
<br>
Concernant l'injection de code SQL ou JavaScript, les caractères ">" et "<" sont stockés au format HTML, pas directement ">" "<" dans la base de données.<br>
Il a été vérifié assidûment que le code pour les requêtes préparés correspond à l'exemple de Monsieur HOGUIN.
