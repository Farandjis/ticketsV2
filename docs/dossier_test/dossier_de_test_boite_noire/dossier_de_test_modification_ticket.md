Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test
## modificationTicket

<br><br>
Ce document permet de s'assurer que la page modificationTicket soit conforme à ce qui a été conçu.

</div>

<br><br><br><br><br><br><br>

## Plan
- ### [I - Introduction](#I)
- ### [II - Description de la procédure de test](#II)
- ### [III - Contexte des tests](#III)
- ### [IV - Test](#IV)
  - #### [Administrateur Web](#a)
  - #### [Administrateur Système](#b)
  - #### [Utilisateur](#c)
  - #### [Technicien](#d)

<br><br><br>

----------

<br><br><br>

## <a name="I"></a>I - Introduction

Le document suivant à pour but de tester la page modificationTicket et de vérifier que le code PHP est bon et conforme à ce qui a été conçu.
<br>

## <a name="II"></a>II - Description de la procédure de test

La page tester est la page tableau de bord, nous testerons que chaque utilisateur puissent réaliser ce qui leur est possible au niveau de la modification de ticket.
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                           |
|------------------------------------|------------------------------------------------------------------|
| Produit testé                      | Page modficationTicket et son action php                         |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2) |
| Configuration matérielle           | Dell Optiplex 9020                                               |
| Date de début                      | 21/12/2023                                                       |
| Date de finalisation               | 00/12/2023                                                       |
| Test à appliquer                   | Vérification des différentes conditions pour modifier un ticket  |
| Responsable de la campagne de test | GUIGNOLLE Enzo                                                   |

<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

<br>

### <a name="a"></a>Administrateur Web

<br>

#### Ticket en attente

| Cas n° | Critère                                                                                                                | Résultat attendu              | Résultat obtenu               |
|:-------|------------------------------------------------------------------------------------------------------------------------|-------------------------------|-------------------------------|
| 1      | Ajout d'un niveau d'urgence et un technicien à un ticket sans rien modifier d'autre                                    | Ticket en cours de traitement | Ticket en cours de traitement |
| 2      | Ajout d'un niveau d'urgence + un technicien à un ticket + modification de la description                               | Ticket en cours de traitement | Ticket en cours de traitement |
| 2      | Ajout d'un niveau d'urgence + un technicien à un ticket + modification des libellé                                     | Ticket en cours de traitement | Ticket en cours de traitement |
| 3      | Ajout d'un niveau d'urgence + un technicien à un ticket + modification de la description et des libellés               | Ticket en cours de traitement | Ticket en cours de traitement |
| 4      | Ajout d'un niveau d'urgence + un technicien à un ticket + modification de la nature                                    | Ticket en cours de traitement | Ticket en cours de traitement |
| 5      | Ajout d'un niveau d'urgence + un technicien à un ticket + modification de la nature et des libellés                    | Ticket en cours de traitement | Ticket en cours de traitement |
| 6      | Ajout d'un niveau d'urgence + un technicien à un ticket + modification de la description et de la nature               | Ticket en cours de traitement | Ticket en cours de traitement |
| 7      | Ajout d'un niveau d'urgence + un technicien à un ticket + modification de la description, de la nature et des libellés | Ticket en cours de traitement | Ticket en cours de traitement |
| 8      | Ajout d'un niveau d'urgence à un ticket sans rien modifier d'autre                                                     | Ticket ouvert                 | Ticket ouvert                 |
| 9      | Ajout d'un niveau d'urgence + modification de la description                                                           | Ticket ouvert                 | Ticket ouvert                 |
| 9      | Ajout d'un niveau d'urgence + modification des libellés                                                                | Ticket ouvert                 | Ticket ouvert                 |
| 10     | Ajout d'un niveau d'urgence + modification de la description et des libellés                                           | Ticket ouvert                 | Ticket ouvert                 |
| 11     | Ajout d'un niveau d'urgence + modification de la nature                                                                | Ticket ouvert                 | Ticket ouvert                 |
| 12     | Ajout d'un niveau d'urgence + modification de la nature et des libellés                                                | Ticket ouvert                 | Ticket ouvert                 |
| 13     | Ajout d'un niveau d'urgence + modification de la description et de la nature                                           | Ticket ouvert                 | Ticket ouvert                 |
| 14     | Ajout d'un niveau d'urgence + modification de la description, de la nature et des libellés                             | Ticket ouvert                 | Ticket ouvert                 |
| 15     | Modification de la description                                                                                         | Ticket en attente             | Ticket en attente             |
| 16     | Modification de la nature                                                                                              | Ticket en attente             | Ticket en attente             |
| 17     | Modification des libellés                                                                                              | Ticket en attente             | Ticket en attente             |
| 18     | Modification de la description et de la nature                                                                         | Ticket en attente             | Ticket en attente             |
| 19     | Modification de la description et des libellés                                                                         | Ticket en attente             | Ticket en attente             |
| 20     | Modification de la nature et des libellés                                                                              | Ticket en attente             | Ticket en attente             |
| 21     | Modification de la description, de la nature et des libellés                                                           | Ticket en attente             | Ticket en attente             |
| 22     | Ajout d'un technicien sans niveau d'urgence                                                                            | KO                            | KO                            |

