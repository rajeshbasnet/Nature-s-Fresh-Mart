
let reviewContainer = document.querySelector('.review-container');
let btnReview = document.querySelector('.btn-review');

btnReview.addEventListener('click', () => {
    reviewContainer.classList.toggle('show-review');
})


let allIcons = document.querySelectorAll('.review-star');
let ratingValue = document.querySelector('.rating-value');
let fasCount = 0;

allIcons.forEach((icon, index, arrayIcons) => {
    icon.addEventListener('click', () => {
        let iconClassName = icon.className;
        let splittedIconClassName = iconClassName.split(' ');

        if (splittedIconClassName[0] === 'fas') {
            icon.removeAttribute('class');
            icon.setAttribute('class', 'far fa-star text-warning')
            --fasCount;
        }

        if (splittedIconClassName[0] === 'far') {
            icon.removeAttribute('class');
            icon.setAttribute('class', 'fas fa-star text-warning')
            fasCount++;
        }

        ratingValue.value = fasCount;

    })
})