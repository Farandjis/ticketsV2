Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S4 - Rapport Dossier de test 
## Site dynamique

<br><br>

</div>

<br><br><br><br><br><br><br>

## Plan
- ### [I - Introduction](#1)
- ### [II - Contexte des tests](#2)
- ### [IV - Test ](#3)
    - #### [Tests unitaires](#3a)
        - #### [Tests boite noire pour les pages](#1a)
        - #### [Tests boite noire pour les fonctions](#2ab)
        - #### [Tests Boite blanche](#2a)
    - #### [Tests PHPunits](#4a)
    - #### [Tests Base de donnees](#5a)
    - #### [Tests d'affichage des pages du site statique](#6a)
    - #### [Tests d'affichage des pages du site dynamique](#7a)
    - #### [Tests des fonctions d'affichage](#8a)
    - #### [Tests d'integration](#9a)

<br><br><br>

----------

<br><br><br>

## <a name="1"></a>I - Introduction

Ce document a pour but principal de faciliter la navigation et la lecture des tests effectués sur les fonctions et les pages de notre application.
<br>

## <a name="2"></a>II - Contexte des tests

| Définition               | Situation pour le test                                           |
|--------------------------|------------------------------------------------------------------|
| Produit testé            | Site dynamique (PHP)                                             |
| Configuration logicielle | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2) |
| Configuration matérielle | Dell Optiplex 9020                                               |
| Date de début            | 26/03/2024                                                       |
| Date de finalisation     | 26/03/2024                                                       |
| Responsable du document  | Gouabi Assia                                                     |

<br><br><br>

----------

<br><br><br>

## <a name="3"></a>III - Test

## <a name="3a"></a>IV - Tests unitaires 

Durant notre projet, nous avons réaliser des tests unitaires boites noires afin de vérifier la validité des pages PHP, les fonctions implémentées et de s'assurer que les messages d'erreurs soient bien exploités. Les tests boites noires servent à vérifier que l'application produise et retourne bien les sorties attendues à partir d'entrées. <br>

Des tests boites blanches ont également été réalisé dans un but de vérifier le bon fonctionnement de chaque composant du code. 

Ses deux types de test étaient nécessaires afin de produire une application cohérente et fonctionnelle dans l'ensemble. 

### <a name="1a"></a> Tests boite noire pour les pages

Vous trouverez ci-dessous les liens permettant d'accéder aux tests unitaires boites noires pour chaque page. 

[Connexion](dossier_de_test_boite_noire/dossier_de_test_connexion.md)

[Déconnexion](dossier_de_test_boite_noire/dossier_de_test_deconnexion.md)

[Inscription](dossier_de_test_boite_noire/dossier_de_test_inscription.md)

[Désinscription](dossier_de_test_boite_noire/dossier_de_test_desinscription.md)

[Modification d'email](dossier_de_test_boite_noire/dossier_de_test_modifEmail.md)

[Modification de mot de passe](dossier_de_test_boite_noire/dossier_de_test_modifMdp.md)

[Création ticket](dossier_de_test_boite_noire/dossier_de_test_creerTicket.md)

[Modification de ticket](dossier_de_test_boite_noire/dossier_de_test_modification_ticket.md)

[Tableau de bord](dossier_de_test_boite_noire/dossier_de_test_tdb.md)

[Profil](dossier_de_test_boite_noire/dossier_test_dynamique_profil.md)

[Accueil](dossier_de_test_boite_noire/dossier_test_dynamique_index.md)

[Administration du point de vu de l'admin web](dossier_de_test_boite_noire/dossier_de_test_administration.md)

[Administration du point de vu de l'admin système](dossier_de_test_boite_noire/dossier_de_test_administrationSysteme.md)

<br>

### <a name="2ab"></a> Tests boite noire pour les fonctions

Vous trouverez ci-dessous le lien permettant d'accéder aux tests unitaires boites noires pour les fonctions implémentées.

[Les fonctions en boite noire](dossier_de_test_boite_noire/dossier_de_test_fonction.md)

<br>

### <a name="2a"></a> Tests boite blanche 

Nous avons réalisé seulement les tests boites blanches pour les fonctions implémentées puisque nous jugeons pas nécessaire de faire de même pour les pages. De plus, certaines pages peuvent regrouper 30 lignes de code, il serait donc difficile de faire un test boite blanche avec 30 lignes. 

Vous trouverez ci-dessous le lien permettant d'accéder aux tests unitaires boites blanches pour les fonctions implementées. 

[Les fonctions en boite blanche](dossier_de_test_fonctions_boiteBlanche.md)

<br>

### <a name="4a"></a> Tests PHPUnits

Des tests à l'aide de PHPUnits sur phpStorm ont été conçu dans un but d'aider à l'écriture des tests boites noires mais également de vérifier le bon fonctionnement et la qualité du code PHP. Ils ont été effectué seulement sur les fonctions implémentées 

Vous trouverez ci-dessous le lien permettant d'accéder aux tests PHPUnits pour les fonctions implementées. 

[Les fonctions à l'aide de PHPUnits](test_PHPunit/test.php)

<br>

### <a name="5a"></a> Tests base de données 

Pour s'assurer du bon fonctionnement de la base de données de l'application, nous avons réaliser des tests d'insertion, de suppression et de modification d'élements dans la base de données tels que des tickets ou utilisateurs. 

Vous trouverez ci-dessous le lien permettant d'accéder aux tests de la base de données.

[La base de donnees](dossier_de_test_base_de_donnees.md)

<br>

### <a name="6a"></a> Tests d'affichage des pages du site statique

Les premiers tests qui ont été conçu étaient ceux permettant l'affichage du site statique et dynamique. Ils permettent de s'assurer que les pages du site statique s'affiche bien en respectant des caractéristiques telles que la taille de l'écran ou encore l'accessibilité. 

Vous trouverez ci-dessous le lien permettant d'accéder aux tests d'affichage des pages du site statique.

[Site statique](dossier_test_site_statique.md)

<br>

### <a name="7a"></a> Tests d'affichage des pages du site dynamique 

Les tests d'affichage des pages PHP permettent également de s'assurer que les pages de la plateforme s'affiche bien en respectant des caractéristiques telles que la taille de l'écran, l'accessibilité ou encore qu'elles ne contiennent aucunes erreurs. 

Vous trouverez ci-dessous le lien permettant d'accéder aux tests d'affichage des pages du site dynamique.

[Site dynamique](dossier_test_site_dynamique.md)

<br>

### <a name="8a"></a> Tests des fonctions d'affichage

Pour certaines fonctions qui retournent simplement un affichage, il était pas nécessaire d'effectuer des tests boites blanches ou noires. Nous avons quand même tenu à les tester pour vérifier leur fonctionnement. 

Vous trouverez ci-dessous le lien permettant d'accéder aux tests d'affichage des fonctions.

[Tests d'affichage](dossier_de_test_fonction_affichage.md)

<br>

### <a name="9a"></a> Tests d'integration

Enfin, nous avons terminer par effectuer des tests d'intégration. Ils permettent de tester la manière dont différentes parties d'un système interagissent les unes avec les autres. Nous avons réaliser ses tests à l'aide du module de cryptographie puisque nous devions intégrer des fonctions de cryptage et décryptage à notre application. 
<br> Ainsi, il fallait évaluer si les fonctions opérées ou au contraire provoquer des bugs dans le site web. 

Vous trouverez ci-dessous le lien permettant d'accéder aux tests d'intégration du module de cryptographie.

[Tests cryptographie](dossier_de_test_cryptographie.md)
