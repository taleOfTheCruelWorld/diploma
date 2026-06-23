const setCartItemCountForms = document.querySelectorAll('.set-cart-item-count_form');

async function setCartItemCount(url, csrf, data) {

    await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': csrf,
        },
        body:JSON.stringify(data),
        redirect: "follow",
    }).then(response => {

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
        .then(data => {
            alert(data.text);
            calcCart();
        })
        .catch((error) => {
            alert('Что-то пошло не так...');
        });

}

function collectData(from){
    let data = {};

    data.count = from.querySelector('.count').value;

    return data;
}

setCartItemCountForms.forEach(form => {
    const url = form.getAttribute('action');
    const btn = form.querySelector('.set-cart-item-count_btn');
    btn.addEventListener('click', function (e) {
        e.preventDefault();

        const data = collectData(form);
        const response = setCartItemCount(url, form.querySelector('[name=_token]').value, data);

    })
});



