CREATE USER admin_sys IDENTIFIED BY azerty; -- MDP à modifier
CREATE USER admin_web IDENTIFIED BY azerty; -- MDP à modifier

CREATE ROLE technicien_role;
CREATE ROLE client_role;
CREATE ROLE visiteur_role;

-- Création des vues

-- Visiteur
CREATE VIEW vue_Utilisateur_visiteur AS
SELECT LOGIN_USER
FROM Utilisateur;

CREATE VIEW vue_Ticket_visiteur AS
SELECT HORODATAGE_CREATION_TICKET, OBJET_TICKET, NIV_URGENCE_ESTIMER_TICKET, DESCRIPTION_TICKET
FROM Ticket;

GRANT SELECT ON vue_Utilisateur_visiteur, vue_Ticket_visiteur TO visiteur_role;

-- Utilisateur
CREATE VIEW vue_Utilisateur_client AS
SELECT LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER
FROM Utilisateur;

CREATE VIEW vue_Utilisateur_insertion_client AS
SELECT EMAIL_USER
FROM Utilisateur
WHERE LOGIN_USER = USER;  -- à vérifier

CREATE VIEW vue_Ticket_client AS
SELECT OBJET_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET, NIV_URGENCE_DEFINITIF_TICKET,
 ETAT_TICKET, HORODATAGE_CREATION_TICKET, HORODATAGE_DEBUT_TRAITEMENT_TICKET, HORODATAGE_RESOLUTION_TICKET
FROM Ticket;

CREATE VIEW vue_Ticket_insertion_client AS   -- peut être inutile
SELECT OBJET_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET
FROM Ticket;

CREATE VIEW vue_RelationTicket_client AS
SELECT NOM_LIBELLE
FROM RelationTicketsLibelles;

GRANT SELECT ON vue_Utilisateur_client, vue_Ticket_client, vue_RelationTicket_client TO client_role;
GRANT UPDATE ON vue_Utilisateur_insertion_client, vue_Ticket_insertion_client TO client_role;

-- Technicien

CREATE VIEW vue_Ticket_technicien AS
SELECT ID_TECHNICIEN, ETAT_TICKET
FROM Ticket;

GRANT UPDATE ON vue_Ticket_technicien;

-- Admin_web

CREATE VIEW vue_etat_update_admWeb AS
SELECT ETAT_TICKET, NIV_URGENCE_DEFINITIF_TICKET
FROM Ticket;

GRANT UPDATE ON vue_etat_update_admWeb TO admin_web;

GRANT INSERT, UPDATE ON Libelle, RelationTicketsLibelles TO admin_web;

-- Générale Techniciens/Admins

GRANT SELECT ON Utilisateur, Ticket, RoleUser, EtatTicket, RelationTicketsLibelles, Libelle 
TO technicien_role, admin_web, admin_sys;