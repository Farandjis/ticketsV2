<?php

// Info BDD

require (dirname(__FILE__) . "/../info_db/connexion_db.php");
require (dirname(__FILE__) . "/../info_db/user_fictif.php");

$empSite = "/sitefteam";

function connectUser($loginMariaDB, $loginSite, $mdpMariaDB){
    /**
     * Connecte l'utilisateur à la base de données et lui crée sa session.
     *
     * @param string $loginMariaDB L'id de l'utilisateur.
     * @param string $loginSite Le login utilisé lors de la correction de l'utilisateur
     * @param string $mdpMariaDB Le mot de passe de l'utilisateur.
     * @return bool Retourne True si la connexion réussit. False sinon.
     */
    global $host, $database, $USER_FICTIF_MDP;
    
    
    
    // Vérifie si l'utilisateur existe dans la base de données
    if ($loginMariaDB) { // true si le $loginMariaDB contient quelque chose

        // Connexion à la base de données en tant que l'utilisateur
        $connexionUtilisateur = mysqli_connect($host, $loginMariaDB, $mdpMariaDB, $database);

        // Vérifie si la connexion a été établie (donc que le mdp est valide (et l'id aussi, mais normalement ça c'est OK))
        if ($connexionUtilisateur) {

            // On récupère l'adresse IP de l'utilisateur
            $ipUtilisateur = gethostbyname($_SERVER['REMOTE_ADDR']);

            // Récupère la date et l'heure à laquelle l'utilisateur s'est connecté la dernière fois
            $dateConnexion = date('Y-m-d H:i:s');

	       $connectionUserFictifConnexion = mysqli_connect($host, 'fictif_connexionDB', $USER_FICTIF_MDP['fictif_connexionDB'], $database);

	
            // On met à jour les colonnes liées à la dernière connexion et l'IP du serveur de l'utilisateur
          
            $arguments = array($dateConnexion, $ipUtilisateur, $loginMariaDB);
            executeSQL("UPDATE UserFictif_maj_derniere_co SET HORODATAGE_DERNIERE_CONNECTION_USER = ?, IP_DERNIERE_CONNECTION_USER = ? WHERE ID_USER = ?",$arguments,$connectionUserFictifConnexion); // Insère des infos sur la connexion de l'utilisateur

            // On démarre la session
            session_start();
            $_SESSION['login'] = $loginSite;
            $_SESSION['mdp'] = $mdpMariaDB;

            return true;
        }
    }
    return false;
}

function executeSQL($reqSQL,$params,$connection){
    /**
     * Insère une commande SQL préparée dans la base de données.
     *
     * @param string $reqSQL - La requete SQL.
     * @param array $params - La liste des paramètres de la requete.
     * @param mysqli $connection - La connexion à la base de données.
     * @return void
     */
    $CONST_TYPE = array("integer" => 'i', "string" => 's', "boolean" => 'b', "double" => 'd');
    
    $reqSQLPre = mysqli_prepare($connection,$reqSQL); // On prépare la requête
    $argsCommandePHP = array($reqSQLPre,''); // liste des arguments de la fonction mysqli_stmt_bind_param
    
    $typeParams = "";

    
    for ($i = 0 ; $i < count($params) ; $i++){
    	$params[$i] = htmlspecialchars($params[$i]); // On protège chaque paramètre

	$argsCommandePHP[$i + 2] = &$params[$i]; // On l'insère à la suite des arguments pour la fonction mysqli_stmt_bind_param
        $typeParams = $typeParams . $CONST_TYPE[gettype(htmlspecialchars($params[$i]))]; // On stock le type du paramètre

    }
    $argsCommandePHP[1] = $typeParams; // On indique le type des paramètres précédements protégés


    call_user_func_array('mysqli_stmt_bind_param',$argsCommandePHP); // On appel la fonction mysqli_stmt_bind_param avec nos arguments
    //call_user_func_array('mysqli_stmt_bind_param',array($reqSQLPre, $typeParams, &$paramsCommandePHP[2]));


    mysqli_stmt_execute($reqSQLPre); // On l'execute

    return mysqli_stmt_get_result($reqSQLPre); // On renvoie le résultat de la requête SQL

}


