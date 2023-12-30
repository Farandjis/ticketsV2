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

- ### [IV - Les vues]()
  - Pour chaque type d'utilisateur
  - Nom de la vue
  - Description de la vue
  - Ce qu'elle fait

- ### [V - Les rôles et utilisateurs MariaDB]()
  - Pour chaque type d'utilisateur MySQL
  - Nom du type d'utilisateur
  - Description de l'utilisateur
  - Ses droits

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



- ### V - Les rôles et utilisateurs MariaDB
  - Rôle Utilisateur `role_utilisateur`
    - **Présentation**
      - Est une personne inscrite sur la plateforme et ayant le droit d'y accéder et de l'utiliser.
    - **Actions**
      - Peut consulter ses informations personnelles.
      - Peut se connecter, se déconnecter, supprimer son compte.
      - Peut changer son mot de passe et son adresse email.
      - Peut créer un ticket.
      - Peut modifier son ticket s'il est encore dans l'état "En attente" de la validation.
      - Peut consulter l'ensemble de ses tickets, y compris ceux fermés.
      - Peut avoir un aperçu des tickets en cours de traitement ou ouvert des autres utilisateurs.
      - Ne peut voir que le nom, prénom et adresse email des autres utilisateurs que s'ils sont techniciens. 
    - **Droits**
      - SELECT
        - DB_TIX.vue_Utilisateur_client
        - DB_TIX.vue_Ticket_client
        - DB_TIX.MotcleTicket
        - DB_TIX.vue_tableau_bord
        - DB_TIX.vue_tdb_relation_ticket_motcle
        - (ID_TICKET) DB_TIX.vue_modif_creation_ticket_utilisateur
        - DB_TIX.vue_suppr_rtm_tdb
        - DB_TIX.vue_technicien
      - INSERT
        - (TITRE_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET) DB_TIX.vue_modif_creation_ticket_utilisateur
        - DB_TIX.RelationTicketsMotscles
      - UPDATE
        - (EMAIL_USER) ON DB_TIX.vue_Utilisateur_maj_email
        - (TITRE_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET) DB_TIX.vue_modif_creation_ticket_utilisateur
      - DELETE
        - DB_TIX.vue_suppr_rtm_tdb
  - Rôle technicien `role_technicien`
    - **Présentation**
      - Est un utilisateur capable de prendre en charge un ticket (se l'attribuer) afin de le modifier et de fermer.
    - **Actions**
      - Possède les droits d'un utilisateur.
      - Peut s'attribuer un ticket ouvert.
      - Peut modifier un ticket dont il en a la charge (donc en cours de traitement).
      - Peut fermer un ticket (si le problème a été résolu).
      - Peut avoir accès au prénom, nom et adresse email du créateur du ticket.
    - **Droits**
      - SELECT
        - (ID_TICKET) vue_modif_ticket_adm_tech
        - (ID_TICKET) vue_associe_ticket_tech
      - UPDATE
        - (TITRE_TICKET, DESCRIPTION_TICKET) vue_modif_ticket_adm_tech
        - (ID_TECHNICIEN) vue_associe_ticket_tech
  - Rôle technicien `role_admin_web`
    - **Présentation**
      - Est un utilisateur capable de gérer les tickets et les utilisateurs ainsi que de valider un ticket en attente,
    - **Actions**
      - Possède les droits d'un utilisateur excepté :
        - Ne peut pas supprimer son compte
      - Peut attribuer un ticket à un technicien
      - Peut changer de technicien la prise en charge d'un ticket
      - Peut modifier à tout moment n'importe quel ticket tant qu'il n'est pas fermé.
      - Peut ajouter et supprimer des mots-clés
      - Peut ajouter et supprimer des titres
      - Peut définir un utilisateur comme technicien
      - Peut redéfinir un technicien comme utilisateur
      - A accès aux prénoms, noms et adresse email de tout le monde
    - **Droits**
      - SELECT
        - (ID_TICKET) vue_modif_ticket_adm_tech
        - affiche_utilisateurs_pour_adm_web
      - INSERT
        - DB_TIX.MotcleTicket
        - DB_TIX.RelationTicketsMotscles
      - DELETE
        - DB_TIX.MotcleTicket
        - DB_TIX.RelationTicketsMotscles
  - Rôle administrateur système `role_admin_sys`
    - **Présentation**
      - Est un utilisateur capable d'accéder au journal d'activité de la plateforme et de suivre l'activité de connexion des utilisateurs.
    - **Actions**
      - Possède les droits d'un utilisateur excepté :
        - Ne peut pas supprimer son compte
      - Peut voir l'historique des tickets (les tickets fermés)
      - Peut voir les informations de connexions des utilisateurs (date de création du compte, dernière connexion et IP dernière connexion)
      - Peut voir l'activité sur la plateforme (journal d'activité)
    - **Droits**
      - SELECT
        - vue_historique
        - vue_historique_relation_ticket_motcle
        - ...
    






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