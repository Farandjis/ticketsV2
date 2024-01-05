Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test
## Base de données

<br><br>
Ce document permet de s'assurer que la base de données soit conforme à ce qui a été conçu.

</div>

<br><br><br><br><br><br><br>

## Plan
- ### [I - Introduction](#I)
- ### [II - Description de la procédure de test](#II)
- ### [III - Contexte des tests](#III)
- ### [IV - Test PHP](#IV)
- ### [V - Test](#V)
  - #### [Table](#1)
    - #### [Table Utilisateur](#1a)
    - #### [Table Ticket](#1b)
  - #### [Role](#2)
    - #### [role_utilisateur](#2a)
    - #### [role_technicien](#2b)
    - #### [role_admin_sys](#2c)
    - #### [role_admin_web](#2d)
  - #### [Fonction](#3)
    - #### [ObtenirRoleUtilisateur](#3a)
  - #### [Procédure](#4)
  - #### [Trigger](#5)


<br><br><br>

----------

<br><br><br>

## <a name="I"></a>I - Introduction

Le document suivant a pour but de tester la base de données du site dynamique.
<br>

## <a name="II"></a>II - Description de la procédure de test

Nous testerons les insertions dans les tables ayant beaucoup de condition ainsi que les différents droits des rôles au niveau des vues
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

## <a name="1"></a>Table

### <a name="1a"></a>Table Utilisateur

| Cas n° | Critère                                                                                                                                                                                          | Résultat attendu | Résultat obtenu |
|:-------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|------------------|-----------------|
| 1      | INSERT INTO `UTILISATEUR` (`LOGIN_USER`, `PRENOM_USER`, `NOM_USER`, `EMAIL_USER`, `IP_DERNIERE_CONNECTION_USER`) VALUES ('DDupont', 'Didier', 'Dupont', 'ddupont@gmail.com', '192.168.1.30');    | OK               | OK              |
| 2      | INSERT INTO `UTILISATEUR` (`LOGIN_USER`, `PRENOM_USER`, `NOM_USER`, `EMAIL_USER`, `IP_DERNIERE_CONNECTION_USER`) VALUES ('DD', 'Didier', 'Dupont', 'ddupont@gmail.com', '192.168.1.30');         | KO               | KO              |
| 3      | INSERT INTO `UTILISATEUR` (`LOGIN_USER`, `PRENOM_USER`, `NOM_USER`, `EMAIL_USER`, `IP_DERNIERE_CONNECTION_USER`) VALUES ('DiDupont', 'Didier', 'Dupont', 'd.dupont@gmail.com', '192.168.1.30');  | OK               | OK              |
| 4      | INSERT INTO `UTILISATEUR` (`LOGIN_USER`, `PRENOM_USER`, `NOM_USER`, `EMAIL_USER`, `IP_DERNIERE_CONNECTION_USER`) VALUES ('DiDupont', 'Didier', 'Dupont','d.dupont@gmail.com', '192.168.1.30');   | KO               | KO              |
| 5      | INSERT INTO `UTILISATEUR` (`LOGIN_USER`, `PRENOM_USER`, `NOM_USER`, `EMAIL_USER`, `IP_DERNIERE_CONNECTION_USER`) VALUES ('DiDupont', 'Didier', 'Dupont', 'd.dupont#gmail.com', '192.168.1.30');  | KO               | KO              |
| 6      | INSERT INTO `UTILISATEUR` (`LOGIN_USER`, `PRENOM_USER`, `NOM_USER`, `EMAIL_USER`, `IP_DERNIERE_CONNECTION_USER`) VALUES ('DiDupont', 'Didier', 'Dupont','d.dupont@gmail.fr', '192.168.1.30');    | OK               | OK              |
| 7      | INSERT INTO `UTILISATEUR` (`LOGIN_USER`, `PRENOM_USER`, `NOM_USER`, `EMAIL_USER`, `IP_DERNIERE_CONNECTION_USER`) VALUES ('DDupont', 'Didier', 'Dupont', 'ddupont@..gmail.com', '192.168.1.30');  | KO               | OK              |
| 8      | INSERT INTO `UTILISATEUR` (`LOGIN_USER`, `PRENOM_USER`, `NOM_USER`, `EMAIL_USER`, `IP_DERNIERE_CONNECTION_USER`) VALUES ('DDupont', 'Didier', 'Dupont',  'd..dupont@gmail.com', '192.168.1.30'); | KO               | OK              |