<br>

#### Ticket ouvert

| Cas n° | Critère                                                                                                                 | Résultat attendu              | Résultat obtenu               |
|:-------|-------------------------------------------------------------------------------------------------------------------------|-------------------------------|-------------------------------|
| 1      | Ajout d'un technicien à un ticket sans rien modifier d'autre                                                            | Ticket en cours de traitement | Ticket en cours de traitement |
| 2      | Ajout d'un technicien à un ticket + modification de la description                                                      | Ticket en cours de traitement | Ticket en cours de traitement |
| 3      | Ajout d'un technicien à un ticket + modification des libellés                                                           | Ticket en cours de traitement | Ticket en cours de traitement |
| 4      | Ajout d'un technicien à un ticket + modification de la description et des libellés                                      | Ticket en cours de traitement | Ticket en cours de traitement |
| 5      | Ajout d'un technicien à un ticket + modification de la nature                                                           | Ticket en cours de traitement | Ticket en cours de traitement |
| 6      | Ajout d'un technicien à un ticket + modification de la nature et des libellés                                           | Ticket en cours de traitement | Ticket en cours de traitement |
| 7      | Ajout d'un technicien à un ticket + modification de la description et de la nature                                      | Ticket en cours de traitement | Ticket en cours de traitement |
| 8      | Ajout d'un technicien à un ticket + modification de la description, de la nature et des libellés                        | Ticket en cours de traitement | Ticket en cours de traitement |
| 9      | Ajout d'un technicien à un ticket + modification du niveau d'urgence                                                    | Ticket en cours de traitement | Ticket en cours de traitement |
| 10     | Ajout d'un technicien à un ticket + modification du niveau d'urgence et des libellés                                    | Ticket en cours de traitement | Ticket en cours de traitement |
| 11     | Ajout d'un technicien à un ticket + modification de la nature et du niveau d'urgence                                    | Ticket en cours de traitement | Ticket en cours de traitement |
| 12     | Ajout d'un technicien à un ticket + modification de la nature et du niveau d'urgence et des libellés                    | Ticket en cours de traitement | Ticket en cours de traitement |
| 13     | Ajout d'un technicien à un ticket + modification de la description et du niveau d'urgence                               | Ticket en cours de traitement | Ticket en cours de traitement |
| 14     | Ajout d'un technicien à un ticket + modification de la description et du niveau d'urgence et des libellés               | Ticket en cours de traitement | Ticket en cours de traitement |
| 15     | Ajout d'un technicien à un ticket + modification de la description, de la nature et du niveau d'urgence                 | Ticket en cours de traitement | Ticket en cours de traitement |
| 16     | Ajout d'un technicien à un ticket + modification de la description, de la nature et du niveau d'urgence et des libellés | Ticket en cours de traitement | Ticket en cours de traitement |
| 17     | modification de la description                                                                                          | Ticket ouvert                 | Ticket ouvert                 |
| 18     | modification des libellés                                                                                               | Ticket ouvert                 | Ticket ouvert                 |
| 19     | modification de la nature                                                                                               | Ticket ouvert                 | Ticket ouvert                 |
| 20     | modification de la description et de la nature                                                                          | Ticket ouvert                 | Ticket ouvert                 |
| 21     | modification de la description et des libellés                                                                          | Ticket ouvert                 | Ticket ouvert                 |
| 22     | modification de la nature et des libellés                                                                               | Ticket ouvert                 | Ticket ouvert                 |
| 23     | modification de la description et de la nature et des libellés                                                          | Ticket ouvert                 | Ticket ouvert                 |
| 24     | Modification du niveau d'urgence                                                                                        | Ticket ouvert                 | Ticket ouvert                 |
| 25     | Modification de la nature et du niveau d'urgence                                                                        | Ticket ouvert                 | Ticket ouvert                 |
| 26     | Modification de la description et du niveau d'urgence                                                                   | Ticket ouvert                 | Ticket ouvert                 |
| 27     | modification de la description, de la nature et du niveau d'urgence                                                     | Ticket ouvert                 | Ticket ouvert                 |
| 28     | Modification de la nature et du niveau d'urgence et des libellés                                                        | Ticket ouvert                 | Ticket ouvert                 |
| 29     | Modification de la description et du niveau d'urgence et des libellé                                                    | Ticket ouvert                 | Ticket ouvert                 |
| 30     | modification de la description, de la nature et du niveau d'urgence et des libellés                                     | Ticket ouvert                 | Ticket ouvert                 |

