Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="/docs/img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Dossier de conception

<br><br>
Ce document présente le système de jeton, conçus et créer pour sécuriser davantage notre application TIX.
</div>

<br><br><br>


- ### [I - Constat](#p1)
- ### [II - Mise en place](#p2)


---------

## <a name="p1"></a> I - Constat
  La reconnexion automatique de l'utilisateur lors des changements de pages se fait via un cookie session.<br>
  Les informations sont stockées côté serveur dans un fichier qui est caractérisé par un identifiant transmis au client (dans un fichier cookie).<br>
  <br>
  Source : [](https://ensweb.users.info.unicaen.fr/pres/sessions/)
  <br>
  De ce fait, n'importe qui possédant l'identifiant stocké dans le cookie peut l'utiliser pour se connecter au compte de l'utilisateur associé. Uniquement si le serveur n'a pas supprimé le cookie.<br>
  Notre objectif par le biais du jeton est de s'assurer que cet identifiant n'est pas utilisé par n'importe qui, mais bien par la personne qui s'est connecté.<br>

## <a name="p2"></a> II - Mise en place
  Pour cela, il suffisait juste de stocker l'horodatage et l'ip dans ce fichier côté serveur et de les comparer avec les infos de la connexion au serveur.<br>
  Pas besoin de base de donnée, même le chiffrement avec une clé qui change à chaque fois ne sert à rien en fait. On ne stocke pas côté client... Les données ne craignent rien...