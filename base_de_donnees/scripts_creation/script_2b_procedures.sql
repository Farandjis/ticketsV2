
-- ===================================================== SUPPRIMER SON COMPTE
DROP PROCEDURE IF EXISTS ATTENTION_SupprimerSonCompte;

DELIMITER // -- Désormais une requête se termine par // (pour éviter tout problème dans la fonction)
CREATE PROCEDURE ATTENTION_SupprimerSonCompte()
BEGIN
    DECLARE monRole VARCHAR(50);
    -- Récupérer le rôle de l'utilisateur qui a fait appel à la commande
    SELECT ObtenirRoleUtilisateur() INTO monRole;


    -- Note : USER() correspond à l'utilisateur qui a fait appel à la commande

    -- On vérifie que c'est un utilisateur
    IF (monRole = 'role_utilisateur') THEN
        -- Si oui, on supprime le compte

        -- En principe, les modifications sont prises en compte uniquement quand on atteint le commit.
        -- S'il y a un plantage entre temps, le compte est toujours utilisable.
        -- Je dis en principe, car en PHP, CREATE USER provoquait un autocommit donc je sais pas pour REVOKE et DROP USER...
        START TRANSACTION;

	    -- On retire l'utilisateur de la liste des utilisateurs de la plateforme TIX.
        UPDATE DB_TIX.Utilisateur SET login_user = NULL, prenom_user = 'Utilisateur', nom_user = 'SUPPRIMÉ', email_user = 'supprimer@tix.fr', HORODATAGE_DERNIERE_CONNECTION_USER = current_timestamp() WHERE ID_USER = SUBSTRING_INDEX(USER(), '@', 1);
	-- On met à jour les tickets si l'utilisateur était technicien et qu'ils sont toujours en cours.
	UPDATE DB_TIX.Ticket SET ID_TECHNICIEN = NULL, ETAT_TICKET = "Ouvert" WHERE ID_TECHNICIEN = SUBSTRING_INDEX(USER(), '@', 1) AND ETAT_TICKET = "En cours de traitement";

	    -- On retire l'intégralité des droits au compte MariaDB de l'utilisateur.
	    SET @suppression_droits = CONCAT('REVOKE ALL ON *.* FROM ', QUOTE(SUBSTRING_INDEX(USER(), '@', 1)),'@',QUOTE(SUBSTRING_INDEX(USER(), '@', -1)));
        PREPARE suppression_droits2 FROM @suppression_droits;
        EXECUTE suppression_droits2;
        DEALLOCATE PREPARE suppression_droits2;

	    -- On supprime le compte MariaDB.
        SET @suppression_compte = CONCAT('DROP USER ', QUOTE(SUBSTRING_INDEX(USER(), '@', 1)),'@',QUOTE(SUBSTRING_INDEX(USER(), '@', -1)));
        PREPARE suppression_compte2 FROM @suppression_compte;
        EXECUTE suppression_compte2;
        DEALLOCATE PREPARE suppression_compte2;


	    COMMIT;
        -- Le compte TIX et MariaDB ont été effacés, la plateforme ne possède plus ses données personnelles et l'utilisateur ne peut plus se connecter.

    END IF;
END //
DELIMITER ; -- On remet le délimiteur par défaut pour les requêtes

GRANT EXECUTE ON PROCEDURE ATTENTION_SupprimerSonCompte TO role_utilisateur;
GRANT EXECUTE ON PROCEDURE ATTENTION_SupprimerSonCompte TO role_technicien;






-- ===================================================== SUPPRESSION DE TOUS LES COMPTES INUTILISÉS
/*
Procédure qui supprime tous les comptes utilisateurs et techniciens inactifs depuis au moins 36 mois.

ATTENTION ! CETTE PROCÉDURE N'UTILISE PAS ATTENTION_SupprimerSonCompte !!
Si le système de suppression de compte est modifié sur l'une des deux, il faut également le modifier sur l'autre !
*/

DROP PROCEDURE IF EXISTS ATTENTION_SupprimerTousLesComptesInutilises;

