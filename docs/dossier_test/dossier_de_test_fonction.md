Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test
## Site dynamique

<br><br>
Ce document permet de s'assurer que les fonctions soient bien fonctionnelles comme souhaité.

</div>

<br><br><br><br><br><br><br>

## Plan
- ### [I - Introduction](#I)
- ### [II - Description de la procédure de test](#II)
- ### [III - Contexte des tests](#III)
- ### [IV - Test ](#IV)
    - #### [Test fonctions](#a)
        - #### [connectUser](#1a)
        - #### [valideMDP](#2a)
        - #### [executeSQL](#3a)
        - #### [recupererRoleDe](#4a)
        - #### [tablegenerate](#5a)
        - #### [pageAccess](#6a)
        - #### [valideEmail](#7a)
        - #### [deconnexionSite](#8a)
        - #### [affichageMenuDuHaut](#9a)
        - #### [operationCAPTCHA](#10a)
        - #### [verifyCAPTCHA](#11a)
        - #### [saveToSessionSignUp](#12a)


<br><br><br>

----------

<br><br><br>

## <a name="I"></a>I - Introduction

Le document suivant à pour but de tester les différentes fonctions crées pour permettre une utilisation plus simple de ses mêmes lignes de code.
<br>

## <a name="II"></a>II - Description de la procédure de test

Les fonctions que nous allons tester seront connectUser, valideMDP et executeSQL.
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                           |
|------------------------------------|------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                             |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2) |
| Configuration matérielle           | Dell Optiplex 9020                                               |
| Date de début                      | 21/11/2023                                                       |
| Date de finalisation               | 24/11/2023                                                       |
| Test à appliquer                   | Vérification du bon fonctionnement des fonctions                 |
| Responsable de la campagne de test | GUIGNOLLE Enzo, Gouabi Assia                                     |

<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

### <a name="1a"></a>connectUser

| Cas n° | Critère                                                 | Résultat attendu | Résultat obtenu | Commentaires                                   |
|:-------|---------------------------------------------------------|------------------|-----------------|------------------------------------------------|
| 1      | $loginMariaDB = "alice" <br> $mdpMariaDB = "azerty!123" | OK               | OK              | $loginMariaDB et $mdpMariaDB correct           |
| 2      | $loginMariaDB = " " <br> $mdpMariaDB = "azerty!123"     | KO               | KO              | $loginMariaDB vide et $mdpMariaDB correct      |
| 3      | $loginMariaDB = "alice" <br> $mdpMariaDB = "123!azerty" | KO               | KO              | $loginMariaDB correct et $mdpMariaDB incorrect |
| 4      | $loginMariaDB = "alice" <br> $mdpMariaDB = " "          | KO               | KO              | $loginMariaDB correct et $mdpMariaDB vide      |
| 5      | $loginMariaDB = "alix" <br> $mdpMariaDB = "azerty!123"  | KO               | KO              | $loginMariaDB incorrect et $mdpMariaDB correct |
| 6      | $loginMariaDB = "alie" <br> $mdpMariaDB = "123!azerty"  | KO               | KO              | $loginMariaDB et $mdpMariaDB incorrect         |
| 7      | $loginMariaDB = " " <br> $mdpMariaDB = " "              | KO               | KO              | $loginMariaDB et $mdpMariaDB sont vides        |



- ### <a name="2a"></a>valideMDP

| Cas n° | Critère                           | Résultat attendu | Résultat obtenu | Commentaires                                          |
|:-------|-----------------------------------|------------------|-----------------|-------------------------------------------------------|
| 1      | Azertyalice!123                   | OK               | OK              | Le format du mdp est correct                          |
| 2      | azertyalice!123                   | KO               | KO              | Absence de majuscule                                  |
| 3      | Azertyalice123                    | KO               | KO              | Absence d'un caractère spécial                        |
| 4      | Azertyalice!                      | KO               | KO              | Absence de chiffres                                   |
| 5      | Azerty!123                        | KO               | KO              | Taille non conforme aux restrictions (inférieur à 12) |
| 6      | Azertyaliceavrilbonjourrrr!123456 | KO               | KO              | Taille non conforme aux restrictions (supérieur à 32) |
| 7      | AZERTYALICE!123                   | KO               | KO              | Absence de minuscule                                  |

