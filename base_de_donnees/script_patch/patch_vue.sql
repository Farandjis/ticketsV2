/*Note pour les case : pour chaque case pour la colonne indiqué, si c'est le bon rôle alors on affiche la valeur, sinon, on affiche "ACCÈS INTERDIT" à l'emplacement de la colonne.
On procède ainsi car à cause des JOIN, il n'est pas possible de préciser les colonnes dans le GRANT SELECT. Sauf qu'on veut cacher des informations.
*/
CREATE OR REPLACE VIEW vue_tableau_bord AS
SELECT
T.ID_TICKET,
T.OBJET_TICKET,
T.DESCRIPTION_TICKET,
T.NIV_URGENCE_ESTIMER_TICKET,
T.NIV_URGENCE_DEFINITIF_TICKET,
T.ETAT_TICKET,
T.HORODATAGE_CREATION_TICKET,
T.HORODATAGE_DERNIERE_MODIF_TICKET,
TECH.PRENOM_USER as PRENOM_TECH,
TECH.NOM_USER as NOM_TECH,

CASE WHEN (ObtenirRoleUtilisateur() = ('role_technicien' COLLATE utf8mb4_unicode_ci) OR ObtenirRoleUtilisateur() = ('role_admin_web' COLLATE utf8mb4_unicode_ci)) THEN T.ID_TECHNICIEN ELSE 'ACCÈS INTERDIT'
END AS ID_TECHNICIEN,

CASE WHEN (ObtenirRoleUtilisateur() = ('role_technicien' COLLATE utf8mb4_unicode_ci) OR ObtenirRoleUtilisateur() = ('role_admin_web' COLLATE utf8mb4_unicode_ci)) THEN T.ID_USER ELSE 'ACCÈS INTERDIT'
END AS ID_CREA,

CASE WHEN (ObtenirRoleUtilisateur() = ('role_technicien' COLLATE utf8mb4_unicode_ci) OR ObtenirRoleUtilisateur() = ('role_admin_web' COLLATE utf8mb4_unicode_ci)) THEN CREA.PRENOM_USER ELSE 'ACCÈS INTERDIT'
END AS PRENOM_CREA,

CASE WHEN (ObtenirRoleUtilisateur() = ('role_technicien' COLLATE utf8mb4_unicode_ci) OR ObtenirRoleUtilisateur() = ('role_admin_web' COLLATE utf8mb4_unicode_ci)) THEN CREA.NOM_USER ELSE 'ACCÈS INTERDIT'
END AS NOM_CREA
    
FROM Ticket AS T
    JOIN Utilisateur AS CREA ON T.ID_USER = CREA.ID_USER
    LEFT OUTER JOIN vue_technicien AS TECH ON T.ID_TECHNICIEN = TECH.ID_USER
WHERE T.ETAT_TICKET = "Ouvert"
   OR T.ETAT_TICKET = "En cours de traitement"
   OR (T.ETAT_TICKET = "En attente" AND (T.ID_USER = substring_index(user(),'@',1) OR (SELECT role_user FROM vue_Utilisateur_client) = "role_admin_web"))

ORDER BY ID_TICKET DESC;


CREATE OR REPLACE VIEW vue_tdb_relation_ticket_libelle AS
SELECT RTL.ID_TICKET, RTL.NOM_LIBELLE
FROM RelationTicketsLibelles AS RTL
    JOIN vue_tableau_bord AS TDB ON RTL.ID_TICKET = TDB.ID_TICKET;



-- LES VUES LIÉES AUX MODIFICATIONS DES TICKETS

CREATE OR REPLACE VIEW vue_modif_creation_ticket_utilisateur AS
SELECT ID_TICKET,OBJET_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET, HORODATAGE_DERNIERE_MODIF_TICKET
FROM Ticket
WHERE ID_USER = SUBSTRING_INDEX(USER(), '@', 1)
AND ETAT_TICKET = 'En attente';

CREATE OR REPLACE VIEW vue_modif_ticket_adm_tech AS
SELECT ID_TICKET,OBJET_TICKET, DESCRIPTION_TICKET, ID_TECHNICIEN, ETAT_TICKET, NIV_URGENCE_DEFINITIF_TICKET, HORODATAGE_DERNIERE_MODIF_TICKET, HORODATAGE_RESOLUTION_TICKET
FROM Ticket
WHERE (ETAT_TICKET = "En cours de traitement" AND ID_TECHNICIEN = SUBSTRING_INDEX(USER(), '@', 1)) OR (ObtenirRoleUtilisateur() = ("role_admin_web" COLLATE utf8mb4_unicode_ci) AND (ETAT_TICKET != "Fermé"));

CREATE OR REPLACE VIEW vue_associe_ticket_tech AS
SELECT ID_TICKET, ID_TECHNICIEN, HORODATAGE_DEBUT_TRAITEMENT_TICKET
FROM Ticket
WHERE (ETAT_TICKET = "Ouvert");

CREATE OR REPLACE VIEW vue_suppr_rtl_tdb AS
SELECT RTL.ID_TICKET, RTL.NOM_LIBELLE
FROM RelationTicketsLibelles AS RTL
WHERE verifier_id_ticket_dans_vue_tdb(RTL.ID_TICKET) = 1 AND (((ObtenirRoleUtilisateur() != ('role_utilisateur' COLLATE utf8mb4_unicode_ci))
AND (ObtenirRoleUtilisateur() != ('role_admin_sys' COLLATE utf8mb4_unicode_ci)))
   OR (recup_etat_ticket_tdb(RTL.ID_TICKET) = ("En attente" COLLATE utf8mb4_unicode_ci)));

CREATE OR REPLACE VIEW vue_historique AS
SELECT T.ID_TICKET, T.OBJET_TICKET, T.DESCRIPTION_TICKET, T.NIV_URGENCE_DEFINITIF_TICKET, T.ETAT_TICKET, T.HORODATAGE_CREATION_TICKET, T.HORODATAGE_DERNIERE_MODIF_TICKET, T.ID_TECHNICIEN, T.ID_USER, CREA.PRENOM_USER, CREA.NOM_USER, TECH.PRENOM_USER as PRENOM_TECH, TECH.NOM_USER as NOM_TECH
FROM Ticket AS T
    JOIN Utilisateur AS CREA ON T.ID_USER = CREA.ID_USER
    LEFT OUTER JOIN Utilisateur AS TECH ON T.ID_TECHNICIEN = TECH.ID_USER
WHERE T.ETAT_TICKET = "Fermé";


CREATE OR REPLACE VIEW vue_historique_relation_ticket_libelle AS
SELECT RTL.ID_TICKET, RTL.NOM_LIBELLE
FROM RelationTicketsLibelles AS RTL
    JOIN vue_historique AS H ON RTL.ID_TICKET = H.ID_TICKET;

CREATE OR REPLACE VIEW vue_technicien AS
SELECT ID_USER, PRENOM_USER, NOM_USER, EMAIL_USER
FROM DB_TIX.Utilisateur
JOIN mysql.user ON mysql.user.User = ID_USER
WHERE mysql.user.default_role = "role_technicien";

-- Modification d'une table
ALTER TABLE Ticket MODIFY COLUMN ID_USER INT DEFAULT (SUBSTRING_INDEX(USER(),'@',1)); -- Par défaut, l'utilisateur qui exécute la requête est le créateur du ticket.



-- Pour adm web (donner le rôle tech)
CREATE VIEW affiche_utilisateurs_pour_adm_web AS SELECT ID_USER, PRENOM_USER, NOM_USER FROM Utilisateur;