function valideMDP($mdp){
    /**
     * Vérifie la solidité du mot de passe.
     *
     * @param string $mdp Le mot de passe à valider.
     * @return int Retourne 1 si le mot de passe est valide. 0 si pb taille, -1 à -4 si pb caractère (voir les commentaires)
     */
    if (strlen($mdp) >= 12 and strlen($mdp) <= 32) { // entre 12 et 32 caractères compris uniquement
        if (preg_match('/[A-Z]/', $mdp)) { // doit contenir au moins une majuscule
            if (preg_match('/[a-z]/', $mdp)) { // doit contenir au moins une minuscule
                if (preg_match('/[0-9]/', $mdp)) { // doit contenir au moins un chiffre
                    if (preg_match('/[^a-zA-Z0-9]/', $mdp)) { // doit contenur un caractère spécial
                        return 1; // mdp valide
                    } else { return -4; } // manque caractère spécial
                } else { return -3; } // manque chiffre
            } else { return -2; } // manque min
        } else { return -1; } // manque maj
    } else { return 0; } // pb taille
}

function recupererRoleDe($connexion){
    /**
     * Récupère le rôle associé à l'utilisateur
     * @param string $utilisateur - La connexion à la base de donnée
     * @return string - Le rôle de l'utilisateur associé à la connexion
     */

     $rolebrute = mysqli_fetch_row(mysqli_query($connexion, "SELECT CURRENT_ROLE();"))[0];

     if ($rolebrute == 'role_utilisateur') { return "Utilisateur"; }
     else if ($rolebrute == 'role_technicien') { return "Technicien"; }
     else if ($rolebrute == 'role_admin_web') { return "Administrateur Site"; }
     else if ($rolebrute == 'role_admin_sys') { return "Administrateur Système"; }
     else if ($rolebrute == NULL) { return "Rôle manquant"; }
     else { return "Rôle inconnu"; }
}

function tableGenerate($getResultSQL, $attributEnPlusPourLesLignes = ""){
    /**
     * Présente sous forme d'un tableau HTML (sans balises <table>) le résultat d'une requête MySQL de type SELECT.
     *
     * @param mysqli_result $getResultSQL - le mysqli_stmt_get_result de l'exécution de la requête, le tableau sera généré là dessus.
     * @param string $attributEnPlusPourLesLignes - (optionnel) attributs supplémentaire pour les balises <tr>
     * @return void
     */

    $id = 1;
    while($enregistrements = mysqli_fetch_row($getResultSQL)){
        echo "<tr id=$id $attributEnPlusPourLesLignes>";
        for ($noAttributRes = 0; $noAttributRes < count($enregistrements); $noAttributRes++){
            echo '<td>' . $enregistrements[$noAttributRes] . '</td>';
        }
        echo '</tr>';
        $id++;
    }
}

function valideEMAIL($email){
    /**
     * Test de la validité de l'adresse email
     * @param $email -> Email dont on va vérifier sa conformité
     * @return bool  -> True si valide, false sinon
     */

    if (! filter_var($email, FILTER_VALIDATE_EMAIL)){
        // Fonction de base vérifiant le format
        return false;
    }
    elseif (substr($email, -2, 1) == "."){
        // S'il y a un point à l'avant dernier caractère, cela veut dire que le DNS est trop court (1 caractère)
        return false;
    }
    elseif (!strpos(substr($email, -6, 6), ".")){
        // S'il n'y a pas de point sur les 4 derniers caractères, alors le DNS est trop long (plus de 4 caractères).
        // Remarque +2 car il doit vérifier que dans la chaîne il y ai un point et un caractère avant le point (je ne sais pas pourquoi)
        // ex : o.frrr  ou oo.frr -> ok (il y a le . et un caractère avant)
        // ex : .frrrr -> ko (absence de caractère avant le .)
        // ex : frrrrr -> ko (pas de .)
        return false;
    }
    else {
        return true;
    }
}