- ### <a name="3a"></a>executeSQL

| Cas n° | Critère                                                                                                                                                                                      | Résultat attendu | Résultat obtenu | Commentaires                                                           |
|:-------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|------------------|-----------------|------------------------------------------------------------------------|
| 1      | $reqSQL = "SELECT ID_USER FROM UserFictif_connexion WHERE login_user = ? " <br> $params = array(loginSite) <br> $connection                                                                  | OK               | OK              | La requête de sélection fonctionne                                     |
| 2      | $reqSQL = "SELECT ID_USER FROM UserFictif_connexion WHERE login_user = ? " <br> $params = array(1) <br> $connection                                                                          | KO               | KO              | Le login étant un char nous ne pouvons pas récupérer le login_user = 1 |
| 3      | $reqSQL = "SELECT COUNT(LOGIN_USER) FROM UserFictif_connexion WHERE Email_USER = ?" <br> $params = array($login) <br> $coUFConnexion                                                         | KO               | KO              | Le $login ne correspond pas à l'Email_user                             |
| 4      | $reqSQL = "INSERT INTO UserFictif_inscription (LOGIN_USER, PRENOM_USER, NOM_USER, EMAIL_USER) VALUES (?, ?, ?, ?)" <br> $params = array($login, $prenom, $nom, $email) <br> $coUFInscription | OK               | OK              | La requête d'insertion fonctionne                                      |
| 5      | $reqSQL = "INSERT INTO UserFictif_inscription (LOGIN_USER, PRENOM_USER, NOM_USER, EMAIL_USER) VALUES (?, ?, ?, ?)" <br> $params = array($login, $prenom, $nom) <br> $coUFInscription         | KO               | KO              | Manque l'email dans le array                                           |
| 6      | $reqSQL = "SELECT ID_USER FROM UserFictif_connexion WHERE login_user = ? " <br> $params = array() <br> $connection                                                                           | KO               | KO              | Aucun paramètre n'est identiqué                                        |
| 7      | $reqSQL = "UPDATE vue_Utilisateur_maj_email SET email_user= ? WHERE ID_USER = ?", array($nouveEmail, $loginMariaDB), $connexionUtilisateur"                                                  | KO               | KO              | Le paramètre nouveEmail n'existe pas                                   |
| 8      | $reqSQL = "UPDATE vue_Utilisateur_maj_email SET email_user= ? WHERE ID_USER = ?", array($nouvelEmail, $loginMariaDB), $connexionUtilisateur"                                                 | OK               | OK              | La requête permet bien une modification de l'Email                     |
| 9      | $reqSQL = "SELECT ID_USER FROM UserFictif_connexion WHERE login_user = ?" <br> $params = array("--") <br> $connection                                                                        | KO               | KO              | Impossible de tenter une injection SQL                                 |
| 10     | $reqSQL = "DELETE FROM `MotcleTicket` WHERE NOM_MOTCLE = ? ;",array($titre),$connection                                                                                                      | OK               | OK              | Le mot-clé est bien supprimé                                           |
| 11     | $reqSQL = "DELETE FROM `MotcleTicket` WHERE NOM_MOTCLE = ? ;",array($titre)                                                                                                                  | KO               | KO              | Absence de la connexion                                                |

- ### <a name="4a"></a>recupereRoleDE

