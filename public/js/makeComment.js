const form = document.querySelector('.to_comment_form');
const submit = document.querySelector('.comment_btn');

const url = form.getAttribute('action');

function collectData() {
    let data = {};

    data['mark'] = form.querySelector('#mark').value;
    data['text'] = form.querySelector('#text').value;

    return data;
}

async function sendForm(url, data) {

    await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value
        },
        body: JSON.stringify(data),
    }).then(response => {

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
        .then(data => {
            alert('Комментарий доставлен');
        })
        .catch((error) => {
            alert('Что-то пошло не так...');
        });

}

submit.addEventListener('click', function (e) {
    e.preventDefault();

    const data = collectData();

    const responce = sendForm(url, data);

    console.log(responce);
})
