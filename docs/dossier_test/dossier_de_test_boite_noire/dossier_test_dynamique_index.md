Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test
## Site dynamique

<br><br>
Ce document permet de s'assurer que la page d'accueil de l'application web soit fonctionnelle. 

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

Le document suivant à pour but de tester la page index.php.
<br>

## <a name="II"></a>II - Description de la procédure de test

Nous allons définir tous les retours possibles que peut renvoyer cette page en fonction du rôle de la personne. 
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                              |
|------------------------------------|---------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                                |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2)    |
| Configuration matérielle           | Dell Optiplex 9020                                                  |
| Date de début                      | 21/11/2023                                                          |
| Date de finalisation               | 24/11/2023                                                          |
| Test à appliquer                   | Vérification du bon fonctionnement de la page d'accueil (index.php) |
| Responsable de la campagne de test | Gouabi Assia                                                        |

<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

| Cas n° | Critère                                              | Résultat attendu                                                                                                                                                                                                      | Résultat obtenu                                                                                                                                                                                                       |
|--------|------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| 1      | Si personne n'est connecté (visiteur)                | - Les 10 derniers tickets <br> - la possibilité de se connecter ou s'inscrire à la plateforme <br> - Regarder la vidéo de présentation                                                                             | - Les 10 derniers tickets <br> - la possibilité de se connecter ou s'inscrire à la plateforme <br> - Regarder la vidéo de présentation                                                                            |
| 2      | Si un utilisateur est connecté                       | - Les 10 derniers tickets <br> - la possibilité d'accéder à son tableau de bord, à son profil et de se déconnecter de la plateforme <br> - Visionner la vidéo de présentation <br> - Regarder où en sont (l'état) ses demandes                          | - Les 10 derniers tickets <br> - la possibilité d'accéder à son tableau de bord, à son profil et de se déconnecter de la plateforme <br> - Visionner la vidéo de présentation <br> - Regarder où en sont (l'état) ses demandes                           |
| 3      | Si un technicien est connecté                        | - Les 10 derniers tickets <br> - la possibilité d'accéder à son tableau de bord, à son profil et de se déconnecter de la plateforme <br> - Visionner la vidéo de présentation <br> - Visualiser le nombre de tickets en attente de prise en charge ou à traiter                          | - Les 10 derniers tickets <br> - la possibilité d'accéder à son tableau de bord, à son profil et de se déconnecter de la plateforme <br> - Visionner la vidéo de présentation <br> - Le nombre de tickets en attente de prise en charge ou à traiter                           |
| 4      | Si un administrateur web est connecté                | - Les 10 derniers tickets <br> - la possibilité d'accéder à son tableau de bord, à son profil, à la page administration et de se déconnecter de la plateforme <br> - Visionner la vidéo de présentation <br> - Visualiser le nombre de ticket en attente de validation ou à attribuer |  - Les 10 derniers tickets <br> - la possibilité d'accéder à son tableau de bord, à son profil, à la page administration et de se déconnecter de la plateforme <br> - Visionner la vidéo de présentation <br> - Visualiser le nombre de ticket en attente de validation ou à attribuer |
| 5      | Si un administrateur système est connecté            | - Les 10 derniers tickets <br> - la possibilité d'accéder à son tableau de bord, à son profil, à la page administration et de se déconnecter de la plateforme <br> - Visionner la vidéo de présentation | - Les 10 derniers tickets <br> - la possibilité d'accéder à son tableau de bord, à son profil, à la page administration et de se déconnecter de la plateforme <br> - Visionner la vidéo de présentation |
| 6      | Bouton 1 : Mon espace (dans la barre de navigation)  | Retourne la page profil                                                                                                                                                                                               | Retourne la page profil                                                                                                                                                                                               |
| 7      | Bouton 2 : Mon espace (dans le bas de la page)       | Retourne la page profil                                                                                                                                                                                               | Retourne la page profil                                                                                                                                                                                               |
| 8      | Bouton 3 : Déconnexion                               | Retourne la page index                                                                                                                                                                                                | Retourne la page index                                                                                                                                                                                                |
| 9      | Bouton 4 : Connexion                                 | Retourne la page de connexion                                                                                                                                                                                         | Retourne la page de connexion                                                                                                                                                                                         |
| 10     | Bouton 5 : Inscription (dans la barre de navigation) | Retourne la page d'inscription                                                                                                                                                                                        | Retourne la page d'inscription                                                                                                                                                                                        |
| 11     | Bouton 6 : Je m'inscris                              | Retourne la page d'inscription                                                                                                                                                                                        | Retourne la page d'inscription                                                                                                                                                                                        |
