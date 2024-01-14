-- Attention ! A exécuter avant de créer les triggers si on utilise le compte admin BD.

-- Je n'arrive pas à me connecter à ma session
INSERT INTO RelationTicketsMotscles VALUES(1, 'Matériel : Ordinateur');
INSERT INTO RelationTicketsMotscles VALUES(1, 'Système : Windows');

-- Je crois qu'on m'a piraté, mes fichiers ont disparus
INSERT INTO RelationTicketsMotscles VALUES(2, 'Système : Windows');

--  Il manque une souris en G24
INSERT INTO RelationTicketsMotscles VALUES(3, "Salle INFO : G24");
INSERT INTO RelationTicketsMotscles VALUES(3, "Matériel : Souris");

-- L'ordinateur ne s'allume plus
INSERT INTO RelationTicketsMotscles VALUES(4, 'Matériel : Ordinateur');
INSERT INTO RelationTicketsMotscles VALUES(4, 'Matériel : Câble Moniteur');
INSERT INTO RelationTicketsMotscles VALUES(4, 'Matériel : Câble Alimentation');
INSERT INTO RelationTicketsMotscles VALUES(4, 'Salle INFO : E51');

--  Impossible de démarrer SQL Developper.
INSERT INTO RelationTicketsMotscles VALUES(5, 'Logiciel : Autre');
INSERT INTO RelationTicketsMotscles VALUES(5, 'Système : Windows');
