Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test boite noire 
## Site dynamique 


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

Le document suivant à pour but de tester la page modifEmail.
<br>

## <a name="II"></a>II - Description de la procédure de test

La principale fonctionnalité que nous allons tester est le fait de vérifier que ce qui est rentrée dans le formulaire est conforme pour être inséré dans la base de données.
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                           |
|------------------------------------|------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                             |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2) |
| Configuration matérielle           | Dell Optiplex 9020                                               |
| Date de début                      | 23/11/2023                                                       |
| Date de finalisation               | 24/03/2024                                                       |
| Test à appliquer                   | Vérification de la fonctionnalité pour modifier l'email          |
| Responsable de la campagne de test | Gouabi Assia                                                     |

<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

### Partitions d'équivalence

Les données permettant à l'utilisateur de modifier son email sont son mot de passe qui lui permet de se connecter à la plateforme et le nouvel email.
<br> Le mot de passe peut être correct, incorrect ou vide tandis que le nouvel email est conforme, s'il respecte certaines caractéristiques, vide ou non conforme s'il ne les respecte pas.
<br> Le résultat que nous obtiendrons est OK si l'email a bien été mis à jour ou KO s'il ne l'a pas été. 

### Conception des tests 

| Cas | $mdp      | $nouvelEmail | Résultat attendu | Résultat obtenu | Commentaires                                                                          |
|-----|-----------|--------------|------------------|-----------------|---------------------------------------------------------------------------------------|
| P1  | Correct   | Conforme     | OK               | OK              | $mdp et $nouvelleEmail sont corrects                                                  |
| P2  | Incorrect | Conforme     | KO               | KO              | $mdp est incorrect mais $nouvelleEmail est conforme                                   |
| P3  | Correct   | Conforme     | OK               | OK              | $mdp et $nouvelleEmail sont corrects (même si le nouveau email correspond à l'ancien) |
| P4  | Vide      | Conforme     | KO               | KO              | $mdp est vide mais $nouvelleEmail est conforme                                        |
| P5  | Correct   | Vide         | KO               | KO              | $mdp est correct mais $nouvelleEmail est vide                                         |
| P6  | Vide      | Vide         | KO               | KO              | $mdp et $nouvelleEmail sont vides                                                     |
| P7  | Correct   | Non conforme | KO               | KO              | $mdp est correct mais le format de l'Email est incorrect                              |
| P8  | Correct   | Non conforme | KO               | KO              | Les données sont valides mais le format de l'Email est incorrect (accent)             |
| P9  | Correct   | Non conforme | KO               | KO              | $mdp est correct mais le format de $nouvelleEmail est non conforme                    |
| P10 | Correct   | Non conforme | KO               | KO              | $mdp est correct mais le format de $nouvelleEmail est non conforme                    |
| P11 | Correct   | Correct      | OK               | OK              | $mdp et $nouvelleEmail sont corrects                                                  |

### Exécution des tests 

| Cas | $mdp        | $nouvelEmail              | Résultat attendu | Résultat obtenu |
|-----|-------------|---------------------------|------------------|-----------------|
| P1  | azerty!123  | bob@email.com             | OK               | OK              |
| P2  | Azerty!123  | bob@email.com             | KO               | KO              |
| P3  | azerty!123  | lebricoleur@castorama.com | OK               | OK              |
| P4  | " "         | bob@email.com             | KO               | KO              |
| P5  | azerty!123  | " "                       | KO               | KO              |
| P6  | " "         | " "                       | KO               | KO              |
| P7  | azerty!123  | bob#email.com             | KO               | KO              |
| P8  | azerty!123  | bobé@email.com            | KO               | KO              |
| P9  | azerty!123  | bob@email.f               | KO               | KO              |
| P10 | azerty!123  | bob@email.frrrr           | KO               | KO              |
| P11 | azerty!123  | bob@email.frrr            | OK               | OK              |