| Cas n° | Critère                                                    | Résultat attendu | Résultat obtenu  | Commentaires                                  |
|:-------|------------------------------------------------------------|------------------|------------------|-----------------------------------------------|
| 1      | je me connecte en temps que alice (utilisateur)            | role_utilisateur | role_utilisateur | récupération du rôle d'utilisateur d'alice    |
| 2      | je me connecte en temps que gestion (administrateur web)   | role_admin_web   | role_admin_web   | récupération du rôle d'administrateur web     |
| 3      | je me connecte en temps que admin (administrateur système) | role_admin_sys   | role_admin_sys   | récupération du rôle d'administrateur système |
| 4      | j'accède à la plateforme en tant que visiteur              | aucun rôle       | aucun rôle       | Aucun rôle n'a été attribué au visiteur       |
| 5      | je me connecte en temps que gordon (technicien)            | role_technicien  | role_technicien  | récupération du rôle de technicien            |

- ### <a name="5a"></a>tablegenerate

| Cas n° | Critère                                                                                                                                                                    | Résultat attendu  | Résultat obtenu    | Commentaires                            |
|:-------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------|--------------------|-----------------------------------------|
| 1      | Affichage avec la requête suivante "SELECT * FROM vue_Ticket_visiteur"                                                                                                     | 4 colonne affiché | 4 colonnes affiché | Affichage de 4 colonnes dans un tableau |
| 2      | Affichage avec la requête suivante "SELECT OBJET_TICKET NIV_URGENCE_ESTIMER_TICKET DESCRIPTION_TICKET FROM vue_Ticket_visiteur"                                            | 3 colonne affiché | 3 colonnes affiché | Affichage de 3 colonnes dans un tableau |
| 3      | Affichage avec la requête suivante "SELECT NIV_URGENCE_ESTIMER_TICKET DESCRIPTION_TICKET FROM vue_Ticket_visiteur"                                                         | 2 colonne affiché | 2 colonnes affiché | Affichage de 3 colonnes dans un tableau |
| 4      | Affichage avec la requête suivante "SELECT DESCRIPTION_TICKET FROM vue_Ticket_visiteur"                                                                                    | 1 colonne affiché | 1 colonne affiché  | Affichage de 1 colonne dans un tableau  |
| 5      | Affichage avec la requête suivante "SELECT LOGIN_USER OBJET_TICKET NIV_URGENCE_ESTIMER_TICKET DESCRIPTION_TICKETFROM Ticket t JOIN Utilisateur u ON t.ID_USER = u.ID_USER" | 5 colonne affiché | 5 colonne affiché  | Affichage de 5 colonnes dans un tableau |

- ### <a name="6a"></a>pageAccess

| Cas n° | Critère                                         | Résultat attendu | Résultat obtenu | Commentaires                                 |
|:-------|-------------------------------------------------|------------------|-----------------|----------------------------------------------|
| 1      | Le fichier de session n'existe pas              | KO               | KO              | La personne ne s'est pas connecté au site    |
| 2      | Les valeurs du fichier de session sont vides    | KO               | KO              | La session de l'utilisateur n'a aucune infos |
| 3      | L'utilisateur n'est pas dans la base de données | KO               | KO              | La personne ne s'est pas inscrit             |
| 4      | L'utilisateur n'a pas de compte                 | KO               | KO              | La personne ne s'est pas inscrit             |
| 5      | La connexion de l'utilisateur à échoué          | KO               | KO              | Le mot de passe à été modifié                |
| 6      | L'utilisateur n'a pas de rôle                   | KO               | KO              | Aucun rôle est associé à l'utilisateur       |
| 7      | Tout est valide                                 | OK               | OK              | Aucune erreur n'a été signalé                |

- ### <a name="7a"></a>valideEmail

