const removeFromFavoriteForms = document.querySelectorAll('.remove-from-favorite_form');

async function removeFromFavorite(url, csrf) {

    await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': csrf,
        },
        redirect: "follow",
    }).then(response => {

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
        .then(data => {
            decrementFavoriteCount();
            console.log(data.text);
        })
        .catch((error) => {
            console.log('Что-то пошло не так...');
        });

}


removeFromFavoriteForms.forEach(form => {
    const url = form.getAttribute('action');
    const btn = form.querySelector('.remove-from-favorite_btn');
    btn.addEventListener('click', function (e) {
        e.preventDefault();

        const response = removeFromFavorite(url, form.querySelector('[name=_token]').value);

        form.parentElement.parentElement.remove();
        checkFavorite();

    })
});



function checkFavorite() {
    const products = document.querySelectorAll('.product');
    if (products.length < 1) {
        document.querySelector('.favorite-items').innerHTML = '<div>Упс! Кажется здесь ничего нет!</div>';
        return false;
    }
    return true;
}

const favoriteCount = document.querySelector('#favorite-count');
function decrementFavoriteCount() {
    favoriteCount.textContent = +favoriteCount.textContent - 1;
}
