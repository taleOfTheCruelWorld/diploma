const sorting = document.querySelector('.sorting');

function sort(){
    console.log('da')
    sorting.submit();
}

sorting.firstElementChild.addEventListener('change', sort);
