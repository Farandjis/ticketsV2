function toggleDropdown() {
    var dropdown = document.getElementById("menu_deroulant_libelle");
    dropdown.classList.toggle("active");
}


function setupForm(buttonId, overlayId) {
    var showFormBtn = document.getElementById(buttonId);
    var overlay = document.getElementsByClassName(overlayClass);

    showFormBtn.addEventListener('click', function() {
        overlay.style.display = 'flex';
    });

    window.addEventListener('click', function(event) {
        if (event.target === overlay) {
            overlay.style.display = 'none';
        }
    });
}

// Initialisation des formulaires
setupForm('show-form-btn-1', 'overlay');
setupForm('show-form-btn-2', 'overlay');