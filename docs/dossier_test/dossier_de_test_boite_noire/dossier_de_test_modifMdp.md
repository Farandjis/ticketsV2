Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test Boite noire
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
| Date de finalisation               | 24/03/2024                                                       |
| Test à appliquer                   | Vérification du bon fonctionnement de la page modifMdp           |
| Responsable de la campagne de test | Gouabi Assia                                                     |

<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

### Partitions d'équivalence 

Les données permettant de modifier son mot de passe sont le mdp qui permet de se connecter à la plateforme, le nouveau mot de passe et sa confirmation. 
<br> Le mdp peut être correct ou incorrect, le nouveau mot de passe peut être quant à lui conforme ou non conforme s'il ne respecte pas certaines caractéristiques. Enfin, la confirmation du mot de passe peut être aussi conforme ou non conforme, mais également incorrect si elle n'est pas identique au nouveau mdp. 
<br> Le résultat que nous obtiendrons est OK si le mot de passe a bien été mis à jour ou KO s'il ne l'a pas été.

### Conception des tests 

| Cas | $mdp      | $nouveauMdp  | $confirmationMdp | Résultat attendu | Résultat obtenu | Commentaires                                                                                |
|-----|-----------|--------------|------------------|------------------|-----------------|---------------------------------------------------------------------------------------------|
| P1  | Correct   | Conforme     | Conforme         | OK               | OK              | Les données sont toutes correctes et conformes                                              |
| P2  | Incorrect | Conforme     | Conforme         | KO               | KO              | Le mdp est incorrect                                                                        |
| P3  | Correct   | Conforme     | Incorrect        | KO               | KO              | Le nouveauMdp et sa confirmation sont différents                                            |
| P4  | Correct   | Non conforme | Non conforme     | KO               | KO              | La taille du nouveauMdp n'est pas conforme (trop court)                                     |
| P5  | Correct   | Non conforme | Non conforme     | KO               | KO              | La taille du nouveauMdp n'est pas conforme (trop long)                                      |
| P6  | Correct   | Non conforme | Non conforme     | KO               | KO              | Absence de lettres minuscules                                                               |
| P7  | Correct   | Non conforme | Non conforme     | KO               | KO              | Absence de lettres majuscules                                                               |
| P8  | Correct   | Non conforme | Non conforme     | KO               | KO              | Absence de chiffres dans le nouveauMdp                                                      |
| P9  | Correct   | Non conforme | Non conforme     | KO               | KO              | Absence de caractère spécial dans le nouveauMdp                                             |
| P10 | Incorrect | Non conforme | Incorrect        | KO               | KO              | Les données sont toutes incorrectes et non conformes                                        |
| P11 | Correct   | Conforme     | Incorrect        | KO               | KO              | Le nouveauMdp et sa confirmation sont quasiment identiques sauf que l'un possède un accent  |

### Exécution des tests 


| Cas | $mdp        | $nouveauMdp                       | $confirmationMdp                  | Résultat attendu | Résultat obtenu |
|-----|-------------|-----------------------------------|-----------------------------------|------------------|-----------------|
| P1  | azerty!123  | Boblebricoleur!123                | Boblebricoleur!123                | OK               | OK              |
| P2  | Azerty!123  | Boblebricoleur!123                | Boblebricoleur!123                | KO               | KO              |
| P3  | azerty!123  | Boblebricoleur!123                | Boblebricoleur!12                 | KO               | KO              |
| P4  | azerty!123  | Bobleb!1                          | Bobleb!1!                         | KO               | KO              |
| P5  | azerty!123  | Boblebricoleurdecastorama!1234567 | Boblebricoleurdecastorama!1234567 | KO               | KO              |
| P6  | azerty!123  | BOBLEBRICOLEUR!123                | BOBLEBRICOLEUR!123                | KO               | KO              |
| P7  | azerty!123  | boblebricoleur!123                | boblebricoleur!123                | KO               | KO              |
| P8  | azerty!123  | Boblebricoleur!                   | Boblebricoleur!                   | KO               | KO              |
| P9  | azerty!123  | Boblebricoleur123                 | Boblebricoleur123                 | KO               | KO              |
| P10 | azerty!     | boblebricoleur!123                | Boblebricoleur.123                | KO               | KO              |
| P11 | azerty!123  | Boblebricoleur!123                | Boblébricoleur!123                | KO               | KO              |
