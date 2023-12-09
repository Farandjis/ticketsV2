// Fonction pour afficher la pop-up avec les informations de la ligne
function showPopup(row) {
    // Obtenez les cellules de la ligne
    var cells = row.getElementsByTagName("td");

    // Obtenez les données de chaque cellule
    var Id = cells[0].innerText;
    var Date = cells[1].innerText;
    var Titre = cells[2].innerText;
    var	Niv_Urgence = cells[3].innerText;
    var Description = cells[4].innerText;
    var Etat = cells[5].innerText;

    /*
    // Créez le contenu de la pop-up
    var content = "Date: " + Date + "<br>Titre: " + Titre + "<br>Niveau Urgence: " + Niv_Urgence + "<br>Description: " + Description + "<br>Demandeur: " + Demandeur ;
    */

    // Affichez le contenu dans la pop-up
    document.getElementById("popupId").innerHTML = Id;
    document.getElementById("popupDate").innerHTML = Date;
    document.getElementById("popupObjet").innerHTML = Titre;
    document.getElementById("popupNiveau").innerHTML = Niv_Urgence;
    document.getElementById("popupDescription").innerHTML = Description;
    document.getElementById("popupEtat").innerHTML = Etat;


    // Affichez la pop-up
    document.getElementById("overlay").style.display = "flex";
    document.getElementsByClassName("formModifTicket").classList.toggle("open");

    var closeButton = document.getElementById("fermer_pop-up");
    closeButton.focus();
}

// Fonction pour fermer la pop-up
function closePopup() {
    var overlay = document.getElementById("overlay");
    var bouton = document.getElementById("fermer_pop-up");

    window.addEventListener('click', function(event) {
        if (event.target === overlay || event.target === bouton) {
            overlay.style.display = 'none';

            document.getElementById("popupId").innerText = "";
            document.getElementById("popupDate").innerText = "";
            document.getElementById("popupNiveau").innerText = "";
            document.getElementById("popupEtat").innerText = "";
            document.getElementById("popupObjet").innerText = "";
            document.getElementById("popupDescription").innerText = "";

        }
    });


    /*
    document.getElementsByClassName("formModifTicket").classList.remove("open");*/
}
window.onload = init;
function init(){
    // Ajoutez des écouteurs d'événements aux lignes du tableau
    var table = document.querySelector("table");
    var rows = table.getElementsByTagName("tr");

    // Rendre toutes les lignes focusables lors du chargement du document
    for (var i = 0; i < rows.length; i++) {
        rows[i].setAttribute("tabindex", "0");
    }




    for (var i = 0; i < rows.length; i++) {
        // Utilisez une fonction anonyme pour capturer la valeur actuelle de "i"
        (function (index) {
            // Fonction pour gérer le clic ou la touche "Entrée"
            function handleClickOrEnter(event) {
                // Vérifier si la touche "Entrée" a été pressée (keyCode 13) ou si c'est un clic
                if (event.type === 'click' || (event.type === 'keydown' && event.keyCode === 13)) {
                    // Appelez la fonction showPopup avec la ligne actuelle
                    showPopup(rows[index]);
                }
            }

            // Associer à la fois le clic et la touche "Entrée" à la fonction
            rows[index].addEventListener('click', handleClickOrEnter);
            rows[index].addEventListener('keydown', handleClickOrEnter);
        })(i);
    }
}