function showPassword(el) {
    const container = el.parentNode;
    const passwordInput = container.querySelector('input');
    passwordInput.setAttribute('type','text');
    container.querySelector('.password-hide').style.display = 'block';
    container.querySelector('.password-show').style.display = 'none';
}

function hidePassword(el) {
    const container = el.parentNode;
    const passwordInput = container.querySelector('input');
    passwordInput.setAttribute('type','password');
    container.querySelector('.password-hide').style.display = 'none';
    container.querySelector('.password-show').style.display = 'block';
}