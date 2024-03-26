Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S4 - Système de modération Fail2Ban

<br><br>
Ce document décrit en détail le processus de configuration de fail2ban et d'Apache2 afin de modérer la plateforme TIX.<br>
Ce document fait suite au document installation.md présentant et montrant l'installation de fail2ban et d'Apache.<br>
<br>

</div>

<br><br><br><br><br><br><br>

---

- ## [I – Modération des connexions/inscriptions à TIX](#p1)
    - ### [a) Stratégie et fonctionnement](#p1a)
    - ### [b) Installation](#p1b)
      - **i) Prison fail2ban : TIX_connexionSite_PRISON.conf**
      - **ii) Action fail2ban : TIX_connexionSite_ACTION.conf**
      - **iii) Droits d'accès Apache**
      - **iv) Script d'ajout shell**
      - **v) Script de retrait shell**
    - ### [c) Tests](#p1c)
- ## [II - Modération des comptes TIX](#p2)
- ## [III - Interface](#p3)
    - ### [a) Administrateur Web (gestion)](#p3a)
    - ### [b) Administrateur Système (admin)](#p3b)

<br><br><br>

---

## <a name="p1"></a> I – Modération des connexions/inscriptions à TIX
Nous allons utiliser fail2ban pour limiter le nombre de tentatives de connexion infructueuse et d'inscription sur la plateforme TIX.

- ### <a name="p1a"></a> a) Stratégie et fonctionnement
    Fail2ban propose de créer nos propres prisons en précisant quel fichier de log à surveiller et les options de bannissement via les fichiers jail.d.<br>
    Il ne peut que bloquer des ports, comme HTTP ou SSH par exemple. Il n'est pas possible de limiter les connexions : on bloque tout ou rien.<br>
    <br>
    Cependant, fail2ban est capable d'exécuter une commande ou un script shell automatiquement lors d'un bannissement ou d'un débannissement.<br>
    Vu qu'Apache peut limiter l'accès aux pages/répertoires du site par certaines IP, l'idée serait que fail2ban modifie la configuration d'Apache afin de limiter l'accès à une portion du site.<br>
    <br>
    <br>
  **Plus clairement, le bannissement :**
  - Une connexion infructueuse vient d'être marqué dans le journal (fichier csv)
  - Fail2ban détecte et incrémente le nombre de tentatives associé à l'IP
  - Dépassant la limite, ou si demandé, fail2ban bannis l'IP en l'ajoutant à la prison
  - Il exécute le script ajout_acces_connexion.sh
  - Le script ajoute l'IP au fichier acces_connexion.conf et recharge Apache
  - Lors d'une nouvelle tentative de l'utilisateur, Apache interdit l'accès et lui affiche une page d'erreur.
  <br><br>
  
  **Le débannissement :**
  - Fail2ban débannis l'IP une fois le temps du bannissement dépassé ou si demandé
  - Fail2ban exécute retire_acces_connexion.sh
  - Le script retire la ligne associée à l'IP indiqué par fail2ban et recharge Apache
  - Lors d'une nouvelle tentative de l'utilisateur, Apache ne bloque pas la connexion.



