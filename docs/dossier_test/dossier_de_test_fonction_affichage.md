Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de test 
## Site dynamique (fonctions)

<br><br>
Ce document permet de s'assurer que les fonctions d'affichage soient bien fonctionnelles comme souhaité.

</div>

<br><br><br><br><br><br><br>

## Plan
- ### [I - Introduction](#I)
- ### [II - Description de la procédure de test](#II)
- ### [III - Contexte des tests](#III)
- ### [IV - Test ](#IV)
    - #### [Test fonctions](#a)
        - #### [tablegenerate](#1a)
        - #### [pageAccess](#2a)
        - #### [deconnexionSite](#3a)
        - #### [affichageMenuDuHaut](#4a)
        - #### [operationCAPTCHA](#5a)
        - #### [menuDeroulant](#6a)


<br><br><br>

----------

<br><br><br>

## <a name="I"></a>I - Introduction

Le document suivant a pour but de tester les différentes fonctions d'affichage créé pour permettre une utilisation plus simple de ses mêmes lignes de code.
<br>

## <a name="II"></a>II - Description de la procédure de test

Les fonctions que nous allons tester seront 
<br>

## <a name="III"></a>III - Contexte des tests

| Définition                         | Situation pour le test                                           |
|------------------------------------|------------------------------------------------------------------|
| Produit testé                      | Site dynamique (PHP)                                             |
| Configuration logicielle           | Firefox (118.0.1 et 64 bits) et<br/>Windows 10 (64 bits et 22H2) |
| Configuration matérielle           | Dell Optiplex 9020                                               |
| Date de début                      | 21/11/2023                                                       |
| Date de finalisation               | 26/03/2024                                                       |
| Test à appliquer                   | Vérification du bon fonctionnement des fonctions                 |
| Responsable de la campagne de test | Gouabi Assia, Guignolle Enzo                                     |

<br><br><br>

----------

<br><br><br>

## <a name="IV"></a>IV - Test

- ### <a name="1a"></a>tablegenerate

| Cas n° | Critère                                                                                                                                                                    | Résultat attendu  | Résultat obtenu    | Commentaires                            |
|:-------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------|--------------------|-----------------------------------------|
| 1      | Affichage avec la requête suivante "SELECT * FROM vue_Ticket_visiteur"                                                                                                     | 4 colonne affiché | 4 colonnes affiché | Affichage de 4 colonnes dans un tableau |
| 2      | Affichage avec la requête suivante "SELECT OBJET_TICKET NIV_URGENCE_ESTIMER_TICKET DESCRIPTION_TICKET FROM vue_Ticket_visiteur"                                            | 3 colonne affiché | 3 colonnes affiché | Affichage de 3 colonnes dans un tableau |
| 3      | Affichage avec la requête suivante "SELECT NIV_URGENCE_ESTIMER_TICKET DESCRIPTION_TICKET FROM vue_Ticket_visiteur"                                                         | 2 colonne affiché | 2 colonnes affiché | Affichage de 3 colonnes dans un tableau |
| 4      | Affichage avec la requête suivante "SELECT DESCRIPTION_TICKET FROM vue_Ticket_visiteur"                                                                                    | 1 colonne affiché | 1 colonne affiché  | Affichage de 1 colonne dans un tableau  |
| 5      | Affichage avec la requête suivante "SELECT LOGIN_USER OBJET_TICKET NIV_URGENCE_ESTIMER_TICKET DESCRIPTION_TICKETFROM Ticket t JOIN Utilisateur u ON t.ID_USER = u.ID_USER" | 5 colonne affiché | 5 colonne affiché  | Affichage de 5 colonnes dans un tableau |

- ### <a name="2a"></a>pageAccess

| Cas n° | Critère                                         | Résultat attendu | Résultat obtenu | Commentaires                                 |
|:-------|-------------------------------------------------|------------------|-----------------|----------------------------------------------|
| 1      | Le fichier de session n'existe pas              | KO               | KO              | La personne ne s'est pas connecté au site    |
| 2      | Les valeurs du fichier de session sont vides    | KO               | KO              | La session de l'utilisateur n'a aucune infos |
| 3      | L'utilisateur n'est pas dans la base de données | KO               | KO              | La personne ne s'est pas inscrit             |
| 4      | L'utilisateur n'a pas de compte                 | KO               | KO              | La personne ne s'est pas inscrit             |
| 5      | La connexion de l'utilisateur à échoué          | KO               | KO              | Le mot de passe à été modifié                |
| 6      | L'utilisateur n'a pas de rôle                   | KO               | KO              | Aucun rôle est associé à l'utilisateur       |
| 7      | Tout est valide                                 | OK               | OK              | Aucune erreur n'a été signalé                |

