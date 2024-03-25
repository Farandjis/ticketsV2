<?php

require (dirname(__FILE__) . "/../ressources/fonctions/PHPfunctions.php");
$connection = pageAccess(array('Administrateur Site'));

try {
	if ((!empty($_POST["ajout_motcle"])) && (!empty($_POST["categorieMc"]))){

        $texte = $_POST["ajout_motcle"]; $categorie = $_POST["categorieMc"];

        $verifExistenceMC = (boolean) executeSQL("SELECT COUNT(*) FROM Categorie WHERE NOM_CATEGORIE = ?", array($texte), $connection);
        if (! $verifExistenceMC){ throw new Exception("erreur", 201); } // catégorie inexistante

        if (strlen(trim($texte)) <= 2){ throw new Exception("erreur", 202); } // texte trop court


        $categorieEtTexte = $categorie . " : " . ucfirst(strtolower($texte));

        if (strlen(htmlspecialchars($categorieEtTexte)) > 30){ throw new Exception("erreur", 203); } // texte + catego trop long

        $verifExistence = (boolean) mysqli_fetch_row(executeSQL("SELECT COUNT(*) FROM MotcleTicket WHERE NOM_MOTCLE = ?", array($categorieEtTexte), $connection))[0];
        if ($verifExistence){ throw new Exception("erreur", 204); } // titre déjà existant

        executeSQL("INSERT INTO `MotcleTicket` VALUES (?, ?);",array($categorieEtTexte, $categorie),$connection);

        header('Location: administration.php');
        return;
    }
    else {
        throw new Exception("erreur", 205); // option manquante
    }
}
catch(Exception $e){
    if ($e->getMessage() == "erreur"){
        header('Location: administration.php?id=' . $e->getCode());
    } else {
        header('Location: administration.php?id=100');
    }
    return;
}
?>