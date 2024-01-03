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

- ### [III - Les attributs des tables](#p3)
  - Pour chaque table
    - Nom de la table 
    - Liste de ses attributs
    - Options des attributs (clées primaire...)

- ### [IV - Les vues](#p4)
  - Pour chaque vue
    - Nom de la vue
    - Présentation de la vue
    - Description de ses attributs, jointure
    - Comportement par rapport aux rôles, aux utilisateurs

- ### [V - Les Fonctions](#p5)
  - Pour chaque fonction
    - Nom
    - Valeurs renvoyés
    - Fonctionnement
    - Effets sur la base de données
    
- ### [VI - Les Procédures](#p6)
  - Pour chaque procédure
    - Nom
    - Fonctionnement
    - Effets sur la base de données
    
- ### [VII - Les Déclencheurs](#p7)
  - Pour chaque déclencheur
    - Nom
    - Moment du déclenchement
    - Fonctionnement
    - Effets sur la base de données

- ### [VIII - Les Évènements](#p8)
  - Pour chaque évènement
    - Nom
    - Date et heure de l'exécution
    - Fonctionnement
    - Effets sur la base de données
    
- ### [IX - Les rôles et utilisateurs fictifs MariaDB](#p9)
  - Pour chaque Rôle, Utilisateur Fictif
    - Nom
    - Présentation
    - Actions
    - Droits


---------

## <a name="p1"></a> I - Analyse
  Nous avons besoin d'une base de données capable de stocker les différentes données concernant les utilisateurs et les différents tickets.
  
  Cette base des données permet de joindre les différents tickets à leur créateur et à leur technicien associé.
  
  Celle-ci doit être sécurisée, elle ne doit pas permettre l'accès ou la modification non autorisée.
  Ainsi, un utilisateur ne doit pouvoir accéder uniquement aux données publiques et à ses données personnelles, et non aux données personnelles des autres utilisateurs.
  
  En cela, il est nécessaire de mettre en place des vues ainsi que la création d'utilisateurs sur la base de données.



## <a name="p2"></a> II - Les tables
  - ### Utilisateur
    La table UTILISATEUR comporte toutes les données liées aux utilisateurs et à leur compte.

  - ### Ticket
    La table TICKET comporte tous les tickets de la plateforme avec leur description complète et les informations relatives à leurs gestions.

  - ### TitreTicket
    La table TITRETICKET comporte tous les titres pouvant être assignés à un ticket.

  - ### EtatTicket
    La table ETATTICKET comporte tous les états pouvant être assignés à un ticket.

  - ### UrgenceTicket
    La table URGENCE-TICKET regroupe l'ensemble des niveaux d'urgences pouvant être attribué à un ticket.

  - ### MotcleTicket
    La table MOTCLETICKET comporte tous les mots-clés pouvant être associés à un ticket.

  - ### RelationTicketMotscles
    La table RELATIONTICKETMOTSCLES permet de faire le lien entre les mots-clés et les tickets.



## <a name="p3"></a> III - Les attributs des tables

  - ### Utilisateur
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

  - ### Ticket
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



