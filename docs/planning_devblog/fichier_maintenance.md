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

## Dimanche 07/01/2024 - Bilan du travail du 01/01/2024 au 07/01/2024, J-3 fin de TIX

Par rapport à ma programmation imaginée avant les vacances, nous avons 1 semaine de retard. Cependant, notre situation est encourageante pour la suite.<br>
Nous sommes sur le point d'avoir toutes les pages fonctionnelles, il manque plus qu'administration.<br>
Après ça, il manquera plus qu'intégrer nos travaux de cryptographies et de proba-stats, la correction des bugs (fonctionnel, HTML/CSS/JavaScript, Accessibilité),
ainsi que la vidéo. Malheureusement, à cause de la poursuite tardive du dossier de test, l'équipe ne connait pas l'intégralité des bugs de la plateforme.<br>
<br>
Si le planning ci-dessous est respecté, nous aurons rattrapé en grande partie le retard. Sauf pour la vidéo (causé par la fin tardive du site).<br>
Cela signifie que je ne pourrais pas être très impliqué dans la création de la présentation. Je veillerais à son contenu toutefois.<br>
Ce document sera mis à jour durant la journée (pour les "Je ne suis pas allé voir").<br>
<br>

#### Etat des lieux
- **Pages web**
  - Accueil OK
  - Tableau de bord OK
  - Administration (le 07/01/2023 : bugs toujours présent)
    - **Fonctionnalités manquantes intégrés en HTML/CSS, manque plus que leur implémentation (note : mot-clé et non pas libellé !).**
    - Pas possible d'enlever un technicien
    - On peut créer un ticket " "
    - **MANQUE TRY DANS PHP**
    - Manque vérif JS
    - Les admins apparaissent dans la liste des techniciens à ajouter/enlever
    - Manque suppr mot clé
    - Manque crétion/suppr titre
    - Journal d'activité ne fonctionne pas
    - "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" par ex comme description d'un ticket casse l'affichage
    - Manque pop-up pour le tableau
    - Tableau avec des dates non formatées
  - Création Ticket (le 07/01/2023 : bugs toujours présent)
    - Manque une vérif JS pour la taille (min et max) de la description
    - Manque une vérif PHP pour liste des Urgences : On peut bidouiller afin de mettre "Non complété !" comme urgence estimée
  - Modification Ticket (le 07/01/2023 : bugs toujours présent)
    - Modifier si possible la taille des cases
    - Manque les tests de vérifications du formulaire côté JS (genre min max description)
    - Note : je n'ai pas testé si on peut bidouiller genre pour la liste d'Urgence
    - **MANQUE TRY DANS PHP**
  - Connexion / changement mdp, email: quasi OK
    - "un spécial" ??? -> "un caractère spécial" ! Info bulle pour le mdp
  - Désinscription
    - Ne supprime pas le compte
    - Mauvaise redirection
  - Profil
    - Le bouton désinscription est rouge
  - Liste mot clé
    - '" -> `&#039;&quot;` comme rendu
- **Conception**
  - Je ne suis pas allé voir
- **Base de donnée**
  - Probablement des modifs à faire côté historique
- **Cahier des charges**
  - Je ne suis pas allé voir
- **Test**
  - Je ne suis pas allé voir

#### Répartition des tâches
- A terminer en ce dimanche 7 janvier :
  - CDC Assia : Cas d'utilisation
    - Repasse-moi l'emplacement de ton document brouiller, s'il te plaît.
  - PHP Assia/Tom : Bugs que je reporte si-dessus
  - PHP Enzo : Les tests
  - BD Enzo : Les tests
    - Mise à jour suite aux corrections pour les tables
    - Ajouter l'email dont je parlais pour les caractères spéciaux. Cet email comporte l'intégralité des caractères acceptés.
    - Donner une explication de ce qui cloche à chaque fois. Ca serait plus simple qu'un jeu des 7 différences (pardon)
    - VALUES ('Salut'); pour les deux tables -> res attendu OK, c'est normal
    - Qu'en est-il des tables RelationBiduleMachin ?
    - Il faudrait vérifier le contenu des vues. Par exemple, que tableau de bord et les pages pour l'update correspondent bien à ce qui est prévu.<br>
      Qu'un technicien ne peut pas modifier le ticket de son collègue parce qu'ils sont techniciens, par exemple.
  - PHP etc Florent : Conception
  - PHP Florent : Fin de l'implémentation de la page Adm (hors pop up) possible ?
