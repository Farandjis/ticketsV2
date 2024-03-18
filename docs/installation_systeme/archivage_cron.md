Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Archivage cron

<br><br>
Ce document décrit en détail le processus d'application de l'archivage cron des logs et de l'historique sur l'application web TIX. <br>

</div>

<br><br><br><br><br><br><br>

---

## Plan

- ### [I – Informations sur cron](#p1)
    - [**a) Commandes et Avertissement**](#p1a)
    - [**b) Synthaxe**](#p1b)

- ### [II – Mise en place](#p2)
    - [**a) Script PHP et PHAR**](#p2a)
    - [**b) Commandes Linux**](#p2b)



## <a name="p1"></a> I - Informations sur cron

- ### <a name="p1a"></a> a) Commandes et Avertissement

On accède à l'interface cron en exécutant la commande :
``crontab -e``

Les commandes présentent dans le crontab du RaspberriePi 4 sont toutes appelées à la source des programmes.
Le crontab ne peut contenir un script bash complet, cependant il est possible de faire appel à un fichier externe (bash,php...) depuis le crontab.

La commande ``man crontab`` donne des informations plus précises sur l'utilisation de la commande cron.

Le crontab contient des informations relatives à la synthaxe et à l'utilisation du fichier crontab sous la forme de commentaires.


- ### <a name="p1b"></a> b) Synthaxe

``* * * * * commande_a_executer``

Chaque champ représente une unité de temps différente, et ils sont séparés par des espaces.

Minute (0-59) : Le premier champ spécifie la minute à laquelle la tâche doit être exécutée.<br>
Heure (0-23) : Le deuxième champ spécifie l'heure à laquelle la tâche doit être exécutée.<br>
Jour du mois (1-31) : Le troisième champ spécifie le jour du mois où la tâche doit être exécutée.<br>
Mois (1-12) : Le quatrième champ spécifie le mois où la tâche doit être exécutée.<br>
Jour de la semaine (0-6, où 0 représente dimanche) : Le cinquième champ spécifie le jour de la semaine où la tâche doit être exécutée.<br>

Pour chaque champ, on pout spécifier un chiffre unique, une liste de chiffres séparés par des virgules, un intervalle de chiffres (en utilisant le tiret), ou utiliser des caractères spéciaux (pour indiquer toutes les valeurs (*), toutes les valeurs impaires (/2)).

La commande à executer est une commande linux.


## <a name="p2"></a> II - Mise en place

- ### <a name="p2a"></a> a) Script PHP et PHAR

La première idée était de gérer l'archivage des logs via un fichier PHP appelé par le crontab.

On pouvait alors utiliser PHARdata afin de gérer la zone d'archivage avec des fichiers temporaires.

Ce plan a été mis en place mais s'est révélé peu pratique pour la reinitialisation des logs temporaires.

- ### <a name="p2b"></a> b) Commandes Linux

L'archivage a finalement été effectuer directement dans le crontab, en utilisant la commande tar.

La reinitialisation des logs temporaires ont alors pu être géré par la commande tee.

Les droits de modifications sur les fichiers de logs sont assurées par la commande chmod, s'executant en continue.
````
0 2 * * * /bin/tar -czvf "/var/www/logs/archives/ActvCoInf/archive_$(date +'\%Y\%m\%d').tar.gz" "/var/www/logs/journauxActvCoInf.csv"
0 2 * * * /bin/tar -czvf "/var/www/logs/archives/ActvCreTck/archive_$(date +'\%Y\%m\%d').tar.gz" "/var/www/logs/journauxActvCreTck.csv"
1 2 * * * echo "Date,Login,Ip,Tentative" | tee /var/www/logs/journauxActvCoInf.csv
1 2 * * * echo "Date,Login,IP,NivUrg" | tee fichier.csv /var/www/logs/journauxActvCreTck.csv
* * * * * sudo chmod -R 777 /var/www/logs
````
