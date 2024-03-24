Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test
## Site dynamique Boite blanche

<br><br>
Ce document permet de s'assurer que les fonctions soient bien fonctionnelles comme souhaité.

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
        - #### [recupererRoleDe](#4a)
        - #### [valideEmail](#5a)
        - #### [verifyCAPTCHA](#6a)


<br><br><br>

----------

<br><br><br>

## <a name="I"></a>I - Introduction

Le document suivant à pour but de tester les différentes fonctions crées pour permettre une utilisation et compréhension plus simple des lignes de code.
<br>

## <a name="II"></a>II - Description de la procédure de test

Les fonctions que nous allons tester seront connectUser, valideMDP et executeSQL, recupererRoleDe, tableGenerate, ValideEmail, operationCAPTCHA, verifyCAPTCHA, pageAccess, deconnexionSite, affichageMenuDuHaut, menuDeroulant.
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                           |
|------------------------------------|------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                             |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2) |
| Configuration matérielle           | Dell Optiplex 9020                                               |
| Date de début                      | 04/03/2024                                                       |
| Date de finalisation               |                                                                  |
| Test à appliquer                   | Vérification du bon fonctionnement des fonctions                 |
| Responsable de la campagne de test | Gouabi Assia                                                     |

<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

### <a name="1a"></a>connectUser

Pour le schéma, dans l'instruction 4 nous avons regrouper toutes les instructions ensembles 

<img height="700" width="300" src="../img/connectUser.png" title="connectUser"/>

## Les chemins que nous proposons pour ce schéma 

### C1 = {1,7} <br>
### C2 = {1,2,3,6} <br>
### C3 = {1,2,3,4,5}

## Conception des tests boites blanches de la fonction ConnectUser

| Chemin | $loginMariaDB                                      | $loginSite | $mdpMariaDB | $connexionUtilisateur                                 | Résultat |
|--------|----------------------------------------------------|------------|-------------|-------------------------------------------------------|----------|
| C1     | l'utilisateur n'existe pas dans la base de données |            |             |                                                       | false    |
| C2     | l'utilisateur existe dans la base de données       | correct    | incorrect   | la connexion à la base de données n'a pas été établie | false    |
| C3     | l'utilisateur existe dans la base de données       |            |             | la connexion à la base de données a bien été établie  | true     |

## Réalisation des tests boites blanches de la fonction ConnectUser

| Chemin | $loginMariaDB | $loginSite | $mdpMariaDB | $connexionUtilisateur                                 | Résultat |
|--------|---------------|------------|-------------|-------------------------------------------------------|----------|
| C1     | 12222002      |            |             |                                                       | false    |
| C2     | 1             | alice      | azerty!     | la connexion à la base de données n'a pas été établie | false    |
| C3     | 1             | alice      | azerty!123  | la connexion à la base de données a bien été établie  | true     |

### <a name="2a"></a>valideMdp

<img height="700" width="500" src="../img/valideMdp.png" title="valideMdp"/>

## Les chemins que nous proposons pour ce schéma

### C1 = {1,11} <br>
### C2 = {1,2,10} <br>
### C3 = {1,2,3,9} <br>
### C4 = {1,2,3,4,8} <br>
### C5 = {1,2,3,4,5,7} <br>
### C6 = {1,2,3,4,5,6}

## Conception des tests boites blanches de la fonction valideMdp

| Chemin | $mdp                                                                                                        | Résultat |
|--------|-------------------------------------------------------------------------------------------------------------|----------|
| C1     | $mdp fait 34 caractères                                                                                     | 0        |
| C2     | $mdp fait 13 caractères sans majuscule                                                                      | -1       |
| C3     | $mdp fait 13 caractères, contient une majuscule mais pas de minuscule                                       | -2       |
| C4     | $mdp fait 13 caractères, contient une majuscule, des minuscules mais pas de chiffres                        | -3       |
| C5     | $mdp fait 13 caractères, contient une majuscule, des minuscules, des chiffres mais pas de caractère spécial | -4       |
| C6     | $mdp est conforme                                                                                           | 1        |

## Réalisation des tests boites blanches de la fonction valideMdp


| Chemin | $mdp                               | Résultat |
|--------|------------------------------------|----------|
| C1     | Azertybonjourcava78913456767890864 | 0        |
| C2     | azerty!123456                      | -1       |
| C3     | AZERTY!123456                      | -2       |
| C4     | Azerty!salutt                      | -3       |
| C5     | Azerty1123456                      | -4       |
| C6     | Azerty!123456                      | 1        |

### <a name="4a"></a>recupererRoleDe

<img height="700" width="300" src="../img/recupererRoleDe.png" title="recupererRoleDe"/>

## Les chemins que nous proposons pour ce schéma

### C1 = {1,2,3} <br>
### C2 = {1,4,5} <br>
### C3 = {1,6,7} <br>
### C4 = {1,8,9} <br>
### C5 = {1,10,11}

## Conception des tests boites blanches de la fonction recupererRoleDe

| Chemin | $loginMariaDB                           | $mdpMariaDB                              | Résultat               |
|--------|-----------------------------------------|------------------------------------------|------------------------|
| C1     | Identifiant d'un utilisateur            | Mot de passe d'un utilisateur            | Utilisateur            |
| C2     | Identifiant d'un technicien             | Mot de passe d'un technicien             | Technicien             |
| C3     | Identifiant de l'administrateur web     | Mot de passe de l'administrateur web     | Administrateur Site    |
| C4     | Identifiant de l'administrateur système | Mot de passe de l'administrateur système | Administrateur Système |
| C5     | Aucun role                              | Aucun role                               | Rôle manquant          |

## Réalisation des tests boites blanches de la fonction recupererRoleDe


| Chemin | $loginMariaDB | $mdpMariaDB                 | Résultat               |
|--------|---------------|-----------------------------|------------------------|
| C1     | 1             | azerty!123                  | Utilisateur            |
| C2     | 4             | azerty!123                  | Technicien             |
| C3     | 6             | P0rqu3p!x                   | Administrateur Site    |
| C4     | 5             | Assuranc3t0ur!x             | Administrateur Système |
| C5     | visiteur      | t9t+<Q33Pe%o4woPNwDhNdhZBz  | Rôle manquant          |
