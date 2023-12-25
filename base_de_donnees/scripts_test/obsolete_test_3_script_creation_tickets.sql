-- Les tickets suivant ont été générés via ChatGPT et corrigés à la main
-- ne correspond plus au S. Secours

INSERT INTO Ticket(id_user, objet_ticket, description_ticket, niv_urgence_estimer_ticket, NIV_URGENCE_DEFINITIF_TICKET, ETAT_TICKET) VALUES
	(1, "Problème d'imprimante", "Le document ne s'imprime pas correctement, besoin d'aide.", "Urgent", "Non complété !", "En attente"),
	(2, "Erreur logicielle", "Rencontre des erreurs inattendues lors de l'utilisation de l'application X.", "Important", "Non complété !", "Ouvert"),
	(3, "Besoin d'une nouvelle clé d'accès", "La clé actuelle ne fonctionne plus, nécessite une mise à jour.", "Moyen", "Non complété !", "En cours de traitement"),
	(1, "Écran noir", "L'écran de l'ordinateur est complètement noir, aucune activité visible.", "Urgent", "Urgent", "En attente"),
	(2, "Perte de données", "Certaines données importantes ont été accidentellement supprimées, besoin de récupération.", "Important", "Important", "Ouvert"),
	(3, "Impossible d'ouvrir des fichiers", "Rencontre des difficultés pour ouvrir certains fichiers, demande d'assistance.", "Moyen", "Moyen", "En cours de traitement"),
	(4, "Lenteur du système", "L'ordinateur fonctionne lentement, nécessite une optimisation.", "Faible", "Faible", "Fermé"),
	(1, "Problème d'accès au compte", "Impossible de se connecter au compte, demande de réinitialisation du mot de passe.", "Urgent", "Urgent", "En attente"),
	(2, "Problème d'affichage", "Les images et les graphiques ne s'affichent pas correctement sur l'écran.", "Important", "Important", "Ouvert"),
	(3, "Erreur système", "Reçoit des messages d'erreur système fréquents, nécessite une résolution.", "Moyen", "Moyen", "En cours de traitement"),
	(4, "Problème de son", "Aucun son ne sort des haut-parleurs, vérification nécessaire.", "Faible", "Faible", "Fermé"),
	(1, "Problème de sécurité", "Soupçonne une activité de piratage, demande une vérification de sécurité.", "Urgent", "Urgent", "En attente"),
	(2, "Problème de configuration", "L'application n'est pas configurée correctement, demande d'aide à la configuration.", "Important", "Important", "Ouvert"),
	(3, "Besoin de droits d'accès", "L'utilisateur ne peut pas accéder à certaines fonctionnalités, nécessite des droits d'accès supplémentaires.", "Moyen", "Moyen", "En cours de traitement"),
	(4, "Problème d'alimentation", "L'ordinateur ne s'allume pas, vérification de l'alimentation nécessaire.", "Faible", "Faible", "Fermé");

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

