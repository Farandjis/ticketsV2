Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test
## creerTicket

<br><br>
Ce document permet de s'assurer que la page creerTicket soient conforme à ce qui a été conçu.

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

Le document suivant à pour but de tester la page tableau de bord et de vérifier que le code PHP est bon et conforme à ce qui a été conçu.
<br>

## <a name="II"></a>II - Description de la procédure de test

La page tester est la page tableau de bord, nous testerons que chaque utilisateur puissent réaliser ce qui leur est possible et que la fonction de recherche de ticket fonction bien suivant les cas.
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                           |
|------------------------------------|------------------------------------------------------------------|
| Produit testé                      | Page creerTicket et son action php                               |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2) |
| Configuration matérielle           | Dell Optiplex 9020                                               |
| Date de début                      | 17/12/2023                                                       |
| Date de finalisation               | 17/12/2023                                                       |
| Test à appliquer                   | Vérification des différentes conditions pour créer un ticket     |
| Responsable de la campagne de test | GUIGNOLLE Enzo                                                   |

<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

<br>

| Cas n° | Critère                                                                                             | Résultat attendu | Résultat obtenu | Commentaires                                              |
|:-------|-----------------------------------------------------------------------------------------------------|------------------|-----------------|-----------------------------------------------------------|
| 1      | Aller directement sur la page creerTicket.php sans être connecté au site                            | KO               | KO              | Renvoie vers la page 403.html                             |
| 2      | Aller sur la page action_creationTicket.php                                                         | KO               | KO              | Renvoie vers la page creerTicket.php avec un id = 1       |
| 3      | $titre = "Piratage" $nivurg = "Faible" $libelle $description = " "                                                                  | KO               | KO              | la description est manquante (id = 2)       |
| 4      | Si il y a un problème durant l'insertion du ticket dans la base de données                          | KO               | KO              | Renvoie vers la page creerTicket.php avec un id = 6       |
| 5      | Si il y a un problème durant l'insertion du couple (id_ticket, nom_libelle) dans la base de données | KO               | KO              | Renvoie vers la page creerTicket.php avec un id = 6       |
| 6      | Si dans un des champs on met des apostrophes                                                        | OK               | OK              | Vérification de l'écriture en format html de l'aspotrophe |
| 7      | $titre = "Piratage" $nivurg = "Faible" $libelle $description = "Bonjour, j'ai un problème"                                                                              | OK               | OK              | Renvoie vers la page tableaudebord.php                    |
