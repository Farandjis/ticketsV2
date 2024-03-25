Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test Boite noire
## Site dynamique (fonctions)

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

Le document suivant a pour but de tester les différentes fonctions créées pour permettre une utilisation plus simple de ses mêmes lignes de code.
<br>

## <a name="II"></a>II - Description de la procédure de test

Les fonctions que nous allons tester seront connectUser, valideMDP, executeSQL, recupererRoleDe, ValideEmail, verifyCAPTCHA.
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                           |
|------------------------------------|------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                             |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2) |
| Configuration matérielle           | Dell Optiplex 9020                                               |
| Date de début                      | 21/11/2023                                                       |
| Date de finalisation               | 23/03/2024                                                       |
| Test à appliquer                   | Vérification du bon fonctionnement des fonctions                 |
| Responsable de la campagne de test | GUIGNOLLE Enzo, Gouabi Assia                                     |

<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

- ### <a name="1a"></a>connectUser

### Partitions d'équivalence 

Les données utilisées pour réaliser cette fonction sont le loginMariaDB qui est l'identifiant d'un utilisateur dans la base de données. Il peut exister dans la base de données ou au contraire être inexistant. 
<br>
Mais il a également le mdpMariaDB qui peut être correct ou incorrect. De plus, si l'utilisateur n'entre aucune valeur, il ne sera pas authentifier et le retour de cette fonction sera faux. Dans le cas contraire, il sera vrai. 

### Conception des tests 

| Cas | $loginMariaDB       | $mdpMariaDB | Résultat attendu | Résultat obtenu | Commentaires                                |
|:----|---------------------|-------------|------------------|-----------------|---------------------------------------------|
| P1  | Existant            | Correct     | true             | true            | Les données sont correctement entrées       |
| P2  | vide                | Correct     | false            | false           | $loginMariaDB est vide                      |
| P3  | Existant            | Incorrect   | false            | false           | $mdpMariaDB est incorrect                   |
| P4  | Existant            | Vide        | false            | false           | $mdpMariaDB est vide                        |
| P5  | Inexistant          | Correct     | false            | false           | $loginMariaDB n'existe pas                  |
| P6  | Inexistant          | Incorrect   | false            | false           | Les données sont incorrects et inexistantes |
| P7  | Vide                | Vide        | false            | false           | Aucunes données n'est entré                 |

### Exécution des tests  

| Cas  | $loginMariaDB       | $mdpMariaDB | Résultat attendu | Résultat obtenu |
|:-----|---------------------|-------------|------------------|-----------------|
| P1   | 1                   | azerty!123  | true             | true            |
| P2   | " "                 | azerty!123  | false            | false           |
| P3   | 1                   | 123!azerty  | false            | false           |
| P4   | 1                   | " "         | false            | false           |
| P5   | 145689              | azerty!123  | false            | false           |
| P6   | 145689              | 123!azerty  | false            | false           |
| P7   | " "                 | " "         | false            | false           |

- ### <a name="2a"></a>valideMDP

### Partitions d'équivalence

Pour vérifier la validité d'un mot de passe, nous allons nous appuyer sur les caractères qui le compose. 
<br>
Il peut être valide ce qui veut dire qu'il respecte toutes les caractéristiques d'un mot de passe correct, mais peut être au contraire incorrect

Les différents cas de tests renvoient des valeurs entre : 0, -1, 1, -4, -3 et -2. 

### Conception des tests 

| Cas | $mdp      | Résultat attendu | Résultat obtenu | Commentaires                                          |
|:----|-----------|------------------|-----------------|-------------------------------------------------------|
| P1  | Valide    | 1                | 1               | Le format du mdp est valide                           |
| P2  | Incorrect | -1               | -1              | Absence de majuscule                                  |
| P3  | Incorrect | -4               | -4              | Absence d'un caractère spécial                        |
| P4  | Incorrect | -3               | -3              | Absence de chiffres                                   |
| P5  | Incorrect | 0                | 0               | Taille non conforme aux restrictions (inférieur à 12) |
| P6  | Incorrect | 0                | 0               | Taille non conforme aux restrictions (supérieur à 32) |
| P7  | Incorrect | -2               | -2              | Absence de minuscule                                  |

### Exécution des tests  

| Cas | $mdp                              | Résultat attendu | Résultat obtenu |
|:----|-----------------------------------|------------------|-----------------|
| P1  | Azertyalice!123                   | 1                | 1               |
| P2  | azertyalice!123                   | -1               | -1              |
| P3  | Azertyalice123                    | -4               | -4              |
| P4  | Azertyalice!                      | -3               | -3              |
| P5  | Azerty!123                        | 0                | 0               |
| P6  | Azertyaliceavrilbonjourrrr!123456 | 0                | 0               |
| P7  | AZERTYALICE!123                   | -2               | -2              |

- ### <a name="3a"></a>executeSQL

