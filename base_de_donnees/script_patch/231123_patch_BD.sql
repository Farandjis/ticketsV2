/*
Comme il était prévu initialement, désormais les utilisateurs récupérons leurs droits via les rôles.
Ce script retire les droits précédemment accordés, et ajoute les rôles
*/
CREATE ROLE 'role_technicien';
CREATE ROLE 'role_client';
CREATE ROLE 'role_utilisateur' WITH ADMIN fictif_droitDB@localhost;
CREATE ROLE 'role_admin_web';
CREATE ROLE 'role_admin_sys';

GRANT SELECT ON DB_TIX.vue_Utilisateur_client TO 'role_utilisateur';
GRANT SELECT ON DB_TIX.vue_Ticket_client TO 'role_utilisateur';
GRANT UPDATE ON DB_TIX.vue_Utilisateur_insertion_client TO 'role_utilisateur';
GRANT UPDATE ON DB_TIX.vue_Ticket_insertion_client TO 'role_utilisateur';

-- ///////////////////////////////// Utilisateurs pour tests
-- Ne pas oublier SET DEFAULT ROLE ! Sinon, le rôle n'est pas actif dès la connexion de l'utilisateur et il n'a pas accès à ses droits.
/*
DROP USER '1'@'localhost';
DROP USER '2'@'localhost';
DROP USER '3'@'localhost';
DROP USER '4'@'localhost';

CREATE USER '1'@'localhost' IDENTIFIED BY 'azerty!123';
CREATE USER '2'@'localhost' IDENTIFIED BY 'azerty!123';
CREATE USER '3'@'localhost' IDENTIFIED BY 'azerty!123';
CREATE USER '4'@'localhost' IDENTIFIED BY 'azerty!123';

GRANT 'role_utilisateur' TO '1'@'localhost';
GRANT 'role_utilisateur' TO '2'@'localhost';
GRANT 'role_utilisateur' TO '3'@'localhost';
GRANT 'role_utilisateur' TO '4'@'localhost';

SET DEFAULT ROLE 'role_utilisateur' FOR '1'@'localhost';
SET DEFAULT ROLE 'role_utilisateur' FOR '2'@'localhost';
SET DEFAULT ROLE 'role_utilisateur' FOR '3'@'localhost';
SET DEFAULT ROLE 'role_utilisateur' FOR '4'@'localhost';
*/

/*
CREATE VIEW vue_UserFictifmodifLogin AS SELECT ID_USER, LOGIN_USER FROM DB_TIX.Utilisateur WHERE id_user = SUBSTRING_INDEX(CURRENT_USER(), '@', 1);
CREATE USER 'fictif_modifLogin'@'localhost' IDENTIFIED BY 'p0pi!5555555954'; -- pas bon ! utilisateur à supprimer
GRANT SELECT ON DB_TIX.vue_UserFictifmodifLogin TO 'fictif_modifLogin'@'localhost';
GRANT UPDATE (LOGIN_USER) ON DB_TIX.vue_UserFictifmodifLogin TO 'fictif_modifLogin'@'localhost'; -- Note : enlever machin sécurité SQL
*/

-- GRANT role_utilisateur TO role_technicien; -- A faire avec l'utilisateur droit
-- SELECT CURRENT_ROLE(); pour voir le role actuel de l'utilisateur
