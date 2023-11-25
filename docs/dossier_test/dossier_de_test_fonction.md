Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test
## Site statique

<br><br>
Ce document permet de s'assurer que les pages web statique soient conforme à ce qui est attendu.

</div>

<br><br><br><br><br><br><br>

## Plan
- ### [I - Introduction](#I)
- ### [II - Description de la procédure de test](#II)
- ### [III - Contexte des tests](#III)
- ### [IV - Test ](#IV)
    - #### [Test fonctions](#a)
        - #### [connectUser](#1a)
        - #### [valideMDP](#2a)
        - #### [executeSQL](#3a)


<br><br><br>

----------

<br><br><br>

## <a name="I"></a>I - Introduction

Le document suivant à pour but de tester les différentes différentes fonctions créer pour permettre l'utilisations plus simple de même ligne de code.
<br>

## <a name="II"></a>II - Description de la procédure de test

Les fonctions que nous allons tester seront connectUser, valideMDP et executeSQL.
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                           |
|------------------------------------|------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                             |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2) |
| Configuration matérielle           | Dell Optiplex 9020                                               |
| Date de début                      | 21/11/2023                                                       |
| Date de finalisation               | 24/11/2023                                                       |
| Test à appliquer                   | Vérification du bon fonctionnement des fonctions                 |
| Responsable de la campagne de test | GUIGNOLLE Enzo, Gouabi Assia                                     |

<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

### <a name="1a"></a>connectUser

| Cas n° | Critère                                                    | Résultat attendu | Résultat obtenu | Commentaires                                   |
|:-------|------------------------------------------------------------|------------------|-----------------|------------------------------------------------|
| 1      | $loginMariaDB = "alice" <br> $mdpMariaDB = "azerty!123"    | OK               | OK              | $loginMariaDB et $mdpMariaDB correct           |
| 2      | $loginMariaDB = " " <br> $mdpMariaDB = "azerty!123"        | KO               | KO              | $loginMariaDB vide et $mdpMariaDB correct      |
| 3      | $loginMariaDB = "alice" <br> $mdpMariaDB = "123!azerty"    | KO               | KO              | $loginMariaDB correct et $mdpMariaDB incorrect |
| 4      | $loginMariaDB = "alice" <br> $mdpMariaDB = " "             | KO               | KO              | $loginMariaDB correct et $mdpMariaDB vide      |
| 5      | $loginMariaDB = "alix" <br> $mdpMariaDB = "azerty!123"     | KO               | KO              | $loginMariaDB incorrect et $mdpMariaDB correct |
| 6      | $loginMariaDB = "alie" <br> $mdpMariaDB = "123!azerty"     | KO               | KO              | $loginMariaDB et $mdpMariaDB incorrect         |



- ### <a name="2a"></a>valideMDP

| Cas n° | Critère                           | Résultat attendu | Résultat obtenu | Commentaires                                          |
|:-------|-----------------------------------|------------------|-----------------|-------------------------------------------------------|
| 1      | Azertyalice!123                   | OK               | OK              | Le format du mdp est correct                          |
| 2      | azertyalice!123                   | KO               | KO              | Absence de majuscule                                  |
| 3      | Azertyalice123                    | KO               | KO              | Absence d'un caractère spécial                        |
| 4      | Azertyalice!                      | KO               | KO              | Absence de chiffres                                   |
| 5      | Azerty!123                        | KO               | KO              | Taille non conforme aux restrictions (inférieur à 12) |
| 6      | Azertyaliceavrilbonjourrrr!123456 | KO               | KO              | Taille non conforme aux restrictions (supérieur à 32) |

- ### <a name="3a"></a>executeSQL

| Cas n° | Critère                                                                                                                                                                                                                                                                       | Résultat attendu | Résultat obtenu | Commentaires                                                           |
|:-------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|------------------|-----------------|------------------------------------------------------------------------|
| 1      | $reqSQL = "SELECT ID_USER FROM vue_UserFictif_connexionDB1 WHERE login_user = ? " <br> $params = array(loginSite) <br> $connection                                                                                                                                            | OK               | OK              | La requête de sélection fonctionne                                     |
| 2      | $reqSQL = "SELECT ID_USER FROM vue_UserFictif_connexionDB1 WHERE login_user = ? " <br> $params = array(1) <br> $connection                                                                                                                                                    | KO               | KO              | Le login étant un char nous ne pouvons pas récupérer le login_user = 1 |
| 3      | $reqSQL = "SELECT COUNT(LOGIN_USER) FROM vue_UserFictif_connexionDB1 WHERE Email_USER = ?" <br> $params = array($login) <br> $coUFConnexion                                                                                                                                   | KO               | KO              | Le $login ne correspond pas à l'Email_user                             |
| 4      | $reqSQL = "INSERT INTO vue_UserFictif_inscriptionDB1 (LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER, HORODATAGE_OUVERTURE_USER) VALUES (?, ?, ?, 'utilisateur', ?, current_timestamp())" <br> $params = array($login, $prenom, $nom, $email) <br> $coUFInscription | OK               | OK              | La requête d'insertion fonctionne                                      |
| 5      | $reqSQL = "SELECT ID_USER FROM vue_UserFictif_connexionDB1 WHERE login_user = ? " <br> $params = array() <br> $connection                                                                                                                                                     | KO               | KO              | Aucun paramètre n'est identiqué                                        |
| 6      | $reqSQL = "UPDATE vue_utilisateur_insertion_client SET email_user= ? WHERE ID_USER = ?" <br> $params = array($nouvEmail, $login) <br> $connexion                                                                                                                              | KO               | KO              | Le paramètre nouvEmail n'existe pas                                    |
| 7      | $reqSQL = "SELECT ID_USER FROM vue_UserFictif_connexionDB1 WHERE login_user = ?" <br> $params = array("--") <br> $connection                                                                                                                                                  | KO               | KO              | Impossible de tenter une injection SQL                                 |
