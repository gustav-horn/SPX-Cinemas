document.addEventListener("DOMContentLoaded", function () {
    var modal = document.getElementById("trailerModal");
    var trailerFrame = document.getElementById("trailerFrame");
    var closeBtn = document.querySelector(".close");
    // Open modal
    document.querySelectorAll(".trailer-link").forEach(function (link) {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            var trailerURL = this.getAttribute("data-trailer") + "?autoplay=1";
            trailerFrame.src = trailerURL;
            modal.style.display = "flex";
        });
    });
    // Close modal
    closeBtn.addEventListener("click", function () {
        modal.style.display = "none";
        trailerFrame.src = ""; // stop the video
    });
    // Close when clicking outside modal content
    window.addEventListener("click", function (e) {
        if (e.target === modal) {
            modal.style.display = "none";
            trailerFrame.src = "";
        }
    });
});
