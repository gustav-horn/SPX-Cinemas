"use strict";
function initialise() {
    document.querySelectorAll(".movie-card").forEach((item) => item.addEventListener("click", function _() {
        location.href = `index.php?page=listings&movie=${this.getAttribute("id")}`;
    }));
}
document.addEventListener("DOMContentLoaded", initialise);
