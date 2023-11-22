-- Création des utilisateurs et rôles
CREATE USER '5' IDENTIFIED BY 'Assuranc3t0ur!x'; -- note : admin_sys et toujours mdp azerty sur serveur secours 
CREATE USER '6' IDENTIFIED BY 'P0rqu3p!x'; -- note : admin_web et toujours mdp azerty sur serveur secours 
CREATE USER 'visiteur' IDENTIFIED BY 't9t+<Q33Pe%o4woPNw\D;hNdhZ}B/z'; -- note : toujours mdp azerty sur serveur secours 

INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER) VALUES(5, 'admin', 'Administrateur', 'SYSTEME', 'admin_sys', 'missing.sys@email.com');
INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER) VALUES(6, 'gestion', 'Administrateur', 'WEB', 'admin_web', 'missing.web@email.com');

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
FROM Utilisateur;

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

GRANT UPDATE ON vue_etat_update_admWeb TO '6';

-- Pour 'admin_web', autorisation d'INSERT
GRANT INSERT ON Libelle TO '6';
GRANT INSERT ON RelationTicketsLibelles TO '6';

-- Pour '6', autorisation de UPDATE
GRANT UPDATE ON Libelle TO '6';
GRANT UPDATE ON RelationTicketsLibelles TO '6';


-- Générale Admins
-- Pour 'admin_web'
GRANT SELECT ON Utilisateur TO '6';
GRANT SELECT ON Ticket TO '6';
GRANT SELECT ON RoleUser TO '6';
GRANT SELECT ON EtatTicket TO '6';
GRANT SELECT ON RelationTicketsLibelles TO '6';
GRANT SELECT ON Libelle TO '6';

-- Pour 'admin_sys'
GRANT SELECT ON Utilisateur TO '5';
GRANT SELECT ON Ticket TO '5';
GRANT SELECT ON RoleUser TO '5';
GRANT SELECT ON EtatTicket TO '5';
GRANT SELECT ON RelationTicketsLibelles TO '5';
GRANT SELECT ON Libelle TO '5';
