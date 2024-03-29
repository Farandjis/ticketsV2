-- Note du 23/12/23 à 10h53 : les endroits où le nom d'une vue doit être modifier dans le code est marqué part // ABCDEF
-- SUPPR si des attributs ont été supprimés

-- ==================

-- LISTE DES TECHNICIENS DE TIX
CREATE OR REPLACE VIEW vue_technicien AS
SELECT ID_USER,
    CONCAT(UPPER(SUBSTRING(PRENOM_USER, 1, 1)), LOWER(SUBSTRING(PRENOM_USER, 2))) as PRENOM_USER,
    UCASE(NOM_USER) AS `NOM_USER`,
    EMAIL_USER
FROM DB_TIX.Utilisateur
JOIN mysql.user ON mysql.user.User = ID_USER
WHERE mysql.user.default_role = "role_technicien";



-- ================================



CREATE OR REPLACE VIEW vue_Ticket_visiteur AS
SELECT ID_TICKET, TITRE_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_DEFINITIF_TICKET, ETAT_TICKET, HORODATAGE_CREATION_TICKET
FROM Ticket
WHERE NIV_URGENCE_DEFINITIF_TICKET != "Non complété !"
AND ETAT_TICKET != "En attente"
ORDER BY ID_TICKET DESC
LIMIT 10;

CREATE OR REPLACE VIEW vue_tv_relation_ticket_motcle AS
SELECT RTM.ID_TICKET, RTM.NOM_MOTCLE
FROM RelationTicketsMotscles AS RTM
    JOIN vue_Ticket_visiteur AS TV ON RTM.ID_TICKET = TV.ID_TICKET;

-- Utilisateur
CREATE OR REPLACE VIEW vue_Utilisateur_client AS
SELECT
    `DB_TIX`.`Utilisateur`.`ID_USER` AS `ID_USER`,
    `DB_TIX`.`Utilisateur`.`LOGIN_USER` AS `LOGIN_USER`,
    CONCAT(UPPER(SUBSTRING(PRENOM_USER, 1, 1)), LOWER(SUBSTRING(PRENOM_USER, 2))) AS PRENOM_USER,
    UCASE(`DB_TIX`.`Utilisateur`.`NOM_USER`) AS `NOM_USER`,
    `user`.`default_role` AS `ROLE_USER`,
    `DB_TIX`.`Utilisateur`.`EMAIL_USER` AS `EMAIL_USER`
FROM
    `DB_TIX`.`Utilisateur`
JOIN mysql.user ON
    `user`.`User` = `DB_TIX`.`Utilisateur`.`ID_USER`
WHERE
    `DB_TIX`.`Utilisateur`.`ID_USER` = SUBSTRING_INDEX(USER(), '@', 1);

-- ABCDEF anciennement : vue_Utilisateur_insertion_client
CREATE OR REPLACE VIEW vue_Utilisateur_maj_email AS
SELECT ID_USER, EMAIL_USER
FROM Utilisateur
WHERE ID_USER = SUBSTRING_INDEX(USER(), '@', 1);

CREATE OR REPLACE VIEW vue_Ticket_client AS
SELECT T.ID_TICKET, T.TITRE_TICKET, T.DESCRIPTION_TICKET, T.ID_TECHNICIEN, T.NIV_URGENCE_ESTIMER_TICKET, T.NIV_URGENCE_DEFINITIF_TICKET,
    T.ETAT_TICKET, T.HORODATAGE_CREATION_TICKET, T.HORODATAGE_DEBUT_TRAITEMENT_TICKET, T.HORODATAGE_RESOLUTION_TICKET,
    T.HORODATAGE_DERNIERE_MODIF_TICKET, T.ID_USER_DERNIERE_MODIF_TICKET,
    CONCAT(UPPER(SUBSTRING(TECH.PRENOM_USER, 1, 1)), LOWER(SUBSTRING(TECH.PRENOM_USER, 2))) as PRENOM_TECH,
    UCASE(TECH.NOM_USER) AS `NOM_TECH`,
    TECH.EMAIL_USER as EMAIL_TECH,
    
    CONCAT(UPPER(SUBSTRING(MODIFIEUR.PRENOM_USER, 1, 1)), LOWER(SUBSTRING(MODIFIEUR.PRENOM_USER, 2))) AS PRENOM_MODIFIEUR,
    UCASE(MODIFIEUR.NOM_USER) AS NOM_MODIFIEUR,
    MODIFIEUR.EMAIL_USER AS EMAIL_MODIFIEUR
FROM Ticket AS T
LEFT OUTER JOIN vue_technicien AS TECH ON T.ID_TECHNICIEN = TECH.ID_USER
LEFT OUTER JOIN Utilisateur AS MODIFIEUR ON T.ID_USER_DERNIERE_MODIF_TICKET = MODIFIEUR.ID_USER
WHERE T.ID_USER = SUBSTRING_INDEX(USER(), '@', 1)
ORDER BY ID_TICKET DESC;

