// Ce script corrige l'absence d'une table "niveau durgence" du ticket.
// https://sql.sh/cours/alter-table#google_vignette
// https://blog.developpez.com/elsuket/p7900/moteur-de-base-de-donnees-sql-server/indexation/ajouter_des_contraintes_a_des_tables_dej
// https://www.w3schools.com/sql/sql_default.asp

CREATE TABLE UrgenceTicket(
	VALEUR_URGENCE_TICKET VARCHAR(15) PRIMARY KEY
	);
	
INSERT INTO UrgenceTicket (VALEUR_URGENCE_TICKET) VALUES
	    ('Non complété !'),
	    ('Faible'),
	    ('Moyen'),
	    ('Important'),
	    ('Urgent');

// Modification de la taille des valeurs des deux attributs	   
ALTER TABLE Ticket MODIFY (NIV_URGENCE_ESTIMER_TICKET, VARCHAR(15));
ALTER TABLE Ticket MODIFY (NIV_URGENCE_DEFINITIF_TICKET, VARCHAR(15));

// Création des deux clés étrangères
ALTER TABLE Ticket
	ADD CONSTRAINT NIV_URGENCE_ESTIMER_TICKET
  	FOREIGN KEY(NIV_URGENCE_ESTIMER_TICKET)
  	REFERENCES UrgenceTicket(VALEUR_URGENCE_TICKET);
  
ALTER TABLE Ticket
	ADD CONSTRAINT NIV_URGENCE_DEFINITIF_TICKET
  	FOREIGN KEY(NIV_URGENCE_DEFINITIF_TICKET)
  	REFERENCES UrgenceTicket(VALEUR_URGENCE_TICKET);
  	
// On indique une valeur par défaut aux deux attributs
ALTER TABLE Ticket
	ALTER NIV_URGENCE_ESTIMER_TICKET SET DEFAULT 'Non complété !';
	
ALTER TABLE Ticket
	ALTER NIV_URGENCE_DEFINITIF_TICKET SET DEFAULT 'Non complété !';

