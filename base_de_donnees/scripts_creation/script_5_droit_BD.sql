-- Création des utilisateurs
CREATE USER '5'@'localhost' IDENTIFIED BY 'Assuranc3t0ur!x';
CREATE USER '6'@'localhost' IDENTIFIED BY 'P0rqu3p!x';
CREATE USER 'visiteur'@'localhost' IDENTIFIED BY 't9t+<Q33Pe%o4woPNwDhNdhZBz';

-- Ajout dans la table Utilisateurs les admins pour qu'ils puissent se connecter via la page de connexion
INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, EMAIL_USER) VALUES(5, 'admin', 'Administrateur', 'SYSTEME', 'missing.sys@email.com');
INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, EMAIL_USER) VALUES(6, 'gestion', 'Administrateur', 'WEB', 'missing.web@email.com');

-- Distribution des droits
GRANT SELECT ON vue_Ticket_visiteur TO 'visiteur'@'localhost';

GRANT 'role_admin_sys' TO '5'@'localhost';
GRANT 'role_admin_web' TO '6'@'localhost';

-- Active par défaut les rôles pour les admins
SET DEFAULT ROLE 'role_admin_sys' FOR '5'@'localhost';
SET DEFAULT ROLE 'role_admin_web' FOR '6'@'localhost';
