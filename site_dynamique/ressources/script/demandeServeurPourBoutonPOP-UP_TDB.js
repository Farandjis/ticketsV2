
function ligneTableauDeBord(idLigneDuTicket){
    // On ajoutera si possible un appel vers une fonction affichant des infos supplémentaires sur le ticket
    demandeSiCestPossibleDeModifierOuAttribuer(idLigneDuTicket);
}


function demandeSiCestPossibleDeModifierOuAttribuer(idLigneDuTicket) {
    /**
     * Principe :
     *      Demande au serveur s'il doit affiché le bouton (si oui, avec quel texte et pour être sur, l'ID du Ticket)
     * @param idLigneDuTicket : Numéro de la ligne donné par la ligne directement lors du clique sur celle ci
     */

    // On récupère le tableau avec l'id "tableaudebord", on récupère toute ses lignes, et pour la ligne n°idLigneDuTicket on récupère toute ses cases afin de récupérer l'identifiant du ticket
    let idTicket = document.getElementById("tableaudebord").getElementsByTagName("tr").item(idLigneDuTicket).getElementsByTagName("td")[0];
    let maListe = [idTicket.innerText];

    console.log("Préparation à l'envoi de la demande de modification ou d'attribution du ticket");
    requestEnr =new XMLHttpRequest()
    requestEnr.open("POST", "../ressources/reponseServeurPHP/reponseServeurModificationAttributionTicketTDB.php") // On indique qu'on envoi notre requête au fichier enregistrement.php
    requestEnr.setRequestHeader("Content-Type", "application/json") // On indique le format des données envoyés (ici, les données sont en Json)
    requestEnr.send(JSON.stringify({maListe: maListe})) // On transforme l'objet Json tabClasse en chaîne de caractère et on l'envoi au serveur
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
    console.log("Réception de la réponse du serveur");
    if (requestEnr.readyState == 4 && requestEnr.status == 200){ // Si c'est ok
        console.log("(demandeServeurPourBoutonPOP-UP) Réponse valide");
        let lePOP_UP = document.getElementById("pop-up"); // On récupère le pop-up

        while (lePOP_UP.getElementsByTagName("input").length > 0){ // Tant que le pop-up contient des boutons de type input (ceux pour aller vers la page modif)
            lePOP_UP.removeChild(lePOP_UP.lastChild); // On les supprimes
        }

        let $infoBouton = JSON.parse(requestEnr.responseText); // On récupère la liste au format [txt_bouton, ID_TICKET]

        // On créer le formulaire + un bouton contenant juste l'id du ticket + le bouton apparant de redirection
        if ($infoBouton[0] != null) { // null si le bouton ne doit pas apparaître (aucun texte)
            console.log("(demandeServeurPourBoutonPOP-UP) Une action est possible");
            let leFormulaireDuBouton = document.createElement("form");
            leFormulaireDuBouton.setAttribute("action", "modificationTicket.php");
            leFormulaireDuBouton.setAttribute("method", "post");
            leFormulaireDuBouton.nodeValue = "d";
            lePOP_UP.appendChild(leFormulaireDuBouton);

            let leBoutonCacherContenantIDTicket = document.createElement("input");
            leBoutonCacherContenantIDTicket.type = 'hidden';
            leBoutonCacherContenantIDTicket.name = 'id_ticket';
            leBoutonCacherContenantIDTicket.value = $infoBouton[1];
            leFormulaireDuBouton.appendChild(leBoutonCacherContenantIDTicket);

            let leBouton = document.createElement("input");
            leBouton.setAttribute("type", "submit");
            leBouton.setAttribute("name", "boutonEnvoi");
            leBouton.setAttribute("value", $infoBouton[0]);
            leFormulaireDuBouton.appendChild(leBouton);

            console.log("(demandeServeurPourBoutonPOP-UP) Fin de la génération du bouton");
        }
    }
}