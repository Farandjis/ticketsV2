Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test
## Base de données

<br><br>
Ce document permet de s'assurer que la base de données soit conforme à ce qui à été conçu.

</div>

<br><br><br><br><br><br><br>

## Plan
- ### [I - Introduction](#I)
- ### [II - Description de la procédure de test](#II)
- ### [III - Contexte des tests](#III)
- ### [IV - Test PHP](#IV)
- ### [V - Test](#V)
  - #### [Table Utilisateur](#1)
  - #### [Table Ticket](#2)
  - #### [role_utilisateur](#3)
  - #### [role_technicien](#4)
  - #### [role_admin_sys](#5)
  - #### [role_admin_web](#6)


<br><br><br>

----------

<br><br><br>

## <a name="I"></a>I - Introduction

Le document suivant à pour but de tester la base de données du site dynamique.
<br>

## <a name="II"></a>II - Description de la procédure de test

Nous testerons les insertions dans les tables ayant beaucoup de condition ainsi que les différents droit des rôles au niveau des vues
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                           |
|------------------------------------|------------------------------------------------------------------|
| Produit testé                      | Base de données                                                  |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2) |
| Configuration matérielle           | Dell Optiplex 9020                                               |
| Date de début                      | 29/12/2023                                                       |
| Date de finalisation               |                                                                  |
| Test à appliquer                   | Vérification de la conformité de la base de données              |
| Responsable de la campagne de test | GUIGNOLLE Enzo                                                   |

<br><br><br>

----------

<br><br><br>

## <a name="V"></a>IV - Test

### <a name="1"></a>Table Utilisateur

- Cas n°1
  - INSERT INTO `UTILISATEUR` (`ID_USER`, `LOGIN_USER`, `PRENOM_USER`, `NOM_USER`, `ROLE_USER`, `EMAIL_USER`, `HORODATAGE_OUVERTURE_USER`, `HORODATAGE_DERNIERE_CONNECTION_USER`, `IP_DERNIERE_CONNECTION_USER`) VALUES (NULL, 'DDupont', 'Didier', 'Dupont', 'utilisateur', 'ddupont@gmail.com', current_timestamp(), NULL, NULL);
  - Résultat attendu : OK
  - Résultat obtenu : OK

- Cas n°2
  - INSERT INTO `UTILISATEUR` (`ID_USER`, `LOGIN_USER`, `PRENOM_USER`, `NOM_USER`, `ROLE_USER`, `EMAIL_USER`, `HORODATAGE_OUVERTURE_USER`, `HORODATAGE_DERNIERE_CONNECTION_USER`, `IP_DERNIERE_CONNECTION_USER`) VALUES (NULL, 'DD', 'Didier', 'Dupont', 'utilisateur', 'ddupont@gmail.com', current_timestamp(), NULL, NULL);
  - Résultat attendu : KO
  - Résultat obtenu : KO

- Cas n°3
  - INSERT INTO `UTILISATEUR` (`ID_USER`, `LOGIN_USER`, `PRENOM_USER`, `NOM_USER`, `ROLE_USER`, `EMAIL_USER`, `HORODATAGE_OUVERTURE_USER`, `HORODATAGE_DERNIERE_CONNECTION_USER`, `IP_DERNIERE_CONNECTION_USER`) VALUES (NULL, 'DiDupont', 'Didier', 'Dupont', 'utilisateur', 'd.dupont@gmail.com', current_timestamp(), NULL, NULL);
  - Résultat attendu : OK
  - Résultat obtenu : OK

- Cas n°4
  - INSERT INTO `UTILISATEUR` (`ID_USER`, `LOGIN_USER`, `PRENOM_USER`, `NOM_USER`, `ROLE_USER`, `EMAIL_USER`, `HORODATAGE_OUVERTURE_USER`, `HORODATAGE_DERNIERE_CONNECTION_USER`, `IP_DERNIERE_CONNECTION_USER`) VALUES (NULL, 'DiDupont', 'Didier', 'Dupont', 'utilisateur', 'd.dupont#gmail.com', current_timestamp(), NULL, NULL);
  - Résultat attendu : KO
  - Résultat obtenu : KO

- Cas n°5
  - INSERT INTO `UTILISATEUR` (`ID_USER`, `LOGIN_USER`, `PRENOM_USER`, `NOM_USER`, `ROLE_USER`, `EMAIL_USER`, `HORODATAGE_OUVERTURE_USER`, `HORODATAGE_DERNIERE_CONNECTION_USER`, `IP_DERNIERE_CONNECTION_USER`) VALUES (NULL, 'DiDupont', 'Didier', 'Dupont', 'utilisateur', 'd.dupont@gmail.fr', current_timestamp(), NULL, NULL);
  - Résultat attendu : OK
  - Résultat obtenu : OK

### <a name="2"></a>Table Ticket

