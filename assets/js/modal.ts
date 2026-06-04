/// Establishes the behaviour of the trailer modal. 
document.addEventListener("DOMContentLoaded", function () {
    var modal = document.getElementById("trailerModal")!;
    var trailerFrame = document.getElementById("trailerFrame")!;
    var closeBtn = document.querySelector(".close")!;
    // Open modal
    document.querySelectorAll(".trailer-link").forEach(function (link) {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            assertHTMLAnchorElement(this);
            assertIFrame(trailerFrame);
            var trailerURL = this.getAttribute("data-trailer") + "?autoplay=1";
            trailerFrame.src = trailerURL;
            modal.style.display = "flex";
        });
    });
    // Close modal
    closeBtn.addEventListener("click", function () {
        assertIFrame(trailerFrame);
        modal.style.display = "none";
        trailerFrame.src = ""; // stop the video
    });
    // Close when clicking outside modal content
    window.addEventListener("click", function (e) {
        assertIFrame(trailerFrame);
        if (e.target === modal) {
            modal.style.display = "none";
            trailerFrame.src = "";
        }
    });
});


function assertIFrame(element: HTMLElement): asserts element is HTMLIFrameElement {
     console.assert(element instanceof HTMLIFrameElement, "the only items with id 'trailerFrame' should be the IFrame in which the trailer will play");
}

function assertHTMLAnchorElement(element: any): asserts element is HTMLAnchorElement {
    console.assert(element instanceof HTMLAnchorElement, "the only items with class 'trailer-link' should be links that display the trailer")
}