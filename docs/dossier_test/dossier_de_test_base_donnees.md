Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test Base de données

<br><br>
Ce document permet de s'assurer que les pages web statique soient conforme à ce qui est attendu.

</div>

<br><br><br><br><br><br><br>

## Plan
- ### [I - Introduction](#I)
- ### [II - Description de la procédure de test](#II)
- ### [III - Contexte des tests](#III)
- ### [V - Test base de donnée](#V)
  - #### [Insertion utilisateur](#1)
  - #### [Insertion ticket](#2)


<br><br><br>

----------

<br><br><br>

## <a name="I"></a>I - Introduction

Le document suivant a pour but de tester les différentes pages du site dynamique réalisé au niveau de la gestion des profils utilisateurs. Nous testerons plusieurs fonctionnalités que nous allons ajouter en rapport avec la gestion des profils des utilisateurs.
<br>

## <a name="II"></a>II - Description de la procédure de test

Les fonctionnalités que nous allons tester seront la connexion des utilisateurs, l’inscription de nouveaux utilisateurs, la déconnexion des utilisateurs et la modification de certaines informations des utilisateurs comme l’email ou le mot de passe.
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                           |
|------------------------------------|------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                             |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2) |
| Configuration matérielle           | Dell Optiplex 9020                                               |
| Date de début                      |                                                                  |
| Date de finalisation               |                                                                  |
| Test à appliquer                   | Vérification de la validité du site                              |
| Responsable de la campagne de test | GUIGNOLLE Enzo                                                   |

<br><br><br>

----------

<br><br><br>

## <a name="V"></a>IV - Test base de données

### <a name="1"></a>Insertion utilisateur

- Cas n°1
  - INSERT INTO `utilisateur` (`ID_USER`, `LOGIN_USER`, `PRENOM_USER`, `NOM_USER`, `ROLE_USER`, `EMAIL_USER`, `HORODATAGE_OUVERTURE_USER`, `HORODATAGE_DERNIERE_CONNECTION_USER`, `IP_DERNIERE_CONNECTION_USER`) VALUES (NULL, 'DDupont', 'Didier', 'Dupont', 'utilisateur', 'ddupont@gmail.com', current_timestamp(), NULL, NULL);
  - Résultat attendu : OK
  - Résultat obtenu : OK

- Cas n°2
    - INSERT INTO `utilisateur` (`ID_USER`, `LOGIN_USER`, `PRENOM_USER`, `NOM_USER`, `ROLE_USER`, `EMAIL_USER`, `HORODATAGE_OUVERTURE_USER`, `HORODATAGE_DERNIERE_CONNECTION_USER`, `IP_DERNIERE_CONNECTION_USER`) VALUES (NULL, 'DD', 'Didier', 'Dupont', 'utilisateur', 'ddupont@gmail.com', current_timestamp(), NULL, NULL);
    - Résultat attendu : KO
    - Résultat obtenu : KO

- Cas n°3
    - INSERT INTO `utilisateur` (`ID_USER`, `LOGIN_USER`, `PRENOM_USER`, `NOM_USER`, `ROLE_USER`, `EMAIL_USER`, `HORODATAGE_OUVERTURE_USER`, `HORODATAGE_DERNIERE_CONNECTION_USER`, `IP_DERNIERE_CONNECTION_USER`) VALUES (NULL, 'DiDupont', 'Didier', 'Dupont', 'utilisateur', 'd.dupont@gmail.com', current_timestamp(), NULL, NULL);
    - Résultat attendu : OK
    - Résultat obtenu : OK

- Cas n°4
    - INSERT INTO `utilisateur` (`ID_USER`, `LOGIN_USER`, `PRENOM_USER`, `NOM_USER`, `ROLE_USER`, `EMAIL_USER`, `HORODATAGE_OUVERTURE_USER`, `HORODATAGE_DERNIERE_CONNECTION_USER`, `IP_DERNIERE_CONNECTION_USER`) VALUES (NULL, 'DiDupont', 'Didier', 'Dupont', 'utilisateur', 'd.dupont#gmail.com', current_timestamp(), NULL, NULL);
    - Résultat attendu : KO
    - Résultat obtenu : KO

- Cas n°5
    - INSERT INTO `utilisateur` (`ID_USER`, `LOGIN_USER`, `PRENOM_USER`, `NOM_USER`, `ROLE_USER`, `EMAIL_USER`, `HORODATAGE_OUVERTURE_USER`, `HORODATAGE_DERNIERE_CONNECTION_USER`, `IP_DERNIERE_CONNECTION_USER`) VALUES (NULL, 'DiDupont', 'Didier', 'Dupont', 'utilisateur', 'd.dupont@gmail.fr', current_timestamp(), NULL, NULL);
    - Résultat attendu : OK
    - Résultat obtenu : OK

### <a name="2"></a>Insertion ticket

- Cas n°1
  - INSERT INTO `ticket` (`ID_TICKET`, `ID_USER`, `OBJET_TICKET`, `DESCRIPTION_TICKET`, `ID_TECHNICIEN`, `NIV_URGENCE_ESTIMER_TICKET`, `NIV_URGENCE_DEFINITIF_TICKET`, `ETAT_TICKET`, `HORODATAGE_CREATION_TICKET`, `HORODATAGE_DEBUT_TRAITEMENT_TICKET`, `HORODATAGE_RESOLUTION_TICKET`, `HORODATAGE_DERNIERE_MODIF_TICKET`) VALUES (NULL, '1', 'Ordinateur cassé', 'Le moniteur d\'un ordinateur a été cassé', '3', 'Urgent', 'Urgent', 'en_cours_de_traitement', current_timestamp(), NULL, NULL, NULL);
  - Résultat attendu : OK
  - Résultat obtenu : OK

- Cas n°2
  - INSERT INTO `ticket` (`ID_TICKET`, `ID_USER`, `OBJET_TICKET`, `DESCRIPTION_TICKET`, `ID_TECHNICIEN`, `NIV_URGENCE_ESTIMER_TICKET`, `NIV_URGENCE_DEFINITIF_TICKET`, `ETAT_TICKET`, `HORODATAGE_CREATION_TICKET`, `HORODATAGE_DEBUT_TRAITEMENT_TICKET`, `HORODATAGE_RESOLUTION_TICKET`, `HORODATAGE_DERNIERE_MODIF_TICKET`) VALUES (NULL, '1', 'Ordinateur cassé', 'L\'ordinateur a été cassé', '3', 'Urgent', 'Urgent', 'en_cours_de_traitement', current_timestamp(), NULL, NULL, NULL);
  - Résultat attendu : OK
  - Résultat obtenu : OK

- Cas n°3
  - INSERT INTO `ticket` (`ID_TICKET`, `ID_USER`, `OBJET_TICKET`, `DESCRIPTION_TICKET`, `ID_TECHNICIEN`, `NIV_URGENCE_ESTIMER_TICKET`, `NIV_URGENCE_DEFINITIF_TICKET`, `ETAT_TICKET`, `HORODATAGE_CREATION_TICKET`, `HORODATAGE_DEBUT_TRAITEMENT_TICKET`, `HORODATAGE_RESOLUTION_TICKET`, `HORODATAGE_DERNIERE_MODIF_TICKET`) VALUES (NULL, '1', 'Problème de connexion', 'Personne ne peut se connecter sur les PC de la salle G23', '3', 'Urgent', 'Urgent', 'en_cours_de_traitement', current_timestamp(), NULL, NULL, NULL);
  - Résultat attendu : OK
  - Résultat obtenu : OK
