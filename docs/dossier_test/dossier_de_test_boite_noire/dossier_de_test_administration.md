Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test Boite noire 
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
  - #### [Ajout d'un technicien](#1a)
  - #### [Suppression d'un technicien](#2a)
  - #### [Ajout d'un titre](#3a)
  - #### [Suppression d'un titre](#4a)
  - #### [Ajout d'un mot-clé](#5a)
  - #### [Suppression d'un mot-clé](#6a)
  - #### [Bannir un utilisateur](#7a)
  - #### [Debannir un utilisateur](#8a)



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

- ### <a name="1a"></a>Ajout d'un technicien

### Partitions d'équivalence 

Pour ajouter un technicien, il faut le sélectionner dans la liste des utilisateurs. Le résultat attendu n'est pas visuel mais son rôle est modifié dans la base de données. 

### Conception des tests

| Cas n° | Critère                                         | Résultat attendu                          | Résultat obtenu                           |
|--------|-------------------------------------------------|-------------------------------------------|-------------------------------------------|
| 1      | On sélectionne un utilisateur                   | Modifie le rôle utilisateur en technicien | Modifie le rôle utilisateur en technicien |
| 2      | On ne sélectionne personne dans la liste        | Aucun rôle n'est modifié                  | Aucun rôle n'est modifié                  |

### Exécution des tests

| Cas n° | Critère        | Résultat attendu                          | Résultat obtenu                           |
|--------|----------------|-------------------------------------------|-------------------------------------------|
| 1      | Hongo Roberto  | Modifie le rôle utilisateur en technicien | Modifie le rôle utilisateur en technicien |
| 2      | " "            | Aucun rôle n'est modifié                  | Aucun rôle n'est modifié                  |


- ### <a name="2a"></a>Suppression d'un technicien

### Partitions d'équivalence 

Pour supprimer un technicien, il faut séléctionner le technicien à supprimer dans la liste. Le résultat attendu est que le rôle lui est enlevé 

### Conception des tests 

| Cas n° | Critère                                         | Résultat attendu                                   | Résultat obtenu                                   |
|--------|-------------------------------------------------|----------------------------------------------------|---------------------------------------------------|
| 1      | On sélectionne un technicien                    | Son rôle utilisateur en technicien lui est enlevé  | Son rôle utilisateur en technicien lui est enlevé |
| 2      | On Sélectionne le seul technicien dans la liste | Son rôle utilisateur en technicien lui est enlevé  | Son rôle utilisateur en technicien lui est enlevé |
| 3      | On ne sélectionne personne dans la liste        | Aucun rôle n'est modifié                           | Aucun rôle n'est modifié                          |

### Exécution des tests 

| Cas n° | Critère        | Résultat attendu                                   | Résultat obtenu                                   |
|--------|----------------|----------------------------------------------------|---------------------------------------------------|
| 1      | Hongo Roberto  | Son rôle utilisateur en technicien lui est enlevé  | Son rôle utilisateur en technicien lui est enlevé |
| 2      | Shumway Gordon | Son rôle utilisateur en technicien lui est enlevé  | Son rôle utilisateur en technicien lui est enlevé |
| 3      | " "            | Aucun rôle n'est modifié                           | Aucun rôle n'est modifié                          |

- ### <a name="3a"></a>Ajout d'un titre

### Partitions d'équivalence 

Pour ajouter un titre, il faut sélectionner un tag dans la liste proposée puis entrer un titre. Le résultat attendu est OK si l'ajout a bien été effectué et KO sinon.

### Conception des tests

| Cas n° | TAG                                       | Titre         | Résultat attendu | Résultat obtenu |
|--------|-------------------------------------------|---------------|------------------|-----------------|
| 1      | On choisit un mot dans la liste proposée  | Conforme      | OK               | OK              |
| 2      | On choisit un mot dans la liste proposée  | Non conforme  | KO               | KO              |
| 3      | On choisit un mot dans la liste proposée  | déjà existant | KO (id = 102)    | KO (id = 102)   |

### Exécution des tests

| Cas n° | TAG    | Titre                      | Résultat attendu | Résultat obtenu |
|--------|--------|----------------------------|------------------|-----------------|
| 1      | Autre  | Administration             | OK               | OK              |
| 2      | Autre  | Salut (trop petite taille) | KO               | KO              |
| 3      | Autre  | Piratage                   | KO (id = 102)    | KO (id = 102)   |


- ### <a name="4a"></a>Suppression d'un titre

### Partitions d'équivalence 

Pour supprimer un titre, il faut cocher un titre parmis les titres dans la liste. Le résultat attendu est qu'il n'apparait plus dans la base de données et dans la liste. 

### Conception des tests 

| Cas n° | Critère                         | Résultat attendu                                            | Résultat obtenu                                              |
|--------|---------------------------------|-------------------------------------------------------------|--------------------------------------------------------------|
| 1      | On coche un titre dans la liste | Le titre est supprimé de la liste et de la base de données  | Le titre est supprimé de la liste et de la base de données   |
| 2      | On ne coche rien dans la liste  | Aucun titre n'est supprimé                                  | Aucun titre n'est supprimé                                   |

### Exécution des tests 

