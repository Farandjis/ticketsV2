Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3  - Conception base de données

<br><br>
Ce document décrit la base de données. Comme ses tables, ses utilisateurs et leurs drois, ses vues.
</div>

<br><br><br>


- ### [I - Analyse](#p1)

- ### [II - Les tables](#p2)
- Pour chaque table
- Nom de la table
- Description

- ### [III - Les attributs des tables]()
- Pour chaque table
- Liste de ses attributs
- Options des attributs (clées primaire...)

- ### [IV - Les utilisateurs MySQL]()
- Pour chaque type d'utilisateur MySQL
- Nom du type d'utilisateur
- Description de l'utilisateur
- Ses droits

- ### [V - Les vues]()
- Pour chaque type d'utilisateur
- Nom de la vue
- Description de la vue
- Ce qu'elle fait

- ### [VI - Les vues des users fictifs]()

- ### [VII - Les rôles]()


---------

- ### I - Analyse
Nous avons besoin d'une base de données capable de stocker les différentes données concernant les utilisateurs et les différents tickets.

Cette base des données permet de joindre les différents tickets à leurs créateurs et à leurs techniciens associés.

Celle-ci doit être sécurisée, elle ne doit pas permettre l'accès ou la modification non autorisée.
Ainsi, un utilisateur ne doit pouvoir accéder uniquement aux données publiques et à ses données personnelles, et non aux données personnelles des autres utilisateurs.

En cela, il est nécessaire de mettre en place des vues ainsi que la création d'utilisateurs sur la base de données.



- ### II - Les tables
  - #### Utilisateur
La table UTILISATEUR comporte toutes les données liées aux utilisateurs, et aux comptes des utilisateurs.

  - #### Ticket
La table TICKET comporte tous les tickets de la plateforme et leurs informations. Ceux en attente de validation par l’administrateur comme ceux en cours de traitement ou encore ceux qui ont été résolus.

Un ticket possède un identifiant unique et possède l'identifiant du demandeur.

  - #### Libelle
La table LIBELLE comporte tous les libellés pouvant être assignés à un ticket.

  - #### EtatTicket
La table ETAT-TICKET comporte tous les états pouvant être assignés à un ticket.

  - ### RoleUser
La table ROLE-USER comporte tous les rôles pouvant être assignés à un utilisateur.

  - #### RelationTicketsLibellés
Table qui permet de faire une jointure entre deux tables. Des informations peuvent compléter la jointure.

  - #### UrgenceTicket
La table URGENCE-TICKET regroupe l'ensemble des niveaux d'urgences pouvant être attribué à un ticket.


Description de la table

- ### III - Les attributs des tables

  - #### Utilisateur
    - **ID_USER** [INT] : Primary key, autoincrement
    - **LOGIN_USER** [VARCHAR 20] : UNIQUE, CHECK Taille >= 5
    - **PRENOM_USER** [VARCHAR 30]
    - **NOM_USER** [VARCHAR 30]
    - **ROLE_USER** [VARCHAR 30] : foreign key (NOM_ROLE-USER, RoleUser)
    - **EMAIL_USER** [VARCHAR 100] : CHECK (email_colonne ~* '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,4}$'
    - **HORODATAGE_OUVERTURE_USER** [DATETIME]
    - **HORODATAGE_DERNIERE_CONNECTION_USER** [DATETIME]
    - **IP_DERNIERE_CONNECTION_USER** [VARCHAR]

  - #### Ticket
    - **ID_TICKET** [INT] : Primary key, autoincrement
    - **ID_USER** [INT] : foreign key (ID_USER - Utilisateur)
    - **OBJET_TICKET** [VARCHAR 100]
    - **DESCRIPTION_TICKET** [VARCHAR 250]
    - **ID_TECHNICIEN** [INT] : foreign key (ID_USER - Utilisateur), default (NULL)
    - **NIV_URGENCE_ESTIMER_TICKET** [VARCHAR 15] : foreign key (VALEUR_URGENCE_TICKET) - UrgenceTicket), default (Non précisé !)
    - **NIV_URGENCE_DEFINITIF_TICKET** [VARCHAR 15] : foreign key (VALEUR_URGENCE_TICKET) - UrgenceTicket), default (Non précisé !)
    - **ETAT_TICKET** [VARCHAR 30] : foreign key (ETAT - EtatTicket), default (en_attente)
    - **HORODATAGE_CREATION_TICKET** [DATETIME]
    - **HORODATAGE_DEBUT_TRAITEMENT_TICKET** [DATETIME]
    - **HORODATAGE_RESOLUTION_TICKET** [DATETIME]
    - **HORODATAGE_DERNIERE_MODIF_TICKET** [DATETIME]

  - ### Libelle
    - **NOM_LIBELLE** [VARCHAR 50] : primary key

  - ### EtatTicket
    - **VALEUR_ETAT_TICKET** [VARCHAR 30] : primary key : primary key // valeurs qui seront stockées : en attente, ouverte, en cours de traitement, fermé

  - ### RoleUser
    - **NOM_ROLE-USER** [VARCHAR 30] : primary key // valeurs qui seront stockées : utilisateur, admin_web, admin_sys, technicien, missingno

  - ### RelationTicketsLibellés
    - **ID_TICKET** [INT] : primary key, foreign key (ID_TICKET - Ticket)
    - **NOM_LIBELLE** [VARCHAR 50] : primary key, foreign key (NOM_LIBELLE - Libelle)

  - ### UrgenceTicket
    - **VALEUR_URGENCE_TICKET** [VARCHAR 15] : primary key

