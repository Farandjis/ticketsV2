
function ligneMonEspace(idLigneDuTicket){
    /**
     * Principe :
     *      Demande au serveur des informations supplémentaire à afficher à la personne sur le ticket sélectionné.
     * @param int idLigneDuTicket : Numéro de la ligne donné par la ligne directement lors du clique sur celle ci
     */

    let idTicket = document.getElementById("monespace").getElementsByTagName("tr").item(idLigneDuTicket).getElementsByTagName("td")[0];
    let maListe = [idTicket.innerText];

    console.log("Préparation à l'envoi de la demande de récupération d'information supplémentaire sur le ticket " + idTicket);
    requestInfoTicket = new XMLHttpRequest()
    requestInfoTicket.open("POST", "../ressources/reponseServeurPHP/reponseInfoTicketDeME.php") // On indique qu'on envoi notre requête à ce fichier
    requestInfoTicket.setRequestHeader("Content-Type", "application/json") // On indique le format des données envoyés (ici, les données sont en Json)
    requestInfoTicket.send(JSON.stringify({maListe: maListe})) // On transforme l'objet Json maListe en chaîne de caractère et on l'envoi au serveur
    requestInfoTicket.onreadystatechange = ajoutDesInfosDansPOP_UP // On s'assure que tout est ok

}

function ajoutDesInfosDansPOP_UP(){
    /**
     * Principe :
     *      Traite la réponse du serveur.
     *      Il ajoute et adapte les informations reçus au pop-up.
     */

    console.log("Réception de la réponse du serveur (ajoutDesInfosDansPOP_UP)");

    if (requestInfoTicket.readyState == 4 && requestInfoTicket.status == 200) { // Si c'est ok
        console.log("(ajoutDesInfosDansPOP_UP) Réponse valide");

        // On récupère le dictionnaire au format : clé -> le nom du texte (ex : Titre), valeur -> le contenu du texte (ex: Le 28/12/2023 à 18h16)
        let dicoDesInfosSupplementaires = JSON.parse(requestInfoTicket.responseText);
        // On récupère les clés du dictionnaire
        let listeDesClesDuDicoInfosSupp = Object.keys(dicoDesInfosSupplementaires);

        // On récupère le div d'id `informations_ticket_popup` contenant toute les informations affichés pour le ticket
        let lesInfosDuPOP_UP = document.getElementById("informations_ticket_popup");

        // Pour la boucle for each, plus d'info sur : https://www.zendevs.xyz/les-boucles-for-foreach-each-en-javascript/
        // Pour chaque élément de la liste, `cle` est l'élément sélectionné (la clé du dictionnaire donc) et `index` l'ID de son emplacement
        // Pour chaque élément, exécuter le code dans {}
        listeDesClesDuDicoInfosSupp.forEach((cle, index) => {
            let infoAAjouter_Ensemble = document.createElement("p"); lesInfosDuPOP_UP.appendChild(infoAAjouter_Ensemble);
            let infoAAjouter_NomTexte = document.createElement("strong"); infoAAjouter_Ensemble.appendChild(infoAAjouter_NomTexte);
            let infoAAjouter_ContenuTexte = document.createElement("span"); infoAAjouter_Ensemble.appendChild(infoAAjouter_ContenuTexte);
            infoAAjouter_NomTexte.innerText = cle + " : "; // on insère la clé
            infoAAjouter_ContenuTexte.innerText = dicoDesInfosSupplementaires[cle]; // on insère la valeur associé à la clé
        })
    }
}