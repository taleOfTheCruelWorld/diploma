function collectData(){
    let data = new FormData();

    let inputs = filterForm.getElementsByTagName('input');

    inputs.forEach(input => {
        data.append(input.getAttribute('name'), input.getAttribute('value'));
    });

    return data;
}

const filterBtn = document.querySelector('.filter_btn');
const filterForm = document.querySelector('.filter_form');

filterBtn.addEventListener('click', async function(e){
    e.preventDefault();

    const formData = collectData();

    const responce = await fetch('http://localhost/search', {
        method:'GET',
        body:formData
    })

    console.log(await responce.json());

});