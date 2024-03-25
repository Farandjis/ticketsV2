Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="/docs/img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3  Dossier de conception
</div>
<br><br>
- <b>Conception de la page index.html</b><br>
<br><br>
<u>Programmation HTML :</u>
<pre>
La page index.html contient :
    Un 'nav' représentant la barre de naviguation. Ce 'nav' contient :
        Un 'div' représenant le logo du site.
        Un 'div' représentant les pages index.html; tableauBord.html; journalActivite.html; historique.html.
        Un 'div' représentant les boutons d'authentification menant vers connexion.html; incription.html; profil.html.
    Un 'section' représentant la partie présentation de la page. Ce 'section' contient :
        Un 'div' représentant le texte de présentation du site.
        Un 'div' représentant la vidéo de présentation du site.
    Un 'section' représentant la liste des dix derniers tickets. Ce 'section' contient :
        Un 'table' représentant le tableau contenant le tableau des tickets.
</pre>

<u>Programmation PHP :</u>
<pre>
Le 'div' contenant les 10 derniers tickets est constitué ainsi :
Appel de la fonction executeSQL(), de façon à réccupérer les 10 derniers tickets avec les informations.
Une balise 'table'.
Appel de la fonction tableGenerate(), prenant en paramètre le résultat d'executeSQL().
</pre>
<br><br>
- <b>Conception de la page modifEmail.html<br>
<br><br>
<u>Programmation HTML :</u>
<pre>
La page modifEmail.html contient :
    Un 'div' représenant le bouton de retour à la page précédante.
    Un 'div' représentant le logo et le formulaire de modification de l'email. Ce 'div' contient :
        Un 'form' représentant le formulaire de modification de l'email.
</pre>

<u>Programmation PHP :</u>
<pre>
Lors du chargement de la page :
Appel de la fonction pageAccess() prenant en paramètre une arraylist des rôles ayant accés à cette page (tous sauf visiteur).
</pre>
<pre>
Lors de la validation du formulaire, les données de ce dernier sont envoyés vers la page d'action action_modifEmail.php :
- Vérification de la provenance des valeurs et de leur non nullité
{
        Lancement de la requête avec la fonction executeSQL()
        Redirection profil.php avec un id 
}
Redirection profil.php avec un id
</pre>
<br><br>
- <b>Conception de la page modifMdp.html<br>
<br><br>
<u>Programmation HTML :</u>
<pre>
La page modifMDP.html contient :
    Un 'div' représenant le bouton de retour à la page précédante.
    Un 'div' représentant le logo et le formulaire de modification du mot de passe. Ce 'div' contient :
        Un 'form' représentant le formulaire de modification du mot de passe.
</pre>
<u>Programmation PHP :</u>
<pre>
Lors du chargement de la page :
Appel de la fonction pageAccess() prenant en paramètre une arraylist des rôles ayant accés à cette page (tous sauf visiteur).
</pre>
<pre>
Lors de la validation du formulaire, les données de ce dernier sont envoyés vers la page d'action action_modifMDP.php :
- Vérification de la provenance des valeurs et de leur non nullité
{
    - Vérification de la conformité du format du mot de passe avec la fonction valideMDP()
    {
        Lancement de la requête avec la fonction executeSQL()
        Redirection profil.php avec un id
    }
    Redirection profil.php avec un id
}
Redirection profil.php avec un id
</pre>
<br><br>
- <b>Conception de la page profile.html<br>
<br><br>
<u>Programmation HTML :</u>
<pre>
La page profile.html contient :
    Un 'nav' représentant la barre de naviguation. Ce 'nav' contient :
        Un 'div' représenant le logo du site.
        Un 'div' représentant les pages index.html; tableauBord.html; journalActivite.html; historique.html.
        Un 'div' représentant le bouton de déconnexion.
    Un 'div' représentant la liste d'information du profil et la liste des tickets du profil. Ce 'div' contient :
        Un 'div' représentant la liste d'information du profil. Ce div contient :
            Un 'table' représentant le tableau des informations.
        Un 'div' représentant la liste des tickets du profil. Ce div contient :
            Un 'table' représentant le tableau des tickets.
</pre>
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
