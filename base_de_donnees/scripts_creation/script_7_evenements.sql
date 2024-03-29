-- guide : https://atranchant.developpez.com/tutoriels/mysql/evenement/

-- Active l'exécution automatique d'évènements
SET GLOBAL event_scheduler = ON;


-- ===================================================== SUPPRESSION AUTOMATIQUE DES COMPTES INUTILISÉS TOUS LES JOURS À 1H DU MATIN

DROP EVENT IF EXISTS SUPPRESSION_AUTO_COMPTES_INACTIFS;

DELIMITER //
CREATE EVENT SUPPRESSION_AUTO_COMPTES_INACTIFS
    ON SCHEDULE EVERY 1 DAY 					-- Tous les jours
    STARTS CURRENT_DATE + INTERVAL 1 DAY + INTERVAL 1 HOUR	-- A partir de demain 1h
    DO
    BEGIN
    	CALL ATTENTION_SupprimerTousLesComptesInutilises();	-- On supprime tous les comptes inactifs depuis au moins 36 mois.
END //
DELIMITER ;


-- ===================================================== DEBANISSEMENT AUTOMATIQUE DES COMPTES DONT L'ECHEANCE DU BAN EST PASSÉE TOUS LES JOURS À 1H DU MATIN

DROP EVENT IF EXISTS DEBAN_AUTO_COMPTES_ECHEANCE_PASSER;

DELIMITER //
CREATE EVENT DEBAN_AUTO_COMPTES_ECHEANCE_PASSER
    ON SCHEDULE EVERY 1 DAY 					-- Tous les jours
    STARTS CURRENT_DATE + INTERVAL 1 DAY + INTERVAL 1 HOUR	-- A partir de demain 1h
    DO
    BEGIN
    	CALL debanComptesEcheancePasser();	-- On débanni tous les comptes dont l'échéance est passé.
END //
DELIMITER ;