function operationCAPTCHA()
{
    $chiffre1 = rand(0, 20);
    $chiffre2 = rand(0, 20);
    $operateur = "+";

    $_SESSION['chiffre1'] = $chiffre1;
    $_SESSION['chiffre2'] = $chiffre2;
    $_SESSION['operateur'] = $operateur;

    $calcul = strval($_SESSION['chiffre1']) . $_SESSION['operateur'] . strval($_SESSION['chiffre2']);
    echo "<input id='captcha' type='text' name ='captcha' placeholder=$calcul>";
}

function verifyCAPTCHA($reponseUtilisateur, $chiffre1, $chiffre2){
    return ($reponseUtilisateur == ($chiffre1 + $chiffre2));
}
function dechiffre($mdpchiffre){
    /**
     * Cette fonction ne déchiffre rien pour le moment.
     */
    return $mdpchiffre;
}

function miseAJourJeton($loginSite, $mdpMariaDBClair){
    /**
     * Fonction par encore conçus et non utilisé.
     * L'idée serait de redonner du temps avant l'expiration de la session de l'Utilisateur.
     * Pour cela, on remet à jour le jeton associé à la connexion et placé dans un endroit dans la BD dédié aux connexions par ex.
     * Donc on rechiffre le mdp et on remet à jour le fichier session aussi.
     *
     */
    return;
}

function verifJeton(){
    /**
     * Fonction qui testera si la connexion de l'utilisateur a expiré ou pas
     * renvoi true si à jour
     * renvoi false si dépassé
     */
    return true;
}

function pageAccess($listeDesRolesAutoriser){
    /**
     * Récupère, déchiffre et vérifie le login et le mot de passe puis tente une connexion à la base de données avec ces informations.
     * Il vérifie le jeton puis par la suite le rôle de l'utilisateur.
     * S'il y a les informations nécessaire et les droits d'accès à la page, la fonction renvoi sa connexion mysqlMariaDB, false sinon
     *
     * Renvoie la connxion si l'utilisateur est autorisé à accéder à cette page.
     *
     * ATTENTION ! CETTE FONCTION UTILISE DES FONCTIONS PAS ENCORE CRÉES QUI RENVOIENT DES RÉPONSES BATEAUX (valide par défaut)
     *
     * @param array $listeDesRolesAutoriser -> Liste des rôles qui sont autorisés à accéder à la page
     * @return mysqli -> Succès de l'accès à la page
     * @return false  -> Echec de l'accès à la page
     */

    global $USER_FICTIF_MDP, $database, $host, $empSite;
    session_start();

    try {
        if (isset($_SESSION['login'], $_SESSION['mdp'])) {
            // Vérifie que le login et le mot de passe est bien définit

            if (!empty($_SESSION['login']) && !empty($_SESSION['mdp'])) {
                // Vérifie que ce n'est pas vide


                // VÉRIFICATION DE LA VALIDITÉ DU JETON
                if (!verifJeton()) {
                    deconnexionSite();
                    header("Location: " . $empSite . "/authentification/connexion.php?id=7"); // erreur : le jeton de connexion a expiré
                    session_abort();
                    return false;
                }


                // RECUPERATION DES DONNEES DU COOKIE SESSION
                $loginSite = htmlspecialchars(htmlspecialchars_decode($_SESSION['login']));
                $mdpMariaDB = htmlspecialchars(htmlspecialchars_decode(dechiffre($_SESSION['mdp']))); // On vire le htmlspecialchars d'avant pour le refaire (mesure de protection)


                // RECUPERATION DE L'ID_USER DE L'UTILISATEUR PAR RAPPORT A SON LOGIN
                $connexionUFConnect = mysqli_connect($host, 'fictif_connexionDB', $USER_FICTIF_MDP['fictif_connexionDB'], $database);
                $resSQL = mysqli_fetch_row(executeSQL("SELECT ID_USER FROM UserFictif_connexion WHERE login_user = ?", array($loginSite), $connexionUFConnect));
                mysqli_close($connexionUFConnect);

                if ($resSQL === null) {
                    return false;
                } // Mauvais login (la requête SQL n'a rien renvoyé)
                else {
                    $loginMariaDB = $resSQL[0];
                } // On récupère l'ID_USER qui est le login MariaDB.


                // TENTATIVE DE CONNEXION DE L'UTILISATEUR A LA BASE DE DONNEES
                $connexionUtilisateur = mysqli_connect($host, $loginMariaDB, $mdpMariaDB, $database);
                if ($connexionUtilisateur) {
                    // CONNEXION DE L'UTILISATEUR A LA PLATEFORME POSSIBLE


                    // VERIFICATION SI L'UTILISATEUR A LE DROIT D'ACCEDER A LA PAGE
                    $roleUtilisateur = recupererRoleDe($connexionUtilisateur);
                    if (in_array($roleUtilisateur, $listeDesRolesAutoriser)) {

                        miseAJourJeton($loginSite, $mdpMariaDB);
                        session_abort();
                        return $connexionUtilisateur;

                    }
                }
            }
        }

        header("Location: " . $empSite . "/erreurs/403.html");
        session_abort();
        return false;
    }
    catch(Exception $e){
        header("Location: " . $empSite . "/erreurs/403.html");
        return false;
    }
}