-- LISTE DE TOUS LES UTILISATEURS DE TIX POUR L'ADMINISTRATEUR WEB
CREATE OR REPLACE VIEW affiche_utilisateurs_pour_adm_web AS
    SELECT
    ID_USER,
    UCASE(`DB_TIX`.`Utilisateur`.`NOM_USER`) AS `NOM_USER`,
    CONCAT(UPPER(SUBSTRING(PRENOM_USER, 1, 1)), LOWER(SUBSTRING(PRENOM_USER, 2))) AS PRENOM_USER
    FROM DB_TIX.Utilisateur
        WHERE (ObtenirRoleDunUtilisateur(ID_USER) COLLATE utf8mb4_unicode_ci) = ('role_utilisateur' COLLATE utf8mb4_unicode_ci);

-- LE TABLEAU DE BORD

/*Note pour les case : pour chaque case pour la colonne indiqué, si c'est le bon rôle alors on affiche la valeur, sinon, on affiche "ACCÈS INTERDIT" à l'emplacement de la colonne.
On procède ainsi car à cause des JOIN, il n'est pas possible de préciser les colonnes dans le GRANT SELECT. Sauf qu'on veut cacher des informations.
C'est un peu lourd... Mais on peut difficilement faire autrement (et rapidement à mettre en place aussi) au vu des limites de MariaDB.
*/
CREATE OR REPLACE VIEW vue_tableau_bord AS
    SELECT
    T.ID_TICKET,
    T.TITRE_TICKET,
    T.DESCRIPTION_TICKET,
    T.NIV_URGENCE_ESTIMER_TICKET,
    T.NIV_URGENCE_DEFINITIF_TICKET,
    T.ETAT_TICKET,
    T.HORODATAGE_CREATION_TICKET,
    T.HORODATAGE_DERNIERE_MODIF_TICKET, 

    CONCAT(UPPER(SUBSTRING(TECH.PRENOM_USER, 1, 1)), LOWER(SUBSTRING(TECH.PRENOM_USER, 2))) as PRENOM_TECH,
    UCASE(TECH.NOM_USER) AS `NOM_TECH`,
    TECH.EMAIL_USER as EMAIL_TECH,
    CASE WHEN (ObtenirRoleUtilisateur() = ('role_technicien' COLLATE utf8mb4_unicode_ci) OR ObtenirRoleUtilisateur() = ('role_admin_web' COLLATE utf8mb4_unicode_ci))THEN T.ID_TECHNICIEN ELSE 'ACCÈS INTERDIT' -- On affiche la valeur que si la personne est un tech ou adm web
    END AS ID_TECHNICIEN,

    CASE WHEN (ObtenirRoleUtilisateur() = ('role_technicien' COLLATE utf8mb4_unicode_ci) OR ObtenirRoleUtilisateur() = ('role_admin_web' COLLATE utf8mb4_unicode_ci)) THEN T.ID_USER ELSE 'ACCÈS INTERDIT'
    END AS ID_CREA,   
    CASE WHEN (T.ID_USER = substring_index(user(),'@',1) OR ObtenirRoleUtilisateur() = ('role_technicien' COLLATE utf8mb4_unicode_ci) OR ObtenirRoleUtilisateur() = ('role_admin_web' COLLATE utf8mb4_unicode_ci))
    THEN CONCAT(UPPER(SUBSTRING(CREA.PRENOM_USER, 1, 1)), LOWER(SUBSTRING(CREA.PRENOM_USER, 2))) ELSE 'ACCÈS INTERDIT'
    END AS PRENOM_CREA,  
    CASE WHEN (T.ID_USER = substring_index(user(),'@',1) OR ObtenirRoleUtilisateur() = ('role_technicien' COLLATE utf8mb4_unicode_ci) OR ObtenirRoleUtilisateur() = ('role_admin_web' COLLATE utf8mb4_unicode_ci))
    THEN UCASE(CREA.NOM_USER) ELSE 'ACCÈS INTERDIT'
    END AS NOM_CREA,
    CASE WHEN (T.ID_USER = substring_index(user(),'@',1) OR ObtenirRoleUtilisateur() = ('role_technicien' COLLATE utf8mb4_unicode_ci) OR ObtenirRoleUtilisateur() = ('role_admin_web' COLLATE utf8mb4_unicode_ci))
    THEN CREA.EMAIL_USER ELSE 'ACCÈS INTERDIT'
    END AS EMAIL_CREA,

    CASE WHEN (T.ID_USER = substring_index(user(),'@',1) OR ObtenirRoleUtilisateur() = ('role_technicien' COLLATE utf8mb4_unicode_ci) OR ObtenirRoleUtilisateur() = ('role_admin_web' COLLATE utf8mb4_unicode_ci))
    THEN CONCAT(UPPER(SUBSTRING(MODIFIEUR.PRENOM_USER, 1, 1)), LOWER(SUBSTRING(MODIFIEUR.PRENOM_USER, 2))) ELSE 'ACCÈS INTERDIT'
    END AS PRENOM_MODIFIEUR,
    CASE WHEN (T.ID_USER = substring_index(user(),'@',1) OR ObtenirRoleUtilisateur() = ('role_technicien' COLLATE utf8mb4_unicode_ci) OR ObtenirRoleUtilisateur() = ('role_admin_web' COLLATE utf8mb4_unicode_ci))
    THEN UCASE(MODIFIEUR.NOM_USER) ELSE 'ACCÈS INTERDIT'
    END AS NOM_MODIFIEUR,
    CASE WHEN (T.ID_USER = substring_index(user(),'@',1) OR ObtenirRoleUtilisateur() = ('role_technicien' COLLATE utf8mb4_unicode_ci) OR ObtenirRoleUtilisateur() = ('role_admin_web' COLLATE utf8mb4_unicode_ci))
    THEN MODIFIEUR.EMAIL_USER ELSE 'ACCÈS INTERDIT'
    END AS EMAIL_MODIFIEUR

    FROM Ticket AS T
        JOIN Utilisateur AS CREA ON T.ID_USER = CREA.ID_USER
        LEFT OUTER JOIN vue_technicien AS TECH ON T.ID_TECHNICIEN = TECH.ID_USER
        LEFT OUTER JOIN Utilisateur AS MODIFIEUR ON T.ID_USER_DERNIERE_MODIF_TICKET = MODIFIEUR.ID_USER
    WHERE T.ETAT_TICKET = "Ouvert"
       OR T.ETAT_TICKET = "En cours de traitement"
       OR (T.ETAT_TICKET = "En attente" AND (T.ID_USER = substring_index(user(),'@',1) OR (SELECT role_user FROM vue_Utilisateur_client) = "role_admin_web"))
    ORDER BY ID_TICKET DESC;

