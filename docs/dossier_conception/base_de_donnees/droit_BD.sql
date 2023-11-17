-- Création des utilisateurs et rôles
CREATE USER 'admin' IDENTIFIED BY 'Assuranc3t0ur!x'; -- note : admin_sys et toujours mdp azerty sur serveur secours 
CREATE USER 'gestion' IDENTIFIED BY 'P0rqu3p!x'; -- note : admin_web et toujours mdp azerty sur serveur secours 
CREATE USER 'visiteur' IDENTIFIED BY 't9t+<Q33Pe%o4woPNw\D;hNdhZ}B/z'; -- note : toujours mdp azerty sur serveur secours 

-- Création des vues

-- Visiteur
CREATE VIEW vue_Utilisateur_visiteur AS
SELECT LOGIN_USER
FROM Utilisateur;

CREATE VIEW vue_Ticket_visiteur AS
SELECT HORODATAGE_CREATION_TICKET, OBJET_TICKET, NIV_URGENCE_ESTIMER_TICKET, DESCRIPTION_TICKET
FROM Ticket;

GRANT SELECT ON vue_Utilisateur_visiteur TO 'visiteur';
GRANT SELECT ON vue_Ticket_visiteur TO 'visiteur';

-- Utilisateur
CREATE VIEW vue_Utilisateur_client AS
SELECT ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER
FROM Utilisateur;

CREATE VIEW vue_Utilisateur_insertion_client AS
SELECT ID_USER, EMAIL_USER
FROM Utilisateur
WHERE LOGIN_USER = CURRENT_USER;

CREATE VIEW vue_Ticket_client AS
SELECT OBJET_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET, NIV_URGENCE_DEFINITIF_TICKET,
ETAT_TICKET, HORODATAGE_CREATION_TICKET, HORODATAGE_DEBUT_TRAITEMENT_TICKET, HORODATAGE_RESOLUTION_TICKET
FROM Ticket;

CREATE VIEW vue_Ticket_insertion_client AS
SELECT OBJET_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET
FROM Ticket;

CREATE VIEW vue_RelationTicket_client AS
SELECT NOM_LIBELLE
FROM RelationTicketsLibelles;

-- Technicien
CREATE VIEW vue_Ticket_technicien AS
SELECT ID_TECHNICIEN, ETAT_TICKET
FROM Ticket;

-- Admin_web
CREATE VIEW vue_etat_update_admWeb AS
SELECT ETAT_TICKET, NIV_URGENCE_DEFINITIF_TICKET
FROM Ticket;

GRANT UPDATE ON vue_etat_update_admWeb TO 'gestion';

-- Pour 'admin_web', autorisation d'INSERT
GRANT INSERT ON Libelle TO 'gestion';
GRANT INSERT ON RelationTicketsLibelles TO 'gestion';

-- Pour 'gestion', autorisation de UPDATE
GRANT UPDATE ON Libelle TO 'gestion';
GRANT UPDATE ON RelationTicketsLibelles TO 'gestion';


-- Générale Admins
-- Pour 'admin_web'
GRANT SELECT ON Utilisateur TO 'gestion';
GRANT SELECT ON Ticket TO 'gestion';
GRANT SELECT ON RoleUser TO 'gestion';
GRANT SELECT ON EtatTicket TO 'gestion';
GRANT SELECT ON RelationTicketsLibelles TO 'gestion';
GRANT SELECT ON Libelle TO 'gestion';

-- Pour 'admin_sys'
GRANT SELECT ON Utilisateur TO 'admin';
GRANT SELECT ON Ticket TO 'admin';
GRANT SELECT ON RoleUser TO 'admin';
GRANT SELECT ON EtatTicket TO 'admin';
GRANT SELECT ON RelationTicketsLibelles TO 'admin';
GRANT SELECT ON Libelle TO 'admin';