| Cas n° | Critère                          | Résultat attendu | Résultat obtenu | Commentaires                  |
|:-------|----------------------------------|------------------|-----------------|-------------------------------|
| 1      | $email = "alice@email.com"       | OK               | OK              | $email est conforme           |
| 2      | $email = "alice.avril@email.com" | KO               | KO              | $email est conforme           |
| 3      | $email = " "                     | KO               | KO              | $email est vide               |
| 4      | $email = "alice#email.com"       | KO               | KO              | L'email n'est pas conforme    |
| 5      | $email = "alicé@email.com"       | KO               | KO              | Il y a un accent dans l'email |
| 6      | $email = "alice@email.c"         | KO               | KO              | Il y a un accent dans l'email |
| 7      | $email = "alice@email.coom"      | KO               | KO              | Il y a un accent dans l'email |
| 8      | $email = "alice@.coom"           | KO               | KO              | Il y a un accent dans l'email |
| 9      | $email = alice.avrilemail.com    | KO               | KO              | Il manque un @                |
| 10     | $email = @email.com              | KO               | KO              | Manque de caractère avant @   |
| 11     | $email = alice.avril@            | KO               | KO              | Manque de caractère après @   |
| 12     | $email = alice.avril@.com        | KO               | KO              | Manque un nom de domaine      |
| 13     | $email = alice.avril@email       | KO               | KO              | Manque le ".com" ou ".fr" etc |
| 14     | $email = @emailalice.avril.fr    | KO               | KO              | Mauvais ordre                 |
| 15     | $email = alice.avril@.fremail    | KO               | KO              | Mauvais ordre                 |
| 16     | $email = avril@email.fr.de       | KO               | KO              | pas de "x.x", directement "x" |
| 17     | $email = alice.avril@email.fr.de | KO               | KO              | sous domaine                  |

- ### <a name="8a"></a>deconnexionSite

| Cas n° | Critère                          | Résultat attendu | Résultat obtenu | Commentaires                  |
|:-------|----------------------------------|------------------|-----------------|-------------------------------|
| 1      | $login = "alice" <br> $mdp = "azerty!123"       | Déconnexion et suppression des données de session              | Déconnexion et suppression des données de session              | La session d'Alice a été déconnectée avec succès et les données de session ont été supprimées           |
| 2      | Aucune session en cours | Aucune action n'est effectuée               | Aucune action n'est effectuée              | Aucune session en cours          |

- ### <a name="9a"></a>affichageMenuDuHaut

| Cas n° | Critère                               | Résultat attendu | Résultat obtenu |
|:-------|----------------------------------     |------------------|-----------------|
| 1      | $pageActuelle = "index"               | Les administrateurs système et web ont accès à : La page administration, tableau de bord, profil, les 10 derniers tickets et le bouton de déconnexion <br><br> Les techniciens et les utilisateurs ont accès à : La page de profil, tableau de bord, les 10 derniers tickets et le bouton de déconnexion <br><br> Les visiteurs ont accès aux : boutons d'inscription, de connexion et aux 10 derniers tickets               | Les administrateurs système et web ont accès à : La page administration, tableau de bord, profil, les 10 derniers tickets et le bouton de déconnexion <br><br> Les techniciens et les utilisateurs ont accès à : La page de profil, tableau de bord, les 10 derniers tickets et le bouton de déconnexion <br><br> Les visiteurs ont accès aux : boutons d'inscription, de connexion et aux 10 derniers tickets             | 
| 2      | $pageActuelle = "profil"              | L'administrateur web a accès à : La page index, tableau de bord et le bouton de déconnexion <br><br> L'administrateur système a accès à : La page index, tableau de bord, historique, journal d'activité et le bouton de déconnexion <br><br> Les techniciens et les utilisateurs ont accès à : La page index, tableau de bord et le bouton de déconnexion               | L'administrateur web a accès à : La page index, tableau de bord et le bouton de déconnexion <br><br> L'administrateur système a accès à : La page index, tableau de bord, historique, journal d'activité et le bouton de déconnexion <br><br> Les techniciens et les utilisateurs ont accès à : La page index, tableau de bord et le bouton de déconnexion              | 
| 3      | $pageActuelle = "tableaudebord"       | Les administrateurs web et système ont accès à : La page index, administration et aux boutons de déconnexion et profil <br><br> Les techniciens et utilisateurs ont accès à : La page index et aux boutons de déconnexion et profil               | Les administrateurs web et système ont accès à : La page index, administration et aux boutons de déconnexion et profil <br><br> Les techniciens et utilisateurs ont accès à : La page index et aux boutons de déconnexion et profil             | 
| 4      | $pageActuelle = "administration"      | Les administrateurs web et système ont accès à : La page index, tableau de bord et aux boutons de déconnexion et profil               | Les administrateurs web et système ont accès à : La page index, tableau de bord et aux boutons de déconnexion et profil              | 
| 5      | Bouton 1 : Inscription (menu du haut) | Retourne la page inscription               | Retourne la page inscription              | 
| 6      | Bouton 2 : Connexion                  | Retourne la page connexion               | Retourne la page connexion              | 
| 7      | Bouton 3 : Déconnexion                | Retourne la page index                | Retourne la page index               | 
| 8      | Bouton 4 : Profil                     | Retourne la page profil               | Retourne la page profil              | 


