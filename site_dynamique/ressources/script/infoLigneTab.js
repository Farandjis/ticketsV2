
// Fonction pour afficher la pop-up avec les informations de la ligne
function showPopup(row, tableAct) {
    // Obtenez les cellules de la ligne

    let entete = tableAct.getElementsByTagName("th");

    let cells = row.getElementsByTagName("td");

    for (let i=0; i < cells.length;i++){

        let cellTete = entete[i].innerText;

        let cell = cells[i].innerText;

        let textLigne = document.createElement("p");

        let textBold = document.createElement("strong");
        textBold.innerText = cellTete + " : ";

        let textInfo = document.createElement("span");
        textInfo.innerText = cell;

        textLigne.appendChild(textBold);
        textLigne.appendChild(textInfo);

        document.getElementById("informations_ticket_popup").appendChild(textLigne);

    }


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

            let popupAct = document.getElementById("informations_ticket_popup");

            while (popupAct.firstChild){
                popupAct.firstChild.remove();
            }

        }
    });


}
window.onload = init;

function init(){
    //=============== LIGNE TABLEAU ==============

    // Ajoutez des écouteurs d'événements aux lignes du tableau
    var table = document.getElementsByClassName("table-popup");

    for (let noTable = 0; noTable < table.length; noTable++) {

        let tableAct = table[noTable];


        let rows = tableAct.getElementsByTagName("tr");

        // Rendre toutes les lignes focusables lors du chargement du document
        for (let i = 0; i < rows.length; i++) {
            rows[i].setAttribute("tabindex", "0");
        }


        for (let i = 1; i < rows.length; i++) {
            // Utilisez une fonction anonyme pour capturer la valeur actuelle de "i"
            (function (index) {
                // Fonction pour gérer le clic ou la touche "Entrée"
                function handleClickOrEnter(event) {
                    /*
                    Note de Matthieu :
                    J'ai ajouté le `&& rows[index].className != "pasLigneHover"`.
                    On ne prend pas en compte l'interraction si c'est la ligne informant l'utilisateur de l'absence de données.
                     */

                    // Vérifier si la touche "Entrée" a été pressée ou si c'est un clic
                    if (event.type === 'click' && rows[index].className != "pasLigneHover") {
                        // Appelez la fonction showPopup avec la ligne actuelle
                        showPopup(rows[index], tableAct);
                    }
                    if (event.type === 'keydown' && event.keyCode === 13  && rows[index].className != "pasLigneHover"){

                        let popupAct = document.getElementById("informations_ticket_popup");

                        while (popupAct.firstChild){
                            popupAct.firstChild.remove();
                        }

                        showPopup(rows[index], tableAct);
                    }
                }

                // Associer à la fois le clic et la touche "Entrée" à la fonction
                rows[index].addEventListener('click', handleClickOrEnter);
                rows[index].addEventListener('keydown', handleClickOrEnter);
            })(i);
        }

    }

}