- ### <a name="3a"></a>deconnexionSite

| Cas n° | Critère                                   | Résultat attendu                                  | Résultat obtenu                                    | Commentaires                                                                                  |
|--------|-------------------------------------------|---------------------------------------------------|----------------------------------------------------|-----------------------------------------------------------------------------------------------|
| 1      | $login = "alice" <br> $mdp = "azerty!123" | Déconnexion et suppression des données de session | Déconnexion et suppression des données de session  | La session d'Alice a été déconnectée avec succès et les données de session ont été supprimées |
| 2      | Aucune session en cours                   | Aucune action n'est effectuée                     | Aucune action n'est effectuée                      | Aucune session en cours                                                                       |

- ### <a name="4a"></a>affichageMenuDuHaut

| Cas n° | $pageActuelle                         | Résultat attendu                                                                                                                                                                                                                                                                                                                                                                                               | Résultat obtenu                                                                                                                                                                                                                                                                                                                                                                                                |
|:-------|---------------------------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| 1      | index                                 | Les administrateurs système et web ont accès à : La page administration, tableau de bord, profil, les 10 derniers tickets et le bouton de déconnexion <br><br> Les techniciens et les utilisateurs ont accès à : La page de profil, tableau de bord, les 10 derniers tickets et le bouton de déconnexion <br><br> Les visiteurs ont accès aux : boutons d'inscription, de connexion et aux 10 derniers tickets | Les administrateurs système et web ont accès à : La page administration, tableau de bord, profil, les 10 derniers tickets et le bouton de déconnexion <br><br> Les techniciens et les utilisateurs ont accès à : La page de profil, tableau de bord, les 10 derniers tickets et le bouton de déconnexion <br><br> Les visiteurs ont accès aux : boutons d'inscription, de connexion et aux 10 derniers tickets | 
| 2      | profil                                | L'administrateur web a accès à : La page index, tableau de bord et le bouton de déconnexion <br><br> L'administrateur système a accès à : La page index, tableau de bord, historique, journal d'activité et le bouton de déconnexion <br><br> Les techniciens et les utilisateurs ont accès à : La page index, tableau de bord et le bouton de déconnexion                                                     | L'administrateur web a accès à : La page index, tableau de bord et le bouton de déconnexion <br><br> L'administrateur système a accès à : La page index, tableau de bord, historique, journal d'activité et le bouton de déconnexion <br><br> Les techniciens et les utilisateurs ont accès à : La page index, tableau de bord et le bouton de déconnexion                                                     | 
| 3      | tableaudebord                         | Les administrateurs web et système ont accès à : La page index, administration et aux boutons de déconnexion et profil <br><br> Les techniciens et utilisateurs ont accès à : La page index et aux boutons de déconnexion et profil                                                                                                                                                                            | Les administrateurs web et système ont accès à : La page index, administration et aux boutons de déconnexion et profil <br><br> Les techniciens et utilisateurs ont accès à : La page index et aux boutons de déconnexion et profil                                                                                                                                                                            | 
| 4      | administration                        | Les administrateurs web et système ont accès à : La page index, tableau de bord et aux boutons de déconnexion et profil                                                                                                                                                                                                                                                                                        | Les administrateurs web et système ont accès à : La page index, tableau de bord et aux boutons de déconnexion et profil                                                                                                                                                                                                                                                                                        | 
| 5      | Bouton 1 : Inscription (menu du haut) | Retourne la page inscription                                                                                                                                                                                                                                                                                                                                                                                   | Retourne la page inscription                                                                                                                                                                                                                                                                                                                                                                                   | 
| 6      | Bouton 2 : Connexion                  | Retourne la page connexion                                                                                                                                                                                                                                                                                                                                                                                     | Retourne la page connexion                                                                                                                                                                                                                                                                                                                                                                                     | 
| 7      | Bouton 3 : Déconnexion                | Retourne la page index                                                                                                                                                                                                                                                                                                                                                                                         | Retourne la page index                                                                                                                                                                                                                                                                                                                                                                                         | 
| 8      | Bouton 4 : Profil                     | Retourne la page profil                                                                                                                                                                                                                                                                                                                                                                                        | Retourne la page profil                                                                                                                                                                                                                                                                                                                                                                                        | 


