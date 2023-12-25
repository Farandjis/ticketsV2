
-- ===================================================== SUPPRIMER SON COMPTE
DROP PROCEDURE IF EXISTS ATTENTION_SupprimerSonCompte;

DELIMITER // -- Désormais une requête se termine par // (pour éviter tout problème dans la fonction)
CREATE PROCEDURE ATTENTION_SupprimerSonCompte()
BEGIN
    DECLARE monRole VARCHAR(50);
    -- Récupérer le rôle de l'utilisateur qui a fait appel à la commande
    SELECT ObtenirRoleUtilisateur() INTO monRole;


    -- Note : USER() correspond à l'utilisateur qui a fait appel à la commande

    -- On vérifie que c'est soit un utilisateur, soit un technicien
    IF (monRole = 'role_utilisateur' OR monRole = 'role_technicien') THEN
        -- Si oui, on supprime le compte

        -- En principe, les modifications sont prises en compte uniquement quand on atteint le commit.
        -- S'il y a un plantage entre temps, le compte est toujours utilisable.
        -- Je dis en principe, car en PHP, CREATE USER provoquait un autocommit donc je sais pas pour REVOKE et DROP USER...
        START TRANSACTION;

	    -- On retire l'utilisateur de la liste des utilisateurs de la plateforme TIX.
        UPDATE DB_TIX.Utilisateur SET login_user = NULL, prenom_user = 'Utilisateur', nom_user = 'SUPPRIMÉ', email_user = 'supprimer@tix.fr', HORODATAGE_DERNIERE_CONNECTION_USER = current_timestamp(), IP_DERNIERE_CONNECTION_USER = '0.0.0.0' WHERE ID_USER = SUBSTRING_INDEX(USER(), '@', 1);

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



