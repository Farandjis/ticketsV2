Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Plan de travail prévu

<br><br>
Ce document explique la façon dont nous pensons nous organiser dans le cadre de cette SAÉ.

</div>

<br><br><br><br><br><br><br>

## Plan
### [I – Déroulement prévu du projet](#p1)
### [II - Priorités](#p2)
### [III - Répartition des tâches](#p3)

<br><br><br><br><br><br><br>

###  <a name="p1"></a>I – Déroulement prévu du projet 

<br><br>

<b>Voici une approximation de l'ordre du déroulement du projet : </b>

- <u>Création du cahier des charges :<br></u>
  -> rendu : semaine du 2 octobre 2023?

- <u>Création du logo et de son argumentaire :<br></u>
	-> rendu : semaine du 9 octobre?<br>
	-> en parallèle de la création du cahier des charges?

- <u>Conception de la maquette Web :<br></u>
	-> rendu : semaine du 9 octobre (ou avant).<br>
	-> dès la fin du cahier des charges.

- <u>Création des pages web statique :<br></u>
	-> rendu : semaine du 9 octobre.<br>
	-> dès la fin de la conception de la maquette.

- <u>Vérification des pages via le validateur W3C (HTML et CSS) :<br></u>
	-> durant la création des pages.<br>
	-> vérification générale à la fin de la création des pages.

- <u>Vérification des pages sur le critère d’accessibilité :<br></u>
	-> durant la création des pages.<br>
	-> vérification générale à la fin de la création des pages.

- <u>Début de la création du dossier :<br></u>
	-> dès le début de l’installation du serveur.

- <u>Installation du serveur sur le Raspberry Pi :<br></u>
	-> rendu : semaine du 23 octobre.

- <u>Conception de la partie dynamique de l'application :<br></u>
	-> dès la fin de la création des pages web statique.<br>
	-> en parallèle de l’installation du serveur.

- <u>Conception de la base de données :<br></u>
	-> en parallèle de la conception de la partie dynamique.

- <u>Création de la base de données :<br></u>
	-> à la fin de la conception de la BDD.

- <u>Création des pages web dynamique :<br></u>
	-> dès la fin de la création de la BDD.

- <u>Vérification de nouveau des pages via le validateur W3C (HTML et CSS) :<br></u>
	-> durant la création des pages.<br>
	-> vérification générale à la fin de la création des pages.

- <u>Vérification de nouveau des pages sur le critère d’accessibilité :<br></u>
	-> durant la création des pages.<br>
	-> vérification générale à la fin de la création des pages.

- <u>Vérification que tout fonctionne, on repasse les tests :<br></u>
	-> vérification générale à la fin de la création des pages.<br>
	-> On vérifie qu’on ne peut pas faire d’injection SQL par exemple.

- <u>Fin de la création du dossier :<br></u>
	-> rendu : janvier 2024.

- <u>Création et montage de la vidéo explicative :<br></u>
	-> rendu avec l’application, en janvier 2024.<br>
	-> dès que l’appli a été terminer d’être créer.

<br><br>

Nous aurons des devoirs supplémentaires à rendre durant cette SAÉ. Notamment de novembre à janvier : 

- Organisation de nos sprints pour la mise en place des modules de l’application.

- Exposé de présentation de l’application en anglais.

- Travail à remettre dans le cadre des ressources de probas-stats, de sécurité (cryptographie), de RGPD, de gestion de projet (risques).

<br>

De plus, nous aurons 2 points bilan de notre avancé sur la SAÉ.

<br>
De manière plus précise, les tâches seront réparties en semaine sur l'image planning.img de la branche planning_devblog (dans docs/planning_devblog).<br>
Ce planning est régulièrement modifié et suit l'évolution du projet.
Dans ce même répertoire, il y a l'organisation prévue du dépôt git ce qui permet de nous donner une idée du déroulement des tâches.

<br>

<br><br><br><br>

### <a name="p2"></a>II - Priorités 

<br><br>

<b>Toutes les tâches décrite plus tôt doivent être faite, cependant, nous pouvons leur donner un ordre d’importance :  </b>

<br>

- Création du cahier des charges, pour mieux cerner l’enjeu du problème. 

- Installer le serveur s'avère être la tâche la plus importante. Sans cela, il est impossible de faire un site internet dynamique avec PHP et MySQL. 

- Il est également très important de concevoir ce que nous allons faire. Que ce soit la base de données, ou l’application web. 
Non seulement cela permet de coordonner le travail de chaque membre du groupe, mais en plus, cela permet d’être certain de l’harmonisation des données, des pages au sein de l’application. 

- Pour pouvoir se lancer dans le développement en PHP, il est indispensable d’avoir une base de données fonctionnelle dès le début du développement. Sans cela, il nous sera compliqué de stocker et de récupérer les données. 

- Le PHP est obligatoire pour pouvoir faire une application satisfaisant notre client. La création de ces pages est une obligation absolue et une priorité dès qu’il est possible de le faire. 

- Vérification que l’application est parfaitement fonctionnelle et qu’il n’y a pas de bug. 

- Vérification des critères d’accessibilité. 
Il est important de vérifier que notre application convient à tous les handicape, et ce n’est pas quelque chose à oublier. Cependant même sans l’application reste fonctionnelle pour la plupart des personnes. 

<br>

Dans tous les cas, sur le planning, les fichiers à rendre et leur date de rendu est marqué en rouge, et les tâches à terminer absolument avant une certaine date sont marqués en orange.<br>

<br>

Les autres tâches doivent respecter leur date de rendu, cependant elles n’interviennent pas dans le fonctionnement de l’application. L’application est l’enjeu de notre devoir. 

<br><br><br><br>

### <a name="p3"></a>III - Répartition des tâches

<br><br>

Nous essayons au maximum que chacun puisse s’investir dans les différentes tâches et que la quantité de travail soit égale entre nous.<br>
Cependant, nous pensons diviser les grandes tâches pour se les répartir par groupe de 2 afin de maximiser l’utilisation de nos points fort. Dans tous les cas, chaque membre se doit de s’intéresser au travail des autres membres.<br>
<br>
Le chef de projet prendra compte des préférences de ses collègues lors de l'assignation des tâches.<br>
Cependant, des tâches peuvent être attribuées même si cela ne plaît pas à la personne.<br>
Dans tous les cas, le chef de projet suit l'avancer de chaque membre et le fichier de maintenance permet d'en garder une trace.<br> 



<br><br>

<b>Qui se propose à faire quoi : </b>

- <u>Florent : </u>

      Algorithime (PHP, R ...), rédaction de textes. 

- <u>Tom : </u>

      Développement en langage de balisage (HTML, CSS), conception (logo, maquette).

- <u>Assia : </u>

      Développement (HTML), communication (logo), anglais.

- <u>Enzo : </u>

      Développement web (HTML, CSS, PHP), base de données (SQL).

- <u>Matthieu : </u>

      Développement (PHP par exemple), base de données (SQL), création de vidéo.
