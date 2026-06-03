import { submitData } from "./formSubmission.ts";

document.addEventListener("DOMContentLoaded", () => {
    let display = document.getElementById("seats-display")!;
    let updateTotal = () => {document.getElementById("total-cost-display")!.innerText = `$${Number(document.getElementById("cost-cell")!.getAttribute("cost")) * Number(display.innerText)}`};
    updateTotal();

    document.getElementById("plus")!.addEventListener("click", () => {
        display.innerText = (Number(display.innerText) + 1).toString();
        updateTotal()
    })
    document.getElementById("minus")!.addEventListener("click", () => {
        display.innerText = Math.max(Number(display.innerText) - 1, 0).toString();
        updateTotal()
    })

    let date = document.getElementById("booking-date")!;
    assertHTMLInputElement(date);

    document.getElementById("booking-submit")!.addEventListener("click", () => submitData([
        {
            key: "noOfSeats",
            value: display.innerHTML
        },
        {
            key: "date",
            value: date.value
        }
    ]))
})

function assertHTMLInputElement(element: HTMLElement): asserts element is HTMLInputElement {

}