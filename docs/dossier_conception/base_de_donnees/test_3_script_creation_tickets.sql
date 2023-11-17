-- Les tickets suivant ont été générés via ChatGPT et corrigés à la main

INSERT INTO Ticket(id_user, objet_ticket, description_ticket, niv_urgence_estimer_ticket, NIV_URGENCE_DEFINITIF_TICKET, ETAT_TICKET) VALUES
	(9991, "Problème d'imprimante", "Le document ne s'imprime pas correctement, besoin d'aide.", "Urgent", "Non complété !", "en_attente"),
	(9992, "Erreur logicielle", "Rencontre des erreurs inattendues lors de l'utilisation de l'application X.", "Important", "Non complété !", "ouvert"),
	(9993, "Besoin d'une nouvelle clé d'accès", "La clé actuelle ne fonctionne plus, nécessite une mise à jour.", "Moyen", "Non complété !", "en_cours_de_traitement"),
	(9991, "Écran noir", "L'écran de l'ordinateur est complètement noir, aucune activité visible.", "Urgent", "Urgent", "en_attente"),
	(9992, "Perte de données", "Certaines données importantes ont été accidentellement supprimées, besoin de récupération.", "Important", "Important", "ouvert"),
	(9993, "Impossible d'ouvrir des fichiers", "Rencontre des difficultés pour ouvrir certains fichiers, demande d'assistance.", "Moyen", "Moyen", "en_cours_de_traitement"),
	(9994, "Lenteur du système", "L'ordinateur fonctionne lentement, nécessite une optimisation.", "Faible", "Faible", "ferme"),
	(9991, "Problème d'accès au compte", "Impossible de se connecter au compte, demande de réinitialisation du mot de passe.", "Urgent", "Urgent", "en_attente"),
	(9992, "Problème d'affichage", "Les images et les graphiques ne s'affichent pas correctement sur l'écran.", "Important", "Important", "ouvert"),
	(9993, "Erreur système", "Reçoit des messages d'erreur système fréquents, nécessite une résolution.", "Moyen", "Moyen", "en_cours_de_traitement"),
	(9994, "Problème de son", "Aucun son ne sort des haut-parleurs, vérification nécessaire.", "Faible", "Faible", "ferme"),
	(9991, "Problème de sécurité", "Soupçonne une activité de piratage, demande une vérification de sécurité.", "Urgent", "Urgent", "en_attente"),
	(9992, "Problème de configuration", "L'application n'est pas configurée correctement, demande d'aide à la configuration.", "Important", "Important", "ouvert"),
	(9993, "Besoin de droits d'accès", "L'utilisateur ne peut pas accéder à certaines fonctionnalités, nécessite des droits d'accès supplémentaires.", "Moyen", "Moyen", "en_cours_de_traitement"),
	(9994, "Problème d'alimentation", "L'ordinateur ne s'allume pas, vérification de l'alimentation nécessaire.", "Faible", "Faible", "ferme");

INSERT INTO RelationTicketsLibelles VALUES(1, "Autre problème");
INSERT INTO RelationTicketsLibelles VALUES(2, "Problème session Windows");
INSERT INTO RelationTicketsLibelles VALUES(3, "Mot de passe Windows oublié");
INSERT INTO RelationTicketsLibelles VALUES(4, "Moniteur HS");
INSERT INTO RelationTicketsLibelles VALUES(5, "Piratage de ma session");
INSERT INTO RelationTicketsLibelles VALUES(5, "Autre problème");
INSERT INTO RelationTicketsLibelles VALUES(6, "Autre problème");
INSERT INTO RelationTicketsLibelles VALUES(7, "Virus sur ma session");
INSERT INTO RelationTicketsLibelles VALUES(8, "Mot de passe Windows oublié");
INSERT INTO RelationTicketsLibelles VALUES(9, "Moniteur HS");
INSERT INTO RelationTicketsLibelles VALUES(10, "Ordinateur HS");
INSERT INTO RelationTicketsLibelles VALUES(10, "Problème session Windows");
INSERT INTO RelationTicketsLibelles VALUES(11, "Ordinateur HS");
INSERT INTO RelationTicketsLibelles VALUES(12, "Piratage de ma session");
INSERT INTO RelationTicketsLibelles VALUES(13, "Problème session Windows");
INSERT INTO RelationTicketsLibelles VALUES(14, "Problème session Windows");
INSERT INTO RelationTicketsLibelles VALUES(15, "Ordinateur HS");

