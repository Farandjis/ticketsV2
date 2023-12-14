CREATE OR REPLACE VIEW vue_Ticket_visiteur AS
SELECT ID_TICKET, OBJET_TICKET, DESCRIPTION_TICKET, NIV_URGENCE_DEFINITIF_TICKET, ETAT_TICKET, HORODATAGE_CREATION_TICKET
FROM Ticket
WHERE NIV_URGENCE_DEFINITIF_TICKET != "Non complété !"
AND ETAT_TICKET != "En attente"
ORDER BY HORODATAGE_CREATION_TICKET DESC
LIMIT 10;

DROP VIEW vue_Utilisateur_visiteur;