function showPassword(el) {
    const container = el.parentNode;
    const passwordInput = container.querySelector('input');
    passwordInput.setAttribute('type','text');
    container.querySelector('.password-hide').style.display = 'block';
}

function hidePassword(el) {
    const container = el.parentNode;
    const passwordInput = container.querySelector('input');
    passwordInput.setAttribute('type','password');
    container.querySelector('.password-hide').style.display = 'none';
}