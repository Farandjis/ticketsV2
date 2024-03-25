function demandeLesMotsClesAAfficher(leTitre){
    /**
     * PRINCIPE :
     *      Demande au serveur les mots-clés à afficher dans la liste cochable. Les mots-clés en lien avec la catégorie du type de titre.
     * ENTRÉES :
     *     @param string leTitre : Titre du ticket mis par l'utilisateur
     */
    let maListe = [leTitre];

    console.log("Préparation à l'envoi de la demande de la liste des mots-clés à afficher" );
    requestMotsClesDuTitre = new XMLHttpRequest()
    requestMotsClesDuTitre.open("POST", "../ressources/reponseServeurPHP/reponseListeMotsClesDuTitre.php") // On indique qu'on envoi notre requête à ce fichier
    requestMotsClesDuTitre.setRequestHeader("Content-Type", "application/json") // On indique le format des données envoyés (ici, les données sont en Json)
    requestMotsClesDuTitre.send(JSON.stringify({maListe: maListe})) // On transforme l'objet Json maListe en chaîne de caractère et on l'envoi au serveur
    requestMotsClesDuTitre.onreadystatechange = insereLesMotsClesDansLaListe // On appel cette fonction une fois que l'on a récupéré la réponse
}


function insereLesMotsClesDansLaListe() {
    /**
     * Principe :
     *      Traite la réponse du serveur.
     *      Il ajoute et adapte les informations reçus au pop-up.
     */

    console.log("Réception de la réponse du serveur (insereLesMotsClesDansLaListe)");

    let texteBouton;
    if (requestMotsClesDuTitre.readyState == 4 && requestMotsClesDuTitre.status == 200) { // Si c'est ok
        console.log("(insereLesMotsClesDansLaListe) Réponse valide, on insère les mots-clés dans la liste");

        let menuDeroulantMotsCles = document.getElementById("menu_deroulant_motcle").getElementsByClassName("option_checkbox").item(0); // le 07/02/24 -> c'est ok ça marche

        // On supprime le contenu du menu déroulant
        while (menuDeroulantMotsCles.hasChildNodes()) {
            menuDeroulantMotsCles.removeChild(menuDeroulantMotsCles.lastChild);
        }

        // On insère dans le code HTML les mots-clés reçus (récupéré sous forme de texte HTML)
        menuDeroulantMotsCles.innerHTML = requestMotsClesDuTitre.responseText

        let titreDuMenuDeroulantMotsCles = document.getElementById("menu_deroulant_motcle").getElementsByClassName("entete_menu_checkbox").item(0);

        // S'il n'y a pas de mots-clés
        if (requestMotsClesDuTitre.responseText == "") {
            titreDuMenuDeroulantMotsCles.innerHTML = "Sélectionnez un titre en premier";  // Change le titre du bouton du menu déroulant
            menuDeroulantMotsCles.innerHTML = "<span>Aucun mot-clé disponible</span>" // Contenu du menu déroulant
            titreDuMenuDeroulantMotsCles.removeAttribute("onclick"); // Empêche qu'on puisse ouvrir le menu déroulant
            document.getElementById("menu_deroulant_motcle").setAttribute("class", "menu_checkbox"); // Referme le menu déroulant
        } else {
            const nbLesMotcleTicketsCoches = (requestMotsClesDuTitre.responseText.match(new RegExp("checked", 'g')) || []).length;

            if (nbLesMotcleTicketsCoches == 0) {
                texteBouton = "-- Listes des mots-clés --";
            } else if (nbLesMotcleTicketsCoches == 1) {
                texteBouton = "1 mot-clé sélectionné à l'origine";
            } else {
                texteBouton = nbLesMotcleTicketsCoches + " mots-clés sélectionnés à l'origine";
            }

            titreDuMenuDeroulantMotsCles.innerHTML = texteBouton; // Redéfiniton le titre du menu déroulant
            titreDuMenuDeroulantMotsCles.setAttribute("onclick", "toggleDropdown(document.getElementById('menu_deroulant_motcle'))"); // Autorise l'ouverture du menu déroulant
        }


    }
}