- ### <a name="10a"></a>operationCAPTCHA

| Cas n° | Critère                                                  | Résultat attendu | Résultat obtenu |
|:-------|----------------------------------------------------------|------------------|-----------------|
| 1      | $chiffre1 = 12 <br> $chiffre2 = 20 <br> $operateur = "+" | 32               | 32              | 
| 2      | $chiffre1 = 16 <br> $chiffre2 = 2 <br> $operateur = "+"  | 18               | 18              | 
| 3      | $chiffre1 = 0 <br> $chiffre2 = 19 <br> $operateur = "+"  | 19               | 19              |

- ### <a name="11a"></a>verifyCAPTCHA

| Cas n° | Critère                                                           | Résultat attendu | Résultat obtenu | Commentaires                 |
|:-------|-------------------------------------------------------------------|------------------|-----------------|------------------------------|
| 1      | $chiffre1 = 12 <br> $chiffre2 = 20 <br> $reponseUtilisateur = " " | KO               | KO              | Aucune réponse n'a été donné | 
| 2      | $chiffre1 = 12 <br> $chiffre2 = 20 <br> $reponseUtilisateur = !!  | KO               | KO              | Tentative échouée            | 
| 3      | $chiffre1 = 12 <br> $chiffre2 = 20 <br> $reponseUtilisateur = 45  | KO               | KO              | Captcha incorrect            |
| 4      | $chiffre1 = 12 <br> $chiffre2 = 20 <br> $reponseUtilisateur = 32  | OK               | OK              | Captcha correct              |
  
- ### <a name="12a"></a>saveToSessionSignUp 

| Cas n° | Critère                                                                                                               | Résultat attendu                                                                                                                                    | Résultat obtenu                                                                                                                                     | Commentaires                      |
|:-------|-----------------------------------------------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------|-----------------------------------|
| 1      | $login = "alice" <br> $nom = "alice" <br> $prenom = "Alice" <br> $email = "alice.avril@email.com" <br> $captcha = " " | L'enregistrement des données suivantes : <br><br> $login = "alice" <br> $nom = "alice" <br> $prenom = "Alice" <br> $email = "alice.avril@email.com" | L'enregistrement des données suivantes : <br><br> $login = "alice" <br> $nom = "alice" <br> $prenom = "Alice" <br> $email = "alice.avril@email.com" | La sauvegarde a bien été effectué | 
| 2      | $nom = "alice" <br> $prenom = "Alice" <br> $email = "alice.avril@email.com" <br> $captcha = " "                       | KO                                                                                                                                                  | KO                                                                                                                                                  | le champ login n'a pas été entré  | 
| 3      | $login = "alice" <br> $nom = "alice"  <br> $email = "alice.avril@email.com" <br> $captcha = " "                       | KO                                                                                                                                                  | KO                                                                                                                                                  | Le champ prénom n'a pas été entré |
| 4      | $login = "alice" <br>  $prenom = "Alice" <br> $email = "alice.avril@email.com" <br> $captcha = " "                    | KO                                                                                                                                                  | KO                                                                                                                                                  | Le champ nom n'a pas été entré    |
| 5      | $login = "alice" <br> $nom = "alice" <br> $prenom = "Alice" <br> $captcha = " "                                       | KO                                                                                                                                                  | KO                                                                                                                                                  | Le champ email n'a pas été entré  |

