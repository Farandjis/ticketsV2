Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test
## Site dynamique - Authentification

<br><br>
Ce document permet de s'assurer que les pages web statique soient conforme à ce qui est attendu.

</div>

<br><br><br><br><br><br><br>

## Plan
- ### [I - Introduction](#I)
- ### [II - Description de la procédure de test](#II)
- ### [III - Contexte des tests](#III)
- ### [IV - Test PHP](#IV)
  - #### [Test fonctionnalités](#b)
    - #### [Connexion](#1b)
    - #### [Inscription](#2b)
    - #### [Déconnexion](#2c)


<br><br><br>

----------

<br><br><br>

## <a name="I"></a>I - Introduction

Le document suivant à pour but de tester les différentes pages du site dynamique réalisé au niveau de la gestion des profils utilisateurs. Nous testerons plusieurs fonctionnalités que nous allons ajouter en rapport avec la gestion des profils des utilisateurs.
<br>

## <a name="II"></a>II - Description de la procédure de test

Les fonctionnalités que nous allons tester seront la connexion des utilisateurs, l’inscription de nouveaux utilisateurs et la modification de certaines informations des utilisateurs comme l’email ou le mot de passe.
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

<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test PHP

### <a name="b"></a>Test fonctionnalités

### <a name="1b"></a>Connexion

| Cas n° | Critère                                                 | Résultat attendu | Résultat obtenu |
|:-------|---------------------------------------------------------|------------------|-----------------|
| 1      | $login = " " <br> $mdpMariaDB = "azerty!123"            | KO               | KO              |
| 2      | $login = "alice" <br> $mdpMariaDB = " "                 | KO               | KO              |
| 3      | $loginMariaDB = " " <br> $mdpMariaDB = " "              | KO               | KO              |
| 4      | $loginMariaDB = "alice" <br> $mdpMariaDB = "adqiidqkd"  | KO               | KO              |
| 5      | $loginMariaDB = "alicE" <br> $mdpMariaDB = "azerty!123" | KO               | KO              |
| 6      | $loginMariaDB = "alice" <br> $mdpMariaDB = "azerty!123" | OK               | OK              |

- ### <a name="2b"></a>Inscription

| Cas n° | Critère                                                                                                                                            | Résultat attendu | Résultat obtenu |
|:-------|----------------------------------------------------------------------------------------------------------------------------------------------------|------------------|-----------------|
| 1      | $login = "alice" <br> $mdp = "Azerty!123" <br> $mdp2 = "Azerty!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com | OK               | OK              |
| 2      | $login = " " <br> $mdp = "Azerty!123" <br> $mdp2 = "Azerty!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com     | KO               | KO              |
| 3      | $login = "alice" <br> $mdp = " " <br> $mdp2 = "Azerty!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com          | KO               | KO              |
| 4      | $login = "alice" <br> $mdp = "Azerty!" <br> $mdp2 = "Azerty!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com    | KO               | KO              |
| 5      | $login = "alice" <br> $mdp = "azerty!123" <br> $mdp2 = "azerty!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com | KO               | KO              |
| 6      | $login = "alice" <br> $mdp = "Azerty!" <br> $mdp2 = "Azerty!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril#email.com    | KO               | KO              |
| 7      | $login = "alic" <br> $mdp = "Azerty!" <br> $mdp2 = "Azerty!123" <br> $prenom = "Alice" <br> $nom = "AVRIL" <br> $email = alice.avril@email.com     | KO               | KO              |

- ### <a name="2c"></a>Déconnexion
