-- Suppression des tables
DROP TABLE RelationTicketsLibelles;
DROP TABLE Ticket;
DROP TABLE Utilisateur;
DROP TABLE RoleUser;
DROP TABLE EtatTicket;
DROP TABLE Libelle;

-- Suppression des user
DROP USER 'admin_sys';
DROP USER 'admin_web';

-- Suppression des rôles
DROP ROLE 'technicien_role';
DROP ROLE 'client_role';
DROP ROLE 'visiteur_role';

-- Suppression des vues
DROP VIEW vue_Utilisateur_visiteur;
DROP VIEW vue_Ticket_visiteur;
DROP VIEW vue_Utilisateur_client;
DROP VIEW vue_Utilisateur_insertion_client;
DROP VIEW vue_Ticket_client;
DROP VIEW vue_Ticket_insertion_client;
DROP VIEW vue_RelationTicket_client;
DROP VIEW vue_Ticket_technicien;
DROP VIEW vue_etat_update_admWeb;