- Lundi 8 janvier :
  - PHP Matthieu : Intégration pop up page adm
  - PHP Enzo : Début de la revérification entière de la SAÉ (côté test)
  - PHP Matthieu/Florent/Tom : Suite des travaux de proba-stat/crypto
  - BD Matthieu : Conception pour la BD des jetons
  - PHP Assia ? : faire en sorte que les cases cochées/sélectionnés apparaissent en haut des listes des menuDeroulant
- Mardi 9 janvier :
  - PHP Enzo : Fin de la verification entière de la SAÉ (côté test)
  - BD Enzo/Matthieu : Début et fin tests et correction BD jeton
  - PHP Assia : Correction des bugs/défaut découverts
  - Matthieu/Florent/Tom : Suite des travaux de proba-stat/crypto/vidéo
  - Rendez-vous vocal Discord pour faire une mise au point de la situation ?
- Mercredi 10 janvier :
  - Florent/Matthieu : Fin travail de crypto
  - Tom : Fin travail de proba-stat si possible
  - PHP Florent/Matthieu : Intégration du travail de crypto
  - PHP Tom/Matthieu : Intégration du travail de proba-stat si possible
  - PHP Enzo : Test suite à l'intégration du travail
  - Matthieu : Suite de la vidéo
- À partir du jeudi 11 janvier :
  - Préparation de la présentation face au jury
  - Matthieu : Fin de la vidéo


#### Travail effectué
- **Florent**<br>
  - Suite d'Administration, recréation du code perdu
  - Conception action_modificationTicket, suite des conceptions pour administration (et une autre je crois)

- **Tom**<br>
  - Correction des problèmes de HTML/CSS
  - Ajout HTML/CSS des fonctionnalités manquante pour la page Administration (côté admin web)
  - Début sujet proba-stat

- **Enzo** :<br>
  - Suite des tests de la BD
  - Début tests rendu code HTML généré par PHP
  - Début tests Accessibilité

- **Assia**<br>
  - Correction problèmes d'affichage des mots-clés + vérification des titres côté php (uniquement ceux présents da la liste de la BD sont autorisés)
  - PHP : Fermeture d'un ticket
  - PHP : Captcha

- **Matthieu (chef de projet)**<br>
  - fin tableau de bord (principalement pop-up, bugs)
  - Fusion des fonctions menuDeroulant
  - Finalisation de la fonctionnalité de fermeture d'un ticket (aide pour Assia)
  - Finalisation BD TIX (tables, vues, triggers...) et de sa conception
  - Correction des bugs causés par la page modif (incompatibilité version 2 de la BD)
  - Nouveauté pour la page accueil : Bilan de la situation de l'utilisateur de la plateforme (simple utilisateur, tech, adm web et sys)
  - Finalisation du captcha (aide pour Assia)
  - Début sujet crypto
  - Suite de la vidéo (j'en suis à 3-5 secondes par jour, pour une vidéo de plus d'1min actuellement) 

<br><br><br>

---

## Lundi 01/01/2024 - Bilan du travail du 26/12/2023 au 31/12/2023, J-9 fin de TIX

Bonne année !<br>
Malheureusement, à 9 jours du 10 janvier, nous sommes très loin de pouvoir se dire "good job".<br>
<br>
Nous avons accumulé un retard trop important au cours de cette semaine. Il va être très compliqué de tenir les délais dans ces conditions.<br>
Cependant, **nous devons les tenirs**. Les enjeux de cette SAÉ sont beaucoup trop important pour qu'on puisse prendre la situation à la légère.<br>
Mais si chacun donne du sien et qu'on trouve la bonne organisation, nous pouvons réussir.<br>
Nous avons des pages non terminées dont certaines pouvant demander un certain temps.<br>
En parallèle, pour la semaine du 1er janvier, nous devons absolument commencer le sujet de cryptographie et celui de proba-stat. Nous devons vérifier l'intégralité du site, corriger les imperfections,
vérifier l'accessibilité, faire la vidéo, et d'autres choses. Sachant qu'à la rentrée... Nous avons les contrôles, et que nous sommes en période de recherche de stage.<br>
A son retour, Tom devra ce charger des problèmes liés au CSS...
<br>
<br>
En ce matin du nouvel an, voici le bilan de l'état du travail (note : il n'est pas exhaustif...):<br>

