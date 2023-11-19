-- Création des différents utilisateurs fictifs
CREATE USER 'fictif_connexionDB'@'localhost' IDENTIFIED BY 't!nt1n_connexionDB45987645';
CREATE USER 'fictif_inscriptionDB'@'localhost' IDENTIFIED BY 't!nt1n_inscriptionDB45987645';
CREATE USER 'fictif_selectionDB'@'localhost' IDENTIFIED BY 't!nt1n_selectionDB45987645';
CREATE USER 'fictif_droitDB'@'localhost' IDENTIFIED BY 't!nt1n_droitDB45987645';
CREATE USER 'fictif_updateTicketDB'@'localhost' IDENTIFIED BY 't!nt1n_updateTicketDB45987645';
CREATE USER 'fictif_selectionTicketDB'@'localhost' IDENTIFIED BY 't!nt1n_selectionTicketDB45987645';
CREATE USER 'fictif_insertionTicketDB'@'localhost' IDENTIFIED BY 't!nt1n_insertionTicketDB45987645';

-- Accès à tous les identifiants et les logins des utilisateurs
CREATE VIEW vue_UserFictif_connexionDB1 AS
SELECT ID_USER, LOGIN_USER
FROM Utilisateur;

-- Permet d'ajouter un nouvel utilsateur
CREATE VIEW vue_UserFictif_inscriptionDB1 AS 
SELECT LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER, HORODATAGE_OUVERTURE_USER, HORODATAGE_DERNIERE_CONNECTION_USER, IP_DERNIERE_CONNECTION_USER 
FROM Utilisateur;

-- Permet de récupérer les différentes infos des utilisateurs
CREATE VIEW vue_UserFictif_selectionDB1 AS 
SELECT *
FROM Utilisateur;

-- Permet de modifier les infos de connexion d'un utilisateur
CREATE VIEW vue_UserFictif_updateDB1 AS 
SELECT ID_USER, HORODATAGE_DERNIERE_CONNECTION_USER, IP_DERNIERE_CONNECTION_USER 
FROM Utilisateur;

-- Permet de modifier les infos des tickets
CREATE VIEW vue_UserFictif_updateTicketDB1 AS 
SELECT ID_TICKET, OBJET_TICKET, DESCRIPTION_TICKET, ID_TECHNICIEN, NIV_URGENCE_DEFINITIF_TICKET
FROM Ticket;

-- Permet de récupérer les différentes infos des tickets
CREATE VIEW vue_userfictif_selectionTicketDB1 AS 
SELECT *
FROM Ticket;

-- Permet d'ajouter un nouveau ticket
CREATE VIEW vue_userfictif_insertionTicketDB1 AS 
SELECT *
FROM Ticket;

-- Ajout des droit pour l'utilisateurs fictif_inscriptionDB
GRANT INSERT ON vue_UserFictif_inscriptionDB1 TO 'fictif_inscriptionDB'@'localhost';
GRANT CREATE USER ON *.* TO 'fictif_inscriptionDB'@'localhost';

-- Ajout des droit pour l'utilisateurs fictif_droitDB
GRANT SELECT ON DB_TIX.vue_Utilisateur_client TO 'fictif_droitDB'@'localhost';
GRANT SELECT ON DB_TIX.vue_Ticket_client TO 'fictif_droitDB'@'localhost';
GRANT SELECT ON DB_TIX.vue_Utilisateur_insertion_client TO 'fictif_droitDB'@'localhost';
GRANT SELECT ON DB_TIX.vue_Ticket_insertion_client TO 'fictif_droitDB'@'localhost';
GRANT GRANT OPTION ON DB_TIX.vue_Utilisateur_client TO 'fictif_droitDB'@'localhost';
GRANT GRANT OPTION ON DB_TIX.vue_Ticket_client TO 'fictif_droitDB'@'localhost';
GRANT GRANT OPTION ON DB_TIX.vue_Utilisateur_insertion_client TO 'fictif_droitDB'@'localhost';
GRANT GRANT OPTION ON DB_TIX.vue_Ticket_insertion_client TO 'fictif_droitDB'@'localhost';

-- Ajout des droit pour l'utilisateurs fictif_selectionDB
GRANT SELECT ON vue_UserFictif_selectionDB1 TO 'fictif_selectionDB'@'localhost';

-- Ajout des droit pour l'utilisateurs fictif_connexionDB
GRANT SELECT ON vue_UserFictif_connexionDB1 TO 'fictif_connexionDB'@'localhost';
GRANT UPDATE (HORODATAGE_DERNIERE_CONNECTION_USER, IP_DERNIERE_CONNECTION_USER) ON vue_UserFictif_updateDB1 TO 'fictif_connexionDB'@'localhost';

-- Ajout des droit pour l'utilisateurs fictif_updateTicketDB
GRANT UPDATE (OBJET_TICKET, DESCRIPTION_TICKET, ID_TECHNICIEN, NIV_URGENCE_DEFINITIF_TICKET) ON vue_UserFictif_updateTicketDB1 TO 'fictif_updateTicketDB'@'localhost';

-- Ajout des droit pour l'utilisateurs fictif_selectionTicketDB
GRANT SELECT ON vue_userfictif_selectionTicketDB1 TO 'fictif_selectionTicketDB'@'localhost';

-- Ajout des droit pour l'utilisateurs fictif_insertionTicketDB
GRANT INSERT ON vue_userfictif_insertionTicketDB1 TO 'fictif_insertionTicketDB'@'localhost';
