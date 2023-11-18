CREATE USER 'fictif_connexionDB'@'localhost' IDENTIFIED BY 't!nt1n_connexionDB45987645';
CREATE USER 'fictif_inscriptionDB'@'localhost' IDENTIFIED BY 't!nt1n_inscriptionDB45987645';
CREATE USER 'fictif_selectionDB'@'localhost' IDENTIFIED BY 't!nt1n_selectionDB45987645';
CREATE USER 'fictif_updateTicketDB'@'localhost' IDENTIFIED BY 't!nt1n_updateTicketDB45987645';
CREATE USER 'fictif_selectionTicketDB'@'localhost' IDENTIFIED BY 't!nt1n_selectionTicketDB45987645';
CREATE USER 'fictif_insertionTicketDB'@'localhost' IDENTIFIED BY 't!nt1n_insertionTicketDB45987645';

-- Accès à tous les identifiants et les logins des utilisateurs
CREATE VIEW vue_UserFictif_connexionDB1 AS
SELECT ID_USER, LOGIN_USER
FROM Utilisateur;

CREATE VIEW vue_UserFictif_inscriptionDB1 AS 
SELECT LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER, HORODATAGE_OUVERTURE_USER, HORODATAGE_DERNIERE_CONNECTION_USER, IP_DERNIERE_CONNECTION_USER 
FROM Utilisateur;

CREATE VIEW vue_UserFictif_selectionDB1 AS 
SELECT *
FROM Utilisateur;

-- Permet de modifier les infos de connexion d'un utilisateur
CREATE VIEW vue_UserFictif_updateDB1 AS 
SELECT ID_USER, HORODATAGE_DERNIERE_CONNECTION_USER, IP_DERNIERE_CONNECTION_USER 
FROM Utilisateur;

CREATE VIEW vue_UserFictif_updateTicketDB1 AS 
SELECT ID_TICKET, OBJET_TICKET, DESCRIPTION_TICKET, ID_TECHNICIEN, NIV_URGENCE_DEFINITIF_TICKET
FROM Ticket;

CREATE VIEW vue_userfictif_selectionTicketDB1 AS 
SELECT *
FROM Ticket;

CREATE VIEW vue_userfictif_insertionTicketDB1 AS 
SELECT *
FROM Ticket;

GRANT SELECT ON vue_UserFictif_connexionDB1 TO 'fictif_connexionDB'@'localhost';

GRANT INSERT ON vue_UserFictif_inscriptionDB1 TO 'fictif_inscriptionDB'@'localhost';
GRANT CREATE USER ON *.* TO 'fictif_inscriptionDB'@'localhost';
GRANT GRANT OPTION, SELECT ON DB_TIX.* TO 'fictif_inscriptionDB'@'localhost';

GRANT SELECT ON vue_UserFictif_selectionDB1 TO 'fictif_selectionDB'@'localhost';

GRANT UPDATE (HORODATAGE_DERNIERE_CONNECTION_USER, IP_DERNIERE_CONNECTION_USER) ON vue_UserFictif_updateDB1 TO fictif_connexionDB@localhost;

GRANT UPDATE (OBJET_TICKET, DESCRIPTION_TICKET, ID_TECHNICIEN, NIV_URGENCE_DEFINITIF_TICKET) ON vue_UserFictif_updateTicketDB1 TO fictif_updateTicketDB@localhost;

GRANT SELECT ON vue_userfictif_selectionTicketDB1 TO fictif_selectionTicketDB@localhost;

GRANT INSERT ON vue_userfictif_insertionTicketDB1 TO fictif_insertionTicketDB@localhost;
