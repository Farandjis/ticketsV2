Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Installation du RPi4

<br><br>
Ce document décrit en détail le processus d'installation du RPi4, de son serveur LAMP, de sa mise en réseau, du ssh et de sa sécurisation.<br>
Les étapes décrites sont également appliqués au serveur de secours. Ce document aborde aussi la configuration du routeur. 

</div>

<br><br><br><br><br><br><br>

## Plan

- ### [I – Préparatif](#p1)
  - [**a) Présentation du RaspberryPi 4**](#p1a)
  - [**b) Présentation de Raspberry OS Lite**](#p1b)
  - [**a) Matériels nécessaires**](#p1c)
  - [**b) Logiciels nécessaires**](#p1d)
  - [**c) Installation de Raspberry OS Lite**](#p1e)
  
- ### [II - Installation du serveur LAMP](#p2)
  - [**a) Premier démarrage de Raspberry OS Lite**](#p2a)
  - [**b) Installation d'Apache**](#p2b)
  - [**c) Installation de MariaDB**](#p2c)
  - [**d) Installation de PHP**](#p2d)
  - [**e) Installation de PHPMyAdmin**](#p2e)

- ### [III - Mise en réseau via Hamachi](#p3)
  - [**a) Présentation de LogMeIn Hamachi**](#p3a)
  - [**b) Installation**](#p3b)
  - [**c) Problèmes rencontrés**](#p3c)
  - [**d) Hypothèse sur ces problèmes**](#p3d)
  - [**e) Résolution des problèmes**](#p3d)

- ### [IV - Sécurisation](#p4)
  - [**a) Pare feu**](#p4a)
    - [i) Pare feu du routeur](#p4ai)
    - [ii) Pare feu du RPi4](#p4c4aii)
  - [**b) Emplacement des fichiers et alias**](#p4b)
  - [**c) Les utilisateurs et leurs droits**](#p4c)
    - [i) Liste des utilisateurs](#p4ci)
    - [ii) Droits des utilisateurs](#p4cii)


<br><br><br>

## <a name="p1"></a> I - Préparatif
  - #### <a name="p1a"></a> c) Matériels nécessaires
    Pour utiliser le RPi4 sur le même écran de son ordinateur tout en l'utilisant, on peut utiliser un boitier d'acquisition.<br>
    C'est un adaptateur HDMI vers USB, permettant de récupérer le signal vidéo sur son ordinateur. Utile pour enregistrer l'écran du RPi4 par exemple.<br>

    <br>
    Pour procéder à l'installation du système, il faut au préalable avoir :<br><br>

    - **Un RaspberryPi et son alimentation**<br>
      Monsieur Hoguin nous a confié un RaspberryPi 4 modèle B. C'est un mini ordinateur à manipuler avec précaution. En effet, il n'est pas dans un boitier.<br>
      Son alimentation se branche au RPi4 via son port USB type C.<br><br>
    
    - **Une carte microSD**<br>
      Monsieur Hoguin nous a donné une carte micro SD Verbatim de 16Go.<br>
      Le RPi4 est réputé comme étant un tueur de carte micro SD. Nous devons donc archiver régulièrement l'intégralité du contenu de cette carte.<br><br>
    
    - **Un câble HDMI et son adaptateur vers micro HDMI**<br>
      Le RPi4 se branche en micro HDMI. Ayant un câble HDMI, un adaptateur était nécessaire. Il nous a coûté 3€ à la FNAC.<br><br>
  
    - **Un clavier d'ordinateur**<br>
      Un clavier d'ordinateur basique se branchant en USB suffit.<br><br>
    
    - **Un câble ethernet** (préférable)<br>
      Brancher un câble ethernet permet de vérifier grâce aux leds que le RPi4 soit bien connecté au réseau.<br>
      On peut aussi connecter le RPi4 en Wi-Fi. Mais grâce au câble nous sommes assurés de ne pas accuser la connexion si on rencontre des problèmes dans la plupart des cas.

<br>

  - #### <a name="p1b"></a> d) Logiciels nécessaires

    Pour installer un système sur un support dédié au RaspberryPi, le plus simple est d'utiliser le logiciel "Pi Imager".<br>
    À partir du bouton "Choisir l'OS", le logiciel propose différents systèmes pouvant être installé. On peut aussi installer son propre système.<br>
    Nous avons choisi Raspberry OS Lite. C'est la version de Raspberry OS sans interface graphique.<br>
    Cette version permet de démarrer le RPi4 sans écran, sans clavier et sans souris. Elle pèse près de 600 Mo, c'est donc le système idéal pour notre serveur.<br>
    Bien que nous savons utiliser le terminal, le cas échéant, il est toujours possible d'ajouter une interface graphique à Raspberry OS Lite.<br>
    <br>
    Raspberry OS est issu du système Debian et est prévu pour un fonctionnement sur un RaspberryPi.<br>
    Ubuntu étant aussi issu sur Debian, nous pouvons aussi bien s'aider de la documentation de Raspberry OS, que celle de Debian ou celle d'Ubuntu.<br>
    Cependant, il peut y avoir des légères différences.<br>
    <br>
    En dehors du logiciel Pi Imager, vu que nous possédons un boitier d'acquisition, nous allons utiliser les logiciels VLC et Mirillis Action!.<br>
    VLC permettra d'afficher sur son ordinateur la sortie vidéo du boitier provenant du RPi4, et Action! permettra en même temps d'enregistrer celui-ci et même le bureau Windows.<br>
    Grâce aux vidéos, nous pouvons décrire précisément l'installation du système et la résolution des problèmes rencontrés.<br>
    Des captures d'écran de ces vidéos illustrons ce document.<br>

    <br><br>

    <div align="center">
    
    <img src="img\I_preparatif\0_piimager_menu.webp" title="Menu de Pi Imager avec les boutons choix OS, choix Stockage, écrire et un bouton paramètre" height="180"/>
    <img src="img\I_preparatif\vlc.webp" title="VLC sur Windows 10 affichant l'écran du RPi4 installant PHPMyAdmin" height="180"/>

    <i>A gauche : Menu de Pi Imager<br> A droite : VLC affichant l'écran du RPi4 sur Windows 10</i>

    </div>


- #### <a name="p1b"></a> e) Installation de Raspberry OS Lite
