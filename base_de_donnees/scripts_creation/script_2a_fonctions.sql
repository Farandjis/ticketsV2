DROP FUNCTION IF EXISTS ObtenirRoleUtilisateur;

DELIMITER // -- Désormais une requête se termine par // (pour éviter tout problème dans la fonction)

CREATE FUNCTION ObtenirRoleUtilisateur()
RETURNS LONGTEXT
BEGIN
  DECLARE sonRole VARCHAR(30) COLLATE utf8mb4_general_ci; -- On déclare une variable au formatage utf8mb4_general_ci
  SELECT ROLE_USER INTO sonRole FROM vue_Utilisateur_client LIMIT 1; -- On instancie la variable avec le rôle de l'utilisateur
  RETURN sonRole COLLATE utf8mb4_general_ci; -- On renvois le rôle dont on essaye de remettre le bon formatage...
END //

DELIMITER ; -- On remet le délimiteur par défaut pour les requêtes





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

    -- Vérifie si l'id_ticket se trouve dans la vue_tableau_bord
    SELECT etat_ticket INTO etat_ticket_recup
    FROM vue_tableau_bord
    WHERE id_ticket = id_ticket_param;

    -- Retourne l'état du ticket s'il existe dans la vue
    RETURN etat_ticket_recup;
END //

DELIMITER ;





-- ===================================================== FERMER UN TICKET
DROP FUNCTION IF EXISTS FermerUnTicket;

DELIMITER //
CREATE FUNCTION FermerUnTicket(id_ticket_param INT) RETURNS BOOLEAN
BEGIN
    DECLARE ticketPeutEtreFermer INT;

    -- Vérifier si l'id_ticket se trouve dans la vue modif ticket adm tech
    SELECT COUNT(*) INTO ticketPeutEtreFermer
    FROM vue_modif_ticket_adm_tech
    WHERE id_ticket = id_ticket_param;

    -- Si le ticket est présent la liste des tickets pouvant être modifié par l'admin web ou le technicien, on peut le fermer
    IF (ticketPeutEtreFermer = 1) THEN
        UPDATE DB_TIX.Ticket SET DB_TIX.Ticket.ETAT_TICKET = 'Fermé' WHERE DB_TIX.Ticket.ID_TICKET = id_ticket_param;
        RETURN True;
    ELSE
        RETURN False; -- Le ticket n'a pas été fermé
    END IF;

END //
DELIMITER ; -- On remet le délimiteur par défaut pour les requêtes

GRANT EXECUTE ON FUNCTION FermerUnTicket TO role_technicien;
GRANT EXECUTE ON FUNCTION FermerUnTicket TO role_admin_web;