<br>

#### Ticket en cours de traitement

| Cas n° | Critère                                                                                              | Résultat attendu              | Résultat obtenu               |
|:-------|------------------------------------------------------------------------------------------------------|-------------------------------|-------------------------------|
| 1      | modification d'un technicien                                                                         | Ticket en cours de traitement | Ticket en cours de traitement |
| 2      | modification d'un technicien et de libellés                                                          | Ticket en cours de traitement | Ticket en cours de traitement |
| 3      | modification d'un technicien et de la description                                                    | Ticket en cours de traitement | Ticket en cours de traitement |
| 4      | modification d'un technicien et de la description et des libellés                                    | Ticket en cours de traitement | Ticket en cours de traitement |
| 5      | modification d'un technicien et de la nature                                                         | Ticket en cours de traitement | Ticket en cours de traitement |
| 6      | modification d'un technicien et de la nature et des libellés                                         | Ticket en cours de traitement | Ticket en cours de traitement |
| 7      | modification d'un technicien, de la description et de la nature                                      | Ticket en cours de traitement | Ticket en cours de traitement |
| 8      | modification d'un technicien, de la description et de la nature et des libellés                      | Ticket en cours de traitement | Ticket en cours de traitement |
| 9      | modification d'un technicien et du niveau d'urgence                                                  | Ticket en cours de traitement | Ticket en cours de traitement |
| 10     | modification d'un technicien et du niveau d'urgence et des libellés                                  | Ticket en cours de traitement | Ticket en cours de traitement |
| 11     | modification d'un technicien, de la nature et du niveau d'urgence                                    | Ticket en cours de traitement | Ticket en cours de traitement |
| 12     | modification d'un technicien, de la nature et du niveau d'urgence et des libellés                    | Ticket en cours de traitement | Ticket en cours de traitement |
| 13     | modification d'un technicien, de la description et du niveau d'urgence                               | Ticket en cours de traitement | Ticket en cours de traitement |
| 14     | modification d'un technicien, de la description et du niveau d'urgence et des libellés               | Ticket en cours de traitement | Ticket en cours de traitement |
| 15     | modification d'un technicien, de la description, de la nature et du niveau d'urgence                 | Ticket en cours de traitement | Ticket en cours de traitement |
| 16     | modification d'un technicien, de la description, de la nature et du niveau d'urgence et des libellés | Ticket en cours de traitement | Ticket en cours de traitement |
| 17     | modification de la description                                                                       | Ticket en cours de traitement | Ticket en cours de traitement |
| 18     | modification de la description et des libellés                                                       | Ticket en cours de traitement | Ticket en cours de traitement |
| 19     | modification de la description et de la nature                                                       | Ticket en cours de traitement | Ticket en cours de traitement |
| 20     | modification de la description et de la nature et des libellés                                       | Ticket en cours de traitement | Ticket en cours de traitement |
| 21     | modification de la description et du niveau d'urgence                                                | Ticket en cours de traitement | Ticket en cours de traitement |
| 22     | modification de la description et du niveau d'urgence et des libellés                                | Ticket en cours de traitement | Ticket en cours de traitement |
| 23     | Modification de la nature                                                                            | Ticket en cours de traitement | Ticket en cours de traitement |
| 24     | Modification de la nature et des libellés                                                            | Ticket en cours de traitement | Ticket en cours de traitement |
| 25     | Modification du niveau d'urgence                                                                     | Ticket en cours de traitement | Ticket en cours de traitement |
| 26     | Modification du niveau d'urgence et des libellés                                                     | Ticket en cours de traitement | Ticket en cours de traitement |
| 27     | modification de la nature et du niveau d'urgence                                                     | Ticket en cours de traitement | Ticket en cours de traitement |
| 28     | modification de la nature et du niveau d'urgence et des libellés                                     | Ticket en cours de traitement | Ticket en cours de traitement |
| 29     | modification de la description, de la  nature, du niveau d'urgence et des libellés                   | Ticket en cours de traitement | Ticket en cours de traitement |
| 30     | modification de la description, de la  nature et du niveau d'urgence                                 | Ticket en cours de traitement | Ticket en cours de traitement |
| 31     | modification des libellés                                                                            | Ticket en cours de traitement | Ticket en cours de traitement |

