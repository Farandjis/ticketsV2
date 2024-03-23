Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test boite noire 
## Site dynamique (connexion)

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

Le document suivant a pour but de tester la page connexion.
<br>

## <a name="II"></a>II - Description de la procédure de test

Nous allons tester tous les cas d'erreurs possibles lors de la connexion ainsi que les cas où elle fonctionne. 
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
| Date de finalisation               | 13/03/2024                                                               |
| Test à appliquer                   | Vérification du bon fonctionnement de la page connexion                  |
| Responsable de la campagne de test | GUIGNOLLE Enzo, Gouabi Assia, FARANDJIS Matthieu                         |


<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

### Partitions d'équivalence 

Afin de se connecter à la plateforme l'utilisateur a besoin de renseigner son login et son mot de passe. S'il parvient à se connecter le résultat obtenu sera OK, ce qui veut dire que la connexion a bien été effectué. 
<br>
Cependant, s'il échoue parce qu'un des champs ou les deux sont vides ou incorrects, l'erreur 3 ou 2 sera déclenchée. Ainsi, le login et le mot de passe peuvent être vides, corrects ou incorrects.  

### Conception des tests

| Cas | $loginSite                | $mdpMariaDB               | Résultat attendu   | Résultat obtenu    | Commentaires                                               |
|:----|---------------------------|---------------------------|--------------------|--------------------|------------------------------------------------------------|
| P1  | Vide                      | Correct                   | Exception erreur 3 | Exception erreur 3 | $loginSite vide et $mdpMariaDB correct                     |
| P2  | Correct                   | Vide                      | Exception erreur 3 | Exception erreur 3 | $loginSite correct et $mdpMariaDB vide                     |
| P3  | Vide                      | Vide                      | Exception erreur 3 | Exception erreur 3 | $loginSite et $mdpMariaDB vide                             |
| P4  | Correct                   | Incorrect                 | id = 2             | id = 2             | $loginSite correct et $mdpMariaDB incorrect                |
| P5  | Incorrect                 | Correct                   | id = 2             | id = 2             | $loginSite incorrect et $mdpMariaDB correct (majuscule)    |
| P6  | Incorrect                 | Correct                   | id = 2             | id = 2             | $loginSite incorrect et $mdpMariaDB correct (accent)       |
| P7  | Correct                   | Correct                   | OK                 | OK                 | $loginSite et $mdpMariaDB correct                          |
| P8  | Correct                   | Incorrect                 | id = 2             | id = 2             | $loginSite correct et $mdpMariaDB non conforme (accent)    |
| P9  | Correct                   | Incorrect                 | id = 2             | id = 2             | $loginSite correct et $mdpMariaDB non conforme (majuscule) |
| P10 | Correct                   | Incorrect (injection SQL) | id = 2             | id = 2             | Tentative ratée d'injection SQL                            |
| P11 | Correct                   | Incorrect (injection SQL) | id = 2             | id = 2             | Tentative ratée d'injection SQL                            |
| P12 | Incorrect (injection SQL) | Correct                   | id = 2             | id = 2             | Tentative ratée d'injection SQL                            |
| P13 | Incorrect (injection SQL) | Correct                   | id = 2             | id = 2             | Tentative ratée d'injection SQL                            |

### Exécution des tests 

| Cas n° | $loginSite | $mdpMariaDB      | Résultat attendu   | Résultat obtenu    |
|:-------|------------|------------------|--------------------|--------------------|
| 1      | " "        | Azertyalice!123  | Exception erreur 3 | Exception erreur 3 |
| 2      | alice      | " "              | Exception erreur 3 | Exception erreur 3 |
| 3      | " "        | " "              | Exception erreur 3 | Exception erreur 3 |
| 4      | alice      | adqiidqkdfesf    | id = 2             | id = 2             |
| 5      | alicE      | Azertyalice!123  | id = 2             | id = 2             |
| 6      | alicé      | Azertyalice!123  | id = 2             | id = 2             |
| 7      | alice      | Azertyalice!123  | OK                 | OK                 |
| 8      | alice      | Azértyalice!123  | id = 2             | id = 2             |
| 9      | alice      | AzErtyalice!123  | id = 2             | id = 2             |
| 10     | alice      | '";--'           | id = 2             | id = 2             |
| 11     | alice      | "';--"           | id = 2             | id = 2             |
| 12     | '";--'     | Azertyalice!123  | id = 2             | id = 2             |
| 13     | "';--"     | Azertyalice!123  | id = 2             | id = 2             |

Si le login et le mot de passe est bon, mais que l'utilisateur ne possède pas de rôle dans la base de donnée, l'accès lui est refusé avec un message d'erreur "Vous n'avez aucun rôle pour accéder au site."<br>
Si le login et le mot de passe est bon, mais que le rôle de l'utilisateur ne permet pas l'accès, l'accès lui sera refusé avec un message d'erreur "Votre rôle ne permet par la connexion".<br>
Si le compte n'existe pas, le login ou le mot de passe est invalide, il affiche l'erreur : "ERREUR : Le champ login ou mot de passe est incorrect ou votre compte n'existe pas"