- Cas n°1
  - INSERT INTO `TICKET` (`ID_TICKET`, `ID_USER`, `OBJET_TICKET`, `DESCRIPTION_TICKET`, `ID_TECHNICIEN`, `NIV_URGENCE_ESTIMER_TICKET`, `NIV_URGENCE_DEFINITIF_TICKET`, `ETAT_TICKET`, `HORODATAGE_CREATION_TICKET`, `HORODATAGE_DEBUT_TRAITEMENT_TICKET`, `HORODATAGE_RESOLUTION_TICKET`, `HORODATAGE_DERNIERE_MODIF_TICKET`) VALUES (NULL, '1', 'Ordinateur cassé', 'Le moniteur d\'un ordinateur a été cassé', '3', 'Urgent', 'Urgent', 'en_cours_de_traitement', current_timestamp(), NULL, NULL, NULL);
  - Résultat attendu : OK
  - Résultat obtenu : OK

- Cas n°2
  - INSERT INTO `TICKET` (`ID_TICKET`, `ID_USER`, `OBJET_TICKET`, `DESCRIPTION_TICKET`, `ID_TECHNICIEN`, `NIV_URGENCE_ESTIMER_TICKET`, `NIV_URGENCE_DEFINITIF_TICKET`, `ETAT_TICKET`, `HORODATAGE_CREATION_TICKET`, `HORODATAGE_DEBUT_TRAITEMENT_TICKET`, `HORODATAGE_RESOLUTION_TICKET`, `HORODATAGE_DERNIERE_MODIF_TICKET`) VALUES (NULL, '1', 'Ordinateur cassé', 'L\'ordinateur a été cassé', '3', 'Urgent', 'Urgent', 'en_cours_de_traitement', current_timestamp(), NULL, NULL, NULL);
  - Résultat attendu : OK
  - Résultat obtenu : OK

- Cas n°3
  - INSERT INTO `TICKET` (`ID_TICKET`, `ID_USER`, `OBJET_TICKET`, `DESCRIPTION_TICKET`, `ID_TECHNICIEN`, `NIV_URGENCE_ESTIMER_TICKET`, `NIV_URGENCE_DEFINITIF_TICKET`, `ETAT_TICKET`, `HORODATAGE_CREATION_TICKET`, `HORODATAGE_DEBUT_TRAITEMENT_TICKET`, `HORODATAGE_RESOLUTION_TICKET`, `HORODATAGE_DERNIERE_MODIF_TICKET`) VALUES (NULL, '1', 'Problème de connexion', 'Personne ne peut se connecter sur les PC de la salle G23', '3', 'Urgent', 'Urgent', 'en_cours_de_traitement', current_timestamp(), NULL, NULL, NULL);
  - Résultat attendu : OK
  - Résultat obtenu : OK

### <a name="3"></a>role_utilisateur

#### vue_Utilisateur_client

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_Ticket_client

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_Utilisateur_maj_email

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | KO               | KO              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | OK               | OK              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### MotcleTicket

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_tableau_bord

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_tdb_relation_ticket_motcle

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_modif_creation_ticket_utilisateur

| Cas n° | Critère                                                                                                | Résultat attendu | Résultat obtenu |
|:-------|--------------------------------------------------------------------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT(ID_TICKET) sur la vue                                                    | OK               | OK              |
| 2      | L'utilisateur tente un INSERT(TITRE_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET) sur la vue | OK               | OK              |
| 3      | L'utilisateur tente un UPDATE(TITRE_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET) sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue                                                               | KO               | KO              |

#### RelationTicketsMotscles

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | KO               | KO              |
| 2      | L'utilisateur tente un INSERT sur la vue | OK               | OK              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_suppr_rtm_tdb

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | OK               | OK              |

#### vue_technicien

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |


### <a name="4"></a>role_technicien

#### vue_Utilisateur_client

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_Ticket_client

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_Utilisateur_maj_email

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | KO               | KO              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | OK               | OK              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### MotcleTicket

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_tableau_bord

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_tdb_relation_ticket_motcle

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_modif_creation_ticket_utilisateur

| Cas n° | Critère                                                                                                | Résultat attendu | Résultat obtenu |
|:-------|--------------------------------------------------------------------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT(ID_TICKET) sur la vue                                                    | OK               | OK              |
| 2      | L'utilisateur tente un INSERT(TITRE_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET) sur la vue | OK               | OK              |
| 3      | L'utilisateur tente un UPDATE(TITRE_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET) sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue                                                               | KO               | KO              |

#### RelationTicketsMotscles

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | KO               | KO              |
| 2      | L'utilisateur tente un INSERT sur la vue | OK               | OK              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_suppr_rtm_tdb

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | OK               | OK              |

#### vue_technicien

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_modif_ticket_adm_tech

| Cas n° | Critère                                                                    | Résultat attendu | Résultat obtenu |
|:-------|----------------------------------------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT(ID_TICKET) sur la vue                        | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue                                   | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE(TITRE_TICKET, DESCRIPTION_TICKET) sur la vue | OK               | OK              |
| 4      | L'utilisateur tente un DELETE sur la vue                                   | KO               | KO              |

#### vue_associe_ticket_tech