## <a name="p4"></a> IV - Les vues
  - ### vue_Ticket_visiteur
    Permet au visiteur de voir les 10 derniers tickets postés sur la plateforme (tous sauf ceux en attente)
    - Sélectionne les 10 derniers tickets(ID_TICKET, TITRE_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_DEFINITIF_TICKET, ETAT_TICKET, HORODATAGE_CREATION_TICKET)
    - Triés par HORODATAGE_CREATION_TICKET DESC
    - Qui ne sont pas en attente
    
  - ### vue_Utilisateur_client
    Permet à l'utilisateur d'avoir accès à ses données personnelles
    - Sélectionne ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, EMAIL_USER de la table Utilisateur
    - Sélectionne default_role de la vue user de la DB MySQL -> Jointure user.User = DB_TIX.Utilisateur.ID_USER
    - Où ID_USER correspond à l'utilisateur qui exécute le SELECT (SUBSTRING_INDEX(USER(), '@', 1))
    
  - ### vue_Utilisateur_maj_email
    Permet à l'utilisateur de pouvoir modifier leurs adresses email
    - Sélectionne l'ID_USER et EMAIL_USER de la table Utilisateur
    - Où ID_USER correspond à l'utilisateur qui exécute le SELECT (SUBSTRING_INDEX(USER(), '@', 1))
    
  - ### vue_Ticket_client
    Permet à l'utilisateur de voir tous leurs tickets qu'ils soient en attentes, ouverts, en cours ou fermés.
    - Sélectionne ID_TICKET, TITRE_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET, NIV_URGENCE_DEFINITIF_TICKET,
      ETAT_TICKET, HORODATAGE_CREATION_TICKET, HORODATAGE_DEBUT_TRAITEMENT_TICKET, HORODATAGE_RESOLUTION_TICKET de Ticket
    - Trié par ID_TICKET DESC
    - Où ID_USER des tickets correspond à l'utilisateur qui exécute le SELECT (SUBSTRING_INDEX(USER(), '@', 1))
    
  - ### vue_technicien
    Liste les techniciens de la plateforme
    - Sélectionne ID_USER, PRENOM_USER, NOM_USER, EMAIL_USER de la table Utilisateur
    - Où mysql.user.default_role = "role_technicien" -> JOIN mysql.user ON mysql.user.User = ID_USER
    
  - ### affiche_utilisateurs_pour_adm_web
    Liste tous les utilisateurs de la plateforme
    - Sélectionne ID_USER, PRENOM_USER, NOM_USER de la table Utilisateur
    - Où LOGIN_USER n'est pas nul
    
  - ### vue_tableau_bord
    Les tickets affichés dans le tableau de bord de l'usager. Le contenu de la vue varie en fonction de l'utilisateur, et du rôle de l'utilisateur.<br>
    Vu que la vue utilise des jointures, on ne peut pas préciser les attributs accessibles via SELECT.<br>
    Les rôles admins et techs possèdent déjà les droits d'un utilisateur. Ils n'ont juste que des permissions un peu plus poussées.
    Pour limiter l'accès aux données, il faut remplacer la valeur de la case par "ACCÈS INTERDIT". La personne a bien accès à l'attribut, mais pas à la donnée.
    - Utilisateur 
      - SELECT Ticket pour les utilisateurs (tableau de bord)
      - Tickets : -> ID Ticket, Titre Ticket, Description Ticket, Urgence Definitif, Etat Ticket, Horodatage création, horodatage modification
      - (1) Utilisateurs : -> Prénom, nom et adresse email du technicien
      - (2) Utilisateurs : Nom, prénom et adresse email de créateur, uniquement si l'utilisateur est le créateur de ce ticket
      - Affiche uniquement tous les tickets ouverts et en cours <br>
        -> Valeurs "Ouvert" et "En cours de traitement"
      - Affiche ses propres tickets en attente en plus

    - Technicien
      - SELECT Ticket pour les techniciens (tableau de bord)
      - Tickets : -> ID Ticket, Titre Ticket, Description Ticket, Urgence Definitif, Etat Ticket, Horodatage création, Horodatage modification
      - Utilisateurs : -> Prénom, nom et adresse email du technicien, ID Technicien, ID Créateur, Prénom et nom du créateur, email du créateur
      - Affiche uniquement les tickets ouverts et en cours <br>
        -> Valeurs "Ouvert" et "En cours de traitement"
      - Affiche ses propres tickets en attente

    - Administrateur Web
      - SELECT Ticket pour l'admin web (tableau de bord)
      - Tickets : -> ID Ticket, Titre Ticket, Description Ticket, Urgence Definitif, Etat Ticket, Horodatage création, Horodatage modification
      - Utilisateurs : -> Prénom, nom et adresse email du technicien, ID Technicien, ID Créateur, Prénom et nom du créateur, email du créateur
      - Affiche uniquement les tickets ouverts, en cours et en attente <br>
        -> Valeurs "Ouvert" et "En cours de traitement", "En attente"

  - ### vue_tdb_relation_ticket_motcle
    Les mots clés associés aux tickets du tableau de bord de l'usager. Le contenu de la vue varie en fonction des tickets disponibles dans la vue tableau de bord.
    - RelationTicketsMotscles : *
    - Où les tickets sont présents dans le tableau de bord

  - ### vue_suppr_rtm_tdb
    Permet la suppression des mots clés associés aux tickets du tableau de bord de l'usager, s'il a le droit de modifier son ticket bien sur
    - DELETE Ticket pour l'utilisateur
    - Ticket : RTM.ID_TICKET, RTM.NOM_MOTCLE
    - Où le ticket est présent dans le tableau de bord
      - Soit le ticket en attente
      - Soit l'utilisateur MariaDB est un admin web ou bien le technicien affecté au ticket

  - ### vue_modif_creation_ticket_utilisateur
    Permet la création d'un ticket ainsi que sa modification s'il est en attente (modification uniquement des valeurs du formulaire de création de ticket)
    - UPDATE, INSERT Ticket pour l'utilisateur (modif/création ticket 1/2)
    - Ticket : titre ticket, description ticket, urgence ticket estimé
    - Ticket : ID Ticket (Select uniquement)
    - Comporte uniquement ses tickets en attente
    -> Valeurs "En attente"
    -> Note : ce sont tous les tickets en attente de son tableau de bord (donc tous ses tickets en attente de la BD en général)
    
  - ### vue_modif_ticket_adm_tech
    Permet la modification avancée d'un ticket pour un technicien ou l'administrateur web
    - Technicien
      - Ticket : ID Ticket, Titre ticket, description ticket, ID Technicien
      - SELECT : ID Ticket
      - UPDATE Titre ticket, description ticket
      - Comporte uniquement les tickets en cours de son tableau de bord et qu'il traite
      -> Valeur "En cours de traitement" 

    - Administrateur Web
      - Ticket : ID Ticket, Titre ticket, description ticket, ID Technicien, urgence def
      - SELECT : ID Ticket
      - UPDATE Titre ticket, description ticket, urgence def
       - Tous les tickets non fermés de son tableau de bord
      
  - ### vue_associe_ticket_tech
    Permet à un technicien de s'attribuer un ticket ouvert
    - Ticket : ID_TICKET, ID_TECHNICIEN
    - S'ils sont ouvert
    
  - ### vue_historique
    Liste tous les tickets fermés de la plateforme
    - Ticket T : T.ID_TICKET, T.TITRE_TICKET, T.DESCRIPTION_TICKET, T.NIV_URGENCE_DEFINITIF_TICKET, T.ETAT_TICKET, T.HORODATAGE_CREATION_TICKET, T.HORODATAGE_DERNIERE_MODIF_TICKET, T.ID_TECHNICIEN, T.ID_USER
    - Utilisateur CREA : CREA.PRENOM_USER, CREA.NOM_USER --- Join
    - Utilisateur TECH : PRENOM_TECH, NOM_TECH  --- left outer join
    - Si les tickets sont fermés
    
  - ### vue_historique_relation_ticket_motcle
    Les mots clés associés aux tickets de l'historique
    - RelationTicketsMotscles : RTM.ID_TICKET, RTM.NOM_MOTCLE
    - S'il est dans l'historique
    
  - ### UserFictif_connexion
    Liste tous les identifiants ID USER et les logins pour l'Utilisateur Fictif connexion
    - Utilisateur : ID_USER, LOGIN_USER
    - Si LOGIN_USER n'est pas null

  - ### UserFictif_inscription
    Permet l'insertion d'un utilisateur dans la table Utilisateur pour UF inscription
    - Utilisateur : ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, EMAIL_USER
    - Attention ! La vue ne permet pas de définir un ID_USER.
    
  - ### UserFictif_maj_derniere_co
    Permet la mise à jour des informations de connexion de la table Utilisateur pour UF connexion
    - Utilisateur : ID_USER, HORODATAGE_DERNIERE_CONNECTION_USER, IP_DERNIERE_CONNECTION_USER



