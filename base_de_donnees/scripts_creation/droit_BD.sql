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
SELECT ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER -- A modifier : supprimer ID_USER
FROM Utilisateur;

CREATE VIEW vue_Utilisateur_insertion_client AS
SELECT ID_USER, EMAIL_USER
FROM Utilisateur; -- Mettre current USER

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

CREATE ROLE 'role_technicien' WITH ADMIN fictif_droitDB@localhost;
CREATE ROLE 'role_utilisateur' WITH ADMIN fictif_droitDB@localhost;
CREATE ROLE 'role_admin_web';
CREATE ROLE 'role_admin_sys';

GRANT SELECT ON DB_TIX.vue_Utilisateur_client TO 'role_utilisateur';
GRANT SELECT ON DB_TIX.vue_Ticket_client TO 'role_utilisateur';
GRANT UPDATE ON DB_TIX.vue_Utilisateur_insertion_client TO 'role_utilisateur';
GRANT UPDATE ON DB_TIX.vue_Ticket_insertion_client TO 'role_utilisateur';

GRANT 'role_utilisateur' TO 'role_technicien';
GRANT UPDATE ON vue_Ticket_technicien TO 'role_technicien';

GRANT 'role_technicien' TO 'role_admin_web';
GRANT UPDATE ON vue_etat_update_admWeb TO 'role_admin_web';
GRANT INSERT ON Libelle TO 'role_admin_web';
GRANT INSERT ON RelationTicketsLibelles TO 'role_admin_web';
GRANT UPDATE ON Libelle TO 'role_admin_web';
GRANT UPDATE ON RelationTicketsLibelles TO 'role_admin_web';

GRANT 'role_technicien' TO 'role_admin_sys';

-- Création des utilisateurs
CREATE USER '5' IDENTIFIED BY 'Assuranc3t0ur!x';
CREATE USER '6' IDENTIFIED BY 'P0rqu3p!x';
CREATE USER 'visiteur' IDENTIFIED BY 't9t+<Q33Pe%o4woPNw\D;hNdhZ}B/z';

INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER) VALUES(5, 'admin', 'Administrateur', 'SYSTEME', 'admin_sys', 'missing.sys@email.com');
INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER) VALUES(6, 'gestion', 'Administrateur', 'WEB', 'admin_web', 'missing.web@email.com');

GRANT 'role_admin_sys' TO '5'@'localhost';
GRANT 'role_admin_web' TO '5'@'localhost';

SET DEFAULT ROLE 'role_admin_sys' FOR '5'@'localhost';
SET DEFAULT ROLE 'role_admin_web' FOR '6'@'localhost';