| Cas n° | Critère                                                 | Résultat attendu | Résultat obtenu |
|:-------|---------------------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT(ID_TICKET) sur la vue     | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue                | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE(ID_TECHNICIEN) sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue                | KO               | KO              |

#### vue_historique

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_historique_relation_ticket_motcle

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

### <a name="5"></a>role_admin_sys

#### vue_Utilisateur_client

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_Ticket_client

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_Utilisateur_maj_email

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | KO               | KO              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | OK               | OK              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### MotcleTicket

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_tableau_bord

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_tdb_relation_ticket_motcle

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_modif_creation_ticket_utilisateur

| Cas n° | Critère                                                                                                | Résultat attendu | Résultat obtenu |
|:-------|--------------------------------------------------------------------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT(ID_TICKET) sur la vue                                                    | OK               | OK              |
| 2      | L'utilisateur tente un INSERT(TITRE_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET) sur la vue | OK               | OK              |
| 3      | L'utilisateur tente un UPDATE(TITRE_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET) sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue                                                               | KO               | KO              |

#### RelationTicketsMotscles

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | KO               | KO              |
| 2      | L'utilisateur tente un INSERT sur la vue | OK               | OK              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_suppr_rtm_tdb

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | OK               | OK              |

#### vue_technicien

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_modif_ticket_adm_tech

| Cas n° | Critère                                                                    | Résultat attendu | Résultat obtenu |
|:-------|----------------------------------------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT(ID_TICKET) sur la vue                        | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue                                   | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE(TITRE_TICKET, DESCRIPTION_TICKET) sur la vue | OK               | OK              |
| 4      | L'utilisateur tente un DELETE sur la vue                                   | KO               | KO              |

#### vue_associe_ticket_tech

| Cas n° | Critère                                                 | Résultat attendu | Résultat obtenu |
|:-------|---------------------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT(ID_TICKET) sur la vue     | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue                | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE(ID_TECHNICIEN) sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue                | KO               | KO              |

### <a name="6"></a>role_admin_web

#### vue_Utilisateur_client

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_Ticket_client

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_Utilisateur_maj_email

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | KO               | KO              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | OK               | OK              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### MotcleTicket

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_tableau_bord

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_tdb_relation_ticket_motcle

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_modif_creation_ticket_utilisateur

| Cas n° | Critère                                                                                                | Résultat attendu | Résultat obtenu |
|:-------|--------------------------------------------------------------------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT(ID_TICKET) sur la vue                                                    | OK               | OK              |
| 2      | L'utilisateur tente un INSERT(TITRE_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET) sur la vue | OK               | OK              |
| 3      | L'utilisateur tente un UPDATE(TITRE_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET) sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue                                                               | KO               | KO              |

#### RelationTicketsMotscles

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | KO               | KO              |
| 2      | L'utilisateur tente un INSERT sur la vue | OK               | OK              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_suppr_rtm_tdb

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | OK               | OK              |

#### vue_technicien

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | KO              |

#### vue_modif_ticket_adm_tech

| Cas n° | Critère                                                                    | Résultat attendu | Résultat obtenu |
|:-------|----------------------------------------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT(ID_TICKET) sur la vue                        | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue                                   | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE(TITRE_TICKET, DESCRIPTION_TICKET) sur la vue | OK               | OK              |
| 4      | L'utilisateur tente un DELETE sur la vue                                   | KO               | KO              |

#### vue_associe_ticket_tech

| Cas n° | Critère                                                 | Résultat attendu | Résultat obtenu |
|:-------|---------------------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT(ID_TICKET) sur la vue     | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue                | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE(ID_TECHNICIEN) sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue                | KO               | KO              |

#### vue_modif_ticket_adm_tech

| Cas n° | Critère                                                                                                                 | Résultat attendu | Résultat obtenu |
|:-------|-------------------------------------------------------------------------------------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT(ID_TICKET) sur la vue                                                                     | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue                                                                                | KO               | KO              |
| 3      | L'utilisateur tente un UPDATE(TITRE_TICKET, ID_TECHNICIEN, DESCRIPTION_TICKET, NIV_URGENCE_DEFINITIF_TICKET) sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue                                                                                | KO               | KO              |

#### MotcleTicket

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | KO               | KO              |
| 2      | L'utilisateur tente un INSERT sur la vue | OK               | OK              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | OK               | OK              |

#### RelationTicketsMotscles

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | KO               | KO              |
| 2      | L'utilisateur tente un INSERT sur la vue | OK               | OK              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | OK               | OK              |

#### affiche_utilisateurs_pour_adm_web

| Cas n° | Critère                                  | Résultat attendu | Résultat obtenu |
|:-------|------------------------------------------|------------------|-----------------|
| 1      | L'utilisateur tente un SELECT sur la vue | OK               | OK              |
| 2      | L'utilisateur tente un INSERT sur la vue | KO               | OK              |
| 3      | L'utilisateur tente un UPDATE sur la vue | KO               | KO              |
| 4      | L'utilisateur tente un DELETE sur la vue | KO               | OK              |