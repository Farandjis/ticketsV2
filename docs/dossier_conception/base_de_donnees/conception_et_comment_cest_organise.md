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

<br><br><br><br><br><br><br>

---------

- ### <a name="p2"></a> I - Analyse
  Nous avons besoin d'une base de données capable de stocker les différentes données concernant les utilisateurs et les différents tickets.<br>
  Cette base des données permet de joindre les différents tickets à leurs créateurs et à leurs techniciens associés.<br>
  Celle-ci doit être sécurisé, elle ne doit pas permettre l'accès ou la modification non autorisée.
  Ainsi, un utilisateur ne doit pouvoir accéder uniquement aux données publiques et à ses données personnelles, et non aux données personnelles des autres utilisateurs.<br>
  En cela, il est nécessaire de mettre en place des vues ainsi que la création d'utilisateurs sur la base de données.<br>


- ### <a name="p2"></a> II - Les tables
  - #### Utilisateur
    La table UTILISATEUR comporte toute les données liés aux utilisateurs, et aux comptes des utilisateurs.

  - #### Ticket
    La table TICKET comporte tous les tickets de la plateforme et leurs informations. Ceux en attente de validation par l’administrateur comme ceux en cours de traitement ou encore ceux qui ont été résolu.<br>
    Un ticket possède un identifiant unique et possède l'identifiant du demandeur.

  - #### Libelle
    La table LIBELLE comporte tous les libellés pouvant être assignés à un ticket.

  - #### EtatTicket
    La table ETAT-TICKET comporte tous les états pouvant être assignés à un ticket

  - ### RoleUser
    La table ROLE-USER comporte tous les rôles pouvant être assignés à un utilisateur

  - #### RelationTicketsLibellés
    Tables qui permettent de faire une jointure entre deux tables. Des informations peuvent compléter la jointure.

Description de la table

- ### <a name="p2"></a> III - Les attributs des tables

  - #### Utilisateur
    - **ID_USER**                                  [INT] : Primary key, autoincrement 
    - **LOGIN_USER**                               [VARCHAR 20] : UNIQUE, CHECK Taille >= 5
    - **PRENOM_USER**                              [VARCHAR 30]
    - **NOM_USER**                                 [VARCHAR 30]
    - **ROLE_USER**                                [VARCHAR 30] : foreign key (NOM_ROLE-USER, RoleUser)
    - **EMAIL_USER**                               [VARCHAR 100] : CHECK (email_colonne ~* '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,4}$'
    - **HORODATAGE_OUVERTURE_USER**                [DATETIME]
    - **HORODATAGE_DERNIERE_CONNECTION_USER**      [DATETIME]
    - **IP_DERNIERE_CONNECTION_USER**              [VARCHAR]

  - #### Ticket
    - **ID_TICKET**                                [INT] : Primary key, autoincrement
    - **ID_USER**                                  [INT] : foreign key (ID_USER - Utilisateur)
    - **OBJET_TICKET**                             [VARCHAR 100]
    - **DESCRIPTION_TICKET**                       [VARCHAR 250]
    - **ID_TECHNICIEN**                            [INT] : foreign key (ID_USER - Utilisateur), default (NULL)
    - **NIV_URGENCE_ESTIMER_TICKET**               [VARCHAR 50]
    - **NIV_URGENCE_DEFINITIF_TICKET**             [VARCHAR 50]
    - **ETAT_TICKET**                              [VARCHAR 30] : foreign key (ETAT - EtatTicket), default (en_attente)
    - **HORODATAGE_CREATION_TICKET**               [DATETIME]
    - **HORODATAGE_DEBUT_TRAITEMENT_TICKET**       [DATETIME]
    - **HORODATAGE_RESOLUTION_TICKET**             [DATETIME]
    - **HORODATAGE_DERNIERE_MODIF_TICKET**         [DATETIME]

  - ### Libelle
    - **NOM_LIBELLE**                              [VARCHAR 50] : primary key

  - ### EtatTicket
    - **VALEUR_ETAT-TICKET**                       [VARCHAR 30] : primary key : primary key   // valeurs qui seront stockés : en attente, ouvert, en cours de traitement, fermé

  - ### RoleUser
    - **NOM_ROLE-USER**                            [VARCHAR 30] : primary key   // valeurs qui seront stockés : utilisateur, admin_web, admin_sys, technicien, missingno

  - ### RelationTicketsLibellés
    - **ID_TICKET**                                [INT] : primary key, foreign key (ID_TICKET - Ticket)
    - **NOM_LIBELLE**                              [VARCHAR 50] : primary key, foreign key (NOM_LIBELLE - Libelle)

- ### <a name="p3"></a> IV - Les utilisateurs MySQL
  - un administrateur système
  - un administrateur web
  - un ou des techniciens
  - un utilisateur inscrit
  - un visiteur

- ### <a name="p4"></a> V - Les vues
  - #### vue_Utilisateur_visiteur
    Permet au visiteur de voir les pseudo des utilisateur de la plateforme
  - #### vue_Ticket_visiteur
    Permet au visiteur d'avoir les infos des tickets crée dans la plateforme
  - #### vue_Utilisateur_client
    Permet au utilisateur d'avoir accès à ces données personnelles
  - #### vue_Utilisateur_insertion_client
    Permet au utilisateur de pouvoir modifier leurs adresses email    
  - #### vue_Ticket_client
    Permet au utilisateur d'avoir accès à leur ticket
  - #### vue_Ticket_insertion_client
    Permet au utilisateur de modifier les tickets qu'ils ont créé
  - #### vue_RelationTicket_client
    Permet au utilisateur d'avoir accès au libellé
  - #### vue_Ticket_technicien
    Permet au technicien d'avoir l'état et le technicien associé au ticket
  - #### vue_etat_update_admWeb
    Permet à l'administrateur web d'avoir l'état du ticket, le niveau d'urgence définitif du ticket  