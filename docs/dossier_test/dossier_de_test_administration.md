Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test
## Site dynamique

<br><br>
Ce document permet de s'assurer que la page administration de l'application web soit fonctionnelle.

</div>

<br><br><br><br><br><br><br>

## Plan
- ### [I - Introduction](#I)
- ### [II - Description de la procédure de test](#II)
- ### [III - Contexte des tests](#III)
- ### [IV - Test ](#IV)


<br><br><br>

----------

<br><br><br>

## <a name="I"></a>I - Introduction

Le document suivant à pour but de tester la page administration.php.
<br>

## <a name="II"></a>II - Description de la procédure de test

Nous allons définir tous les retours possibles que peut renvoyer cette page en fonction du rôle de la personne.
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                                            |
|------------------------------------|-----------------------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                                              |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2)                  |
| Configuration matérielle           | Dell Optiplex 9020                                                                |
| Date de début                      | 09/01/2024                                                                        |
| Date de finalisation               | /01/2024                                                                          |
| Test à appliquer                   | Vérification du bon fonctionnement de la page administration (administration.php) |
| Responsable de la campagne de test | Guignolle Enzo                                                                    |

<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

#### <a name="1a"></a>Ajout d'un technicien

| Cas n° | Critère                                                                   | Résultat attendu                            | Résultat obtenu                             |
|--------|---------------------------------------------------------------------------|---------------------------------------------|---------------------------------------------|
| 1      | On coche une ou plusieurs nouvelles personnes dans la liste des personnes | Modifie leur rôle utilisateur en technicien | Modifie leur rôle utilisateur en technicien |
| 2      | On decoche une ou plusieurs personnes dans la liste des personnes         | Modifie leur rôle technicien en utilisateur | Modifie leur rôle technicien en utilisateur |
| 3      | On ne coche ni décoche personne dans la liste                             | Aucun rôle n'est modifié                    |                                             |

#### <a name="1b"></a>Ajout d'un titre

| Cas n° | Critère                                         | Résultat attendu | Résultat obtenu |
|--------|-------------------------------------------------|------------------|-----------------|
| 1      | On entre dans le champ [SESSION] Autre problème | OK               | OK              |
| 2      | On entre dans le champ <b>Salut<b>              | OK               | OK              |
| 3      | On entre dans le champ 'Salut'                  | OK               | OK              |
| 4      | On ajoute un titre déjà existant                | KO               | KO              |

#### <a name="1c"></a>Suppression d'un titre

| Cas n° | Critère                         | Résultat attendu               | Résultat obtenu                |
|--------|---------------------------------|--------------------------------|--------------------------------|
| 1      | On coche un titre dans la liste | Le titre est supprimé de la BD | Le titre est supprimé de la BD |
| 2      | On ne coche rien dans la liste  | Aucun titre n'est supprimé     | Aucun titre n'est supprimé     |


#### <a name="1d"></a>Ajout d'un mot clés

| Cas n° | Critère                                         | Résultat attendu | Résultat obtenu |
|--------|-------------------------------------------------|------------------|-----------------|
| 1      | On entre dans le champ [SESSION] Autre problème | OK               | OK              |
| 2      | On entre dans le champ <b>Salut<b>              | OK               | OK              |
| 3      | On entre dans le champ 'Salut'                  | OK               | OK              |
| 4      | On ajoute un mot clés déjà existant             | KO               | KO              |

#### <a name="1e"></a>Suppression d'un mot clés

| Cas n° | Critère                           | Résultat attendu                 | Résultat obtenu                  |
|--------|-----------------------------------|----------------------------------|----------------------------------|
| 1      | On coche un mot-clé dans la liste | Le mot-clé est supprimé de la BD | Le mot-clé est supprimé de la BD |
| 2      | On ne coche rien dans la liste    | Aucun mot-clé n'est supprimé     | Aucun mot-clé n'est supprimé     |

