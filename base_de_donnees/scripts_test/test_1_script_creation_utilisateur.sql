-- Supprimer l'utilisateur s'il existe
DROP USER IF EXISTS '1'@'localhost';
DROP USER IF EXISTS '2'@'localhost';
DROP USER IF EXISTS '3'@'localhost';
DROP USER IF EXISTS '4'@'localhost';

-- Supprimer les enregistrements de la table Utilisateur s'ils existent
DELETE FROM Utilisateur WHERE ID_USER = '1';
DELETE FROM Utilisateur WHERE ID_USER = '2';
DELETE FROM Utilisateur WHERE ID_USER = '3';
DELETE FROM Utilisateur WHERE ID_USER = '4';

-- On créer les utilisateurs TIX
INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, EMAIL_USER) VALUES(1, "alice", "Alice", "AVRIL", "alice.avril@email.com");
INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, EMAIL_USER) VALUES(2, "boblebricoleur", "Bob", "LEBRICOLEUR", "lebricoleur@castorama.com");
INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, EMAIL_USER) VALUES(3, "roberto", "Roberto", "HONGO", "roberto.hongo@email.com");
INSERT INTO Utilisateur(ID_USER, LOGIN_USER, PRENOM_USER, NOM_USER, EMAIL_USER) VALUES(4, "gordon", "Gordon", "SHUMWAY", "alf@melmac.cat");

-- On créer les utilisateurs MariaDB
CREATE USER '1'@'localhost' IDENTIFIED BY 'azerty!123';
CREATE USER '2'@'localhost' IDENTIFIED BY 'azerty!123';
CREATE USER '3'@'localhost' IDENTIFIED BY 'azerty!123';
CREATE USER '4'@'localhost' IDENTIFIED BY 'azerty!123';

-- Ce sont des utilisateurs de la plateforme
GRANT 'role_utilisateur' TO '1'@'localhost';
GRANT 'role_utilisateur' TO '2'@'localhost';
GRANT 'role_utilisateur' TO '3'@'localhost';
GRANT 'role_utilisateur' TO '4'@'localhost';

-- On active leurs droits à leur connexion par défaut.
SET DEFAULT ROLE 'role_utilisateur' FOR '1'@'localhost';
SET DEFAULT ROLE 'role_utilisateur' FOR '2'@'localhost';
SET DEFAULT ROLE 'role_utilisateur' FOR '3'@'localhost';
SET DEFAULT ROLE 'role_utilisateur' FOR '4'@'localhost';


-- Pour le moment du moins, on considère Gordon comme un technicien
GRANT 'role_technicien' TO '4'@localhost;
SET DEFAULT ROLE 'role_technicien' FOR '4'@localhost;

