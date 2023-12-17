function toggleDropdown() {
    var dropdown = document.getElementById("menu_deroulant_libelle");
    if (event.type === 'click' ||(event.type === 'keydown' && event.keyCode === 13)){
        dropdown.classList.toggle("active");
    }
    if (event.type === 'keydown' && (event.key === "Escape" || event.keyCode === 27)){
        dropdown.classList.toggle("active");
    }
}