### <a name="1b"></a>Table Ticket

| Cas n° | Critère                                                                                                                                                                                                                                                                                                           | Résultat attendu | Résultat obtenu |
|:-------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|------------------|-----------------|
| 1      | INSERT INTO `Ticket` (`ID_USER`, `TITRE_TICKET`, `DESCRIPTION_TICKET`, `ID_TECHNICIEN`, `NIV_URGENCE_ESTIMER_TICKET`, `NIV_URGENCE_DEFINITIF_TICKET`, `ETAT_TICKET`) VALUES ('1', '[MATERIEL] Matériel en panne', 'Le moniteur d\'un ordinateur a été cassé', '3', 'Urgent', 'Urgent', 'En cours de traitement'); | OK               | OK              |
| 2      | INSERT INTO `Ticket` (`ID_USER`, `TITRE_TICKET`, `DESCRIPTION_TICKET`, `ID_TECHNICIEN`, `NIV_URGENCE_ESTIMER_TICKET`, `NIV_URGENCE_DEFINITIF_TICKET`, `ETAT_TICKET`) VALUES ('1', '[MATERIEL] Matériel en panne', 'Le moniteur d\'un ordinateur a été cassé', '3', 'Urgent', 'Urgent', 'en_cours_de_traitement'); | KO               | KO              |
| 3      | INSERT INTO `Ticket` (`ID_USER`, `TITRE_TICKET`, `DESCRIPTION_TICKET`, `ID_TECHNICIEN`, `NIV_URGENCE_ESTIMER_TICKET`, `NIV_URGENCE_DEFINITIF_TICKET`, `ETAT_TICKET`) VALUES ('1', 'Matériel en panne', 'Le moniteur d\'un ordinateur a été cassé', '3', 'Urgent', 'Urgent', 'En cours de traitement');            | KO               | KO              |
| 4      | INSERT INTO `Ticket` (`ID_USER`, `TITRE_TICKET`, `DESCRIPTION_TICKET`, `ID_TECHNICIEN`, `NIV_URGENCE_ESTIMER_TICKET`, `NIV_URGENCE_DEFINITIF_TICKET`, `ETAT_TICKET`) VALUES ('1', '[MATERIEL] Matériel en panne', 'Le moniteur d\'un ordinateur a été cassé', '3', 'urgent', 'Urgent', 'En cours de traitement'); | KO               | KO              |
| 5      | INSERT INTO `Ticket` (`ID_USER`, `TITRE_TICKET`, `DESCRIPTION_TICKET`, `ID_TECHNICIEN`, `NIV_URGENCE_ESTIMER_TICKET`, `NIV_URGENCE_DEFINITIF_TICKET`, `ETAT_TICKET`) VALUES ('1', '[MATERIEL] Matériel en panne', 'Le moniteur d\'un ordinateur a été cassé', '3', 'Urgent', 'urgent', 'En cours de traitement'); | KO               | KO              |

### <a name="1b"></a>Table TitreTicket

| Cas n° | Critère                                                                             | Résultat attendu | Résultat obtenu |
|:-------|-------------------------------------------------------------------------------------|------------------|-----------------|
| 1      | INSERT INTO `TitreTicket` (`TITRE_TICKET`) VALUES ('[MATERIEL] Matériel manquant'); | OK               | OK              |
| 2      | INSERT INTO `TitreTicket` (`TITRE_TICKET`) VALUES ('<b>Salut</b>');                 | KO               | OK              |

### <a name="1b"></a>Table MotClesTicket

| Cas n° | Critère                                                                  | Résultat attendu | Résultat obtenu |
|:-------|--------------------------------------------------------------------------|------------------|-----------------|
| 1      | INSERT INTO `MotcleTicket` (`NOM_MOTCLE`) VALUES ('Logiciel : Firefox'); | OK               | OK              |
| 2      | INSERT INTO `MotcleTicket` (`NOM_MOTCLE`) VALUES ('<b>Salut</b>');       | KO               | OK              |

