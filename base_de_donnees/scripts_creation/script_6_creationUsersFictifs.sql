-- Création des différents utilisateurs fictifs
CREATE USER 'fictif_connexionDB'@'localhost' IDENTIFIED BY 't!nt1n_connexionDB45987645';
CREATE USER 'fictif_inscriptionDB'@'localhost' IDENTIFIED BY 't!nt1n_inscriptionDB45987645';
CREATE USER 'fictif_droitDB'@'localhost' IDENTIFIED BY 't!nt1n_droitDB45987645';



-- Accès à tous les identifiants et les logins des utilisateurs
-- ABCDEF UserFictif_connexionDB1
CREATE OR REPLACE VIEW UserFictif_connexion AS
SELECT ID_USER, LOGIN_USER
FROM Utilisateur;

-- Permet d'ajouter un nouvel utilsateur
-- ABCDEF UserFictif_inscriptionDB1
CREATE OR REPLACE VIEW UserFictif_inscription AS
SELECT ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, EMAIL_USER
FROM Utilisateur;

-- Permet de modifier les infos de connexion d'un utilisateur
-- ABCDEF UserFictif_updateDB1
CREATE OR REPLACE VIEW UserFictif_maj_derniere_co AS
SELECT ID_USER, HORODATAGE_DERNIERE_CONNECTION_USER, IP_DERNIERE_CONNECTION_USER 
FROM Utilisateur;


-- Ajout des droit pour l'utilisateurs fictif_inscriptionDB
GRANT INSERT (LOGIN_USER, PRENOM_USER, NOM_USER, EMAIL_USER) ON UserFictif_inscription TO 'fictif_inscriptionDB'@'localhost';
GRANT SELECT ON UserFictif_inscription TO 'fictif_inscriptionDB'@'localhost';
GRANT CREATE USER ON *.* TO 'fictif_inscriptionDB'@'localhost';

-- Ajout des droit pour l'utilisateurs fictif_droitDB

/*
GRANT SELECT ON DB_TIX.vue_Utilisateur_client TO 'fictif_droitDB'@'localhost';
GRANT SELECT ON DB_TIX.vue_Ticket_client TO 'fictif_droitDB'@'localhost';
GRANT UPDATE ON DB_TIX.vue_Utilisateur_insertion_client TO 'fictif_droitDB'@'localhost';
GRANT UPDATE ON DB_TIX.vue_Ticket_insertion_client TO 'fictif_droitDB'@'localhost';
GRANT UPDATE ON DB_TIX.vue_Ticket_technicien TO 'fictif_droitDB'@'localhost';
GRANT UPDATE ON DB_TIX.vue_etat_update_admWeb TO 'fictif_droitDB'@'localhost';
GRANT INSERT ON DB_TIX.MotcleTicket TO 'fictif_droitDB'@'localhost';
GRANT INSERT ON DB_TIX.RelationTicketsMotscles TO 'fictif_droitDB'@'localhost';
GRANT UPDATE ON DB_TIX.MotcleTicket TO 'fictif_droitDB'@'localhost';
GRANT UPDATE ON DB_TIX.RelationTicketsMotscles TO 'fictif_droitDB'@'localhost';

GRANT GRANT OPTION ON DB_TIX.vue_Utilisateur_client TO 'fictif_droitDB'@'localhost';
GRANT GRANT OPTION ON DB_TIX.vue_Ticket_client TO 'fictif_droitDB'@'localhost';
GRANT GRANT OPTION ON DB_TIX.vue_Utilisateur_insertion_client TO 'fictif_droitDB'@'localhost';
GRANT GRANT OPTION ON DB_TIX.vue_Ticket_insertion_client TO 'fictif_droitDB'@'localhost';
GRANT GRANT OPTION ON DB_TIX.vue_Ticket_technicien TO 'fictif_droitDB'@'localhost';
GRANT GRANT OPTION ON DB_TIX.vue_etat_update_admWeb TO 'fictif_droitDB'@'localhost';
GRANT GRANT OPTION ON DB_TIX.MotcleTicket TO 'fictif_droitDB'@'localhost';
GRANT GRANT OPTION ON DB_TIX.RelationTicketsMotscles TO 'fictif_droitDB'@'localhost';
GRANT GRANT OPTION ON DB_TIX.MotcleTicket TO 'fictif_droitDB'@'localhost';
GRANT GRANT OPTION ON DB_TIX.RelationTicketsMotscles TO 'fictif_droitDB'@'localhost';
*/

-- UF droitDB peut est considéré comme un utilisateur de la plateforme pour pouvoir transmettre le rôle à qui il veut.
GRANT role_utilisateur TO 'fictif_droitDB'@'localhost' WITH ADMIN OPTION;



-- Ajout des droit pour l'utilisateurs fictif_connexionDB
GRANT SELECT ON UserFictif_connexion TO 'fictif_connexionDB'@'localhost';
GRANT UPDATE (HORODATAGE_DERNIERE_CONNECTION_USER, IP_DERNIERE_CONNECTION_USER) ON UserFictif_maj_derniere_co TO 'fictif_connexionDB'@'localhost';