## <a name="p5"></a> V - Les Fonctions
  - ### ObtenirRoleUtilisateur() RETURNS LONGTEXT
    Renvoi le rôle de l'utilisateur MariaDB appelant la fonction
    - L'utilisateur MariaDB doit être un utilisateur, technicien, admin web ou admin système de TIX.
    - Renvoi la valeur ROLE_USER de la vue vue_Utilisateur_client
    
  - ### verifier_id_ticket_dans_vue_tdb(id_ticket_param INT) RETURNS INT
    Fonction qui vérifie qu'un ticket est présent dans le tableau de bord de l'utilisateur
    - Le ticket doit être dans vue_tableau_bord
    - Renvoi 1 s'il est présent
    - Renvoi 0 sinon
    
  - ### recup_etat_ticket_tdb(id_ticket_param INT) RETURNS VARCHAR(30)
    Fonction qui récupère du tableau de bord l'état d'un ticket demandé par l'utilisateur
    - Le ticket doit être dans vue_tableau_bord
    - Renvoi l'état du ticket du tableau de bord demandé
    
  - ### FermerUnTicket(id_ticket_param INT) RETURNS BOOLEAN
    Fonction qui ferme un ticket (une demande de dépannage)
    - Le ticket doit être dans vue_modif_ticket_adm_tech
    - Renvoi True s'il a pu changer l'état du Ticket en fermé
    - Renvoi False sinon



