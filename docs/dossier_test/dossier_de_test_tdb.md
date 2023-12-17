Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test
## Tableau de bord

<br><br>
Ce document permet de s'assurer que la page tableau de bord soient conforme à ce qui a été conçu.

</div>

<br><br><br><br><br><br><br>

## Plan
- ### [I - Introduction](#I)
- ### [II - Description de la procédure de test](#II)
- ### [III - Contexte des tests](#III)
- ### [IV - Test](#IV)
  - #### [Formulaire de recherche](#a)
  - #### [Bouton de modification d'un ticket](#b)
    - ##### [Administrateur Web](#b1)
    - ##### [Administrateur Sys](#b2)
    - ##### [Utilisateur](#b3)
    - ##### [Technicien](#b4)

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
| Produit testé                      | Site statique (HTML et CSS)                                      |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2) |
| Configuration matérielle           | Dell Optiplex 9020                                               |
| Date de début                      | 17/10/2023                                                       |
| Date de finalisation               | 17/10/2023                                                       |
| Test à appliquer                   | Vérification de la validité du site                              |
| Responsable de la campagne de test | GUIGNOLLE Enzo, Gouabi Assia                                     |

<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

<br><br>

### <a name="a"></a>Formulaire de recherche

<br>

| Cas n° | Critère                                                                  | Résultat attendu | Résultat obtenu | Commentaires                                                                                     |
|:-------|--------------------------------------------------------------------------|------------------|-----------------|--------------------------------------------------------------------------------------------------|
| 1      | On entre en dans le champs titre "Problème"                              | 5 tickets        | 5 tickets       | On trouve les différents tickets qui ont dans leur titre est "Problème"                          |
| 2      | On coche "Moniteur HS" dans le champ libellé                             | 2 tickets        | 2 tickets       | On trouve les différents tickets qui ont comme libellé "Moniteur HS"                             |
| 3      | On met dans le champ date à droite "10/12/2023"                          | 14 tickets       | 14 tickets      | On trouve les différents tickets qui ont été crée avant le "10/12/2023"                          |
| 4      | On met dans le champ date à gauche "08/12/2023"                          | 14 tickets       | 14 tickets      | On trouve les différents tickets qui ont été crée après le "08/12/2023"                          |
| 5      | On met dans le champ date à gauche "08/12/2023" et à droite "10/12/2023" | 14 tickets       | 14 tickets      | On trouve les différents tickets qui ont été crée avant le "10/12/2023" et après le "08/12/2023" |
| 1      | On entre en dans le champs titre "Problème d'affichage"                  | 1 tickets        | 1 tickets       | On trouve les différents tickets qui ont dans leur titre est "Problème d'affichage"              |

<br>

### <a name="b"></a>Bouton de modification d'un ticket

<br>

#### <a name="b1"></a>Administrateur Web

| Cas n° | Critère                        | Résultat attendu                            | Résultat obtenu                             | Commentaires                                                                              |
|:-------|--------------------------------|---------------------------------------------|---------------------------------------------|-------------------------------------------------------------------------------------------|
| 1      | Etat du ticket = ouvert        | Un bouton "Attribuer ou modifier ce ticket" | Un bouton "Attribuer ou modifier ce ticket" | En appuyant sur un ticket ouvert, un bouton "Attribuer ou modifier ce ticket" apparaît    |
| 2      | Etat du ticket = en attente    | Un bouton "Définir l'urgence de ce ticket"  | Un bouton "Définir l'urgence de ce ticket"  | En appuyant sur un ticket en attente, un bouton "Définir l'urgence de ce ticket" apparaît |
| 3      | Tout les autres état de ticket | Un bouton "Modifier ce ticket"              | Un bouton "Modifier ce ticket"              | En appuyant sur un ticket avec un autre etat , un bouton "Modifier ce ticket" apparaît    |

<br>

#### <a name="b2"></a>Administrateur Système

| Cas n° | Critère                                              | Résultat attendu               | Résultat obtenu                | Commentaires                                                                                               |
|:-------|------------------------------------------------------|--------------------------------|--------------------------------|------------------------------------------------------------------------------------------------------------|
| 1      | Etat du ticket = en attente + un ticket qu'il a créé | Un bouton "Modifier ce ticket" | Un bouton "Modifier ce ticket" | En appuyant sur un ticket en attente et qui est son propre ticket, un bouton "Modifier ce ticket" apparaît |
| 2      | Tout les autres état de ticket                       | Aucun bouton n'apparaît        | Aucun bouton n'apparaît        | En appuyant sur un ticket avec un autre etat , aucun bouton n'apparaît                                     |

<br>

#### <a name="b3"></a>Utilisateur

| Cas n° | Critère                                              | Résultat attendu               | Résultat obtenu                | Commentaires                                                                                               |
|:-------|------------------------------------------------------|--------------------------------|--------------------------------|------------------------------------------------------------------------------------------------------------|
| 1      | Etat du ticket = en attente + un ticket qu'il a créé | Un bouton "Modifier ce ticket" | Un bouton "Modifier ce ticket" | En appuyant sur un ticket en attente et qui est son propre ticket, un bouton "Modifier ce ticket" apparaît |
| 2      | Tout les autres état de ticket                       | Aucun bouton n'apparaît        | Aucun bouton n'apparaît        | En appuyant sur un ticket avec un autre etat , aucun bouton n'apparaît                                     |

<br>

#### <a name="b4"></a>Technicien

| Cas n° | Critère                                                             | Résultat attendu                  | Résultat obtenu                   | Commentaires                                                                                                    |
|:-------|---------------------------------------------------------------------|-----------------------------------|-----------------------------------|-----------------------------------------------------------------------------------------------------------------|
| 1      | Etat du ticket = en attente + un ticket qu'il lui a été attribué    | Un bouton "Modifier ce ticket"    | Un bouton "Modifier ce ticket"    | En appuyant sur un ticket en attente et qui lui a été attribué, un bouton "Modifier ce ticket" apparaît         |
| 2      | Etat du ticket = Ouvert                                             | Un bouton "S'attribuer ce ticket" | Un bouton "S'attribuer ce ticket" | En appuyant sur un ticket ouvert ,un bouton "s'attribuer ce ticket" apparaît                                    |
| 2      | Tout les autres état de ticket + un ticket qu'il lui a été attribué | Un bouton "Modifier ce ticket"    | Un bouton "Modifier ce ticket"    | En appuyant sur un ticket avec un autre etat et qui lui a été attribué, un bouton "Modifier ce ticket" apparaît |

