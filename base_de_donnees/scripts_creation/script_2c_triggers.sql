-- Note : <> signifie !=





-- ========= [TICKET] : SI VALEUR ID TECH CHANGE -> "En cours de traitement" =========
-- Si un technicien est définie, alors on passe le ticket à En cours

DROP TRIGGER IF EXISTS PasseTicketAEnCours; -- Supprimer le déclencheur s'il existe

DELIMITER // -- Désormais une requête se termine par // (pour éviter tout problème dans la fonction)
CREATE TRIGGER PasseTicketAEnCours
BEFORE UPDATE ON Ticket
FOR EACH ROW
BEGIN
    -- Mettre à jour l'attribut ETAT_TICKET à "En cours de traitement" quand l'ID_TECHNICIEN change si:
    --  - le ticket est Ouvert
    --  - le ticket est En attente MAIS qu'un niveau d'urgence est indiqué dans l'update.
    IF ((IFNULL(NEW.ID_TECHNICIEN, 0) <> IFNULL(OLD.ID_TECHNICIEN, 0)) AND (OLD.ETAT_TICKET = 'Ouvert' OR (OLD.ETAT_TICKET = 'En attente' AND NEW.NIV_URGENCE_DEFINITIF_TICKET != NULL))) THEN
        SET NEW.ETAT_TICKET = 'En cours de traitement';
        SET NEW.HORODATAGE_DEBUT_TRAITEMENT_TICKET = CURRENT_TIMESTAMP();
    END IF;
END //
DELIMITER ; -- On remet le délimiteur par défaut pour les requêtes





-- ========= [TICKET] : SI VALEUR URGENCE DEF CHANGE -> "Ouvert" =========
-- Si l'urgence définitive est définie et que le ticket est en attente, on le passe alors à ouvert

DROP TRIGGER IF EXISTS PasseTicketAOuvert; -- Supprimer le déclencheur s'il existe

DELIMITER // -- Désormais une requête se termine par // (pour éviter tout problème dans la fonction)
CREATE TRIGGER PasseTicketAOuvert
BEFORE UPDATE ON Ticket
FOR EACH ROW
BEGIN
    -- Mettre à jour l'attribut ETAT_TICKET à "En cours de traitement" si l'ID_TECHNICIEN change
    IF ((IFNULL(NEW.NIV_URGENCE_DEFINITIF_TICKET, 0) <> IFNULL(OLD.NIV_URGENCE_DEFINITIF_TICKET, 0)) AND OLD.ETAT_TICKET = 'En attente') THEN
        SET NEW.ETAT_TICKET = 'Ouvert';
    END IF;
END //
DELIMITER ; -- On remet le délimiteur par défaut pour les requêtes





-- ========= [TICKET] : UN TECH NE PEUT PAS ATTRIBUER À UN AUTRE UN TICKET" =========
-- Si un technicien est définie, si l'utilisateur exécutant la commande est l'admin web ou le technicien définie.
-- Alors on autorise le changement de technicien, sinon, on garde comme c'était avant.

DROP TRIGGER IF EXISTS VerifQuiCestLeTechDuTicket;

DELIMITER //
CREATE TRIGGER VerifQuiCestLeTechDuTicket
BEFORE UPDATE ON Ticket
FOR EACH ROW
BEGIN
    IF (IFNULL(NEW.ID_TECHNICIEN, 0) <> IFNULL(OLD.ID_TECHNICIEN, 0)) THEN
        IF ((ObtenirRoleUtilisateur() = ("role_admin_web" COLLATE utf8mb4_general_ci)) OR NEW.ID_TECHNICIEN = substring_index(user(),'@',1)) THEN
            SET NEW.ID_TECHNICIEN = NEW.ID_TECHNICIEN;
        ELSE
            SET NEW.ID_TECHNICIEN = OLD.ID_TECHNICIEN;
            SET NEW.ETAT_TICKET = OLD.ETAT_TICKET;
        END IF;
    END IF;
END //
DELIMITER ;



-- ========= [TICKET] : Si changement sur un ticket : màj horodatage dernière modif =========

DROP TRIGGER IF EXISTS MajHorodatageModifTicket;