## <a name="p6"></a> VI - Les Procédures

  - ### ATTENTION_SupprimerSonCompte()
    Supprime un compte TIX et l'utilisateur MariaDB associé
    - L'utilisateur à supprimer est soit un utilisateur, soit un technicien obligatoirement
    - Début de la transaction
    - On retire les données personnel de l'utilisateur de la liste des utilisateurs de la plateforme TIX.
      - login -> NULL, prénom -> 'Utilisateur', nom -> 'SUPPRIMÉ', email -> 'supprimer@tix.fr'
      - HORODATAGE_DERNIERE_CONNECTION_USER -> date et heure de la suppressin du compte
    - On retire l'intégralité des droits au compte MariaDB de l'utilisateur
    - On supprime le compte MariaDB.
    - Validation de la transaction

  - ### ATTENTION_SupprimerTousLesComptesInutilises()
    Procédure qui supprime tous les comptes utilisateurs et techniciens inactifs depuis au moins 36 mois.<br>
    ATTENTION ! CETTE PROCÉDURE N'UTILISE PAS ATTENTION_SupprimerSonCompte !!<br>
    Si le système de suppression de compte est modifié sur l'une des deux, il faut également le modifier sur l'autre !<br>
    - On récupère tous les identifiants des comptes qui ne se sont pas connecté depuis au moins 36 mois (et qui sont soit des utilisateurs, soit des techniciens).
    - Pour chaque utilisateur
      - Début de la transaction
      - On retire l'utilisateur de la liste des utilisateurs de la plateforme TIX.
        - login -> NULL, prénom -> 'Utilisateur', nom -> 'SUPPRIMÉ', email -> 'supprimer@tix.fr'
        - IP_DERNIERE_CONNECTION_USER -> '0.0.0.0' (car suppression automatique du compte après 36 mois)
      - On retire l'intégralité des droits au compte MariaDB de l'utilisateur.
      - On supprime le compte MariaDB.
      - Validation de la transaction
      
  - ### activerUnRoleTechOuUtiParAdminWeb(parID_USER VARCHAR(11), parLeRole VARCHAR(50))
    Créer pour l'admin web, même si n'importe qui ayant les droits de grant et ayant accès en écriture à la DB mysql peut l'utiliser.<br>
    Au préalable, la personne doit posséder le rôle à activer. Cette fonction active le rôle tech si c'est un utilisateur, utilisateur si c'est un tech.<br>
    Si c'est un tech qui devient un utilisateur, on lui supprime son rôle de technicien. Il faudra le GRANT à nouveau s'il redevient un technicien<br>
    <br>
    parID -> STRING de l'id de l'utilisateur<br>
    parLeRole -> STRING du rôle qu'on veut activer (tech ou uti)<br>
    - Si l'utilisateur possède un rôle MariaDB (mysql.user.default_role IS NOT NULL)
    - Si son rôle est utilisateur, et qu'on veut activer son nouveau rôle technicien (GRANT avant l'appel de la procédure)
      - Début transaction
      - SET DEFAULT ROLE role_technicien
      - Validation transaction
    - Si son rôle est techncien, et qu'on veut le dégrader en utilisateur (pas besoin de GRANT le rôle juste avant l'appel de la procédure)
      - Début transaction
      - SET DEFAULT ROLE role_utilisateur
      - REVOKE role_technicien
      - Validation transaction



