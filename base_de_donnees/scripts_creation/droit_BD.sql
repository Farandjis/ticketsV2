CREATE VIEW vue_Utilisateur_visiteur AS
SELECT LOGIN_USER
FROM Utilisateur;

CREATE VIEW vue_Ticket_visiteur AS
SELECT HORODATAGE_CREATION_TICKET, OBJET_TICKET, NIV_URGENCE_ESTIMER_TICKET, DESCRIPTION_TICKET
FROM Ticket;

-- Utilisateur
CREATE VIEW vue_Utilisateur_client AS
SELECT ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER -- A modifier : supprimer ID_USER
FROM Utilisateur
WHERE ID_USER = SUBSTRING_INDEX(CURRENT_USER, '@', 1);

ALTER ALGORITHM = UNDEFINED DEFINER=`phpmyfteam`@`localhost`
 SQL SECURITY INVOKER VIEW `vue_Utilisateur_client` AS
 select `DB_TIX`.`Utilisateur`.`ID_USER` AS `ID_USER`,
 `DB_TIX`.`Utilisateur`.`LOGIN_USER` AS `LOGIN_USER`,
 `DB_TIX`.`Utilisateur`.`PRENOM_USER` AS `PRENOM_USER`,
 `DB_TIX`.`Utilisateur`.`NOM_USER` AS `NOM_USER`,
 `DB_TIX`.`Utilisateur`.`ROLE_USER` AS `ROLE_USER`,
 `DB_TIX`.`Utilisateur`.`EMAIL_USER` AS `EMAIL_USER`
 from `DB_TIX`.`Utilisateur`
 where `DB_TIX`.`Utilisateur`.`ID_USER` = substring_index(current_user(),'@',1)

CREATE VIEW vue_Utilisateur_insertion_client AS
SELECT ID_USER, EMAIL_USER
FROM Utilisateur
WHERE ID_USER = SUBSTRING_INDEX(CURRENT_USER, '@', 1);

ALTER ALGORITHM = UNDEFINED DEFINER=`phpmyfteam`@`localhost`
SQL SECURITY INVOKER VIEW `vue_Utilisateur_insertion_client` AS
select `DB_TIX`.`Utilisateur`.`ID_USER` AS `ID_USER`,
`DB_TIX`.`Utilisateur`.`EMAIL_USER` AS `EMAIL_USER`
from `DB_TIX`.`Utilisateur`
where `DB_TIX`.`Utilisateur`.`ID_USER` = substring_index(current_user(),'@',1)

CREATE VIEW vue_Ticket_client AS
SELECT OBJET_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET, NIV_URGENCE_DEFINITIF_TICKET,
ETAT_TICKET, HORODATAGE_CREATION_TICKET, HORODATAGE_DEBUT_TRAITEMENT_TICKET, HORODATAGE_RESOLUTION_TICKET
FROM Ticket;

CREATE VIEW vue_Ticket_insertion_client AS
SELECT OBJET_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET
FROM Ticket
WHERE ID_USER = SUBSTRING_INDEX(CURRENT_USER(), '@', 1);

ALTER ALGORITHM = UNDEFINED DEFINER=`phpmyfteam`@`localhost`
SQL SECURITY INVOKER VIEW `vue_Ticket_insertion_client` AS
select `DB_TIX`.`Ticket`.`OBJET_TICKET` AS `OBJET_TICKET`,
`DB_TIX`.`Ticket`.`DESCRIPTION_TICKET` AS `DESCRIPTION_TICKET`,
`DB_TIX`.`Ticket`.`NIV_URGENCE_ESTIMER_TICKET` AS `NIV_URGENCE_ESTIMER_TICKET`
from `DB_TIX`.`Ticket`
where `DB_TIX`.`Ticket`.`ID_USER` = substring_index(current_user(),'@',1)

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

CREATE ROLE 'role_technicien';
CREATE ROLE 'role_utilisateur';
CREATE ROLE 'role_admin_web';
CREATE ROLE 'role_admin_sys';

-- Création des utilisateurs
CREATE USER '5'@'localhost' IDENTIFIED BY 'Assuranc3t0ur!x';
CREATE USER '6'@'localhost' IDENTIFIED BY 'P0rqu3p!x';
CREATE USER 'visiteur'@'localhost' IDENTIFIED BY 't9t+<Q33Pe%o4woPNw\D;hNdhZ}B/z';

-- Ajout dans la table Utilisateurs les admins pour qu'ils puissent se connecter via la page de connexion
INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER) VALUES(5, 'admin', 'Administrateur', 'SYSTEME', 'admin_sys', 'missing.sys@email.com');
INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER) VALUES(6, 'gestion', 'Administrateur', 'WEB', 'admin_web', 'missing.web@email.com');

-- Distribution des droits
GRANT SELECT ON vue_Utilisateur_visiteur TO 'visiteur'@'localhost';
GRANT SELECT ON vue_Ticket_visiteur TO 'visiteur'@'localhost';

GRANT 'role_utilisateur' TO 'role_technicien';
GRANT 'role_technicien' TO 'role_admin_web';
GRANT 'role_technicien' TO 'role_admin_sys';

GRANT 'role_admin_sys' TO '5'@'localhost';
GRANT 'role_admin_web' TO '6'@'localhost';

-- Active par défaut les rôles pour les admins
SET DEFAULT ROLE 'role_admin_sys' FOR '5'@'localhost';
SET DEFAULT ROLE 'role_admin_web' FOR '6'@'localhost';
