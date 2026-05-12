"use strict";
function swap(list, curr, replace) {
    if (list.contains(curr)) {
        list.remove(curr);
        list.add(replace);
    }
}
function changeOpen(accordians, openCode) {
    accordians.map((element) => {
        if (element.getAttribute("order-id") === openCode) {
            swap(element.classList, "hidden", "flex");
        }
        else {
            swap(element.classList, "flex", "hidden");
        }
    });
}
function establishAccordian(element) {
    let header = element.getElementsByClassName("card-header")[0];
    let body = element.getElementsByClassName("collapse")[0];
    header.addEventListener("click", () => changeOpen(Array.from(document.getElementsByClassName("collapse")), header.getAttribute("order-id")));
}
document.addEventListener("DOMContentLoaded", () => {
    // Plumb the behaviour for the accordian cards
    document.getElementsByName("accordian").forEach((element) => {
        establishAccordian(element);
    });
});
