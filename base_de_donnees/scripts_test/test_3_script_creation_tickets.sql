-- A exécuter en tant que n'importe quel utilisateur MariaDB
-- Incomplet

INSERT INTO `Ticket`(ID_TICKET, ID_USER, `TITRE_TICKET`, `DESCRIPTION_TICKET`, `NIV_URGENCE_ESTIMER_TICKET`, ID_USER_DERNIERE_MODIF_TICKET, `HORODATAGE_CREATION_TICKET`, ETAT_TICKET, ID_USER_DERNIERE_MODIF_TICKET, HORODATAGE_DERNIERE_MODIF_TICKET, HORODATAGE_DEBUT_TRAITEMENT_TICKET, NIV_URGENCE_DEFINITIF_TICKET) VALUES (1, 3, '[AUTRE] Problème pour se connecter','Je n\'arrive pas à me connecter à ma session, ça ouvre à chaque fois une session temporaire.','Moyen', 3, "2024-01-04 17:11:35", "En cours de traitement", 4, "2024-01-05 10:59:05", "2024-01-05 10:02:48", "Important");
INSERT INTO `Ticket`(ID_TICKET, ID_USER, `TITRE_TICKET`, `DESCRIPTION_TICKET`, `NIV_URGENCE_ESTIMER_TICKET`, ID_USER_DERNIERE_MODIF_TICKET, `HORODATAGE_CREATION_TICKET`, ETAT_TICKET, ID_USER_DERNIERE_MODIF_TICKET, HORODATAGE_DERNIERE_MODIF_TICKET, HORODATAGE_DEBUT_TRAITEMENT_TICKET, NIV_URGENCE_DEFINITIF_TICKET) VALUES (2, 3, '[AUTRE] Piratage','Je crois qu\'on m\'a piraté, mes fichiers ont disparus','Urgent', 3, "2024-01-04 17:11:35", "En cours de traitement", 6, "2024-01-04 18:11:11", "2024-01-04 18:11:11", "Urgent);
INSERT INTO `Ticket`(ID_TICKET, ID_USER, `TITRE_TICKET`, `DESCRIPTION_TICKET`, `NIV_URGENCE_ESTIMER_TICKET`, ID_USER_DERNIERE_MODIF_TICKET, `HORODATAGE_CREATION_TICKET`, ETAT_TICKET, ID_USER_DERNIERE_MODIF_TICKET, HORODATAGE_DERNIERE_MODIF_TICKET, HORODATAGE_DEBUT_TRAITEMENT_TICKET, NIV_URGENCE_DEFINITIF_TICKET) VALUES (3, 3, '[MATERIEL] Matériel manquant','Il manque une souris en G24','Faible', 3, "2024-01-04 17:11:35", "En cours de traitement", 4, "2024-01-05 09:45:25", "2024-01-05 09:45:25", "Faible");
INSERT INTO `Ticket`(ID_TICKET, ID_USER, `TITRE_TICKET`, `DESCRIPTION_TICKET`, `NIV_URGENCE_ESTIMER_TICKET`, ID_USER_DERNIERE_MODIF_TICKET, `HORODATAGE_CREATION_TICKET`, ETAT_TICKET, ID_USER_DERNIERE_MODIF_TICKET, HORODATAGE_DERNIERE_MODIF_TICKET, NIV_URGENCE_DEFINITIF_TICKET) VALUES (4, 3, '[MATERIEL] Matériel en panne','L\'ordinateur ne s\'allume plus','Moyen', 3, "2024-01-04 17:11:35", "Ouvert", 6, "2024-01-04 18:02:59", "Urgent");
INSERT INTO `Ticket`(ID_TICKET, ID_USER, `TITRE_TICKET`, `DESCRIPTION_TICKET`, `NIV_URGENCE_ESTIMER_TICKET`, ID_USER_DERNIERE_MODIF_TICKET, `HORODATAGE_CREATION_TICKET`, ETAT_TICKET, ID_USER_DERNIERE_MODIF_TICKET, HORODATAGE_DERNIERE_MODIF_TICKET, NIV_URGENCE_DEFINITIF_TICKET) VALUES (5, 1, '[LOGICIEL] Problème de logiciel',
'Impossible de démarrer SQL Developper.

Je reçois un message d&#039;erreur :
&quot;Unable to launch the Java Virtual Machine Located at path : ..\\..\\jdk\\jr\\bin\\client\\jvm.dll&quot;
','Urgent', 1, "2024-01-04 17:11:35", "En cours de traitement", 1, "2024-01-04 18:08:15", "Moyen");
INSERT INTO `Ticket`(ID_TICKET, ID_USER, `TITRE_TICKET`, `DESCRIPTION_TICKET`, `NIV_URGENCE_ESTIMER_TICKET`, ID_USER_DERNIERE_MODIF_TICKET, ETAT_TICKET, ID_USER_DERNIERE_MODIF_TICKET, HORODATAGE_DERNIERE_MODIF_TICKET) VALUES (6, 2, '[AUTRE] Contacter un technicien ou un admnistrateur','Je sais comment résoudre le problème n°5, j&#039;ai donné l&#039;explication dans le salon Discord question-entraide des FI1. Un modérateur a épinglé mon message.','Urgent', 2, "2024-01-06 12:56:35", "En attente", 2, "2024-01-06 12:56:35");


INSERT INTO `Ticket`(`ID_TICKET`, `ID_USER`, `TITRE_TICKET`, `DESCRIPTION_TICKET`, `NIV_URGENCE_ESTIMER_TICKET`, `HORODATAGE_CREATION_TICKET`, ETAT_TICKET, ID_USER_DERNIERE_MODIF_TICKET, HORODATAGE_DERNIERE_MODIF_TICKET, NIV_URGENCE_DEFINITIF_TICKET) VALUES (39, 4, "[!] Autre problème", "Bug trouvé sur la plateforme TIX : Lorsque je vais sur la page", "Faible", "2024-01-06 12:56:35", "Ouvert", 6, "2024-01-08 19:28:12", "Urgent")
