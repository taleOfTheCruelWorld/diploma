const accordions = document.querySelectorAll('.accordion .data');
console.log(accordions);

function acopen(el) {
    const options = el.parentElement.querySelector('.options');
    el.querySelector('.btn').style.transform = 'rotate(0.5turn)';
    options.style.height = 'fit-content';

}


function acclose(el) {
    const options = el.parentElement.querySelector('.options');
    el.querySelector('.btn').style.transform = 'none';
    options.style.height = '0';
}


accordions.forEach(el => {
    el.dataset.opened = false;
    el.addEventListener('click', () => {
        if (el.dataset.opened == 'true') {
            acclose(el);
            el.dataset.opened = 'false';
        }
        else {
            acopen(el);
            el.dataset.opened = 'true';
        }
    })
});

