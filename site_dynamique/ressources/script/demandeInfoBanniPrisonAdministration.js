function demandeDonneesBannisPrisonAdministration(parPrisonChoisit){
    /**
     * PRINCIPE :
     *      Demande au serveur les informations par rapport à la prison et le formulaire choisit (temps de bannissement, les bannis...).
     *      On demande pas les mêmes en fonctions en fonction du type de formulaire, afin d'alléger les temps de calcul (si très grande liste de bannis par ex)
     * ENTRÉES :
     *     @param string leTitre : Titre du ticket mis par l'utilisateur
     */
    let maListe = [parPrisonChoisit];

    console.log("Préparation à l'envoi de la demande pour récupérer les informations sur la prison" );
    requestInformationsPrisons = new XMLHttpRequest()
    requestInformationsPrisons.open("POST", "../ressources/reponseServeurPHP/reponseInfoBanniPrisonAdministration.php") // On indique qu'on envoi notre requête à ce fichier
    requestInformationsPrisons.setRequestHeader("Content-Type", "application/json") // On indique le format des données envoyés (ici, les données sont en Json)
    requestInformationsPrisons.send(JSON.stringify({maListe: maListe})) // On transforme l'objet Json maListe en chaîne de caractère et on l'envoi au serveur
    requestInformationsPrisons.onreadystatechange = insereDonnesBannisPrison // On appel cette fonction une fois que l'on a récupéré la réponse


    let listeDesIP = document.getElementById("debannir_ip")
    while (listeDesIP.hasChildNodes()){ listeDesIP.firstChild.remove() }

    let uneOptionIP = document.createElement("option")
    uneOptionIP.value = ""
    uneOptionIP.innerText = "Chargement en cours..."
    listeDesIP.appendChild(uneOptionIP);

}


function insereDonnesBannisPrison() {
    /**
     * Principe :
     *      Traite la réponse du serveur.
     *      Il indique qui sont les bannis pour cette prison
     */

    console.log("Réception de la réponse du serveur (insereDonnesBannisPrison)");

    if (requestInformationsPrisons.readyState == 4 && requestInformationsPrisons.status == 200) { // Si c'est ok
        console.log("(insereDonnesBannisPrison) Réponse valide");
        // console.log(requestInformationsPrisons.responseText);

        let listeDesIP = document.getElementById("debannir_ip")
        while (listeDesIP.hasChildNodes()){ listeDesIP.firstChild.remove() }

        let lesIP = JSON.parse(requestInformationsPrisons.responseText); // Attention, les éléments récupérés diffèrent en fonction du formulaire.

        if (lesIP[0] == ""){
            let uneOptionIP = document.createElement("option")
            uneOptionIP.value = ""
            uneOptionIP.innerText = "Aucun banni"
            listeDesIP.appendChild(uneOptionIP);
        } else {
            let uneOptionIP = document.createElement("option")
            uneOptionIP.value = ""
            uneOptionIP.innerText = "Selectionnez une IP"
            listeDesIP.appendChild(uneOptionIP);

            lesIP.forEach((uneIP) => {
                let uneOptionIP = document.createElement("option")
                let prisonSelectionner = document.getElementById("prison2").value;

                uneOptionIP.value = uneIP
                uneOptionIP.innerText = uneIP
                uneOptionIP.setAttribute("onclick", "demandeInfoSurLeBanni('"+ uneIP +"', 'ip', 'divErreur1', '" + prisonSelectionner +"')")
                listeDesIP.appendChild(uneOptionIP);
            })
        }
    }
}