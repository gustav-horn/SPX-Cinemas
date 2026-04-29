import { submitData } from "./formSubmission.ts";

document.addEventListener("DOMContentLoaded", () => {
    let display = document.getElementById("seats-display")!
    document.getElementById("plus")!.addEventListener("click", () => {
        display.innerHTML = (Number(display.innerHTML) + 1).toString();
    })
    document.getElementById("minus")!.addEventListener("click", () => {
        display.innerHTML = Math.max(Number(display.innerHTML) - 1, 0).toString();
    })

    document.getElementById("booking-submit")!.addEventListener("click", () => submitData([{
        key: "noOfSeats",
        value: display.innerHTML
    }]))
})