function motcleGenerate($id_ticket, $connexion) {
    /**
     * Génère la liste des mots-clés présents dans la base de données sous la forme d'une liste d'objets input checkbox HTML.
     * Si un id de ticket est passé en paramètre, les mots-clés associés à ce ticket sont en état checked.
     * @param $id_ticket = null/integer - Id du ticket dont on veut voir les mots-clés checkés.
     * @return void
     */
    $unchecked_motcle = executeSQL("SELECT nom_motcle FROM MotcleTicket WHERE nom_motcle NOT IN (SELECT nom_motcle FROM vue_tdb_relation_ticket_motcle WHERE id_ticket = ?);", array($id_ticket), $connexion);
    $checked_motcle = executeSQL("SELECT nom_motcle FROM vue_tdb_relation_ticket_motcle WHERE id_ticket = ?;", array($id_ticket), $connexion);

    while ($row = mysqli_fetch_row($checked_motcle)) {
        echo "<label><input type='checkbox' name='motcle_option[]' checked> $row[0]</label>";
    }

    while ($row = mysqli_fetch_row($unchecked_motcle)) {
        echo "<label><input type='checkbox' name='motcle_option[]'> $row[0] </label>";
    }
}



function motcleUpdate($id_ticket,$motcle_option, $connexion){
	/**
 	* Pour un ticket dont l'id est donnée :
  	* Remplace ses mots-clés en effaçant ses anciens mots-clés puis en lui associant ceux dans la liste en paramètre.
   	* @param $id_ticket - Id du ticket dont on veut remplacer les mots-clés.
       	* @param $motcle_option - Liste des mots-clés du ticket.
    	* @return void
    	*/
	executeSQL("DELETE FROM vue_suppr_RTM_tdb WHERE id_ticket = ?;", array($id_ticket), $connexion);
	for ($n=0;$n<count($motcle_option);$n++){
		executeSQL("INSERT INTO RelationTicketsMotscles (ID_TICKET, NOM_MOTCLE) VALUES (?,?);",array($id_ticket,$motcle_option[$n]), array($id_ticket, $motcle_option[$n]));
	}
}


function deconnexionSite(){
	/**
	 * @return void
	 * Déconnecte l'utilisateur du site
	 * Code venant de action_deconnexion.php
	 */
    // Démarre une session
        session_start();

    // Vérifie si les variables de session 'login' et 'mdp' sont définies
        if (isset($_SESSION['login'], $_SESSION['mdp'])){
            // Supprime les variables de session 'login' et 'mdp'
            unset($_SESSION['login'], $_SESSION['mdp']);
        }

    // Détruit toutes les données de session existantes.
        session_destroy();
}

