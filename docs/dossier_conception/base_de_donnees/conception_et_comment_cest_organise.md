Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3  - Conception base de données

<br><br>
Ce document décrit la base de données. Comme ses tables, ses utilisateurs et leurs drois, ses vues.
</div>

<br><br><br>

- ### [I - Analyse](#p1)

- ### [II - Les tables](#p2)
  - Pour chaque table
    - Nom de la table
    - Description
- ### [III - Les attributs des tables]()
  - Pour chaque table
    - Liste de ses attributs
    - Options des attributs (clées primaire...)
- ### [IV - Les utilisateurs MySQL]()
  - Pour chaque type d'utilisateur MySQL
    - Nom du type d'utilisateur
    - Description de l'utilisateur
    - Ses droits
- ### [V - Les vues]()
  - Pour chaque type d'utilisateur
    - Nom de la vue
    - Description de la vue
    - Ce qu'elle fait

<br><br><br><br><br><br><br>

---------

- ### <a name="p2"></a> I - Analyse
  Nous avons besoin d'une base de données capable de stocker les différentes données concernant les utilisateurs et les différents tickets.<br>
  Cette base des données permet de joindre les différents tickets à leurs créateurs et à leurs techniciens associés.<br>
  Celle-ci doit être sécurisé, elle ne doit pas permettre l'accès ou la modification non autorisée.
  Ainsi, un utilisateur ne doit pouvoir accéder uniquement aux données publiques et à ses données personnelles, et non aux données personnelles des autres utilisateurs.<br>
  En cela, il est nécessaire de mettre en place des vues ainsi que la création d'utilisateurs sur la base de données.<br>


- ### <a name="p2"></a> II - Les tables
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

- ### <a name="p2"></a> III - Les attributs des tables

- ### <a name="p3"></a> IV - Les utilisateurs MySQL

- ### <a name="p4"></a> V - Les vues