- ### <a name="p1b"></a> b) Installation
  - **i) Prison fail2ban : TIX_connexionSite_PRISON.conf**<br>
    Fichier de configuration centrale pour la modération de fail2ban : il indique tout ce dont il doit savoir.<br>
    <br>
    **Remarques :**
    - À placer dans **/etc/fail2ban/jail.d/**
    - Les fichiers sont détectés automatiquement.
    - On peut les modifier à la voler, sans devoir recharger fail2ban (note : je ne suis plus sur)
    <br><br>
    
    En plus du journal à surveillé, il doit être accompagné d'un filtre, afin que fail2ban puisse reconnaître les lignes problématiques et récupérer les informations.<br>
    Pour que le filtre soit détecté, il ne faut pas oublié de mettre **backend = auto** tout en haut du fichier de configuration de la prison.<br>
    Le filtre est à placer dans **/etc/fail2ban/filter.d/**.
    
    <br><br>
    _Fichier /etc/fail2ban/filter.d/tix_connexionSite.conf_ 
    > [Definition]<br>
      datepattern = ^\"Day/Mon/Year 24hour:Minute:Second\" # détection et formatage de l'horodatage<br>
      failregex = ^\".*?\"\,[^,]*?,<HOST>,.*$ # détecttion de la ligne problématique et de l'IP.
  
    <br><br>
    _Fichier /etc/fail2ban/jail.d/TIX_connexionSite_PRISON.conf_
    [TIX_connexionSite_PRISON]
    >\# Prison active<br>
      backend = auto<br>
      enabled = true<br>
    > 
    > \# Filtre pour reconnaître les lignes des trucs pas bien (et reconnaître l'emplacement des données intéressantes)<br>
      filter = tix_connexionSite<br>
      journalmatch='CONTAINER_TAG=192'<br>
    >
    > \# Ports à surveiller (-> s'il y a une activité, on regarde le journal)<br>
      port = http,https<br>
    >
    > \# Fichier log à surveiller<br>
      logpath = /var/www/logs/journauxActvCoInf.csv<br>
    >
    > \# Que faut il faire<br>
      banaction = iptables-multiport<br>
      action = TIX_connexionSite_ACTION<br>
    >
    > \# Nb max tentative, pendant cmb de temps, durée du ban<br>
      maxretry = 4<br>
      findtime = 600 # 10min<br>
      bantime = 300 # 5min<br>
    
    <br><br>
  - **ii) Action fail2ban : TIX_connexionSite_ACTION.conf**<br>
    Fichiers indiquant ce que doit faire fail2ban par rapport à la prison.<br>
    <br>
    **Remarques :**
      - À placer dans **/etc/fail2ban/action.d/**
      - À indiquer dans le fichier de configuration de la prison
        <br><br>

      _Fichier /etc/fail2ban/action.d/TIX_connexionSite_ACTION.conf_
      > [Definition]<br>
        actionban = sh /var/www/autorisation_acces/connexionSite/ajout_acces_connexion.sh <ip><br>
        actionunban = sh /var/www/autorisation_access/connexionSite/retire_acces_connexion.sh <ip>

    <br><br>
  - **iii) Droits d'accès Apache**<br>
    Fichier de configuration personnalisé d'Apache pour paramétrer l'accès aux répertoires/fichiers<br>
    <br>
    **Remarques :**
      - À inclure dans **/etc/apache2/apache2.conf** : "Include /var/www/autorisation_acces/acces_connexion.conf"
      - Recharger Apache pour prendre en compte les modifications.<br>
        ATTENTION : Si le fichier est mal rédigé, Apache plante et coupe l'accès au site. 
    <br><br>
    
    _Fichier /var/www/autorisation_acces/acces_connexion.conf_

        <Directory /var/www/html/sitefteam/authentification>
        AllowOverride All
        
        <FilesMatch "^(connexion|action_connexion)\.php$">
        # Les règles concernent les fichiers connexion.php et action_connexion.php
        
                # Redirection en cas d'erreur 403 (accès interdit)
                ErrorDocument 403 /sitefteam/erreurs/403.html
        
                # Restriction des adresses IP
                # Ordre de priorité des instructions : autoriser puis refuser
                Order Allow,Deny
                # On autorise tout le monde à accéder au site…
                Allow from all
                # …Sauf l’adresse IP x.x.x.x
        
        </FilesMatch>
        </Directory>

    Avec le script, les adresses seront ajoutées avant le < /FilesMatch >.<br>

  <br><br>
  - **iv) Script d'ajout shell**<br>
    Script shell Linux qui va modifier le fichier de configuration d'Apache pour ajouter une IP et la bloquer<br>
    <br>
    **Remarques :**
    - À indiquer dans **/etc/fail2ban/action.d/TIX_connexionSite_ACTION.conf**
    - ATTENTION : S'assurer que cela ne pose aucun problème pour la sécurité système. (ex : n'importe qui modifie le .sh et attend que f2b l'exécute pour pirater)
    - Remarque : Cela fonctionne pour un bannissement simultané fait à la main. Cela peut sûrement poser problèmes si c'est à la microseconde près (droit d'accès au fichier) 
      <br><br>

    _Fichier /var/www/autorisation_acces/ajout_acces_connexion.conf_
 
        #!/bin/bash
        
        # Vérifie si largument est passé au script
        if [ -z "$1" ]; then
        echo "Usage: $0 <ip_address>"
        exit 1
        fi
        
        # Retirer la dernière ligne du fichier (le </Directory>
        sudo sed '$d' -i /var/www/autorisation_acces/connexionSite/acces_connexion.conf
        sudo sed '$d' -i /var/www/autorisation_acces/connexionSite/acces_connexion.conf
        
        # Ajoute ladresse IP à la liste daccès restreint
        echo "Deny from $1" >> /var/www/autorisation_acces/connexionSite/acces_connexion.conf

        echo "</FilesMatch>" >> /var/www/autorisation_acces/connexionSite/acces_connexion.conf
        echo "</Directory>" >> /var/www/autorisation_acces/connexionSite/acces_connexion.conf
        
        # Recharge les fichiers de configurations Apache déjà chargé
        sudo apachectl -k graceful

      Ce script retire les deux dernières lignes (/FilesMatch et /Directory), ajoute le refus d'accès pour l'IP puis remet les deux dernières lignes.
  
    <br><br>
  - **v) Script de retrait shell**<br>
    Script shell Linux qui va modifier le fichier de configuration d'Apache pour retirer une IP et la bloquer.<br>
    <br>
    **Remarques :**
    - À indiquer dans **/etc/fail2ban/action.d/TIX_connexionSite_ACTION.conf**
    - ATTENTION : S'assurer que cela ne pose aucun problème pour la sécurité système. (ex : n'importe qui modifie le .sh et attend que f2b l'exécute pour pirater)
    - Remarque : Cela fonctionne pour un bannissement simultané fait à la main. Cela peut sûrement poser problèmes si c'est à la microseconde près (droit d'accès au fichier)
      <br><br>

    _Fichier /var/www/autorisation_acces/retire_acces_connexion.conf_
  
        #!/bin/bash
        
        # Vérifie si largument est passé au script
        if [ -z "$1" ]; then
        echo "Usage: $0 <ip_address>"
        exit 1
        fi

        # Retire ladresse IP de la liste daccès restreint
        # voir : https://forum.ubuntu-fr.org/viewtopic.php?id=807231
        
        sed -i "/Deny from $1/d" "/var/www/autorisation_acces/connexionSite/acces_connexion.conf"
  
        # Recharge les fichiers de configurations Apache déjà chargé
        sudo apachectl -k

