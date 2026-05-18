const removeFromCartForms = document.querySelectorAll('.remove-from-cart_form');

async function removeFromCart(url, csrf) {

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
            decrementCartCount();
            console.log(data.text);
        })
        .catch((error) => {
            console.log('Что-то пошло не так...');
        });

}


removeFromCartForms.forEach(form => {
    const url = form.getAttribute('action');
    const btn = form.querySelector('.remove-from-cart_btn');
    btn.addEventListener('click', function (e) {
        e.preventDefault();

        const response = removeFromCart(url, form.querySelector('[name=_token]').value);

        form.parentElement.parentElement.remove();
        if (checkCart()) {
            calcCart();
        }

    })
});



function checkCart() {
    const products = document.querySelectorAll('.product');
    if (products.length < 1) {
        document.querySelector('.cart').innerHTML = '<div>Упс! Кажется здесь ничего нет!</div>';
        return false;
    }
    return true;
}

function calcCart() {
    const prices = document.querySelectorAll('.price .value');

    let result = 0;

    prices.forEach(el => {
        result += +el.textContent;
    });

    document.querySelector('.total-cost').innerHTML = `Итого: <strong>${result}</strong> Руб.`
}

const cartCount = document.querySelector('#cart-count');
function decrementCartCount() {
    cartCount.textContent = +cartCount.textContent - 1;
}