## <a name="2"></a>Role

### <a name="2a"></a>role_utilisateur

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


### <a name="2b"></a>role_technicien

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

### <a name="2c"></a>role_admin_sys

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

### <a name="2d"></a>role_admin_web

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

## <a name="3"></a>Fonction

### <a name="3a"></a>ObtenirRoleUtilisateur

| Cas n° | Critère                                                  | Résultat attendu | Résultat obtenu  |
|:-------|----------------------------------------------------------|------------------|------------------|
| 1      | On se connecte en temps que alice à la base de données   | role_utilisateur | role_utilisateur |
| 2      | On se connecte en temps que gordon à la base de données  | role_technicien  | role_technicien  |
| 3      | On se connecte en temps que gestion à la base de données | role_admin_web   | role_admin_web   |
| 4      | On se connecte en temps que admin à la base de données   | role_admin_sys   | role_admin_sys   |

### <a name="3b"></a>verifTicketPeutEtreModif

| Cas n° | Critère                                                             | Résultat attendu | Résultat obtenu |
|:-------|---------------------------------------------------------------------|------------------|-----------------|
| 1      | Le ticket se trouve dans le tableau de bord d'un utilisateur        | 1                | 1               |
| 2      | Le ticket ne se trouve pas dans le tableau de bord d'un utilisateur | 0                | 0               |
| 3      | Le ticket se trouve dans le tableau de bord d'un technicien         | 1                | 1               |
| 4      | Le ticket ne se trouve pas dans le tableau de bord d'un technicien  | 0                | 0               |
| 5      | Le ticket se trouve dans le tableau de bord d'un admin Web          | 1                | 1               |
| 6      | Le ticket ne se trouve pas dans le tableau de bord d'un admin Web   | 0                | 0               |
| 7      | Le ticket se trouve dans le tableau de bord d'un admin sys          | 1                | 1               |
| 8      | Le ticket ne se trouve pas dans le tableau de bord d'un admin Sys   | 0                | 0               |

### <a name="3c"></a>recup_etat_ticket_tdb

| Cas n° | Critère                                             | Résultat attendu       | Résultat obtenu        |
|:-------|-----------------------------------------------------|------------------------|------------------------|
| 1      | Demande l'état d'un ticket `en attente`             | en attente             | en attente             |
| 2      | Demande l'état d'un ticket `ouvert`                 | ouvert                 | ouvert                 |
| 3      | Demande l'état d'un ticket `en cours de traitement` | en cours de traitement | en cours de traitement |
| 4      | Demande l'état d'un ticket `fermé`                  | fermé                  | fermé                  |

### <a name="3d"></a>FermerUnTicket

| Cas n° | Critère                                                                    | Résultat attendu | Résultat obtenu |
|:-------|----------------------------------------------------------------------------|------------------|-----------------|
| 1      | Le ticket se trouve dans la vue `vue_modif_ticket_adm_tech`                | True             | True            |
| 2      | Le ticket ne se trouve pas dans la vue `vue_modif_ticket_adm_tech`         | False            | False           |
| 1      | Le ticket se trouve dans la vue `vue_modif_ticket_adm_tech` et est modifié | OK               | OK              |

## <a name="4"></a>Procédure

### <a name="4a"></a>ATTENTION_SupprimerSonCompte

| Cas n° | Critère                                                  | Résultat attendu | Résultat obtenu |
|:-------|----------------------------------------------------------|------------------|-----------------|
| 1      | On se connecte en temps que alice à la base de données   | OK               | OK              |
| 2      | On se connecte en temps que gordon à la base de données  | OK               | OK              |
| 3      | On se connecte en temps que gestion à la base de données | KO               | KO              |
| 4      | On se connecte en temps que admin à la base de données   | KO               | KO              |

### <a name="4b"></a>ATTENTION_SupprimerTousLesComptesInutilises

