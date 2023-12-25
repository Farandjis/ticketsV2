function hamburger() {
    var nav = document.querySelector("nav");
    var btnToggleNav = document.querySelector(".hamburger-menu");

    nav.classList.toggle("active");
    btnToggleNav.classList.toggle("active");
}