const confirmationForm = document.querySelector('#cookie-confirmation');
const confirmationBtn = confirmationForm.querySelector('#cookie-confirmation_btn');

function confirmationFormAppear() {
    confirmationForm.style.opacity = 1;
}


function confirmationFormDisappear() {
    confirmationForm.style.display = 'none';
}

function acceptCookies() {
    document.cookie = "cookie_consent=true; max-age=31536000; path=/; SameSite=Lax;";
    confirmationForm.style.opacity = '0';
    confirmationForm.addEventListener('transitionend', confirmationFormDisappear)
    confirmationForm.removeEventListener('transitionend', confirmationFormDisappear);
}

window.onload = function () {
    if (document.cookie.includes('cookie_consent=true')) {
        confirmationForm.style.display = 'none';
    }
    else {
        confirmationFormAppear();
    }
};



confirmationBtn.addEventListener('click', (e) => {
    e.preventDefault();
    acceptCookies();
})