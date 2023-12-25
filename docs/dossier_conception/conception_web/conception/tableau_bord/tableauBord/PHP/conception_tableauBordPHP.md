Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="/docs/img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3  Dossier de conception
</div>

<br><br><br><br><br><br><br>

- <b>Conception de la page tableauBord.html</b><br>
<br><br>
<u>Programmation PHP :</u>
<pre>
Lorsque le formulaire est validé :
- Vérification de la provenance des données du formulaire
    {
    Initialisation d'une arraylist et d'une requête SQL vide (string)
    - Pour chaque information du formulaire, vérification de la non-nullité des données du formulaire
        {
            Adaptation de la requête SQL pour la donnée en question
            Ajout dans une arraylist des paramètres concernant la donnée en question
        }
    Ajout dans le string représentant la requête SQL de la projection n'incluant que des tickets non-fermés.
    Execution de la requête préparée en utilisant la fonction executeSQL() avec pour paramètre l'arraylist et le string.
    Appel de la fonction tableGenerate() prenant en argument l'execution de la fonction executeSQL
    }
</pre>
