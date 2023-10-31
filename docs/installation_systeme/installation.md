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

---

## Plan

- ### [I – Présentation](#p1)
    - [**a) Présentation du RaspberryPi 4**](#p1a)
    - [**b) Présentation de Raspberry OS Lite**](#p1b)

- ### [II – Préparatif](#p2)
  - [**a) Matériels nécessaires**](#p2a)
  - [**b) Logiciels nécessaires**](#p2b)
  - [**c) Installation de Raspberry OS Lite**](#p2c)
  
- ### [III - Installation du serveur LAMP](#p3)
  - [**a) Premier démarrage de Raspberry OS Lite**](#p3a)
  - [**b) Installation d'Apache**](#p3b)
  - [**c) Installation de MariaDB**](#p3c)
  - [**d) Installation de PHP**](#p3d)
  - [**e) Installation de PHPMyAdmin**](#p3e)

- ### [IV - Mise en réseau via Hamachi](#p4)
  - [**a) Présentation de LogMeIn Hamachi**](#p4a)
  - [**b) Installation**](#p4b)
  - [**c) Problèmes rencontrés**](#p4c)
  - [**d) Hypothèse sur ces problèmes**](#p4d)
  - [**e) Résolution des problèmes**](#p4d)

- ### [V - Sécurisation](#p5)
  - [**a) Pare feu**](#p5a)
    - [i) Pare feu du routeur](#p5ai)
    - [ii) Pare feu du RPi 4](#p5c5aii)
  - [**b) Emplacement des fichiers et alias**](#p5b)
  - [**c) Les utilisateurs et leurs droits**](#p5c)
    - [i) Liste des utilisateurs](#p5ci)
    - [ii) Droits des utilisateurs](#p5cii)


<br><br><br>

---

## <a name="p1"></a> I - Présentation

  - ### <a name="p1a"></a> a) Présentation du RaspberryPi 4
    Le RaspberryPi est un micro ordinateur monocarte apparu en février 2012. Excepté l'alimentation et un support de stockage,
    nous y retrouvons tout le nécessaire pour le faire fonctionner comme un processeur et de la mémoire vive.<br>
    Comme pour la majorité des ordinateurs, celui-ci propose des ports pour y brancher un écran, des périphériques, une alimentation, une caméra ou encore un câble ethernet.<br>
    <br>
    Cependant, le RPi 4 comporte des différences avec les anciens modèles de RPi.<br>
    En termes de processeur, son CPU possède des cœurs plus récents (les Cortex-A72) et son GPU est 25% plus rapide que les précédents modèles :
    désormais sa résolution d'écran maximal est de la 4K UltraHD. Son port HDMI/Mini-HDMI a laissé place à deux ports micro HDMI.<br>
    Concernant la mémoire vive passant de LPDDR2 à LPDDR4 d'ailleurs, il y a trois versions du RPi4 : une 1Go, une 2Go et une à 4Go, la nôtre.<br>
    Deux de ses ports USB 2 ont laissé place à deux ports USB 3, et en termes de connectique réseau, le RPi4 possède un meilleur port LAN, un meilleur Wi-Fi et un meilleur Bluetooth.<br>
    <br>
    Nous pouvons en apprendre plus sur les caractéristiques de notre Raspberry Pi 4 en exécutant la commande Raspberry OS : pinout<br>
    <br>
    <div align="center">
    <img width=400px src="/media/matthieu/TOSHIBA/!CONTENU_CLEE_USB/!!ECOLE -----------------/!IUT----------------------------------/!INF2-A/SAE/SAE_S3/ticketsV2/docs/installation_systeme/img/I_preparatif/pinout.png" title="résultat de la commande pinout avec les différents ports, un dessin de la carte et une descriptions des pins"/><br>
    <i>résultat de la commande pinout</i>
    </div>
    <br>
    <br>
    Comme précédemment dit, Le RPi 4 possède un processeur ARM Cortex-A72. Même si c'est un processeur 64bits, c'est un processeur faisant partie de la famille ARMv8 et non des x86 comme on le retrouve souvent sur nos PC.<br>
    Les processeurs ARM sont principalement utilisé pour "les appareils compacts et tendent à optimiser l'autonomie, la taille, le refroidissement et surtout, les coûts" selon RedHat. Ce qui correspond aux critères du RPi 4 : être un mini ordinateur abordable<br>
    On remarque cependant que selon RedHat, l'architecture x86 est plutôt utilisé pour les serveurs pour leur vitesse. Ainsi, en dehors du cadre de cette SAÉ, utiliser RaspberryPi comme serveur n'est pas le mieux.<br>
    <br>
    On remarque aussi le préfixe "LP" de "LPDDR4" comme type de mémoire vive du RPi4. "LP" pour "Low Power" est une version plus petite et moins consommatrice en termes de ressources que le simple DDR "Double Data Rate".<br>
    La DDR a remplacé la SDRAM au début des années 2000 par sa rapidité : "La DDR transfère les données au processeur à la fois dans la phase montante et descendante des signaux d’horloge" selon Crucial.<br>
    Encore une fois, c'est un composant adapté pour les appareils compacts comme le RaspberryPi.<br>
    
    <br><br>
    **Sources :**
    - https://www.jmdoudoux.fr/raspberry/raspberry_pi_4_modele_B.htm
    - https://www.conrad.fr/fr/guides/materiel-educatif-kits-de-developpement/raspberry-pi.html
    - https://fr.wikipedia.org/wiki/Raspberry_Pi
    - https://www.raspberrypi.com/products/raspberry-pi-4-model-b/
    - https://fr.wikipedia.org/wiki/ARM_Cortex-A72
    - https://www.redhat.com/fr/topics/linux/ARM-vs-x86
    - https://www.hardware.fr/news/13047/quelques-details-lpddr4-ddr4-wide-i-o.html
    - https://fr.msi.com/blog/ultra-thin-business-and-productivity-laptop-with-lpddr4x-memory
    - https://www.crucial.fr/articles/about-memory/difference-among-ddr2-ddr3-ddr4-and-ddr5-memory
    - https://fr.wikipedia.org/wiki/LPDDR


  - ### <a name="p1b"></a> b) Présentation de Raspberry OS Lite


<br><br><br>

---

## <a name="p2"></a> II - Préparatif

  - ### <a name="p2a"></a> a) Matériels nécessaires
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

  - ### <a name="p2b"></a> b) Logiciels nécessaires

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


- ### <a name="p2c"></a> c) Installation de Raspberry OS Lite
