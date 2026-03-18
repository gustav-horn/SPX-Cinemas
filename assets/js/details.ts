interface context {
    activeDetail?: detail,
}

interface detail {
    element: HTMLElement,
    isActive: boolean,
}

var context: context = {
    activeDetail: undefined
}


// Let users click out of the details page
document.addEventListener("click", function(ev) {
    let detail = context.activeDetail;
    if (detail && detail.isActive) {
        let visible = detail.element.getElementsByClassName("details-content").item(0)!;
        let rect = visible.getBoundingClientRect();
        // console.log(rect.left, rect.right, rect.bottom, rect.top);
        // console.log(ev.clientX, ev.clientY)
        if ((ev.clientX < rect.left) || (ev.clientX > rect.right) || (ev.clientY > rect.bottom) || (ev.clientY < rect.top)) {
            // console.log("Closing")
            detail.element.style.display = "none"
        }
    }
})

document.addEventListener("DOMContentLoaded", function() {
    // Key assumption: One-one mapping of modals to items with class "close".
    // i.e. All close buttons are matched with one and only one modal
    var modals = document.getElementsByClassName("details-modal");
    var btns = document.querySelectorAll(".details-close");

    console.assert(modals.length == btns.length, "The number of modals and buttons don't match")

    let closeBtn = function(btn: HTMLElement) {
        return () => {assertHTMLElement(btn); btn.style.display = "none"}
    }

    // Set up the close buttons
    for (var i = 0; i < modals.length; i++) {
        let modal = modals[i]; 
        assertHTMLElement(modal);
        btns[i].addEventListener("click", closeBtn(modal))
    }

    // Plumb the behaviour for the movie-cards
    document.querySelectorAll(".movie-card").forEach((card) => {
        card.addEventListener("click", () => {
            open(card.getAttribute("id")!)
            }
        );
    })

    // Make sure the initial details card is opened
    let initId;
    if ((initId = document.getElementById("movieInit")!.getAttribute("key")!) != "None") {
        open(initId);
    }
})


function assertHTMLElement(element: Element): asserts element is HTMLElement {
    console.assert(element instanceof HTMLElement, "Where are you using this? The only elements with className 'modal' should be HTMLElements.");
}

/// Opens the movieDetails modal associated with the provided id
function open(id: string) {
    let item = document.getElementById("movieDetails"+id)!; 
    item.style.display = "flex"; 
    context.activeDetail = {element: item, isActive: false}; 
    setTimeout(() => context.activeDetail!.isActive = true, 1)
}