-- ABCDEF anciennement : vue_tdb_relation_ticket_libelle
CREATE OR REPLACE VIEW vue_tdb_relation_ticket_motcle AS
SELECT RTM.ID_TICKET, RTM.NOM_MOTCLE
FROM RelationTicketsMotscles AS RTM
    JOIN vue_tableau_bord AS TDB ON RTM.ID_TICKET = TDB.ID_TICKET;

-- ABCDEF anciennement : vue_suppr_rtl_tdb
CREATE OR REPLACE VIEW vue_suppr_rtm_tdb AS
SELECT RTM.ID_TICKET, RTM.NOM_MOTCLE
FROM RelationTicketsMotscles AS RTM
WHERE verifTicketPeutEtreModif(RTM.ID_TICKET) = 1;


-- LES VUES LIÉES AUX MODIFICATIONS DES TICKETS

-- SUPPR , HORODATAGE_DERNIERE_MODIF_TICKET
CREATE OR REPLACE VIEW vue_modif_creation_ticket_utilisateur AS
SELECT ID_TICKET,TITRE_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET
FROM Ticket
WHERE ID_USER = SUBSTRING_INDEX(USER(), '@', 1)
AND ETAT_TICKET = 'En attente';

-- SUPPR , ETAT_TICKET, HORODATAGE_DERNIERE_MODIF_TICKET, HORODATAGE_RESOLUTION_TICKET
CREATE OR REPLACE VIEW vue_modif_ticket_adm_tech AS
SELECT ID_TICKET,TITRE_TICKET, DESCRIPTION_TICKET, ID_TECHNICIEN, NIV_URGENCE_DEFINITIF_TICKET
FROM Ticket
WHERE (ETAT_TICKET = "En cours de traitement" AND ID_TECHNICIEN = SUBSTRING_INDEX(USER(), '@', 1)) OR (ObtenirRoleUtilisateur() = ("role_admin_web" COLLATE utf8mb4_unicode_ci) AND (ETAT_TICKET != "Fermé"));

-- SUPPR , HORODATAGE_DEBUT_TRAITEMENT_TICKET
CREATE OR REPLACE VIEW vue_associe_ticket_tech AS
SELECT ID_TICKET, ID_TECHNICIEN
FROM Ticket
WHERE (ETAT_TICKET = "Ouvert");


-- LES VUES LIÉES A L'HISTORIQUE DES TICKETS
CREATE OR REPLACE VIEW vue_historique AS
SELECT T.ID_TICKET, T.TITRE_TICKET, T.DESCRIPTION_TICKET, T.NIV_URGENCE_DEFINITIF_TICKET, T.ETAT_TICKET, T.HORODATAGE_CREATION_TICKET, T.HORODATAGE_DERNIERE_MODIF_TICKET, T.ID_TECHNICIEN, T.ID_USER, CREA.PRENOM_USER, CREA.NOM_USER, TECH.PRENOM_USER as PRENOM_TECH, TECH.NOM_USER as NOM_TECH
FROM Ticket AS T
    JOIN Utilisateur AS CREA ON T.ID_USER = CREA.ID_USER
    LEFT OUTER JOIN Utilisateur AS TECH ON T.ID_TECHNICIEN = TECH.ID_USER
WHERE T.ETAT_TICKET = "Fermé";

-- ABCDEF anciennement : vue_historique_relation_ticket_libelle
CREATE OR REPLACE VIEW vue_historique_relation_ticket_motcle AS
SELECT RTM.ID_TICKET, RTM.NOM_MOTCLE
FROM RelationTicketsMotscles AS RTM
    JOIN vue_historique AS H ON RTM.ID_TICKET = H.ID_TICKET;

