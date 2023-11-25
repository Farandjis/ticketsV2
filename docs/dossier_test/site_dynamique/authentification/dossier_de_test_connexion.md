Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test
## Site statique

<br><br>

</div>

<br><br><br><br><br><br><br>

## Plan
- ### [I - Introduction](#I)
- ### [II - Description de la procédure de test](#II)
- ### [III - Contexte des tests](#III)
- ### [IV - Test](#IV)


<br><br><br>

----------

<br><br><br>

## <a name="I"></a>I - Introduction

Le document suivant à pour but de tester la page connexion.
<br>

## <a name="II"></a>II - Description de la procédure de test

Nous allons tester tout les cas possibles qui permettent à la page de donner une erreur au moment de la connexion mais aussi les cas où la connexion  marchera.
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                                   |
|------------------------------------|--------------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                                     |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2)         |
| Conf. logicielle Matthieu          | Navigateur : Firefox 119.0.1 (64 bits)<br>OS : Ubuntu 22.04.3 LTS 64bits |
| Configuration matérielle           | Dell Optiplex 9020                                                       |
| Conf. Matérielle Matthieu          | Acer Nitro 50-600                                                        |
| Date de début                      | 21/11/2023                                                               |
| Date de finalisation               | 25/11/2023                                                               |
| Test à appliquer                   | Vérification du bon fonctionnement de la page connexion                  |
| Responsable de la campagne de test | GUIGNOLLE Enzo, Gouabi Assia, FARANDJIS Matthieu                         |


<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

| Cas n° | Critère                                                      | Résultat attendu | Résultat obtenu | Commentaires                                           |
|:-------|--------------------------------------------------------------|------------------|-----------------|--------------------------------------------------------|
| 1      | $login = " " <br> $mdpMariaDB = "Azertyalice!123"            | KO               | KO              | $login vide et $mdpMariaDB correct                     |
| 2      | $login = "alice" <br> $mdpMariaDB = " "                      | KO               | KO              | $login correct et $mdpMariaDB vide                     |
| 3      | $loginMariaDB = " " <br> $mdpMariaDB = " "                   | KO               | KO              | $login et $mdpMariaDB vide                             |
| 4      | $loginMariaDB = "alice" <br> $mdpMariaDB = "adqiidqkdfesf"   | KO               | KO              | $login correct et $mdpMariaDB incorrect                |
| 5      | $loginMariaDB = "alicE" <br> $mdpMariaDB = "Azertyalice!123" | KO               | KO              | $login incorrect et $mdpMariaDB correct (majuscule)    |
| 6      | $loginMariaDB = "alicé" <br> $mdpMariaDB = "Azertyalice!123" | KO               | KO              | $login incorrect et $mdpMariaDB correct (accent)       |
| 7      | $loginMariaDB = "alice" <br> $mdpMariaDB = "Azertyalice!123" | OK               | OK              | $login et $mdpMariaDB correct                          |
| 8      | $loginMariaDB = "alice" <br> $mdpMariaDB = "Azértyalice!123" | KO               | KO              | $login correct et $mdpMariaDB non conforme (accent)    |
| 9      | $loginMariaDB = "alice" <br> $mdpMariaDB = "AzErtyalice!123" | KO               | KO              | $login correct et $mdpMariaDB non conforme (majuscule) |
| 10     | $loginMariaDB = "alice" <br> $mdpMariaDB = '";--'            | KO               | KO              | Tentative raté d'injection SQL                         |
| 11     | $loginMariaDB = "alice" <br> $mdpMariaDB = "';--"            | KO               | KO              | Tentative raté d'injection SQL                         |
| 12     | $loginMariaDB = '";--' <br> $mdpMariaDB = "Azertyalice!123"  | KO               | KO              | Tentative raté d'injection SQL                         |
| 13     | $loginMariaDB = "';--" <br> $mdpMariaDB = "Azertyalice!123"  | KO               | KO              | Tentative raté d'injection SQL                         |

Si le login et le mot de passe est bon mais que l'utilisateur ne possède pas de rôle dans la base de donnée, l'accès lui est refusé avec un message d'erreur "Vous n'avez aucun rôle pour accéder au site."<br>
Si le login et le mot de passe est bon mais que le rôle de l'utilisateur ne permet pas l'accès, l'accès lui sera refusé avec un message d'erreur "Votre rôle ne permet par la connexion".<br>
Si le compte n'existe pas, le login ou le mot de passe est invalide, il affiche l'erreur : "ERREUR : Le champ login ou mot de passe est incorrect ou votre compte n'existe pas"