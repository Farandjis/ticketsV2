<?php
require(../ressources/fonctions/PHPfunctions.php);

if (isset($_POST["date"]) && isset($_POST["date2"]) && isset($_POST["titre"]) && isset($_POST["liste-libelle"])){
    
    $requet = "SELECT * FROM Ticket WHERE" ;
    $param = array();
    
    if (!(empty($_POST["date"]))){
        $requet = $requete."Ticket.horodatage_creation_ticket > ? AND";
        array_push($param,$_POST["date"]);
    }
    
    if (!(empty($_POST["date2"]))){
        $requet = $requete."Ticket.horodatage_creation_ticket < ? AND";*
        array_push($param,$_POST["date2"]);
    }
    
    if (!(empty($_POST["titre"]))){
        $requet = $requete."Ticket.titre = ? AND";
        array_push($param,$_POST["titre"]);
    }
    
    if (!(empty($_POST["liste-libelle"]))){
        $libelle = explode(" ", $_POST["liste-libelle"]);
        for ($i = 0; $i < count($libelle)-1; i++){
            $requet = $requete." Ticket.id_ticket IN (SELECT RelationTicketLibelles.id_ticket FROM RelationTicketLibelles WHERE RelationTicketLibelles.nom_libelle = ?) AND";
            array_push($param,$libelle[i]);
        }
    }
    
    $requet = $requete."Ticket.valeur_etat_ticket != 'fermé';";
    
    $result = insertRequest($requet,$param);

    tableGenerate($result);
}

?>
