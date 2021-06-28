let allColumnImg = document.querySelectorAll(".column-img");
let allColumns = document.querySelectorAll(".column");

let allColumnsArr = Array.prototype.slice.call(allColumns);

const clickHandler = (index, currentCol) => {
    let currentEl = allColumnsArr.find((curr, id) => id == index);
    currentEl.classList.add("width-100");

    let remainingColumns = allColumnsArr.filter((currEl, id) => {
        return id != index;
    });

    remainingColumns.forEach((col) => {
        col.classList.add("width-0");
    });

    //Mouse Out Event
    currentCol.addEventListener("mouseout", () => {
        mouseHandler(index);
    });
};

const mouseHandler = (index) => {
    let currentEl = allColumnsArr.find((curr, id) => id == index);
    currentEl.classList.remove("width-100");
    let remColumns = allColumnsArr.filter((currEl, id) => {
        return id != index;
    });
    remColumns.forEach((col) => {
        col.classList.remove("width-0");
    });
};

allColumnImg.forEach((currentCol, index) => {
    currentCol.addEventListener("mouseover", () => {
        clickHandler(index, currentCol);
        console.log(currentCol);
    });
});
