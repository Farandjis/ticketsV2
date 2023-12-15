CREATE USER 'fictif_suppressionDB'@'localhost' IDENTIFIED BY 't!nt1n_suppressionDB45987645';

GRANT DROP
ON DB_TIX.*
TO 'fictif_suppressionDB'@'localhost';
GRANT UPDATE(LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER)
ON Utilisateur
TO 'fictif_suppressionDB'@'localhost';

GRANT SELECT
ON Libelle
TO 'fictif_droitDB'@'localhost';

GRANT SELECT
ON RelationTicketsLibelles
TO 'fictif_droitDB'@'localhost';
