DROP DATABASE IF EXISTS DB_TIX;
CREATE DATABASE DB_TIX;

-- Création de la table "Utilisateur"
CREATE OR REPLACE TABLE Utilisateur (
    ID_USER INT AUTO_INCREMENT PRIMARY KEY,
    LOGIN_USER VARCHAR(20) UNIQUE CHECK (LENGTH(LOGIN_USER) >= 5),
    PRENOM_USER VARCHAR(30) CHECK (PRENOM_USER REGEXP '^[A-Za-zÀ-ÖØ-öø-ÿ\\-]+$'),
    NOM_USER VARCHAR(30) CHECK (NOM_USER REGEXP '^[A-Za-zÀ-ÖØ-öø-ÿ\-\\s]+$'),
    EMAIL_USER VARCHAR(100) CHECK (EMAIL_USER REGEXP '^[A-Za-z0-9._%-]+@[A-Za-z.-]+\\.[A-Za-z]{2,4}$'),
    HORODATAGE_OUVERTURE_USER DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    HORODATAGE_DERNIERE_CONNECTION_USER DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    IP_DERNIERE_CONNECTION_USER VARCHAR(15)
);

CREATE OR REPLACE TABLE UrgenceTicket(
	VALEUR_URGENCE_TICKET VARCHAR(15) PRIMARY KEY, 
	IMPORTANCE_URGENCE INT UNIQUE
	);


-- Création de la table "EtatTicket"
CREATE OR REPLACE TABLE EtatTicket (
    VALEUR_ETAT_TICKET VARCHAR(30) PRIMARY KEY
);


CREATE OR REPLACE TABLE TitreTicket (
    TITRE_TICKET VARCHAR(60) PRIMARY KEY
);


-- Création de la table "Ticket"
CREATE OR REPLACE TABLE Ticket (
    ID_TICKET INT AUTO_INCREMENT PRIMARY KEY,
    ID_USER INT NOT NULL DEFAULT (SUBSTRING_INDEX(USER(),'@',1)),
    TITRE_TICKET VARCHAR(60) NOT NULL,
    DESCRIPTION_TICKET VARCHAR(250) NOT NULL,
    ID_TECHNICIEN INT DEFAULT NULL,
    NIV_URGENCE_ESTIMER_TICKET VARCHAR(15) DEFAULT 'Non complété !' NOT NULL,
    NIV_URGENCE_DEFINITIF_TICKET VARCHAR(15) DEFAULT 'Non complété !',
    ETAT_TICKET VARCHAR(30) DEFAULT 'En attente' NOT NULL,
    HORODATAGE_CREATION_TICKET DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    HORODATAGE_DEBUT_TRAITEMENT_TICKET DATETIME,
    HORODATAGE_RESOLUTION_TICKET DATETIME,
    HORODATAGE_DERNIERE_MODIF_TICKET DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    FOREIGN KEY (ID_USER) REFERENCES Utilisateur (ID_USER),
    FOREIGN KEY (ID_TECHNICIEN) REFERENCES Utilisateur (ID_USER),
    FOREIGN KEY (TITRE_TICKET) REFERENCES TitreTicket(TITRE_TICKET),
    FOREIGN KEY (ETAT_TICKET) REFERENCES EtatTicket (VALEUR_ETAT_TICKET),
    FOREIGN KEY (NIV_URGENCE_ESTIMER_TICKET) REFERENCES UrgenceTicket(VALEUR_URGENCE_TICKET),
    FOREIGN KEY (NIV_URGENCE_DEFINITIF_TICKET) REFERENCES UrgenceTicket(VALEUR_URGENCE_TICKET)
);

-- Création de la table "MotcleTicket"
CREATE OR REPLACE TABLE MotcleTicket (
    NOM_MOTCLE VARCHAR(30) PRIMARY KEY
);

-- Création de la table "RelationTicketsMotscles"
CREATE OR REPLACE TABLE RelationTicketsMotscles (
    ID_TICKET INT NOT NULL,
    NOM_MOTCLE VARCHAR(30) NOT NULL,
    PRIMARY KEY (ID_TICKET, NOM_MOTCLE),
    FOREIGN KEY (ID_TICKET) REFERENCES Ticket (ID_TICKET),
    FOREIGN KEY (NOM_MOTCLE) REFERENCES MotcleTicket (NOM_MOTCLE)
);