### Partitions d'équivalence

Nous avons testé la fonction executeSQL avec les opérations de sélection, de modification, d'insertion et suppression. 
<br> Les résultats que nous pouvons obtenir sont un booléen (false) ou un array. 
<br> $connexion fait référence à la connexion à la base de données avec les informations suivantes : <br> $host, "root", " ", $database

### Conception des tests 

| Cas | $reqSQL                                                                                                   | $params                                                        | $connexion | Résultat attendu | Résultat obtenu |
|-----|-----------------------------------------------------------------------------------------------------------|----------------------------------------------------------------|------------|------------------|-----------------|
| P1  | "SELECT ID_USER FROM UserFictif_connexion WHERE login_user = ?                                            | array(loginSite)                                               | $connexion | array(ID_USER)   | array(ID_USER)  |
| P2  | "SELECT ID_USER FROM UserFictif_connexion WHERE login_user = ?                                            | array(loginMariaDB)                                            | $connexion | array()          | array()         |
| P3  | "SELECT LOGIN_USER FROM UserFictif_connexion WHERE id_user = ?"                                           | array(loginSite)                                               | $connexion | array()          | array()         |
| P4  | "INSERT INTO UTILISATEUR (ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, EMAIL_USER) VALUES (?, ?, ?, ?, ?)" | array(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, EMAIL_USER ) | $connexion | false            | false           |
| P5  | "UPDATE vue_Utilisateur_maj_email SET email_user= ? WHERE ID_USER = ?"                                    | array( EMAIL_USER, ID_USER )                                   | $connexion | false            | false           |
| P6  | "DELETE FROM Utilisateur WHERE ID_USER = ? ;"                                                             | array(ID_USER)                                                 | $connexion | false            | false           |


### Exécution des tests 

| Cas | $reqSQL                                                                                                   | $params                                                           | $connexion | Résultat attendu | Résultat obtenu |
|-----|-----------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------|------------|------------------|-----------------|
| P1  | "SELECT ID_USER FROM UserFictif_connexion WHERE login_user = ?                                            | array("alice")                                                    | $connexion | array(1)         | array(1)        |
| P2  | "SELECT ID_USER FROM UserFictif_connexion WHERE login_user = ?                                            | array(1)                                                          | $connexion | array()          | array()         |
| P3  | "SELECT LOGIN_USER FROM UserFictif_connexion WHERE id_user = ?"                                           | array("alice")                                                    | $connexion | array()          | array()         |
| P4  | "INSERT INTO UTILISATEUR (ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, EMAIL_USER) VALUES (?, ?, ?, ?, ?)" | array(10000, "jmarc", "JeanMarc", "DELAVILLE", "jmarc@gmail.com") | $connexion | false            | false           |
| P5  | "UPDATE vue_Utilisateur_maj_email SET email_user= ? WHERE ID_USER = ?"                                    | array("jeanmarc@gmail.com", 10000)                                | $connexion | false            | false           |
| P6  | "DELETE FROM Utilisateur WHERE ID_USER = ? ;"                                                             | array(10000)                                                      | $connexion | false            | false           |


- ### <a name="4a"></a>recupereRoleDE

### Partitions d'équivalence

Nous avons 4 rôles : l'utilisateur, l'administrateur système et web et le technicien. Cependant, le visiteur peut aussi avoir accès à la page d'accueil de la plateforme. 
Nous avons décidé de prendre l'utilisateur Alice, l'administrateur web de la plateforme Gestion, l'administrateur système Admin et le technicien Gordon pour matérialiser nos cas de tests. 

### Conception des tests 

| Cas | $loginMariaDB                                 | $mdpMariaDB          | Résultat attendu       | Résultat obtenu        | Commentaires                                        |
|:----|-----------------------------------------------|----------------------|------------------------|------------------------|-----------------------------------------------------|
| P1  | Identifiant d'Alice                           | Mot de passe d'Alice | Utilisateur            | Utilisateur            | récupération du rôle d'utilisateur d'alice          |
| P2  | Identifiant Admin                             | Mot de passe Admin   | Administrateur Système | Administrateur Système | récupération du rôle d'administrateur système Admin |
| P3  | Identifiant Gestion                           | Mot de passe Gestion | Administrateur Site    | Administrateur Site    | récupération du rôle d'administrateur web Gestion   |
| P4  | j'accède à la plateforme en tant que visiteur | " "                  | Rôle manquant          | Rôle manquant          | Aucun rôle n'a été attribué au visiteur             |
| P5  | Identifiant Gordon                            | Mot de passe Gordon  | Technicien             | Technicien             | récupération du rôle de technicien de Gordon        |

### Exécution des tests 

