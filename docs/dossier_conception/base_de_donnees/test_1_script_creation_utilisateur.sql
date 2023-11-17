
-- script ne correspondant pas au S. Secours


DROP USER '1'@'localhost'; -- alice
DROP USER '2'@'localhost'; -- boblebricoleur
DROP USER '3'@'localhost'; -- roberto
DROP USER '4'@'localhost'; -- gordon

DELETE FROM Utilisateur WHERE ID_USER = '1';
DELETE FROM Utilisateur WHERE ID_USER = '2';
DELETE FROM Utilisateur WHERE ID_USER = '3';
DELETE FROM Utilisateur WHERE ID_USER = '4';

INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER) VALUES(9991, "alice", "Alice", "AVRIL", "utilisateur", "alice.avril@email.com");
INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER) VALUES(9992, "boblebricoleur", "Bob", "LEBRICOLEUR", "utilisateur", "lebricoleur@castorama.com");
INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER) VALUES(9993, "roberto", "Roberto", "HONGO", "utilisateur", "roberto.hongo@email.com");
INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER) VALUES(9994, "gordon", "Gordon", "SHUMWAY", "utilisateur", "alf@melmac.cat");

CREATE USER '1'@'localhost' IDENTIFIED BY 'azerty!123';
CREATE USER '2'@'localhost' IDENTIFIED BY 'azerty!123';
CREATE USER '3'@'localhost' IDENTIFIED BY 'azerty!123';
CREATE USER '4'@'localhost' IDENTIFIED BY 'azerty!123';


GRANT SELECT ON vue_Utilisateur_client TO '1'@'localhost';
GRANT SELECT ON vue_Ticket_client TO '1'@'localhost';
GRANT UPDATE ON vue_Utilisateur_insertion_client TO '1'@'localhost';
GRANT UPDATE ON vue_Ticket_insertion_client TO '1'@'localhost';

GRANT SELECT ON vue_Utilisateur_client TO '2'@'localhost';
GRANT SELECT ON vue_Ticket_client TO '2'@'localhost';
GRANT UPDATE ON vue_Utilisateur_insertion_client TO '2'@'localhost';
GRANT UPDATE ON vue_Ticket_insertion_client TO '2'@'localhost';

GRANT SELECT ON vue_Utilisateur_client TO '3'@'localhost';
GRANT SELECT ON vue_Ticket_client TO '3'@'localhost';
GRANT UPDATE ON vue_Utilisateur_insertion_client TO '3'@'localhost';
GRANT UPDATE ON vue_Ticket_insertion_client TO '3'@'localhost';

GRANT SELECT ON vue_Utilisateur_client TO '4'@'localhost';
GRANT SELECT ON vue_Ticket_client TO '4'@'localhost';
GRANT UPDATE ON vue_Utilisateur_insertion_client TO '4'@'localhost';
GRANT UPDATE ON vue_Ticket_insertion_client TO '4'@'localhost';
