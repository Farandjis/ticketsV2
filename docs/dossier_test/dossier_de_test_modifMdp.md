Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test
## Page modifMdp

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

Le document suivant à pour but de tester la page modifMdp
<br>

## <a name="II"></a>II - Description de la procédure de test

Nous allons tester les différents cas où la page n'est pas censé changer de mot de passe mais aussi les cas ou le mot de passe peut être changé.
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                           |
|------------------------------------|------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                             |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2) |
| Configuration matérielle           | Dell Optiplex 9020                                               |
| Date de début                      | 21/11/2023                                                       |
| Date de finalisation               | 23/11/2023                                                       |
| Test à appliquer                   | Vérification du bon fonctionnement de la page modifMdp           |
| Responsable de la campagne de test | Gouabi Assia                                                     |

<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

| Cas n° | Critère                                                                                              | Résultat attendu | Résultat obtenu | Commentaires                                                                               |
|:-------|------------------------------------------------------------------------------------------------------|------------------|-----------------|--------------------------------------------------------------------------------------------|
| 1      | $mdp = "azerty!123" <br> $nouveauMdp = "Boblebricoleur!123" <br> $confirmationMdp = "Boblebricoleur!123" | OK               | OK              | Les données sont toutes correctes et conformes                                             |
| 2      | $mdp = "Azerty!123" <br> $nouveauMdp = "Boblebricoleur!123" <br> $confirmationMdp = "Boblebricoleur!123" | KO               | KO              | Le mdp est incorrect                                                                       |
| 3      | $mdp = "azerty!123" <br> $nouveauMdp = "Boblebricoleur!123" <br> $confirmationMdp = "Boblebricoleur!12" | KO               | KO              | Le nouveauMdp et sa confirmation sont différents                                           |
| 4      | $mdp = "azerty!123" <br> $nouveauMdp = "Bobleb!1" <br> $confirmationMdp = "Bobleb!1!"                   | KO               | KO              | La taille du nouveauMdp n'est pas conforme (trop court)                                                 |
| 5      | $mdp = "azerty!123" <br> $nouveauMdp = "Boblebricoleurdecastorama!1234567" <br> $confirmationMdp = "Boblebricoleurdecastorama!1234567"                   | KO               | KO              | La taille du nouveauMdp n'est pas conforme (trop long)                                                 |
| 6      | $mdp = "azerty!123" <br> $nouveauMdp = "BOBLEBRICOLEUR!123" <br> $confirmationMdp = "BOBLEBRICOLEUR!123" | KO               | KO              | Absence de lettres minuscules                                                              |
| 7      | $mdp = "azerty!123" <br> $nouveauMdp = "boblebricoleur!123" <br> $confirmationMdp = "boblebricoleur!123" | KO               | KO              | Absence de lettres majuscules                                                             |
| 8      | $mdp = "azerty!123" <br> $nouveauMdp = "Boblebricoleur!" <br> $confirmationMdp = "Boblebricoleur!" | KO               | KO              | Absence de chiffres dans le nouveauMdp                                                     |
| 9      | $mdp = "azerty!123" <br> $nouveauMdp = "Boblebricoleur123" <br> $confirmationMdp = "Boblebricoleur123" | KO               | KO              | Absence de caractère spécial dans le nouveauMdp                                            |
| 10      | $mdp = "azerty!" <br> $nouveauMdp = "boblebricoleur!123" <br> $confirmationMdp = "Boblebricoleur.123" | KO               | KO              | Les données sont toutes incorrectes et non conformes                                       |
| 11      | $mdp = "azerty!123" <br> $nouveauMdp = "Boblebricoleur!123" <br> $confirmationMdp = "Boblébricoleur!123" | KO               | KO              | Le nouveauMdp et sa confirmation sont quasiment identiques sauf que l'un possède un accent |
