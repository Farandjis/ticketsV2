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

Le document suivant a pour but de tester la page désincription.
<br>

## <a name="II"></a>II - Description de la procédure de test

Nous allons tester tous les cas possibles qui permettent à la page de donner une erreur au moment de la désincription mais aussi les cas où la désinscription marchera.
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                                  |
|------------------------------------|-------------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                                    |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2)        |
| Configuration matérielle           | Dell Optiplex 9020                                                      |
| Date de début                      | 08/01/2024                                                              |
| Date de finalisation               | 08/01/2024                                                              |
| Test à appliquer                   | Vérification de la conformité de la page désincription validité du site |
| Responsable de la campagne de test | GUIGNOLLE Enzo                                                          |


<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

| Cas n° | Critère                                                   | Résultat attendu                                     | Résultat obtenu                                      | Commentaires |
|:-------|-----------------------------------------------------------|------------------------------------------------------|------------------------------------------------------|--------------|
| 1      | Si nous allons directement sur la page d'action           | KO (redirection id=1) | KO (redirection id=1)  | Les données ne sont pas définies              |
| 2      | $login = "alice" <br> $mdp = "Azertyyy!123" <br> $captcha (3+8) = 11 <br> la case confirmation a été validé                             | OK | OK | La déconnexion a bien été effectué             |
| 3      |  $login = " " <br> $mdp = "Azertyyy!123" <br> $captcha (3+8) = 11 <br> la case confirmation a été validé | KO (redirection id=2) | KO (redirection id=2) | $login vide             |
| 4      | $login = "alice" <br> $mdp = " " <br> $captcha (3+8) = 11 <br> la case confirmation a été validé        | Ko (redirection id=2) | Ko (redirection id=2) | $mdp est vide              |
| 5      |  $login = "alice" <br> $mdp = "Azertyyy!123" <br> $captcha (3+8) = " " <br> la case confirmation a été validé             | KO (redirection id=3) | KO (redirection id=3)  | $captcha est vide              |
| 6      | $login = "alice" <br> $mdp = "Azertyyy!123" <br> $captcha (3+8) = 45 <br> la case confirmation a été validé      | KO (redirection id = 3) | KO (redirection id = 3) | $captcha est incorrect              |