- ### <a name="5a"></a>operationCAPTCHA

### Exécution des tests 

| Cas n° | $chiffre1 | $chiffre2 | $operateur | Résultat attendu | Résultat obtenu |
|:-------|-----------|-----------|------------|------------------|-----------------| 
| 1      | 12        | 20        | +          | 32               | 32              | 
| 2      | 16        | 2         | +          | 18               | 18              | 
| 3      | 0         | 19        | +          | 19               | 19              |


- ### <a name="6a"></a>MenuDeroulant

### Exécution des tests

| Cas n° | $resultatSQL                                          | $attributListe | $elementACocher                                     | Résultat attendu                                                                                                | Résultat obtenu                                                                                                 | Validation |
|:-------|-------------------------------------------------------|----------------|-----------------------------------------------------|-----------------------------------------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------|------------|
| 1      | Aucun résultat                                        | "selected"     | array()                                             | un menu déroulant vide                                                                                          | un menu déroulant vide                                                                                          | OK         |
| 2      | Aucun résultat                                        | "selected"     | array("[MATERIEL] Matériel manquant")               | un menu déroulant vide                                                                                          | un menu déroulant vide                                                                                          | OK         |
| 3      | Résultat d'une requête sur la table <br> TitreTicket  | "selected"     | array("[MATERIEL] Matériel manquant")               | un menu déroulant selectionnable avec les information de $resultatSQL <br> et l'élément sélectionne de celle ci | un menu déroulant selectionnable avec les information de $resultatSQL <br> et l'élément sélectionne de celle ci | OK         |
| 4      | Résultat d'une requête sur la table <br> TitreTicket  | "selected"     | array()                                             | un menu déroulant selectionnable avec les information de $resultatSQL                                           | un menu déroulant selectionnable avec les information de $resultatSQL                                           | OK         |
| 5      | Aucun résultat                                        | "checked"      | array()                                             | un menu déroulant vide                                                                                          | un menu déroulant vide                                                                                          | OK         |
| 6      | Aucun résultat                                        | "checked"      | array("Salle R&T : Autre", "Matériel : Ordinateur") | un menu déroulant vide                                                                                          | un menu déroulant vide                                                                                          | OK         |
| 7      | Résultat d'une requête sur la table <br> MotcleTicket | "checked"      | array("Salle R&T : Autre", "Matériel : Ordinateur") | un menu déroulant cochable avec les information de $resultatSQL <br> et les éléments cocher de celle ci         | un menu déroulant cochable avec les information de $resultatSQL <br> et les éléments cocher de celle ci         | OK         |
| 8      | Résultat d'une requête sur la table <br> MotcleTicket | "checked"      | array()                                             | un menu déroulant cochable avec les information de $resultatSQL                                                 | un menu déroulant cochable avec les information de $resultatSQL                                                 | OK         |
| 9      | Aucun résultat                                        | vide           | array()                                             | Aucun menu déroulant                                                                                            | Aucun menu déroulant                                                                                            | OK         |
| 10     | Aucun résultat                                        | vide           | array("[MATERIEL] Matériel manquant")               | Aucun menu déroulant                                                                                            | Aucun menu déroulant                                                                                            | OK         |
| 11     | Résultat d'une requête sur la table <br> TitreTicket  | vide           | array("[MATERIEL] Matériel manquant")               | Aucun menu déroulant                                                                                            | Aucun menu déroulant                                                                                            | OK         |
| 12     | Résultat d'une requête sur la table <br> MotcleTicket | vide           | array()                                             | Aucun menu déroulant                                                                                            | Aucun menu déroulant                                                                                            | OK         |

Les fonctions isSelected, appendTOCSV, csvToHTMLTable, getIP, dirToTable, test, extractFile et writeInscriptionLogs sont fonctionnelles et retournent bien ce pourquoi elles ont été créé. 

Les fonctions saveToSessionSignUP, saveToSessionCreateTicket permettent bien de sauvegarder les données correctes du formulaire de saisie. 

Les fonctions chiffe et dechiffre permettent bien de chiffrer et déchiffrer les mots de passe notamment dans les pages de modification telles que modification mot de passe ou email. 

Enfin, les fonctions creationJeton, miseAJourJeton, verifJeton gèrent la durée et la mise à jour de l'ouverture d'une session et la fonction verifEstBanni vérifie bien si un utilisateur est banni de l'application. 

