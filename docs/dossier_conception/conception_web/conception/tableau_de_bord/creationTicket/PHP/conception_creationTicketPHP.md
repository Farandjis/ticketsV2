Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="/docs/img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3  Dossier de conception
</div>

<br><br><br><br><br><br><br>

- <b>Conception de la page creerTicket.html</b><br>
<br><br>
<u>Programmation PHP :</u>
<pre>
Vérification de l'autorisation à l'accés à la page avec la fonction pageAccess().
Appel de la fonction libelleGenerate() au niveau de la liste des libéllés.
</pre>
<pre>
Lorsque le formulaire est validé (redirection vers action_creerTicket.php):
- Vérification de la provenance des données du formulaire
    {
    Initialisation d'une array contenant les données du formulaire (sauf les libéllés).
    Appel de la fonction executeSQL() qui prend l'array ci-dessus en paramètre.
    Appel de la fonction executeSQL() qui renvoie l'id du dernier ticket créer par l'utilsateur actuellement connécté (en fonction de son login).
    Appel de la fonction libelleUpdate() aui prend l'id du ticket en paramètre.
</pre>
