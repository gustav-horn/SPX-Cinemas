function swap(list: DOMTokenList, curr: string, replace: string) {
    if (list.contains(curr)) {
        list.remove(curr);
        list.add(replace)
    }
}

function changeOpen(accordians: Array<Element>, openCode: string) {
    accordians.map((element) => {
        if (element.getAttribute("order-id")! === openCode) {
            swap(element.classList, "hidden", "flex")
        }
        else {
            swap(element.classList, "flex", "hidden")
        }
    })
}

function establishAccordian(element: HTMLElement) {
    let header = element.getElementsByClassName("card-header")![0];
    let id = header.getAttribute("order-id")!;

    header.addEventListener("click", 
        () => changeOpen(Array.from(document.getElementsByClassName("collapse")), id)
    )
}


document.addEventListener("DOMContentLoaded", () => {
    // Plumb the behaviour for the accordian cards
    document.getElementsByName("accordian").forEach((element) => {
        establishAccordian(element)
    })
})