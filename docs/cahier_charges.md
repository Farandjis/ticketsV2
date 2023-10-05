Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3  Cahier des charges

<br><br>
Ce document fait office de cahier des charges. Il rassemble toutes les informations importantes que nous devrons respecter pour mener à bien ce projet.

</div>

<br><br><br><br><br><br><br>

## Plan

### I – Objectif et portée
- <b>a) Quels sont la portée et les objectifs généraux ?</b>
- <b>b) Lecture du cahier des charges </b>
- <u>ib. Liste des objets, acteurs et actions </u>
- <u>iib. Les différents niveaux </u>
- <u>iiib. Un schéma descriptif des niveaux </u>
### II – Terminologie employée / Glossaire
### III – Les cas d’utilisation
- <b>a) Les acteurs principaux et leurs objectifs généraux.</b>
- <b>b) Les cas d’utilisation métier (concepts opérationnels).</b>
- <b>c) Les cas d’utilisation système.</b>
### IV – La technologie employée
- <b>a) Quelles sont les exigences technologiques pour ce système ?</b>
- <b>b) Avec quels systèmes ce système s’interfacera-t-il et avec quelles exigences ?</b>
### V – Autres exigences
- <b>a) Processus de développement</b>
  - <u>i. Qui sont les participants au projet ?</u>
  - <u>ii. Quelles valeurs devront être privilégiées ? (exemple : simplicité, disponibilité, rapi-
dité, souplesse etc... )</u>
  - <u>iii. Quels retours ou quelle visibilité sur le projet les utilisateurs et commanditaires
souhaitent-ils ?</u>
  - <u>iv. Que peut-on acheter ? Que doit-on construire ? Qui sont nos concurrents ?</u>
  - <u>v. Quels sont les autres exigences du processus ? (exemple : tests, installation, etc...)</u>
  - <u>vi. À quelle dépendance le projet est-il soumis ?</u>
- <b>b) Règles métier</b>
- <b>c) Performances</b>
- <b>d) Opérations, sécurité, documentation</b>
- <b>e) Utilisation et utilisabilité</b>
- <b>f) Maintenance et portabilité</b>
- <b>g) Questions non résolues ou reportées à plus tard</b>
### VI – Recours humain, questions juridiques, politiques, organisationnelles.
- <b>a) Quel est le recours humain au fonctionnement du système ?</b>
- <b>b) Quelles sont les exigences juridiques et politiques ?</b>
- <b>c) Quelles sont les conséquences humaines de la réalisation du système ?</b>
- <b>d) Quels sont les besoins en formation ?</b>
- <b>e) Quelles sont les hypothèses et les dépendances affectant l’environnement humain ?</b>




<br><br><br><br><br><br><br>

------------------------------------------------------------------------------------------------------------------------
### I – Objectif et portée
- <b>a) Quels sont la portée et les objectifs généraux ?</b><br>
  Le projet consiste à réaliser une application web permettant de récupérer les demandes de dépannage des utilisateurs dans les salles machines. En fonction des utilisateurs, l’application permet de voir les demandes, d’en créer ou de les gérer. Les demandes peuvent être classé en fonction de l’urgence qu’elle représente et seront archivés dans un journal.


- b) La lecture du cahier des charges

| Objets                                | Acteurs                                     | Actions                                                                                                                                                                                                                                                    |
|---------------------------------------|---------------------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Une application web (la plateforme)   | Client                                      | - Recueillir les demandes de dépannages <br/> - Accueillera quatre types d'utilisateurs                                                                                                                                                                    |
| Le ticket (les demandes de dépannage) | Des utilisateurs (étudiants et professeurs) | - Afficher les différentes demandes (tickets) et leurs statuts <br/> - Ouvrir un ticket <br/> - Accéder à son tableau de bord et à son profil utilisateur                                                                                                  |
| Un formulaire d'inscription           | Un visiteur                                 | - Remplir un formulaire pour devenir utilisateur <br/> - Accéder à la page d'accueil <br/> - Visualiser les 10 dernières demandes                                                                                                                          |
| La base de données                    | Un administrateur web                       | - Se connecter <br/> - Gérer la liste des libellés affectés aux différents problèmes <br/> - Définir les statuts des tickets et leurs niveaux d'urgence <br/> - Créer les comptes des techniciens et peut leur affecter des tickets <br/> - Se déconnecter |
| Le statut des tickets                 | Des techniciens                             | - Se connecter <br/> - S'attribuer un ticket <br/> - Changer le statut d'un ticket <br/> - Se déconnecter                                                                                                                                                  |
| Les journaux d'activité               | Un administrateur système                   | - Accéder aux journaux d'activité <br/> - Stocker des données de connexion infructueuse                                                                                                                                                                    |
| La page d'accueil                     |                                             | - Explique le but de la plateforme avec une vidéo de démonstration la présentant                                                                                                                                                                           |
| Un historique                         |                                             | - Stocker les tickets fermés                                                                                                                                                                                                                               |
| Un tableau de bord                    |                                             |                                                                                                                                                                                                                                                            |
| La liste des libellés                 |                                             |                                                                                                                                                                                                                                                            |
| Les niveaux d'urgence des tickets     |                                             |                                                                                                                                                                                                                                                            |
| Le système                            |                                             |                                                                                                                                                                                                                                                            |
| Un profil utilisateur                 |                                             |                                                                                                                                                                                                                                                            |




