const openBtns = document.querySelectorAll('.create-new-value_btn');
const closeBtn = document.querySelector('.close-modal_btn');
const modal = document.querySelector('.modal');
const createBtn = document.querySelector('.create-value_btn');

let select;


function openModal() {
    modal.style.display = 'flex';
}

function closeModal() {
    modal.style.display = 'none';
}


openBtns.forEach(btn => {
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        openModal();
        select = this.previousElementSibling;
    });
});

closeBtn.addEventListener('click', function (e) {
    e.preventDefault();
    closeModal();
});

function createValue() {
    const value = modal.querySelector('.create-value_value').value;

    let option = document.createElement('option');
    option.setAttribute('value', value);
    let optionText = value;
    option.append(optionText);

    select.append(option);
}

createBtn.addEventListener('click', function (e) {
    e.preventDefault();
    createValue();
    closeModal();
})