| Cas | $loginMariaDB | $mdpMariaDB                | Résultat attendu       | Résultat obtenu        |
|:----|---------------|----------------------------|------------------------|------------------------|
| P1  | 1             | azerty!123                 | Utilisateur            | Utilisateur            |
| P2  | 5             | Assuranc3t0ur!x            | Administrateur Système | Administrateur Système |
| P3  | 6             | P0rqu3p!x                  | Administrateur Site    | Administrateur Site    |
| P4  | visiteur      | t9t+<Q33Pe%o4woPNwDhNdhZBz | Rôle manquant          | Rôle manquant          |
| P5  | 4             | azerty!123                 | Technicien             | Technicien             |


- ### <a name="5a"></a>valideEmail

### Partitions d'équivalence 

L'email doit respecter certaines caractéritisques. Dependant de celles-ci, il peut être correct, vide ou incorrect. 
On obtiendra ainsi un booléen true ou false.

### Conception des tests

| Cas | $email    | Résultat attendu | Résultat obtenu | Commentaires                             |
|:----|-----------|------------------|-----------------|------------------------------------------|
| P1  | Correct   | true             | true            | $email est conforme                      |
| P2  | Correct   | true             | true            | $email est conforme                      |
| P3  | Vide      | false            | false           | $email est vide                          |
| P4  | Incorrect | false            | false           | L'email contient un #                    |
| P5  | Incorrect | false            | false           | Il y a un accent dans l'email            |
| P6  | Incorrect | false            | false           | Il n'y a pas assez de lettres après le . |
| P7  | Incorrect | false            | false           | Il y a trop de lettres après le .        |
| P8  | Incorrect | false            | false           | Il manque un @                           |
| P9  | Incorrect | false            | false           | pas de lettres avant le @                |
| P10 | Incorrect | false            | false           | pas de lettres après le @                |
| P11 | Incorrect | false            | false           | Manque de caractère après @              |
| P12 | Incorrect | false            | false           | Manque un nom de domaine                 |
| P13 | Incorrect | false            | false           | $email dans le désordre                  |
| P14 | Incorrect | false            | false           | $email non conforme                      |
| P15 | Incorrect | false            | false           | pas de "x.x", directement "x"            |
| P16 | Incorrect | false            | false           | pas de "x.x", directement "x"            |


### Exécution des tests  

| Cas | $email                  | Résultat attendu | Résultat obtenu |
|:----|-------------------------|------------------|-----------------|
| P1  | alice@email.com         | true             | true            |
| P2  | alice.avril@email.com   | true             | true            |
| P3  | " "                     | false            | false           |
| P4  | alice#email.com         | false            | false           |
| P5  | alicé@email.com         | false            | false           |
| P6  | alice@email.c           | false            | false           |
| P7  | alice@email.cooom       | false            | false           |
| P8  | alice.avrilemail.com    | false            | false           |
| P9  | @email.com              | false            | false           |
| P10 | alice.avril@            | false            | false           |
| P11 | alice.avril@.com        | false            | false           |
| P12 | alice.avril@email       | false            | false           |
| P13 | @emailalice.avril.fr    | false            | false           |
| P14 | alice.avril@.fremail    | false            | false           |
| P15 | avril@email.fr.de       | false            | false           |
| P16 | alice.avril@email.fr.de | false            | false           |


- ### <a name="6a"></a>verifyCAPTCHA

### Partitions d'équivalence 

Les données utilisées pour vérifier la validité d'un captcha sont des chiffres ou nombres qui doivent être compris entre 0 et 20 et la réponse de l'utilisateur face au captcha. 
Si la réponse se révèle être incorrecte, on retournera false sinon true. 

### Conception des tests 

| Cas | $chiffre1           | $chiffre2           | $reponseUtilisateur   | Résultat attendu | Résultat obtenu | Commentaires                 |
|:----|---------------------|---------------------|-----------------------|------------------|-----------------|------------------------------|
| P1  | 0 <= chiffre1 >= 20 | 0 <= chiffre2 >= 20 | Vide                  | false            | false           | Aucune réponse n'a été donné | 
| P2  | 0 <= chiffre1 >= 20 | 0 <= chiffre2 >= 20 | Tentative d'injection | false            | false           | Tentative échouée            | 
| P3  | 0 <= chiffre1 >= 20 | 0 <= chiffre2 >= 20 | Incorrect             | false            | false           | Réponse incorrect            |
| P4  | 0 <= chiffre1 >= 20 | 0 <= chiffre2 >= 20 | Correct               | true             | true            | Captcha correct              |

### Exécution des tests 

| Cas | $chiffre1 | $chiffre2 | $reponseUtilisateur | Résultat attendu | Résultat obtenu |
|:----|-----------|-----------|---------------------|------------------|-----------------|
| P1  | 12        | 20        | " "                 | false            | false           | 
| P2  | 12        | 20        | !!                  | false            | false           | 
| P3  | 12        | 20        | 45                  | false            | false           |
| P4  | 12        | 20        | 32                  | true             | true            |