INSERT INTO UrgenceTicket (VALEUR_URGENCE_TICKET, IMPORTANCE_URGENCE) VALUES
	    ('Non complété !', 999),
	    ('Faible', 4),
	    ('Moyen', 3),
	    ('Important', 2),
	    ('Urgent', 1);


-- Insertion des états possibles
INSERT INTO EtatTicket (VALEUR_ETAT_TICKET) VALUES
    ('En attente'),
    ('Ouvert'),
    ('En cours de traitement'),
    ('Fermé');


INSERT INTO MotcleTicket VALUES("Logiciel : WebStorm");
INSERT INTO MotcleTicket VALUES("Logiciel : PHPStorm");
INSERT INTO MotcleTicket VALUES("Logiciel : PyCharm");
INSERT INTO MotcleTicket VALUES("Logiciel : IntelliJ");
INSERT INTO MotcleTicket VALUES("Logiciel : Firefox");
INSERT INTO MotcleTicket VALUES("Logiciel : Open Office");
INSERT INTO MotcleTicket VALUES("Logiciel : WinSCP");
INSERT INTO MotcleTicket VALUES("Logiciel : Autre");
INSERT INTO MotcleTicket VALUES("Système : CentOS");
INSERT INTO MotcleTicket VALUES("Système : Windows");
INSERT INTO MotcleTicket VALUES("Système : Debian");
INSERT INTO MotcleTicket VALUES("Système : Autre");
INSERT INTO MotcleTicket VALUES("Matériel : Moniteur");
INSERT INTO MotcleTicket VALUES("Matériel : Ordinateur");
INSERT INTO MotcleTicket VALUES("Matériel : Clavier");
INSERT INTO MotcleTicket VALUES("Matériel : Souris");
INSERT INTO MotcleTicket VALUES("Matériel : Vidéoprojecteur");
INSERT INTO MotcleTicket VALUES("Matériel : Câble Moniteur");
INSERT INTO MotcleTicket VALUES("Matériel : Câble Alimentation");
INSERT INTO MotcleTicket VALUES("Matériel : Câble Ethernet");
INSERT INTO MotcleTicket VALUES("Matériel : Prise Électrique");
INSERT INTO MotcleTicket VALUES("Matériel : Autre");
INSERT INTO MotcleTicket VALUES("Salle INFO : G25");
INSERT INTO MotcleTicket VALUES("Salle INFO : G24");
INSERT INTO MotcleTicket VALUES("Salle INFO : G23");
INSERT INTO MotcleTicket VALUES("Salle INFO : G22");
INSERT INTO MotcleTicket VALUES("Salle INFO : G21");
INSERT INTO MotcleTicket VALUES("Salle INFO : I21");
INSERT INTO MotcleTicket VALUES("Salle INFO : E51");
INSERT INTO MotcleTicket VALUES("Salle INFO : Autre");
INSERT INTO MotcleTicket VALUES("Salle GEII : Autre");
INSERT INTO MotcleTicket VALUES("Salle MMI : Autre");
INSERT INTO MotcleTicket VALUES("Salle R&T : Autre");
INSERT INTO MotcleTicket VALUES("[!] Aucun mot-clé");

INSERT INTO TitreTicket VALUES("[MATERIEL] Matériel manquant");
INSERT INTO TitreTicket VALUES("[MATERIEL] Matériel en panne");
INSERT INTO TitreTicket VALUES("[MATERIEL] Autre problème");
INSERT INTO TitreTicket VALUES("[SESSION] Taille de session");
INSERT INTO TitreTicket VALUES("[SESSION] Mot de passe de session oublié");
INSERT INTO TitreTicket VALUES("[SESSION] Autre problème");
INSERT INTO TitreTicket VALUES("[LOGICIEL] Logiciel malveillant");
INSERT INTO TitreTicket VALUES("[LOGICIEL] Problème de logiciel");
INSERT INTO TitreTicket VALUES("[LOGICIEL] Mise à jour de logiciel");
INSERT INTO TitreTicket VALUES("[LOGICIEL] Proposition de logiciel");
INSERT INTO TitreTicket VALUES("[LOGICIEL] Autre problème");
INSERT INTO TitreTicket VALUES("[SALLE] Problème de la salle");
INSERT INTO TitreTicket VALUES("[!] Autre problème");
INSERT INTO TitreTicket VALUES("[AUTRE] Problème pour se connecter");
INSERT INTO TitreTicket VALUES("[AUTRE] Piratage");
INSERT INTO TitreTicket VALUES("[AUTRE] Contacter un technicien ou un admnistrateur");
