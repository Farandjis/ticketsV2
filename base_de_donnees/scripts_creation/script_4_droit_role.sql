
/*
Il faut exécuter ce code avec l'utilisateur fictif_droitDB
*/






-- ======================== LES UTILISATEURS ========================
-- info sur l'utilisateur
GRANT SELECT ON DB_TIX.vue_Utilisateur_client TO 'role_utilisateur';

-- tous ses tickets
GRANT SELECT ON DB_TIX.vue_Ticket_client TO 'role_utilisateur';

-- Mettre à jour son adresse email
GRANT UPDATE(EMAIL_USER) ON DB_TIX.vue_Utilisateur_maj_email TO 'role_utilisateur';

-- Voir les différents mots-clés disponibles pour un ticket
GRANT SELECT ON DB_TIX.MotcleTicket TO 'role_utilisateur';

-- Voir les différents titres disponibles pour un ticket
GRANT SELECT ON TitreTicket TO 'role_utilisateur';

-- Voir les différentes urgences disponibles pour un ticket;
GRANT SELECT ON UrgenceTicket TO 'role_utilisateur';

-- Voir les tickets de son tableau de bord
GRANT SELECT ON DB_TIX.vue_tableau_bord TO 'role_utilisateur'; -- A cause des JOIN, on doit donner l'accès SELECT intégrale (mais la vu limite)

-- Voir les mots-clés associés aux tickets du tableau de bord
GRANT SELECT ON DB_TIX.vue_tdb_relation_ticket_motcle TO 'role_utilisateur';

-- Voir les tickets qu'il peut modifier
GRANT SELECT(ID_TICKET)
    ON DB_TIX.vue_modif_creation_ticket_utilisateur
    TO 'role_utilisateur';

-- Ajouter un ticket
GRANT INSERT(TITRE_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET)
    ON DB_TIX.vue_modif_creation_ticket_utilisateur
    TO 'role_utilisateur';

-- Modifier un de ses tickets
GRANT UPDATE(TITRE_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET)
    ON DB_TIX.vue_modif_creation_ticket_utilisateur
    TO 'role_utilisateur';

-- DANGER : le problème est que l'utilisateur peut associés des mots clés à n'importe quel ticket
-- Permet d'insérer un couple (ticket, mot-clé)
GRANT INSERT ON DB_TIX.RelationTicketsMotscles TO 'role_utilisateur';

-- Voir les couples (ticket, mot-clé) qu'il peut supprimer
GRANT SELECT ON DB_TIX.vue_suppr_rtm_tdb TO 'role_utilisateur';

-- Supprimer un couple (ticket, mot-clé)
GRANT DELETE ON DB_TIX.vue_suppr_rtm_tdb TO 'role_utilisateur';

-- Voir les différents techniciens de la plateforme
GRANT SELECT ON DB_TIX.vue_technicien TO 'role_utilisateur';





-- ======================== LES TECHNICIENS ========================
-- Les techniciens sont des utilisateurs
GRANT 'role_utilisateur' TO 'role_technicien';

-- Voir les tickets qu'il peut modifier en tant que technicien
GRANT SELECT(ID_TICKET)
    ON vue_modif_ticket_adm_tech
    TO 'role_technicien';

-- Modifier les tickets en tant que technicien
GRANT UPDATE(TITRE_TICKET, DESCRIPTION_TICKET)
    ON vue_modif_ticket_adm_tech
    TO 'role_technicien';

-- Voir les tickets qu'il peut s'attribuer
GRANT SELECT(ID_TICKET) ON vue_associe_ticket_tech TO 'role_technicien';

-- Modifier pour s'attribuer un ticket
GRANT UPDATE(ID_TECHNICIEN)
ON vue_associe_ticket_tech
TO 'role_technicien';





-- ======================== L'ADMINISTRATEUR WEB ========================
-- Les L'administrateur web est un utilisateur.
GRANT 'role_utilisateur' TO 'role_admin_web';

-- Il possède aussi le rôle technicien, sauf qu'il ne l'activera jamais (en principe).
-- C'est uniquement pour le transmettre.
GRANT role_technicien TO role_admin_web WITH ADMIN OPTION;

-- Voir les tickets qu'il peut modifier en tant qu'administrateur web
GRANT SELECT(ID_TICKET)
    ON vue_modif_ticket_adm_tech
    TO 'role_admin_web';

-- Modifier les tickets en tant qu'administrateur web
GRANT UPDATE(TITRE_TICKET, ID_TECHNICIEN, DESCRIPTION_TICKET, NIV_URGENCE_DEFINITIF_TICKET)
    ON vue_modif_ticket_adm_tech
    TO 'role_admin_web';

-- Ajouter un titre
GRANT INSERT ON TitreTicket TO 'role_admin_web';

-- Supprimer un titre
GRANT DELETE ON TitreTicket TO 'role_admin_web';

-- Ajouter un mot clé
GRANT INSERT ON DB_TIX.MotcleTicket TO 'role_admin_web';

-- Supprimer un mot clé
GRANT DELETE ON DB_TIX.MotcleTicket TO 'role_admin_web';

-- Ajouter un couple (ticket, mot-clé) (note : répétition avec les droits de l'utilisateur, mais il n'est pas sur que l'utilisateur le garde)
GRANT INSERT ON DB_TIX.RelationTicketsMotscles TO 'role_admin_web';

-- Supprimer un couple (ticket, mot-clé)
GRANT DELETE ON DB_TIX.RelationTicketsMotscles TO 'role_admin_web';

-- Voir tous les utilisateurs de la plateforme TIX
GRANT SELECT ON affiche_utilisateurs_pour_adm_web TO 'role_admin_web';



-- ======================== L'ADMINISTRATEUR SYSTÈME ========================
GRANT 'role_utilisateur' TO 'role_admin_sys';

GRANT SELECT
ON vue_historique
TO 'role_admin_sys';

GRANT SELECT
ON vue_historique_relation_ticket_motcle
TO 'role_admin_sys';