| Cas n° | Critère                | Résultat attendu                                             | Résultat obtenu                                              |
|--------|------------------------|--------------------------------------------------------------|--------------------------------------------------------------|
| 1      | Autre : Administration | Le titre est supprimé de la liste et de la base de données   | Le titre est supprimé de la liste et de la base de données   |
| 2      | " "                    | Aucun titre n'est supprimé                                   | Aucun titre n'est supprimé                                   |

- ### <a name="5a"></a>Ajout d'un mot-clé

### Partitions d'équivalence 

Pour ajouter un mot-clé, il faut choisir un tag dans la liste et entrer un mot-clé. Le résultat attendu est OK si l'ajout a bien été fait et KO sinon. 

### Conception des tests

| Cas n° | Tag                                       | Mots-clés           | Résultat attendu | Résultat obtenu |
|--------|-------------------------------------------|---------------------|------------------|-----------------|
| 1      | On choisit un mot dans la liste proposée  | On entre un mot-clé | OK               | OK              |
| 2      | On choisit un mot dans la liste proposée  | Déjà existant       | KO (id = 204)    | KO (id = 204)   |

### Exécution des tests

| Cas n° | Tag    | Mots-clés | Résultat attendu | Résultat obtenu |
|--------|--------|-----------|------------------|-----------------|
| 1      | Autre  | salut     | OK               | OK              |
| 2      | Autre  | salut     | KO (id = 204)    | KO (id = 204)   |


- ### <a name="6a"></a>Suppression d'un mot-clé

### Partitions d'équivalence 

Pour supprimer un mot-clé, il faut cocher un mot-clé dans la liste. Le résultat attendu est que le mot-clé est supprimé de la liste et de la base de données. 

### Conception des tests

| Cas n° | Critère                           | Résultat attendu                                             | Résultat obtenu                                               |
|--------|-----------------------------------|--------------------------------------------------------------|---------------------------------------------------------------|
| 1      | On coche un mot-clé dans la liste | Le mot-clé est supprimé de la liste et de la base de données | Le mot-clé est supprimé de la liste et de la base de données  |
| 2      | On ne coche rien dans la liste    | Aucun mot-clé n'est supprimé                                 | Aucun mot-clé n'est supprimé                                  |

### Exécution des tests 

| Cas n° | Critère       | Résultat attendu                                              | Résultat obtenu                                               |
|--------|---------------|---------------------------------------------------------------|---------------------------------------------------------------|
| 1      | Autre : Salut | Le mot-clé est supprimé de la liste et de la base de données  | Le mot-clé est supprimé de la liste et de la base de données  |
| 2      | " "           | Aucun mot-clé n'est supprimé                                  | Aucun mot-clé n'est supprimé                                  |

- ### <a name="7a"></a>Bannir un compte 

### Partitions d'équivalence

Pour bannir un utilisateur, il faut choisir un utilisateur à bannir, entrer la date jusqu'à laquelle il va être banni. Le résultat attendu est qu'il apparait comme étant banni de la plateforme dans la base de données et qu'il n'a plus accès à la plateforme. 

### Conception des tests

| Cas n° | Utilisateur                    | Date                | Résultat attendu                                                                            | Résultat obtenu                                                                              |
|--------|--------------------------------|---------------------|---------------------------------------------------------------------------------------------|----------------------------------------------------------------------------------------------|
| 1      | On sélectionne un utilisateur  | On choisit une date | L'utilisateur est marqué banni dans la base de données et il n'a plus accès à la plateforme | L'utilisateur est marqué banni dans la base de données et il n'a plus accès à la plateforme  |

### Exécution des tests

| Cas n° | Utilisateur    | Date       | Résultat attendu                                                                             | Résultat obtenu                                                                              |
|--------|----------------|------------|----------------------------------------------------------------------------------------------|----------------------------------------------------------------------------------------------|
| 1      | Guignolle Enzo | 25/03/2024 | L'utilisateur est marqué banni dans la base de données et il n'a plus accès à la plateforme  | L'utilisateur est marqué banni dans la base de données et il n'a plus accès à la plateforme  |

- ### <a name="8a"></a>Débannir un compte

### Partitions d'équivalence

Pour débannir un utilisateur, il faut choisir un utilisateur à bannir, entrer la date jusqu'à laquelle il va être banni. Le résultat attendu est qu'il apparait comme étant banni de la plateforme dans la base de données et qu'il n'a plus accès à la plateforme.

### Conception des tests

| Cas n° | Utilisateur                    | Résultat attendu                                                                                       | Résultat obtenu                                                                                         |
|--------|--------------------------------|--------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------|
| 1      | On sélectionne un utilisateur  | L'utilisateur est marqué comme débanni dans la base de données et il a accès à nouveau à la plateforme | L'utilisateur est marqué comme débanni dans la base de données et il a accès à nouveau à la plateforme  |

### Exécution des tests

| Cas n° | Utilisateur    | Résultat attendu                                                                                        | Résultat obtenu                                                                                         |
|--------|----------------|---------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------|
| 1      | Guignolle Enzo | L'utilisateur est marqué comme débanni dans la base de données et il a accès à nouveau à la plateforme  | L'utilisateur est marqué comme débanni dans la base de données et il a accès à nouveau à la plateforme  |
