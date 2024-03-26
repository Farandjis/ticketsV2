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
- ### [I - Introduction](#I)
- ### [II - Contexte des tests](#II)
- ### [IV - Test ](#III)
    - #### [Tests unitaires](#IV)
        - #### [Tests boite noire pour les pages](#1a)
        - #### [Tests boite noire pour les fonctions](#2ab)
        - #### [Tests Boite blanche](#2a)
    - #### [Tests PHPunits](#V)
    - #### [Tests Base de donnees](#VI)
    - #### [Tests d'affichage des pages du site statique](#VII)
    - #### [Tests d'affichage des pages du site dynamique](#VIII)
    - #### [Tests des fonctions d'affichage](#IX)
    - #### [Tests d'integration](#X)

<br><br><br>

----------

<br><br><br>

## <a name="I"></a>I - Introduction

Ce document a pour but principal de faciliter la navigation et la lecture des tests effectués sur les fonctions et les pages de notre application.
<br>

## <a name="II"></a>II - Contexte des tests

| Définition               | Situation pour le test                                           |
|--------------------------|------------------------------------------------------------------|
| Produit testé            | Site dynamique (PHP)                                             |
| Configuration logicielle | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2) |
| Configuration matérielle | Dell Optiplex 9020                                               |
| Date de début            | 26/03/2024                                                       |
| Date de finalisation     |                                                                  |
| Responsable du document  | Gouabi Assia                                                     |

<br><br><br>

----------

<br><br><br>

## <a name="III"></a>III - Test

## <a name="IV"></a>IV - Tests unitaires 

Durant notre projet, nous avons réaliser des tests unitaires boites noires afin de vérifier la validité des pages PHP, les fonctions implémentées et de s'assurer que les messages d'erreurs soient bien retournés. Les tests boites noires servent à vérifier que l'application produise et retourne bien les sorties attendues à partir d'entrées. <br>

Des tests boites blanches ont également été réalisé dans un but de vérifier le bon fonctionnement de chaque composant du code. 

Ses deux types de test étaient nécessaires afin de produire une application cohérente et fonctionnelle dans l'ensemble. 

### <a name="1a"></a> Tests boite noire pour les pages

Vous trouverez ci-dessous les liens permettant d'accéder aux tests unitaires boites noires pour chaque page. 

[Tests boite noire page Connexion](dossier_de_test_boite_noire/dossier_de_test_connexion.md)

[Tests boite noire page Déconnexion](dossier_de_test_boite_noire/dossier_de_test_deconnexion.md)

[Tests boite noire page Inscription](dossier_de_test_boite_noire/dossier_de_test_inscription.md)

[Tests boite noire page Désinscription](dossier_de_test_boite_noire/dossier_de_test_desinscription.md)

[Tests boite noire page modification d'email](dossier_de_test_boite_noire/dossier_de_test_modifEmail.md)

[Tests boite noire page modification de mot de passe](dossier_de_test_boite_noire/dossier_de_test_modifMdp.md)

[Tests boite noire page création ticket](dossier_de_test_boite_noire/dossier_de_test_creerTicket.md)

[Tests boite noire page modification de ticket](dossier_de_test_boite_noire/dossier_de_test_modification_ticket.md)

[Tests boite noire page tableau de bord](dossier_de_test_boite_noire/dossier_de_test_tdb.md)

[Tests boite noire page profil](dossier_de_test_boite_noire/dossier_test_dynamique_profil.md)

[Tests boite noire page d'accueil](dossier_de_test_boite_noire/dossier_test_dynamique_index.md)

[Tests boite noire page administration du point de vu de l'admin web](dossier_de_test_boite_noire/dossier_de_test_administration.md)

[Tests boite noire page administration du point de vu de l'admin système](dossier_de_test_boite_noire/dossier_de_test_administrationSysteme.md)

<br><br><br>

### <a name="2ab"></a> Tests boite noire pour les fonctions

Vous trouverez ci-dessous les liens permettant d'accéder aux tests unitaires boites noires pour chaque fonction implémentée.

[Tests boite noire fonction connectUser](dossier_de_test_boite_noire/dossier_de_test_fonction.md#a-name1aaconnectuser)