#### Etat des lieux
- **Pages web**
  - Accueil OK (sauf icône travail de droit à changer)
  - Tableau de bord
    - Problème de CSS POP-UP (bouton refermer le pop up manquant)
    - Plantage de la page lors de la sélection d'un type de ticket et d'un mot clé
    - Problème taille bouton de la liste type ticket
  - Administration
    - Impossible d'attribuer/retirer le rôle technicien
    - Impossible de supprimer un mot-clé (BD concerné aussi)
    - Impossible de créer et de supprimé un titre
    - Problème JavaScript historique
    - Manque les tests donc...
  - Création Ticket
    - Système de choix de titre demandé par M. Hoguin non développé, il y a toujours l'ancien
    - Je soupçonne sûrement à tort que les données ne sont pas vraiment vérifiées (genre taille des entrées) côté PHP...
    - Manque la revérification par tests donc...
  - Modification Ticket
    - Système de choix de titre demandé par M. Hoguin non développé, il y a toujours l'ancien
    - Comme une petite odeur de roussi puisqu'il est très probable qu'il y a des bugs causés par des morceaux de codes obsolètes.
    - Manque les tests de vérifications du formulaire côté JS
    - Je soupçonne sûrement à tort que les données ne sont pas vraiment vérifiées (genre taille des entrées) côté PHP...
    - Manque la revérification par tests donc...
  - Connexion / changement mdp, email:
    - Pb bouton oeil mdp
  - Inscription
    - Captcha non fonctionnel... Mais est ce qu'on aura le temps de s'en occuper en cette nouvelle semaine ?
  - Profil
    - Le pop-up d'info ticket n'apparaît pas...
    - A noter mais il pourrait être pas mal de cacher les sections "mot de passe" et "email" pour les admnistrateurs vu qu'ils n'y ont pas accès...
- **Conception**
  - Je ne suis pas allé voir, mais il y a sûrement...
  - Des retouches à faire
  - Des diagrammes UML à faire sûrement aussi
- **Base de donnée**
  - La conception n'est pas terminé
  - Les tests pour la V2 de la BD viennent tout juste d'être commencé, il manque les fonctions, la vérification que le contenu des vues est bien conforme etc etc
  - Dans les bugs à corriger, mettre ".." dans une adresse email fonctinne (JS compris)
- **Cahier des charges**
  - Je ne suis pas allé voir
- **Test**
  - Manque tests BD (excepté les vues, tables à corriger)
  - Manque tests accessibilité
  - Manque tests rendu HTML des pages générés par PHP (valisateur HTML/CSS)


Voici ce qui était prévu et qui est toujours prévu de ce 1er au 10 janvier :
#### Tâches à terminer pour le 10 janvier.
  - La vidéo
    - -> Pour cela le site doit visuellement être entièrement terminé
  - Le sujet de cryptographie
    - Implique le chiffrement des mots de passes (et l'élaboration d'un jeton pour la session de l'utilisateur, si on veut faire les choses bien n'est ce pas)
  - Le sujet proba-stat
    - Apparemment, l'installation de Shiny sur le RPi4 est compliqué.
  - Le captcha
  - Une vérification ENTIÈRE de la SAÉ
    - Un test de l'intégralité de la plateforme (BD, site dynamique (côté fonctionnel, rendu HTML, accessibilité), CSS et JavaScript) (2 au moins, 1 avant et 1 après les corrections)
    - La correction des bugs qui vont être trouvé
    - Vérification de l'intégralité de la conception
    - Vérification de l'intégralité du cahier des charges
    - Vérification de l'intégralité du code (rajout de commentaire, amélioration du code ?)

Dans mes prévisions, pour le 31 décembre, nous devions avoir une préversion finale avant test globale du site.<br>
Ca aurait été une version exploitable et pouvant même être présenté au jury dans l'état (excepté le captcha, et des petits problèmes mineurs à corriger).<br>
Cette seconde partie nous permettrait, en plus d'ajouter les fonctionnalités et travaux manquants, de nous assurer de la qualité de notre travail ainsi qu'une connaissance entière de l'état de celui-ci.<br>
<br>
<br>
Il y a donc du travail...

#### Avancé

- **Ce qui sera à terminer cette semaine :**<br>
  - Ce que j'ai décris plus haut