function affichageMenuDuHaut($pageActuelle, $connexionUtilisateur = null){
	/**
	 * Affiche le menu en haut en fonction du rôle de l'utilisateur, ou si c'est un simple visiteur.
	 * @param $connexionUtilisateur : connexion MySQL permettant de déterminé le rôle de l'utilisateur, null si c'est un visiteur (par défaut)
	 * @param $pageActuelle : nom de la page où est appelé cette fonction
     * @return void
	 */

    global $empSite;
?>
    <header>
        <nav>
            <a href="#" aria-current="page">
                <div class="logo">
                    <?php echo'<img src="' . $empSite . '/ressources/images/logo_blanc.png" alt="logo du site">'; ?>
                    <p>TIX</p>
                </div>
            </a>

            <?php
            if ($connexionUtilisateur != null){

                echo '<div class="nav-conteneur">';

                if ($pageActuelle == "index") { echo '<a href="." aria-current="page" id="page_actuelle">Accueil</a>'; } else { echo '<a href="../" aria-current="page">Accueil</a>'; }
                if ($pageActuelle == "tableaudebord") { echo '<a href="tableaudebord.php" aria-current="page" id="page_actuelle">Tableau de bord</a>'; } else { echo '<a href="' . $empSite . '/tableau_bord/tableaudebord.php" aria-current="page">Tableau de bord</a>'; }
                // Si la personne est connecté...
                if (recupererRoleDe($connexionUtilisateur) == "Administrateur Site"){
                    // ... et que c'est l'administrateur du site
                    if ($pageActuelle == "administration") { echo '<a href="administration.php" aria-current="page" id="page_actuelle">Administration</a>'; } else { echo '<a href="' . $empSite . '/administration/administration.php" aria-current="page">Administration</a>'; }
                }
                elseif (recupererRoleDe($connexionUtilisateur) == "Administrateur Système"){
                    if ($pageActuelle == "administration") { echo '<a href="administration.php" aria-current="page" id="page_actuelle">Administration</a>'; } else { echo '<a href="' . $empSite . '/administration/administration.php" aria-current="page">Administration</a>'; }
                }

                echo '</div>';
            }
            ?>

            <div class="nav-authentification">
                <a href="profil/profil.php" class="user-icon" aria-label="Page de connexion">
                    <img src="ressources/images/user.svg" alt="icone utilisateur">
                </a>
                <div class="authentification">
                    <?php
                    if ($connexionUtilisateur != null) {
                        // Si la personne est connectée...
                        $roleUtilisateur = recupererRoleDe($connexionUtilisateur);

                        echo "<a href='" . $empSite . "/authentification/action_deconnexion.php' class='deconnexion-desinscription'> Déconnexion </a>";

                        if ($pageActuelle == "profil" && $roleUtilisateur != "Administrateur Site" && $roleUtilisateur != "Administrateur Système") {
                            echo "<a href='" . $empSite . "/authentification/action_desinscription.php' class='deconnexion-desinscription'> Désinscription </a>";
                        }
                        
                        if ($pageActuelle != "profil") {
                            echo "<a href='" . $empSite . "/profil/profil.php'> Mon Espace </a>";
                        }
                    } else {
                        // Sinon, c'est un visiteur
                        echo '<a href="' . $empSite . '/authentification/connexion.php"> Connexion</a>';
                        echo '<a href="' . $empSite . '/authentification/inscription.php"> Inscription</a>';
                    }
                    ?>
                </div>


            </div>
        </nav>
        <div class="hamburger-menu">
            <div class="slice"></div>
            <div class="slice"></div>
            <div class="slice"></div>
        </div>
    </header>

<?php
}

/*
function menuDeroulantTousLesMotcleTickets($connexionUtilisateur, $motclesACocher = array()){


    $resSQL = mysqli_query($connexionUtilisateur, "SELECT NOM_MOTCLE FROM `MotcleTicket` ORDER BY NOM_MOTCLE ASC;");
    while($unMotcleTicket = mysqli_fetch_row($resSQL)){
        if (in_array($unMotcleTicket[0], $motclesACocher)){ $cestCocher = "checked"; }
        else { $cestCocher = ""; }
        echo "<label><input type='checkbox' name='motcle_option[]' value='" . htmlspecialchars($unMotcleTicket[0]) . "' $cestCocher> " . htmlspecialchars($unMotcleTicket[0]) . " </label>";
    }
}
*/

