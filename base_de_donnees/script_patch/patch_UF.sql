CREATE USER 'fictif_suppressionDB'@'localhost' IDENTIFIED BY 't!nt1n_suppressionDB45987645';

GRANT DROP USER
ON DB_TIX.*
TO 'fictif_suppressionDB'@'localhost';
GRANT UPDATE(LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER)
ON UTILISATEUR
TO 'fictif_suppressionDB'@'localhost';
