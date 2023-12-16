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

GRANT EXECUTE ON FUNCTION ObtenirRoleUtilisateur TO 'role_utilisateur';
GRANT EXECUTE ON FUNCTION ObtenirRoleUtilisateur TO 'role_technicien';
GRANT EXECUTE ON FUNCTION ObtenirRoleUtilisateur TO 'role_admin_sys';
GRANT EXECUTE ON FUNCTION ObtenirRoleUtilisateur TO 'role_admin_web';