#### Travail effectué
- **Florent**<br>
  - (rappel) Indisponibilité du 23/24 au 25, je ne sais plus exactement
  - Développement de la page administration et implémentation de ses fonctionnalités (journal d'activité...)
  
- **Tom**<br>
  - (rappel) Vacances

- **Enzo** :<br>
  - (rappel) Indisponibilité du 24 au 26, du 31 décembre au 2 janvier.
  - Test des droits sur les vues

- **Assia**<br>
  - (rappel) Indisponibilité 1 ou 2 jours dans la semaine
  - Correction problèmes CSS pages création et modification ticket
  - Désormais le bouton désinscription ne s'affiche plus pour les admins
  - Importation du travail de droit sur le site
  - **Note : il manque des tâches effectuées par Assia.**
  
- **Matthieu (chef de projet)**<br>
  - (rappel) Indisponibilité 1 ou 2 jours dans la semaine
  - Implémentation des nouvelles fonctionnalités du tableau de bord, correction du problème de css du formulaire de recherche
    - Choix du type de ticket à afficher
    - Informations supplémentaires dans le pop up
  - Création de script de test pour les tickets
  - Début de la vidéo de présentation (juste l'animation du logo au début)
  - Début de la conception (et revu des documents déjà présent) pour la base de données
  - Création d'une BD pour la gestion des jetons de session, et mise en place de la suppression auto des comptes inactifs

#### Organisation
La création de la vidéo doit se faire dès que possible. Nous allons donc nous fonder en partie dessus.<br>
L'objectif est de terminer la SAÉ le 10, afin qu'on puisse réviser et préparer calmement notre présentation face au jury.



Dans l'ordre des priorités, même si cela peut paraître quelque peu dangereux :<br>
1. Finition/Correction des pages création/modification ticket, tableau de bord et d'administration
   - Pour le 02/01/2024 midi dernier délai
2. Commencer le sujet de cryptographie, de proba-stat, terminer la conception (tout, BD compris), corriger la page de profil, CSS
   - Page profil : Pour le mardi 02/01/2023 soir dernier délai
   - CSS : Cela dépend du retour de Tom. Sinon, nous serons obligés de nous consacrer du temps dessus en urgence.
   - Conception BD (Matthieu) : le mercredi 03/01/2024 midi sûrement possible
   - Conception (Florent) : le vendredi 05/01 midi dernier délai
   - Cryptographie : mercredi 10/01 soir prêt pour impression.
3. La vidéo, Le captcha
   - Les deux seront fait en parallèle d'une partie du 2.
   - Vidéo : je ne peux pas m'avancer dessus.
   - Captcha : Pour samedi 06/01 dernier délai
4. Vérification global
   - On vérifie l'ensemble de nos travaux dimanche 7 janvier (on fait le bilan des problèmes à résoudre, ce qui est d'important et qui manque)
5. Correction et finalisation de nos travaux
   - Mercredi 10 janvier 14h dernier délai
6. Tests définitifs
   - Mercredi 10 janvier à partir de 14h, tout problème doit être reporté et résolut dans l'après midi pour pouvoir être retesté.


<br><br><br>

---

## Mardi 26/12/2023 - Bilan du travail du 18/11/2023 au 25/12/2023, J-15 fin de TIX

Mercredi 20 décembre, Monsieur HOGUIN a pu découvrir un peu plus notre plateforme avec la page de création de ticket.<br>
Vendredi, il nous a pu faire un retour sur notre travail :
  - Pour la page d'inscription et semblables, il nous recommande vivement d'utiliser les titles HTML plutôt que le bouton d'information que nous avions mis en place.
  - Pour les tickets, il nous recommande vivement d'imposer à l'utilisateur une sélection de titre "libellé" pré-préparé par l'administrateur WEB.

Pour les titres, jusqu'à présent l'utilisateur était libre de donner un titre au problème dont il reporte.<br>
Il avait la possibilité d'associer un ou plusieurs libellés pour faciliter la tâche des techniciens et de l'administrateur web.<br>
Cet échange souligne 2 problèmes :
  - Une transformation de notre système de ticket à faire, qui par chance, ne devrait pas être complexe à mettre en place.
  - Une confusion sur la définition de ce qu'est un libellé (pour M. HOGUIN : un titre, pour nous : plutôt des mots-clés).

Par conséquent, cela implique une revue de la base de données (qui s'imposait déjà dans tous les cas) mais également des différentes pages.<br>
Cela implique aussi un changement de nom : libellé devient mot-clé, titre sera l'unique nom désignant le nom d'un problème (il n'y aura plus "objet ticket", "nature du problème" etc).


Une autre difficulté concernant l'organisation en cette fin de semaine et celle de la semaine prochaine : les vacances et fêtes de fin d'année.<br>
Tom ne sera pas disponible durant la première semaine, Florent durant le premier Week-end et Enzo de samedi à mardi inclut pour des raisons non communiquées.<br>
De même de mon côté, je ne serais pas disponible certains jours des vacances.<br>
<br>
<br>
Nous sommes à 15 jours de la fin de TIX si nous voulons avoir assez de temps de faire les dernières vérifications et préparer notre présentation.<br>
Nous avons une plateforme non terminée comme convenu, ce qui provoque un retard important sur la création de la vidéo et les tests finaux.<br>
<br>
<br>
**ATTENTION : LA BASE DE DONNEES A ÉTÉ RADICALEMENT CHANGÉE, ELLE N'EST PLUS COMPATIBLE AVEC LA V2.2 DU SITE.**


#### Avancé

- **Ce qui sera à terminer cette semaine :**<br>
  - PHP Florent : Page administration : développement, test
  - PHP Florent : Journal d'activité : développement, test
  - PHP Florent : Finition de la fonction libellée de Florent : Conception, développement, test
  - PHP Tom : Vérification JavaScript des entrées pour les pages : modification mot de passe et email, création ticket
  - PHP Tom : Modification Ticket Manque un bouton "fermer le ticket"
  - PHP : Manque la possibilité de supprimer son compte : développement, test (SQL ok via sa fonction - Matthieu)
  - PHP Enzo : Test de modification et création Ticket v2
  - PHP Enzo : Test d'Administration
  - PHP Enzo : Test fonction libellé de Florent
  - PHP Enzo : Test intégrale de la BD (vues, tables, fonctions, triggers, procédures)
  - PHP Assia : Rendre accessible une version WEB de notre travail de droit -> Ah intégrer sur le dépôt !
  - PHP Assia : Peut être revoir les CU pour la v2 et faire CU page Administration
  - BD Matthieu : Suppr auto du compte
  - BD Matthieu : BD pour la gestion des jetons
  - PHP Matthieu : Intégration bouton recherche "Mes Tickets, Mes tickets bidules" sur tableau de bord
  - PHP Matthieu : Intégration info supplémentaire dans pop up


Assia est en charge d'intégrer les modifications HTML sur les pages PHP et l'intégration du nouveau système de titre.<br>
Enzo s'occupe que des tests pour le moment.<br>
Florent s'occupe en priorité d'Administration, mais peut travailler (demander de l'aide, aider) avec Assia.<br>
Tom n'est pas encore disponible en ce mercredi 27 dec.<br>
Je m'occupe de la DB, tdb et de la vidéo de mon côté.<br>


Remarque : les tests doivent être effectués par Enzo, la conception par Florent

- **A continuer :**
  - La vidéo de présentation ne peut être continuer du moment que le site n'est pas terminée visuellement.

- **Ajout que je propose :**
  - PHP Tom : Administration : Possibilité de supprimer les mots-clés, titres ?



#### Travail effectué
- **Florent**<br>
  - PHP : Administration - Développement en cours
  - PHP : modifTicket - Développement v1

- **Tom**<br>
  -  JS : Administration Statique - Bouton de confirmation d'ajout de technicien
  - CSS : Tableau de Bord Statique - Style pour bouton attribution
  - CSS : Inscrption etc Statique - Info bulle (comme demandé par M Hoguin)

- **Enzo** :<br>
  - PHP : ModifTicket - Test v1
  - PHP : CreerTicket - Test v1
  - PHP : Connexion - Résolution pb horodatage dernière connexion
  - PHP : ModifTicket - Résolution pb : Impossible de mettre un autre technicien pour un ticket

- **Assia**<br>
  - PHP : Cas d'utilisation pour : consulter ses demandes, créer ticket, rechercher des tickets, 

- **Matthieu (chef de projet)**<br>
  - PHP : Page modifTicket - Correction d'un problème d'affichage
  - SQL : Correction BD avant la V2
  - GIT : Fusion des branches pour la V2.2
  - SQL : Revue intégrale de la BD : trie des vues, Utilisateurs Fictif, tables... (notamment suite à la demande de M Hoguin)
  - SQL : Création des dernières fonctions, procédures et triggers (note : manque suppr auto comptes utilisateurs)


<br><br><br>

---

## Mercredi 20/12/2023 - Bilan du travail du 11/11/2023 au 17/12/2023, J-21 fin de TIX

Comme promis, nous avons rendu une version présentable pour Monsieur HOGUIN.<br>
Malheureusement, cette version ne comporte pas la page Administration et les fonctionnalités du journal d'activité.<br>
Cela était dû au temps que demandaient les pages Tableau de Bord (Matthieu), Modification Ticket (Florent), les corrections HTML/CSS/JS (Tom) et la page création ticket (Assia/Enzo).<br>
Il reste des corrections à faire, vendredi 22 décembre, une version complète et fonctionnelle (hors chiffrage et captcha) sera disponible.

#### Avancé

- **Ce qui sera à terminer la semaine prochaine (objectif : terminer vendredi):**<br>
  - PHP Florent : Page administration : développement, test
  - PHP Florent : Journal d'activité : conception, développement, test
  - PHP Florent : Finition de la fonction libellée de Florent : Conception, développement, test
  - PHP Tom : Vérification JavaScript des entrées pour les pages : modification mot de passe et email, création ticket
  - PHP Tom : Modification Ticket Manque un bouton "fermer le ticket"
  - PHP Tom et Enzo : Manque la possibilité de supprimer son compte
  - PHP Enzo : Correction du tableau de bord : Placer un DISTINCT dans la requête SQL pour la recherche : développement, test
  - PHP Enzo : Correction du problème de fuseau horaire dans connectUser (dernière déconnexion utilisateur) : développement, test
  - PHP Enzo : Test de modification Ticket
  - PHP Enzo : Test d'Administration
  - PHP Enzo : Test fonction libellé de Florent
  - PHP Assia : Modification Ticket : Impossible de changer de technicien (développement, test)
  - PHP Assia : Rendre accessible une version WEB de notre travail de droit
  - Assia : Terminer les CU
  - BD Matthieu : Trie dans la base de données (suppression des lignes SQL inutiles)
  - BD Matthieu : Correction des droits des utilisateurs


Remarque : les tests doivent être effectués par Enzo, la conception par Florent

- **A continuer :**
  - BD : Trigger, automatiser le changement d'état des tickets
  - BD : Trigger, empêcher qu'un technicien puisse attribuer un ticket à un autre technicien
  - BD : Trigger, supprimer des utilisateurs 3 ans après leur dernière connexion
  - BD : Trigger, automatiser les horodatages

- **Ajout que je propose :**
  - PHP Tom : Tableau de bord : Bouton de recherche par Etat Ticket et un Mes tickets (qui inclura mes tickets crées et attribués) ?
  - PHP Tom : Administration : Possibilité de supprimer les libellés ?
  - PHP Tom et Matthieu : Tableau de bord : Afficher davantage d'information dans le POP-UP

- **Ce qu'on commencera dès samedi (semaine suivante, attribution non définitive) :**
  - Florent et Matthieu : Sujet Crypto (-> Implique gestion des jetons... Une nouvelle BD ?)
  - Tom et ? : Sujet Proba-Stat
  - Florent et Matthieu : Captcha
  - Matthieu et ? : Vidéo de présentation
  - Enzo et ? : Conception, tests de la base de données
  - TOUT LE MONDE : 1ère/3 vérification de A à Z de la plateforme : conception, développemet, tests, cahier des charges

- **Ce qu'on commencera dès mercredi 10 janvier, ou plus tôt :**
  - TOUT LE MONDE : Préparation de la présentation de TIX face au Jury

#### Travail effectué
- **Florent**<br>
  - PHP/HTML : Conception creerTicket
  - PHP/HTML : Finition conception Tableau de Bord
  - PHP : Création et finition de modification Ticket
  - PHP : Ajout de la conception de modif email et mdp

- **Tom**<br>
  - HTML/CSS : Mise à jour des pages avec la dernière version du code HTML et CSS
  -  JS : Création et finition d'un code pour un bouton permettant de voir le mot de passe en clair (lorsque l'on le tape)
  -  JS : Création et finition d'un code JavaScript vérifiant les entrées du formulaire d'inscription avant de l'envoyer

- **Enzo** :<br>
  - PHP : Finition de la page profile
  - PHP : Test pour Tableau de Bord
  - PHP : Création et finition de la page création Ticket (avec Assia)
  - PHP : Test pour création Ticket
  -  BD : Ajout des droits sur la BD

- **Assia**<br>
  - PHP : Test pour la fonction deconnexionSite
  - PHP : Test pour affichageMenuHaut
  - PHP : Test pour la page Profile, accueil
  - PHP : Finition test pour la page Modification MDP et email
  - PHP : Création et finition de la page création Ticket (avec Enzo)
  - CDC : Création et finition des Cas d'Utilisation pour : consulter, créé et rechercher des tickets.
  - Droit : Finition du travail de Droit

- **Matthieu (chef de projet)**<br>
  - GIT : Fusion, suppression des branches
  - PHP : Finition d'Accueil
  - PHP : Finition de Tableau de bord (suite du début du travail de Florent)
  - PHP : Finition fonction affichageMenuHaut
  - PHP : Contribution débuggage de modification Ticket (avec Florent)
  -  BD : Correction des droits de la BD
  -  BD : Correction des tables et des vues
  -  BD : Création Fonctions SQL : renvoi Role Utilisateur, 
  -  BD : Finition de menuDeroulantTousLesLibelles
  -  BD : Trigger pour passer de "En attente" à "En cours" lorsque le technicien change (ou remplacer par Null)
  - Droit : Finition du travail de Droit (aide pour Assia)


<br><br><br>

---

## Dimanche 10/12/2023 - Bilan du travail du 03/11/2023 au 10/12/2023

Je maintiens que Dimanche, nous aurons une version présentable pour Monsieur HOGUIN qui pourra nous faire un retour sur notre travail.<br>
Cependant, il n'y aura pas la vidéo de présentation et il est possible qu'il reste certaines retouches à faire.
Mais nous aurions un avis de notre client, et nous pourrons l'ajuster au cours de la semaine.<br>

#### Avancé

- **état des lieux qu'il faut faire pour la semaine prochaine (conception/dev/test) :** <br>
  - tableau de bord, profil, création ticket, modification ticket, administration, droits BD

- **Ce qui sera à terminer la semaine prochaine :**<br>
  - fin de la distribution des droits pour les nouvelles vues de la base de données (juste dev)
  - Réécrire deux vues dans le patch (voir avec Matthieu)
  - tableau de bord, profil (développement, test)
  - création ticket, modification ticket, administration

- **Ce qui a été terminé :**
  - accueil (il faut juste que Tom retouche au HTML)
  - modif mdp et modif email
  - conception pour les nouvelles vues de la BD

#### Travail effectué
- **Florent**<br>
  - HS : Répartition des documents de conception sur les différentes branches
  - PHP : Conception fonction pageAccess
  - PHP : Développement tableau de bord

- **Tom**<br>
  - HTML/JS : Amélioration site statique, début de correction des problèmes reportés par M Hoguin sur le site.

- **Enzo** :<br>
  - PHP :Tests sur les fonctions pageAccess, valideEMAIL, récupérerRoleDe
  - PHP :Changement ordre des fonctions dans le fichier fonctions.php par rapport à la conception

- **Assia**<br>
  - PHP :Fin de développement page modif mdp et modif email
  - PHP :Développement page accueil

- **Matthieu (chef de projet)**<br>
  - PHP : Fin de développement page modif mdp et modif email
  - PHP : Fin développement page accueil
  - PHP : Fin de développement de la fonction pageAccess
  - PHP : Fin de développement de la fonction valideEMAIL
  - PHP : Correction de la gestion du cookie session (on stocke le login par l'ID de l'utilisateur)
  - PHP : Modification du code HTML (.php) connexion/inscription/modif mdp/email + ajout page erreur 403 -> logo redirigeant désormais vais l'accueil et bouton retour fonctionnel.


<br><br><br>

---

## Samedi 02/12/2023 - Bilan du travail du 27/11/2023 au 02/12/2023

Pour des infos sur l'organisation future, voir texte sous Avancé.

#### Avancé

- **état des lieux qu'il faut faire pour la semaine prochaine (conception/dev/test) :** <br>
  - pages Modif mdp, modif email, tableau de bord, profile, accueil

- **Ce qui sera à terminer la semaine prochaine :**<br>
  - pages Modif mdp, modif email (concept, dev, test, cas d'utilisation)
  - profile, accueil (concept, dev, test, cas d'utilisation)
  - nouvelle version BD (juste dev)

- **Ce qui a été avancé :**
  - tableau de bord

- **Ce qui sera à commencer :**
  - création ticket, modif ticket

A noter qu'il faut mettre sur le git la nouvelle version de la maquette,<br>
Qu'il faut retetester le site statique, tester l'affichage html du site dynamique,
Faire la conception BD pour les vues, utilisateurs MariaDB + revoir le fichier Markdown,
Refaire des tests pour la BD

Le 17 décembre les fonctionnalités et l'affichage du site doivent être totalement terminé, ou du moins qu'il reste
que des choses vraiment minime à faire. En prévision de la vidéo.<br>
De plus, il faudra faire tout ce que j'ai cité au dessus, en plus du sujet de crypto et de stats.<br>
Sans oublier le sujet de droit... Je ne parle pas non plus du cahier des charges...<br>

#### Travail effectué
- **Florent**<br>
  - PHP : Conception et premier jet de la fonction tableGenerate.

- **Tom**<br>
  - BD : Ajout d'une condition pour certaines vues pour afficher les données uniquement liés à l'utilisateur MariaDB connecté

- **Enzo** :<br>
  - BD : Fusion des patchs BD avec le script BD.
  - BD : Attributions des droits aux rôles et des rôles aux profils MariaDB concernés.
  - BD : Décision de renommer les vues.
  
- **Assia**<br>
  - PHP : Modification des pages actions connexion/inscription suite au changement de nom des vues par Enzo.

- **Matthieu (chef de projet)**<br>
  - Git : Gestion du dépôt git (création, suppression, merge des branches).
  - PHP : Rectification du style.css, et de l'include des fichiers liés à la BD dans le fichier php fonction.
  - PHP : Développement de la fonction tableGenerate suite au premier jet de Florent.

Le travail effectué est fondé sur l'activité du dépôt GitHub. Toute modification extérieure n'est pas répertorié.

<br><br><br>

---

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

- **Ce qui a été terminé :**
  - Page connexion (les msg erreurs), action connexion, test (terminé par Matthieu)
  - Page inscription (les msg erreurs), action inscription, test (terminé par Matthieu)
  - Test page déconnexion (terminé par Matthieu)
  - Fonction recupererRoleDe (manque conception je crois ? Note : ça ne serait pas l'objectif d'UserRole d'ailleurs en fait ?) (Matthieu)
  - Fin dev connectUser, valideMDP, executeSQL (terminé par Matthieu, commencé par Florent, Enzo, Assia)
  - Fin dossier de test des fonctions executeSQL, pages modifMdp et modifEmail (Assia, commencé par Enzo)
  - Cas d’utilisation modifEmail et modifMdp (Assia)

- **Ce qui sera à terminer la semaine prochaine :**
  - Page modif mot de passe (Assia, Enzo, Florent)
  - Page modif adresse email (Assia, Enzo, Florent)
  - Nouvelle version de la base de données (Enzo, Matthieu)
  - Le devoir en Droit : utilisation des données (continué par Assia (et Tom ?) durant cette semaine)
  - Fonction pour les tableaux (Florent)
  - Page de profile (Enzo, Florent)
  - Partie dynamique page d'accueil

- **Ce qui a été avancé :**
  - Nouvelle version du site statique (Tom)
  - Page de profile (Enzo)

- **Ce qui est a terminé dès que possible :**
  - Nouvelle version du site (Tom)
 
- **Ce qui est a continué :**
  - Tableau de bord
 
- **Ce qui est à commencé :**
  - Création d'un ticket
  - Modification d'un ticket

Note : Florent s'occupe d'une fonction dédiée à la génération des tableaux HTML. Je ne suis pas allé me renseigner de son avancée.
Remarque : Je vais essayer d'aller voir dès que possible M. DUFAUD et demander peut-être l'avis sur notre site à M. HOGUIN. Si possible aussi, l'avis de M. DJERROUD sur les cas d'utilisation (mais je ne suis pas certain).<br>
<br>

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
