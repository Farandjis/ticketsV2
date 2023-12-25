Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test
## Site dynamique

<br><br>
Ce document permet de s'assurer que la page profil de l'application web soit fonctionnelle. 

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

Le document suivant à pour but de tester la page profil.php.
<br>

## <a name="II"></a>II - Description de la procédure de test

Nous allons définir tous les retours possibles que peut renvoyer cette page en fonction du rôle de la personne. 
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                            |
|------------------------------------|-------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                              |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2)  |
| Configuration matérielle           | Dell Optiplex 9020                                                |
| Date de début                      | 21/11/2023                                                        |
| Date de finalisation               | 24/11/2023                                                        |
| Test à appliquer                   | Vérification du bon fonctionnement de la page profil (profil.php) |
| Responsable de la campagne de test | Gouabi Assia                                                      |

<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

| Cas n° | Critère                                                                              | Résultat attendu                                                                                                                                                                                                                                                                                              | Résultat obtenu                                                                                                                                                                                                                                                                                               |
|--------|--------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| 1      | Si personne n'est connecté (visiteur)                                                | KO (nécessite d'avoir un compte sur la plateforme pour avoir un profil)                                                                                                                                                                                                                                       | KO (nécessite d'avoir un compte sur la plateforme pour avoir un profil)                                                                                                                                                                                                                                       |
| 2      | Si un utilisateur est connecté                                                       | L'affichage de ses données personnelles dans un tableau, la possibilité de modifier son mot de passe et Email, d'accéder à son tableau de bord, à la page d'accueil et de se déconnecter de la plateforme. De plus il peut visionner le tableau de ses demandes formulées (tickets)                           | L'affichage de ses données personnelles dans un tableau, la possibilité de modifier son mot de passe et Email, d'accéder à son tableau de bord, à la page d'accueil et de se déconnecter de la plateforme. De plus il peut visionner le tableau de ses demandes formulées (tickets)                           |
| 3      | Si un technicien est connecté                                                        | L'affichage de ses données personnelles dans un tableau, la possibilité de modifier son mot de passe et Email, d'accéder à son tableau de bord, à la page d'accueil et de se déconnecter de la plateforme. De plus il peut visionner le tableau de ses demandes formulées (tickets)                           | L'affichage de ses données personnelles dans un tableau, la possibilité de modifier son mot de passe et Email, d'accéder à son tableau de bord, à la page d'accueil et de se déconnecter de la plateforme. De plus il peut visionner le tableau de ses demandes formulées (tickets)                           |
| 4      | Si un administrateur web est connecté                                                | L'affichage de ses données personnelles dans un tableau, la possibilité de modifier son mot de passe et Email, d'accéder à son tableau de bord, à la page d'accueil, à la page administration et de se déconnecter de la plateforme. De plus il peut visionner le tableau de ses demandes formulées (tickets) | L'affichage de ses données personnelles dans un tableau, la possibilité de modifier son mot de passe et Email, d'accéder à son tableau de bord, à la page d'accueil, à la page administration et de se déconnecter de la plateforme. De plus il peut visionner le tableau de ses demandes formulées (tickets) |
| 5      | Si un administrateur système est connecté                                            | L'affichage de ses données personnelles dans un tableau, la possibilité de modifier son mot de passe et Email, d'accéder à son tableau de bord, à la page d'accueil, à la page administration et de se déconnecter de la plateforme. De plus il peut visionner le tableau de ses demandes formulées (tickets) | L'affichage de ses données personnelles dans un tableau, la possibilité de modifier son mot de passe et Email, d'accéder à son tableau de bord, à la page d'accueil, à la page administration et de se déconnecter de la plateforme. De plus il peut visionner le tableau de ses demandes formulées (tickets) |
| 6      | Bouton 1 : Modifier (pour modifier l'Email)                                          | Retourne la page de modification d'Email                                                                                                                                                                                                                                                                      | Retourne la page de modification d'Email                                                                                                                                                                                                                                                                      |
| 7      | Bouton 2 : Modifier (pour modifier le mot de passe)                                  | Retourne la page de modification de mot de passe                                                                                                                                                                                                                                                              | Retourne la page de modification de mot de passe                                                                                                                                                                                                                                                              |
| 8      | Bouton 3 : Déconnexion                                                               | Retourne la page index                                                                                                                                                                                                                                                                                        | Retourne la page index                                                                                                                                                                                                                                                                                        |
| 9      | Bouton 4 : flèche de connexion (si le visiteur essaye d'accéder à la page de profil) | Retourne la page de connexion                                                                                                                                                                                                                                                                                 | Retourne la page de connexion                                                                                                                                                                                                                                                                                 |
