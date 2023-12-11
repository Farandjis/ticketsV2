Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="/docs/img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3  Dossier de conception
</div>

- <b>Conception de la page modifEmail.html<br>
<br><br>
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