## <a name="p7"></a> VII - Les Déclencheurs
  - ### PasseTicketAEnCours
    Si un technicien est définie, alors on passe le ticket à En cours
    - BEFORE UPDATE ON Ticket<br>
      FOR EACH ROW
    - Mettre à jour l'attribut ETAT_TICKET à "En cours de traitement" quand l'ID_TECHNICIEN change si:
      - le ticket est Ouvert
      - le ticket est En attente MAIS qu'un niveau d'urgence est indiqué dans l'update.
      
  - ### PasseTicketAOuvert
    Si l'urgence définitive est définie et que le ticket est en attente, on le passe alors à ouvert
    - BEFORE UPDATE ON Ticket<br>
      FOR EACH ROW
    - Mettre à jour l'attribut ETAT_TICKET à "En cours de traitement" si l'ID_TECHNICIEN change
    
  - ### VerifQuiCestLeTechDuTicket
    On vérifie si l'utilisateur MariaDB est autorisé à mettre à jour le technicien
    - BEFORE UPDATE ON Ticket<br>
      FOR EACH ROW
    - Si un technicien est définie et que l'utilisateur exécutant la commande c'est l'admin web ou le technicien définie,
      alors on autorise le changement de technicien, sinon, on garde comment c'était avant.
      Le technicien ne peut que s'attribuer un ticket Ouvert.
    
  - ### MajHorodatageModifTicket
    Si un changement a été effectué sur un ticket, on met à jour l'horodatage de dernière modification
    - BEFORE UPDATE ON Ticket<br>
      FOR EACH ROW
    - S'il y a un UPDATE pour une quelconque valeur d'un quelconque attribut (sauf horodatage modif), on met à jour l'horodatage modif
    
  - ### EMPECHE_modifUtilisateurQuelquesInfos
    En cas de modification de certaines infos d'un Utilisateur, on remplace les nouvelles valeurs par les anciennes pour annuler l'effet du changement
    - BEFORE UPDATE ON Utilisateur<br>
      FOR EACH ROW
    - S'il y a un changement pour : ID_USER ou HORODATAGE OUVERTURE USER
      - On annule le changement
      
  - ### EMPECHE_modifTicketQuelquesInfos
  En cas de modification de certaines infos d'un ticket, on remplace les nouvelles valeurs par les anciennes
    - BEFORE UPDATE ON Ticket<br>
      FOR EACH ROW
    - ### S'il y a un changement pour : ID_TICKET, ID_USER ou HORODATAGE_CREATION_TICKET
      - On annule le changement
    
  - ### EMPECHE_modifTicketFermer
  En cas de modification d'un ticket fermé, on remplace les nouvelles valeurs par les anciennes
  - BEFORE UPDATE ON Ticket<br>
    FOR EACH ROW
  - S'il y a un quelconque changement de valeur pour une ou plusieurs valeurs d'un ticket fermé
    - On annule le changement



