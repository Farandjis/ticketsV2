Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test Boite noire 
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

Nous allons tester tous les cas possibles qui permettent à la page de donner une erreur au moment de la désincription mais aussi les cas où la désinscription fonctionne.
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                           |
|------------------------------------|------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                             |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2) |
| Configuration matérielle           | Dell Optiplex 9020                                               |
| Date de début                      | 08/01/2024                                                       |
| Date de finalisation               | 23/03/2024                                                       |
| Test à appliquer                   | Vérification de la conformité de la page désincription           |
| Responsable de la campagne de test | Gouabi Assia                                                     |


<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

### Partitions d'équivalence 

Les données telles que le login, le mdp, le captcha permettent de réaliser la désinscription d'un utilisateur. Elles peuvent être vides, incorrectes ou correctes. <br>
Les résultats possibles peuvent être les id 2, 3, 4 ou 5. 

### Conception des tests 


| Cas n° | $login    | $mdp      | $captcha  | Case                               | Résultat attendu                               | Résultat obtenu                                      | Commentaires                       |
|:-------|-----------|-----------|-----------|------------------------------------|------------------------------------------------|------------------------------------------------------|------------------------------------|
| 2      | Correct   | Correct   | Correct   | la case confirmation a été validé  | OK                                             | OK                                                   | La déconnexion a bien été effectué |
| 3      | Vide      | Correct   | Correct   | la case confirmation a été validé  | KO (redirection id=2)                          | KO (redirection id=2)                                | $login vide                        |
| 4      | Correct   | Vide      | Correct   | la case confirmation a été validé  | Ko (redirection id=2)                          | Ko (redirection id=2)                                | $mdp est vide                      |
| 5      | Correct   | Correct   | Vide      | la case confirmation a été validé  | KO (redirection id=4)                          | KO (redirection id=4)                                | $captcha est vide                  |
| 6      | Correct   | Correct   | Incorrect | la case confirmation a été validé  | KO (redirection id = 5)                        | KO (redirection id = 5)                              | $captcha est incorrect             |
| 7      | Correct   | Correct   | Incorrect | la case confirmation a été validé  | KO (redirection id = 5)                        | KO (redirection id = 5)                              | $captcha est incorrect             |
| 8      | Incorrect | Correct   | Correct   | la case confirmation a été validé  | KO (redirection id = 3)                        | KO (redirection id = 3)                              | $login incorrect                   |
| 9      | Correct   | Incorrect | Correct   | la case confirmation a été validé  | KO (redirection id = 3)                        | KO (redirection id = 3)                              | $mdp incorrect                     |


### Exécution des tests 


| Cas n° | $login | $mdp         | $captcha    | Case                               | Résultat attendu                               | Résultat obtenu                                      |
|:-------|--------|--------------|-------------|------------------------------------|------------------------------------------------|------------------------------------------------------|
| 2      | alice  | Azertyyy!123 | (3+8) = 11  | la case confirmation a été validé  | OK                                             | OK                                                   |
| 3      | " "    | Azertyyy!123 | (3+8) = 11  | la case confirmation a été validé  | KO (redirection id=2)                          | KO (redirection id=2)                                |
| 4      | alice  | " "          | (3+8) = 11  | la case confirmation a été validé  | Ko (redirection id=2)                          | Ko (redirection id=2)                                |
| 5      | alice  | Azertyyy!123 | (3+8) = " " | la case confirmation a été validé  | KO (redirection id=4)                          | KO (redirection id=4)                                |
| 6      | alice  | Azertyyy!123 | (3+8) = 45  | la case confirmation a été validé  | KO (redirection id = 5)                        | KO (redirection id = 5)                              |
| 7      | alice  | Azertyyy!123 | (3+8) = !!  | la case confirmation a été validé  | KO (redirection id = 5)                        | KO (redirection id = 5)                              |
| 8      | alic   | Azertyyy!123 | (3+8) = 11  | la case confirmation a été validé  | KO (redirection id = 3)                        | KO (redirection id = 3)                              |
| 9      | alice  | Azertyyy!    | (3+8) = 11  | la case confirmation a été validé  | KO (redirection id = 3)                        | KO (redirection id = 3)                              |
