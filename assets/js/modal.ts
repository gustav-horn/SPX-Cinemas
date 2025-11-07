document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("trailerModal");
    const trailerFrame = document.getElementById("trailerFrame");
    const closeBtn = document.querySelector(".close");

    // Open modal
    document.querySelectorAll(".trailer-link").forEach(link => {
        link.addEventListener("click", function(e) {
            e.preventDefault();
            const trailerURL = this.getAttribute("data-trailer") + "?autoplay=1";
            trailerFrame.src = trailerURL;
            modal.style.display = "flex";
        });
    });

    // Close modal
    closeBtn.addEventListener("click", function() {
        modal.style.display = "none";
        trailerFrame.src = ""; // stop the video
    });

    // Close when clicking outside modal content
    window.addEventListener("click", function(e) {
        if (e.target === modal) {
            modal.style.display = "none";
            trailerFrame.src = "";
        }
    });
});