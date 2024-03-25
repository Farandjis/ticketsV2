// Fonction pour afficher la pop-up avec les informations de la ligne
function showPopup(nom,fichier) {

    var popup = document.getElementsByClassName("popupLog")[0];


    var iframePopup = document.createElement("iframe");

    if (fichier == "Today"){
        iframePopup.src = "../ressources/reponseServeurPHP/reponsePOPupArchive.php?nom="+nom+"&fichier="+fichier+"&today=true";
    }
    else {
        iframePopup.src = "../ressources/reponseServeurPHP/reponsePOPupArchive.php?nom="+nom+"&fichier="+fichier+"&today=false";
    }


    iframePopup.width = 1206;
    iframePopup.height = 505;

    document.getElementById("informations_ticket_popup_log").appendChild(iframePopup);


    // Affichez la pop-up
    document.getElementById("overlay").style.display = "flex";
}

// Fonction pour fermer la pop-up
function closePopup() {
    let overlay = document.getElementById("overlay");
    let bouton = document.getElementById("fermer_pop-up");

    window.addEventListener('click', function(event) {
        if (event.target === overlay || event.target === bouton) {
            overlay.style.display = 'none';

            var popup = document.getElementById("informations_ticket_popup_log");
            while (popup.firstChild) {
                popup.firstChild.remove();
            }
        }
    });
}

window.onload = init;

function init() {
    //=============== LIGNE TABLEAU ==============

    // Ajoutez des écouteurs d'événements aux lignes du tableau
    let cells = document.getElementsByClassName("archive");


    for (let i = 0; i < cells.length; i++) {
        cells[i].setAttribute("tabindex", "0");
        // Utilisez une fonction anonyme pour capturer la valeur actuelle de "i"
        (function (index) {
            // Fonction pour gérer le clic ou la touche "Entrée"
            function handleClickOrEnter(event) {
                if (event.type === 'click') {
                    // Utilisez la première cellule de la ligne au lieu de la ligne entière
                    showPopup(cells[index].getAttribute("Class").split(" ")[1],cells[index].innerHTML);
                }
                if (event.type === 'keydown' && event.keyCode === 13) {

                    let popup = document.getElementById("informations_ticket_popup_log");

                    while (popup.firstChild){
                        popup.firstChild.remove();
                    }
                    showPopup(cells[index].getAttribute("Class").split(" ")[1], cells[index].innerHTML);
                }
            }

            // Associer à la fois le clic et la touche "Entrée" à la fonction
            cells[index].addEventListener('click', handleClickOrEnter);
            cells[index].addEventListener('keydown', handleClickOrEnter);
        })(i);
    }
    //}

}

function ligneMonEspace(nom, fichier) {
    // let maListe = [nom, fichier];
    let maListe = ["ddddd"];
    requestMiam = new XMLHttpRequest()
    requestMiam.open("POST", "../ressources/reponseServeurPHP/reponsePOPupArchive.php")
    requestMiam.setRequestHeader("Content-Type", "application/json")
    requestMiam.send(JSON.stringify({maListe: maListe}))
    requestMiam.onreadystatechange = afficheArchiveDansPOP_UP
    console.log(JSON.stringify({maListe: maListe}))
}


function afficheArchiveDansPOP_UP() {

    if (requestMiam.readyState === 4 && requestMiam.status === 200) {
        console.log("(ajoutDesInfosDansPOP_UP) Réponse valide");

    }
};






