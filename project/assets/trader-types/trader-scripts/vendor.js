let increaseBtn = document.querySelector(
    ".cart-info .img-container .row .col-xl-7 .order-quantity .quantity .increase-btn"
);

let classNameOfIncreaseBtn = increaseBtn.className;
let splittedClassName = classNameOfIncreaseBtn.split(' ');

let decreaseBtn = document.querySelector(
    ".cart-info .img-container .row .col-xl-7 .order-quantity .quantity .decrease-btn"
);

let input = document.querySelector(
    ".cart-info .img-container .row .col-xl-7 .order-quantity .quantity .form-control"
);

let innerText = parseInt(input.value);

if (splittedClassName.length === 2) {

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

} else if (splittedClassName.length > 2) {

    let lastSplittedValue = splittedClassName[2];
    let splitClass = lastSplittedValue.split('-');
    let maxOrders = parseInt(splitClass[1]);

    increaseBtn.addEventListener("click", () => {
        if (innerText <= maxOrders) {
            input.value = ++innerText;
        }

        if (innerText === maxOrders) {
            increaseBtn.disabled = true;
        }
    });

    decreaseBtn.addEventListener("click", () => {
        if (innerText > 1) {
            input.value = --innerText;
        }

        if (innerText < maxOrders && increaseBtn.disabled === true) {
            increaseBtn.disabled = false;
        }
    });
}


