let increaseBtn = document.querySelector(
    ".cart-info .img-container .row .col-xl-7 .order-quantity .quantity .increase-btn"
);

let decreaseBtn = document.querySelector(
    ".cart-info .img-container .row .col-xl-7 .order-quantity .quantity .decrease-btn"
);

let input = document.querySelector(
    ".cart-info .img-container .row .col-xl-7 .order-quantity .quantity .form-control"
);


let innerText = parseInt(input.value);

increaseBtn.addEventListener("click", () => {
    if (innerText <= 20) {
        input.value = ++innerText;
    }

    if (innerText === 20) {
        increaseBtn.disabled = true;
    }
});

decreaseBtn.addEventListener("click", () => {
    if (innerText > 1) {
        input.value = --innerText;
    }

    if (innerText < 20 && increaseBtn.disabled === true) {
        increaseBtn.disabled = false;
    }
});