const toCartForms = document.querySelectorAll('.to-cart_form');
const cartCount = document.querySelector('#cart-count');

async function addToCart(url, csrf) {

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
            console.log(data);
            if (data.product == 'not-exists') {
                incrementCartCount();
            }
            console.log(data.text);
        })
        .catch((error) => {
            console.log('Что-то пошло не так...');
        });

}

function incrementCartCount() {
    cartCount.textContent = +cartCount.textContent + 1;
}
toCartForms.forEach(form => {
    const url = form.getAttribute('action');
    const btn = form.querySelector('.add-to-cart');
    btn.addEventListener('click', function (e) {
        e.preventDefault();

        const response = addToCart(url, form.querySelector('[name=_token]').value);

    })
});

