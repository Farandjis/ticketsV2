/*
Il faut exécuter ce code avec l'utilisateur fictif_droitDB
*/

GRANT SELECT ON DB_TIX.vue_Utilisateur_client TO 'role_utilisateur';
GRANT SELECT ON DB_TIX.vue_Ticket_client TO 'role_utilisateur';
GRANT UPDATE ON DB_TIX.vue_Utilisateur_insertion_client TO 'role_utilisateur';
GRANT UPDATE ON DB_TIX.vue_Ticket_insertion_client TO 'role_utilisateur';

GRANT 'role_utilisateur' TO 'role_technicien';
GRANT UPDATE ON vue_Ticket_technicien TO 'role_technicien';

GRANT 'role_technicien' TO 'role_admin_web';
GRANT UPDATE ON vue_etat_update_admWeb TO 'role_admin_web';
GRANT INSERT ON Libelle TO 'role_admin_web';
GRANT INSERT ON RelationTicketsLibelles TO 'role_admin_web';
GRANT UPDATE ON Libelle TO 'role_admin_web';
GRANT UPDATE ON RelationTicketsLibelles TO 'role_admin_web';

GRANT 'role_technicien' TO 'role_admin_sys';
