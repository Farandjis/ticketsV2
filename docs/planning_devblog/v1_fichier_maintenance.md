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

## Lundi 12/02/2024 - Bilan du travail du 06/01/2024 au 12/01/2024

Semaine en cours.

<br><br><br>

---

## Lundi 05/02/2024 - Bilan du travail du 30/01/2024 au 05/01/2024

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
