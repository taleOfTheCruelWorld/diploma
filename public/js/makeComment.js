const form = document.querySelector('.to_comment_form');
const submit = document.querySelector('.comment_btn');

const url = form.getAttribute('action');

function collectData() {
    const data = new FormData();

    data.append('mark', form.querySelector('#mark').value);
    data.append('text', form.querySelector('#text').value);

    const images = form.querySelector('#images').files;
    for (let i = 0; i < images.length; i++) {
        data.append('images[]', images[i]);
    }

    data.append('_token', form.querySelector('[name="_token"]').value);
    return data;
}

async function sendForm(url, data) {

    await fetch(url, {
        method: "POST",
        body: data,
    }).then(response => {

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
        .then(data => {
            console.log(data);
            //alert('Комментарий доставлен');
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
