Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test
## Site dynamique

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

Le document suivant à pour but de tester la page action déconnexion.
<br>

## <a name="II"></a>II - Description de la procédure de test

Nous allons tester tout les cas possibles qui permettent à la page de donner une erreur au moment de la connexion mais aussi les cas où la connexion  marchera.
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                                   |
|------------------------------------|--------------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                                     |
| Conf. logicielle                   | Navigateur : Firefox 119.0.1 (64 bits)<br>OS : Ubuntu 22.04.3 LTS 64bits |
| Conf. Matérielle                   | Acer Nitro 50-600                                                        |
| Date de début                      | 25/11/2023                                                               |
| Date de finalisation               | 25/11/2023                                                               |
| Test à appliquer                   | Vérification du bon fonctionnement de la page déconnexion                |
| Responsable de la campagne de test | FARANDJIS Matthieu                                                       |


<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

Le cookie est bien rendu inutilisable, le site n'est plus accessible.<br>
Cependant, Firefox le détecte encore, il doit simplement être rendu inutilisable plutôt que supprimé.
