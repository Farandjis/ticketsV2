/*

function validateForm() {
    validateLogin();
    validatePassword();
    validateVerifPassword();
    validatePrenom();
    validateNom();
    validateEmail();
}
*//*
window.onload = init;
function init(){
    document.getElementById('inscriptionForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Empêche l'envoi du formulaire par défaut
        validateForm();
    });

    document.getElementById('login').addEventListener('input', validateLogin);
    document.getElementById('mdp').addEventListener('input', validatePassword);
    document.getElementById('verifMdp').addEventListener('input', validateVerifPassword);
    document.getElementById('mdp').addEventListener('input', validateVerifPassword);
    document.getElementById('nom').addEventListener('input', validateNom);
    document.getElementById('prenom').addEventListener('input', validatePrenom);
    document.getElementById('email').addEventListener('input', validateEmail);
}




function validateLogin() {
    const loginInput = document.getElementById('login');
    const loginError = document.getElementById('loginError');
    const loginPattern = /^.{5,32}$/;
    var validation = false;

    if (loginPattern.test(loginInput.value)) {
        // Le login est valide
        //loginError.textContent = '';
        loginInput.removeAttribute("class")
        loginInput.setAttribute("class", "champValide")
        validation = true
    } else {
        // Le login est invalide
        // loginError.textContent = 'Le login doit contenir entre 5 et 32 caractères.';
        loginInput.removeAttribute("class")
        loginInput.setAttribute("class", "champInvalide")
    }
    return validation
}

function validatePassword() {
    const passwordInput = document.getElementById('mdp');
    const passwordError = document.getElementById('passwordError');
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!.#$%&*])(.{12,32})$/;
    var validation = false;


    if (passwordPattern.test(passwordInput.value)) {
        // Le mot de passe est valide
        //passwordError.textContent = '';
        passwordInput.removeAttribute("class")
        passwordInput.setAttribute("class", "champValide")
        validation = true
    } else {
        // Le mot de passe est invalide
        //passwordError.textContent = 'Le mot de passe doit contenir au moins 12 caractères, une majuscule, un chiffre, un caractère spécial, et ne pas dépasser 32 caractères.';
        passwordInput.removeAttribute("class")
        passwordInput.setAttribute("class", "champInvalide")
    }
    return validation
}
function validateVerifPassword() {
    const passwordInput = document.getElementById('mdp');
    const verifPasswordInput = document.getElementById('verifMdp');

    const passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[!.#$%&*])(.{12,32})$/;
    var validation = false;

    if (passwordInput.value === (verifPasswordInput.value)) {
        // Le mot de passe est valide
        //passwordError.textContent = '';
        verifPasswordInput.removeAttribute("class")
        verifPasswordInput.setAttribute("class", "champValide")
        validation = true
    } else {
        // Le mot de passe est invalide
        //passwordError.textContent = 'Le mot de passe doit contenir au moins 12 caractères, une majuscule, un chiffre, un caractère spécial, et ne pas dépasser 32 caractères.';
        verifPasswordInput.removeAttribute("class")
        verifPasswordInput.setAttribute("class", "champInvalide")
    }
    return validation
}

function validatePrenom() {
    const prenomInput = document.getElementById('prenom');

    const namePattern = /^[a-zA-Z\-]{2,50}$/;
    var validation = false;

    if (namePattern.test(prenomInput.value)) {
        // Le nom et le prénom sont valides
        //nameError.textContent = '';

        prenomInput.removeAttribute("class")
        prenomInput.setAttribute("class", "champValide")
        validation = true
    } else {
        // Le nom ou le prénom est invalide
        //nameError.textContent = 'Le nom et le prénom ne doivent contenir que des lettres et le caractère "-".';

        prenomInput.removeAttribute("class")
        prenomInput.setAttribute("class", "champInvalide")
    }
    return validation
}
function validateNom() {
    const nomInput = document.getElementById('nom');

    const namePattern = /^[a-zA-Z\-]{2,50}$/;
    var validation = false;

    if (namePattern.test(nomInput.value)) {
        // Le nom et le prénom sont valides
        //nameError.textContent = '';

        nomInput.removeAttribute("class")
        nomInput.setAttribute("class", "champValide")
        validation = true
    } else {
        // Le nom ou le prénom est invalide
        //nameError.textContent = 'Le nom et le prénom ne doivent contenir que des lettres et le caractère "-".';
        nomInput.removeAttribute("class")
        nomInput.setAttribute("class", "champInvalide")
    }
    return validation
}


function validateEmail() {
    const emailInput = document.getElementById('email');
    const emailError = document.getElementById('emailError');
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]{2,4}$/;
    var validation = false;

    if (emailPattern.test(emailInput.value)) {
        // L'email est valide
        // emailError.textContent = '';
        emailInput.removeAttribute("class")
        emailInput.setAttribute("class", "champValide")
        validation = true
    } else {
        // L'email est invalide
        // emailError.textContent = 'Format d\'email invalide';
        emailInput.removeAttribute("class")
        emailInput.setAttribute("class", "champInvalide")
    }
    return validation
}*/


function validateForm() {
    var isFormValid = true;
    var fields = ['login', 'mdp', 'verifMdp', 'prenom', 'nom', 'email'];

    fields.forEach(function(field) {
        if (!validateField(field)) {
            isFormValid = false;
        }
    });

    if (isFormValid) {
        document.getElementById('inscriptionForm').submit();
    } else {
        alert('Veuillez remplir correctement tous les champs.');
    }
}

function validateField(fieldName) {
    const input = document.querySelector(`#${fieldName}`);
    const pattern = getValidationPattern(fieldName);

    if (fieldName === 'verifMdp') {
        // Pour le champ 'verifMdp', vérifiez si la valeur est identique à celle de 'mdp'
        const mdpValue = document.getElementById('mdp').value;
        if (input.value === mdpValue && pattern.test(input.value)) {
            updateFieldStatus(input, 'champValide');
            return true;
        } else {
            updateFieldStatus(input, 'champInvalide');
            return false;
        }
    } else {
        // Pour les autres champs, utilisez le motif de validation standard
        if (pattern.test(input.value)) {
            updateFieldStatus(input, 'champValide');
            return true;
        } else {
            updateFieldStatus(input, 'champInvalide');
            return false;
        }
    }
}


function getValidationPattern(fieldName) {
    // Ajoutez ici la logique pour retourner le motif de validation en fonction du champ
    switch(fieldName) {
        case 'login':
            return /^.{5,32}$/;
        case 'mdp':
            return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%.&*])(.{12,32})$/;
        case 'verifMdp':
            return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%.&*])(.{12,32})$/;
        case 'prenom':
        case 'nom':
            return /^[a-zA-Z\-]{2,50}$/;
        case 'email':
            return /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        default:
            return /.*/;
    }
}

function updateFieldStatus(input, status) {
    input.classList.remove('champValide', 'champInvalide');
    input.classList.add(status);
}

window.onload = init;

function init() {
    document.getElementById('inscriptionForm').addEventListener('submit', function(event) {
        event.preventDefault();
        validateForm();
    });

    var fields = ['login', 'mdp', 'verifMdp', 'prenom', 'nom', 'email'];
    fields.forEach(function(field) {

        document.getElementById(field).addEventListener('input', function() {
            validateField(field);
            if (field === 'mdp'){
                document.getElementById('mdp').addEventListener('input', validateField('verifMdp'));
            }
        });
    });
    document.getElementById('mdp').addEventListener('input', function() {
        validatePassword();  // Réexécutez la validation du champ mdp
        validateVerifPassword();  // Réexécutez la validation du champ verifMdp
    });
}
