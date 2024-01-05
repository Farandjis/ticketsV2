-- A exécuter en tant que n'importe quel utilisateur MariaDB
-- Incomplet

INSERT INTO `Ticket`(ID_TICKET, ID_USER, `TITRE_TICKET`, `DESCRIPTION_TICKET`, `NIV_URGENCE_ESTIMER_TICKET`, ID_USER_DERNIERE_MODIF_TICKET) VALUES (1, 3, '[AUTRE] Problème pour se connecter','Je n\'arrive pas à me connecter à ma session, ça ouvre à chaque fois une session temporaire.','Moyen', 3);
INSERT INTO `Ticket`(ID_TICKET, ID_USER, `TITRE_TICKET`, `DESCRIPTION_TICKET`, `NIV_URGENCE_ESTIMER_TICKET`, ID_USER_DERNIERE_MODIF_TICKET) VALUES (2, 3, '[AUTRE] Piratage','Je crois qu\'on m\'a piraté, mes fichiers ont disparus','Urgent', 3);
INSERT INTO `Ticket`(ID_TICKET, ID_USER, `TITRE_TICKET`, `DESCRIPTION_TICKET`, `NIV_URGENCE_ESTIMER_TICKET`, ID_USER_DERNIERE_MODIF_TICKET) VALUES (3, 3, '[MATERIEL] Matériel manquant','Il manque une souris en G24','Faible', 3);
INSERT INTO `Ticket`(ID_TICKET, ID_USER, `TITRE_TICKET`, `DESCRIPTION_TICKET`, `NIV_URGENCE_ESTIMER_TICKET`, ID_USER_DERNIERE_MODIF_TICKET) VALUES (4, 3, '[MATERIEL] Matériel en panne','L\'ordinateur ne s\'allume plus','Moyen', 3);
INSERT INTO `Ticket`(ID_TICKET, ID_USER, `TITRE_TICKET`, `DESCRIPTION_TICKET`, `NIV_URGENCE_ESTIMER_TICKET`, ID_USER_DERNIERE_MODIF_TICKET) VALUES (5, 1, '[LOGICIEL] Problème de logiciel',
'Impossible de démarrer SQL Developper.

Je reçois un message d&#039;erreur :
&quot;Unable to launch the Java Virtual Machine Located at path : ..\\..\\jdk\\jr\\bin\\client\\jvm.dll&quot;
','Urgent', 1);
INSERT INTO `Ticket`(ID_TICKET, ID_USER, `TITRE_TICKET`, `DESCRIPTION_TICKET`, `NIV_URGENCE_ESTIMER_TICKET`, ID_USER_DERNIERE_MODIF_TICKET) VALUES (6, 2, '[AUTRE] Contacter un technicien ou un admnistrateur','Je sais comment résoudre le problème n°5, j&#039;ai donné l&#039;explication dans le salon Discord question-entraide des FI1. Un modérateur a épinglé mon message.','Urgent', 2);



