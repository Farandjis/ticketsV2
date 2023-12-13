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
| 1      | $mdp = "Azerty!123" <br> $nouveauMdp = "Bonjouralice!123" <br> $confirmationMdp = "Bonjouralice!123" | OK               | OK              | Les données sont toutes correctes et conformes                                             |
| 2      | $mdp = "azerty!123" <br> $nouveauMdp = "Bonjouralice!123" <br> $confirmationMdp = "Bonjouralice!123" | KO               | KO              | Le mdp est incorrect                                                                       |
| 3      | $mdp = "Azerty!123" <br> $nouveauMdp = "Bonjouralice!123" <br> $confirmationMdp = "Bonjouralice!124" | KO               | KO              | Le nouveauMdp et sa confirmation sont différents                                           |
| 4      | $mdp = "Azerty!123" <br> $nouveauMdp = "Alice1!" <br> $confirmationMdp = "Alice1!"                   | KO               | KO              | La taille du nouveauMdp n'est pas conforme                                                 |
| 5      | $mdp = "Azerty!123" <br> $nouveauMdp = "BONJOURALICE!123" <br> $confirmationMdp = "BONJOURALICE!123" | KO               | KO              | Absence de lettres minuscules                                                              |
| 6      | $mdp = "Azerty!123" <br> $nouveauMdp = "Bonjouralice!!!!" <br> $confirmationMdp = "Bonjouralice!!!!" | KO               | KO              | Absence de chiffres dans le nouveauMdp                                                     |
| 7      | $mdp = "Azerty!123" <br> $nouveauMdp = "Bonjouralice1123" <br> $confirmationMdp = "Bonjouralice1123" | KO               | KO              | Absence de caractère spécial dans le nouveauMdp                                            |
| 8      | $mdp = "Azerty1123" <br> $nouveauMdp = "bonjouralice!123" <br> $confirmationMdp = "Bonjouralice.123" | KO               | KO              | Les données sont toutes incorrectes et non conformes                                       |
| 9      | $mdp = "Azerty!123" <br> $nouveauMdp = "Bonjouralice!123" <br> $confirmationMdp = "Bonjouralicé!123" | KO               | KO              | Le nouveauMdp et sa confirmation sont quasiment identiques sauf que l'un possède un accent |
