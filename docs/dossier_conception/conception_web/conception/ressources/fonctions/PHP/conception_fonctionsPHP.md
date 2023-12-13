Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="/docs/img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3  Dossier de conception
</div>

- <b>Recueil de fonctions<br>
<br><br>

#### <i>x = executeSQL(a, b, c)</i>
<pre>
Préparation de la requete sous la forme d'une requête préparé et envoie de cette dernière à la base de données.
    
x : Faux -> sur une erreur
    objet mysqli_result -> résultat de la requête (pour SELECT, SHOW, DESCRIBE or EXPLAIN)
a : str (Requête mySQL sous la forme d'une requête préparé avec des '?')
b : arraylist (Tableau des valeurs à inérer dans la requête dans l'ordre)
c : mysqli (Objet relatif à la connexion à la base de données)
</pre>
#### <i>x = newUser(a, b)</i>
<pre>
Création d'un nouvel utilisateur MariaDB, puis don de ses droits.
Si la fonction s'exécute correctement x = True. Sinon x = False.

x : bool (Définie l'état de la création de l'utilisateur)
a : str (Correspond au login entré)
b : str (Correspond au mot de passe entré)
</pre>
#### <i>x = valideMDP(a)</i>
<pre>
Vérifiaction de l'identité du mot de passe et de la confirmation du mot de passe. Vérification que le mot de passe respecte les normes de sécurité.
Si le mot de passe respecte les conditions de sécurité x = 1 si c'est bon, une autre valeur si ce n'est pas bon.

x : int (Définie la validité du mot de passe + l'erreur correspondante)
    1 -> MDP OK
    0 -> MDP KO : taille (inférieur à 12 ou supérieur à 32)
    -1 -> MDP KO : manque une majuscule
    -2 -> MDP KO : manque une minuscule
    -3 -> MDP KO : manque un chiffre
    -4 -> MDP KO : manque un caractère spécial
a : str (Correspond au mot de passe entré)

</pre>
#### <i>x = connectUser(a, b)</i>
<pre>
Tentative de connexion à la base de données avec l'identifiant de l'utilisateur et son mot de passe.
Si la connexion réussit, une session est créer et x = True. Sinon x = False.

x : bool (Définie l'état de la connexion à la base)
a : str (Correspond au login entré)
b : str (Correspond au mot de passe entré)
</pre>
#### <i>x = pageAccess(a)</i>
<pre>
Tente une connexion à la base de données avec les informations de sessions de kl'utilisateur puis vérifie le rôle de l'utilisateur, et le redirige vers une page adapté à son niveau de droit.
Renvoie la connxion si l'utilisateur est autorisé à accéder à cette page.

a : arraylist (liste des rôles pouvant accéder à la page en question)
x : mysqli | false (connexion à la base de données)
</pre>
#### <i>x = recupererRoleDe(a)</i>
<pre>
Renvoie le rôle de l'utilisateur sous la forme d'un string.

a : mysqli (connexion à la base de données)
x : string (Nom du rôle de l'individu se connectant)
</pre>
#### <i>x = tableGenerate(a)</i>
<pre>
Présente sous forme d'un tableau HTML (sans balises 'table') le résultat d'une requête MySQL de type SELECT.

a : mysqli_result (Le resultat d'une commande sql)
x : void
</pre>
#### <i>x = valideEMAIL(a)</i>
<pre>
Vérifiaction que l'email en paramètre est un email valide/possible.

a : string (Email entrée par l'utilisateur)
x : bool (Définie la validité de l'email entré)
</pre>
#### <i>x = operationCAPTCHA()</i>
<pre>
Affiche un champs de formualire pour le captcha, indique dans ce champs un calcul aléatoire et inscrit le résultat de ce calcul dans le fichier de session.

x : void
</pre>
#### <i>x = libelleGenerate()</i>
<pre>

x : void
</pre>
#### <i>x = libelleUpdate()</i>
<pre>

x : void
</pre>
#### <i>x = deconnexionSite()</i>
<pre>

x : void
</pre>
#### <i>x = affichageMenuDuHaut()</i>
<pre>

x : void
</pre>
#### <i>x = dechiffre()</i>
<pre>

x : void
</pre>
#### <i>x = miseAJourJeton()</i>
<pre>

x : void
</pre>
#### <i>x = vetifJeton()</i>
<pre>

x : void
</pre>
