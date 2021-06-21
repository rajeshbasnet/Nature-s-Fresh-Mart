let columnFirst = document.querySelector(
  ".custom-container .row .column-first"
);

let customerSelection = document.querySelector(
  ".custom-container .row .column-first form fieldset .role-field #user"
);

let columnSecond = document.querySelector(
  ".custom-container .row .column-second"
);

let traderSelection = document.querySelector(
  ".custom-container .row .column-second form fieldset .role-field #user"
);

customerSelection.addEventListener("change", () => {
  let selectUser = customerSelection.value;

  if (selectUser === "trader") {
    traderSelection.options[0].defaultSelected = true;
    customerSelection.options[0].defaultSelected = false;

    //Removing customer signup form
    columnFirst.classList.add("none");

    //Adding trader signup form
    columnSecond.classList.add("block");
  }
});

traderSelection.addEventListener("change", () => {
  let selectUser = traderSelection.value;

  if (selectUser === "customer") {
    customerSelection.options[0].defaultSelected = true;
    traderSelection.options[0].defaultSelected = false;

    //Removing trader signup form
    columnSecond.classList.remove("block");

    //Adding customer signup form
    columnFirst.classList.remove("none");
  }
});