<br>

### <a name="b"></a>Administrateur Système

<br>

#### Ticket en attente

| Cas n° | Critère                                                                                    | Résultat attendu  | Résultat obtenu   |
|:-------|--------------------------------------------------------------------------------------------|-------------------|-------------------|
| 1      | modification de la description                                                             | Ticket en attente | Ticket en attente |
| 2      | modification de la nature                                                                  | Ticket en attente | Ticket en attente |
| 3      | modification de la description et de la nature                                             | Ticket en attente | Ticket en attente |
| 4      | modification du niveau d'urgence estimé                                                    | Ticket en attente | Ticket en attente |
| 5      | modification de la description et du niveau d'urgence estimé                               | Ticket en attente | Ticket en attente |
| 6      | modification de la nature et du niveau d'urgence estimé                                    | Ticket en attente | Ticket en attente |
| 7      | modification de la nature, de la description et du niveau d'urgence estimé                 | Ticket en attente | Ticket en attente |
| 8      | modification de la description et des libellés                                             | Ticket en attente | Ticket en attente |
| 9      | modification de la nature et des libellés                                                  | Ticket en attente | Ticket en attente |
| 10     | modification de la description, de la nature et des libellés                               | Ticket en attente | Ticket en attente |
| 11     | modification du niveau d'urgence estimé et des libellés                                    | Ticket en attente | Ticket en attente |
| 12     | modification de la description et du niveau d'urgence estimé et des libellés               | Ticket en attente | Ticket en attente |
| 13     | modification de la nature et du niveau d'urgence estimé et des libellés                    | Ticket en attente | Ticket en attente |
| 14     | modification de la nature, de la description et du niveau d'urgence estimé et des libellés | Ticket en attente | Ticket en attente |
| 15     | modification des libellés                                                                  | Ticket en attente | Ticket en attente |

<br>

### <a name="c"></a>Utilisateur

<br>

#### Ticket en attente

| Cas n° | Critère                                                                                    | Résultat attendu  | Résultat obtenu   |
|:-------|--------------------------------------------------------------------------------------------|-------------------|-------------------|
| 1      | modification de la description                                                             | Ticket en attente | Ticket en attente |
| 2      | modification de la nature                                                                  | Ticket en attente | Ticket en attente |
| 3      | modification de la description et de la nature                                             | Ticket en attente | Ticket en attente |
| 4      | modification du niveau d'urgence estimé                                                    | Ticket en attente | Ticket en attente |
| 5      | modification de la description et du niveau d'urgence estimé                               | Ticket en attente | Ticket en attente |
| 6      | modification de la nature et du niveau d'urgence estimé                                    | Ticket en attente | Ticket en attente |
| 7      | modification de la nature, de la description et du niveau d'urgence estimé                 | Ticket en attente | Ticket en attente |
| 8      | modification de la description et des libellés                                             | Ticket en attente | Ticket en attente |
| 9      | modification de la nature et des libellés                                                  | Ticket en attente | Ticket en attente |
| 10     | modification de la description, de la nature et des libellés                               | Ticket en attente | Ticket en attente |
| 11     | modification du niveau d'urgence estimé et des libellés                                    | Ticket en attente | Ticket en attente |
| 12     | modification de la description et du niveau d'urgence estimé et des libellés               | Ticket en attente | Ticket en attente |
| 13     | modification de la nature et du niveau d'urgence estimé et des libellés                    | Ticket en attente | Ticket en attente |
| 14     | modification de la nature, de la description et du niveau d'urgence estimé et des libellés | Ticket en attente | Ticket en attente |
| 15     | modification des libellés                                                                  | Ticket en attente | Ticket en attente |