DELIMITER //
CREATE TRIGGER MajHorodatageModifTicket
BEFORE UPDATE ON Ticket
FOR EACH ROW
BEGIN
    IF NEW.TITRE_TICKET <=> OLD.TITRE_TICKET OR
        NEW.DESCRIPTION_TICKET <=> OLD.DESCRIPTION_TICKET OR
        NEW.ID_TECHNICIEN <=> OLD.ID_TECHNICIEN OR
        NEW.NIV_URGENCE_ESTIMER_TICKET  <=> OLD.NIV_URGENCE_ESTIMER_TICKET  OR
        NEW.NIV_URGENCE_DEFINITIF_TICKET  <=> OLD.NIV_URGENCE_DEFINITIF_TICKET  OR
        NEW.ETAT_TICKET <=> OLD.ETAT_TICKET OR
        NEW.HORODATAGE_DEBUT_TRAITEMENT_TICKET <=> OLD.HORODATAGE_DEBUT_TRAITEMENT_TICKET OR
        NEW.HORODATAGE_RESOLUTION_TICKET <=> OLD.HORODATAGE_RESOLUTION_TICKET
        THEN
            SET NEW.HORODATAGE_DERNIERE_MODIF_TICKET = CURRENT_TIMESTAMP();
    END IF;
END //
DELIMITER ;






-- ================================================================================================
-- EMPÊCHE UN CHANGEMENT DE VALEUR NON AUTORISÉ
-- ================================================================================================

-- ========= [UTILISATEUR] : INTERDICTION DE MODIFIER CERTAINES INFOS D'UN UTILISATEUR =========
-- En cas de modification de certaines infos (voir set) d'un Utilisateur, on remplace les nouvelles valeurs par les anciennes

DROP TRIGGER IF EXISTS EMPECHE_modifUtilisateurQuelquesInfos;

DELIMITER //
CREATE TRIGGER EMPECHE_modifUtilisateurQuelquesInfos
BEFORE UPDATE ON Utilisateur
FOR EACH ROW
BEGIN
    IF NEW.ID_USER <=> OLD.ID_USER OR NEW.HORODATAGE_OUVERTURE_USER <=> OLD.HORODATAGE_OUVERTURE_USER THEN
        SET NEW.ID_USER = OLD.ID_USER;
        SET NEW.HORODATAGE_OUVERTURE_USER = OLD.HORODATAGE_OUVERTURE_USER;
    END IF;
END //
DELIMITER ;


-- ========= [TICKET] : INTERDICTION DE MODIFIER CERTAINES INFOS D'UN TICKET =========
-- En cas de modification de certaines infos (voir set) d'un ticket, on remplace les nouvelles valeurs par les anciennes

DROP TRIGGER IF EXISTS EMPECHE_modifTicketQuelquesInfos;

DELIMITER //
CREATE TRIGGER EMPECHE_modifTicketQuelquesInfos
BEFORE UPDATE ON Ticket
FOR EACH ROW
BEGIN
    IF NEW.ID_TICKET <=> OLD.ID_TICKET OR NEW.ID_USER <=> OLD.ID_USER OR NEW.HORODATAGE_CREATION_TICKET <=> OLD.HORODATAGE_CREATION_TICKET THEN
        SET NEW.ID_TICKET = OLD.ID_TICKET;
        SET NEW.ID_USER = OLD.ID_USER;
        SET NEW.HORODATAGE_CREATION_TICKET = OLD.HORODATAGE_CREATION_TICKET;
    END IF;
END //
DELIMITER ;

-- ========= [TICKET] : INTERDICTION DE MODIFIER UN TICKER FERMÉ =========
-- En cas de modification d'un ticket fermé, on remplace les nouvelles valeurs par les anciennes

DROP TRIGGER IF EXISTS EMPECHE_modifTicketFermer;

DELIMITER //
CREATE TRIGGER EMPECHE_modifTicketFermer
BEFORE UPDATE ON Ticket
FOR EACH ROW
BEGIN
    IF OLD.ETAT_TICKET = 'Fermé' THEN
        SET NEW.TITRE_TICKET = OLD.TITRE_TICKET;
        SET NEW.DESCRIPTION_TICKET = OLD.DESCRIPTION_TICKET;
        SET NEW.ID_TECHNICIEN = OLD.ID_TECHNICIEN;
        SET NEW.NIV_URGENCE_ESTIMER_TICKET = OLD.NIV_URGENCE_ESTIMER_TICKET;
        SET NEW.NIV_URGENCE_DEFINITIF_TICKET = OLD.NIV_URGENCE_DEFINITIF_TICKET;
        SET NEW.ETAT_TICKET = OLD.ETAT_TICKET;
        SET NEW.HORODATAGE_CREATION_TICKET = OLD.HORODATAGE_CREATION_TICKET;
        SET NEW.HORODATAGE_DEBUT_TRAITEMENT_TICKET = OLD.HORODATAGE_DEBUT_TRAITEMENT_TICKET;
        SET NEW.HORODATAGE_RESOLUTION_TICKET = OLD.HORODATAGE_RESOLUTION_TICKET;
        SET NEW.HORODATAGE_DERNIERE_MODIF_TICKET = OLD.HORODATAGE_DERNIERE_MODIF_TICKET;
    END IF;
END //
DELIMITER ;