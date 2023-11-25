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

| Définition                         | Situation pour le test                                           |
|------------------------------------|------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                             |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2) |
| Configuration matérielle           | Dell Optiplex 9020                                               |
| Date de début                      | 21/11/2023                                                       |
| Date de finalisation               | 24/11/2023                                                       |
| Test à appliquer                   | Vérification du bon fonctionnement de la page connexion          |
| Responsable de la campagne de test | GUIGNOLLE Enzo, Gouabi Assia                                     |

<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

| Cas n° | Critère                                                      | Résultat attendu | Résultat obtenu | Commentaires                                        |
|:-------|--------------------------------------------------------------|------------------|-----------------|-----------------------------------------------------|
| 1      | $login = " " <br> $mdpMariaDB = "Azertyalice!123"            | KO               | KO              | $login vide et $mdpMariaDB correct                  |
| 2      | $login = "alice" <br> $mdpMariaDB = " "                      | KO               | KO              | $login correct et $mdpMariaDB vide                  |
| 3      | $loginMariaDB = " " <br> $mdpMariaDB = " "                   | KO               | KO              | $login et $mdpMariaDB vide                          |
| 4      | $loginMariaDB = "alice" <br> $mdpMariaDB = "adqiidqkdfesf"   | KO               | KO              | $login correct et $mdpMariaDB incorrect             |
| 5      | $loginMariaDB = "alicE" <br> $mdpMariaDB = "Azertyalice!123" | KO               | KO              | $login incorrect et $mdpMariaDB correct             |
| 6      | $loginMariaDB = "alice" <br> $mdpMariaDB = "Azertyalice!123" | OK               | OK              | $login et $mdpMariaDB correct                       |
| 7      | $loginMariaDB = "alice" <br> $mdpMariaDB = "azértyalice!123" | KO               | KO              | $login correct et $mdpMariaDB non conforme (accent) |
