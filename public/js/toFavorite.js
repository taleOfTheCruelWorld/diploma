const toFavoriteForms = document.querySelectorAll('.to-favorite_form');
const favoriteCount = document.querySelector('#favorite-count');

async function addToFavorite(url, csrf) {

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
            if (data.product == 'exists') {
                incrementFavoriteCount();
            }
            alert(data.text);
        })
        .catch((error) => {
            alert('Что-то пошло не так...');
        });

}

function incrementFavoriteCount() {
    favoriteCount.textContent = +favoriteCount.textContent + 1;
}
toFavoriteForms.forEach(form => {
    const url = form.getAttribute('action');
    const btn = form.querySelector('.add-to-favorite');
    btn.addEventListener('click', function (e) {
        e.preventDefault();

        const response = addToFavorite(url, form.querySelector('[name=_token]').value);
    })
});