- ### <a name="p1c"></a> c) Tests
  Tests effectués avec succès pour s'assurer du bon fonctionnement du système :
    - Connexion infructueuse 
      - Correctement inscrit dans le fichier csv, fail2ban détecte l'échec de connexion
    - Connexion fructueuse
      - Non inscrit dans le fichier csv, fail2ban ne détecte rien
    - Dépasser le nombre de tentatives
      - Correctement banni
    - Attendre le temps imparti et s'assurer qu'on soit bien débanni
      - Correctement débanni
    - Bannir simultanément à la main 2 comptes (sur 2 ordinateurs, appuyer sur Entrée en même temps)
      - Les deux ordinateurs sont bien banni
    - Attendre le temps imparti et s'assurer que les deux ordinateurs soient bien débanni
      - Les deux ordinateurs sont bien débanni
    - Lors d'un ban/déban, tester l'accès de connexion.php et action_connexion.php
      - L'accès est bien bloqué/autorisé pour les deux pages. L'erreur s'affiche bien en cas de bannissement.
    - Lors d'un ban
      - L'utilisateur a toujours accès aux autres pages (ex : Accueil)


## <a name="p2"></a> II – Modération des comptes TIX
Pour bannir et débannir des comptes TIX nous n'utiliserons pas fail2ban mais la base de données.<br>
Sur la ligne de l'utilisateur, nous indiquons si l'utilisateur est banni ou non, et jusqu'à quand il l'est.<br>
A sa connexion, nous vérifierons s'il a le droit d'accéder à son compte, s'il n'a pas le droit, il aura un message d'erreur l'invitant à aller consulter l'Administrateur Web.<br>
<br>
Même si sur la la ligne des techniciens et administrateurs, il y a un emplacement pour le bannissement, celles-ci sont ignorées.<br>
<br>
## <a name="p3"></a> III - Interface
  TIX doit permettre de reconfigurer les prisons fail2ban mais également bannir et débannir manuellement des IP et des comptes via une interface graphique.<br> 
  Cette section présente les pages.<br>
