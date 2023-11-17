-- Création des utilisateurs et rôles
CREATE USER 'admin_sys' IDENTIFIED BY 'azerty'; -- MDP à modifier
CREATE USER 'admin_web' IDENTIFIED BY 'azerty'; -- MDP à modifier
CREATE USER 'visiteur' IDENTIFIED BY 'azerty'; -- MDP à modifier

-- Création des vues

-- Visiteur
CREATE VIEW vue_Utilisateur_visiteur AS
SELECT LOGIN_USER
FROM Utilisateur;

CREATE VIEW vue_Ticket_visiteur AS
SELECT HORODATAGE_CREATION_TICKET, OBJET_TICKET, NIV_URGENCE_ESTIMER_TICKET, DESCRIPTION_TICKET
FROM Ticket;

GRANT SELECT ON vue_Utilisateur_visiteur TO 'visiteur';
GRANT SELECT ON vue_Ticket_visiteur TO 'visiteur';

-- Utilisateur
CREATE VIEW vue_Utilisateur_client AS
SELECT ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER
FROM Utilisateur;

CREATE VIEW vue_Utilisateur_insertion_client AS
SELECT ID_USER, EMAIL_USER
FROM Utilisateur
WHERE LOGIN_USER = CURRENT_USER;

CREATE VIEW vue_Ticket_client AS
SELECT OBJET_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET, NIV_URGENCE_DEFINITIF_TICKET,
ETAT_TICKET, HORODATAGE_CREATION_TICKET, HORODATAGE_DEBUT_TRAITEMENT_TICKET, HORODATAGE_RESOLUTION_TICKET
FROM Ticket;

CREATE VIEW vue_Ticket_insertion_client AS
SELECT OBJET_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET
FROM Ticket;

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

GRANT UPDATE ON vue_etat_update_admWeb TO 'admin_web';

-- Pour 'admin_web', autorisation d'INSERT
GRANT INSERT ON Libelle TO 'admin_web';
GRANT INSERT ON RelationTicketsLibelles TO 'admin_web';

-- Pour 'admin_web', autorisation de UPDATE
GRANT UPDATE ON Libelle TO 'admin_web';
GRANT UPDATE ON RelationTicketsLibelles TO 'admin_web';


-- Générale Admins
-- Pour 'admin_web'
GRANT SELECT ON Utilisateur TO 'admin_web';
GRANT SELECT ON Ticket TO 'admin_web';
GRANT SELECT ON RoleUser TO 'admin_web';
GRANT SELECT ON EtatTicket TO 'admin_web';
GRANT SELECT ON RelationTicketsLibelles TO 'admin_web';
GRANT SELECT ON Libelle TO 'admin_web';

-- Pour 'admin_sys'
GRANT SELECT ON Utilisateur TO 'admin_sys';
GRANT SELECT ON Ticket TO 'admin_sys';
GRANT SELECT ON RoleUser TO 'admin_sys';
GRANT SELECT ON EtatTicket TO 'admin_sys';
GRANT SELECT ON RelationTicketsLibelles TO 'admin_sys';
GRANT SELECT ON Libelle TO 'admin_sys';


