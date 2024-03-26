<?php

require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connection = pageAccess(array('Administrateur Site'));

try{
	if ((!empty($_POST["ajout_titre"])) && (!empty($_POST["categorieMc"]))){

        $texte = $_POST["ajout_titre"]; $categorie = $_POST["categorieMc"];

        $verifExistenceMC = (boolean) executeSQL("SELECT COUNT(*) FROM Categorie WHERE NOM_CATEGORIE = ?", array($texte), $connection);
        if (! $verifExistenceMC){ throw new Exception("erreur", 301); } // catégorie inexistante

        if (strlen(trim($texte)) <= 10){ throw new Exception("erreur", 302); } // texte trop court


        $categorieEtTexte = $categorie . " : " . ucfirst(strtolower($texte));

        if (strlen(htmlspecialchars($categorieEtTexte)) > 60){ throw new Exception("erreur", 303); } // texte + catego trop long

        $verifExistence = (boolean) mysqli_fetch_row(executeSQL("SELECT COUNT(*) FROM TitreTicket WHERE Titre_Ticket = ?", array($categorieEtTexte), $connection))[0];
        if ($verifExistence){ throw new Exception("erreur", 304); } // titre déjà existant

        executeSQL("INSERT INTO `TitreTicket` VALUES (?, ?);",array($categorieEtTexte, $categorie),$connection);

        header('Location: administration.php');
        return;
    }
    else {
        throw new Exception("erreur", 305); // option manquante
    }

}
catch(Exception $e){
    if ($e->getMessage() == "erreur"){
        header('Location: administration.php?id=' . $e->getCode());
    } else {
        header('Location: administration.php?id=300');
    }
    return;
}
?>