
/*
DROP USER '1'@'localhost';
DROP USER '2'@'localhost';
DROP USER '3'@'localhost';
DROP USER '4'@'localhost';

DELETE FROM Utilisateur WHERE ID_USER = '1';
DELETE FROM Utilisateur WHERE ID_USER = '2';
DELETE FROM Utilisateur WHERE ID_USER = '3';
DELETE FROM Utilisateur WHERE ID_USER = '4';
*/

INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER) VALUES(1, "alice", "Alice", "AVRIL", "utilisateur", "alice.avril@email.com");
INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER) VALUES(2, "boblebricoleur", "Bob", "LEBRICOLEUR", "utilisateur", "lebricoleur@castorama.com");
INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER) VALUES(3, "roberto", "Roberto", "HONGO", "utilisateur", "roberto.hongo@email.com");
INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER) VALUES(4, "gordon", "Gordon", "SHUMWAY", "utilisateur", "alf@melmac.cat");

CREATE USER '1'@'localhost' IDENTIFIED BY 'azerty!123';
CREATE USER '2'@'localhost' IDENTIFIED BY 'azerty!123';
CREATE USER '3'@'localhost' IDENTIFIED BY 'azerty!123';
CREATE USER '4'@'localhost' IDENTIFIED BY 'azerty!123';

GRANT 'role_utilisateur' TO '1'@'localhost';
GRANT 'role_utilisateur' TO '2'@'localhost';
GRANT 'role_utilisateur' TO '3'@'localhost';
GRANT 'role_utilisateur' TO '4'@'localhost';