| Cas n° | Critère                                                     | Résultat attendu | Résultat obtenu |
|:-------|-------------------------------------------------------------|------------------|-----------------|
| 1      | Le compte d'alice est inactif depuis moins de 36 mois       | KO               | KO              |
| 2      | Le compte d'alice est inactif depuis au moins de 36 mois    | OK               | OK              |
| 3      | Le compte de gordon est inactif depuis moins de 36 mois     | KO               | KO              |
| 4      | Le compte de gordon est inactif depuis au moins de 36 mois  | OK               | OK              |
| 5      | Le compte de gestion est inactif depuis moins de 36 mois    | KO               | KO              |
| 6      | Le compte de gestion est inactif depuis au moins de 36 mois | KO               | KO              |
| 7      | Le compte de admin est inactif depuis moins de 36 mois      | KO               | KO              |
| 8      | Le compte de admin est inactif depuis au moins de 36 mois   | KO               | KO              |

### <a name="4b"></a>activerUnRoleTechOuUtiParAdminWeb

| Cas n° | Critère                                                           | Résultat attendu                                            | Résultat obtenu                                             |
|:-------|-------------------------------------------------------------------|-------------------------------------------------------------|-------------------------------------------------------------|
| 1      | L'admin web veut passer un utilisateur en technicien              | Le rôle par défaut de l'utilisateur devient role_technicien | Le rôle par défaut de l'utilisateur devient role_technicien |
| 2      | L'admin web veut passer un technicien en utilisateur              | Le rôle par défaut du technicien devient role_utilisateur   | Le rôle par défaut du technicien devient role_utilisateur   |
| 3      | L'admin web veut passer un admin sys en technicien ou utilisateur | KO                                                          | KO                                                          |

## <a name="5"></a>Trigger

### <a name="5a"></a>PasseTicketAEnCours

| Cas n° | Critère                                                                                      | Résultat attendu                       | Résultat obtenu                        |
|:-------|----------------------------------------------------------------------------------------------|----------------------------------------|----------------------------------------|
| 1      | Le ticket est ouvert + un technicien est associé au ticket                                   | Le ticket passe en cours de traitement | Le ticket passe en cours de traitement |
| 2      | Le ticket est en attente + un niv d'urgence est défini + un technicien est associé au ticket | Le ticket passe en cours de traitement | Le ticket passe en cours de traitement |

### <a name="5b"></a>PasseTicketAOuvert

| Cas n° | Critère                                                                 | Résultat attendu                       | Résultat obtenu        |
|:-------|-------------------------------------------------------------------------|----------------------------------------|------------------------|
| 1      | Le ticket est en attente et un niv d'urgence est défini                 | Le ticket passe ouvert                 | Le ticket passe ouvert |
| 2      | Le ticket est en cours de traitement et le niveau d'urgence est modifié | Le ticket reste en cours de traitement |                        |

### <a name="5c"></a>VerifQuiCestLeTechDuTicket

| Cas n° | Critère                                                                 | Résultat attendu | Résultat obtenu |
|:-------|-------------------------------------------------------------------------|------------------|-----------------|
| 1      | Si l'admin web veut changer le technicien d'un ticket                   | OK               | OK              |
| 2      | Si le technien veut attribuer à un autre technicien le ticket           | KO               | KO              |
| 3      | Si le technicien veut s'attribuer un ticket                             | OK               | OK              |
| 4      | Si le technicien veut s'attribuer un ticket dans n'importe qu'elle état | KO               | KO              |
| 5      | Si l'admin web veut attribuer un ticket fermée                          | KO               | KO              |
| 6      | Si l'utilisateur veut attribuer un ticket à un technicien               | KO               | KO              |
| 7      | Si l'admin sys veut attribuer un ticket à un technicien                 | KO               | KO              |

### <a name="5d"></a>MajHorodatageModifTicket