<br>

### <a name="d"></a>Technicien

<br>

#### Ticket en attente

| Cas n° | Critère                                                                                    | Résultat attendu  | Résultat obtenu   |
|:-------|--------------------------------------------------------------------------------------------|-------------------|-------------------|
| 1      | modification de la description                                                             | Ticket en attente | Ticket en attente |
| 2      | modification de la nature                                                                  | Ticket en attente | Ticket en attente |
| 3      | modification de la description et de la nature                                             | Ticket en attente | Ticket en attente |
| 4      | modification du niveau d'urgence estimé                                                    | Ticket en attente | Ticket en attente |
| 5      | modification de la description et du niveau d'urgence estimé                               | Ticket en attente | Ticket en attente |
| 6      | modification de la nature et du niveau d'urgence estimé                                    | Ticket en attente | Ticket en attente |
| 7      | modification de la nature, de la description et du niveau d'urgence estimé                 | Ticket en attente | Ticket en attente |
| 8      | modification de la description et des libellés                                             | Ticket en attente | Ticket en attente |
| 9      | modification de la nature et des libellés                                                  | Ticket en attente | Ticket en attente |
| 10     | modification de la description, de la nature et des libellés                               | Ticket en attente | Ticket en attente |
| 11     | modification du niveau d'urgence estimé et des libellés                                    | Ticket en attente | Ticket en attente |
| 12     | modification de la description et du niveau d'urgence estimé et des libellés               | Ticket en attente | Ticket en attente |
| 13     | modification de la nature et du niveau d'urgence estimé et des libellés                    | Ticket en attente | Ticket en attente |
| 14     | modification de la nature, de la description et du niveau d'urgence estimé et des libellés | Ticket en attente | Ticket en attente |
| 15     | modification des libellés                                                                  | Ticket en attente | Ticket en attente |

<br>

#### Ticket ouvert

| Cas n° | Critère                | Résultat attendu       | Résultat obtenu        |
|:-------|------------------------|------------------------|------------------------|
| 1      | S'attribuer ce ticket  | En cours de traitement | En cours de traitement |

<br>

#### Ticket en cours de traitement
#### Si le ticket lui a été aussi attribué

| Cas n° | Critère                                                                                    | Résultat attendu  | Résultat obtenu   |
|:-------|--------------------------------------------------------------------------------------------|-------------------|-------------------|
| 1      | modification de la description                                                             | Ticket en attente | Ticket en attente |
| 2      | modification de la nature                                                                  | Ticket en attente | Ticket en attente |
| 3      | modification de la description et de la nature                                             | Ticket en attente | Ticket en attente |
| 4      | modification du niveau d'urgence estimé                                                    | Ticket en attente | Ticket en attente |
| 5      | modification de la description et du niveau d'urgence estimé                               | Ticket en attente | Ticket en attente |
| 6      | modification de la nature et du niveau d'urgence estimé                                    | Ticket en attente | Ticket en attente |
| 7      | modification de la nature, de la description et du niveau d'urgence estimé                 | Ticket en attente | Ticket en attente |
| 8      | modification de la description et des libellés                                             | Ticket en attente | Ticket en attente |
| 9      | modification de la nature et des libellés                                                  | Ticket en attente | Ticket en attente |
| 10     | modification de la description, de la nature et des libellés                               | Ticket en attente | Ticket en attente |
| 11     | modification du niveau d'urgence estimé et des libellés                                    | Ticket en attente | Ticket en attente |
| 12     | modification de la description et du niveau d'urgence estimé et des libellés               | Ticket en attente | Ticket en attente |
| 13     | modification de la nature et du niveau d'urgence estimé et des libellés                    | Ticket en attente | Ticket en attente |
| 14     | modification de la nature, de la description et du niveau d'urgence estimé et des libellés | Ticket en attente | Ticket en attente |
| 15     | modification des libellés                                                                  | Ticket en attente | Ticket en attente |
