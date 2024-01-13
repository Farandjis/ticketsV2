Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS
INF2-A

<div align="center">
<img height="95" width="400" src="../../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Conception base de données

<br><br>
Ce document décrit la base de données utilisé pour le système de jeton (voir conception web).
</div>

<br><br><br>

- ### [I - Analyse](#p1)
- ### [II - La table stockage_jeton](#p2)
  - Description
  - Liste de ses attributs
- ### [III - L'utilisateur fictif fictif_connexionDB](#p9)


---------

## <a name="p1"></a> I - Analyse
Nous avons besoin d'une base de données permettant de lutter contre le piratage de compte en cas d'extraction du fichier cookie session.<br>
<br>
Elle est isolée de la base de donnée principale et utilisée uniquement par le compte fictif_connexionDB qui gère les connexions à la base de données.<br>
Nous n'avons besoin qu'une seule table : stockage_jeton<br>
<br>
Pour rappel, TIX est une application interne de l'IUT, l'IP est donc celle des machines de l'IUT.



## <a name="p2"></a> II - La table stockage_jeton
  - ### Description
    Permet le stockage du jeton.<br>
    Un jeton est caractérisé par l'ip de connexion actuelle au compte, de l'horodatage de cette connexion et d'un nombre généré aléatoirement.<br>
    Une connexion étant caractérisé par l'IP et le login, ce sont les clés primaires.<br>
    <br>
    De ce fait, deux ordinateurs peuvent se connecter en simultané sur un même compte tout en ayant 2 jetons distincts valides.

  - ### Liste de ses attributs
    - **JETON_LOGIN_USER** VARCHAR(20) : NOT NULL, PRIMARY KEY
    - **JETON_IP_USER** VARCHAR(15) : NOT NULL, PRIMARY KEY
    - **JETON_HORODATAGE_USER** DATETIME : DEFAULT CURRENT_TIMESTAMP,  NOT NULL,
    - **JETON_VALEUR** INT : NOT NULL



## <a name="p3"></a> III - L'utilisateur fictif fictif_connexionDB
  - ### Utilisateur MariaDB : fictif_connexionDB
    - **Présentation**
      - Gère les jetons
    - **Action**
      - Créer, supprime, met à jour, consulte les jetons
    - **Droits**
      - SELECT
          - DB_JETONS_TIX.stockage_jeton
      - INSERT
          - (JETON_LOGIN_USER, JETON_IP_USER, JETON_VALEUR) ON DB_JETONS_TIX.stockage_jeton
      - UPDATE
          - (JETON_HORODATAGE_USER) ON DB_JETONS_TIX.stockage_jeton
      - DELETE
          - DB_JETONS_TIX.stockage_jeton
    