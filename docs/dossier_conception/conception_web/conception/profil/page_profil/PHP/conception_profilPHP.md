Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="/docs/img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3  Dossier de conception
</div>

- <b>Conception de la page profil.php<br>
<br><br>
<u>Programmation PHP :</u>
<pre>
Lors du chargement de la page :
Appel de la fonction pageAccess() prenant en paramètre une arraylist des rôles ayant accés à cette page (tous sauf visiteur).
</pre>
<pre>
Lorsque le bouton de déconnexion est préssé, on active la page d'action action_deconnexion.php :
Ouverture session
Suppression des données de la session
Fermeture de la session
</pre>
<pre>
Le 'div' représentant le profil contient des informations dynamiques, ce div est conçu ainsi :
Balises 'table' et 'tbody'
{
    Réccupération des données à afficher avec la fonction executeSQL()
    Boucle affichant chaque ligne du tableau (de 0 à 4)
    Initialisation de la constante INDEX étant une array contenant les premières données des lignes.
    {
        Balise 'tr'
        {
            Balise 'td'
            {
                Elément d'INDEX
            }
            Balise 'td'
            {
                Elément de la requête SQL
            }
            - Si l'itération de la boucle est de 2 ou 4
            {
                Balise 'td'
                {
                    Bouton de modification
                }
            }
        }
    }
}
</pre>
<pre>
Le 'div' contenant les tickets de l'utilisateur est constitué ainsi :
Appel de la fonction executeSQL(), de façon à réccupérer les tickets de l'utilisateur avec les informations (Date, Titre, Description, Etat).
Une balise 'table'.
Appel de la fonction tableGenerate(), prenant en paramètre le résultat d'executeSQL().
</pre>
