-- DROITS POUR LES VUES DE TABLEAU DE BORD

/*
GRANT SELECT(ID_TICKET, OBJET_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_DEFINITIF_TICKET,
             ETAT_TICKET, HORODATAGE_CREATION_TICKET, HORODATAGE_DERNIERE_MODIF_TICKET, PRENOM_TECH, NOM_TECH)
ON vue_tableau_bord
TO 'role_utilisateur';

GRANT SELECT(ID_TICKET, OBJET_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_DEFINITIF_TICKET,
             ETAT_TICKET, HORODATAGE_CREATION_TICKET, HORODATAGE_DERNIERE_MODIF_TICKET, PRENOM_TECH, NOM_TECH,
             ID_TECHNICIEN, ID_CREA, PRENOM_CREA, NOM_CREA)
ON vue_tableau_bord
TO 'role_technicien';

GRANT SELECT(ID_TICKET, OBJET_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_DEFINITIF_TICKET,
             ETAT_TICKET, HORODATAGE_CREATION_TICKET, HORODATAGE_DERNIERE_MODIF_TICKET, PRENOM_TECH, NOM_TECH,
             ID_TECHNICIEN, ID_CREA, PRENOM_CREA, NOM_CREA)
ON vue_tableau_bord
TO 'role_admin_web';
*/

-- A cause des JOIN, on doit donner l'accès SELECT intégrale (mais la vu limite)
GRANT SELECT ON vue_tableau_bord TO 'role_utilisateur';








GRANT UPDATE(OBJET_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_ESTIMER_TICKET, HORODATAGE_DERNIERE_MODIF_TICKET)
ON vue_modif_creation_ticket_utilisateur
TO 'role_utilisateur';

GRANT SELECT(ID_TICKET)
ON vue_modif_creation_ticket_utilisateur
TO 'role_utilisateur';

GRANT SELECT ON vue_tdb_relation_ticket_libelle TO 'role_utilisateur';
GRANT SELECT ON vue_tdb_relation_ticket_libelle TO 'role_technicien';
GRANT SELECT ON vue_tdb_relation_ticket_libelle TO 'role_admin_sys';
GRANT SELECT ON vue_tdb_relation_ticket_libelle TO 'role_admin_web';

GRANT SELECT ON Libelle TO 'role_utilisateur'; -- fonctionne aussi pour technicien, admin sys et web en principe

-- DROITS POUR LES VUES DE MODIFICATION DE TICKET
GRANT UPDATE(OBJET_TICKET, DESCRIPTION_TICKET, ETAT_TICKET, HORODATAGE_DERNIERE_MODIF_TICKET, HORODATAGE_RESOLUTION_TICKET)
ON vue_modif_ticket_adm_tech
TO 'role_technicien';
GRANT UPDATE(OBJET_TICKET, DESCRIPTION_TICKET, ETAT_TICKET, NIV_URGENCE_DEFINITIF_TICKET, HORODATAGE_DERNIERE_MODIF_TICKET, HORODATAGE_RESOLUTION_TICKET)
ON vue_modif_ticket_adm_tech
TO 'role_admin_web';

GRANT SELECT(ID_TICKET)
ON vue_modif_ticket_adm_tech
TO 'role_technicien';
GRANT SELECT(ID_TICKET)
ON vue_modif_ticket_adm_tech
TO 'role_admin_web';


-- DROITS POUR VUE ASSOCIE TICKET TECH
GRANT SELECT(ID_TICKET) ON vue_associe_ticket_tech TO 'role_technicien';
GRANT SELECT(ID_TICKET) ON vue_associe_ticket_tech TO 'role_admin_web';

GRANT UPDATE(ID_TECHNICIEN, HORODATAGE_DEBUT_TRAITEMENT_TICKET)
ON vue_associe_ticket_tech
TO 'role_technicien';
GRANT UPDATE(ID_TECHNICIEN, HORODATAGE_DEBUT_TRAITEMENT_TICKET)
ON vue_associe_ticket_tech
TO 'role_admin_web';



GRANT SELECT
ON vue_tdb_relation_ticket_libelle
TO 'role_utilisateur';

GRANT SELECT
ON vue_tdb_relation_ticket_libelle
TO 'role_technicien';

GRANT SELECT
ON vue_tdb_relation_ticket_libelle
TO 'role_admin_web';

GRANT INSERT, DELETE
ON vue_modif_relation_ticket_libelle
TO 'role_utilisateur';

GRANT INSERT, DELETE
ON vue_modif_relation_ticket_libelle
TO 'role_technicien';

GRANT INSERT, DELETE
ON vue_modif_relation_ticket_libelle
TO 'role_admin_web';

GRANT INSERT, DELETE
ON vue_modif_relation_ticket_libelle
TO 'role_admin_sys';

GRANT SELECT
ON vue_historique
TO 'role_admin_sys';

GRANT SELECT
ON vue_historique_relation_ticket_libelle
TO 'role_utilisateur';

GRANT SELECT
ON vue_historique_relation_ticket_libelle
TO 'role_technicien';

GRANT SELECT
ON vue_historique_relation_ticket_libelle
TO 'role_admin_web';

GRANT SELECT
ON vue_historique_relation_ticket_libelle
TO 'role_admin_sys';

GRANT SELECT
ON vue_technicien
TO 'role_technicien';

GRANT SELECT
ON vue_technicien
TO 'role_admin_web';

GRANT INSERT ON RelationTicketsLibelles TO 'role_utilisateur';
GRANT DELETE ON vue_suppr_rtl_tdb TO 'role_utilisateur';

GRANT SELECT ON vue_technicien TO 'role_utilisateur';
