Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Conception base de données (version 2)

<br><br>
Ce document décrit la base de données. Comme ses tables, ses vues ou encore ses utilisateurs et leurs droits.<br>
Ce document est complété par les différents diagrammes montrant la mise en relations des différents éléments entre eux.
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
  
  Cette base des données permet de joindre les différents tickets à leur créateur et à leur technicien associé.
  
  Celle-ci doit être sécurisée, elle ne doit pas permettre l'accès ou la modification non autorisée.
  Ainsi, un utilisateur ne doit pouvoir accéder uniquement aux données publiques et à ses données personnelles, et non aux données personnelles des autres utilisateurs.
  
  En cela, il est nécessaire de mettre en place des vues ainsi que la création d'utilisateurs sur la base de données.



- ### II - Les tables
  - #### Utilisateur
    La table UTILISATEUR comporte toutes les données liées aux utilisateurs et à leur compte.

  - #### Ticket
    La table TICKET comporte tous les tickets de la plateforme avec leur description complète et les informations relatives à leurs gestions.

  - #### TitreTicket
    La table TITRETICKET comporte tous les titres pouvant être assignés à un ticket.

  - #### EtatTicket
    La table ETATTICKET comporte tous les états pouvant être assignés à un ticket.

  - #### UrgenceTicket
    La table URGENCE-TICKET regroupe l'ensemble des niveaux d'urgences pouvant être attribué à un ticket.

  - #### MotcleTicket
    La table MOTCLETICKET comporte tous les mots-clés pouvant être associés à un ticket.

  - #### RelationTicketMotscles
    La table RELATIONTICKETMOTSCLES permet de faire le lien entre les mots-clés et les tickets.



- ### III - Les attributs des tables

  - #### Utilisateur
    - **ID_USER** [INT 11] : Primary key, autoincrement
    - **LOGIN_USER** [VARCHAR 20] : UNIQUE, CHECK Taille >= 5
    - **PRENOM_USER** [VARCHAR 30] : CHECK caractères autorisés : majuscules, minuscules, accents, tirets
      - En SQL : `CHECK (PRENOM_USER REGEXP '^[A-Za-zÀ-ÖØ-öø-ÿ\\-]+$')`
    - **NOM_USER** [VARCHAR 30] : CHECK caractères autorisés : majuscules, minuscules, accents, tirets, espaces
      - En SQL : `CHECK (NOM_USER REGEXP '^[A-Za-zÀ-ÖØ-öø-ÿ\-\\s]+$')`
      - `^` -> début, `$` -> fin
      - `A-Za-z` -> lettres majuscules et minuscules
      - `À-ÖØ-öø-ÿ` -> lettres accentuées majuscules et minuscules
      - `\\-` -> tiret, `\\s` -> espace
    - **EMAIL_USER** [VARCHAR 100] : CHECK (email_colonne ~* '^[A-Za-z0-9._%-]+@[A-Za-z.-]+\\.[A-Za-z]{2,4}$'
      - `^[A-Za-z0-9._%-]+@` -> Lettres majuscules ou minuscules non accentuées, chiffres, points, tirets du bas et pourcentages acceptés entre le début et l'arobase (ex : `al..ice_DU-%78@`)
      - `@[A-Za-z.-]+\\.` -> Lettres majuscules ou minuscules non accentuées, points acceptés entre l'arobase et le point (ex : `@moi..Ens-uvsq.`)
      - `\\.[A-Za-z]{2,4}$` -> 2 à 4 lettres majuscules ou minuscules non accentuées comprises entre le point et la fin (ex : `.Com`)
      - Une adresse email comme `al..ice_DU-%78@moi..Ens-uvsq.cOm` serait donc accepté par la base de données. À noter que côté code php, un caractère doit obligatoirement séparer deux points.
    - **HORODATAGE_OUVERTURE_USER** [DATETIME] : DEFAULT CURRENT_TIMESTAMP NOT NULL
    - **HORODATAGE_DERNIERE_CONNECTION_USER** [DATETIME] : DEFAULT CURRENT_TIMESTAMP NOT NULL
    - **IP_DERNIERE_CONNECTION_USER** [VARCHAR 15]

  - #### Ticket
    - **ID_TICKET** [INT 11] : Primary key, autoincrement
    - **ID_USER** [INT 11] : foreign key (Utilisateur.ID_USER), NOT NULL, DEFAULT (SUBSTRING_INDEX(USER(),'@',1))
      - Par défaut, l'utilisateur exécutant la requête est le créateur du ticket ex : utilisateur "3" si c'est 3@localhost (on récupère que le nom avant l'arobase). 
    - **TITRE_TICKET** [VARCHAR 60] foreign key (TitreTicket.TITRE_TICKET) NOT NULL
    - **DESCRIPTION_TICKET** [VARCHAR 250] NOT NULL
    - **ID_TECHNICIEN** [INT] : foreign key (Utilisateur.ID_USER), default (NULL)
    - **NIV_URGENCE_ESTIMER_TICKET** [VARCHAR 15] : foreign key (UrgenceTicket.VALEUR_URGENCE_TICKET), default (Non complété !), NOT NULL
    - **NIV_URGENCE_DEFINITIF_TICKET** [VARCHAR 15] : foreign key (UrgenceTicket.VALEUR_URGENCE_TICKET), default (Non complété !)
    - **ETAT_TICKET** [VARCHAR 30] : foreign key (EtatTicket.VALEUR_ETAT_TICKET), default (En attente)
    - **HORODATAGE_CREATION_TICKET** [DATETIME], DEFAULT CURRENT_TIMESTAMP NOT NULL,
    - **HORODATAGE_DEBUT_TRAITEMENT_TICKET** [DATETIME]
    - **HORODATAGE_RESOLUTION_TICKET** [DATETIME]
    - **HORODATAGE_DERNIERE_MODIF_TICKET** [DATETIME] DEFAULT CURRENT_TIMESTAMP NOT NULL

  - ### TitreTicket
    - **TitreTicket** [VARCHAR 60] Primary Key

  - ### EtatTicket
    - **VALEUR_ETAT_TICKET** [VARCHAR 30] : primary key // valeurs qui seront stockées : En attente, Ouvert, En cours de traitement, Fermé

  - ### UrgenceTicket
    - **VALEUR_URGENCE_TICKET** [VARCHAR 15] : primary key

  - ### MotcleTicket
    - **NOM_MOTCLE** [VARCHAR 30] : primary key

  - ### RelationTicketsMotscles
    - **ID_TICKET** [INT] : primary key, foreign key (Ticket.ID_TICKET) NOT NULL
    - **NOM_MOTCLE** [VARCHAR 30] : primary key, foreign key (MotcleTicket.NOM_MOTCLE) NOT NULL
