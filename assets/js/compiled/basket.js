import { submitData } from "./formSubmission.js";
document.addEventListener("DOMContentLoaded", () => {
    var _a;
    // Plumb the edit buttons
    document.getElementsByName("edit-booking").forEach((item) => item.addEventListener("click", () => window.location.href = `index.php?page=booking&booking=${item.getAttribute("booking-id")}`));
    // Plub the delete buttons
    document.getElementsByName("delete-booking").forEach((item) => item.addEventListener("click", () => submitData([
        { key: "action", value: "delete" },
        { key: "item", value: item.getAttribute("booking-id") }
    ])));
    // Plumb the submit button
    (_a = document.getElementById("basket-confirm")) === null || _a === void 0 ? void 0 : _a.addEventListener("click", () => submitData([{ key: "action", value: "confirm" }]));
});
