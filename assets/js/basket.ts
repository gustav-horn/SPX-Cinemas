import {submitData} from "./formSubmission.ts"

document.addEventListener("DOMContentLoaded", () => {
    // Plumb the edit buttons
    document.getElementsByName("edit-booking").forEach(
        (item) => item.addEventListener("click", 
            () => window.location.href = `index.php?page=booking&booking=${item.getAttribute("booking-id")!}`
        )
    )

    // Plumb the delete buttons
    document.getElementsByName("delete-booking").forEach(
        (item) => item.addEventListener("click",
            () => submitData([
                {key: "action", value: "delete"}, 
                {key: "item", value: item.getAttribute("booking-id")!}
            ])
        )
    )

    // Plumb the submit button
    document.getElementById("basket-confirm")?.addEventListener("click", 
        () => submitData([{key: "action", value: "confirm"}])
    )

})