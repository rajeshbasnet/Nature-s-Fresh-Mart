let checkoutBtn = document.querySelector('.container-fluid .row .col-xl-3 .checkout-btn');
let overlay = document.querySelector('.overlay');
let agreementSection = document.querySelector('.agreement-section');

checkoutBtn.addEventListener('click', (event) => {
    event.preventDefault();
    overlay.classList.add('block');
    agreementSection.classList.add('visible');


    setTimeout(() => {
        window.location.href = "/website/project/assets/checkout/checkout.php";
    }, 2000)
})