-- Supprimer le déclencheur s'il existe
DROP TRIGGER IF EXISTS update_etat_ticket;

DELIMITER //

CREATE TRIGGER update_etat_ticket
BEFORE UPDATE ON Ticket
FOR EACH ROW
BEGIN
    -- Mettre à jour l'attribut ETAT_TICKET à "En cours de traitement" si l'ID_TECHNICIEN change
    IF (IFNULL(NEW.ID_TECHNICIEN, 0) <> IFNULL(OLD.ID_TECHNICIEN, 0)) THEN
        SET NEW.ETAT_TICKET = 'En cours de traitement';
        SET NEW.HORODATAGE_DEBUT_TRAITEMENT_TICKET = CURRENT_TIMESTAMP();
    END IF;
END //

DELIMITER ;
