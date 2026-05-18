const submit = document.querySelector('.submit');
submit.disabled = true;
submit.classList.add('disabled');

const confirmation = document.querySelector('#policy_confirmation');

confirmation.addEventListener('change', () => {
    if (confirmation.checked) {
        submit.disabled = false;
        submit.classList.remove('disabled');
    }
    else {
        submit.disabled = true;
        submit.classList.add('disabled');
    }
});