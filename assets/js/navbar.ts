interface NavBarContext {
    active: boolean,
}

var NavBarContext = {active: false}

/// Displays the drop-down navbar
function displayNavBar() {
    var navs = document.getElementsByTagName("nav")
    for (let index = 0; index < navs.length; index++) {
        let item = navs[index];
        if (NavBarContext.active === true) {
            item.classList.remove("mobile-nav")
            setTimeout(() => NavBarContext.active = false, 1);
        }
        else {
            item.classList.add("mobile-nav")
            setTimeout(() => NavBarContext.active = true, 1)
        }
    }
}

/// Removes from display all navbars that haven't been explicitly clicked on
function navBarClickHandler(this: Document, ev: Event) {
    assertPointerEvent(ev);
    let navs = this.getElementsByTagName("nav");
    if (NavBarContext.active) {
        for (let index = 0; index < navs.length; index++) {
            var item = navs[index];
            let rect = item.getBoundingClientRect();
            if ((ev.clientX < rect.left) || (ev.clientX > rect.right) || (ev.clientY > rect.bottom) || (ev.clientY < rect.top)) {
                // console.log("Closing")
                item.classList.remove("mobile-nav")
            }
        }
        setTimeout(() => NavBarContext.active = false, 1)
    }
}

function assertPointerEvent(event: Event): asserts event is PointerEvent {
}

/// Initialises the behaviour of the navbar
function establishNavbar() {
    document.addEventListener("click", navBarClickHandler)
    document.getElementById("hamburger")!.addEventListener("click", displayNavBar);
}


document.addEventListener("DOMContentLoaded", establishNavbar)