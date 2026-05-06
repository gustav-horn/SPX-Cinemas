import { submitData } from "./formSubmission.js";
document.addEventListener("DOMContentLoaded", () => {
    let display = document.getElementById("seats-display");
    let updateTotal = () => { document.getElementById("total-cost-display").innerText = `$${Number(document.getElementById("cost-cell").getAttribute("cost")) * Number(display.innerText)}`; };
    document.getElementById("plus").addEventListener("click", () => {
        display.innerText = (Number(display.innerText) + 1).toString();
        updateTotal();
    });
    document.getElementById("minus").addEventListener("click", () => {
        display.innerText = Math.max(Number(display.innerText) - 1, 0).toString();
        updateTotal();
    });
    document.getElementById("booking-submit").addEventListener("click", () => submitData([{
            key: "noOfSeats",
            value: display.innerHTML
        }]));
});
