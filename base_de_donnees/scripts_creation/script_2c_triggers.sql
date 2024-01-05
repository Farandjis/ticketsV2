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





-- ========= [TICKET] : UN TECH NE PEUT PAS ATTRIBUER À UN AUTRE TECH UN TICKET =========
-- Si un technicien est définie, on s'assure que l'utilisateur exécutant la commande est soit l'admin web soit, le technicien défini.
-- Si c'est un technicien qui s'attribue le ticket, on vérifie que le ticket est Ouvert.
-- Sinon, il n'est pas autorisé à attribuer le ticket.

DROP TRIGGER IF EXISTS VerifQuiCestLeTechDuTicket;

DELIMITER //
CREATE TRIGGER VerifQuiCestLeTechDuTicket
BEFORE UPDATE ON Ticket
FOR EACH ROW
BEGIN
    IF (IFNULL(NEW.ID_TECHNICIEN, 0) <> IFNULL(OLD.ID_TECHNICIEN, 0)) THEN
        IF ((ObtenirRoleUtilisateur() = ("role_admin_web" COLLATE utf8mb4_general_ci) AND OLD.ETAT_TICKET != 'Fermé') OR (NEW.ID_TECHNICIEN = substring_index(user(),'@',1) AND (ObtenirRoleUtilisateur() = ("role_technicien" COLLATE utf8mb4_general_ci) AND OLD.ETAT_TICKET = 'Ouvert'))) THEN
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

            IF(SUBSTRING_INDEX(USER(),'@',1) = "phpmyfteam") THEN
            	SET NEW.ID_USER_DERNIERE_MODIF_TICKET = NULL;
            ELSE
            	SET NEW.ID_USER_DERNIERE_MODIF_TICKET = SUBSTRING_INDEX(USER(),'@',1);
            END IF;
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
        IF NEW.TITRE_TICKET != "[!] Autre problème" THEN
            SET NEW.TITRE_TICKET = OLD.TITRE_TICKET;
        END IF;
        SET NEW.DESCRIPTION_TICKET = OLD.DESCRIPTION_TICKET;
        SET NEW.ID_TECHNICIEN = OLD.ID_TECHNICIEN;
        SET NEW.NIV_URGENCE_ESTIMER_TICKET = OLD.NIV_URGENCE_ESTIMER_TICKET;
        SET NEW.NIV_URGENCE_DEFINITIF_TICKET = OLD.NIV_URGENCE_DEFINITIF_TICKET;
        SET NEW.ETAT_TICKET = OLD.ETAT_TICKET;
        SET NEW.HORODATAGE_CREATION_TICKET = OLD.HORODATAGE_CREATION_TICKET;
        SET NEW.HORODATAGE_DEBUT_TRAITEMENT_TICKET = OLD.HORODATAGE_DEBUT_TRAITEMENT_TICKET;
        SET NEW.HORODATAGE_RESOLUTION_TICKET = OLD.HORODATAGE_RESOLUTION_TICKET;
	IF(SUBSTRING_INDEX(USER(),'@',1) != "phpmyfteam") THEN
        	SET NEW.HORODATAGE_DERNIERE_MODIF_TICKET = OLD.HORODATAGE_DERNIERE_MODIF_TICKET;
		SET NEW.ID_USER_DERNIERE_MODIF_TICKET = OLD.ID_USER_DERNIERE_MODIF_TICKET;
	END IF;
    END IF;
END //
DELIMITER ;



-- ========= [RELATIONTICKETSMOTCLES] : MODIF HORODATAGE TICKET APRÈS INSERT =========
-- Met à jour l'horodatage de modification du ticket dont on lui a associé un ou plusieurs mots clés

DROP TRIGGER IF EXISTS MajHorodatageModifMotsclesTicket_INSERT;

DELIMITER //

CREATE TRIGGER MajHorodatageModifMotsclesTicket_INSERT
AFTER INSERT ON RelationTicketsMotscles
FOR EACH ROW
BEGIN
    UPDATE Ticket SET HORODATAGE_DERNIERE_MODIF_TICKET = CURRENT_TIMESTAMP() WHERE ID_TICKET = NEW.ID_TICKET;
    IF(SUBSTRING_INDEX(USER(),'@',1) = "phpmyfteam") THEN
        UPDATE Ticket SET ID_USER_DERNIERE_MODIF_TICKET = NULL WHERE ID_TICKET = NEW.ID_TICKET;
    ELSE
        UPDATE Ticket SET ID_USER_DERNIERE_MODIF_TICKET = SUBSTRING_INDEX(USER(),'@',1) WHERE ID_TICKET = NEW.ID_TICKET;
    END IF;
