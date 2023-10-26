Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE, Matthieu FARANDJIS<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3  Dossier de conception
</div>

<br><br><br><br><br><br><br>

## Plan

### [I – Conception Architectural](#p1)
- <b>[Figure 1 : Diagramme des composants ](#fg1)</b>
### [II – Conception Détaillée](#p3)
- <b>[a) Conception de la page index.html ](#p1a)</b>
- <b>[b) Conception de la page connexion.html ](#p1b)</b>
- <b>[c) Conception de la page modifMdp.html ](#p1c)</b>
- <b>[d) Conception de la page inscription.html ](#p1d)</b>
- <b>[e) Conception de la page journalActivite.html ](#p1e)</b>
- <b>[f) Conception de la page modifEmail.html ](#p1f)</b>
- <b>[g) Conception de la page creerTicket.html ](#p1g)</b>
- <b>[h) Conception de la page profile.html ](#p1h)</b>
- <b>[i) Conception de la page historique.html ](#p1i)</b>
- <b>[j) Conception de la page tableauBord.html ](#p1j)</b>
- <b>[k) Conception de la page modificationTicket.html ](#p1k)</b>


<br><br><br><br><br><br><br>


------------------------------------------------------------------------------------------------------------------------
### <a name="p1"></a>I – Conception Détaillée
<br><br>


- <b><a name="p1a"></a>a) Conception de la page index.html</b><br>
<br><br>
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
<br><br>



- <b><a name="p1b"></a>b) Conception de la page connexion.html</b><br>
<br><br>
<pre>
La page connexion.html contient :
    Un 'div' représenant le bouton de retour à la page précédante.
    Un 'div' représentant le logo et le formulaire de connexion. Ce 'div' contient :
        Un 'form' représentant le formulaire de connexion.
</pre>
<br><br>



- <b><a name="p1c"></a>c) Conception de la page modifMdp.html</b><br>
<br><br>
<pre>
La page modifMDP.html contient :
    Un 'div' représenant le bouton de retour à la page précédante.
    Un 'div' représentant le logo et le formulaire de modification du mot de passe. Ce 'div' contient :
        Un 'form' représentant le formulaire de modification du mot de passe.
</pre>
<br><br>



- <b><a name="p1d"></a>d) Conception de la page inscription.html</b><br>
<br><br>
<pre>
La page inscription.html contient :
    Un 'div' représenant le bouton de retour à la page précédante.
    Un 'div' représentant le logo et le formulaire d'inscription. Ce 'div' contient :
        Un 'form' représentant le formulaire d'inscription.
</pre>
<br><br>



- <b><a name="p1e"></a>e) Conception de la page journalActivite.html</b><br>
<br><br>
<pre>
La page journalActivite.html contient :
    Un 'nav' représentant la barre de naviguation. Ce 'nav' contient :
        Un 'div' représenant le logo du site.
        Un 'div' représentant les pages index.html; tableauBord.html; journalActivite.html; historique.html.
        Un 'div' représentant le bouton d'accés au profil menant à profil.html.
    Un 'div' représentant les deux listes de journaux. Ce 'div' contient :
        Un 'div' représentant la liste des connexions infructueuses. Ce div contient :
            Un 'table' représentant le tableau des connexions.
        Un 'div' représentant la liste des tickets crées. Ce div contient :
            Un 'table' représentant le tableau des tickets.
    Un 'form' représentant le formulaire de télechargement des journaux.
</pre>
<br><br>



- <b><a name="p1f"></a>f) Conception de la page modifEmail.html</b><br>
<br><br>
<pre>
La page modifEmail.html contient :
    Un 'div' représenant le bouton de retour à la page précédante.
    Un 'div' représentant le logo et le formulaire de modification de l'email. Ce 'div' contient :
        Un 'form' représentant le formulaire de modification de l'email.
</pre>
<br><br>



- <b><a name="p1g"></a>g) Conception de la page creerTicket.html</b><br>
<br><br>
<pre>
La page creerTicket.html contient :
    Un 'div' représenant le bouton de retour à la page précédante.
    Un 'div' représentant le logo et le formulaire de création de tickets. Ce 'div' contient :
        Un 'form' représentant le formulaire de création de tickets.
</pre>
<br><br>



- <b><a name="p1h"></a>h) Conception de la page profile.html</b><br>
<br><br>
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
<br><br>



- <b><a name="p1i"></a>i) Conception de la page historique.html</b><br>
<br><br>
<pre>
La page historique.html contient :
    Un 'nav' représentant la barre de naviguation. Ce 'nav' contient :
        Un 'div' représenant le logo du site.
        Un 'div' représentant les pages index.html; tableauBord.html; journalActivite.html; historique.html.
        Un 'div' représentant le bouton d'accés au profil menant à profil.html.
    Un 'div' représentant la liste du contenu de l'historique. Ce 'div' contient :
        Un 'table' représentant le tableau de l'historique.
    Un 'form' représentant le formulaire de télechargement de l'historique.
</pre>
<br><br>



- <b><a name="p1j"></a>j) Conception de la page tableauBord.html</b><br>
<br><br>
<pre>
La page tableauBord.html contient :
    Un 'nav' représentant la barre de naviguation. Ce 'nav' contient :
        Un 'div' représenant le logo du site.
        Un 'div' représentant les pages index.html; tableauBord.html; journalActivite.html; historique.html.
        Un 'div' représentant le bouton d'accés au profil menant à profil.html.
    Un 'div' représentant les boutons de modification et de création de tickets.
    Un 'div' représentant la liste des tickets. Ce 'div' contient :
        Un 'table' représentant le tableau de bord.
    Un 'form' représentant le formulaire de recherche de tickets dans le tableau de bord.
</pre>
<br><br>



- <b><a name="p1k"></a>k) Conception de la page modificationTicket.html</b><br>
<br><br>
<pre>
La page modificationTicket.html contient :
    Un 'div' représenant le bouton de retour à la page précédante.
    Un 'div' représentant le logo et le formulaire de modification de tickets. Ce 'div' contient :
        Un 'form' représentant le formulaire de modification de tickets.
</pre>
<br><br>
------------------------------------------------------------------------------------------------------------------------
### <a name="p2"></a>I – Conception Architecturale
<br><br>

<img height="500" width="800" src="diagramme_composant.png" title="conception UML du site statique"/><br><br>
<i><a name="fg1"></a>Figure 1 : Diagramme de composants.</i>


La plateforme web est constitué de multiples pages (cf: spécification.md; les noms des pages de la plateforme web sont associés à leurs nom dans le dossier de spécification) :

    - index.html : La page "Page d'accueil".
    - connexion.html : La page "Page de réinitialisation de mot de passe (en maintenance)".
    - modifMdp.html : La page "Modification mot de passe".
    - incription.html : La page "Page d’inscription".
    - journalActivite.html : La page "Journal d’activité".
    - modifEmail.html : La page "Modification email".
    - creerTicket.html : La Page "Demande de dépannage".
    - profile.html : La page "Profil de l’utilisateur".
    - historique.html : La page "Historique des tickets".
    - tableauBord.html : La page "Tableau de bord ".
    - oublieMdp.html : La page "Oublie mot de passe".
    - modificationTicket.html : La page "Modification ticket".
    - logo.png : image du logo de l'application web.
    - fleche_retour.png : image de flèche de retour en arrière.
    - user.png : image de profil des utilisateurs.
    - logo_blanc.png : image du logo de l'application web en blanc.
    - logo_UVSQ.png : image du logo de l'UVSQ.
    - logo_sans_texte.png : image du logo de l'application web sans le texte.
