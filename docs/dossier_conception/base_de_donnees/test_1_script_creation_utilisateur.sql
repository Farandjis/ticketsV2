
// A terminer, ajout en cours sur le serveur de secours


DROP USER '9991'@'localhost';
DROP USER '9992'@'localhost';
DROP USER '9993'@'localhost';
DROP USER '9994'@'localhost';

DELETE FROM Utilisateur WHERE ID_USER = '9991';
DELETE FROM Utilisateur WHERE ID_USER = '9992';
DELETE FROM Utilisateur WHERE ID_USER = '9993';
DELETE FROM Utilisateur WHERE ID_USER = '9994';

INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER) VALUES(9991, "alice", "Alice", "AVRIL", "utilisateur", "alice.avril@email.com");
INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER) VALUES(9992, "boblebricoleur", "Bob", "LEBRICOLEUR", "utilisateur", "lebricoleur@castorama.com");
INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER) VALUES(9993, "roberto", "Roberto", "HONGO", "utilisateur", "roberto.hongo@email.com");
INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, ROLE_USER, EMAIL_USER) VALUES(9994, "gordon", "Gordon", "SHUMWAY", "utilisateur", "alf@melmac.cat");

CREATE USER '9991'@'localhost' IDENTIFIED BY 'azerty!123';
CREATE USER '9992'@'localhost' IDENTIFIED BY 'azerty!123';
CREATE USER '9993'@'localhost' IDENTIFIED BY 'azerty!123';
CREATE USER '9994'@'localhost' IDENTIFIED BY 'azerty!123';


GRANT SELECT ON vue_Utilisateur_client TO '9991'@'localhost';
GRANT SELECT ON vue_Ticket_client TO '9991'@'localhost';
GRANT UPDATE ON vue_Utilisateur_insertion_client TO '9991'@'localhost';
GRANT UPDATE ON vue_Ticket_insertion_client TO '9991'@'localhost';

GRANT SELECT ON vue_Utilisateur_client TO '9992'@'localhost';
GRANT SELECT ON vue_Ticket_client TO '9992'@'localhost';
GRANT UPDATE ON vue_Utilisateur_insertion_client TO '9992'@'localhost';
GRANT UPDATE ON vue_Ticket_insertion_client TO '9992'@'localhost';

GRANT SELECT ON vue_Utilisateur_client TO '9993'@'localhost';
GRANT SELECT ON vue_Ticket_client TO '9993'@'localhost';
GRANT UPDATE ON vue_Utilisateur_insertion_client TO '9993'@'localhost';
GRANT UPDATE ON vue_Ticket_insertion_client TO '9993'@'localhost';

GRANT SELECT ON vue_Utilisateur_client TO '9994'@'localhost';
GRANT SELECT ON vue_Ticket_client TO '9994'@'localhost';
GRANT UPDATE ON vue_Utilisateur_insertion_client TO '9994'@'localhost';
GRANT UPDATE ON vue_Ticket_insertion_client TO '9994'@'localhost';