## <a name="p8"></a> VIII - Les Évènements
  - ### SUPPRESSION_AUTO_COMPTES_INACTIFS
    Supprime automatiquement les comptes inactifs
    - A partir du lendemain de la création de l'évènement, à 1h du matin
    - Pour tous les jours à 1h du matin
    - Exécution de la procédure ATTENTION_SupprimerTousLesComptesInutilises()



## <a name="p9"></a> IX - Les rôles et utilisateurs MariaDB
  - ### Rôle Utilisateur `role_utilisateur`
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
        - DB_TIX.TitreTicket
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
      - PROCÉDURES
        - ATTENTION_SupprimerSonCompte
        
  - ### Rôle technicien `role_technicien`
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
      - FONCTIONS
        - FermerUnTicket
        
  - ### Rôle technicien `role_admin_web`
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
        - DB_TIX.TitreTicket
        - DB_TIX.MotcleTicket
        - DB_TIX.RelationTicketsMotscles
      - DELETE
        - DB_TIX.TitreTicket
        - DB_TIX.MotcleTicket
        - DB_TIX.RelationTicketsMotscles
      - PROCÉDURES
        - activerUnRoleTechOuUtiParAdminWeb
        
  - ### Rôle administrateur système `role_admin_sys`
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
        
  - ### Utilisateur MariaDB : Visiteur
    - **Présentation**
      - Consulte l'application sans avoir de compte (ou en étant déconnecté)
    - **Actions**
      - Ne peut que voir les 10 derniers tickets de la plateforme excepté ceux qui sont fermés
    - **Droits**
      - SELECT
        - vue_Ticket_visiteur
        
  - ### Utilisateur MariaDB : fictif_connexionDB [POUR FONCTIONNEMENT SITE WEB UNIQUEMENT]:
    - **Présentation**
      - Dédié à la connexion d'un utilisateur à la plateforme
    - **Actions**
      - Peut retrouver l'ID USER d'un utililisateur MariaDB à partir d'un login
      - Gère les jetons
    - **Droits**
      - SELECT
        - DB_TIX.UserFictif_connexion
        - DB_JETONS_TIX.stockage_jeton
      - INSERT
        - (JETON_LOGIN_USER, JETON_IP_USER, JETON_VALEUR) ON DB_JETONS_TIX.stockage_jeton
      - UPDATE
        - (JETON_HORODATAGE_USER) ON DB_JETONS_TIX.stockage_jeton
      - DELETE
        - DB_JETONS_TIX.stockage_jeton
        
  - ### Utilisateur MariaDB : fictif_inscriptionDB [POUR FONCTIONNEMENT SITE WEB UNIQUEMENT]:
    - **Présentation**
      - Dédié à l'inscription d'un utilisateur à la plateforme mais n'attribue pas les droits
    - **Actions**
      - Créer un utilisateur MariaDB
      - Insère un utilisateur dans la table Utilisateur
      - Peut voir les identifiants de tous les utilisateurs (sinon, on ne peut pas récupéré l'identifiant du dernier enregistrement...)
    - **Droits**
      - SELECT
        - (ID_USER) ON UserFictif_inscription
      - INSERT
        - (LOGIN_USER, PRENOM_USER, NOM_USER, EMAIL_USER) ON UserFictif_inscription
      - CREATE USER
        - Partout !
        
  - ### Utilisateur MariaDB : fictif_droitDB [POUR FONCTIONNEMENT SITE WEB UNIQUEMENT]:
    - **Présentation**
      - Dédié à la distribution du rôle Utilisateur
    - **Actions**
      - Distribuer le rôle utilisateur à un utilisateur MariaDB
      - Voir la structure de DB_TIX
    - **Droits**
      - SHOW VIEW ON DB_TIX.*
      - GRANT role_utilisateur ... WITH ADMIN OPTION;