function menuDeroulantTousLesUtilisateurs($connexionUtilisateur){
    $libellesACocher = array();
    
    $resultLibellesACocher = mysqli_query($connexionUtilisateur, "SELECT ID_USER FROM vue_technicien");

    if ($resultLibellesACocher) {
        while ($n = mysqli_fetch_row($resultLibellesACocher)) {
            array_push($libellesACocher, $n[0]);
        }
    } else {
        die("Erreur lors de l'ex�cution de la requ�te : " . mysqli_error($connexionUtilisateur));
    }

    $resultUtilisateurs = mysqli_query($connexionUtilisateur, "SELECT ID_USER, NOM_USER, PRENOM_USER FROM affiche_utilisateurs_pour_adm_web");
    if ($resultUtilisateurs) {
        while ($unLibelle = mysqli_fetch_row($resultUtilisateurs)) {
            $cestCocher = (in_array($unLibelle[0], $libellesACocher)) ? "checked" : "";

            echo "<label><input type='checkbox' name='tech_option[]' value='" . htmlspecialchars($unLibelle[0]) . "' $cestCocher> " . htmlspecialchars($unLibelle[1]) . " " . htmlspecialchars($unLibelle[2]) . " </label>";
        }
    } else {
        die("Erreur lors de l'ex�cution de la requ�te : " . mysqli_error($connexionUtilisateur));
    }
}

/*
function menuDeroulantTousLesTitres($connexionUtilisateur, $titreACocher = array()){


    $resSQL = mysqli_query($connexionUtilisateur, "SELECT TITRE_TICKET FROM `TitreTicket` ORDER BY TITRE_TICKET ASC;");
    while($unTitre = mysqli_fetch_row($resSQL)[0]){
        if (count($titreACocher) == 1 and $unTitre == $titreACocher[0]){ $cestCocher = "selected"; }
        else { $cestCocher = ""; }
        echo "<option value='$unTitre' $cestCocher>$unTitre</option>";
    }
}
*/
function menuDeroulant($resultatSQL, $attributListe, $elementsACocher = array()){
    /**
     *  Même principe que tableGenerate, sauf que génère une liste HTML (menu déroulant sélectionnable ou cochable).
     *  Elle récupère le resultat de la requête SQL, génère la liste déroulante cochable (si $attribut == "checked") ou sélectionnable (si $attribut == "selected").
     *  Elle cochera tous les éléments contenus dans la liste ou sélectionnera le premier élément de celle-ci.
     *  Le contenu de la liste correspondra à la première valeur du SELECT.
     *  @param mysqli $resultatSQL -> Le résultat de la requête SQL (mysqli_result d'une requête SELECT attention !)
     *  @param string $attributListe -> L'attribut de la liste (selected, checked)
     *  @param array $elementsACocher -> L'élement à sélectionner, les éléments à cochers (par défaut : aucun)
     *
     * Remarque : nous utilisons une liste pour titreACocher en prévision d'une fusion des 3 fonctions menuDeroulantTousLes
     */

    // Si $attributListe == "selected" sans prendre compte de la casse
    if (strcasecmp($attributListe, "selected") == 0) {

        // Tant qu'il y a des éléments dans le résultat SQL (donc à mettre dans la liste
        while ($unElement = mysqli_fetch_row($resultatSQL)) {

            // On vérifie qu'il y a bien un seul élément et on le prend pour le sélectionner
            if (count($elementsACocher) == 1 and $unElement[0] == $elementsACocher[0]) { $cestCocher = "selected"; }
            else { $cestCocher = ""; } // Il n'y en a pas, ou ce n'est pas possible d'en sélectionner qu'un
            echo "<option value='$unElement[0]' $cestCocher>$unElement[0]</option>"; // On ajoute l'élément à la liste
        }
    }
    elseif (strcasecmp($attributListe, "checked") == 0) {
        while ($unElement = mysqli_fetch_row($resultatSQL)) {
            if (in_array($unElement[0], $elementsACocher)){ $cestCocher = "checked"; }
            else { $cestCocher = ""; }
            echo "<label><input type='checkbox' name='motcle_option[]' value='" . htmlspecialchars($unElement[0]) . "' $cestCocher> " . htmlspecialchars($unElement[0]) . " </label>";
        }
    }
}

function isSelected($value,$comp){
	if ($comp == $value){
		return "selected";
	}
}
