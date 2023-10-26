Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3  Spécification
</div>


# Les pages :
- [Page d'accueil](#p1)
- [Page d'inscription](#p2)
- [Page de connexion](#p3)
- [Page de demande de dépannage](#p4)
- [Profil de l’utilisateur](#p5)
- [Tableau de bord](#p6)
- [Journal d’activité](#p7)
- [Historique des tickets](#p8)
- [Modification mot de passe](#p9)
- [Modification email](#p10)
- [Modification ticket](#p11)
------

<h3><a name="p1"></a> Page d'accueil</h3></br>
La page contient :

- Une présentation textuelle de l’application 
- Une vidéo explicative de son utilisation 
- Les 10 dernières demandes de dépannage 
- Un bouton de connexion (Page de connexion)
- Un bouton d'inscription (Page d'inscription)
- Une barre de navigation(Page d'accueil,Tableau de bord, Historique des tickets, Journal d'activités)
- Un lien vers le profil (Profil de l'utilisateur)

Lorsque le bouton de validation est préssé, les informations entrées dans les champs du formulaire sont vérifiées :
	- nom : null
	- prénom : null
	- email : Doit contenir le caractère '@' et se finir par un nom de domaine Internet (exemple : 'gmail.com')
	- mot de passe : Devra contenir 12 caractères minimum. Au moins une lettre minuscule, une majuscule, un caractère spécial et un chiffre.
	- login :  Son unicité sera vérifié.
	- captcha : null

Le bouton de validation crée une session, connecte l'utilisateur à sa session et le renvoie sur le tableau de bord.



</br></br></br>
<h3><a name="p2"></a>Page d'inscription</h3></br>
La page contient un formulaire (nom, prénom, email, mot de passe, login, captcha), un bouton de validation ainsi qu'un bouton de retour arrière (Page d'accueil).

</br></br></br>
<h3><a name="p3"></a>Page de connexion</h3></br>
La page contient un formulaire (mot de passe, login), un bouton de validation, deux lien (Page de connexion et Page de réinitialisation de mot de passe) ainsi qu'un bouton de retour arrière (Page d'accueil).

Quand le bouton de validation est préssé, le mot de passe et le login sont vérifiés.
Le bouton de validation connecte l'utilisateur à sa session et le renvoie sur la page "Tableau de bord".



</br></br></br>
<h3><a name="p4"></a>Page de demande de dépannage</h3></br>
La page contient un formulaire (libellé, Niveau d’urgence estimé, description) ainsi qu'un bouton de retour en arrière (Tableau de bord) et un bouton de validation.



</br></br></br>
<h3><a name="p5"></a>Profil de l’utilisateur</h3></br>
La page contient :

- Les informations de l'utilisateur (login, email, nom, prénom)
- Deux liens (Modification email, Modification mot de passe)
- Les demandes de dépannages de l'utilisateurs 
- Une barre de navigation(Page d'accueil,Tableau de bord, Historique des tickets, Journal d'activités)

Les informations de l'utilisateur s'affichent dynamiquement dans son tableau.
Les demandes de dépannages s'affichent dynamiquement dans son tableau. 



</br></br></br>
<h3><a name="p6"></a>Tableau de bord</h3></br>
La page contient :

- L'ensemble des tickets ouverts
- Un bouton de modification (Modification de ticket)
- Un bouton de création (Page de demande de dépannage)
- Un formulaire de recherche de tickets
- Une barre de navigation(Page d'accueil,Tableau de bord, Historique des tickets, Journal d'activités)
- Un lien vers le profil (Profil de l'utilisateur)



</br></br></br>
<h3><a name="p7"></a>Journal d’activité</h3></br>
La page contient :

- L'ensemble des demandes de dépannages
- L'ensemble des connexions infructueuses
- Un formulaire de téléchargement des journaux
- Une barre de navigation(Page d'accueil,Tableau de bord, Historique des tickets, Journal d'activités)
- Un lien vers le profil (Profil de l'utilisateur)



</br></br></br>
<h3><a name="p8"></a>Historique des tickets </h3></br>
La page contient :

- L'ensemble des tickets fermés
- Un bouton de téléchargement de l'historique
- Une barre de navigation(Page d'accueil,Tableau de bord, Historique des tickets, Journal d'activités)
- Un lien vers le profil (Profil de l'utilisateur)



</br></br></br>
<h3><a name="p9"></a>Modification mot de passe</h3></br>
La page contient un formulaire (mot de passe, nouveau mot de passe, confirmation nouveau mot de passe) ainsi qu'un bouton de retour en arrière (Profil de l'utilisateur) et un bouton de validation.

Quand le bouton de validation est préssé :
	- Le nouveau mot de passe et la confirmation du nouveau mot de passe doivent être identique et respecter les normes du mot de passe citées dans "Page d'inscription".
	- Le mot de passe est vérifié.

Le bouton de validation modifie le mot de passe puis renvoie l'utilisateur sur la page "Profil de l’utilisateur".


</br></br></br>
<h3><a name="p10"></a>Modification email</h3></br>
La page contient un formulaire (mot de passe, nouveau email) ainsi qu'un bouton de retour en arrière (Profil de l'utilisateur) et un bouton de validation.

Quand le bouton de validation est préssé :
	- Le nouvel email doit respecter les normes de l'email citées dans "Page d'inscription".
	- Le mot de passe est vérifié.
Le bouton de validation modifie l'email puis renvoie l'utilisateur sur la page "Profil de l’utilisateur".



</br></br></br>
<h3><a name="p11"></a>Modification ticket</h3></br>
La page contient un formulaire (libellé, Niveau d’urgence définitif, description,technicien affecté), les informations du tickets ainsi qu'un bouton de retour en arrière (Tableau de bord) et un bouton de validation.
