const categoryList = document.getElementById('categories');

function scrollUp() {
    categoryList.scrollBy({ left: 200, behavior: "smooth" })
}

function scrollDown() {
    categoryList.scrollBy({ left: -200, behavior: "smooth" })
}

const up = document.querySelector('#scroll_category_up');
const down = document.querySelector('#scroll_category_down');

up.onclick = scrollUp;
down.onclick = scrollDown;

const categorySlider = document.querySelector('header .category_list .categories');

function checkScroll() {
    if (categorySlider.scrollWidth > categorySlider.clientWidth) {
        up.style.display = 'block';
        down.style.display = 'block';
    }
    else {
        up.style.display = 'none';
        down.style.display = 'none';
    }
}

window.addEventListener('load', checkScroll);
window.addEventListener('resize', checkScroll);