<br><br><br><br><br><br><br>
------------------------------------------------------------------------------------------------------------------------
### II – Terminologie employée / Glossaire

| Mots                  | Définition                                                                                                                                                                                               |
|:----------------------|:---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Ticket                | Enregistre une tâche effectuée (ou qui doit être effectuée) par le système de support informatique afin de rectifier les problèmes, résoudre les demandes des clients.                                   |
| Support informatique  | L'assistance technique qui réalise la gestion des demandes d'assistance, le dépannage des problèmes techniques, la résolution des questions liées à l'informatique.                                      |
| Scenario ?            |                                                                                                                                                                                                          |
| Tableau de bord       | Une interface en ligne qui affiche des informations récapitulatives et des données clés pour aider les utilisateurs à surveiller et à gérer les opérations liées aux tickets et au support informatique. |
| Demande de dépannage  | Une requête soumise par un utilisateur pour signaler un problème ou une difficulté technique qui nécessite une intervention ou une résolution (Ticket) par l'équipe de support informatique.             |
| Libellés              | Des étiquettes ou des mots-clés attribués à un ticket informatique pour catégoriser, organiser et faciliter la recherche des problèmes similaires ou des demandes de support.                            |
| Connexion infructeuse | L'échec d'une tentative de connexion à un système ou à un compte utilisateur en raison d'informations incorrectes ou d'un problème technique.                                                            |
| RPi4                  | Raspberry Pi 4 un ordinateur monocarte de petite taille développé par la Fondation Raspberry Pi                                                                                                          |
| SGBD                  | Système de Gestion de Base de Données                                                                                                                                                                    |


<br><br><br><br><br><br><br>
------------------------------------------------------------------------------------------------------------------------
### III – Les cas d’utilisation

- <b>a) Les acteurs principaux et leurs objectifs généraux.</b><br>
  <br>

  - <u>Le visiteur (un ou plusieurs) :</u><br>
    > - S'inscrit
    > - Accède à la page d’accueil
    > - Consulte les 10 dernières demandes de dépannage
  
  <br>
  Pour différencier un utilisateur d’un visiteur. Les visiteurs doivent s’inscrire, remplir un formulaire pour devenir utilisateur.<br>
  <br>

  - <u>L’utilisateur (un ou plusieurs) :</u><br>
    > - Se connecte, se déconnecte
    > - Ouvre un ticket
    > - Accède à son tableau de bord
    > - Accède à son profil
    > - Change son mot de passe
  
  <br>

  - <u>Les techniciens (deux) :</u><br>
    > - Est un utilisateur, mais avec plus de droit
    > - S'attribue ou affecte un ticket à un technicien
    > - Change l'état d'un ticket

  <br>

  - <u>L’administrateur web (un seul) :</u><br>

    > - Est un technicien, mais avec en plus des droits d'administration
    > - Affecte/Retire des libellés aux tickets
    > - Définis le statut des tickets
    > - Définis le niveau d'urgence d'un ticket
    > - Créer des comptes techniciens
    > - Résout les problèmes liés à l'authentification de l'utilisateur

  <br>

  - <u>L’administrateur système (un seul) :</u><br>
    > - Est un technicien, mais avec en plus des droits d'administration
    > - Accède et utilise les journaux d'activités

- <b>b) Les cas d’utilisation métier (concepts opérationnels).</b>
- <b>c) Les cas d’utilisation système.</b>

<br><br><br><br><br><br><br>
------------------------------------------------------------------------------------------------------------------------

### IV – La technologie employée
- <b>a) Quelles sont les exigences technologiques pour ce système ?</b>

  L'application devra utiliser : SQL, HTML, CSS et PHP<br>
  - SQL est le langage utilisé pour l'utilisation d'un SGBD comme MySQL<br>
  - HTML et CSS permettent la création des pages web du site internet.<br>
  - PHP permet de son côté de personnaliser les pages en fonction de l'utilisateur et des données de l'application.<br>

  <br>
  MySQL est le Système de Gestion de Base de Données (SGBD) proposé par le client.<br>
  <br>
  Nous utiliserons les logiciels PHPStorm, WebStorm de Jetbrains.<br>
  Ces outils ne sont pas contraints mais nous permettrons d’améliorer la qualité du code rendu.<br>
<br>

- <b>b) Avec quels systèmes ce système s’interfacera-t-il et avec quelles exigences ?</b>

  Afin de garantir le bon fonctionnement de l’application web finale, il faudra s’assurer que le serveur web soit prêt à l’utilisation sur une carte SD.<br>
  De plus, il sera nécessaire d’assurer le bon fonctionnement du site web sur les postes présents dans les salles machines de l’IUT de Vélizy.<br>
  La carte SD se devra de contenir un serveur web (Apache est conseillé) ainsi qu’un serveur SGBD.<br>
  Aussi, le serveur contenant l’application web sera porté sur Raspberry Pi 4 et sera accessible par connexion SSH.<br>

