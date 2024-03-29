Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S4  - Fichier de maintenance V1 de TIX (depuis Janvier)

<br><br>
Ce document permet de récapituler la progression de chacun et de l'avancée du projet dans sa globalité depuis la sortie de sa première version.<br>
Chaque semaine, il y a un bilan expliquant ce qui fonctionne, nos problèmes, nos discussions ou encore nos prévisions.
</div>

<br><br><br>


## Dimanche 24/03/2024 - Bilan du travail du 18/03/2024 au 24/03/2024

Semaine en cours.

- **Florent**
  - Fin : Archivage des tentatives d'inscription réussites et échoués (note au moment d'écrire : en cours)
- **Tom**
  - Fin : afficher le fichier csv directement dans une pop-up (note au moment d'écrire : en cours)
- **Enzo**<br>
  - ...
- **Assia**<br>
  - ...
- **Matthieu**
  - Fin : Intégration de fail2ban à la plateforme TIX (note au moment d'écrire : en cours)
  - Fin : Bannissement/Débannissement de compte (modif BD + intégration à la plateforme TIX)  (note au moment d'écrire : en cours)

<br><br><br>

---



## Lundi 18/03/2024 - Bilan du travail du 11/03/2024 au 17/03/2024

- **Florent**
  - Fin : Vérification du bon fonctionnement automatique Kron
  - Fin : Rédaction du document d'installation de Kron

- **Tom**
  - Fin : Archiver/Désarchiver via JavaScript sur l'interface web
  - En cours : afficher le fichier csv directement dans une pop-up

- **Enzo**<br>
  - En cours : Mise en code des tests pour les fonctions à l'aide de PHP Unit (manque plus que 2 fonctions)
- **Assia**<br>
  - ...
- **Matthieu**
  - Fin : débloquage de l'accès aux pages lors d'un débannissement
  - En cours : Intégration de fail2ban à la plateforme TIX


<br><br><br>

---

## Dimanche 10/03/2024 - Bilan du travail du 04/03/2024 au 10/03/2024

- **Florent**
  - En cours : Vérification du bon fonctionnement automatique Kron
  - Fin : Téléchargement/Suppression des archives via TIX
- **Tom**
  - En cours : Archiver/Désarchiver via JavaScript sur l'interface web
- **Enzo**<br>
  - A Copier-coller 5 lignes de code à chaque redirection dans action_modif_ticket un lundi soir mais c'est pas 100% fonctionnel (pb avec les mots-clés)
- **Assia**<br>
  - En cours tests boîtes blanches pour toute les fonctions utilisées
- **Matthieu**
  - Fin : voir comment juste bloquer l'accès aux pages page d'authentifications lors d'un ban f2b (manque inscript)
  - en cours : voir comment juste débloquer l'accès aux pages page d'authentifications lors d'un déban f2b

<br><br><br>

---

## Dimanche 03/03/2024 - Bilan du travail du 26/02/2024 au 03/03/2024

Rien de spécial cette semaine, nous continuons nos travaux.
Objectif prochaine fois : terminer toutes les tâches indiquées dans le pdf

- **Florent**
  - Fin : Listage des archives connexions infructueuses et derniers tickets
- **Tom**
  - En cours : Archiver/Désarchiver via JavaScript sur l'interface web
- **Enzo**<br>
  - Aucune avancée
- **Assia**<br>
  - Fin Tests saveToSessionSignUp
- **Matthieu**
  - Fin : bannissement auto en fonction des échecs d'authentification (logs .csv de Florent)
  - En cours : voir comment juste bloquer l'accès à la page d'authentification, et pas tout le site...
<br><br><br>

---

## Mardi 27/02/2024 - Bilan du travail du 12/02/2024 au 25/02/2024

Document discussion_autour_des_ameliorations_m_hoguin (version odt et pdf) mis à jour<br>
<br>
<br>
Ce bilan compte le travail effectué la semaine avant et pendant les vacances.

#### Travaux restants
  - Consultez discussion_autour_des_ameliorations_m_hoguin
#### Travail effectué

- **Florent**
  - Fin archivage et extractions des données
- **Tom**
  - Fin Création page modération
  - Amélioration page administration
  - Fin Menu sous ADM SYS pour afficher 2 ancres : Historique et J. A.
- **Enzo**<br>
  - En cours : retour des données entrées dans le formulaire d'inscription en cas d'erreur
- **Assia**<br>
  - Fin Tests des différentes pages terminées
  - Fin Ajout des cas de tests pour executeSQL, validemdp, valideEmail
  - Fin Réalisation des tests pour operationCaptcha et verifyCaptcha
- **Matthieu**
  - Gestion du projet
  - Début de la configuration de fail2ban pour le système de modération de TIX
  - BD : Fin la vue "affiche_utilisateurs_pour_adm_web" liste désormais uniquement les enregistrement de la table Utilisateur associé à un compte MariaDB avec un rôle par défaut 'role_utilisateur'
  - PHP : Fin Modification fonction menuDeroulant : les éléments cochés ou l'élément sélectionné passe désormait tout en haut du menu. Ces éléments sont affichés avec un chevron.

<br><br><br>

---

## Dimanche 11/02/2024 - Bilan du travail du 06/02/2024 au 11/02/2024

Document discussion_autour_des_ameliorations_m_hoguin (version odt et pdf) mis à jour, avec des ajouts personnels.<br>
<br>
Le système de catégorie est opérationnel, les tests peuvent commencer. Le système d'archivages des journaux d'activités sont sur le point d'être terminé.<br>
Pour cette nouvelle semaine, je propose qu'on soit plus productif :
- Fin de la revue intégrale du site pour que le dossier de test soit complet. Pour rappel : Assia dossier, Enzo campagne.
- Revue intégrale de l'accessibilité et amélioration de l'accessibilité (narrateur...)
  - Faire un bouton pour voir la description visuel de la vidéo par exemple aussi.
- Faire les tâches libres, celles qui ne sont pas assignés (ex : passer les valeurs cochées en haut des menus déroulant)

#### Travaux restants
Pour des informations supplémentaires, consultez le PDF.
- Manuel d'utilisateur
- Niveau d'urgence « En attente » devient « En vérification »
- Les cases cochées repassent en haut de la liste
- Retirer les administrateurs de la liste des utilisateurs pour gestion tech
- Tom : Faire un style pour les alertes JS
- Faire un menu sous ADM SYS pour afficher 2 ancres : Historique et J. A.
- Journaux d'activités
- Modération
- Statistique
- Reprendre le système de remise des valeurs de créer mais cette fois ci pour modif
  - -> Note : Peut-être utiliser une fonction au lieu de mettre X fois Y mêmes lignes de codes ?
- Système jeton à revoir
- Préciser les messages d’erreurs
- Mettre sys msg erreurs pour page adm
- Tom : Améliorer l'accessibilité via le narrateur (voir les aria-machin peut-être)

#### Travail effectué
- **Florent**
  - Fin de l'installation de CRON et des scripts d'automatisation sur le RPi4 mais manque rapport d'installation ?
    - Manque juste la gestion des fichiers côté PHP
- **Tom**
  - Création du code HTML pour la liste déroulante des catégories titres/mots-clés pour l'adm w (+ code SQL dans le code PHP afficher la liste)
    - Manque juste de remettre proprement la liste, pour que ce soit plus jolie
- **Enzo**<br>
  - Correction bug : Rajout des données quand le captcha est incorrecte.
- **Assia**<br>
  - Correction du dossier de test dossier_test_dynamique_profil.md
- **Matthieu**
  - Gestion du projet
  - Fin du système de catégorie
    - On indique désormais la catégorie lors d'un création d'un titre ou d'un mot-clé
    - La liste des mots-clés possible s'adapte au titre sélectionné (création et modification ticket). Pas possible de prendre un non listé sauf en SQL.

<br><br><br>

---

## Lundi 05/02/2024 - Bilan du travail du 30/01/2024 au 05/02/2024

#### Travaux restants (fondé selon le PDF résumant les remarques de M Hoguin):
- Matthieu - Associer aux titres/mots-clés un tag (ex [AUTRE] [MATERIEL]...)
  - -> En cours, fin prévu pour le 06/02/2024
- Assia - Le technicien ne doit pas pouvoir se désinscrire
- Niveau d'urgence « En attente » devient « En vérification »
- Les cases cochées repassent en haut de la liste
- Retirer les administrateurs de la liste des utilisateurs pour gestion tech
- Faire un menu sous ADM SYS pour afficher 2 ancres : Historique et J. A.
- Journaux d'activités
- Modération
- Statistique
- Régler pb retour des données inscription quand erreur
- Système jeton à revoir


#### Travail effectué
- **Florent** et **Tom**<br>
  - Préparation de l'installation de CRON sur le RPi4
  - Préparation des scripts d'automatisation
  - Fin gestion des techniciens v2 (voir pdf)
- **Enzo**<br>
  - Aide pour le récapitulatif "Travail effectué"
- **Assia**<br>
  - Révision dossier de tests : pages d'authentifications, index et création de ticket
- **Matthieu**
  - Gestion du projet
  - Légère avancé pour le système de catégorie
<br><br><br>

---

## Jeudi 01/02/2024 - Bilan du travail du 23/01/2024 au 29/01/2024

Premier bilan de la version 1 de TIX, publié et noté comme SAÉ S3.<br>
Au cours de ce nouveau semestre, nous devrons améliorer notre application et prendre en compte les remarques de notre client Monsieur HOGUIN.<br>
<br>
Les remarques de notre professeur et nos réflexions dessus sont dans le document PDF du 23/01/24 : [discussion_autour_des_ameliorations_m_hoguin.pdf](discussion_autour_des_ameliorations_m_hoguin.pdf).<br>
<br>
<br>
Désormais, Assia est la cheffe des dossiers de tests, Enzo mènera les campagnes de tests.<br>
Pour compenser, Enzo m'aidera pour faire le récapitulatif "Travail effectué" chaque semaine.<br>
<br>
Exceptionnellement, l'équipe avance en autonomie.

#### Travail effectué
- **Florent** et **Tom**<br>
  - Mise en place de la nouvelle façon de gérer les techniciens (avec Tom)
  - Correction des erreurs textuelles discussion_autour_des_ameliorations_m_hoguin.pdf

- **Enzo** :<br>
  - Correction des redirections vers le tableau de bord (modif/creerTicket) : redirige directement vers la page
  - Récapitulatif "Travail effectué"

- **Assia**<br>
  - Revu du dossier de tests, ajout de nouveaux cas
  
- **Matthieu (chef de projet)**<br>
  - Modification du code et de la conception pour l'ajout des catégories (tags) de titres et de mots-clés.
  - Début de la création du code JS pour faire une demande au serveur et détecter quand le faire.
  - Début du script de réponse PHP du serveur.



<br><br><br>

---
