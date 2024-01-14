/*
function includeScript(src, callback) {
    var script = document.createElement('script');
    script.src = src;
    script.onload = callback;
    document.head.appendChild(script);
}
// Inclure le script2.js et appeler la fonction de script2.js une fois chargé
includeScript('../ressources/script/infoLigneTab.js', function() {
    // La fonction de script2.js est maintenant disponible
    // Appelez ici la fonction spécifique de script2.js que vous souhaitez utiliser
    handleClickOrEnter();
});
*/

function ligneTableauDeBord(idLigneDuTicket){
    demandeInfoTicketDuTDB(idLigneDuTicket);
    demandeSiCestPossibleDeModifierOuAttribuer(idLigneDuTicket);
}

function demandeInfoTicketDuTDB(idLigneDuTicket){
    /**
     * Principe :
     *      Demande au serveur des informations supplémentaire à afficher à la personne sur le ticket sélectionné.
     * @param int idLigneDuTicket : Numéro de la ligne donné par la ligne directement lors du clique sur celle ci
     */

    let idTicket = document.getElementById("tableaudebord").getElementsByTagName("tr").item(idLigneDuTicket).getElementsByTagName("td")[0];
    let maListe = [idTicket.innerText];

    console.log("Préparation à l'envoi de la demande de récupération d'information supplémentaire sur le ticket " + idTicket);
    requestInfoTicket = new XMLHttpRequest()
    requestInfoTicket.open("POST", "../ressources/reponseServeurPHP/reponseInfoTicketDuTDB.php") // On indique qu'on envoi notre requête à ce fichier
    requestInfoTicket.setRequestHeader("Content-Type", "application/json") // On indique le format des données envoyés (ici, les données sont en Json)
    requestInfoTicket.send(JSON.stringify({maListe: maListe})) // On transforme l'objet Json maListe en chaîne de caractère et on l'envoi au serveur
    requestInfoTicket.onreadystatechange = ajoutDesInfosDansPOP_UP // On s'assure que tout est ok

}



function supprimerLesBoutonsPOP_UP(){
    let lePOP_UP = document.getElementById("pop-up"); // On récupère le pop-up
    let lesInputDuPOP_UP = lePOP_UP.getElementsByTagName("input");
    while (lesInputDuPOP_UP.length > 0){ // Tant que le pop-up contient des boutons de type input (ceux pour aller vers la page modif)
        lesInputDuPOP_UP.item(0).remove(); // On les supprimes
    }
}
function demandeSiCestPossibleDeModifierOuAttribuer(idLigneDuTicket) {
    /**
     * Principe :
     *      Demande au serveur s'il doit affiché le bouton (si oui, avec quel texte et pour être sur, l'ID du Ticket)
     * @param int idLigneDuTicket : Numéro de la ligne donné par la ligne directement lors du clique sur celle ci
     */

    // On récupère le tableau avec l'id "tableaudebord", on récupère toute ses lignes, et pour la ligne n°idLigneDuTicket on récupère toute ses cases afin de récupérer l'identifiant du ticket
    let idTicket = document.getElementById("tableaudebord").getElementsByTagName("tr").item(idLigneDuTicket).getElementsByTagName("td")[0];
    let maListe = [idTicket.innerText];

    supprimerLesBoutonsPOP_UP();

    console.log("Préparation à l'envoi de la demande de modification ou d'attribution du ticket");
    requestEnr =new XMLHttpRequest()
    requestEnr.open("POST", "../ressources/reponseServeurPHP/reponseServeurModificationAttributionTicketTDB.php") // On indique qu'on envoi notre requête à ce fichier
    requestEnr.setRequestHeader("Content-Type", "application/json") // On indique le format des données envoyés (ici, les données sont en Json)
    requestEnr.send(JSON.stringify({maListe: maListe})) // On transforme l'objet Json maListe en chaîne de caractère et on l'envoi au serveur
    requestEnr.onreadystatechange = ajoutDuBoutonDansPOP_UP // On s'assure que tout est ok
}

function demandeServeurAttributionTicket(ID_TICKET){
    /**
     * Principe :
     *      Demande d'ajouter au technicien un ticket
     * @param int ID_TICKET : id du ticket à attribuer
     */

    supprimerLesBoutonsPOP_UP();

    console.log("Préparation à l'envoi de la demande d'attribution du ticket à l'utilisateur");
    requestEnr =new XMLHttpRequest()
    requestEnr.open("POST", "../ressources/reponseServeurPHP/reponseServeurSAttribuerUnTicket.php") // On indique qu'on envoi notre requête à ce fichier
    requestEnr.setRequestHeader("Content-Type", "application/json") // On indique le format des données envoyés (ici, les données sont en Json)
    requestEnr.send(JSON.stringify({ID_TICKET:[ID_TICKET]})) // On transforme l'objet Json tabClasse en chaîne de caractère et on l'envoi au serveur
    requestEnr.onreadystatechange = ajoutDuBoutonDansPOP_UP // On s'assure que tout est ok
}

function ajoutDuBoutonDansPOP_UP(){
    /**
     * Principe :
     *      Traite la réponse du serveur.
     *      Il renvoi une liste, si la première case est nulle, alors on affiche pas le bouton.
     *      Sinon, on affiche le bouton avec le texte contenu dans la première case et on indique comme ID Ticket
     *      le contenu de la deuxième case.
     */
    console.log("Réception de la réponse du serveur (ajoutDuBoutonDansPOP_UP)");
    if (requestEnr.readyState == 4 && requestEnr.status == 200){ // Si c'est ok
        console.log("(demandeServeurPourBoutonPOP-UP) Réponse valide");
        let lePOP_UP = document.getElementById("pop-up"); // On récupère le pop-up

        console.log(requestEnr.responseText);
        let $infoBouton = JSON.parse(requestEnr.responseText); // On récupère la liste au format [txt_bouton, ID_TICKET]

        // On créer le formulaire + un bouton contenant juste l'id du ticket + le bouton apparant de redirection
        if ($infoBouton[0] != null) { // null si le bouton ne doit pas apparaître (aucun texte)
            console.log("(demandeServeurPourBoutonPOP-UP) Une action est possible");
            let leFormulaireDuBouton = document.createElement("form");

            if ($infoBouton[0] != "S'attribuer ce ticket"){
                leFormulaireDuBouton.setAttribute("action", "modificationTicket.php");
            }

            leFormulaireDuBouton.setAttribute("method", "post");
            leFormulaireDuBouton.nodeValue = "d";
            lePOP_UP.appendChild(leFormulaireDuBouton);

            let leBoutonCacherContenantIDTicket = document.createElement("input");
            leBoutonCacherContenantIDTicket.type = 'hidden';
            leBoutonCacherContenantIDTicket.name = 'id_ticket';
            leBoutonCacherContenantIDTicket.value = $infoBouton[1];
            leFormulaireDuBouton.appendChild(leBoutonCacherContenantIDTicket);

            let leBouton = document.createElement("input");
            if ($infoBouton[0] != "S'attribuer ce ticket"){ leBouton.setAttribute("type", "submit"); }
            leBouton.setAttribute("name", "boutonEnvoi");
            leBouton.setAttribute("value", $infoBouton[0]);
            if ($infoBouton[0] == "S'attribuer ce ticket"){
                // Permet d'exécuter la fonction avec un arg pas au moment de la lecture de la ligne
                leBouton.onclick = function() { demandeServeurAttributionTicket($infoBouton[1]); };
            }
            leFormulaireDuBouton.appendChild(leBouton);

            console.log("(demandeServeurPourBoutonPOP-UP) Fin de la génération du bouton");
        }
    }
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