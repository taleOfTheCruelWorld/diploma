const menu = document.querySelector('.nav-mobile');
const nav = document.querySelector('.main_nav');

function menuVisabilityChange() {
    if (nav.style.display == 'flex') {
        close();
    }
    else {
        open();
    }
}

function open() {
    nav.style.display = 'flex';
}

function close() {
    nav.style.display = 'none';
}

menu.addEventListener('click', menuVisabilityChange);