DELIMITER //
CREATE PROCEDURE ATTENTION_SupprimerTousLesComptesInutilises()
BEGIN

    -- Variable pour stocker l'ID User de l'utilisateur qu'on va supprimer
    DECLARE unIDUtilisateur INT;

    -- Déclarer une condition pour continuer ou non
    DECLARE cestFinit INT DEFAULT FALSE;



    -- On récupère tous les identifiants des comptes qui ne se sont pas connecté depuis au moins 36 mois.
    DECLARE lesIDUtilisateurs CURSOR FOR
        SELECT ID_USER
        FROM Utilisateur
        JOIN mysql.user ON user.User = Utilisateur.ID_USER AND default_role = 'role_utilisateur'
        WHERE DATEDIFF(CURDATE(), HORODATAGE_DERNIERE_CONNECTION_USER) >= 1095 AND LOGIN_USER IS NOT NULL; -- DATEDIFF : nombre de jours de différence


    -- Lorsqu'il n'y a plus de ligne à traiter dans le curseur, CONTINUE HANDLER est appelé.
    -- Ici, lorsqu'on a plus rien à a traiter, on marque la variable comme True. Hors True dans le if de la boucle signifie quitter la boucle.
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cestFinit = TRUE;

    OPEN lesIDUtilisateurs;

    -- Parcourir les utilisateurs concernés
    read_loop: LOOP
        FETCH lesIDUtilisateurs INTO unIDUtilisateur; -- On récupère l'ID de l'utilisateur sélectionné dans la liste des ID

        -- Sortir de la boucle s'il n'y a plus d'enregistrements
        IF cestFinit THEN
            LEAVE read_loop;
        END IF;

        
        -- Même fonctionnement que la procédure qui permet à l'utilisateur de supprimer de lui même son compte
        
        START TRANSACTION;
        
        -- On retire l'utilisateur de la liste des utilisateurs de la plateforme TIX.
        UPDATE DB_TIX.Utilisateur SET login_user = NULL, prenom_user = 'Utilisateur', nom_user = 'SUPPRIMÉ AUTO', email_user = 'supprimer.automatiquement@tix.fr', IP_DERNIERE_CONNECTION_USER = '0.0.0.0' WHERE ID_USER = unIDUtilisateur;

	-- On met à jour les tickets si l'utilisateur était technicien et qu'ils sont toujours en cours.
	UPDATE Ticket SET ID_TECHNICIEN = NULL, ETAT_TICKET = "Ouvert" WHERE ID_TECHNICIEN = parID_USER AND ETAT_TICKET = "En cours de traitement";

        -- On retire l'intégralité des droits au compte MariaDB de l'utilisateur.
	SET @suppression_droits = CONCAT('REVOKE ALL ON *.* FROM ', QUOTE(unIDUtilisateur),'@',QUOTE('localhost'));
        PREPARE suppression_droits2 FROM @suppression_droits;
        EXECUTE suppression_droits2;
        DEALLOCATE PREPARE suppression_droits2;
        
	-- On supprime le compte MariaDB.
        SET @suppression_compte = CONCAT('DROP USER ', QUOTE(unIDUtilisateur),'@',QUOTE('localhost'));
        PREPARE suppression_compte2 FROM @suppression_compte;
        EXECUTE suppression_compte2;
        DEALLOCATE PREPARE suppression_compte2;
        
        COMMIT;
        -- Le compte TIX et MariaDB ont été effacés, la plateforme ne possède plus ses données personnelles et l'utilisateur ne peut plus se connecter.

    END LOOP;

    CLOSE lesIDUtilisateurs;
END //
DELIMITER ;


-- ===================================================== ACTIVATION ROLE UTILISATEUR OU TECHNICIEN PAR L'ADMIN WEB

DROP PROCEDURE IF EXISTS activerUnRoleTechOuUtiParAdminWeb;
DELIMITER //

/*
Créer pour l'admin web, même si n'importe qui ayant les droits de grant et ayant accès en écriture à la DB mysql peut l'utiliser.
Au préalable, la personne doit posséder le rôle à activer. Cette fonction active le rôle tech si c'est un utilisateur, utilisateur si c'est un tech.
Si c'est un tech qui devient un utilisateur, on lui supprime son rôle de technicien. Il faudra le GRANT à nouveau s'il redevient un technicien

parID -> STRING de l'id de l'utilisateur
parLeRole -> STRING du rôle qu'on veut activer (tech ou uti)
*/
CREATE PROCEDURE activerUnRoleTechOuUtiParAdminWeb(parID_USER VARCHAR(11), parLeRole VARCHAR(50))
BEGIN
	
    DECLARE sonRole VARCHAR(30); -- On déclare une variable au formatage utf8mb4_general_ci
    SELECT default_role INTO sonRole FROM mysql.user WHERE User = parID_USER LIMIT 1;

    -- Si c'est un vrai utilisateur de la plateforme, il possède un rôle.
    IF (sonRole IS NOT NULL) THEN
	IF (sonRole = "role_utilisateur" AND parLeRole = "role_technicien") THEN
		START TRANSACTION;

	    	-- On active le rôle technicien
	    	SET @activeRole = CONCAT('SET DEFAULT ROLE "role_technicien" FOR ', QUOTE(parID_USER),'@',QUOTE("localhost"));
        	PREPARE activeRole2 FROM @activeRole; EXECUTE activeRole2; DEALLOCATE PREPARE activeRole2;

		COMMIT;
	END IF;
	IF (sonRole = "role_technicien" AND parLeRole = "role_utilisateur") THEN
		START TRANSACTION;

		-- On met tous les tickets du technicien à Ouvert (pour qu'un autre technicien puisse les récupérers).
		UPDATE Ticket SET ID_TECHNICIEN = NULL, ETAT_TICKET = "Ouvert" WHERE ID_TECHNICIEN = parID_USER AND ETAT_TICKET = "En cours de traitement";

	    	-- On active le rôle utilisateur
	    	SET @activeRole = CONCAT('SET DEFAULT ROLE "role_utilisateur" FOR ', QUOTE(parID_USER),'@',QUOTE("localhost"));
        	PREPARE activeRole2 FROM @activeRole; EXECUTE activeRole2; DEALLOCATE PREPARE activeRole2;

		-- On retire le rôle technicien
	    	SET @supprRole = CONCAT('REVOKE "role_technicien" FROM ', QUOTE(parID_USER),'@',QUOTE("localhost"));
        	PREPARE supprRole2 FROM @supprRole; EXECUTE supprRole2; DEALLOCATE PREPARE supprRole2;
		COMMIT;
	END IF;
    END IF;

END //

DELIMITER ; -- On remet le délimiteur par défaut pour les requêtes

-- On autorise son utilisation par l'admin du Site
GRANT EXECUTE ON PROCEDURE activerUnRoleTechOuUtiParAdminWeb TO 'role_admin_web';

