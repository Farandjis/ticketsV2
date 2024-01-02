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
GRANT SELECT(ID_USER) ON UserFictif_inscription TO 'fictif_inscriptionDB'@'localhost';
GRANT CREATE USER ON *.* TO 'fictif_inscriptionDB'@'localhost';


-- UF droitDB peut est considéré comme un utilisateur de la plateforme pour pouvoir transmettre le rôle à qui il veut.
GRANT role_utilisateur TO 'fictif_droitDB'@'localhost' WITH ADMIN OPTION;

-- UF droitBD peut voir la structure de la BD (pour s'y connecter), mais ne peut absolument rien faire avec (pas de SELECT, UPDATE...)
GRANT SHOW VIEW ON DB_TIX.* TO 'fictif_droitDB'@'localhost';



-- Ajout des droit pour l'utilisateurs fictif_connexionDB
GRANT SELECT ON UserFictif_connexion TO 'fictif_connexionDB'@'localhost';
GRANT UPDATE (HORODATAGE_DERNIERE_CONNECTION_USER, IP_DERNIERE_CONNECTION_USER) ON UserFictif_maj_derniere_co TO 'fictif_connexionDB'@'localhost';

-- Pour l'administrateur de la BD, pour qu'il puisse continuer à donner le rôle utilisateur lui aussi
GRANT 'role_utilisateur' TO phpmyfteam@localhost WITH ADMIN OPTION;
