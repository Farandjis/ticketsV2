function demandeMajPrisonAdministrationEnFonctionDeTitre(parPrisonChoisit, parExeAutreFct){
    /**
     * PRINCIPE :
     *      Demande au serveur les informations par rapport à la prison et le formulaire choisit (temps de bannissement, les bannis...).
     *      On demande pas les mêmes en fonctions en fonction du type de formulaire, afin d'alléger les temps de calcul (si très grande liste de bannis par ex)
     * ENTRÉES :
     *     @param string leTitre : Titre du ticket mis par l'utilisateur
     */
    let maListe = [parPrisonChoisit];
    // nomFormulaire = parNomFormulaire;
    exeAutreFct = parExeAutreFct

    console.log("Préparation à l'envoi de la demande pour récupérer les informations sur la prison" );
    requestInformationsPrisons = new XMLHttpRequest()
    requestInformationsPrisons.open("POST", "../ressources/reponseServeurPHP/reponseMajPrisonAdministrationEnFonctionDeTitre.php") // On indique qu'on envoi notre requête à ce fichier
    requestInformationsPrisons.setRequestHeader("Content-Type", "application/json") // On indique le format des données envoyés (ici, les données sont en Json)
    requestInformationsPrisons.send(JSON.stringify({maListe: maListe})) // On transforme l'objet Json maListe en chaîne de caractère et on l'envoi au serveur
    requestInformationsPrisons.onreadystatechange = insereDonnesPrison // On appel cette fonction une fois que l'on a récupéré la réponse

}


function insereDonnesPrison() {
    /**
     * Principe :
     *      Traite la réponse du serveur.
     *      Il adapte les formulaire liés à la prison
     */

    console.log("Réception de la réponse du serveur (insereDonnesPrison)");


    if (requestInformationsPrisons.readyState == 4 && requestInformationsPrisons.status == 200) { // Si c'est ok
        console.log("(insereDonnesPrison) Réponse valide");
        // console.log(requestInformationsPrisons.responseText);

        let lesInfosRecup = JSON.parse(requestInformationsPrisons.responseText); // Attention, les éléments récupérés diffèrent en fonction du formulaire.

        // Si c'est par rapport au formulaire à gauche (options prison)
        let prisonMaxTentatives = lesInfosRecup[0];
        let prisonTempsBan = lesInfosRecup[1];
        let prisonTempsAvOublie = lesInfosRecup[2];

        document.getElementById("nb-tentative").setAttribute("value", prisonMaxTentatives)
        document.getElementById("nb-temps-oubli").setAttribute("value", prisonTempsBan)
        document.getElementById("temps-banni").setAttribute("value", prisonTempsAvOublie)

        if (exeAutreFct == "appelAutreFonction"){
            demandeDonneesBannisPrisonAdministration(document.getElementById("prison2").value);
        }
    }

}