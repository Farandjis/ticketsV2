<?php

/**
 * Principe :
 *      Répond à la demande de l'utilisateur.
 *      Il lui envoi la liste des mots-clés associés au titre sélectionné par l'utilisateur
 */

require(dirname(__FILE__) . "/../../ressources/fonctions/PHPfunctions.php");
$connexionUtilisateur = pageAccess(array('Utilisateur', 'Technicien', 'Administrateur Site', 'Administrateur Système')); // Renvoi vers e403 si la personne n'a pas accès

$recup = file_get_contents("php://input"); // On récupère le fichier reçus (ici notre liste)

$headers = getallheaders();

if (! array_key_exists("Content-Type", $headers)){ // Cas où on accède à la page sans passer par le formulaire (donc "Content-Type" n'existe pas)
    header("Location: ../../erreurs/403.html");
    return;
}



try {
    if ($headers["Content-Type"] == "application/json") { // Si le fichier reçu est bien de type JSON (?)
        $_POST = ["ok"]; // ???
        $data = json_decode($recup, true);

        if (json_last_error() == JSON_ERROR_NONE) { // ???
            if (isset($data['maListe'])) {


                // On récupère la catégorie du titre par un petit tour de passe-passe
                $categorieDuTitre = mysqli_fetch_row(executeSQL("SELECT NOM_CATEGORIE FROM TitreTicket WHERE TITRE_TICKET = ? ", $data['maListe'], $connexionUtilisateur));
                if ($categorieDuTitre == Null){
                    // echo "<p>Sélectionnez un titre en premier</p>";
                    return; }
                else { $categorieDuTitre = $categorieDuTitre[0]; }

                // On récupère tous les mots-clés pouvant avoir un lien avec ce titre
                // note : manque perm mariadb accès à la table
                $lesMotsClesEnLiensAvecLeTitre = executeSQL("SELECT mc.NOM_MOTCLE FROM MotcleTicket AS mc WHERE mc.NOM_CATEGORIE = ? OR mc.NOM_CATEGORIE IN (SELECT ca.NOM_CATEGORIE_ASSOCIER FROM CategorieAssocies AS ca WHERE ca.NOM_CATEGORIE = ?)", array($categorieDuTitre, $categorieDuTitre), $connexionUtilisateur);
                // SELECT mc.NOM_MOTCLE FROM MotcleTicket AS mc WHERE mc.NOM_CATEGORIE = 'LOGICIEL' OR mc.NOM_CATEGORIE IN (SELECT ca.NOM_CATEGORIE_ASSOCIER FROM CategorieAssocies AS ca WHERE ca.NOM_CATEGORIE = 'LOGICIEL')


                $lesMotcleTicketsCoches = array();
                session_start();
                if (isset($_SESSION['motcle'])) {
                    $lesMotcleTicketsCoches = $_SESSION['motcle'];
                    unset($_SESSION['motcle']);
                    session_commit(); // Sinon, le unset n'est pas pris en compte !
                }
                session_abort();

                menuDeroulant($lesMotsClesEnLiensAvecLeTitre, "checked", $lesMotcleTicketsCoches);


                $liste = array($categorieDuTitre, $data['maListe']);

                header('Content-Type: application/json');

                return;


            }
        }
    }
}catch(Exception $e){
    header('Content-Type: application/json');
    $dicoDesInfosSupplementaires = array("Oups... " => "Impossible de charger des informations supplémentaires.");
    echo json_encode($dicoDesInfosSupplementaires);
    return;
}