END //
DELIMITER ;


-- ========= [RELATIONTICKETSMOTCLES] : MODIF HORODATAGE TICKET APRÈS DELETE =========
-- Met à jour l'horodatage de modification du ticket dont on lui a retiré un ou plusieurs mots clés

DROP TRIGGER IF EXISTS MajHorodatageModifMotsclesTicket_DELETE;

DELIMITER //

CREATE TRIGGER MajHorodatageModifMotsclesTicket_DELETE
AFTER DELETE ON RelationTicketsMotscles
FOR EACH ROW
BEGIN
    UPDATE Ticket SET HORODATAGE_DERNIERE_MODIF_TICKET = CURRENT_TIMESTAMP() WHERE ID_TICKET = OLD.ID_TICKET;
    IF(SUBSTRING_INDEX(USER(),'@',1) = "phpmyfteam") THEN
        UPDATE Ticket SET ID_USER_DERNIERE_MODIF_TICKET = NULL WHERE ID_TICKET = OLD.ID_TICKET;
    ELSE
        UPDATE Ticket SET ID_USER_DERNIERE_MODIF_TICKET = SUBSTRING_INDEX(USER(),'@',1) WHERE ID_TICKET = OLD.ID_TICKET;
    END IF;
END //
DELIMITER ;


-- ========= [RELATIONTICKETSMOTCLES] : EMPÊCHE L'INSERTION DE MOTS-CLES POUR UN TICKET SI NON AUTORISÉ =========
-- Annule l'insertion d'un mot clé si l'utilisateur MariaDB n'a pas la permission de modifier ce ticket.

DROP TRIGGER IF EXISTS EMPECHE_InsertionMotsclesTicket;

DELIMITER //

CREATE TRIGGER EMPECHE_InsertionMotsclesTicket
BEFORE INSERT ON RelationTicketsMotscles
FOR EACH ROW
BEGIN
    IF verifTicketPeutEtreModif(NEW.ID_TICKET) = 0 THEN
        -- S'il est ni dans la vue modif pour Admin et Technicien, ni dans la vue modif pour Utilisateur,
        -- Alors il n'est pas possible d'ajouter un mot-clé, on génère une erreur SQL
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'ERREUR (EMPECHE_InsertionMotsclesTicket): Vous n\'êtes pas autorisé à associer un mot-clé à ce ticket.';
    END IF;

END //
DELIMITER ;



-- ========= [TITRETICKET] : SUPPRIME LES ASSOCIATIONS MOTCLE-TICKET LORS DE LA SUPPRESSION D'UN MOT-CLE =========
-- SupprRTMQuandSupprMotcle

DROP TRIGGER IF EXISTS SupprRTMQuandSupprMotcle;

DELIMITER //
CREATE TRIGGER SupprRTMQuandSupprMotcle
BEFORE DELETE ON MotcleTicket
FOR EACH ROW
BEGIN
	DELETE FROM RelationTicketsMotscles WHERE NOM_MOTCLE = OLD.NOM_MOTCLE;
END //
DELIMITER ;



DROP TRIGGER IF EXISTS SupprTTQuandSupprTitre;

DELIMITER //
CREATE TRIGGER SupprTTQuandSupprTitre
BEFORE DELETE ON TitreTicket
FOR EACH ROW
BEGIN
	IF (OLD.TITRE_TICKET = "[!] Autre problème") THEN
		SIGNAL SQLSTATE '45000'
        	SET MESSAGE_TEXT = 'ERREUR (SupprTTQuandSupprTitre): Il est impossible de supprimer le titre [!] Autre problème.';
        ELSE
		UPDATE Ticket SET TITRE_TICKET = '[!] Autre problème' WHERE TITRE_TICKET = OLD.TITRE_TICKET;
	END IF;
END //
DELIMITER ;
