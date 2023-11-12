CREATE USER 'fictif_connexionDB'@'localhost' IDENTIFIED BY 't!nt1n_connexionDB45987645';
CREATE USER 'fictif_inscriptionDB'@'localhost' IDENTIFIED BY 't!nt1n_inscriptionDB45987645';
CREATE USER 'fictif_selectionDB'@'localhost' IDENTIFIED BY 't!nt1n_selectionDB45987645';
CREATE USER 'fictif_updateDB'@'localhost' IDENTIFIED BY 't!nt1n_updateDB45987645';

// Accès à tous les identifiants et les logins des utilisateurs
CREATE VIEW vue_UserFictif_connexionDB1 AS
SELECT ID_USER, LOGIN_USER
FROM Utilisateur;

CREATE VIEW vue_UserFictif_inscriptionDB1 AS 
SELECT * 
FROM Utilisateur;

CREATE VIEW vue_UserFictif_selectionDB1 AS 
SELECT *
FROM Utilisateur;

CREATE VIEW vue_UserFictif_updateDB1 AS 
SELECT ID_USER, HORODATAGE_DERNIERE_CONNECTION_USER, IP_DERNIERE_CONNECTION_USER 
FROM Utilisateur;

/*
// Accès aux infos de connexion juste pour l utilisateur accueil ATTENTION IL FAUT CREER UN TRIGGER
CREATE VIEW vue_UserFictif_connexionDB2 AS
SELECT HORODATAGE_DERNIERE_CONNECTION_USER, IP_DERNIERE_CONNEXION_USER
FROM Utilisateur

GRANT SELECT ON vue_UserFictif_connexionDB2 TO 'fictif_connexionDB'@'localhost';
*/

GRANT SELECT ON vue_UserFictif_connexionDB1 TO 'fictif_connexionDB'@'localhost';

GRANT INSERT ON vue_UserFictif_inscriptionDB1 TO 'fictif_inscriptionDB'@'localhost';
GRANT CREATE USER ON *.* TO 'fictif_inscriptionDB'@'localhost';
GRANT GRANT OPTION, SELECT ON DB_TIX.* TO 'fictif_inscriptionDB'@'localhost';

GRANT SELECT ON vue_UserFictif_selectionDB1 TO 'fictif_selectionDB'@'localhost';

GRANT UPDATE ON vue_UserFictif_updateDB1 TO 'fictif_updateDB'@'localhost';