<br><br><br><br><br><br><br>
------------------------------------------------------------------------------------------------------------------------

### V – Autres exigences
- <b>a) Processus de développement</b>
  - <u>i. Qui sont les participants au projet ?</u><br>
  - <u>ii. Quelles valeurs devront être privilégiées ? (exemple : simplicité, disponibilité, rapi-
    dité, souplesse etc... )</u><br>
  - <u>iii. Quels retours ou quelle visibilité sur le projet les utilisateurs et commanditaires
    souhaitent-ils ?</u><br>
  - <u>iv. Que peut-on acheter ? Que doit-on construire ? Qui sont nos concurrents ?</u><br>
  - <u>v. Quels sont les autres exigences du processus ? (exemple : tests, installation, etc...)</u><br>
  - <u>vi. À quelle dépendance le projet est-il soumis ?</u><br>
- <b>b) Règles métier</b><br>
- <b>c) Performances</b><br>
- <b>d) Opérations, sécurité, documentation</b><br>
  Parler de l'injection SQL ?<br>
  <br>

- <b>e) Utilisation et utilisabilité</b><br>
  Nous veillerons à rendre l’application accessible en se basant sur la norme UAAG 2.1 de W3C.<br>
  Nous utiliserons l'extension de navigateur internet "Wave" pour s'en assurer.<br>
  <br>
  Wave est une extension notamment disponible sur Google Chrome, Mozilla Firefox et Microsoft Edge.<br>
  <br>
- <b>f) Maintenance et portabilité</b><br>
  parler du validateur W3C HTML et CSS ?<br>
  <br>

- <b>g) Questions non résolues ou reportées à plus tard</b><br>

<br><br><br><br><br><br><br>
------------------------------------------------------------------------------------------------------------------------

### VI – Recours humain, questions juridiques, politiques, organisationnelles.
- <b>a) Quel est le recours humain au fonctionnement du système ?</b><br>
  Le système fonctionnera en toute autonomie sur un serveur pour pouvoir être utilisés par les différents utilisateurs.<br>
  <br>
  Si le système peut inscrire de lui-même un visiteur, ce n'est pas le cas pour les techniciens.<br>
  En effet, quand bien même il passe par la plateforme, l'administrateur web doit les inscrire de lui-même.<br>
  Il en va de même pour la réinitialisation de mot de passe en cas d'oubli.<br>
  <br>
  L'application propose différentes actions pour les utilisateurs, qu'ils doivent actionner d'eux même. L'application ne fait que de les mettre en application.<br>
  <br>
- <b>b) Quelles sont les exigences juridiques et politiques ?</b><br>
  L'application se doit de respecter la loi française « Informatique et liberté » du 6 janvier 1978, mise à jour le 1er juin 2019, relative à l'informatique, aux fichiers et aux libertés.<br>
  L'application est également soumise au règlement européen « Règlement Général sur la Protection des Données » (RGPD) du 27 avril 2016, relatif à la protection des personnes physiques à l'égard du traitement des données à caractère personnel et à la libre circulation de ces données, et abrogeant la directive 95/46/CE.<br>
  <br>
  A noter, la CNIL propose des recommandations vis à vis de la lois, notamment en matière de cookies.<br>
  <br>
  Les articles peuvent être consultés via les liens ci-dessous :
  - <u>Loi « Informatique et liberté » :</u><br>
    https://www.cnil.fr/fr/la-loi-informatique-et-libertes <br>
  - <u>Règlement européen « Règlement Général sur la Protection des Données » :</u><br>
  https://www.cnil.fr/fr/reglement-europeen-protection-donnees <br>
  - <u>A propos des cookies :</u><br>
  https://www.cnil.fr/fr/cookies-et-autres-traceurs/regles/cookies <br>
    <br>

- <b>c) Quelles sont les conséquences humaines de la réalisation du système ?</b><br>
  La conséquence est l'amélioration de la gestion des dépannages dans les salles machines.<br>
  Les demandes seront prises en charge plus rapidement, et elles seront mieux répartie pour une résolution rapide et optimale.<br>
  D'autant plus que l'application offre des données utilisables dans le cas d'étude statistique.<br>
  Ce qui permettrait donc d'organiser des révisions du matériel, ou prévoir le renouvellement du parc informatique.<br>
  <br>
  En cela, les techniciens seront mieux sollicité et leurs plannings moins chargés.<br>
  Concernant les utilisateurs étudiants et professeurs, ils pourront travailler dans de meilleures conditions avec du matériel fonctionnel.<br>
  <br>
  Grâce à l'application, il y aura un gain de productivité chez les techniciens, les professeurs et étudiants.<br>

  <br>
- <b>d) Quels sont les besoins en formation ?</b><br>
  Utiliser un ordinateur ?<br>
  <br>

- <b>e) Quelles sont les hypothèses et les dépendances affectant l’environnement humain ?</b><br>
  ???
