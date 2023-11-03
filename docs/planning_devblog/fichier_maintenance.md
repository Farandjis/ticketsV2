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

---
## Jeudi 02/11/2023 - Bilan du travail du 27/10/2023 au 02/11/2023
Nous avons assez bien avancé cette semaine.<br>
En dehors des serveurs à réinstaller proprement, le rapport d'installation, la base de données et les tests sur celle-ci à terminer,
on pourrait même dès à présent le développement PHP. Cependant, nous préférons attendre encore un peu, notamment vis à vis de la progression des cas d'utilisations.<br>
Attention ! La conception du site dynamique n'a pas encore été effectué. Nous allons devoir créer le site à partir des cas d'utilisations et sans la conception.<br>

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

#### Travail effecté du dimanche 27/10/2023 au jeudi 02/11/2023
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

#### Travail effecté du dimanche 22/10/2023 au jeudi 26/10/2023
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

#### Travail effecté du jeudi 12/10/2023 au samedi 21/10/2023

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

#### Répartion des tâches jusqu'à ce jour
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
