Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3  - Fichier de maintenance

<br><br>
Ce document permet de récapituler la progression de chacun et de l'avancée du projet dans sa globalité.<br>
Chaque semaine, il y a un bilan expliquant ce qui fonctionne, nos problèmes, nos discussions ou encore nos prévisions.
</div>


<br><br><br>

## Dimanche 26/11/2023 - Bilan du travail du 18/11/2023 au 26/11/2023
Exceptionnellement cette semaine, il n'y a pas eu de répartition des tâches ni d'organisation à cause du retard que nous avons accumulé.<br>
J'ai pris la décision de terminer les 3 pages qui mettait beaucoup trop de temps d'être clôturé : inscription, connexion et déconnexion.
3 semaines après le début de leur création, elles sont enfin terminé. Il y aura juste le captcha à intégrer dans la page inscription et modifier la requête
d'insertion de l'utilisateur dans la BD (on indiquera plus les rôles dans la BD).<br>
Je n'ai donc pas eu le temps de gérer le projet ni de voir l'avancer du travail des différents membres.<br>
<br>
Dans notre malheur, nous faisons face à 3 bonnes nouvelles !<br>
1. J'ai réussi à faire fonctionner les droits des rôles MariaDB (il fallait le mettre comme rôle par défaut à l'utilisateur : `SET DEFAULT ROLE 'role' FOR 'user'@'localhost'`;).
2. J'ai trouvé la requête MariaDB pour que l'utilisateur puisse changer son propre mot de passe : `SET PASSWORD = PASSWORD("monMDP");` (`PASSWORD()` permet de chiffrer le mot de passe).
3. J'ai trouvé le moyen de désactiver la sécurité qui empêche à une vu MariaDB de prendre en compte le WHERE CURRENT_USER (sur PHPMyAdmin, pas en requête) : Sur la vu -> Structure -> Editer la vue -> Mettre SQL SECURITY sur Invoker -> Exécuter

<br>
Désormais, nous n'avons plus de raison d'avoir de nouveau du retard puisque nous pensons ne plus avoir de difficultés à affronter.<br>
<br>
Ce retard a été provoqué par une désorganisation générale de l'équipe. Le développement de certaines pages commençait alors que la conception n'était pas faite.<br>
Cette désorganisation peut être expliqué par le fait que chaque membre était un peu perdu à cause du manque de communication au sein de l'équipe.<br>
<br>
Avec Florent, chef de la conception du projet, nous avons réfléchi à une réorganisation du dépôt git :<br>
Fini les branches "dossier conception" et "dossier test", désormais, la conception, le développement et les tests par fonctionnalités sont sur la branche de la fonctionnalité concernée.<br>
Cela nous permet de mieux voir là où on en est, et d'avoir tout à un même endroit.<br>
Les branches pages sont des sous-branches de la branche représentant leur répertoire, qui sont eux-mêmes des sous branche de la branche site_dynamique.<br>
<br>
Avec un dépôt mieux organisé et plus simple à comprendre, il sera plus facile de voir ce qui a été fait et ce qui peut être fait.<br>
Les fichiers sont travaillés directement depuis le serveur XAMPP, serveur de secours ou serveur RPi4. Ils sont ensuite transférés vers GitHub.<br>
<br>
<br>
Les problèmes ont été résolus grâce à l'aide de Mme PREDA, M. LOYER et de M. DUFAUD (gestion du dépôt git).<br>
<br>

#### Avancé