- ### IV - Les utilisateurs MySQL
  - un administrateur système
    - S'occupe du site plutôt journaux d'activité
  - un administrateur web
    - S'occupe des utilisateurs et des tickets
  - un ou des techniciens
    - Ceux qui réparent les pannes, ils consultent les tickets et se les attributs
  - un utilisateur inscrit
    - L'utilisateur de la plateforme, connecté et pouvant posté des tickets
  - un visiteur
    - Celui qui consulte l'application sans avoir de compte (ou en étant déconnecté)
  - # Marquer ici les profils MariaDB pour le site
  - fictif_connexionDB [POUR FONCTIONNEMENT SITE WEB UNIQUEMENT]:
    - Profil dédié à récupérer l'identifiant de l'utilisateur à partir du login et d'autres actions liés à la connexion d'un utilisateur.
  - fictif_insertionDB [POUR FONCTIONNEMENT SITE WEB UNIQUEMENT]:
    - Profil dédié à insérer les données de l'utilisateur au moment de l'inscription dans la base de données et de donner les droits à chaque utilisateur MariaDB.
  - fictif_sélectionDB [POUR FONCTIONNEMENT SITE WEB UNIQUEMENT]:
    - Profil dédié à récupérer le rôle de l'utilisateur pour afficher ce qu'il doit voir.
  - fictif_updateDB [POUR FONCTIONNEMENT SITE WEB UNIQUEMENT]:
    - Profil dédié à modifier l'horodatage et l'ip de dernière connexion du compte connecter.



- ### V - Les vues

  - #### vue_Utilisateur_visiteur
    Permet au visiteur de voir les pseudos des utilisateurs de la plateforme
  - #### vue_Ticket_visiteur
    Permet au visiteur d'avoir les infos des tickets crées dans la plateforme
  - #### vue_Utilisateur_client
    Permet à l'utilisateur d'avoir accès à ses données personnelles
  - #### vue_Utilisateur_insertion_client
    Permet à l'utilisateur de pouvoir modifier leurs adresses email
  - #### vue_Ticket_client
    Permet à l'utilisateur d'avoir accès à leur ticket
  - #### vue_Ticket_insertion_client
    Permet à l'utilisateur de modifier les tickets qu'ils ont créés
  - #### vue_RelationTicket_client
    Permet à l'utilisateur d'avoir accès aux libellés
  - #### vue_Ticket_technicien
    Permet au technicien d'avoir l'état et le technicien associé au ticket
  - #### vue_etat_update_admWeb
    Permet à l'administrateur web d'avoir l'état du ticket, le niveau d'urgence définitif du ticket 

- ### VI - Les vues des users fictifs

  - #### vue_UserFictif_connexionDB1
    Vue n°1 pour le profil MariaDB dédié à la connexion. Cette vue montre uniquement les colonnes login et ID_USER.
  - #### vue_UserFictif_insertionDB1
    Vue n°2 pour le profil MariaDB dédié à l'inscription. Cette vue permettra d'ajouter les données dans la table 
    utilisateur quand les données seront ajouter
  - #### vue_UserFictif_selectionDB1
    Vue n°3 pour le profil MariaDB dédié à la récupération des données des utilisateur utile pour la vérification. 
    Cette vue montre tout les informations d'un utilisateur.
  - #### vue_UserFictif_updateDB1
    Vue n°4 pour le profil MariaDB dédié à la modification de l'horodatage et l'ip de dernière connexion. 
    Cette vue montre uniquement les colonnes ID_USER, HORODATAGE_DERNIERE_CONNECTION_USER et IP_DERNIERE_CONNECTION_USER.
    
  - #### vue_UserFictif_insertionTicketDB1
    Vue n°5 pour le profil MariaDB dédié à l'inscription.
    Cette vue permettra d'ajouter les données dans la table Ticket quand les données seront ajouter
  - #### vue_UserFictif_selectionTicketDB1
    Vue n°6 pour le profil MariaDB dédié à la récupération des données des utilisateur utile pour la vérification. 
    Cette vue montre tout les informations d'un ticket.
  - #### vue_UserFictif_updateTicketDB1
    Vue n°7 pour le profil MariaDB dédié à la modification de l'horodatage et l'ip de dernière connexion. 
    Cette vue montre uniquement les colonnes ID_USER, HORODATAGE_DERNIERE_CONNECTION_USER et IP_DERNIERE_CONNECTION_USER.

- ### VII - Les rôles

Nous avons créer différents rôles pour permettre au utilisateur d'avoir les droits qui leur sont suffisant.
Les différents rôles que nous avons créer sont le rôle utilisateur, techncien, admin web et admin sys.
