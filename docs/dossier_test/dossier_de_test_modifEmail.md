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
- ### [IV - Test](#IV)


<br><br><br>

----------

<br><br><br>

## <a name="I"></a>I - Introduction

Le document suivant à pour but de tester la page modifEmail.
<br>

## <a name="II"></a>II - Description de la procédure de test

La fonctionnalité que nous allons tester est le faite de vérifié que ce qui est rentrée dans est conforme pour être insérer dans la base de données.
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                           |
|------------------------------------|------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                             |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2) |
| Configuration matérielle           | Dell Optiplex 9020                                               |
| Date de début                      | 23/11/2023                                                       |
| Date de finalisation               | 24/11/2023                                                       |
| Test à appliquer                   | Vérification de la fonctionnalité pour modifié l'email           |
| Responsable de la campagne de test | Gouabi Assia                                                     |

<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

| Cas n° | Critère                                                           | Résultat attendu | Résultat obtenu | Commentaires                                                              |
|:-------|-------------------------------------------------------------------|------------------|-----------------|---------------------------------------------------------------------------|
| 1      | $mdp = "Azerty!123" <br> $nouvelleEmail = "alice@email.com"       | OK               | OK              | $mdp et $nouvelleEmail sont correct                                       |
| 2      | $mdp = "azerty!123" <br> $nouvelleEmail = "alice@email.com"       | KO               | KO              | $mdp est incorrect mais $nouvelleEmail est conforme                       |
| 3      | $mdp = "Azerty!123" <br> $nouvelleEmail = "alice.avril@email.com" | KO               | KO              | $mdp est correct mais $nouvelleEmail correspond à l'Email actuel          |
| 4      | $mdp = " " <br> $nouvelleEmail = "alice@email.com"                | KO               | KO              | $mdp est vide mais $nouvelleEmail est conforme                            |
| 5      | $mdp = "Azerty!123" <br> $nouvelleEmail = " "                     | KO               | KO              | $mdp est correct mais $nouvelleEmail est vide                             |
| 6      | $mdp = " " <br> $nouvelleEmail = " "                              | KO               | KO              | $mdp et $nouvelleEmail sont vides                                         |
| 7      | $mdp = "Azerty!123" <br> $nouvelleEmail = "alice#email.com"       | KO               | KO              | $mdp est correct mais le format de l'Email est incorrect                  |
| 8      | $mdp = "Azerty!123" <br> $nouvelleEmail = "alicé@email.com"       | KO               | KO              | Les données sont valides mais le format de l'Email est incorrect (accent) |
