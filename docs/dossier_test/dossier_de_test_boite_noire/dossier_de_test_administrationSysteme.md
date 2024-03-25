Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test Boite noire 
## Site dynamique

<br><br>
Ce document permet de s'assurer que la page administration de l'application système soit fonctionnelle.

</div>

<br><br><br><br><br><br><br>

## Plan
- ### [I - Introduction](#I)
- ### [II - Description de la procédure de test](#II)
- ### [III - Contexte des tests](#III)
- ### [IV - Test ](#IV)
  - #### [Télécharger une archive de l'historique des tickets, les connexions infructueuses ou l'ouverture des tickets ](#1a)
  - #### [Suppression d'une archive de l'historique des tickets, les connexions infructueuses ou l'ouverture des tickets ](#2a)



<br><br><br>

----------

<br><br><br>

## <a name="I"></a>I - Introduction

Le document suivant à pour but de tester la page administration.php du point de vu de l'administrateur web.
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
| Date de finalisation               | 25/03/2024                                                                        |
| Test à appliquer                   | Vérification du bon fonctionnement de la page administration (administration.php) |
| Responsable de la campagne de test | Gouabi Assia                                                                      |

<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

- ### <a name="1a"></a>Télécharger une archive de l'historique des tickets, les connexions infructueuses ou l'ouverture des tickets 

### Partitions d'équivalence 

Pour télécharger une archive, il suffit de sélectionner la flèche prévue à cet effet. Le résultat attendu est OK si l'achive a bien été téléchargé et KO sinon.

### Conception des tests

| Cas n° | Archive                   | Résultat attendu         | Résultat obtenu          |
|--------|---------------------------|--------------------------|--------------------------|
| 1      | On télécharge une archive | OK                       | OK                       |

### Exécution des tests

| Cas n° | Archive                 | Résultat attendu | Résultat obtenu |
|--------|-------------------------|------------------|-----------------|
| 1      | archive_20240317.tar.gz | OK               | OK              |

- ### <a name="2a"></a>Suppression d'une archive de l'historique des tickets, les connexions infructueuses ou l'ouverture des tickets 

### Partitions d'équivalence 

Pour supprimer une archive, il suffit de sélectionner la poubelle prévu à cet effet. Le résultat attendu est OK si l'achive a bien été supprimé et KO sinon. 

### Conception des tests 

| Cas n° | Archive                 | Résultat attendu | Résultat obtenu |
|--------|-------------------------|------------------|-----------------|
| 1      | On supprime une archive | OK               | OK              |

### Exécution des tests 

| Cas n° | Archive                 | Résultat attendu | Résultat obtenu |
|--------|-------------------------|------------------|-----------------|
| 1      | archive_20240317.tar.gz | OK               | OK              |

