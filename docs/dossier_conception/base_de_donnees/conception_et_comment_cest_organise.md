Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3  - Conception base de données

<br><br>
Ce document décrit la base de données. Comme ses tables, ses utilisateurs et leurs drois, ses vues.
</div>

<br><br><br>

- ### [I - Les tables](#p1)
  - Pour chaque table
    - Nom de la table
    - Description
- ### [II - Les attributs des tables]()
  - Pour chaque table
    - Liste de ses attributs
    - Options des attributs (clées primaire...)
- ### [III - Les utilisateurs MySQL]()
  - Pour chaque type d'utilisateur MySQL
    - Nom du type d'utilisateur
    - Description de l'utilisateur
    - Ses droits
- ### [IV - Les vues]()
  - Pour chaque type d'utilisateur
    - Nom de la vue
    - Description de la vue
    - Ce qu'elle fait

<br><br><br><br><br><br><br>

---------

- ### <a name="p1"></a> I - Les tables
  - #### Utilisateur
    La table utilisateur comporte toute les données liés aux utilisateurs, et aux comptes des utilisateurs.

  - #### Ticket
    La table ticket comporte tous les tickets de la plateforme et leurs informations. Ceux en attente de validation par l’administrateur comme ceux en cours de traitement ou encore ceux qui ont été résolu.<br>
    Un ticket possède un identifiant unique et possède l'identifiant du demandeur.

  - #### Libelle
    La table libelle comporte tous les libellés pouvant être assignés à un ticket.

  - #### RelationTicketsLibellés et RelationTicketsLibellés
    Tables qui permettent de faire une jointure entre deux tables. Des informations peuvent compléter la jointure.

Description de la table

- ### <a name="p2"></a> II - Les attributs des tables

- ### <a name="p3"></a> III - Les utilisateurs MySQL

- ### <a name="p4"></a> IV - Les vues