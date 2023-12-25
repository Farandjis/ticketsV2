DROP FUNCTION IF EXISTS ObtenirRoleUtilisateur;

DELIMITER //

CREATE FUNCTION ObtenirRoleUtilisateur()
RETURNS LONGTEXT
BEGIN
  DECLARE sonRole VARCHAR(30) COLLATE utf8mb4_general_ci;
  SELECT ROLE_USER INTO sonRole FROM vue_Utilisateur_client LIMIT 1;
  RETURN sonRole COLLATE utf8mb4_general_ci;
END //

DELIMITER ;





DROP FUNCTION IF EXISTS verifier_id_ticket_dans_vue_tdb;
DELIMITER //

-- Fonction qui vérifie qu'un ticket est présent dans le tableau de bord de l'utilisateur
CREATE FUNCTION verifier_id_ticket_dans_vue_tdb(id_ticket_param INT) RETURNS INT
BEGIN
    DECLARE ticket_exists INT;

    -- Vérifier si l'id_ticket se trouve dans la vue_tableau_bord
    SELECT COUNT(*) INTO ticket_exists
    FROM vue_tableau_bord
    WHERE id_ticket = id_ticket_param;

    -- Retourner 1 si l'id_ticket existe dans la vue, sinon retourner 0
    RETURN IF(ticket_exists > 0, 1, 0);
END //

DELIMITER ;



DROP FUNCTION IF EXISTS recup_etat_ticket_tdb;

DELIMITER //

-- Fonction qui récupère du tableau de bord l'état d'un ticket demandé par l'utilisateur
CREATE FUNCTION recup_etat_ticket_tdb(id_ticket_param INT) RETURNS VARCHAR(30)
BEGIN
    DECLARE etat_ticket_recup VARCHAR(30);

    -- Vérifier si l'id_ticket se trouve dans la vue_tableau_bord
    SELECT etat_ticket INTO etat_ticket_recup
    FROM vue_tableau_bord
    WHERE id_ticket = id_ticket_param;

    -- Retourner l'état du ticket s'il existe dans la vue
    RETURN etat_ticket_recup;
END //

DELIMITER ;

GRANT EXECUTE ON FUNCTION ObtenirRoleUtilisateur TO 'role_utilisateur';
GRANT EXECUTE ON FUNCTION ObtenirRoleUtilisateur TO 'role_technicien';
GRANT EXECUTE ON FUNCTION ObtenirRoleUtilisateur TO 'role_admin_sys';
GRANT EXECUTE ON FUNCTION ObtenirRoleUtilisateur TO 'role_admin_web';
