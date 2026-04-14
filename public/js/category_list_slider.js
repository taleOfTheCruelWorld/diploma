const categoryList = document.getElementById('categories');

function scrollUp() {
    categoryList.scrollBy({ left: 200, behavior: "smooth" })
}

function scrollDown() {
    categoryList.scrollBy({ left: -200, behavior: "smooth" })
}

document.querySelector('#scroll_category_up').onclick = scrollUp;
document.querySelector('#scroll_category_down').onclick = scrollDown;