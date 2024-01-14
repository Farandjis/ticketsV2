/*

Scénario :
	L'utilisateur se connecte
	On supprime tous les enregistrements correspondant à son login et son ip de connexion.
	On créer un enregistrement avec son login, son ip de connexion, l'heure de sa connexion (pas pour insert) et une valeur généré aléatoirement.
	On fait un calcul avec la version chiffré du mot de passe... On obtient un jeton de connexion unique.
	On stock ce jeton dans le cookie session.

	L'utilisateur change de page
	On récupère le jeton, on peut ainsi récupèrer l'enregistrement en fonction de son login et de son IP en récupérant l'horodatage le plus grand (récent).
	On possède toute les valeurs nécessaires pour faire le calcul inverse et récupérer le mot de passe chiffré (qu'on va déchiffré).
	On met à jour le jeton (en mettant à jour l'horodatage)
	
	L'utilisateur se déconnecte
	On supprime tous les enregistrements correspondant à son login et son ip de connexion.

	L'utilisateur est en cours de suppression
	On supprime tous les enregistrements correspondant à son login.


Procédure possible :
	 - On pourrait supprimer automatiquement les jetons au bout d'un utilisateur certain temps (ex, si l'horodatage date d'il y a plus d'1h).
	 - Suppression immédiat de l'intégralité des jetons de l'utilisateur
	
Évènement possible :
	Tous les 2h, on exécute la procédure de suppression de tous les jetons obsolètes des utilisateurs

*/

DROP DATABASE IF EXISTS DB_JETONS_TIX;
CREATE DATABASE DB_JETONS_TIX;

CREATE OR REPLACE TABLE stockage_jeton(
    JETON_LOGIN_USER VARCHAR(20),
    JETON_IP_USER VARCHAR(15),
    JETON_HORODATAGE_USER DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    JETON_VALEUR INT,
    
    PRIMARY KEY(JETON_LOGIN_USER, JETON_IP_USER)
);

GRANT SELECT ON DB_JETONS_TIX.stockage_jeton TO fictif_connexionDB@localhost;
GRANT INSERT(JETON_LOGIN_USER, JETON_IP_USER, JETON_VALEUR) ON DB_JETONS_TIX.stockage_jeton TO fictif_connexionDB@localhost;
GRANT UPDATE(JETON_HORODATAGE_USER) ON DB_JETONS_TIX.stockage_jeton TO fictif_connexionDB@localhost;
GRANT DELETE ON DB_JETONS_TIX.stockage_jeton TO fictif_connexionDB@localhost;