| Cas n° | Critère                                                                                       | Résultat attendu                                                                | Résultat obtenu                                                                 |
|:-------|-----------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------|---------------------------------------------------------------------------------|
| 1      | Si une modification est opéré sur un ticket                                                   | changement de l'horodatage de dernière modif et de l'id du user qui l'a modifié | changement de l'horodatage de dernière modif et de l'id du user qui l'a modifié |
| 2      | Si l'admin de la BD fait une modification sur un ticket                                       | changement de l'horodatage de dernière modif et de l'id du user passe en NULL   | changement de l'horodatage de dernière modif et de l'id du user passe en NULL   |
| 2      | Si une personne non enregistrer dans la table Utilisateur fait une modification sur un ticket | Message d'erreur                                                                | Message d'erreur                                                                |
| 3      | Si aucune modification est opéré sur un ticket                                                | rien ne se passe                                                                | rien ne se passe                                                                |

### <a name="5e"></a>EMPECHE_modifUtilisateurQuelquesInfos

| Cas n° | Critère                                               | Résultat attendu              | Résultat obtenu               |
|:-------|-------------------------------------------------------|-------------------------------|-------------------------------|
| 1      | Si modification de l'ID du user                       | Annulation de la modification | Annulation de la modification |
| 2      | Si modification de l'horodatage de création de compte | Annulation de la modification | Annulation de la modification |
| 3      | Si aucune modification d'une info utilisateur         | Rien ne se passe              | Rien ne se passe              |

### <a name="5f"></a>EMPECHE_modifTicketQuelquesInfos

| Cas n° | Critère                                               | Résultat attendu              | Résultat obtenu               |
|:-------|-------------------------------------------------------|-------------------------------|-------------------------------|
| 1      | Si modification de l'ID du ticket                     | Annulation de la modification | Annulation de la modification |
| 2      | Si modification de l'ID du user qui a créé le ticket  | Annulation de la modification | Annulation de la modification |
| 3      | Si modification de l'horodatage de création de ticket | Annulation de la modification | Annulation de la modification |
| 4      | Si aucune modification d'une info ticket              | Rien ne se passe              | Rien ne se passe              |

### <a name="5g"></a>EMPECHE_modifTicketFermer

| Cas n° | Critère                                  | Résultat attendu              | Résultat obtenu               |
|:-------|------------------------------------------|-------------------------------|-------------------------------|
| 1      | Si modification d'un ticket fermé        | Annulation de la modification | Annulation de la modification |
| 2      | Si aucune modification d'un ticket fermé | Rien ne se passe              | Rien ne se passe              |

### <a name="5h"></a>MajHorodatageModifMotsclesTicket_INSERT

| Cas n° | Critère                                | Résultat attendu                                                                            | Résultat obtenu                                                                                |
|:-------|----------------------------------------|---------------------------------------------------------------------------------------------|------------------------------------------------------------------------------------------------|
| 1      | Si ajout d'une relation ticket-motclés | modification de l'horodatage de dernière modif du ticket et de l'id du user qui l'a modifié | modification de l'horodatage de dernière modif du ticket et de de l'id du user qui l'a modifié |
| 2      | Si aucune ajout n'est opéré            | Rien ne se passe                                                                            | Rien ne se passe                                                                               |

### <a name="5i"></a>MajHorodatageModifMotsclesTicket_DELETE

| Cas n° | Critère                                     | Résultat attendu                                                                            | Résultat obtenu                                                                             |
|:-------|---------------------------------------------|---------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------|
| 1      | Si suppresion d'une relation ticket-motclés | modification de l'horodatage de dernière modif du ticket et de l'id du user qui l'a modifié | modification de l'horodatage de dernière modif du ticket et de l'id du user qui l'a modifié |
| 2      | Si aucune suppression n'est opéré           | Rien ne se passe                                                                            | Rien ne se passe                                                                            |

### <a name="5j"></a>EMPECHE_InsertionMotsclesTicket

| Cas n° | Critère                                                              | Résultat attendu               | Résultat obtenu                |
|:-------|----------------------------------------------------------------------|--------------------------------|--------------------------------|
| 1      | Si le ticket se trouve dans la vue_modif_creation_ticket_utilisateur | modification du ticket         | modification du ticket         |
| 2      | Si le ticket se trouve dans la vue_modif_ticket_adm_tech             | modification du ticket         | modification du ticket         |
| 3      | Si le ticket se trouve dans aucune vue de modification               | empechement de la modification | empechement de la modification |

