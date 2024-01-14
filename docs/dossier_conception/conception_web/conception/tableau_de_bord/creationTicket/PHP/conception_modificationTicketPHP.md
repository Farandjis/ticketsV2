Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="/docs/img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3  Dossier de conception
</div>

<br><br><br><br><br><br><br>

- <b>Conception de la page ModificationTicket.html</b><br>
<br><br>
<u>Programmation PHP :</u>
<pre>
Vérification de l'autorisation à l'accés à la page avec la fonction pageAccess().
Réccupération des informations du ticket sur la base de données avec executeSQL().
Vérification si l'utilisateur à le droit de modifier le ticket.
Réccupération de l'id, du prénom et du nom de l'utilisateur actuel.
Affichage d'un message d'erreur en fonction de l'id d'erreur rerçue.

Affichage de l'id, du prénom et du nom du créateur du ticket.
Affichage de l'état du ticket, de sa date de création et de sa date de dernière modification.
Affichage du menu déroulant checkbox des titres avec menuDeroulant().
Affichage de la description du ticket dans un textarea.


- Si l'utilisateur peut modifier le niveau d'urgence estimé.
    {
    Réccupération des niveaux d'urgences dans la base de données.
    Appel de la fonction menuDeroulant() pour afficher la liste des niveaux d'urgences.
    }
    Sinon
    {
    Afficher le niveau d'urgence estimé du ticket.
    }
- Si l'utilisateur est Administrateur web.
    {
    Réccupération des niveaux d'urgences dans la base de données.
    Appel de la fonction menuDeroulant() pour afficher la liste des niveaux d'urgences.
    }
    Sinon
    {
    Afficher le niveau d'urgence définitif du ticket.
    }
- Si l'utilisateur est Administrateur web.
    {
    Réccupération des techniciens dans la base de données.
    Affichage des techniciens dans une checkbox.
    }
    Sinon
    {
    Afficher le technicien du ticket.
    }
Affichage du nombre de mots clées séléctionnés.
Réccupération des mots clés dans la base de données.
Affichage des mots clés avec menuDeroulant().
- Si l'utilisateur est l'Administrateur web ou un technicien
    {
    - Si le ticket peut être fermé.
        {
        Afficher le bouton pour fermé le ticket.    
        }
    }
</pre>