- ### <a name="p3a"></a> a) Administrateur Web (gestion)
  L'administrateur Web ne peut que bannir et débannir des comptes hors Administrateurs et techniciens.<br>
  <br>
  Il peut sélectionner un utilisateur et préciser la date du bannissement. L'utilisateur est débanni le lendemain de la date indiquée à 1h du matin.<br>
  L'administrateur peut débannir l'utilisateur, lors de la sélection de celui-ci, un rappel des informations le concernant est affiché. Notamment, la date limite du bannissement.<br>
  Il n'y a aucun système de bannissement ou débannissement automatique des comptes.<br>
<br>
- ### <a name="p3b"></a> b) Administrateur Système (admin)
  Côté Administrateur Système, il gère tout ce qui concerne fail2ban.<br>
  Il a accès aux logs du logiciel, il peut paramétrer les prisons liées à TIX et et bannir/débannir pour toute les prisons.<br>
  <br>
  <b>Accéder à la page :</b> Se connecter en tant que "admin" > Page Administration > Modération > Entrez le login et mdp de la session RPi4 associée.<br>
  <b>Note :</b> S'il y a un quelconque problème lors de l'authentification à la session Linux lors de l'exécution d'une action, l'utilisateur est déconnecté de TIX par précaution.<br>
  <br>
  <br>
  <b>Fonctionnement :</b><br>
  Depuis PHP on peu exécuter des commandes Linux entant que l'utilisateur Linux d'Apache.<br>
  Nous avons créer un compte administrateur associé à la plateforme. Il a quelques droits sudo.<br>
  Avec la commande `su`, on devient ce compte pour exécuter des commandes à l'aide de sudo.<br>
  <br>
  Pour le chargement automatique des données des prisons, un script JavaScript demande à une page PHP du serveur les données nécessaire.<br>
  Le serveur lui répond, et JavaScript ajuste la page avec ces données.<br>
  <br>
  Le serveur enregistre à la fois à la volé ces informations (en exécutant une commande fail2ban) et à la fois dans le temps en modifiant le fichier de configuration.<br>
  En cas de plantage de redémarrage de fail2ban, la configuration est chargé depuis les fichiers de configurations. La nouvelle configuration est disponible sans relancer fail2ban grâce à l'exécution des commandes à la voler.<br>
  <br>
  De même, on récupère la liste des bannis par prison grâce à JavaScript. Si c'est un utilisateur banni automatiquement, les informations issus du CSV concernant le bannissement de l'IP sont affichés. Notamment : la date et l'heure du bannissement.<br>
  <br>
  L'administrateur peut bannir et débannir manuellement l'utilisateur. Le temps du ban correspond à la durée inscrite dans la prison.<br>