- **Ce qui a été terminé :** <br>
  - Page connexion (les msg erreurs), action connexion, test (terminé par Matthieu)
  - Page inscription (les msg erreurs), action inscription, test (terminé par Matthieu)
  - Test page déconnexion (terminé par Matthieu)
  - Fonction recupererRoleDe (manque conception je crois ? Note : ça ne serait pas l'objectif d'UserRole d'ailleurs en fait ?) (Matthieu)
  - Fin dev connectUser, valideMDP, executeSQL (terminé par Matthieu, commencé par Florent, Enzo, Assia)
  - Fin dossier de test des fonctions executeSQL, pages modifMdp et modifEmail (Assia, commencé par Enzo)
  - Cas d’utilisation modifEmail et modifMdp (Assia)

- **Ce qui sera à terminer la semaine prochaine :**<br>
  - Page modif mot de passe (Assia, Enzo, Florent)
  - Page modif adresse email (Assia, Enzo, Florent)
  - Nouvelle version de la base de données (Enzo, Matthieu)
  - Le devoir en Droit : utilisation des données (Assia et Tom ?)

- **Ce qui a été avancé :**
  - Nouvelle version du site statique (Tom)
  - Page de profile (Enzo)

Note : Florent s'occupe d'une fonction dédiée à la génération des tableaux HTML. Je ne suis pas allé me renseigner de son avancée.

#### Travail effectué
- **Florent**<br>
  - Conception des pages (notamment modification mot de passe et modification adresse email)
  - Conception et début des codes connectUser, valideMDP, executeSQL
  - Conception des fonctions isConnected() et userRole()

- **Tom**<br>
  - Nouvelle version du site (HTML, CSS, JavaScript)

- **Enzo** :<br>
  - Début des codes connectUser, valideMDP, executeSQL
  - Début dossier de test des fonctions executeSQL, pages modifMdp et modifEmail
  - Page modif mot de passe et modif email (dev)
  - Modification de la base de données, recherche par rapport aux problèmes des vues et des modifications de mot de passe

- **Assia**<br>
  - Début des codes connectUser, valideMDP, executeSQL
  - Fin dossier de test des fonctions executeSQL, pages modifMdp et modifEmail
  - Cas d’utilisation modifEmail et modifMdp
  - Page modif mot de passe et modif email (dev)
  - Suite du devoir en Droit
  - Ajout des commentaires et certains cas pour les autres fonctions et pages


- **Matthieu (chef de projet)**<br>
  - Gestion des branches du dépôt Git, gestion minimale du projet
  - Page connexion (les msg erreurs), action connexion, test
  - Page inscription (les msg erreurs), action inscription, test
  - Test page déconnexion
  - Fonction recupererRoleDe (remarque : il est possible que Florent ai fait une fonction similaire)
  - Fin dev connectUser, valideMDP, executeSQL
  - Modification de la base de données (les rôles et leurs droits)

<br><br><br>

---

## Vendredi 17/11/2023 - Bilan du travail du 11/11/2023 au 17/11/2023
Cette semaine, nous avons quasiment résolu tous les problèmes cités précédemment. Nous avons pu avancer, nous ne sommes plus bloqués.<br>
L'expérience de binôme Florent-Enzo est concluante, nous allons la poursuivre. Il y a une meilleure ambience au sein du groupe.<br>
<br>
Les problèmes 1 et 2 sont en cours de résolution. Dans le premier cas, nous en discutons avec notre professeur de base de données, Madame PREDA.<br>
Pour le deuxième, nous sommes en cours de réflexion concernant la page d'administration et une page du CGU. Dans tous les cas, la partie HTML des pages PHP n'est pas à jour.<br>
<br>
Malgré ces bonnes nouvelles, nous prenons du retard. Des pages simples à faire en quelques heures demandent plus de temps.<br>
Ce n'est pas forcément un manque d'implication, même si c'est le cas pour la base de donnée, c'est je pense surtout la difficulté de se projeter sur comment fonctionne le système.<br>
<br>
En tant que chef de projet, il m'est compliqué d'être présent sur plusieurs parties du projet à la fois. Aider, nous fait perdre du temps. Cela demande à reflexion...<br>
<br>
Avec la fin de l'installation du RaspberryPi 4, je vais reprendre en main les tâches qui tardent trop à être terminé. Ce n'est pas possible de continuer comme ça.<br>
<br>

#### Avancé

- **Ce qui a été terminé :** <br>
  - Sécurisation du RaspberriPi 4 et son rapport d'installation
  - Patch de la base de données : Création de la table UrgenceTicket
  - Script de test comportant des utilisateurs et des tickets
  - Utilisateurs fictifs MariaDB pour le fonctionnement des pages

- **Ce qui a été commencé :**
  - Adaptation des pages HTML (devenu PHP) en fonction des utilisateurs

- **Ce qui a été avancé :**
  - Fonction simplifiant l'utilisation de la base de données
  - Correction site statique (il faut l'ajouter au code PHP maintenant...)

#### Travail effectué
- **Florent**<br>
  - Fonction simplifiant l'utilisation de la base de données

- **Tom**<br>
  - Correction site statique (il faut l'ajouter au code PHP maintenant...)
  
- **Assia**<br>
  - Sécurisation du RaspberriPi 4 et son rapport d'installation
  
- **Enzo** :<br>
  - Adaptation des pages HTML (devenu PHP) en fonction des utilisateurs
  - Utilisateurs fictifs MariaDB pour le fonctionnement des pages
  
- **Matthieu (chef de projet)**<br>
  - Sécurisation du RaspberriPi 4 et son rapport d'installation
  - Patch de la base de données : Création de la table UrgenceTicket
  - Script de test comportant des utilisateurs et des tickets

<br><br><br>

---

## Samedi 11/11/2023 - Bilan du travail du 03/11/2023 au 10/11/2023
Durant cette semaine, nous avons pu commencer la création du site dynamique. Cependant, nous faisons faces à différents problèmes de différentes tailles.<br>

Les problèmes par ordre croissant (gravité) :
1. Les utilisateurs n'héritent pas des droits des rôles
2. Il manque des éléments sur la maquette donc sur le site statique suite à la création de la base de données et à la relecture attentive du sujet.
3. Le serveur interdit l'utilisation de root (MariaDB) dans les scripts PHP.
4. Les scripts SQL pour créer des utilisateurs et des tickets n'ont pas été fait.
5. Aucun moyen de modifier la base de données par les vues.

Solutions :
1. Solution temporaire : On associe les droits directement aux utilisateurs en attendant de trouver une solution avec Mme PREDA
2. À faire le plus vite possible
3. Création de profil MariaDB dédié à la gestion des pages (on le fait directement au lieu de tester en premier avec root)
4. À faire en urgence
5. Il faut faire des triggers, ATTENTION : il est possible qu'il faille créer au préalable des profils MariaDB dédié à la gestion des pages.

Si les problèmes 1 et 3 n'affecte pas vraiment notre progression, la 2 risque de poser rapidement un problème et les problèmes 4 et 5 limite sévèrement notre progression actuel.<br>
En ce samedi 11 novembre, il est obligatoire de résoudre ces problèmes.

Certaines tâches n'ont pas été effectués :
- Certaines pages n'ont pas été corrigés - Tom
- Création de qq utilisateurs et tickets bidon - Enzo
  - En conséquence, je m'en occupe, mais cela nous a accumulé du retard.
- Email pour M Dufaud - Matthieu
- git tag - Matthieu
- renommage des branches terminés - Matthieu
- Règles métiers (il faudrait demander à M Hoguin peut-être..)

#### Changement de l'organisation
Pour pallier le retard d'Enzo à suivre l'avancée du groupe et pour l'aider dans ses tâches, désormais Florent et Enzo travailleront ensemble en binôme.<br>
Cela permettra d'améliorer la cohésion de l'équipe en évitant de nouveaux les moments pouvant sévèrement impacter l'entente au sein du groupe.........<br>
<br>

#### Avancé

- **Ce qui a été terminé :** <br>
  - Fin du rapport d'installation du serveur et de ses composants. Il manque simplement la partie sécurisation.
  - Fin de la réinstallation complète du serveur RPi4 et du serveur de secours.
  - Fin de la mise en réseau définitive via Hamachi sur les deux serveurs.
  - Test sur la base de données (juste ajouter une mini description des cas, peut-être qu'il faut rajouter des trucs, je n'en sais rien)
  - Base de données V1 (il faudra la continuer pour mettre les triggers etc)
  - Page de déconnexion (ok)
  - Diagramme composant (il faut demander à M Dufaud, mauvaise branche d'ailleurs)
- **Ce qui a été commencé :**
  - Page d'inscription (ne peut être terminé donc...)
  - Page de connexion (de même...)
  - Page de tableau de bord (ok)
  - Page de déconnexion (ok)
  - Page de modification de mot de passe
  - Script générant des utilisateurs et des tickets (qu'utilisateurs pour le moment)
- **Ce qui a été avancé :**
  - Correction des pages statiques
  - Conception du site dynamique
- **Ce qui devra être terminé pour la semaine prochaine :**
  - Script générant des utilisateurs et des tickets
  - Page de connexion
  - Page d'inscription
  - Page de déconnexion
  - Page de modification de Mot de passe
  - Page index.php
  - Rectification du site statique
- **Ce qui devra être commencé pour la semaine prochaine :**
  - Sécurisation du RPi4 (retardé)
  - Page index.php
  - Page profil.php
  - Page modif email (profil)
- **Ce qui doit être continué :**
  - tableau de bord php
  - cas d'utilisations
  - dossier de test
  - conception site dynamique

#### Travail effectué
- **Florent**<br>
  - Début création du tableau de bord
  - Fin diagramme des composants (normalement
  - Conception du site dynamique
- **Tom**<br>
  - Début des corrections des pages statiques
  - Rangement des fichiers du site statique
- **Assia**<br>
  - Début création de la page modification de mot de passe (avec Enzo)
  - Début création de la page connexion
  - Fin création page déconnexion
  - Suite des cas d'utilisations
- **Enzo** :<br>
  - Début création de la page modification de mot de passe (avec Assia)
  - Fin du dossier de test de la base de donnée V1
  - Correction des problèmes liés à la base de données (erreurs dans le script, problème des roles)
- **Matthieu (chef de projet)**<br>
  - Aide pour la page de connexion (mise en place serveur, message d'erreur)
  - Modification des cas d'utilisations
  - Gestion des branches git
  - Gestion du projet
  - Début script générant des utilisateurs et des tickets
  - Fin du rapport d'installation du serveur et de ses composants. 
  - Fin de la réinstallation complète du serveur RPi4 et du serveur de secours.
  - Fin de la mise en réseau définitive via Hamachi sur les deux serveurs.

<br><br><br><br>

---

## Jeudi 02/11/2023 - Bilan du travail du 27/10/2023 au 02/11/2023
Nous avons assez bien avancé cette semaine.<br>
En dehors des serveurs à réinstaller proprement, le rapport d'installation, la base de données et les tests sur celle-ci à terminer,
on pourrait même dès à présent le développement PHP. Cependant, nous préférons attendre encore un peu, notamment vis à vis de la progression des cas d'utilisations.<br>
Attention ! La conception du site dynamique n'a pas encore été effectué. Nous allons devoir créer le site à partir des cas d'utilisations et sans la conception.<br>
<br>
Mes remarques sur les travaux sont sur : https://discord.com/channels/1148991038761996328/1154334739638005841/1172841989054660658 <br>
Malgré ces problèmes qui vont nous retarder, on s'en sort très bien. Je dois mieux répartir les tâches cependant.

#### Avancé
- **Ce qui a été terminé :** <br>
  - Test de mise en réseau via LogMeIn Hamachi réussite.

- **Ce qui a été commencé :**
  - Création de la base de données (table, vues, utilisateurs MariaDB)

- **Ce qui devra être terminé pour la semaine prochaine :**
  - Création de la base de données (Date limite : Samedi 4 Novembre 2023)
  - Conception de la base de données (DL: 04/11/2023)
  - Test sur la base de données (DL: 04/11/2023)
  - Rapport d'installation du serveur (hors sécurisation) (DL: 04/11/2023)
  - Réinstallation au propre du serveur (hors sécurisation) (DL: 04/11/2023)
  - Sécurisation du serveur (qui devra être commencé)

- **Ce qui devra être commencé pour la semaine prochaine :**
  - Création du site dynamique
  - Sécurisation du serveur (qui devra être terminé)
  - Conception du site dynamique **EN URGENCE, RETARD A RATTRAPER : ON COMMENCE DEJA LE SITE !!**

#### Travail effectué du dimanche 27/10/2023 au jeudi 02/11/2023
- **Florent**<br>
  - Réflexion sur la conception, rien de rédigé (Attention au retard !)

- **Tom**<br>
  - Conception de la BD (quasi terminé)
  - Création de la BD : tables, vues et utilisateurs (quasi terminé)

- **Assia**<br>
  - Début de l'écriture de quelques cas d’utilisation

- **Enzo** :<br>
  - Correction des erreurs dans le code de la BD
  - Description des vues dans le fichier .md
  - Début des tests pour la BD


- **Matthieu (chef de projet)**<br>
  - Fin des tests de mise en réseau via LogMeIn Hamachi
  - Suite du rapport d'installation (parties I et II terminée)
  - Gestion du projet : planning, répartition des tâches, gestion du git (branches renommés...)
  - Critique sur la base de données

<br><br><br><br>

---

## Jeudi 26/10/2023 - Bilan du travail du 22/10/2023 au 26/10/2023

#### À propos du planning
Notre travail sur la SAÉ a été perturbé par les nombreux contrôles que nous avons eus durant cette semaine. Nous avons fait le choix d'avancer exclusivement durant les heures de SAÉ.<br>

#### Avancé
- **Ce qui a été terminé :** <br>
  - Maquette du site statique
  - Site statique
  - Conception architecturale du site statique
  - Spécification terminée pour le site statique
  - Cahier des charges et dossier recueil des besoins
  - Conception de la base de donnée :
    - Transfert du document Word en Markdown
    - Listage des tables et des attributs

- **Ce qui a été commencé :**
  - Préparation du dossier de test pour la partie dynamique et la base de données
  - Spécifications pour la partie dynamique
  - Cas d'utilisation pour la partie dynamique

- **Ce qui devra être terminé pour la semaine prochaine :**
  - Conception de la base de données
  - Installation du serveur
  - Rapport d'installation du serveur

- **Ce qui devra être commencé pour la semaine prochaine :**
  - Création de la base de données

#### Travail effectué du dimanche 22/10/2023 au jeudi 26/10/2023
- **Florent**<br>
  - Fin de la conception est des spécifications pour le site statique
  - Début conception et spécifications pour le site statique
  
- **Tom**<br>
  - Fin du site statique et sa maquette
  - Conception de la base de données
  - Vérification de la conformité du site statique avec le dossier de test

- **Assia**<br>
  - Fin du cahier des charges et recueil des besoins
  - Début des cas d'utilisations pour la partie dynamique du site
  
- **Enzo** :<br>
  - Fin du dossier de test site statique
  - Préparation du dossier de test pour la partie dynamique et la base de données 

- **Matthieu (chef de projet)**<br>
  - Vérification des tests sur la dimension de l'écran pour le site statique
  - Transfert du Word et suite de la conception de la base de donnée
  - Tâche de gestion de projet : attribution des tâches, gestion des branches, gestion du planning
  - Installation et tentative de mise en réseau via Hamachi du serveur
  - Début de la rédaction de l'installation du RPi4

<br><br><br><br>

---

## Samedi 21/10/2023 - Bilan du travail du 15/10/2023 au 21/10/2023

#### Changement du planning
Au cours de cette semaine, j'ai modifié le planning (planning.png).<br>
Premièrement, de ce lundi à ce vendredi, on a décidé de mettre un peu de côté la SAÉ pour nous concentrer sur nos contrôles (hors heures de SAÉ).<br>
Nous profiterons du week-end du 28 octobre pour discuter de l'organisation de la SAÉ et de notre organisation durant les vacances.<br>
<br>
Deuxièmement, la fin de la mise en service sans ssh du RPi4 a été repoussé à aujourd'hui, samedi 21/10/2023.<br>
Pour pouvoir utiliser le RPi4, nous devions acheter un adaptateur HDMI vers Micro HDMI. Il nous était donc impossible de l'installer jeudi.<br>

#### Avancé
- **Ce qui a été terminé :** <br>
  - Diagramme UML
  - Charte graphique du site web (fait sur Google Docs)
  - Argumentaire du logo (fait sur Google Docs)
  - Recueil des besoins (avant passage à la préparation du site dynamique)
  - Envoi des invitations à rejoindre le dépôt à M. HOGUIN, M. DUFAUD, M. DJERROUD
  - Récupération du RPi4 (+ alimentation et son sac) de M. HOGUIN

- **Ce qui doit être avancé, terminé :**
  - Maquette du site statique (Date limite : 22/10/23)
  - Site statique (DL : 22/10/23)
  - Conception architecturale du site statique (DL : 22/10/23)
  - Cahier des charges (DL : 22/10/23)

- **Ce qui a été commencé, avancé :** <br>
  - Conception de la base de données
  - Installation du RPi4 (sans ssh)


Cette partie sera mise à jour durant la journée du samedi 21 octobre 2023.<br>
<br>

#### Travail effectué du jeudi 12/10/2023 au samedi 21/10/2023

- **Florent**<br>
  - Suite de la charte graphique du site
  - Création des documents liés à la conception architecturale
- **Tom**<br>
  - Suite de la création du site statique
  - Rectification de la maquette
- **Assia**<br>
  - écriture de la partie I et II du dossier de test
  - Suite et fin de la rédaction du choix du logo et de la conclusion qui finalise la charte logo
  - Finalisation de la charte graphique du site
  - Remplissage du (vrai...) cahier des charges
  - Conception de la base de données
- **Enzo** :<br>
  - Dossier de test site statique
  - Diagramme UML du site statique
- **Matthieu (chef de projet)**<br>
  - Correction du recueil des besoins
  - Modification du plan de travail prévu
  - Modification du planning
  - Création puis modification de l'organisation prévue du git
  - Vérification du travail effectué
  - Répartition des tâches entre les différents membres
  - Création du dossier de test pour le site statique
  - Gestion des branches du GIT
  - Installation du RPi4 (sans ssh)
  - Conception de la base de données
  
<br><br><br><br>

---

## 13/10/2023 - Bilan du travail effectué jusqu'à présent

#### Problème
Le projet a été commencé il y a 3 semaines, le 21 septembre 2023. Malheureusement, le premier bilan et l'explication de notre planning se font aujourd'hui.<br>
Au début du projet, nos efforts étaient répartis entre le cahier des charges, la conception et la création des logos.<br>
Nous avons rencontré de très grandes difficultés par rapport à l'écriture du cahier des charges.
En effet, notre professeur M. DJERROUD étant très occupé, nous pouvions échanger avec lui que durant les heures de cours, le mardi.
Malheureusement, notre cahier des charges initial ne correspondait pas au travail attendu, le plan n'était pas le bon.
Nous avons donc dû le recommencer, et consacrer une grande partie de nos efforts pour celui-ci au détriment des prévisions que nous avons faites.<br>
<br>
Mardi 10 octobre, nous avons eu la validation de notre cahier des charges avec simplement quelques remarques dessus.
Avec les indications de M. DUFAUD par rapport au projet, nous pouvons désormais organiser notre travail en étant assuré d'aller dans la bonne direction.


#### Avancé
- **Ce qui a été terminé :** <br>
  - Nous avons choisi le logo du site, mais nous continuons à chercher un nom pour notre application. <br>
  - Concernant l'application, nous avons choisi la maquette à utiliser parmi les deux. Nous l'avons ajusté en s'inspirant des points forts de la deuxième et nous l'avons détaillée.
  - Nous estimons avoir assez bien réfléchi sur les données à stocker, grâce à la réflexion qui a été faite dans le cahier des charges abandonné. 
- **Ce qui doit être avancé :** <br>
  - 🔷️ Concernant le cahier des charges, il manque la prise en compte des remarques de M. DJERROUD.
  - Il manque également les cas d'utilisation correspondants au site internet statique. <br>
  - La rédaction du choix du logo et de la charte graphique doit être terminée au plus vite.
  - Le plan de travail doit être retravaillé, en prenant compte de l'ajout du planning et de ce document.
- **Ce qui a été commencé :** <br>
  - 🔷 Nous avons commencé à réfléchir sur le diagramme UML sur la base du sujet.<br>
  - La rédaction des documents concernant la gestion des risques a été très bien commencée. Nous devons compléter ces documents jusqu'au 29 octobre 2023.
- **Ce qui doit être commencé, fait :** <br>
  - 🔷 Une partie de notre travail ne se trouve pas sur le dépôt Git. Ces fichiers et documents doivent être mis sur le dépôt git au plus vite. La maquette sélectionnée par exemple.
  - 🔷 Nous devons également construire le dossier de conception, qui inclura les diagrammes UML, dont celui qui a été légèrement commencé.<br>
    - À noter qu'une partie de la réflexion a été fait dans le cahier des charges abandonné.
  - Concernant la gestion du projet :
    - Il faut de toute urgence découper les nouvelles tâches du planning pour pouvoir les répartir entre les membres.
    - Préparer le git pour l'accueil de la création du site statique et de son dossier de test
  - Préparer un dossier de test pour le site statique

#### Répartition des tâches jusqu'à ce jour
- Florent :
  - Fin de la rédaction de la charte graphique
    - Estimation : terminé le dimanche 15 octobre
    - Remarque : impliquera une modification mineure de la maquette et du css s'il est commencé.
- Tom :
  - Correction de la maquette
    - Estimation : terminé le samedi 14 octobre
  - Ébauche du site statique (HTML et CSS)
    - Estimation : terminé le dimanche 15 octobre
    - Remarque : la réalisation du site statique se fera durant toute la semaine. Il est indispensable de respecter les critères de test du dossier de test.
- Assia :
  - Fin de la rédaction du choix du logo
    - Estimation : terminé le dimanche 15 octobre
- Enzo :
  - Création des cas d'utilisation pour le site statique, dans le cahier des charges
    - terminé le dimanche 15 octobre (*màj le 14/10/2023*) 
- Matthieu (chef de projet) :
  - Découpage des tâches du planning pour pouvoir les répartir entre les membres
    - Travail à terminer samedi, dès que possible
  - Préparation de la branche "site_statique" pour l'accueil de la création du site statique et de son dossier de test
    - Travail rapide à effectuer dès que la maquette est terminée.
  - Préparation du dossier de test pour le site statique
    - Travail rapide à terminer samedi
  - Plan de travail
    - Estimation : terminé le dimanche 15 octobre

#### Légende
Les tâches marquées par un 🔷 dans ce bilan signifie qu'elles n'ont pas encore été attribués.<br>
Exception faite pour la gestion des risques qui correspond à un travail propre au binôme (Tom, Florent) et trinôme (Matthieu, Enzo, Assia).
